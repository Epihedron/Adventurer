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

//class for model query
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

	//insert new character value query
	function ncharvalQ($nv,$nt) {
		global $db;
		global $user;
		global $char;

		$powers = ['atwillpowers','encounterpowers','dailypowers','utilitypowers'];
		$tables = ['racefeatures','classfeatures','feats','langs','inventory'];
	
		foreach($powers as $value)
		{
			if($nt == $value)
			{
				if($value == 'atwillpowers'){$value='at will';}
				if($value == 'encounterpowers'){$value='encounter';}
				if($value == 'dailypowers'){$value='daily';}
				if($value == 'utilitypowers'){$value='utility';}
				$stmt = $db->prepare("insert into powers(charname,username,power,type) values('$char','$user',:nv,'$value')");
				$stmt->execute(array('nv' => $nv));
			}
		}

		foreach($tables as $values)
		{
			if($nt == $values)
			{
				if($values=='racefeatures'){$values='rfeatures';$c='rfeature';}
				if($values=='classfeatures'){$values='cfeatures';$c='cfeature';}
				if($values=='feats'){$values='feats';$c='feat';}
				if($values=='langs'){$values='languages';$c='language';}
				if($values=='inventory'){$values='inventory';$c='item';}
				$stmt = $db->prepare("insert into $values(charname,username,$c) values('$char','$user',:nv)");
				$stmt->execute(array('nv' => $nv));
			}
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
	//delete value from charactersheet
	function attrD($t,$v) {
		global $user;
		global $char;
		global $db;

		if($t == 'atwillpowers' || $t == 'encounterpowers' || $t == 'dailypowers' || $t == 'utilitypowers')
		{
			$stmt = $db->prepare("delete from powers where username='$user' and charname='$char' and power='$v'");
			$stmt->execute();
		}
		else
		{
			if($t=='classfeatures'){$c='cfeature';$t='cfeatures';}
			if($t=='inventory'){$c='item';}
			if($t=='racefeatures'){$c='rfeature';$t='rfeatures';}
			if($t=='langs'){$c='language';$t='languages';}
			if($t=='feats'){$c='feat';}

			$stmt = $db->prepare("delete from $t where username='$user' and charname='$char' and $c='$v'");
			$stmt->execute();
		}
	}


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

class dbU {

	//change character name
	function nameU($nn) {
		global $user;
		global $char;
		global $db;

		$tables = array('characters','cfeatures','rfeatures','feats','inventory','languages','powers','wealth');
		foreach($tables as $t) {
			$stmt = $db->prepare("update $t set charname = :nn where username = '$user' and charname = '$char'");
			$stmt->execute(array('nn' => $nn));
		}
		$_SESSION['character'] = htmlspecialchars($nn);
		echo "Character name changed to ".$_SESSION['character'];
	} 

	//change attribute
	function attrU($t,$c,$o,$n) {
		global $user;
		global $char;
		global $db;

		$stmt = $db->prepare("update $t set $c = :n where username = '$user' and charname = '$char' and $c = '$o'");
		$stmt->execute(array('n' => $n));
	}

	//change power
	function powerU($t,$c,$o,$n,$tp) {
		global $user;
		global $char;
		global $db;

		$stmt = $db->prepare("update $t set $c = :n where username = '$user' and charname = '$char' and $c = '$o'and type = '$tp'");
		$Stmt->execute(array('n' => $n));
	}

	//change skill
	function skillU($sc,$s) {
		global $user;
		global $char;
		global $db;

		$stmt = $db->prepare("update characters set $sc='$s' where username='$user' and charname='$char'");
		$stmt->execute();
	}
}
?>
