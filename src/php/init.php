<?php
	session_start();
	$user=$_SESSION['user'];
	$char=$_SESSION['character'];
    
    //character change
    if(isset($_POST['cc']))
    {
        //$jsoninit=file_get_contents("../json/chars/$user/$user"."init.json");
        //$jsoninitdc=json_decode($jsoninit,true);
        //$jsoninitdc['char']=$charchange;
        //$finjsoninit=json_encode($jsoninitdc);
        //file_put_contents("../json/chars/$user/$user"."init.json",$finjsoninit);
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
	//old json way of doing things
        //$notfound=false;
        //$trash=$_POST['delchar'];
        //$charlist=file_get_contents("../json/chars/$user/$user"."list.json");
        //$charlistdc=json_decode($charlist,true);
        //foreach($charlistdc as $key => $value)
        //{
        //    if($trash == $value["Basic Info"]["character"])
        //    {
        //        $notfound=false;
        //        unset($charlistdc[$key]);
        //        break;
        //    }
        //    else
        //    {
        //        $notfound=true;
        //    }
        //}
        //if($notfound==true)
        //{
        //    echo("Character not found");
        //}
        //else
        //{
        //    echo("Character deleted \n");
        //}
        //$finallist=json_encode($charlistdc);
        //file_put_contents("../json/chars/$user/$user"."list.json",$finallist);
	
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

    //make dm files
    if(isset($_POST['mkdm']))
    {
        $fp=fopen("../json/chars/$user/$user"."dm.json", w);
        fwrite($fp,"{}");
        fclose("../json/chars/$user/$user"."dm.json");
    }

	//get character list
	if(isset($_POST['charlistquery']))
	{
		mysql_connect('localhost','host','');
		mysql_select_db('adventurer');
		$query=mysql_query("select charname from characters where username='admin';");
		while($r=mysql_fetch_assoc($query))
		{
			$f[]=$r['charname'];
		}
		$ff=json_encode($f);
		echo $ff;
	}

	//getting character stats from SQL
	if(isset($_POST['basicstats']))
	{
		mysql_connect('localhost','host','');
		mysql_select_db('adventurer');
		$query=mysql_query("select * from characters where username='$user' and charname='$char';");
		while($r=mysql_fetch_assoc($query))
		{
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
			$a[]=$r;
		}
		echo json_encode($a);
	}
?>
