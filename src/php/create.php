<?php
    $required = array('firstname','lastname','password','passwordagain','email','username');
    $error=false;
	$db = new PDO("mysql:host=localhost;dbname = adventurer", "host", "");
	if(!$db){throw new Exception('failed to connect to the database');}
    $hashedpass = md5($_POST['password']);
    $username = $_POST['username'];
    $first = $_POST['firstname'];
    $last = $_POST['lastname'];
    $email = $_POST['email'];
	function usercheck() {
		global $username;
		global $db;
		$query = "select username from accounts where username = :u;";
		$stmt = $db->prepare($query);
		$stmt->execute(array("u" => $username));
		$r = $stmt->fetch();
		return $r[0];
	}

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
                if(usercheck() == $username)
                {
                    echo('Username already exists.');
                    echo("<meta http-equiv='refresh' content='2;../html/createaccount.html'");
                }
                else
                {
			try {
                    		$q = "insert into accounts(`firstname`,`lastname`,`username`,`password`,`email`,`access`) values(?, ?, ?, ?, ?, 1)";
				$s = $db->prepare($q);
				$s->execute(array($first, $last, $username, $hashedpass, $email));
				$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
                    		echo('You have submitted successfully. Heading to login.');
                    		echo("<meta http-equiv='refresh' content='3;../../index.html'");
			} catch (Exception $e) {
				die("error in query");
			}
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
