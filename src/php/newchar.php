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
    $deity=$_POST['deity'];

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
	$con=mysql_connect('localhost','host','');
	if(!$con){print("could not connect to SQL\n");}
	$sel=mysql_select_db("adventurer");
	if(!$sel){print("could not select db\n");}

	//sending data to SQL
	function qinit($y,$z)
	{
		foreach($z as $x)
		{
			$query=mysql_query("insert into $y values(null,$character,$user,$x);");
			if(!$query){print("could not query to database\n");}
		}
	}
	function arraytosql($array,$inup)
	{
		foreach($array as $key => $value)
		{
			$columns=array();
			$data=array();
			$columns[]=$key;

			if($value != "")
			{
				$data[]="'".$value."'";
			}
			else
			{
				$data[]="null";
			}
		}
	}
	print("i am working\n");

    //basic info array
    //$basicinfo['world']=$world;
    $basicinfo['character']=$character;
    $basicinfo['level']=1;
    $basicinfo['xp']=0;
    $basicinfo['age']=$age;
    $basicinfo['gender']=$gender;
    $basicinfo['race']=$race;
    $basicinfo['class']=$class;
    $basicinfo['weight']=$weight;
    $basicinfo['height']=$height;
    $basicinfo['deity']=$deity;
    $basicinfo['notes']='';
   
	//inserting values into SQL
	
 
    //abilsco array
    $abilsco['str']=$str;
    $abilsco['con']=$con;
    $abilsco['dex']=$dex;
    $abilsco['int']=$int;
    $abilsco['wis']=$wis;
    $abilsco['cha']=$cha;
    
    //defs
    $defs['armor']=$arm;
    $defs['armor class']=$armclass;
    $defs['armor misc']=$armmisc;
    $defs['fort class']=$fortclass;
    $defs['fort misc']=$fortmisc;
    $defs['ref class']=$refclass;
    $defs['ref misc']=$refmisc;
    $defs['will class']=$willclass;
    $defs['will misc']=$willmisc;
    
    //atks
    $atks['atk class']=$atkclass;
    $atks['atk feat']=$atkfeat;
    $atks['atk misc']=$atkmisc;
    $atks['dam feat']=$damfeat;
    $atks['dam misc']=$dammisc;
    
    //HP
    $hp['maxhp']=$maxhp;
    $hp['speed']=$speed;
    $hp['pass perc']=$passperc;
    $hp['pass ins']=$passins;
   
    //equipment
    $equip['ehead']=$head;
    $equip['eneck']=$neck;
    $equip['earmor']=$armor;
    $equip['earms']=$arms;
    $equip['ehands']=$hands;
    $equip['efinger1']=$finger1;
    $equip['efinger2']=$finger2;
    $equip['ewaist']=$waist;
    $equip['elegs']=$legs;
    $equip['efeet']=$feet;
    
    //skills
    $skills['acrobatics']=$acro;
    $skills['arcana']=$arc;
    $skills['athletics']=$ath;
    $skills['bluff']=$bluff;
    $skills['diplomacy']=$diplo;
    $skills['dungeoneering']=$dung;
    $skills['endurance']=$end;
    $skills['heal']=$heal;
    $skills['insight']=$ins;
    $skills['intimidate']=$intim;
    $skills['nature']=$nat;
    $skills['perception']=$perc;
    $skills['religion']=$rel;
    $skills['stealth']=$ste;
    $skills['streetwise']=$street;
    $skills['thievery']=$thiev;
    $skills['history']=$his;

    //race features
    foreach($_POST['rfeat'] as $x)
    {
        $features['race features'][]=$x;
    }

    //class features
    foreach($_POST['cfeat'] as $x)
    {
        $features['class features'][]=$x;
    }

    //feats
    foreach($_POST['feat'] as $x)
    {
        $feat['feats'][]=$x;
    }
    foreach($_POST['lang'] as $x)
    {
        $feat['langs'][]=$x;
    }
    
    //powers
    foreach($_POST['atwill'] as $x)
    {
        $powers['at will'][]=$x;
    }
    foreach($_POST['enc'] as $x)
    {
        $powers['encounter'][]=$x;
    }
    foreach($_POST['daily'] as $x)
    {
        $powers['daily'][]=$x;
    }
    foreach($_POST['util'] as $x)
    {
        $powers['utility'][]=$x;
    }

    //inventory slots
    foreach($_POST['inv'] as $x)
    {
        $equip['inventory'][]=$x;
    }

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
    //  header("location:../html/charselect.html");
    //}
?>
