<?php
    include('adminPanelData.php');
?>
<html>
    
    <title>Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="templatestyle.css">

    <meta charset="UTF-8"><script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <body style="min-width:1600px";>

    <header>
    Admin Panel
    </header>
        
    <div id="adminStuff">
        <h3>Registered Users</h3>
        <?php getUsers()?>
        <form method="post">
            <input type="submit" id="delete_users" value="Update" name="delete_users">
        </form>
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
        $(document).ready(function(){
            
            $("#delete_users").click(function(){
                deleteSelectedUsers();
            });
        });
        
        function deleteSelectedUsers()
        {
            var selectedUser = null;
            var users = document.getElementsByClassName("dUser");
            for(var i = 0; users[i]; i++)
            {
                if(users[i].checked)
                {
                    selectedUser = users[i].value;
                    deleteUser(selectedUser);
                }
            }
        }
        
        function deleteUser(user)
        {
            $.ajax({
               type: 'POST',
               url:'deleteUsers.php',
               data:{dUser: user},
               success: function(response)
               {
                   alert("Job's Done " + response);
               },
               error: function(msg)
               {
                   alert("Error: "+msg);
               }
            });
        }
        
    </script>
    <!--<script>  
        var sqlDATA = ''; 
        
        $(document).ready(function()
        {
            getFromSQL('getusers'); 
        });

        function getFromSQL(qType) 
        {
            $.ajax({
                   type: 'POST',
                   url: 'adminPanelData.php',
                   data: {qtype: qType}, //more information can be passed to the URL PHP, for now I am only passing qtype
                   success: function(response)
                   {
                        sqlDATA = response;
                        $.each(response, function(i, info)
                        {
                            trHTML += '<tr><td>' + info.id + '</td><td>' + item.username + '</td></tr>';
                        });
                        $('#usertable').append(trHTML);
                   },
                   error: function(msg){
                   alert("Error: "+msg);
                   }
                   });
    
        }
    </script>-->

</html>
