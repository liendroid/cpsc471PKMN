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
<link rel="stylesheet" href="battlestyle.css">

<meta charset="UTF-8"><script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<link rel="stylesheet" href="/css/font-awesome.min.css">

</head>

<body style="min-width:1600px";>


<header>
Opponent Selection
</header>

<h1>Choose an opponent:</h1>
<div id="pokedex"  >

</div>

<div class="continuebtn" onclick="readyBattle()";>Continue</div>
<div class="menuWrapper">

<div class="topHalf">
<a href="#" class="back-to-top">Back to Top</a>

<div class="pokeballwrapper" id="pokeballwrapperID" onclick="window.location.href = 'home.php'";>
<div class="pokeballimg" ></div>
<div id="selectedtxtlbl" class="btnlabelclass">Back</div>
</div>





<div id="pokemonHolder" >


</div>

<div class="logoutwrapper" id="logoutwrapper" onclick="window.location.href = 'logout.php'">
<div class="logoutimg"></div>
<div class="btnlabelclass">Logout</div>
</div>

<div class="bottomHalf" ></div>

</div>


<div id="form-messages"></div>


<script>


/*$(function () {
 $(".login-box").on("submit", function () {
 
 $.ajax({
 type: "post",
 url: "login.php",
 data: $(this).serialize(),
 success: function (response) {
 if (response == "done") {
 alert("worked");
 }
 else {
 alert("Form submission failed!");
 }
 }
 
 });
 return false;
 });
 });
 
 <h1>Login</h1>
 <form class="login-box" method="post" action="">
 <div class="username-wrapper">
 <label for="username" class="username-label">Username</label>
 <input type="text"name="username" id="username">
 </div>
 <div class="password-wrapper">
 <label for="password">Password</label>
 <input type="password" name="password" id="password">
 </div>
 <input type="submit" value="Login!"/>
 </form>
 
 */




//<input type="button"  class="btn" value="' + i + '" onclick="testF(' + i +')" ;/>
</script>

</body>

<script>

function testF(id){
    //alert("Button Number " + id + " was pressed");
}


var pokemons = [];
var pokemonsfull;
var players;
var playerpokelist;
var pokemon;
var selectedPokemon;
var currentlySelected = [];
var incomingList;
var playerid;
var strSelectedList;
var searchFor;
var searchResults;
var firstrun = 0;
var removeIt = false;
var amountScrolled = 300;
var source = 1;
var pokedexid;
var toadd;
var currentselection = 0;
var playerwins = 0;
var playerloses = 0;
var botselection = 0;

$(window).scroll(function() {
                 if ( $(window).scrollTop() > amountScrolled ) {
                 $('a.back-to-top').fadeIn('slow');
                 
                 $('.bottomsearchbar').fadeIn('slow');
                 } else {
                 $('a.back-to-top').fadeOut('slow');
                 $('.bottomsearchbar').fadeOut('slow');
                 }
                 });



function setpokemons(){
    
    pokemons = JSON.parse(incomingList);
    var html='';
    for(i = 0; i < pokemons.length; i++) {
        var name = pokemons[i].name;
        var difficulty = pokemons[i].difficulty
        var stars = '';
        var pokedexobj = document.getElementById('pokedex');
        
        while (pokedexobj.hasChildNodes()) {
            pokedexobj.removeChild(pokedexobj.firstChild);
        }

        
        for(j=0; j<difficulty; j++){
            stars += '<i class="fa fa-star"></i>';
        }
        
        var startingclass = 'blockwrapper';
        
        html += ' <div id="blockwrapper'+(i+1)+'"class="'+startingclass+'"  onclick="select('+ (i+1) +')"; onmouseover="removeIt=true;source = 1;"; onmouseout="removeIt=false;"; > <div class="name">'+name+'</div> <div class="imageholder" style="background-image: url(img/'+name+'.png); background-size: 80%; background-position: center; background-repeat: no-repeat;"> </div> <div class="difficultybar">'+ stars + '</div> </div>';
    }
    $('#pokedex').append(html);
    //setmenu(pokemons);
}


 
function setcurrentpokemon(){
   var selectedpokemoninfo = JSON.parse(incomingList);
    
    
    //var node = document.getElementById('pokemonHolder');
    //while (node.hasChildNodes()) {
    //    node.removeChild(node.firstChild);
   // }
    pokedexnumber = selectedpokemoninfo[0].pokedex;
    var imgname;
    if(pokedexnumber<10){
        
        imgname = '00'+pokedexnumber;
    } else if (pokedexnumber<100){
        imgname = '0'+pokedexnumber;
    } else {
        imgname = pokedexnumber;
    }
    
    var html = '<div id="pokeblock" class="pokeblock"><div class="pokeblockName">' + selectedpokemoninfo[0].name + '</div><div class="pokeblockstattxt">' + selectedpokemoninfo[0].hp + ' <i class="fa fa-heart"></i></div><div class="pokeblockstattxt">' + selectedpokemoninfo[0].atk + ' <i class="fa fa-gavel"></i></div><div class="pokeblockstattxt">' + selectedpokemoninfo[0].def + ' <i class="fa fa-shield"></i></div><div class="pokeblockstattxt">' + selectedpokemoninfo[0].spd + ' <i class="fa fa-bolt"></i></div><img src="img/'+imgname+'.png" class="smallblockimg"></img></div>';
    
    $('#pokemonHolder').append(html);
    
    
    
    
}


$(document).ready(function(){
                   playerid = "<?php session_start(); echo ( $_SESSION['userID']); ?>" ;
                   selectedPokemon = "<?php echo $_GET['currentselection']?>";
                  //alert(selectedPokemon);
                   pokedexid = selectedPokemon;
                   getpoke(setpokemons,'getbots');
                   getpoke(setcurrentpokemon, 'getpokemonbyid');
                  });



function clearSearch(newSearch){
    var textbox = document.getElementById('search2');
    textbox.value = newSearch;
    searchFor = newSearch;
    getpoke(setpokemons,'searchpokemon');
    
}

function clearSearchb(newSearch){
    var textbox = document.getElementById('search');
    textbox.value = newSearch;
    searchFor = newSearch;
    getpoke(setpokemons,'searchpokemon');
}


function select(from){
    
    
    oldselection = currentselection;
    currentselection = from;
    
    var oldwrapperobj = document.getElementById("blockwrapper"+oldselection);
    var currwrapperobj = document.getElementById("blockwrapper"+from);
    
    if(oldselection==0) {
        currwrapperobj.className = 'blockwrappersel';
        return;
    }
    if(oldselection!=from && oldwrapperobj.className=='blockwrappersel'){
        oldwrapperobj.className ='blockwrapper';
        currwrapperobj.className = 'blockwrappersel';
    } else {
        currwrapperobj.className = 'blockwrappersel';
    }
    
}







function searchChanged(searchfor){
    if(searchfor.length==0){
        getpoke(setpokemons,'getpokemon');
    } else {
        searchFor = searchfor;
        getpoke(setpokemons,'searchpokemon');
        
    }
    
}
function readyBattle(){

    if(currentselection!=0){
        botselection = Math.floor(Math.random() * (298 - 1 + 1) + 1);
        getpoke(setBattle, 'setbattle');
        
    } else {
        alert("please choose an opponent");
    }
    
}

function setBattle(){
    window.location.href = 'template.php?currentselection='+pokedexid+'&botselection='+botselection;
    
}

function getpoke(callback,qType) {
   // alert("userid: " + playerid + " botid " + currentselection + " botpokemon " + botselection + " userpokemon "  + selectedPokemon);
    $.ajax({
           type: 'POST',
           url: 'selectiondb.php',
           data: {qtype: qType, pid: playerid, pokemons: strSelectedList, searchstr: searchFor, pokedexid: pokedexid, botid: currentselection, botpokemon: botselection, userpokemon: selectedPokemon},
           success: function(response){
           incomingList = response;
           //pokemons =  res.split(" ");
           //alert("RECIEVED "+response);
           callback (response);
           },
           error: function(msg){
           alert("Error: "+msg);
           }
           });
    
}

</script>

</html>


