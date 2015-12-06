<?php
    //Credentials
    $server = "localhost";
    $user = "root";
    $password ="admin";
    $db = "Pokemon";
    $pokestr = 'getpokemon';
    $playersstr = 'getplayers';
    $getplayerpokestr = 'getplayerpokemons';
    $setpokemons = 'savepokemons';
    $searchforstr = 'searchpokemon';
    $pokemonbyID = 'getpokemonbyid';
    $getrecordstr = 'getplayerrecord';
    $getbotsstr = 'getbots';
    $setbattlestr = 'setbattle';
    $getbattleinfostr = 'getbattleinfo';
    $getbotbyidstr = 'getbotbyid';
    $getplayerbyidstr = 'getplayerbyid';
    $getmovesstr = 'getmoves';
    $gettypesstr = 'gettypes';
    $playerwonstr = 'playerwon';
    $playerloststr = 'playerlost';
    //Connect
    $link = mysql_connect($server, $user, $password);
    //Select database
    mysql_select_db($db, $link);
    
    //Assemble query
    $pokemonsSTR = mysql_real_escape_string($_POST['pokemons'], $link);
    $qType = mysql_real_escape_string($_POST['qtype'], $link);
    $playerID = mysql_real_escape_string($_POST['pid'], $link);
    $searchtxt = mysql_real_escape_string($_POST['searchstr'], $link);
    $pokedextoget = mysql_real_escape_string($_POST['pokedexid'], $link);
    
    $selectedbot = mysql_real_escape_string($_POST['botid'], $link);
    $botpokemon = mysql_real_escape_string($_POST['botpokemon'], $link);
    $userpokemon = mysql_real_escape_string($_POST['userpokemon'], $link);
    
    $playerPokeList="";
    
    
    if($qType==$pokestr){
        $query = "SELECT * FROM pokemon as P;";
    } else if ($qType==$getmovesstr){
        $query = "SELECT * FROM move as M WHERE M.id in (Select MU.moveid from moveuses as MU where MU.pokedex = '".$userpokemon."');";
    } else if ($qType==$playerwonstr){
        $query = "Update botrecord as BR SET BR.loses = BR.loses + 1 WHERE  BR.botid = '".$selectedbot."'";
        $result1 = mysql_query($query, $link);
        $query = "Update record as R SET R.wins = R.wins + 1 WHERE  R.id in (Select P.userid FROM player as P WHERE P.pid = ".$playerID.");";
    } else if ($qType==$playerloststr){
        $query = "Update botrecord as BR SET BR.wins = BR.wins + 1 WHERE  BR.botid = '".$selectedbot."'";
        $result1 = mysql_query($query, $link);
        $query = "Update record as R SET R.loses = R.loses + 1 WHERE  R.id in (Select P.userid FROM player as P WHERE P.pid = ".$playerID.");";
    } else if ($qType==$playersstr){
        $query = "SELECT * FROM player as P;";
    } else if ($qType==$gettypesstr){
        $query = "SELECT * FROM type as T;";
    } else if ($qType==$getbattleinfostr){
        $query = "SELECT * FROM battle as B Where pid=".$playerID.";";
    } else if ($qType==$getplayerbyidstr){
        $query = "SELECT * FROM player as P Where P.pid=".$playerID.";";
    } else if ($qType==$getbotbyidstr){
        $query = "SELECT * FROM bot as B Where B.botid=".$selectedbot.";";
    } else if ($qType==$getbotsstr){
        $query = "SELECT * FROM bot as B;";
    } else if ($qType==$getplayerpokestr){
        $query = "SELECT H.pokedex FROM HAS as H WHERE H.pid=".$playerID.";";
    } else if ($qType==$searchforstr){
        $query = "SELECT * FROM pokemon as P WHERE  P.name LIKE '".$searchtxt."%';";
        //echo $query;
    } else if ($qType==$pokemonbyID){
        $query = "SELECT * FROM pokemon as P WHERE  P.pokedex=".$pokedextoget.";";
        //echo $query;
    } else if ($qType==$getrecordstr){
        $query = "SELECT * FROM record as R WHERE  R.id=(SELECT P.userid FROM player as P WHERE P.pid=".$playerID.");";
        //echo $query;
    } else if($qType==$setpokemons){
        $pokemonsSTR = rtrim($pokemonsSTR, ",");
        $pokemonList = explode(",", $pokemonsSTR);
        $query = "DELETE FROM HAS WHERE pid=".$playerID.";";
        $result1 = mysql_query($query, $link);
        $query='';
        $query = $query."INSERT INTO HAS (pid,pokedex) VALUES ";
        foreach($pokemonList as $pokemonList){
            $query = $query."('".$playerID."','".$pokemonList."'),";
        }
        $query =rtrim($query, ",");
        $query = $query.";";
        echo $query;
    } else if($qType==$setbattlestr){
        $query = "DELETE FROM battle WHERE pid=".$playerID.";";
        $result1 = mysql_query($query, $link);
        $query='';
        $query = "INSERT INTO battle (botid,pid,botpokemon,userpokemon) VALUES ('".$selectedbot."','".$playerID."','".$botpokemon."','".$userpokemon."')";
    }
    
  
    
    //Query database
   // echo ($query);
    $result = mysql_query($query, $link);
       //Output result, send back to ajax as var 'response'
   // echo '[{"firstname":"Jesper","surname":"Aaberg","phone":["555-0100","555-0120"]},{"firstname":"Jesper","surname":"Aaberg","phone":["555-0100","555-0120"]}]';
    $overall = "[";
    if(mysql_num_rows($result) > 0){
        

        while($row = mysql_fetch_array($result)){
            if(($qType==$pokestr)||($qType==$searchforstr)||($qType==$pokemonbyID)){
                $overall = $overall."{\"name\":\"".$row['name']."\",\"pokedex\":\"".$row['pokedex']."\",\"hp\":\"".$row['hp']."\",\"atk\":\"".$row['atk']."\",\"def\":\"".$row['def']."\",\"spd\":\"".$row['speed']."\"},";
            } else if($qType==$playersstr || $qType==$getplayerbyidstr){
                $overall = $overall."{\"pid\":\"".$row['pid']."\",\"name\":\"".$row['name']."\"},";
            } else if($qType==$getmovesstr){
                $overall = $overall."{\"damage\":\"".$row['damage']."\",\"movename\":\"".$row['name']."\"},";
            } else if($qType==$getrecordstr){
                $overall = $overall."{\"wins\":\"".$row['wins']."\",\"loses\":\"".$row['loses']."\"},";
            } else if($qType==$getbotsstr || $qType==$getbotbyidstr){
                $overall = $overall."{\"name\":\"".$row['name']."\",\"difficulty\":\"".$row['difficulty']."\"},";
            } else if($qType==$gettypesstr){
                $overall = $overall."{\"pokedex\":\"".$row['pokedex']."\",\"resistance\":\"".$row['resistance']."\",\"weakness\":\"".$row['weakness']."\",\"strength\":\"".$row['strength']."\",\"name\":\"".$row['name']."\"},";
            } else if($qType==$getbattleinfostr){
                $overall = $overall."{\"botid\":\"".$row['botid']."\",\"pid\":\"".$row['pid']."\",\"botpokemon\":\"".$row['botpokemon']."\",\"userpokemon\":\"".$row['userpokemon']."\"},";
            } else if($qType==$getplayerpokestr){
                $overall = $overall.$row['pokedex'].",";
            }

        }
        $overall = rtrim($overall, ",");
        $overall = $overall."]";
        echo $overall;
    }else{
        echo "<tr><td>No results matching family \"$family\"</td></tr>";
    }
    
    
    //mysql_free_result($result)
    //mysql_close($link);
?>