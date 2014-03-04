<?php
	session_start();
	$cnctdb = mysql_connect('localhost','host','');
	$slctdb = mysql_select_db('adventurer');
	$user = $_SESSION['user'];
	$char = $_SESSION['character'];

	if(isset($_POST['newval']) && isset($_POST['newtype']))
	{
		$powers=['atwillpowers','encounterpowers','dailypowers','utilitypowers'];
		$tables=['racefeatures','classfeatures','feats','langs','inventory'];
		$newval=$_POST['newval'];
	
		foreach($powers as $value)
		{
			if($_POST['newtype']==$value)
			{
				if($value=='atwillpowers'){$value='at will';}
				if($value=='encounterpowers'){$value='encounter';}
				if($value=='dailypowers'){$value='daily';}
				if($value=='utilitypowers'){$value='utility';}
				mysql_query("insert into powers(charname,username,power,type) values('$char','$user','$newval','$value');");
			}
		}

		foreach($tables as $values)
		{
			if($_POST['newtype']==$values)
			{
				if($values=='racefeatures'){$values='rfeatures';$c='rfeature';}
				if($values=='classfeatures'){$values='cfeatures';$c='cfeature';}
				if($values=='feats'){$values='feats';$c='feat';}
				if($values=='langs'){$values='languages';$c='language';}
				if($values=='inventory'){$values='inventory';$c='item';}
				$query="insert into $values(charname,username,$c) values('$char','$user','$newval');";
				mysql_query($query);
			}
		}
	}
?>
