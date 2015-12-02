<?php
    
    //Credentials
    $server = "localhost";
    $user = "root";
    $password ="admin";
    $db = "Pokemon";
    //Connect
    $link = mysql_connect($server, $user, $password);
    //Select database
    mysql_select_db($db, $link);
    
    //Assemble query

    $qType = mysql_real_escape_string($_POST['qtype'], $link); //GRABBING THE qtype from the ajax function in template.php
    $query = '';
    

    if($qType=='getusers'){
        $query = "SELECT * from users;";
    }
    
    //Query database
    $result = mysql_query($query, $link);
    //start building the response
    $overall = "[";
    if(mysql_num_rows($result) > 0){

        while($row = mysql_fetch_array($result)){
            if($qType=='getusers'){
                    $overall = $overall."{\"userid\":\"".$row['userid']."\",\"name\":\"".$row['name']."\"},"; //put it in JSON format so it can be parsed properly $row['name'] is that you use to put in values from the sql tuple
            }
        }
        $overall = rtrim($overall, ",");
        $overall = $overall."]";
        //echo is used to return information to ajax
        echo $overall;
    }else{
        echo "<tr><td>No results matching family \"$family\"</td></tr>";
    }
    
?>
