<?php
        include_once 'dependencies.php';
        
        //Küldött adatok beolvasása
        $getEmail = filter_input(INPUT_GET, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
        $postName = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
        $postEmail = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
        $postDept = filter_input(INPUT_POST, 'dept', FILTER_SANITIZE_SPECIAL_CHARS);
        $postRank = filter_input(INPUT_POST, 'rank', FILTER_SANITIZE_SPECIAL_CHARS);
        $postPhone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_SPECIAL_CHARS);
        $postRoom = filter_input(INPUT_POST, 'room', FILTER_SANITIZE_SPECIAL_CHARS);
        
        
        
        
        //Person objektumlista létrehozása az xml fájlból
        $peopleArr = array();
        $xml = simplexml_load_file('people.xml') or die("Error");
        
        
        foreach($xml as $person)
        {
            $newPerson = new Person((string)$person->name, (string)$person->email, (string)$person->dept, (string)$person->rank, (string)$person->phone, (string)$person->room);
            $peopleArr[] = $newPerson;
        }
        
        //URI kinyerése
        $uri = parse_URL($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = explode('/', $uri);
        $rmethod = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_SPECIAL_CHARS);
        
        
        //Eseménykezelés
        if (isset($uri[3]) && $uri[3] === 'people' && $rmethod == 'GET')
        {
            $searchedArr = array_usearch($peopleArr, function($person) use($getEmail) { return $person->email == $getEmail; });
            $searchedArr = array_values($searchedArr);
            if(count($searchedArr) === 0){
                http_response_code(400);
                $errorObj = new ErrorMsg('Nem található az adatbázisban', http_response_code());
                echo $errorObj->message();
            }
            else
            {
                echo json_encode($searchedArr, JSON_UNESCAPED_UNICODE);
            }
        }
        
        if (isset($uri[3]) && $uri[3] === 'people' && $rmethod == 'POST')
        {
            
            $hibauzenet = '';
            if(empty(trim($postName)) || empty(trim($postEmail)) || empty(trim($postDept)) || empty(trim($postRank)) || empty(trim($postPhone)))
            {
                $hibauzenet .= 'Nem adtál meg minden adatot. ';
            }
            
            if(!filter_var($postEmail, FILTER_VALIDATE_EMAIL))
            {
               $hibauzenet .= 'Az email nem megfelelő formátumú. '; 
            }
            
            $searchedArr = array_usearch($peopleArr, function($person) use($postEmail) { return $person->email == $postEmail; });
            $searchedArr = array_values($searchedArr);
            if(count($searchedArr) !== 0){
                $hibauzenet .= 'Ezzel az e-maillel már valaki létezik a rendszerben. ';
            }
            

            if(mb_strlen($postPhone) !== 16 || !is_numeric(substr($postPhone, 12, 4)) || substr($postPhone, 0, 12) !== '+36 (1) 666-')
            {
                $hibauzenet .= 'A telefonszám formátuma nem megfelelő. ';
            }
            
            if(!empty($hibauzenet)) 
            {
                http_response_code(400);
                $errorObj = new ErrorMsg($hibauzenet, http_response_code());
                echo $errorObj->message();
            }
            else 
            {
                
                $domXML = new DOMDocument('1.0','UTF-8');
                $domXML->preserveWhiteSpace = false;
                $domXML->formatOutput = true;
                $domXML->load('people.xml');
                
                
                $newPerson = $domXML->createElement('person');
                $newPerson->appendChild($domXML->createElement('email', $postEmail));
                $newPerson->appendChild($domXML->createElement('name', $postName));
                $newPerson->appendChild($domXML->createElement('dept', $postDept));
                $newPerson->appendChild($domXML->createElement('rank', $postRank));
                $newPerson->appendChild($domXML->createElement('phone', $postPhone));
                if(!empty($postRoom))
                {
                    $newPerson->appendChild($domXML->createElement('room', $postRoom));
                }
                $domXML->getElementsByTagName('people')[0]->appendChild($newPerson);
                
                $domXML->save('people.xml');
                
                echo '[{"Message":"Success"}]';
            }
        }
        
        
        if (isset($uri[3]) && $uri[3] === 'people' && $rmethod == 'DELETE')
        {
            $data = file_get_contents("php://input");
            
            $searchedArr = array_usearch($peopleArr, function($person) use($data) { return $person->email == $data; });
            $searchedArr = array_values($searchedArr);
            if(count($searchedArr) === 0){
                http_response_code(400);
                $errorObj = new ErrorMsg('Nem létezik ilyen ember a rendszerben.', http_response_code());
                echo $errorObj->message();
            }
            else 
            {
                $domXML = new DOMDocument('1.0','UTF-8');
                $domXML->preserveWhiteSpace = false;
                $domXML->formatOutput = true;
                $domXML->load('people.xml');
                
                $doc = $domXML->documentElement;
                $persons = $doc->getElementsByTagName('person');
                
                $nodeToRemove = null;
                foreach ($persons as $person) {
                    if($person->getElementsByTagName('email')->item(0)->nodeValue === $data)
                    {
                        $nodeToRemove = $person;
                    }
                }
                
                if( $nodeToRemove != null)
                {
                    $doc->removeChild($nodeToRemove);
                }
                
                $domXML->save('people.xml');
                
                echo '[{"Message":"Success"}]';
                
            }
        }
        
?>