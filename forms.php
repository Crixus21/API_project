<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CRUD rendszer</title>
        
        <link rel="stylesheet"  type="text/css" href="bootstrap/css/bootstrap.min.css">
        <script type="text/javascript" src="bootstrap/js/bootstrap.bundle.js"></script>
        <script type="text/javascript" src="scripts.js"></script>
        <script type="module" src="bootstrap/js/index.bundle.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col d-flex justify-content-center mb-4">
                    <h1 class="">CRUD rendszer</h1>
                </div>
                <fieldset>
                    <legend>Keresés</legend>
                    <form id="peopleGetForm" method="get" action="index.php/people">
                        <div class="col-sm-5">
                        <label class="form-label" for="email">Email alapján keres:</label>
                        <input class="form-control" type="text" id="email" name="email">
                        </div>
                        <input class="btn btn-primary mt-2" type="submit" name="submit" value="Elküld">
                    </form>
                </fieldset>

                <hr class="my-5">

                <fieldset>
                <legend>Person beszúrása</legend>
                    <form id="peoplePostForm" method="post" action="index.php/people">
                        <div class="col-sm-5">
                        <label class="form-label" for="name">Name: </label>
                        <input class="form-control" type="text" id="name" name="name">
                        <label class="form-label" for="email">Email: </label>
                        <input class="form-control" type="text" id="email" name="email">
                        <label class="form-label" for="dept">Dept: </label>
                        <input class="form-control" type="text" id="dept" name="dept">
                        <label class="form-label" for="rank">Rank: </label>
                        <input class="form-control" type="text" id="rank" name="rank">
                        <label class="form-label" for="phone">Phone: </label>
                        <input class="form-control" type="text" id="phone" name="phone">
                        <label class="form-label" for="room">Room: </label>
                        <input class="form-control" type="text" id="room" name="room">
                        </div>
                        <input class="btn btn-primary mt-2" type="submit" name="Submit" value="Elküld">

                    </form>
                </fieldset>

                <hr class="my-5">

                <fieldset>
                <legend>Törlés</legend>
                    <form>
                        <div class="col-sm-5">
                        <label class="form-label">Törlendő email címe:</label>
                        <input class="form-control" type="text" id="delEmail" name="email">
                        </div>
                        <div class="btn btn-primary mt-2 d-inline-block" onclick="delPerson()">Törlés</div>
                        <div class="d-inline-block ms-3" id="result"></div>
                    </form>
                </fieldset>
                
                <hr class="my-5">
                
                <fieldset>
                    <form>
                        <div class="col-sm-5">
                        <label class="form-label">Számok összege</label>
                        <input class="form-control" type="text" id="number" name="number">
                        </div>
                        <div class="btn btn-primary mt-2 d-inline-block" onclick="numSum()">Összead</div>
                        <div class="d-inline-block ms-3" id="sumResult"></div>
                    </form>
                    
                </fieldset>
                
                <hr class="my-5">
                
                <p class="d-inline-block">Pie közelítő értéke: </p><div class="d-inline-block" id="pieResult"></div>
                <!--calcPie metódussal számolva-->
                
                <hr class="my-5">
                
                <p>Egy bolha az alábbi módszer szerint ugrál egy bálna hátán: egyet (egy cm-t) előre, egyet hátra, kettőt előre, egyet hátra, hármat előre, egyet hátra, stb… (tehát előreugrás után mindig ugrik egyet hátra, és hátra ugrás után eggyel nagyobbat ugrik előre mint az előző előreugrásban ugrott - időközben ugyanis megerősödik és egyre nagyobbakat tud ugrani).
                    Hol lesz a bolha száz ugrás után?<br>
                    1225, SUM(1-50) – 50 <br>
(50-szer lép visszafele egyet, 50-ig minden előre lépésnél egyel nő az ugrások száma.)</p>

            </div>
        </div>
    </body>
    <script>calcPie();</script>
    
</html>


