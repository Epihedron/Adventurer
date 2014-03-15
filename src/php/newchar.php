<?php
    session_start();
    
    //post variables
    $user=$_SESSION['user'];
    //$world=$_POST['world'];

    $character=$_POST['character'];
    $age=$_POST['age'];
    $weight=$_POST['weight'];
    $height=$_POST['height'];
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

    $acro=(isset($_POST['hasacro']) ? $_POST['hasacro'] : null);
    $arc=(isset($_POST['hasarc']) ? $_POST['hasarc'] : null);
    $ath=(isset($_POST['hasath']) ? $_POST['hasath'] : null);
    $bluff=(isset($_POST['hasbluff']) ? $_POST['hasbluff'] : null);
    $diplo=(isset($_POST['hasdiplo']) ? $_POST['hasdiplo'] : null);
    $dung=(isset($_POST['hasdung']) ? $_POST['hasdung'] : null);
    $end=(isset($_POST['hasend']) ? $_POST['hasend'] : null);
    $heal=(isset($_POST['hasheal']) ? $_POST['hasheal'] : null);
    $ins=(isset($_POST['hasins']) ? $_POST['hasins'] : null);
    $intim=(isset($_POST['hasintim']) ? $_POST['hasintim'] : null);
    $nat=(isset($_POST['hasnat']) ? $_POST['hasnat'] : null);
    $perc=(isset($_POST['hasperc']) ? $_POST['hasperc'] : null);
    $rel=(isset($_POST['hasrel']) ? $_POST['hasrel'] : null);
    $ste=(isset($_POST['hasste']) ? $_POST['hasste'] : null);
    $street=(isset($_POST['hasstreet']) ? $_POST['hasstreet'] : null);
    $thiev=(isset($_POST['hasthiev']) ? $_POST['hasthiev'] : null);
    $his=(isset($_POST['hashis']) ? $_POST['hashis'] : null);

	//1/4 of the value rounded down
	function quarterDown($a) {
		$a = floor($a / 4);
		return $a;
	}
    
	//connection to SQL 
	$db = new PDO("mysql:host=localhost;dbname=adventurer","host","",array(PDO::ATTR_PERSISTENT =>true));

	//function to send variable arrays to proper SQL tables
	function qinit($array,$field,$table)
	{
		global $db;

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
				$sql .= "('$character','$user',:n)";
				$stmt = $db->prepare($sql);
				$stmt->execute(array("n" => $cit -> current()));
			}
		}
		

	}
	
	function sqinit($array,$field,$table,$type)
	{
		global $db;

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
				$sql .= "('$character','$user',:n,'$type')";
				$stmt = $db->prepare($sql);
				$stmt->execute(array("n" => $cit -> current()));
			}
		}
	}

	//function to send initial SQL character data
	function arraytosql($array)
	{
		global $db;

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
		$stmt->execute();

	}

	//inserting blank values in the wallet
	$sql = "insert into wealth(username,charname,copper,silver,gold,platinum) values('$user','$character',0,0,0,0)";
	$stmt = $db->prepare($sql);
	$stmt->execute();

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
	$charinfo['surgesleft'] = quarterDown($maxhp);
	$charinfo['surges'] = quarterDown($maxhp);
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
    	if(isset($_POST['rfeat'])) {
		foreach($_POST['rfeat'] as $x)
    		{
    		    $rfeatures[]=$x;
    		}
		qinit($rfeatures,'rfeature','rfeatures');
	}

    	//class features
	if(isset($_POST['cfeat'])) {
   		foreach($_POST['cfeat'] as $x)
		{
        		$cfeatures[]=$x;
    		}
		qinit($cfeatures,'cfeature','cfeatures');
	}

    	//feats
	if(isset($_POST['feat'])) {
    		foreach($_POST['feat'] as $x)
    		{
        		$feats[]=$x;
    		}
		qinit($feats,'feat','feats');
	}

	//langs
	if(isset($_POST['lang'])) {
    		foreach($_POST['lang'] as $x)
    		{
    		    $langs[]=$x;
    		}
		qinit($langs,'language','languages');
	}
    
    	//powers
	if(isset($_POST['atwill'])) {
    		foreach($_POST['atwill'] as $x)
    		{
    		    $aw[]=$x;
    		}
		sqinit($aw,'power','powers','at will');
	}

	if(isset($_POST['enc'])) {
    		foreach($_POST['enc'] as $x)
    		{
    		    $enc[]=$x;
    		}
		sqinit($enc,'power','powers','encounter');
	}

	if(isset($_POST['daily'])) {
    		foreach($_POST['daily'] as $x)
    		{
    		    $daily[]=$x;
    		}
		sqinit($daily,'power','powers','daily');
	}

	if(isset($_POST['util'])) {
    		foreach($_POST['util'] as $x)
    		{
    		    $util[]=$x;
    		}
		sqinit($util,'power','powers','utility');
	}

    	//inventory slots
	if(isset($_POST['inv'])) {
    		foreach($_POST['inv'] as $x)
    		{
    		    $equip[]=$x;
    		}
		qinit($equip,'item','inventory');
	}

	header("location:../html/main.html");
?>
