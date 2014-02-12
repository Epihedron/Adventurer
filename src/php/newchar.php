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
	$conn=mysql_connect('localhost','host','');
	if(!$conn){print("could not connect to SQL\n");}
	$sel=mysql_select_db("adventurer");
	if(!$sel){print("could not select db\n");}

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
		
		mysql_query($sql.';') or die("<br/>Could not send query");
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
		mysql_query("insert into characters($fincol) values($findat);") or die("<br/> could not send query");
	}

    //basic info array
    //$basicinfo['world']=$world;
    $charinfo['username']=$user;
    $charinfo['charname']=$character;
    $charinfo['level']=1;
    $charinfo['xp']=0;
    $charinfo['age']=$age;
    $charinfo['gender']=$gender;
    $charinfo['race']=$race;
    $charinfo['class']=$class;
    $charinfo['weight']=$weight;
    $charinfo['height']=$height;
    $charinfo['deity']=$deity;
    $charinfo['notes']='';
   
    //abilsco array
    $charinfo['strength']=$str;
    $charinfo['constitution']=$con;
    $charinfo['dexterity']=$dex;
    $charinfo['intelligence']=$int;
    $charinfo['wisdom']=$wis;
    $charinfo['charisma']=$cha;

    //defs
    $charinfo['armor']=$arm;
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
	qinit($aw,'power','powers');

    foreach($_POST['enc'] as $x)
    {
        $enc[]=$x;
    }
	qinit($enc,'power','powers');

    foreach($_POST['daily'] as $x)
    {
        $daily[]=$x;
    }
	qinit($daily,'power','powers');

    foreach($_POST['util'] as $x)
    {
        $util[]=$x;
    }
	qinit($util,'power','powers');

    //inventory slots
    foreach($_POST['inv'] as $x)
    {
        $equip[]=$x;
    }
	qinit($equip,'item','inventory');

	header("location:../html/charselect.html");


    //previous json way of doing things. 
    //json encode
    //$charstats['Basic Info']=$basicinfo;
    //$charstats['Ability Scores']=$abilsco;
    // $charstats['Defenses']=$defs;
    //$charstats['Attacks']=$atks;
    //$charstats['Hit Points']=$hp;
    //$charstats['Features']=$features;
    //$charstats['Feats and Langs']=$feat;
    //$charstats['Powers']=$powers;
    //$charstats['Equipment']=$equip;
    //$charstats['Skills']=$skills;
    
    //checking accounts to see if they've been here and made a char before
    //$characcounts=file_get_contents('../json/accounts.json');
    //$accountsdata=json_decode($characcounts,true);
    //foreach($accountsdata['users'] as $i)
    //{
    //  if($i['user'] == $user)
    //  {
    //      $err=true;
    //  }
    //}
    //if($err == true)
    //{
        //grabbing char contents
    //  $charpd=file_get_contents("../json/chars/$user/$user"."list.json");
    //  $charpddecode=json_decode($charpd);
        
        //creating json object
    //  $charpddecode[]=$charstats;
        
        //pushing json object to charfile
    //  $finchar=json_encode($charpddecode);
    //  file_put_contents("../json/chars/$user/$user"."list.json",$finchar);
    //  header("location:../html/charselect.html");
    //}
    //else
    //{
    //  $newarr['user']=$user;
    //  $newarr['list']="../json/chars/$user/$user"."list.json";
    //  array_push($accountsdata['users'],$newarr);
    //  $finaccjson=json_encode($accountsdata);
    //  file_put_contents('../json/accounts.json',$finaccjson);
        
        //making char directory
    //  mkdir("../json/chars/$user");
    //  $charpage="../json/chars/$user/$user"."list.json";
    //  $charpagefp=fopen($charpage,'w+');
    //  fclose($charpagefp);
        
        //creating init.json
    //  $jsoninit=file_get_contents("../json/chars/$user/$user"."init.json");
    //  $jsoninitdc=json_decode($jsoninit);
    //  $jsoninitdc['user']=$user;
    //  $jsoninitdc['char']=$character;
    //  $finjsoninit=json_encode($jsoninitdc);
    //  file_put_contents("../json/chars/$user/$user"."init.json",$finjsoninit);
        
        //grabbing contents after closing the made page
    //  $charpd=file_get_contents("../json/chars/$user/$user"."list.json");
    //  $charpddecode=json_decode($charpd);
        
        //creating json object
    //  $charpddecode[]=$charstats;
        
        //pushing json object to charfile
    //  $finchar=json_encode($charpddecode);
    //  file_put_contents("../json/chars/$user/$user"."list.json",$finchar);
    //}
?>
