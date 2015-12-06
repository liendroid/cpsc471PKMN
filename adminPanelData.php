<?php
    function getUsers()
    {
        $con = mysqli_connect("localhost", "root", "admin", "pokemon") or die ("Trouble connecting to the database" .  mysqli_errno($con));
        $adminQuery = "SELECT * from users";
        
        $query = mysqli_query($con, $adminQuery);
        if($query->num_rows > 0)
        {
           echo '<table id=userList"><tr>'
                .'<th>User Id</th>'
                .'<th>User Name</th>'
                .'<th>Delete</th>'
                .'</tr>';
           
           while($row = $query -> fetch_assoc())
           {
               echo '<tr>'
                    . '<td>'.$row['id'].'</td>'
                    .'<td>'.$row['username'].'</td>'
                    .'<td><input type="checkbox" class="dUser" name="check" value='.$row['id'].'></td>'
                    . '</tr>';
           }
           echo "</table>";
        }  
           /*
            * $results = mysqli_num_rows($query);
           if($results > 0)
           {
               $array = mysqli_fetch_array($results);
               echo json_encode($array);
           }
            */ 
        else
        {
            echo "<p>Opps. No users are detected.</p>";
        }
    }
?>
