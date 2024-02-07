<?php

        class Person {
            public $name;
            public $email;
            public $dept;
            public $rank;
            public $phone;
            public $room;
            
            function __construct($name, $email, $dept, $rank, $phone, $room) {
                $this->name = $name;
                $this->email = $email;
                $this->dept = $dept;
                $this->rank = $rank;
                $this->phone = $phone;
                $this->room = $room;
            }
        }
        
        class ErrorMsg {
            public $errorMessage;
            public $errorCode;
            
            public function __construct($errorMessage, $errorCode) {
                $this->errorMessage = $errorMessage;
                $this->errorCode = $errorCode;
            }
            
            public function message() {
                return '[{"errorMessage":"' . $this->errorMessage . '", "errorCode":"' . $this->errorCode . '"}]';
            }
        }
        
        function array_usearch(array $array, callable $comparitor) {
        return array_filter(
        $array,
        function ($element) use ($comparitor) {
            if ($comparitor($element)) {
                return $element;
                    }
                }
            );
        }


?>