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
                //echo 'db error: could not create user table. Check to see if you have the table already created</br>';
             }
             else
             {
                 echo 'table creation successful.';
             }
             include('logIn.php'); //includes the login script
        ?>
        <h1>Pokemon Beat Them Up</h1>
        <br>
        <div id="signin">
            <h2>Log In</h2>
            <form class="form-login" method="post">
                <div class ="form-field">
                    <input type="text" class="form-input" placeholder="Username" name="username" required/>
                </div>
                <div class="form-field">
                    <input type="password" class="form-input" placeholder="Password" name="password" required/>
                </div>
                <div class="form-field">
                    <input name='submit' type="submit" value="Login"/>
                </div>
            </form>
            <span><?php echo $error; ?></span>
        </div>
        
        <p class="text-center">Not a member? <a href="Register.php">Sign up now</a> <span class="fontawesome-arrow-right"></span></p>
    </body>
</html>
