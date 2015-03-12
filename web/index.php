<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        body {
            padding-top: 50px;
            padding-bottom: 20px;
        }
        output { 
          position: absolute;
          background-image: linear-gradient(#444444, #999999);
          width: 40px; 
          height: 30px; 
          text-align: center; 
          color: white; 
          border-radius: 10px; 
          display: inline-block; 
          font: bold 15px/15px Georgia;
          bottom: 175%;
          left: 0;
        }
        output:after { 
          content: "";
          position: absolute; 
          width: 0;
          height: 0;
          border-top: 10px solid #999999;
          border-left: 5px solid transparent;
          border-right: 5px solid transparent;
          top: 100%;
          left: 50%;
          margin-left: -5px;
          margin-top: -1px;
        }
        form { position: relative; margin: 50px; /*width: 1200px;*/ }
        
        #wordBox {
            margin-top: 150px;
        }
        #activeWord {

            font-size: 600%;

        }
        .center{
            text-align: center;
        }
        .wordsoup span {
            margin: 3px;
            float: left;
        }
        .wordsoup span:hover {
            color: green;
        }
        @keyframes flickerAnimation {
          0%   { opacity:1; }
          50%  { opacity:0; }
          100% { opacity:1; }
        }
        @-o-keyframes flickerAnimation{
          0%   { opacity:1; }
          50%  { opacity:0; }
          100% { opacity:1; }
        }
        @-moz-keyframes flickerAnimation{
          0%   { opacity:1; }
          50%  { opacity:0; }
          100% { opacity:1; }
        }
        @-webkit-keyframes flickerAnimation{
          0%   { opacity:1; }
          50%  { opacity:0; }
          100% { opacity:1; }
        }
        .animate-flicker {
           -webkit-animation: flickerAnimation 1s ;
           -moz-animation: flickerAnimation 1s ;
           -o-animation: flickerAnimation 1s ;
            animation: flickerAnimation 1s ;

            -webkit-animation-iteration-count: 3; /* Chrome, Safari, Opera */
            animation-iteration-count: 3;
        }
        #arrow {
            width: 200px;
            margin-right: 100px;
            -ms-transform: rotate(-102deg); /* IE 9 */
            -webkit-transform: rotate(-102deg); /* Chrome, Safari, Opera */
            transform: rotate(-102deg);
        }
    </style>
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
<!--    <link rel="stylesheet" href="css/main.css">-->

</head>
<body>
<!--[if lt IE 7]>
<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a id="headline" class="navbar-brand" href="#">ContentCoder</a>
        </div>
        <div class="navbar-collapse collapse">
            <form id="login" class="navbar-form navbar-right" role="form" novalidate><!--  -->
                <div class="form-group">
                    <input id="username" type="text" placeholder="username" class="form-control" required>
                </div>
                <button id="loginBtn" type="submit" class="btn btn-success">Logg inn</button>
            </form>
        </div><!--/.navbar-collapse -->
    </div>
</div>

<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron">
    <div class="container">
        <img id="arrow" src="arrow.png" alt="" class="pull-right animate-flicker">
        <h1>Hello, Coder!</h1>

        <p>Logg inn ved å skrive inn ditt navn i menybaren øverst! </p>
<!-- 
        <div class="alert alert-info" role="alert">
             <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
             <h3>her er info</h3>
             <p>Vi trenger data</p>
        </div> -->

        <div class="panel panel-info">
          <div class="panel-heading">
            <h3 class="panel-title">Hva er dette?</h3>
          </div>
          <div class="panel-body">
            Den enkleste formene for <a href="https://en.wikipedia.org/wiki/Sentiment_analysis">sentimentanalyse</a> gjøres ved å kjøre en tekst gjennom en ordliste med ord som er annotert med en verdi.<br />
            <span class="label label-info">hurra</span>, <span class="label label-info">fantastisk</span> og <span class="label label-info">brilliant</span> er super-positive ord, og får en super-høy skår. <span class="label label-info">drittsekk</span>, <span class="label label-info">katastrofalt</span> og <span class="label label-info">ludder</span> er super-negative og så en super-lav skår. <br />
            <br />
            Her trenger jeg din hjelp til å annotere hvor spositive eller nagative ord er, slik at vi kan lage en ordliste sammen. <br />
            <br />
            Skalaen går fra -5 (super-negativt) til 5 (super-positivt). Et ord som <span class="label label-info">jeg</span> eller <span class="label label-info">trikk</span> er i denne sammenhengen nøytrale og får verdien 0. <br />     
            <br />
            PS: Koden og ordlisten lagres åpent på <a href="https://github.com/eiriks/Afinn-for-Norsk">github</a>.<br />


          </div>
        </div>
<!-- 
        <div class="alert alert-info" role="alert">...</div>

        <div class="alert alert-danger" role="alert">
          <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
          <span class="sr-only">Error:</span>
          Enter a valid email address
        </div> -->

<!--         <p><a class="btn btn-primary btn-lg" role="button">Learn more &raquo;</a></p> -->
    </div>
</div>

<div class="container">
    <!-- Example row of columns -->
    <div class="row">
        <div class="col-md-4">
        </div>
        <div id="wordBox" class="col-md-4 center">
            <span id="activeWord">word</span>
        </div>
        <div class="col-md-4">
        </div>

        <div class="col-md-12">
            <form>
<!--             <label for="rater">Rating</label> -->
            <input id="rater" type="range" min="-5" max="5" step="1" value="0" />
            <output for="rater" onforminput="value = rater.valueAsNumber;"></output>
            </form>
        </div>
    </div>


    <div class="row">
        <div class="col-md-4">
        </div>
        <div class="col-md-4 center">
            <button id="confermButn" type="submit" class="btn btn-success btn-lg">Slik er det !</button>
        </div>
        <div class="col-md-4">
                    <button id="skip" type="submit" class="btn btn-default pull-right">Skipp ord</button>
        </div>
    </div>


<hr />


    <div class="row wordsoup">
    <?php
            // Create connection
            include 'settings.php'; // get username, pass, etc
            $conn = new mysqli($servername, $username, $password, $dbname);
            if (!$conn->set_charset("utf8")) {
                printf("Error loading character set utf8: %s\n", $mysqli->error);
            } else {
                //printf("Current character set: %s\n <br/>", $conn->character_set_name());
            }
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            //$sql = "SELECT * FROM worsentiment_wordsds";
            $sql = "SELECT value,name, count(*) c FROM sentiment_words GROUP BY name order by c, rand()";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    // output here
                    echo "<span class='".$row['name']."' data-target='".$row['value'] ."'>".  $row['name']."</span>";
                    //echo "id: " . $row["id"]. " - url: " . $row["url"]. " " . $row["title"]. "<br>";
                }
            } else {
                echo "0 results";
            }
            $conn->close();
            ?>
    </div>


<!--     <div class="row">
        <div class="col-md-4">
            <h2>Idé</h2>
            <p>Problemet er å laget et GUI som får kodere til å kategorisere nyhetstekster så raskt som mulig.</p>
            <p>Må sende ogg videre eller fjerne en kategorisering fra GUI auto for å skape moment framover.</p>
            <p>Må ha støtte for hva hver kategori inkluderer for å bekjempe tvil og inkonsistens</p>
            <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
        </div>
        <div class="col-md-4">
            <h2>Kategoriene</h2>
            <p>test
            </p>
            <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
        </div>
        <div class="col-md-4">
            <h2>Heading</h2>


            <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
            <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
        </div>
    </div> -->

    <hr>

    <footer>
        <p>&#187; Eirik 2015</p>
    </footer>
</div> <!-- /container -->        
<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>-->
<script>window.jQuery || document.write('<script src="js/jquery-1.11.1.min.js"><\/script>')</script>
<script src="js/bootstrap.min.js"></script>
<script>
// function outputUpdate(vol) {
//     document.querySelector('#out').value = vol;
// }


</script>
<script src="js/slider.js"></script>
</body>
</html>