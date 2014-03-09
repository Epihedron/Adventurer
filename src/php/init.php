<?php
	include 'database.php';
	//calling in the database controller
	$dbQ = new dbQ;
	$dbD = new dbD;
	$tools = new tools;
	//session calls
	session_start();
	$user=$_SESSION['user'];
	$char = (isset($_SESSION['character']) ? $_SESSION['character'] : null);
	//handles for database controller
	$userquery = (isset($_POST['userquery']) ? $dbQ->userQ() : false); 
   	$charquery = (isset($_POST['charquery']) ? $dbQ->charQ() : false); 
	$charchange = (isset($_POST['cc']) ? $_SESSION['character']=$_POST['cc'] : false);
	$charlistquery = (isset($_POST['charlistquery']) ? $dbQ->charlistQ() : false);
	$charstatsquery = (isset($_POST['basicstats']) ? $dbQ->singleQ('*','characters') : false);
	$powersquery = (isset($_POST['powers']) ? $dbQ->multiQ('*','powers') : false);
	$cfeaturesquery = (isset($_POST['cfeatures']) ? $dbQ->multiQ('*','cfeatures') : false);
	$rfeaturesquery = (isset($_POST['rfeatures']) ? $dbQ->multiQ('*','rfeatures') : false);
	$featsquery = (isset($_POST['feats']) ? $dbQ->multiQ('*','feats') : false);
	$languagesquery = (isset($_POST['languages']) ? $dbQ->multiQ('*','languages') : false);
	$inventoryquery = (isset($_POST['inventory']) ? $dbQ->multiQ('*','inventory') : false);
	$wealthquery = (isset($_POST['wealth']) ? $dbQ->multiQ('*','wealth') : false);
	//delete character
	$deletechar = (isset($_POST['delchar']) ? $dbD->charD($_POST['delchar'],$user) : false);
?>
