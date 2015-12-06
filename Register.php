<?php     session_start();
    session_regenerate_id(true);?>
<!doctype html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css">
        <meta charset="UTF-8"><script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    </head>
    <body>
        <h1>Registration Page</h1>
        <div class='register'>

            <form class="form-signup2"  method="post" action="registration.php" autocomplete="off">
                <div class ="form-field">
                    <input type="text" class="form-input" id="usernametxt1" placeholder="Username" name="username" autocomplete="off" required/ >
                </div>
                <div class ="form-field">
                    <input type="text" class="form-input"  id="playernametxt1" placeholder="Playername" name="playername" autocomplete="off" required/>
                </div>
                <div class="form-field">
                    <input type="password" class="form-input"  id="passwordtxt1" placeholder="Password" name="password" autocomplete="off" required/>
                </div>

                <div class="form-field">
                    <button name = 'button' type="submit" value="Register" onclick="register(done);" style="width:30%; font-size:20px;"> submit </button>
                </div>
            </form>
            <div id="err"></div>
            <p class="text-center">Back to <a href="index.php">Login</a> <span class="fontawesome-arrow-right"></span></p>

        </div>
    </body>

<script>
$(document).ready(function(){
                  var errorcode = "<?php echo $_GET['err']?>";
                  if(errorcode ==1 ) {
                    document.getElementById('err').innerHTML = "Username or Playername taken.";
                  }
                  });

var incomingList = 0;

function  done(){
        if(incomingList==1){
            window.location.href = "selection.php";
            alert("Account made");
            return false;
        } else {
            alert("Could not create account. Usename may be taken.");
           // window.location.href = "Register.php";
            //alert("acc creating fail");
            return false;
        }
}








</script>
</html>

