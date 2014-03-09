<?php

include 'database.php';
session_start();
$dbQ = new dbQ;
$user=$_POST['username'];
$password=md5($_POST['password']);
$dbQ->loginQ($user,$password);

?>
<head>
    <head>
        <link href='../css/redirect.css' type='text/css' rel='StyleSheet'/>
    </head>
</head>
