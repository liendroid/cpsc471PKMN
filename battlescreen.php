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

<link rel="stylesheet" href="battlescreenstyle.css">

<meta charset="UTF-8"><script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<link rel="stylesheet" href="/css/font-awesome.min.css">

</head>

<body style="min-width:1600px";>


<header>
Battle Screen
</header>

<div id="pokedex" class="pokedex" ><div id="playerside">
<div id="playerimg"></div>
</div>
<div id="botside">
<div id="botimg"></div>
</div>
</div>
</div>

<div id="messages"></div>


<div class="menuWrapper">

<div class="topHalf">
<a href="#" class="back-to-top">Back to Top</a>

<div class="pokeballwrapper" id="pokeballwrapperID" onclick='if(confirm("Are you sure you want to leave the battle?")) window.location.href = "home.php";';>
<div class="pokeballimg" ></div>
<div id="selectedtxtlbl" class="btnlabelclass">Quit</div>
</div>

<div id="move1" class ="movediv" onclick="movepressed(1)">
</div>
<div  id="move2" class ="movediv" onclick="movepressed(2)">
</div>
<div  id="move3" class ="movediv" onclick="movepressed(3)">
</div>
<div c id="move4" class ="movediv"  onclick="movepressed(4)">
</div>

<div id="continuebtn" class="continuebtn" onclick ="saveRecord()";>Continue</div>







</body>

<script>
var sqlDATA = ''; //Global variable to store what is retrieved from sql
var botid;
var userPokemon;
var botPokemon;
var playerid;
var pokemontoget;
var userpokemoninfo;
var botpokemoninfo;
var playerinfo;
var botinfo;
var moveinfo;
var whosmove = 0;
var playerhealth;
var bothealth;
var damagedone;
var gamestatus = 1;
var playerwins = 0;
var playerlastmove;
//This is the function which will run as soon as the page is loaded up.
$(document).ready(function(){
                  playerid = "<?php session_start(); echo ( $_SESSION['userID']); ?>" ;
                  getFromSql(setBattleinfo, 'getbattleinfo');
                  //userPokemon = "<?php echo $_GET['currentselection']?>";
                 // userPokemon = "<?php echo $_GET['currentselection']?>";
                 // botPokemon = "<?php echo $_GET['botselection']?>";
                  //alert("user:" + userPokemon);
                 // buildimage();
                  });

//this is the function getFromSql() will return to
function done(id){
    tempData = JSON.parse(sqlDATA); //This command is used to parse the incoming data in sqlDATA.
    //alert(tempData[0].name);
}

function buildimage(){
    var pokedexobj = document.getElementById('pokedex');
    
    var botimgname;
    if(botPokemon<10){
        
        botimgname = '00'+botPokemon;
    } else if (botPokemon<100){
        botimgname = '0'+botPokemon;
    } else {
        botimgname = botPokemon;
    }
    
    var playerimgname;
    if(userPokemon<10){
        
        playerimgname = '00'+userPokemon;
    } else if (userPokemon<100){
        playerimgname = '0'+userPokemon;
    } else {
        playerimgname = userPokemon;
    }
    
    
    
    
    html = '<div class="imageholder1" style=" content:url(img/'+playerimgname+'.png);"></div><div class="versus">VS</div><div class="imageholder2" style=" content:url(img/'+botimgname+'.png);"></div><div class="continuebtn">Continue</div>';
    $('#pokedex').append(html);
}


function setBattleinfo(){
    var battleinfo = JSON.parse(sqlDATA);
    botid = battleinfo[0].botid;
    userPokemon = battleinfo[0].userpokemon;
    botpokemon = battleinfo[0].botpokemon;
    pokemontoget = userPokemon;
    getFromSql(setPlayerPokemon,'getpokemonbyid');
    
}
function setPlayerPokemon(){
    userpokemoninfo = JSON.parse(sqlDATA);
    pokemontoget = botpokemon;
    getFromSql(setBotPokemon,'getpokemonbyid');
}

function setBotPokemon(){
    botpokemoninfo = JSON.parse(sqlDATA);
    getFromSql(setBotInfo,'getbotbyid');
}

function setBotInfo(){
    botinfo = JSON.parse(sqlDATA);
    getFromSql(setPlayerInfo,'getplayerbyid');
}

function setPlayerInfo(){
    playerinfo = JSON.parse(sqlDATA);
    
    getFromSql(setStandardMoves,'getmoves');
}

function setStandardMoves(){
    moveinfo = JSON.parse(sqlDATA);
    //alert(moveinfo[0].movename);
    setupscreen();
}
function setupscreen(){
    var playerside = document.getElementById('playerside');
    var playerpokeimg = document.getElementById('playerimg');
    var botpokeimg = document.getElementById('botimg');
    var playerimgname;
    
    playerhealth = userpokemoninfo[0].hp;
    bothealth = botpokemoninfo[0].hp;
    
    if(userPokemon<10){
        
        playerimgname = '00'+userPokemon;
    } else if (userPokemon<100){
        playerimgname = '0'+userPokemon;
    } else {
        playerimgname = userPokemon;
    }
    var botimgname;
    if(botpokemon<10){
        botimgname = '00'+botpokemon;
    } else if (botpokemon<100){
        botimgname = '0'+botpokemon;
    } else {
        botimgname = botpokemon;
    }
    var stars = ''
    for(i=0;i<botinfo[0].difficulty;i++){
        stars += '<i class="fa fa-star"></i>';
    }
    
    playerpokeimg.style.backgroundImage="url('img/"+playerimgname+".png')";
    botpokeimg.style.backgroundImage="url('img/"+botimgname+".png')";
    
    html = '<div class= "pokename">'+userpokemoninfo[0].name+'</div><div class="healthbar" id="playerhealthbar">'+ userpokemoninfo[0].hp + 'HP <i class="fa fa-heart"></i></div><div id="statslbl">Stats:</div><div class="atkbar">'+ userpokemoninfo[0].atk + 'ATK <i class="fa fa-gavel"></i></div><div class="defbar">'+ userpokemoninfo[0].def + 'DEF <i class="fa fa-shield"></i></div><div class="spdbar">'+ userpokemoninfo[0].spd + 'SPD <i class="fa fa-bolt"></i></div><br></br><div class="playername">Player:'+playerinfo[0].name+'</div>';
    
    $('#playerside').append(html);
    html = '<div class= "pokename">'+botpokemoninfo[0].name+'</div><div class="healthbar" id="bothealthbar">'+ botpokemoninfo[0].hp + 'HP <i class="fa fa-heart"></i></div><div id="statslbl">Stats:</div><div class="atkbar">'+ botpokemoninfo[0].atk + 'ATK <i class="fa fa-gavel"></i></div><div class="defbar">'+ botpokemoninfo[0].def + 'DEF <i class="fa fa-shield"></i></div><div class="spdbar">'+ botpokemoninfo[0].spd + 'SPD <i class="fa fa-bolt"></i></div><br></br><div class="playername">Player:'+botinfo[0].name+'</div><div class="botdiff">Difficulty:'+stars+'</div>';
    $('#botside').append(html);
    var move1 = document.getElementById('move1');
    var move2 = document.getElementById('move2');
    var move3 = document.getElementById('move3');
    var move4 = document.getElementById('move4');
    move1.innerHTML = moveinfo[0].movename;
    move2.innerHTML = moveinfo[1].movename;
    move3.innerHTML = moveinfo[2].movename;
    move4.innerHTML = moveinfo[3].movename;

}

function calculatePlayerDamage(moveid){
    var movedamage =  moveinfo[moveid].damage;
    var playerpokeatk =  userpokemoninfo[0].atk;
    var botpokedef = botpokemoninfo[0].def;
    
    return Math.ceil(((movedamage/100)*playerpokeatk)-(botpokedef*(movedamage/100)));
}

function calculateBotDamage(moveid){
    var movedamage =  moveinfo[moveid].damage;
    var botpokeatk =  botpokemoninfo[0].atk;
    var playerpokedef = userpokemoninfo[0].def;
    var botdiff = botinfo[0].difficulty;
    
    if(playerlastmove==0 || playerlastmove==1){
        var bothitchance = Math.floor(Math.random() * (botdiff - 1 + 1)) + 1;
    } else if(playerlastmove==2){
        var bothitchance = Math.floor(Math.random() * (botdiff - 0 + 1)) + 0;
    } else if(playerlastmove==3){
        var bothitchance = Math.floor(Math.random() * ((botdiff-1) - 0 + 1)) + 0;
    }
    
    return ((bothitchance*Math.ceil(((movedamage/100)*botpokeatk)-(playerpokedef*(movedamage/100))-bothitchance*2)));
}
function updateHealth(){
    var playerhpbar = document.getElementById('playerhealthbar');
    var bothpbar = document.getElementById('bothealthbar');
    playerhpbar.innerHTML =  playerhealth + 'HP <i class="fa fa-heart"></i>';
    bothealthbar.innerHTML =  bothealth + 'HP <i class="fa fa-heart"></i>';
    
}
function action(moveid){
    var continuebtn = document.getElementById('continuebtn');
    var botmove = Math.floor(Math.random() * (3 - 0 + 1)) + 0;
    playerlastmove = moveid-1;
    var playerdamage = calculatePlayerDamage(moveid-1);
    var botdamage   = calculateBotDamage(botmove);
    var msg;
    if(playerdamage<0){
        playerdamage = playerdamage*-1
    }
    if(botdamage<0){
        botdamage = botdamage*-1
    }
    playerhealth = playerhealth - botdamage;
    bothealth = bothealth - playerdamage
    
    msg = 'You have used: <b>' + moveinfo[moveid-1].movename + '</b> against <b>' + botpokemoninfo[0].name + '</b> and it did <b>' + playerdamage +' Damage </b> <div style="text-align:right; color:#b41818"><b>'+botinfo[0].name+'</b> has used <b>' + moveinfo[botmove].movename + ' </b>against you, doing <b>'+ botdamage +'  damage.</b></div>';

    
    if(playerhealth<=0){
        msg = '<div style="font-size:40px; text-align:center;">You lose</div><br>You have used: <b>' + moveinfo[moveid-1].movename + '</b> against <b>' + botpokemoninfo[0].name + '</b> and it did <b>' + playerdamage +' Damage </b> <div style="text-align:right; color:#b41818"><b>'+botinfo[0].name+'</b> has used <b>' + moveinfo[botmove].movename + ' </b>against you, doing <b>'+ botdamage +'  damage.</b></div>';
        gamestatus = 0;
        document.getElementById('continuebtn').style.display = 'inline-block';
    } else if (bothealth<=0){
        document.getElementById('continuebtn').style.display = 'inline-block';
        msg = '<div style="font-size:40px; text-align:center;">You WIN</div>br>You have used: <b>' + moveinfo[moveid-1].movename + '</b> against <b>' + botpokemoninfo[0].name + '</b> and it did <b>' + playerdamage +' Damage </b> <div style="text-align:right; color:#b41818"><b>'+botinfo[0].name+'</b> has used <b>' + moveinfo[botmove].movename + ' </b>against you, doing <b>'+ botdamage +'  damage.</b></div>';
        playerwins = 1;
        gamestatus = 0;
    }

    updateHealth();
    setmessage(msg);
}

function saveRecord(){
    if(playerwins==1){
        getFromSql(gameover, 'playerwon');
    }else {
        getFromSql(gameover, 'playerlost');
    }
}
function gameover(){
    window.location.href = 'home.php';
}
function setmessage(messagestr){
    var message = document.getElementById('messages');
    html = '<b><div style="font-size:30px;">Console:</div><br></b><div class = "latestmessge">'+messagestr+'</div><br></br> ';
    var oldmessages = message.innerHTML;
    oldmessages = oldmessages.replace('#b41818',"");

    oldmessages = oldmessages.replace('<b><div style="font-size:30px;">Console:</div><br></b>',"");
    oldmessages = oldmessages.replace("latestmessge","oldmessage");
    message.innerHTML = "";
    $('#messages').append(html);
    $('#messages').append(oldmessages);
}

function movepressed(moveid){
    if(gamestatus==1){
        action(moveid);
    } else {
        setmessage("The game is already over. Please press continue to advance.");

    }
    
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
           url: 'selectiondb.php',
           data: {qtype: qType, pid: playerid, pokedexid: pokemontoget, botid: botid, userpokemon: userPokemon}, //more information can be passed to the URL PHP, for now I am only passing qtype
           success: function(response){
           sqlDATA = response;
           //THIS IS A TEST ALERT TO HELP YOU.
           //alert("RECIEVED " + response);
           callback (response);
           },
           error: function(msg){
           alert("Error: "+msg);
           }
           });
    
}

</script>

</html>