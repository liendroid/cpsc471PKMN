<?php

function CheckLogin()
{
    session_start();
    $sessionvar = $_SESSION['userID'];
    
    if(empty($_SESSION['userID']))
    {
        return false;
    }
    return true;
}
?>