<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Pokemon Beat Them Up</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
         <?php
            //stick our php logic in here. 
             $con = mysqli_connect("localhost", "root", "bloop", "pokemon_beat_em_up") or die ("Trouble connecting to the database" .  mysqli_errno($con));
             $query2 = "CREATE TABLE users (id INT PRIMARY KEY, playerID INT, username TEXT NOT NULL, password TEXT NOT NULL, usertype TEXT)";
             $result2 = mysqli_query($con, $query2);

             if(!$result2)
             {
                 echo 'db error: could not create user table. Check to see if you have the table already created</br>';
             }
             else
             {
                 echo 'table creation successful.';
             }
             include('logIn.php'); //includes the login script
        ?>
        <h1>Pokemon Beat Them Up</h1>
        <h2>Log In</h2>
        <form class="signin" method="post">
            <label class="form-lbl"> Username: </label>
            <input type="text" name="username"/>
            <p>
            <label class="form-lbl">Password: </label>
            <input type="password" name="password"/>
            <p>
            <input name='submit' type="submit" value=" Login "/>
        </form>
        <span><?php echo $error; ?></span>
        <h2>Sign Up</h2>
        <form action="Register.php">
            <input type="submit" value="Register"/>
        </form>
    </body>
</html>
