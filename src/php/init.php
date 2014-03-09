<?php
	include 'database.php';
	session_start();
	$user=$_SESSION['user'];
	$char = (isset($_SESSION['character']) ? $_SESSION['character'] : null);
	$dbQ = new dbQ;
	$dbD = new dbD;
	
	$userquery = (isset($_POST['userquery']) ? $dbQ->userQ() : false); 
   	$charquery = (isset($_POST['charquery']) ? $dbQ->charQ() : false); 
	$charchange = (isset($_POST['cc']) ? $_SESSION['character']=$_POST['cc'] : false);

	//delete character
	if(isset($_POST['delchar']))
	{
		$trash=$_POST['delchar'];
		$dbD->charD($trash,$user);
	}

	//get character list
	if(isset($_POST['charlistquery']))
	{
		mysql_connect('localhost','host','');
		mysql_select_db('adventurer');
		$query=mysql_query("select charname from characters where username='$user';");
		while($r=mysql_fetch_assoc($query))
		{
			$f[]=$r['charname'];
		}
		$ff=json_encode($f);
		echo $ff;
	}

	//regex values before shown to view with htmlspecialchars
	function htmlspecarr(&$vari)
	{
		foreach($vari as $val)
		{
			if(!is_array($val)){$val = htmlspecialchars($val);}
			else {htmlspecarr($val);}
		}
	}

	//getting character stats from SQL
	if(isset($_POST['basicstats']))
	{
		mysql_connect('localhost','host','');
		mysql_select_db('adventurer');
		$query=mysql_query("select * from characters where username='$user' and charname='$char';");
		while($r=mysql_fetch_assoc($query))
		{
			htmlspecarr($r);
			
			$a=$r;
		}
		echo json_encode($a);
	}

	if(isset($_POST['powers']))
	{
		mysql_connect('localhost','host','');
		mysql_select_db('adventurer');
		$query=mysql_query("select * from powers where username='$user' and charname='$char';");
		while($r=mysql_fetch_assoc($query))
		{
			$r['power']=htmlspecialchars($r['power']);
			$a[]=$r;
		}
		echo json_encode($a);
	}
	
	if(isset($_POST['cfeatures']))
	{
		mysql_connect('localhost','host','');
		mysql_select_db('adventurer');
		$query=mysql_query("select * from cfeatures where username='$user' and charname='$char';");
		while($r=mysql_fetch_assoc($query))
		{
			$r['cfeature']=htmlspecialchars($r['cfeature']);
			$a[]=$r;
		}
		echo json_encode($a);
	}
	if(isset($_POST['rfeatures']))
	{
		mysql_connect('localhost','host','');
		mysql_select_db('adventurer');
		$query=mysql_query("select * from rfeatures where username='$user' and charname='$char';");
		while($r=mysql_fetch_assoc($query))
		{
			$r['rfeature']=htmlspecialchars($r['rfeature']);
			$a[]=$r;
		}
		echo json_encode($a);
	}
	if(isset($_POST['feats']))
	{
		mysql_connect('localhost','host','');
		mysql_select_db('adventurer');
		$query=mysql_query("select * from feats where username='$user' and charname='$char';");
		while($r=mysql_fetch_assoc($query))
		{
			$r['feat']=htmlspecialchars($r['feat']);
			$a[]=$r;
		}
		echo json_encode($a);
	}
	if(isset($_POST['languages']))
	{
		mysql_connect('localhost','host','');
		mysql_select_db('adventurer');
		$query=mysql_query("select * from languages where username='$user' and charname='$char';");
		while($r=mysql_fetch_assoc($query))
		{
			$r['language']=htmlspecialchars($r['language']);
			$a[]=$r;
		}
		echo json_encode($a);
	}
	if(isset($_POST['inventory']))
	{
		mysql_connect('localhost','host','');
		mysql_select_db('adventurer');
		$query=mysql_query("select * from inventory where username='$user' and charname='$char';");
		while($r=mysql_fetch_assoc($query))
		{
			$r['item']=htmlspecialchars($r['item']);
			$a[]=$r;
		}
		echo json_encode($a);
	}

	//wealth query
	if(isset($_POST['wealth']))
	{
		mysql_connect('localhost','host','');
		mysql_select_db('adventurer');
		$query=mysql_query("select * from wealth where username='$user' and charname='$char';");
		while($r=mysql_fetch_assoc($query))
		{
			//$r=htmlspecialchars($r);
			$c=htmlspecialchars($r['copper']);
			$s=htmlspecialchars($r['silver']);
			$g=htmlspecialchars($r['gold']);
			$p=htmlspecialchars($r['platinum']);

			$f['copper']=$c;
			$f['silver']=$s;
			$f['gold']=$g;
			$f['platinum']=$p;
		}
		echo json_encode($f);
	}
?>
