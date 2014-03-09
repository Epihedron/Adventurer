<?php

//connecting to MySQL with PDO
$db = new PDO("mysql:host=localhost;dbname=adventurer",'host','');

//tool box
Class tools {
	function cleanHTMLarr(&$vari) {
		foreach($var as $val) {
			if(!is_array($val)){$val = htmlspecialchars($val);}
			else {cleanHTMLarr($val);}
		}
	}
}

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
	
	//character list query
	function charlistQ() {
		global $db;
		global $user;

		$q = "select charname from characters where username='$user'";
		$stmt = $db->prepare($q);
		$stmt->execute();
		$r = $stmt->fetchAll(PDO::FETCH_OBJ);
		$f = json_encode($r);
		echo $f;
	}

	//basic column/table query. values can be placed in controller and pulled from here. NO USER INPUT PLEASE JUST CODE!
	function singleQ($column,$table) {
		global $db;
		global $user;
		global $char;
		$tools = new tools;

		$q = "select $column from $table where username='$user'and charname='$char'";
		$stmt = $db->prepare($q);
		$stmt->execute();
		$r = $stmt->fetch(PDO::FETCH_ASSOC);
		$f = json_encode($r);
		echo $f;
	}

	//basic column/table query. values can be placed in controller and pulled from here. NO USER INPUT PLEASE JUST CODE!
	function multiQ($column,$table) {
		global $db;
		global $user;
		global $char;
		$tools = new tools;

		$q = "select $column from $table where username='$user'and charname='$char'";
		$stmt = $db->prepare($q);
		$stmt->execute();
		$r = $stmt->fetchAll(PDO::FETCH_OBJ); 
		$f = json_encode($r);
		echo $f;
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
