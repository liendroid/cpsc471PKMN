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
<link rel="stylesheet" href="homestyle.css">

<meta charset="UTF-8"><script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<link rel="stylesheet" href="/css/font-awesome.min.css">

</head>

<body style="min-width:1600px";>


<header>
Beat em up
</header>

<h1>Your Currently Selected Pokemon:</h1>
<div id="pokedex"  >

</div>
<h1>Stats:</h1>

</div>

<div id="recordwrapper">
<div id="winswrapper">wins</div>
<div id="loseswrapper">loses</div>
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

<div class="accountwrapper" id="accountwrapper" onclick="window.location.href = 'account.php'";>
<div class="accountimg" ></div>
<div class="btnlabelclass">Account</div>
</div>

<div class="logoutwrapper" id="logoutwrapper" onclick="window.location.href = 'logout.php'">
<div class="logoutimg"></div>
<div class="btnlabelclass">Logout</div>
</div>



<div id="pokemonHolder" >


</div>

<div class="bottomHalf" ></div>

</div>


<div id="form-messages"></div>

</body>

<script>

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
$(window).scroll(function() {
                 if ( $(window).scrollTop() > amountScrolled ) {
                 $('a.back-to-top').fadeIn('slow');
                 
                 $('.bottomsearchbar').fadeIn('slow');
                 } else {
                 $('a.back-to-top').fadeOut('slow');
                 $('.bottomsearchbar').fadeOut('slow');
                 }
                 });

function setPlayerPokemon(){
    incomingList = incomingList.replace("[","");
    incomingList = incomingList.replace("]","");
    playerpokelist = incomingList.split(",");
    toadd = playerpokelist.length;
    for(var i = 0; i<=playerpokelist.length; i++){
        pokedexid = playerpokelist[i];

        getpoke(buildpokemons, 'getpokemonbyid');
        
    }
    
    
}

function buildpokemons(){
    if(toadd>0){
        if(incomingList.indexOf("<")==-1){
            //alert(incomingList);
            pokemon = JSON.parse(incomingList);
            item = {};
            item ["name"] = pokemon[0].name;
            item ["pokedex"] = pokemon[0].pokedex;
            item ["hp"] = pokemon[0].hp;
            item ["def"] = pokemon[0].def;
            item ["atk"] = pokemon[0].atk;
            item ["spd"] = pokemon[0].spd;
            pokemons.push(item);
            toadd--;
        } else {
            return;
        }
    } else {
        setpokemons();
    }
}


function setpokemons(){

    //pokemons = JSON.parse(incomingList);
    //alert ("inhere" + pokemons.length);
    var html='';
    for(i = 0; i < pokemons.length; i++) {
        var pokedexnumber = pokemons[i].pokedex;
        var hearts = '';
        var atkdots = '';
        var defsheilds = '';
         var spdbolts = '';
        var pokedexobj = document.getElementById('pokedex');
        
        while (pokedexobj.hasChildNodes()) {
            pokedexobj.removeChild(pokedexobj.firstChild);
        }
        
        var numOfdef = ((pokemons[i].def/2)-(pokemons[i].def/2.5));
        var numOfHP = ((pokemons[i].hp/2)-(pokemons[i].hp/2.5));
        var numOfAtk = ((pokemons[i].atk/2)-(pokemons[i].atk/2.5));
        var numOfspd = ((pokemons[i].spd/2)-(pokemons[i].spd/2.5));
        if(numOfdef>16){
            numOfdef=16;
        }
        if(numOfHP>14){
            numOfHP=14;
        }
        if(numOfAtk>12){
            numOfAtk=12;
        }
        for(j=0; j<numOfspd; j++){
            spdbolts += '<i class="fa fa-bolt"></i>';
        }
        
        for(j=0; j<numOfHP; j++){
            hearts += '<i class="fa fa-heart"></i>';
        }
        
        for(j=0; j<numOfAtk; j++){
            atkdots += '<i class="fa fa-gavel"></i>';
        }
        
        for(j=0; j<numOfdef; j++){
            defsheilds += '<i class="fa fa-shield"></i>';
        }
        
        var startingclass = 'blockwrapper';
        
        for(j=0;j<currentlySelected.length;j++){
            if(pokedexnumber==currentlySelected[j]){
                startingclass = 'blockwrappersel';
            }
        }
        
        var imgname;
        if(pokedexnumber<10){
            
            imgname = '00'+pokedexnumber;
        } else if (pokedexnumber<100){
            imgname = '0'+pokedexnumber;
        } else {
            imgname = pokedexnumber;
        }
        
        html += ' <div id="blockwrapper'+pokedexnumber+'"class="'+startingclass+'"  onclick="select('+ pokedexnumber +')"; onmouseover="removeIt=true;source = 1;"; onmouseout="removeIt=false;"; > <div class="pokedexnumber">#'+pokedexnumber+'</div> <div class="imageholder" style="background-image: url(img/'+imgname+'.png); background-size: 80%; background-position: center; background-repeat: no-repeat;"> </div> <div class="healthbar">'+ pokemons[i].hp + 'HP '+ hearts + '</div> <div class="block-bottom-part">  <div class="namewrapper"> '+ pokemons[i].name +' </div><div class="attacktxt">attack:</div><div class="atkbar"> ' + pokemons[i].atk +' '+ atkdots + '</div><div class="defencetxt">defence:</div><div class="defbar"> ' + pokemons[i].def +' '+ defsheilds + '</div><div class="spdtxt">speed:</div><div class="spdbar"> ' + pokemons[i].spd +' '+ spdbolts + '</div></div></div>';
    }
    $('#pokedex').append(html);
    //setmenu(pokemons);
}

/*

function setmenu(){
    
    
    var node = document.getElementById('pokemonHolder');
    while (node.hasChildNodes()) {
        node.removeChild(node.firstChild);
    }
    
    //node = document.getElementById('selectedText');
    //while (node.hasChildNodes()) {
    //    node.removeChild(node.firstChild);
    //}
    
    //alert("in setmenu");
    var selected = currentlySelected.length;
    //document.getElementById('selectedtxtlbl').innerHTML = 'Ready! ('+selected+'/6)';
    for(var i = 0;i<selected;i++){
        
        var pokedexnumber = pokemonsfull[currentlySelected[i]-1].pokedex;
        var imgname;
        if(pokedexnumber<10){
            
            imgname = '00'+pokedexnumber;
        } else if (pokedexnumber<100){
            imgname = '0'+pokedexnumber;
        } else {
            imgname = pokedexnumber;
        }
        
        var html = '<div id="pokeblock" class="pokeblock"  onclick="test('+ pokedexnumber +')"; onmouseover="source = 0;if(document.getElementById(\'blockwrapper'+ pokedexnumber +'\')!=null){document.getElementById(\'boxclose'+ pokedexnumber +'\').style.display = \'block\';}"; onmouseout="removeIt = false;document.getElementById(\'boxclose'+ pokedexnumber +'\').style.display = \'none\'";><div id="boxclose'+ pokedexnumber +'" class="boxclose"  onmouseover="removeIt=true;";onmouseout="removeIt=false;";></div><div class="pokeblockName">' + pokemonsfull[currentlySelected[i]-1].name + '</div><div class="pokeblockstattxt">' + pokemonsfull[currentlySelected[i]-1].hp + ' <i class="fa fa-heart"></i></div><div class="pokeblockstattxt">' + pokemonsfull[currentlySelected[i]-1].atk + ' <i class="fa fa-gavel"></i><div class="pokeblockstattxt">' + pokemonsfull[currentlySelected[i]-1].def + ' <i class="fa fa-shield"></i></div><div class="pokeblockstattxt">' + pokemonsfull[currentlySelected[i]-1].spd + ' <i class="fa fa-bolt"></i></div><img src="http://assets22.pokemon.com/assets/cms2/img/pokedex/full/'+imgname+'.png" class="smallblockimg"></img></div>';
        $('#pokemonHolder').append(html);
    }
    
    
    
}
*/

$(document).ready(function(){
                  playerid = "<?php session_start(); echo ( $_SESSION['userID']); ?>" ;
                  getpoke(setPlayerPokemon,'getplayerpokemons');
                  getpoke(setRecord, 'getplayerrecord');
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


function setPlayers(){
    players = JSON.parse(incomingList);
    //alert(players[0].name);
    getpoke(setPlayerPokemon,'getplayerpokemons');
}




function savePokemon(){
    
    strSelectedList = '';
    for(var i = 0; i <currentlySelected.length; i++){
        strSelectedList += currentlySelected[i] + ",";
    }
    alert("saved");
    getpoke(saveDone,'savepokemons');
    
}

function saveDone(){
    
}




function searchChanged(searchfor){
    if(searchfor.length==0){
        getpoke(setpokemons,'getpokemon');
    } else {
        searchFor = searchfor;
        getpoke(setpokemons,'searchpokemon');
        
    }
    
}


function stadiumClick(){
    if(currentselection===0){
        alert("Please select a pokemon to battle with");
    } else {
        //alert(currentselection);
        "<?php session_start(); $currsel = $_GET['currentselection']; $_SESSION['selectedPokemon'] = '. $currsel .'; ?>";
        window.location.href = "battle.php?currentselection=" + currentselection;
    }
}

function setRecord(){
    var winwrapper = document.getElementById('winswrapper');
    var loseswrapper = document.getElementById('loseswrapper');
    var record = JSON.parse(incomingList);
    
    winwrapper.innerHTML = record[0].wins+ " wins";
    loseswrapper.innerHTML = record[0].loses + " loses";
}

function getpoke(callback,qType) {
    $.ajax({
           type: 'POST',
           url: 'selectiondb.php',
           data: {qtype: qType, pid: playerid, pokemons: strSelectedList, searchstr: searchFor, pokedexid: pokedexid},
           success: function(response){
           incomingList = response;
           callback ();
           },
           error: function(msg){
           alert("Error: "+msg);
           }
           });
    
}

</script>

</html>


