<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <?php
            include('registration.php'); //include the registration script
        ?>
        <h1>Registration Page</h1>
        <form method="post">
            <label>Username:</label>
            <input type="text" name="newUsername">
            <p>
            <label>Password:</label>
            <input type="password" name="newPassword">
            <p>
            <input name='registation-submit' value='Register' type="submit">
        </form>
        <span><?php echo $error; ?></span>
    </body>
</html>

