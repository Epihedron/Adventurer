<?php
	session_start();

	$user=$_SESSION['user'];
	$char=$_SESSION['character'];

	$table=$_POST['table'];
	$column=$_POST['column'];
	$og=$_POST['og'];
	$nv=$_POST['nv'];

	//function to change characters name
	function changenm($nn)
	{
		global $user;
		global $char;

		mysql_connect('localhost','host','');
		mysql_select_db('adventurer');
		mysql_query("update characters set charname='$nn' where username='$user' and charname='$char';");
		mysql_query("update cfeatures set charname='$nn' where username='$user' and charname='$char';");
		mysql_query("update rfeatures set charname='$nn' where username='$user' and charname='$char';");
		mysql_query("update feats set charname='$nn' where username='$user' and charname='$char';");
		mysql_query("update inventory set charname='$nn' where username='$user' and charname='$char';");
		mysql_query("update languages set charname='$nn' where username='$user' and charname='$char';");
		mysql_query("update powers set charname='$nn' where username='$user' and charname='$char';");

		$_SESSION['character']=$nn;
		echo "Character name changed to ".$_SESSION['character'];
	}
	if(isset($_POST['changename'])){changenm($_POST['changename']);}

	//function for changing attributes
	function changeatt($t,$c,$o,$n)
	{
		global $user;
		global $char;

		mysql_connect('localhost','host','');
		mysql_select_db('adventurer');
		$query="update $t set $c='$n' where username='$user' and charname='$char' and $c='$o';";
		mysql_query($query) or die('Could not update attribute');
	}
	if(isset($_POST['table']) && isset($_POST['column']) && isset($_POST['og']) && isset($_POST['nv']))
	{
		changeatt($table,$column,$og,$nv);
	}

	//function for changing powers
	function changepow($t,$c,$o,$n,$tp)
	{
		global $user;
		global $char;

		mysql_connect('localhost','host','');
		mysql_select_db('adventurer');
		$query="update $t set $c='$n' where username='$user' and charname='$char' and $c='$o' and type='$tp';";
		mysql_query($query) or die('Could not update attribute');
		echo $query;
	}
	if(isset($_POST['table']) && isset($_POST['column']) && isset($_POST['og']) && isset($_POST['nv']) && isset($_POST['type']))
	{
		changepow($table,$column,$og,$nv,$_POST['type']);
	}

	//function for deleting values
	function delcharval($t,$v)
	{
		mysql_connect('localhost','host','');
		mysql_select_db('adventurer');

		if($t == 'atwillpowers' || $t == 'encounterpowers' || $t == 'dailypowers' || $t == 'utilitypowers')
		{
			echo $t.' norm';
			$query="delete $v from powers where username='$user' and charname='$char' and power='$v';";
		}
		else
		{
			$query="";
			echo $t;
		}
		mysql_query($query);
	}
	if(isset($_POST['title']) && isset($_POST['text']))
	{
		delcharval($_POST['title'],$_POST['text']);
	}
?>
