<?php
    $name = $_POST['userName'];
    $password = $_POST['password'];

    //if the user hits submit
    if(!empty($_POST['userName']) && !empty($_POST['password']))
    {
        //add stuff into database regarding account info here. 
        echo '<p>Account made!';
    }
    else
    {
        echo 'Please fill in all the fields';
    }
?>