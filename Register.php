<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <?php
            include('registration.php'); //include the registration script
        ?>
        <div class='register'>
            <h1>Registration Page</h1>
            <form class="form-signup" method="post">
                <div class ="form-field">
                    <input type="text" class="form-input" placeholder="Username" name="newUsername" required/>
                </div>
                <div class="form-field">
                    <input type="password" class="form-input" placeholder="Password" name="newPassword" required/>
                </div>
                <div class="form-field">
                    <input name='registation-submit' type="submit" value="Register"/>
                </div>
            </form>
            <span><?php echo $error; ?></span>
        </div>
    </body>
</html>

