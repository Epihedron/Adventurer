<?php
	session_start();

	$user=$_SESSION['user'];
	$char=$_SESSION['char'];

	$table=$_POST['table'];
	$column=$_POST['column'];
	$og=$_POST['og'];
	$nv=$_POST['nv'];

	//function for changing attributes
	function changeatt($t,$c,$o,$n)
	{
		global $user;
		global $char;

		mysql_connect('localhost','host','');
		mysql_select_db('adventurer');
		mysql_query("update $t set $c=$n where username='$user' and charname='$char' and $c=$o;") or die('did not send query properly');
	}
	changeatt($table,$column,$og,$nv);
?>
