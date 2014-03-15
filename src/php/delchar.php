<?php
require('database.php');
session_start();

$user = $_SESSION['user'];
$dbD = new dbD;
if(isset($_POST)){
	foreach($_POST as $v) {
		$dbD->charD($v,$user);
	}
}

?>
