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
        $charlist=file_get_contents("../json/chars/$user/$user"."list.json");
        $charlistdc=json_decode($charlist);
        foreach($charlistdc as $key => $value)
        {
            $chars=json_encode($value);
            echo($chars."\n");
            var_dump($value);
            if(in_array($trash,$chars))
            {

                echo("ok");
                //unset($charlistdc[$key]);
            }
            else
            {
                echo("Could not find that character");
            }
        }
        //$finallist=json_encode($charlistdc);
        //var_dump($charlistdc);
        //file_put_contents("../json/chars/$user/$user"."list.json",$finallist);
    }
?>