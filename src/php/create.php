<?php
    $required = array('firstname','lastname','password','passwordagain','email','username');
    $error=false;
    mysql_connect('localhost','host','');
    mysql_select_db(adventurer);
    $date = date('m/d/y@H:i');
    $hashedpass = md5($_POST['password']);
    $username = $_POST['username'];
    $first = $_POST['firstname'];
    $last = $_POST['lastname'];
    $email = $_POST['email'];
    $userscheck=mysql_query("select username from accounts where username='$username';");
    $ucrow=mysql_fetch_array($userscheck);

    foreach($required as $field)
    {
        if(empty($_POST[$field]))
        {
            $error=true;
        }
    }
    if($error)
    {
        echo('You must fill out all fields.');
        echo("<meta http-equiv='refresh' content='2;../html/createaccount.html'");
    }
    else
    {
        if($_POST['password'] !== $_POST['passwordagain'])
        {
            echo("Your passwords don't match.");
            echo("<meta http-equiv='refresh' content='2;../html/createaccount.html'");
        }
        else
        {
            if(strpos($username,' ') !== false)
            {
                echo'Your username must not contain spaces.';
                echo("<meta http-equiv='refresh' content='2;../html/createaccount.html'");
            }
            else
            {
                if($ucrow[0]==$username)
                {
                    echo('Username already exists.');
                    echo("<meta http-equiv='refresh' content='2;../html/createaccount.html'");
                }
                else
                {
                    echo($otherusers);
                    mysql_query("insert into accounts(firstname,lastname,username,password,email,date,access) values('$first','$last','$username','$hashedpass','$email','$date',1);");
                    $newusr["name"]=$first;
                    $newusr["access"]=1;
                    echo('You have submitted successfully. Heading to login.');
                    echo("<meta http-equiv='refresh' content='3;../../index.html'");
                }
            }
        }
    }
?>
<html>
    <head>
        <link href='../css/redirect.css' rel='StyleSheet' type='text/css'/>
    </head>
</html>
