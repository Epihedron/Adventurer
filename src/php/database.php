<?php

//connecting to MySQL with PDO
$db = new PDO("mysql:host=localhost;dbname=adventurer",'host','');

//class for basic single model query
class dbQ {
	//login query
	function loginQ($user,$password) {
		global $db;

		$q = "select * from accounts where username = :user";
		$stmt = $db->prepare($q);
		$stmt->execute(array('user' => $user));
		$r = $stmt->fetch(); 
		if($user == $r['username'] && $password == $r['password']) {
			$_SESSION['user'] = $user;
			header("LOCATION:../html/main.html");
		} else {
			echo("incorrect login info");
			echo("<meta http-equiv='refresh' content='2;../../index.html'/>");
		}
	}
	
	//user query
	function userQ() {

		echo $_SESSION['user'];
	}

	//character query
	function charQ() {
		
		echo $_SESSION['character'];
	}
}

//class for deleting a value from the model
class dbD {

	//delete a character
	function charD($char,$user) {

		global $db;

		$stmt = $db->prepare("delete from characters where username='$user' and charname=:char");
		$stmt->execute(array('char' => $char));
		$stmt = $db->prepare("delete from cfeatures where username='$user' and charname=:char");
		$stmt->execute(array('char' => $char));
		$stmt = $db->prepare("delete from feats where username='$user' and charname=:char");
		$stmt->execute(array('char' => $char));
		$stmt = $db->prepare("delete from inventory where username='$user' and charname=:char");
		$stmt->execute(array('char' => $char));
		$stmt = $db->prepare("delete from languages where username='$user' and charname=:char");
		$stmt->execute(array('char' => $char));
		$stmt = $db->prepare("delete from powers where username='$user' and charname=:char");
		$stmt->execute(array('char' => $char));
		$stmt = $db->prepare("delete from rfeatures where username='$user' and charname=:char");
		$stmt->execute(array('char' => $char));
		$stmt = $db->prepare("delete from wealth where username='$user' and charname=:char");
		$stmt->execute(array('char' => $char));

		echo $char.' wiped.';
	}
}


?>
