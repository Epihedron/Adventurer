<?php
session_start();
if(!isset($_SESSION['user']))
{
    header('LOCATION: ../php/login.php');    
}
?>
<html>
    <head>
        <link href='../css/main.css' type='text/css' rel='StyleSheet'/>
        <h1 style='font-weight:normal;'>
            Greetings <span id='user'><?php echo($_SESSION['user']);?></span>
        </h1>
        <h2>
            <button onclick='toforum()' class='menubutton'>Forum</button>
            <button class='menubutton'onclick='newchar()'>New Character</button>
            <button class='menubutton'onclick='chars()'>Characters</button><br/>
            <button class='menubutton'onclick='toaccount()'>Account</button>
            <?php
                if($_SESSION['access'] >= 3)
                {
            ?>
                    <button class='menubutton' onclick='toadmin()'>Admin</button>
            <?php
                }
            ?>
            <button onclick='logout()'class='menubutton'>Log Out</button>
        </h2>
    </head>
    <body>
        <!--<?php
        //      echo '<table>';
        //      echo '<tr>';
        //      echo '<td class="notehead">';
        //      echo $row['title'];
        //      echo '</td></tr>';
        //      echo '<tr>';
        //      echo '<td class="notebody">';
        //      echo $row['note'];
        //      echo '</td></tr>';
        //      echo '<tr>';
        //      echo '<td class="notefoot">';
        //      echo $row['user'].':'.$row['date'];
        //      echo '</td></tr>';
        //      echo '</table>';
        //      echo '<br/>';
        //   ?>
        -->
        <script src='../js/JQuery.js'></script>
        <script src='../js/main.js'></script>
    </body>
</html>