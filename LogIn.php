<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');
    //add session start stuff here
    $link = mysqli_connect("localhost", "root", "admin");
    mysqli_select_db($link,"pokemon");
    $Username = $_POST['username'];
    $Password = $_POST['password'];
    
    $strSQL = "SELECT * FROM users WHERE username='$Username' AND password='$Password'";
    $query = mysqli_query($link,$strSQL);
    $results = mysqli_num_rows($query);
    //echo('results '.$results);
   // echo('user '.$Username.' pass '.$Password);
            if($results == 1) {//add session stuff here. Log in was successful
                $strSQL = "SELECT * FROM users WHERE username='$Username'";
                $query = mysqli_query($link,$strSQL);
                $row = mysqli_fetch_array($query);
                $userID = $row['id'];
                //echo("USER id" + $userID);
                
                $strSQL = "SELECT * FROM player WHERE userid='$userID'";
                $query = mysqli_query($link,$strSQL);
                $row = mysqli_fetch_array($query);
                session_start();
                $_SESSION['userID'] = $row['pid'];
                header("Location: home.php");
                echo(1);
                die();
            }
    header("Location: index.php?err=1");
    die();
?>