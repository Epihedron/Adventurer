<?php
    session_start();
    mysql_connect('localhost','host','');
    mysql_select_db('adventurer');
    $user=$_POST['username'];
    $password=md5($_POST['password']);
    $userquery=mysql_query("select * from accounts where username='$user';");
    $urow=mysql_fetch_array($userquery);
    if($user&&$password!=='')
    {
        if($user == $urow[2] && $password == $urow[3])
        {
            $_SESSION['user'] = $user;
            header("LOCATION:../html/main.html");
        }
        else
        {
            echo("your username or password is incorrect");
            echo("<meta http-equiv='refresh' content='2;../../index.html'>");
        }
    }
    else
    {
        echo('You must enter a username and password.');
        echo("<meta http-equiv='refresh' content='2;../../index.html'>");
    }
?>
<head>
    <head>
        <link href='../css/redirect.css' type='text/css' rel='StyleSheet'/>
    </head>
</head>
