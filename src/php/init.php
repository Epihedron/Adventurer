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
        $notfound=false;
        $trash=$_POST['delchar'];
        $charlist=file_get_contents("../json/chars/$user/$user"."list.json");
        $charlistdc=json_decode($charlist,true);
        foreach($charlistdc as $key => $value)
        {
            if($trash == $value["Basic Info"]["character"])
            {
                $notfound=false;
                unset($charlistdc[$key]);
                break;
            }
            else
            {
                $notfound=true;
            }
        }
        if($notfound==true)
        {
            echo("Character not found");
        }
        else
        {
            echo("Character deleted \n");
        }
        $finallist=json_encode($charlistdc);
        file_put_contents("../json/chars/$user/$user"."list.json",$finallist);
    }
?>