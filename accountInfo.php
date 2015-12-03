<?php
    session_start();
    $con = mysqli_connect("localhost", "root", "bloop", "pokemon_beat_em_up") or die ("Trouble connecting to the database" .  mysqli_errno($con));
    $error = "";
    
    if(isset($_POST['update_pw']))
    {
        if(empty($_POST['oldPW']) || empty($_POST['n1PW']) || empty($_POST['n2PW']))
        {
            $error = "Passwords can not be blank. Please try again.";
        }
        else if(strcmp($_POST['n1PW'], $_POST['n2PW']) !== 0)
        {
            $error = "The new passwords do not match.";
        }
        else
        {
            $oldPW = $_POST['oldPW'];
            $n1PW = $_POST['n1PW'];
            $n2PW = $_POST['n2PW'];
            
            $user = $_SESSION['username'];
            
            $strSQL ="SELECT * FROM users WHERE username='$user' AND password='$oldPW'";
            $query = mysqli_query($con, $strSQL);
            if(!$query)
            {
                $error = "The password is wrong, try again.";
            }
            else
            {
                $results = mysqli_num_rows($query);
                if($results == 1)
                {
                   $updateSQL = "UPDATE users SET password='$n1PW' WHERE username='$user' AND password='$oldPW'";
                   $query = mysqli_query($con, $updateSQL);
                   $error = "Password Changed Successfully.";
                }
                else
                {
                    $error = "There was an unknown issue. Sorry.";
                }
            }
        }
    }
    else if(isset($_POST['enter_admin']))
    {
        if(empty($_POST['adUser']) || empty($_POST['adPW']))
        {
            $error = "The fields can not be blank. Please try again.";
        }
        else
        {
            $username = $_POST['adUser'];
            $password = $_POST['adPW'];
            
            $strSQL = "SELECT * FROM users WHERE password='$password' AND username='$username' AND usertype='admin'";
            $query = mysqli_query($con, $strSQL);
            $results = mysqli_num_rows($query);
            if($results == 1 || !$query) //that means there is one row that matched the username and pw.
            {   
                $_SESSION['logAdmin'] = $username;
                //add session stuff here. Log in was successful
                header("location:adminPanel.php"); //move to the dashboard
            }
            else
            {
                $error="Admin Username and Password did not match. Try again";
            }   
        }
    }
    
?>
