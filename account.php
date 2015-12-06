<?PHP
    require_once("membersite_config.php");
    
    if(checklogin()==false)
    {
        header("Location: index.php");
        die();
        exit;
    }
?>
<?php
    include('accountInfo.php');
?>
<html>
    
    <title>Account Info</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="accountstyle.css">

    <meta charset="UTF-8"><script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <body style="min-width:1600px";>

    <header>
    Account Info
    </header>

    <div id="AccountInfo" >
        <div><span><?php echo $error; ?></span></div>
        <input type="button" id="show_changePW" onClick="showpopup()" value="Change Password"/>
<div id ="change_PW">
<form method="post" id="PW_Form">
<h1>Change Password</h1>
<input type="password" id="oldPW" placeholder="Old Password" name="oldPW" required/>
<input type="password" id="n1PW" placeholder="New Password" name="n1PW" required/>
<input type="password" id="n2PW" placeholder="New Password" name="n2PW" required/>
<div id="grid">
<input type="submit" id="update" value="Update" name="update_pw">
<input type="button" id="cancel" value="Cancel" onClick="hidepopup()" name="close_changePW">
</div>
</form>
</div>
        <input type="button" id="adminAccess" value="Admin Access" onClick="showAdminPopup()">

        <div id ="adminAccessForm">
            <form method="post" id="adminForm">
                <h1>Verify Admin</h1>
                <input type="text" id="adUser" placeholder="username" name="adUser" required/>
                <input type="password" id="adPass" placeholder="password" name="adPW" required/>
                <div id="grid">
                <input type="submit" id="enter" value="Enter" name="enter_admin">
                <input type="button" id="cancelAd" onclick("showAdminPopup();")value="Cancel" name="close_admin">
                </div>
            </form>
        </div>
    </div>



    <div class="menuWrapper">

    <div class="topHalf">
    <a href="#" class="back-to-top">Back to Top</a>

    <div class="pokeballwrapper" id="pokeballwrapperID" onclick="window.location.href = 'home.php'";>
    <div class="pokeballimg" ></div>
    <div id="selectedtxtlbl" class="btnlabelclass">Home</div>
    </div>


    <div class="bottomHalf" ></div>

    </div>


    <div id="form-messages"></div>


    </body>
    
    <script>   
        var onePopupShown = false;
        
        $(document).ready(function(){

                hidepopup();
                hideAdminPopup()
            

        });
        
        function showpopup()
        {
            if(onePopupShown == false)
            {
                $("#change_PW").fadeIn();
                $("#change_PW").css({"visibility":"visible","display":"block"});
                onePopupShown = true;
            }
        }

        function hidepopup()
        {
           $("#change_PW").fadeOut();
           $("#change_PW").css({"visibility":"hidden","display":"none"});
           onePopupShown = false;
        }
        
        function showAdminPopup()
        {
            if(onePopupShown == false)
            {
                $("#adminAccessForm").fadeIn();
                $("#adminAccessForm").css({"visibility":"visible","display":"block"});  
                onePopupShown = true;
            }
        }

        function hideAdminPopup()
        {
           $("#adminAccessForm").fadeOut();
           $("#adminAccessForm").css({"visibility":"hidden","display":"none"});
           onePopupShown = false;
        }
    </script>

</html>