<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');
    
    $con = mysqli_connect("localhost","root","admin","pokemon");
    
    if(isset($_POST['username']) && isset($_POST['playername']) && isset($_POST['password'])){
        $username = $_POST['username'];
        $playername = $_POST['playername'];
        $password = $_POST['password'];
    } else {
        echo(5);
        die();
    }

    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        die();
    } else {
        $SQL = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($con,$SQL);
        $userrowcount = mysqli_num_rows($result);

        $SQL2 = "SELECT * FROM player WHERE name='$playername'";
        $result2 = mysqli_query($con,$SQL2);
        $playerrowcount = mysqli_num_rows($result2);

        $userID = rand();
        if($playerrowcount==0 && $userrowcount==0){
            $strSQL1 = "INSERT into users(id, username, password, usertype) VALUES('$userID', '$username', '$password', 'user')";
            $result1 = mysqli_query($con,$strSQL1);

            $strSQL2 = "INSERT into player(name, userid) VALUES('$playername', '$userID')";
            $result2 = mysqli_query($con,$strSQL2);

            $strSQL3 = "INSERT into record(wins, loses, id) VALUES('0','0', '$userID')";
            $result3 = mysqli_query($con,$strSQL3);

            $strSQL3 = "SELECT * from player WHERE userid='$userID'";
            $result = mysqli_query($con,$strSQL3);
            $row    =   mysqli_fetch_array($result,MYSQLI_ASSOC);
            session_start();
            $_SESSION['userID'] = $row['pid'];
            ob_start();
            header("Location: selection.php");
            echo(1);
            die();
        }
        
    }
    mysqli_close($con);
    header("Location: Register.php?err=1");
    die();
?>