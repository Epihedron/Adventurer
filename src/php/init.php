<?php
    session_start();
    $user=$_SESSION['user'];
    $charchange=$_POST['cc'];
    
    //character change
    if(isset($charchange))
    {
    $jsoninit=file_get_contents("../json/chars/$user/$user"."init.json");
    $jsoninitdc=json_decode($jsoninit,true);
    $jsoninitdc['char']=$charchange;
    $finjsoninit=json_encode($jsoninitdc);
    file_put_contents("../json/chars/$user/$user"."init.json",$finjsoninit);
    }
    if(isset($_POST['userquery']))
    {
        echo($user);
    }
?>