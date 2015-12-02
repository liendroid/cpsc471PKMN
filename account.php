<?php
    include('accountInfo.php');
?>
<html>
    
    <title>Account Info</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="templatestyle.css">

    <meta charset="UTF-8"><script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <body style="min-width:1600px";>

    <header>
    Account Info
    </header>

    <div id="AccountInfo" >
        <div><span><?php echo $error; ?></span></div>
        <input type="button" id="show_changePW" value="Change Password"/>
        <input type="button" id="adminAccess" value="Admin Access"/>
        <div id ="change_PW">
            <form method="post" id="PW_Form">
                <h1>Change Password</h1>
                <input type="password" id="oldPW" placeholder="Old Password" name="oldPW" required/>
                <input type="password" id="n1PW" placeholder="New Password" name="n1PW" required/>
                <input type="password" id="n2PW" placeholder="New Password" name="n2PW" required/>
                <div id="grid">
                <input type="submit" id="update" value="Update" name="update_pw">
                <input type="button" id="cancel" value="Cancel" name="close_changePW">
                </div>
            </form>
        </div>
        <div id ="adminAccessForm">
            <form method="post" id="adminForm">
                <h1>Verify Admin</h1>
                <input type="text" id="adUser" placeholder="username" name="adUser" required/>
                <input type="password" id="adPass" placeholder="password" name="adPW" required/>
                <div id="grid">
                <input type="submit" id="enter" value="Enter" name="enter_admin">
                <input type="button" id="cancelAd" value="Cancel" name="close_admin">
                </div>
            </form>
        </div>
    </div>



    <div class="menuWrapper">

    <div class="topHalf">
    <a href="#" class="back-to-top">Back to Top</a>

    <div class="pokeballwrapper" id="pokeballwrapperID" onclick="window.location.href = 'selection.php'";>
    <div class="pokeballimg" ></div>
    <div id="selectedtxtlbl" class="btnlabelclass">Pokeball</div>
    </div>

    <div class="stadiumwrapper" id="stadiumwrapper" onclick="stadiumClick();">
    <div class="stadiumimg" onclick="";></div>
    <div class="btnlabelclass">Stadium</div>
    </div>

    <div class="accountwrapper" id="accountwrapper" onclick="window.location.href = 'account.php'";>
    <div class="accountimg" ></div>
    <div class="btnlabelclass">Account</div>
    </div>

    <div class="logoutwrapper" id="logoutwrapper" onclick="window.location.href = 'logout.php'">
    <div class="logoutimg"></div>
    <div class="btnlabelclass">Logout</div>
    </div>



    <div class="bottomHalf" ></div>

    </div>


    <div id="form-messages"></div>


    </body>
    
    <script>   
        var onePopupShown = false;
        
        $(document).ready(function(){
            
            $("#show_changePW").click(function(){
                showpopup();
            });
            
            $("#cancel").click(function(){
                hidepopup();
            });
            
            $("#adminAccess").click(function(){
                showAdminPopup();
            });
            
            $("#cancelAd").click(function(){
                hideAdminPopup();
            });
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