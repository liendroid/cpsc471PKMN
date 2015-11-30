<?php

    //add session start stuff here
    $error=""; //error message
    if(isset($_POST['registation-submit']))
    {
        if(empty($_POST['newUsername'] || empty($_POST['newPassword'])))
        {
            $error="Username and Password can not be empty";
        }
        else
        {
            $con = mysqli_connect("localhost", "root", "bloop", "pokemon_beat_em_up") or die ("Trouble connecting to the database" .  mysqli_errno($con));
            $newUsername = $_POST['newUsername'];
            $newPassword = $_POST['newPassword'];
            
            $checkUserSQL = "SELECT * FROM users WHERE username='$newUsername'";
            $isUserNameValid = mysqli_query($con, $checkUserSQL);
            $userResults = mysqli_num_rows($isUserNameValid);
            if(!$isUserNameValid || $userResults >= 1)
            {
                $error = "Username is taken. Please choose another one.";
            }
            else
            {
                $validID = false;
                $userID = rand();

                while($validID == FALSE)
                {
                    $checkIDSQL = "SELECT * FROM users WHERE id='$userID'";
                    $queryID = mysqli_query($con, $checkIDSQL);
                    $results = mysqli_num_rows($queryID);
                    if($results == 1 || !$queryID)
                    {
                        //user with that id is found find another id
                        $userID = rand();
                    }   
                    else
                    {
                        $validID = true;
                    }
                }

                $strSQL = "INSERT into users(id, username, password, usertype) VALUES('$userID', '$newUsername', '$newPassword', 'user')";
                $query = mysqli_query($con, $strSQL);
                if(!$query) //if there was an issue with inserting the data in the table
                {
                    $error= "Username and password can not be empty. Try again.";
                }
                else
                {
                    //add session stuff here. registration was successful
                    header("location:dashboard.php"); //move to the dashboard
                }   
            }   
        }
    }
?>

