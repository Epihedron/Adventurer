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
    //user query
    if(isset($_POST['userquery']))
    {
        echo($user);
    }
    //delete character
    if(isset($_POST['delchar']))
    {
        $trash=$_POST['delchar'];
        // $charlist=file_get_contents("../json/chars/$user/$user"."list.json");
        // $charlistdc=json_decode($charlist);
        // foreach($charlistdc as $key => $value)
        // {
        //     echo($key.'+'.$value);
        //     if(in_array($trash,$value))
        //     {
        //         // unset($charlistdc[$key]);
        //     }
        // }
        var_dump($charlistdc);
        $finallist=json_encode($charlistdc);

        // file_put_contents("../json/chars/$user/$user"."list.json",$finallist);
    }
?>