<?php     session_start();
    session_regenerate_id(true);?>
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
        <meta charset="UTF-8"><script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    </head>
    <body>
        <h1>Pokemon Beat Them Up</h1>
        <div class='signin'>
            <h2>Log In</h2>
            <form class="form-login" method="post" action="LogIn.php">
                <div class ="form-field">
                    <input type="text" class="form-input"  id="usernametxt" placeholder="Username" name="username"  autocomplete="off" required/>
                </div>
                <div class="form-field">
                    <input type="password" class="form-input" id="passwordtxt" placeholder="Password" name="password" autocomplete="off" required/>
                </div>
                <div class="form-field">
                    <button name = 'button' type="submit" value="Login" onclick="login(done);" style="width:10%; font-size:20px;"> submit </button>

                </div>
            </form>
            <div id='err'></div>
        </div>
        
        <p class="text-center">Not a member? <a href="Register.php">Sign up now</a> <span class="fontawesome-arrow-right"></span></p>
    </body>

<script>

$(document).ready(function(){
                  var errorcode = "<?php echo $_GET['err']?>";
                  if(errorcode ==1 ) {
                    document.getElementById('err').innerHTML = "Bad login. Please try again!";
                  }
                  });
var incomingList = "";

function  done(){
    if(incomingList==1){
        window.location.href = "home.php";
        alert("login good");
        return false;
    } else {
        window.location.href = "index.php";
        alert("login fail");
        return false;
    }
}


function login(callback) {
    var username = document.getElementById('usernametxt').value;
    var password = document.getElementById('passwordtxt').value;
    $.ajax({
           type: 'POST',
           url: 'LogIn.php',
           data: {username: username, password: password},
           success: function(response){
           incomingList = response;
           //pokemons =  res.split(" ");
           //alert("RECIEVED "+response);
           //callback();
           },
           error: function(msg){
           alert("Error: "+msg);
           }
           });
    
}





</script>
</html>
