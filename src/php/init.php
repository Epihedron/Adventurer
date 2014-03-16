<?php
require('database.php');

//database controller classes
$dbQ = new dbQ;
$dbD = new dbD;

//php client session variables and start
session_start();
$user = $_SESSION['user'];
$char = (isset($_SESSION['character']) ? $_SESSION['character'] : null);

/** 
	ajax handles for the database controller
	each one is listed by their names
**/

//basic queries
$userquery = (isset($_POST['userquery']) ? $dbQ->userQ() : false); 
$charquery = (isset($_POST['charquery']) ? $dbQ->charQ() : false); 
$charlistquery = (isset($_POST['charlistquery']) ? $dbQ->charlistQ() : false);
$charstatsquery = (isset($_POST['basicstats']) ? $dbQ->singleQ('*','characters') : false);
$powersquery = (isset($_POST['powers']) ? $dbQ->multiQ('*','powers') : false);
$cfeaturesquery = (isset($_POST['cfeatures']) ? $dbQ->multiQ('*','cfeatures') : false);
$rfeaturesquery = (isset($_POST['rfeatures']) ? $dbQ->multiQ('*','rfeatures') : false);
$featsquery = (isset($_POST['feats']) ? $dbQ->multiQ('*','feats') : false);
$languagesquery = (isset($_POST['languages']) ? $dbQ->multiQ('*','languages') : false);
$inventoryquery = (isset($_POST['inventory']) ? $dbQ->multiQ('*','inventory') : false);
$wealthquery = (isset($_POST['wealth']) ? $dbQ->singleQ('*','wealth') : false);

//update queries
$charchange = (isset($_POST['cc']) ? $_SESSION['character']=$_POST['cc'] : false);

//delete queries
$deletechar = (isset($_POST['delchar']) ? $dbD->charD($_POST['delchar'],$user) : false);

//new value queries
$newcharvalue = (isset($_POST['newval']) && isset($_POST['newtype']) ? $dbQ->ncharvalQ($_POST['newval'],$_POST['newtype']) : false);
?>
