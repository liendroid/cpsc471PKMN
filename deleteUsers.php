<?php
    session_start();
    $con = mysqli_connect("localhost", "root", "admin", "pokemon") or die ("Trouble connecting to the database" .  mysqli_errno($con));
    $selectedUser = $_POST['dUser'];
    
    $checkUserInfo = "SELECT username FROM users WHERE id='$selectedUser'";
    $results1 = mysqli_query($con, $checkUserInfo);
    $validTarget = true;
    
    //check to see if the admin is trying to delete itself.
    if(mysqli_num_rows($results1) == 1)
    {
        $row = mysqli_fetch_assoc($results1);
        if($_SESSION['logAdmin'] == $row['username'])
        {
            $validTarget = false;
            echo 'Whoops! You can not delete yourself';
        }
    }
    if($validTarget)
    {
        $sqlStr = "DELETE FROM users WHERE id='$selectedUser'";
        $delQuery = mysqli_query($con, $sqlStr);

        if($delQuery)
        {
            echo "User Deleted.";
            header("Refresh:0");
        }      
    }

?>

