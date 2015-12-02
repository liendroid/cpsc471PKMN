//code to check if user is logged in
<?PHP
    require_once("membersite_config.php");
    
    if(checklogin()==false)
    {
        header("Location: index.php");
        die();
        exit;
    }
    ?>


<!doctype html>
<head>
<title>Page</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
//stylesheet definition
<link rel="stylesheet" href="templatestyle.css">

<meta charset="UTF-8"><script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<link rel="stylesheet" href="/css/font-awesome.min.css">

</head>

<body style="min-width:1600px";>

//top header
<header>
Pokemon Battle1
</header>

<div id="pokedex"  >
/// put content in here////
</div>



<div class="menuWrapper">

<div class="topHalf">
<a href="#" class="back-to-top">Back to Top</a>

<div class="pokeballwrapper" id="pokeballwrapperID" onclick="window.location.href = 'selection.php'";>
<div class="pokeballimg" ></div>
<div id="selectedtxtlbl" class="btnlabelclass">Pokeball</div>
</div>

<div class="stadiumwrapper" id="stadiumwrapper" onclick="stadiumClick();">
<div class="stadiumimg" onclick="";></div>
<div class="btnlabelclass">Stadium</div>
</div>

<div class="accountwrapper" id="accountwrapper" onclick="showaccount();";>
<div class="accountimg" ></div>
<div class="btnlabelclass">Account</div>
</div>

<div class="logoutwrapper" id="logoutwrapper" onclick="window.location.href = 'logout.php'">
<div class="logoutimg"></div>
<div class="btnlabelclass">Logout</div>
</div>



<div class="bottomHalf" ></div>

</div>


<div id="form-messages"></div>


</body>

<script>
var sqlDATA = ''; //Global variable to store what is retrieved from sql


//This is the function which will run as soon as the page is loaded up.
$(document).ready(function(){
                  getFromSql(done,'getusers');
                  });

//this is the function getFromSql() will return to
function done(id){
    tempData = JSON.parse(sqlDATA); //This command is used to parse the incoming data in sqlDATA.
    alert(tempData[0].name);
}



/*
 This is the function that is used to get sql data.
 It takes in two parameters. The first is callback, which is the function you want this function to return to after it finishes the SQL
 This is so it will only continue after retrieveing the data.
 url is the php file which containts the connection information
 
 qType is the query type, this is used to let connection php know what to retrieve.
 
 */
function getFromSql(callback,qType) {
    $.ajax({
           type: 'POST',
           url: 'templatedb.php',
           data: {qtype: qType}, //more information can be passed to the URL PHP, for now I am only passing qtype
           success: function(response){
           sqlDATA = response;
           //THIS IS A TEST ALERT TO HELP YOU.
           alert("RECIEVED " + response);
           callback (response);
           },
           error: function(msg){
           alert("Error: "+msg);
           }
           });
    
}

</script>

</html>
