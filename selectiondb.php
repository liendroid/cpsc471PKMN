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
    //Connect
    $link = mysql_connect($server, $user, $password);
    //Select database
    mysql_select_db($db, $link);
    
    //Assemble query
    $pokemonsSTR = mysql_real_escape_string($_POST['pokemons'], $link);
    $qType = mysql_real_escape_string($_POST['qtype'], $link);
    $playerID = mysql_real_escape_string($_POST['pid'], $link);
    $searchtxt = mysql_real_escape_string($_POST['searchstr'], $link);
    $playerPokeList="";
    
    
    if($qType==$pokestr){
        $query = "SELECT * FROM pokemon as P;";
    } else if ($qType==$playersstr){
        $query = "SELECT * FROM player as P;";
    } else if ($qType==$getplayerpokestr){
        $query = "SELECT H.pokedex FROM HAS as H WHERE H.pid=".$playerID.";";
    } else if ($qType==$searchforstr){
        $query = "SELECT * FROM pokemon as P WHERE  P.name LIKE '".$searchtxt."%';";
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
    }
    
  
    
    //Query database
    $result = mysql_query($query, $link);
       //Output result, send back to ajax as var 'response'
   // echo '[{"firstname":"Jesper","surname":"Aaberg","phone":["555-0100","555-0120"]},{"firstname":"Jesper","surname":"Aaberg","phone":["555-0100","555-0120"]}]';
    $overall = "[";
    if(mysql_num_rows($result) > 0){
        

        while($row = mysql_fetch_array($result)){
            if(($qType==$pokestr)||($qType==$searchforstr)){
                $overall = $overall."{\"name\":\"".$row['name']."\",\"pokedex\":\"".$row['pokedex']."\",\"hp\":\"".$row['hp']."\",\"atk\":\"".$row['atk']."\",\"def\":\"".$row['def']."\",\"spd\":\"".$row['speed']."\"},";
            } else if($qType==$playersstr){
                $overall = $overall."{\"pid\":\"".$row['pid']."\",\"name\":\"".$row['name']."\"},";
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
