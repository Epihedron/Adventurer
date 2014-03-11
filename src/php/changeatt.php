<?php
	require('database.php');

	$dbU = new dbU;
	$dbD = new dbD;

	session_start();
	$user=$_SESSION['user'];
	$char=$_SESSION['character'];

	$table=$_POST['table'];
	$column=$_POST['column'];
	$og=$_POST['og'];
	$nv=$_POST['nv'];

	$changename = (isset($_POST['changename']) ? $dbU->nameU($_POST['changename']) : false);

	//function for changing attributes
	if(isset($_POST['table']) && isset($_POST['column']) && isset($_POST['og']) && isset($_POST['nv']))
	{
		$dbU->attrU($table,$column,$og,$nv);
	}

	//function for changing powers
	if(isset($_POST['table']) && isset($_POST['column']) && isset($_POST['og']) && isset($_POST['nv']) && isset($_POST['type']))
	{
		$dbU->powerU($table,$column,$og,$nv,$_POST['type']);
	}

	//function for deleting values
	if(isset($_POST['title']) && isset($_POST['text']))
	{
		$dbD->attrD($_POST['title'],$_POST['text']);
	}

	//change skill value
	if(isset($_POST['skillcol']))
	{
		$dbU->skillU($_POST['skillcol'],$_POST['newskill']);
	}
?>
