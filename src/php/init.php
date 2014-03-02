<?php
	session_start();
	$user=$_SESSION['user'];
	$char=$_SESSION['character'];
    
    //character change
    if(isset($_POST['cc']))
    {
	$_SESSION['character']=$_POST['cc'];
	echo $_SESSION['character'];
    }

    //user query
    if(isset($_POST['userquery']))
    {
        echo($user);
    }

	//character query
	if(isset($_POST['charquery']))
	{
		echo $_SESSION['character'];
	}

    //delete character
    if(isset($_POST['delchar']))
    {
	//SQL char removal
	$trash=$_POST['delchar'];
	mysql_connect('localhost','host','');
	mysql_select_db('adventurer');
	mysql_query("delete from cfeatures using cfeatures where cfeatures.username='$user' and cfeatures.charname='$trash';");
	mysql_query("delete from characters using characters where characters.username='$user' and characters.charname='$trash';");
	mysql_query("delete from feats using feats where feats.username='$user' and feats.charname='$trash';");
	mysql_query("delete from inventory using inventory where inventory.username='$user' and inventory.charname='$trash';");
	mysql_query("delete from languages using languages where languages.username='$user' and languages.charname='$trash';");
	mysql_query("delete from powers using powers where powers.username='$user' and powers.charname='$trash';");
	mysql_query("delete from rfeatures using rfeatures where rfeatures.username='$user' and rfeatures.charname='$trash';");
	echo "Character $trash wiped!";
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
?>
