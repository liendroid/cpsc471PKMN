<?php
    //add session start stuff here
    $error=""; //error message
    if(isset($_POST['submit']))
    {
        if(empty($_POST['username'] || empty($_POST['password'])))
        {
            $error="Username or Password is invalid";
        }
        else
        {
            $username = $_POST['username'];
            $password = $_POST['password'];
            
            $strSQL = "SELECT * FROM users WHERE password='$password' AND username='$username'";
            $query = mysqli_query($con, $strSQL);
            $results = mysqli_num_rows($query);
            if($results == 1 || !$query) //that means there is one row that matched the username and pw.
            {
                //add session stuff here. Log in was successful
                header("location:dashboard.php"); //move to the dashboard
            }
            else
            {
                $error="Username and Password did not match. Try again";
            }   
        }
    }
?>