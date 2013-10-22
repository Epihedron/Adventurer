<?php
    session_start();
    $db = new SQLite3('../../database/main.db');
    $updatebody = $_POST['updatebody'];
    $updatetitle = $_POST['updatetitle'];
    $date = date('d.m.y H:i');
    $user = $_SESSION['user'];
    
    if($notebody && $notetitle && $user == null)
    {
        echo '<html><body>Submission was unsuccessful.</body></html>';    
    }
    else
    {
        echo '<html><body>Submission was a success!</body></html>';
        $db->query("insert into updates(title,user,note,date) values('$updatetitle','$user','$updatebody','$date');");
    }
?>
<html>
    <head>
        <link href='../css/redirect.css' type='text/css' rel='StyleSheet'/>
        <meta http-equiv='refresh' content='3;admin.php'/>
    </head>
</html>