<?php
    session_start();
    
    //post variables
    $user=$_SESSION['user'];
    //$world=$_POST['world'];

    $character=$_POST['character'];
    $age=$_POST['age'];
    $weight=$_POST['weight'];
    $height=mysql_real_escape_string($_POST['height']);
    $class=$_POST['class'];
    $race=$_POST['race'];
    $gender=$_POST['gender'];
    $deity=$_POST['diety'];

    $str=$_POST['str'];
    $con=$_POST['con'];
    $dex=$_POST['dex'];
    $int=$_POST['int'];
    $wis=$_POST['wis'];
    $cha=$_POST['cha'];

    $arm=$_POST['armor'];
    $armclass=$_POST['armclass'];
    $armmisc=$_POST['armmisc'];
    $fortclass=$_POST['fortclass'];
    $fortmisc=$_POST['fortmisc'];
    $refclass=$_POST['refclass'];
    $refmisc=$_POST['refmisc'];
    $willclass=$_POST['willclass'];
    $willmisc=$_POST['willmisc'];

    $atkclass=$_POST['atkclass'];
    $atkfeat=$_POST['atkfeat'];
    $atkmisc=$_POST['atkmisc'];
    $damfeat=$_POST['dmgfeat'];
    $dammisc=$_POST['dmgmisc'];

    $maxhp=$_POST['maxhp'];
    $speed=$_POST['speed'];
    $passperc=$_POST['passperc'];
    $passins=$_POST['passins'];

    $head=$_POST['ehead'];
    $neck=$_POST['eneck'];
    $armor=$_POST['earmor'];
    $arms=$_POST['earms'];
    $hands=$_POST['ehands'];
    $finger1=$_POST['efinger1'];
    $finger2=$_POST['efinger2'];
    $waist=$_POST['ewaist'];
    $legs=$_POST['elegs'];
    $feet=$_POST['efeet'];

    $acro=$_POST['hasacro'];
    $arc=$_POST['hasarc'];
    $ath=$_POST['hasath'];
    $bluff=$_POST['hasbluff'];
    $diplo=$_POST['hasdiplo'];
    $dung=$_POST['hasdung'];
    $end=$_POST['hasend'];
    $heal=$_POST['hasheal'];
    $ins=$_POST['hasins'];
    $intim=$_POST['hasintim'];
    $nat=$_POST['hasnat'];
    $perc=$_POST['hasperc'];
    $rel=$_POST['hasrel'];
    $ste=$_POST['hasste'];
    $street=$_POST['hasstreet'];
    $thiev=$_POST['hasthiev'];
    $his=$_POST['hashis'];
    
	//connection to SQL 
	$db = new PDO("mysql:host=localhost;dbname=;adventurer","host","");

	//function to send variable arrays to proper SQL tables
	function qinit($array,$field,$table)
	{
		if(empty($array))
		{
			return null;
		}
		else
		{
			global $character,$user;

			$sql="insert into $table(charname,username,$field) values";
			$it=new ArrayIterator($array);
			$cit=new CachingIterator($it);
		
			foreach($cit as $v)
			{
				$sql .= "('$character','$user','".$cit -> current()."')";
				if($cit -> hasNext())
				{
					$sql .= ",";
				}
			}
		}
		
		$stmt = $db->prepare($sql);
		$stmt->execute($sql);
	}
	
	function sqinit($array,$field,$table,$type)
	{
		if(empty($array))
		{
			return null;
		}
		else
		{
			global $character,$user;

			$sql="insert into $table(charname,username,$field,type) values";
			$it=new ArrayIterator($array);
			$cit=new CachingIterator($it);
		
			foreach($cit as $v)
			{
				$sql .= "('$character','$user','".$cit -> current()."','$type')";
				if($cit -> hasNext())
				{
					$sql .= ",";
				}
			}
		}
		
		$stmt = $db->prepare($sql);
		$stmt->execute($sql);
	}

	//function to send initial SQL character data
	function arraytosql($array)
	{
		$columns=array();
		$data=array();
		foreach($array as $key => $value)
		{	
			$columns[]=$key;

			if($value != "")
			{
				$data[]='"'.$value.'"';
			}
			else
			{
				$data[]="null";
			}
		}
		$fincol=implode(",",$columns);
		$findat=implode(",",$data);		
		$sql = "insert into characters($fincol) values($findat)";
		$stmt = $db->prepare($sql);
		$stmt->execute($sql);

	}

	//inserting blank values in the wallet
	$sql = "insert into wealth(username,charname,copper,silver,gold,platinum) values('$user','$character',0,0,0,0)";
	$stmt = $db->prepare($sql);
	$stmt->execute($sql);

    //basic info array
    //$basicinfo['world']=$world;
    $charinfo['username']=$user;
    $charinfo['charname']=$character;
    $charinfo['level']=1;
    $charinfo['xp']=1;
    $charinfo['age']=$age;
    $charinfo['gender']=$gender;
    $charinfo['race']=$race;
    $charinfo['class']=$class;
    $charinfo['weight']=$weight;
    $charinfo['height']=$height;
    $charinfo['deity']=$deity;
    $charinfo['notes']='Double click here!';
   
    //abilsco array
    $charinfo['strength']=$str;
    $charinfo['constitution']=$con;
    $charinfo['dexterity']=$dex;
    $charinfo['intelligence']=$int;
    $charinfo['wisdom']=$wis;
    $charinfo['charisma']=$cha;

    //defs
    $charinfo['armor']=0;
    $charinfo['armorclass']=$armclass;
    $charinfo['armormisc']=$armmisc;
    $charinfo['fortclass']=$fortclass;
    $charinfo['fortmisc']=$fortmisc;
    $charinfo['refclass']=$refclass;
    $charinfo['refmisc']=$refmisc;
    $charinfo['willclass']=$willclass;
    $charinfo['willmisc']=$willmisc;
    
    //atks
    $charinfo['atkclass']=$atkclass;
    $charinfo['atkfeat']=$atkfeat;
    $charinfo['atkmisc']=$atkmisc;
    $charinfo['damfeat']=$damfeat;
    $charinfo['dammisc']=$dammisc;
    
    //HP
    $charinfo['maxhp']=$maxhp;
    $charinfo['currenthp']=$maxhp;
    $charinfo['speed']=$speed;
   
    //equipment
    $charinfo['headslot']=$head;
    $charinfo['neckslot']=$neck;
    $charinfo['chestslot']=$armor;
    $charinfo['armsslot']=$arms;
    $charinfo['handsslot']=$hands;
    $charinfo['finger1']=$finger1;
    $charinfo['finger2']=$finger2;
    $charinfo['waistslot']=$waist;
    $charinfo['legsslot']=$legs;
    $charinfo['feetslot']=$feet;
    
    //skills
    $charinfo['acrobatics']=$acro;
    $charinfo['arcane']=$arc;
    $charinfo['athletics']=$ath;
    $charinfo['bluff']=$bluff;
    $charinfo['diplomacy']=$diplo;
    $charinfo['dungeoneering']=$dung;
    $charinfo['endurance']=$end;
    $charinfo['heal']=$heal;
    $charinfo['insight']=$ins;
    $charinfo['intimidation']=$intim;
    $charinfo['nature']=$nat;
    $charinfo['perception']=$perc;
    $charinfo['religion']=$rel;
    $charinfo['stealth']=$ste;
    $charinfo['streetwise']=$street;
    $charinfo['thievery']=$thiev;
    $charinfo['history']=$his;

	//sending charinfo array to SQL table
	arraytosql($charinfo);

    //race features
    foreach($_POST['rfeat'] as $x)
    {
        $rfeatures[]=$x;
    }
	qinit($rfeatures,'rfeature','rfeatures');

    //class features
    foreach($_POST['cfeat'] as $x)
    {
        $cfeatures[]=$x;
    }
	qinit($cfeatures,'cfeature','cfeatures');

    //feats
    foreach($_POST['feat'] as $x)
    {
        $feats[]=$x;
    }
	qinit($feats,'feat','feats');

    foreach($_POST['lang'] as $x)
    {
        $langs[]=$x;
    }
	qinit($langs,'language','languages');
    
    //powers
    foreach($_POST['atwill'] as $x)
    {
        $aw[]=$x;
    }
	sqinit($aw,'power','powers','at will');

    foreach($_POST['enc'] as $x)
    {
        $enc[]=$x;
    }
	sqinit($enc,'power','powers','encounter');

    foreach($_POST['daily'] as $x)
    {
        $daily[]=$x;
    }
	sqinit($daily,'power','powers','daily');

    foreach($_POST['util'] as $x)
    {
        $util[]=$x;
    }
	sqinit($util,'power','powers','utility');

    //inventory slots
    foreach($_POST['inv'] as $x)
    {
        $equip[]=$x;
    }
	qinit($equip,'item','inventory');

	header("location:../html/charselect.html");
?>
