<?PHP
    require_once("membersite_config.php");
    
    if(checklogin()==false)
    {
        echo("asdf");
        RedirectToURL("index.php");
        
        exit;
    }
?>

<!doctype html>
	<head>
		<title>Page</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="selectionstyle.css">
<meta charset="UTF-8"><script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<link rel="stylesheet" href="/css/font-awesome.min.css">

	</head>

	<body style="min-width:1600px";>


        <header>
            Pokemon Battle1
        </header>



<form id="searchform">
<input type="text" name="search" id="search2" class="search" onclick="clearSearch('')"placeholder="Search For Pokemon..." autocomplete="off">
</form>



<div id="pokedex"  >

</div>
<div class="menuWrapper">

    <div class="topHalf">
        <a href="#" class="back-to-top">Back to Top</a>
        <input type="text" name="search" class="bottomsearchbar" id="search" onclick="clearSearchb('')"placeholder="Search..." autocomplete="off">
       <div class="pokeballwrapper" id="pokeballwrapperID">
        <div class="pokeballimg" onclick="savePokemon()";></div>
        <div id="selectedtxtlbl" class="selectedtxtlblclass">Ready!(0/0)</div>

        </div>
        <div id="pokemonHolder" >

        </div>
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
    alert("Button Number " + id + " was pressed");
}



var pokemons;
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
    //alert(incomingList);
    //alert("firstrun:" + firstrun);
    if(firstrun==1){
        pokemonsfull = JSON.parse(incomingList);
        //alert("pokemonsfull: " + pokemonsfull.length)
        pokemons = JSON.parse(incomingList);
        //alert("pokemons: " + pokemons.length)
        firstrun=0;
        
    }else{
        pokemons = JSON.parse(incomingList);
    }
    
    //alert(pokemons[2].name);
   // var pokemonhps = [30,70,80,39,58,78];
   // var pokemonatk = [49,62,82,52,64,84];
   // var pokemondef = [49,63,83,43,58,78];
    
    var html='';
    for(i = 0; i < pokemons.length; i++) {
        var pokedexnumber = pokemons[i].pokedex;
        var hearts = '';
        var atkdots = '';
        var defsheilds = '';
        var pokedexobj = document.getElementById('pokedex');
        
        while (pokedexobj.hasChildNodes()) {
            pokedexobj.removeChild(pokedexobj.firstChild);
        }
        
        var numOfdef = ((pokemons[i].def/2)-(pokemons[i].def/2.5));
        var numOfHP = ((pokemons[i].hp/2)-(pokemons[i].hp/2.5));
        var numOfAtk = ((pokemons[i].atk/2)-(pokemons[i].atk/2.5));
        if(numOfdef>16){
            numOfdef=16;
        }
        if(numOfHP>14){
            numOfHP=14;
        }
        if(numOfAtk>12){
            numOfAtk=12;
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
            
        html += ' <div id="blockwrapper'+pokedexnumber+'"class="'+startingclass+'"  onclick="test('+ pokedexnumber +')"; onmouseover="removeIt=true;source = 1;"; onmouseout="removeIt=false;"; > <div class="pokedexnumber">#'+pokedexnumber+'</div> <div class="imageholder" style="background-image: url(http://assets22.pokemon.com/assets/cms2/img/pokedex/full/'+imgname+'.png); background-size: 80%; background-position: center; background-repeat: no-repeat;"> </div> <div class="healthbar">'+ pokemons[i].hp + 'HP '+ hearts + '</div> <div class="block-bottom-part">  <div class="namewrapper"> '+ pokemons[i].name +' </div><div class="attacktxt">attack:</div><div class="atkbar"> ' + pokemons[i].atk +' '+ atkdots + '</div><div class="defencetxt">defence:</div><div class="defbar"> ' + pokemons[i].def +' '+ defsheilds + '</div></div></div>';
    }
    $('#pokedex').append(html);
    setmenu(pokemons);
}


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
    document.getElementById('selectedtxtlbl').innerHTML = 'Ready! ('+selected+'/6)';
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


$(document).ready(function(){
                 //alert("loaded: " + playerid);
                  playerid = "<?php session_start(); echo ( $_SESSION['userID']); ?>" ;
                  //alert("loaded: " + playerid);
                  getpoke(setpokemons,'getpokemon');
                  getpoke(setPlayers,'getplayers');
                  firstrun = 1;
                  $("#search").on("input", function(e){
                                  
                                         // if($(this).val()==="") return;
                                  searchFor = $(this).val();
                                  var textbox = document.getElementById('search2');
                                  getpoke(setpokemons,'searchpokemon');
                                  textbox.value = searchFor;
                                  });
                  $("#search2").on("input", function(e){
                                  
                                  // if($(this).val()==="") return;
                                  searchFor = $(this).val();
                                  getpoke(setpokemons,'searchpokemon');
                                  
                  });
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


function test(from){
    var textbox = document.getElementById('search2');
    var wrapperobj = document.getElementById("blockwrapper"+from);
   
    if(wrapperobj==null) {
        clearSearch(pokemonsfull[from-1].name);
        var wrapperobj = document.getElementById("blockwrapper"+from);

    }
    
    
    
    var currentClass = wrapperobj.className;
    var selectedtxtlbl = document.getElementById("selectedtxtlbl");

    var donotadd = 0;
    
    var pokeballholder = document.getElementById("pokeballwrapperID");
    
    if(source==0){
    for(var i=0;i<currentlySelected.length;i++){
        if(currentlySelected[i]==from){
            donotadd = 1;
            if(removeIt==true){
                currentlySelected.splice(i,1);
                wrapperobj.className=('blockwrapper');
                if(textbox.value==pokemonsfull[from-1].name){clearSearch("");}
            } else {
                clearSearch(pokemonsfull[from-1].name);
            }
        } else if (currentlySelected.length==6){
            donotadd = 1;
            

        }
    }
    } else {
        for(var i=0;i<currentlySelected.length;i++){
            if(currentlySelected[i]==from){
                donotadd = 1;
                currentlySelected.splice(i,1);
                wrapperobj.className=('blockwrapper');
                if(textbox.value==pokemonsfull[from-1].name){clearSearch("");}
            } else if (currentlySelected.length==6){
                donotadd = 1;
                
                
            }
        }
    }
    
    if(donotadd==0){
        currentlySelected.push(from);
        wrapperobj.className=('blockwrappersel');
        if(textbox.value==pokemonsfull[from-1].name){clearSearch("");}
    }
    if(currentlySelected.length==6){
        pokeballholder.className = 'pokeballwrappersel';
        selectedtxtlbl.className= 'selectedtxtlblclass';
    } else {
        pokeballholder.className = 'pokeballwrapper';
        selectedtxtlbl.className= 'selectedtxtlblclassfull';
    }
    
    setmenu(pokemons);
    
}


function setPlayers(){
    players = JSON.parse(incomingList);
    //alert(players[0].name);
    getpoke(setPlayerPokemon,'getplayerpokemons');
}

function setPlayerPokemon(){
    incomingList = incomingList.replace("[","");
    incomingList = incomingList.replace("]","");
    playerpokelist = incomingList.split(",");
   // alert(playerpokelist[0]);
    for(var i = 0; i<playerpokelist.length; i++){
        test(playerpokelist[i]);
    }
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

function getpoke(callback,qType) {
    $.ajax({
           type: 'POST',
           url: 'selectiondb.php',
           data: {qtype: qType, pid: playerid, pokemons: strSelectedList, searchstr: searchFor},
           success: function(response){
           incomingList = response;
           //pokemons =  res.split(" ");
          // alert("RECIEVED "+response);
           callback (response);
           },
           error: function(msg){
           alert("Error: "+msg);
           }
           });
    
}

</script>

</html>