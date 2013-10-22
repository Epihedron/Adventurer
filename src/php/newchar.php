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
    $diety=$_POST['diety'];
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
    $rfeature1=$_POST['racefeatures1'];
    $rfeature2=$_POST['racefeatures2'];
    $rfeature3=$_POST['racefeatures3'];
    $rfeature4=$_POST['racefeatures4'];
    $rfeature5=$_POST['racefeatures5'];
    $cfeature1=$_POST['classfeatures1'];
    $cfeature2=$_POST['classfeatures2'];
    $cfeature3=$_POST['classfeatures3'];
    $cfeature4=$_POST['classfeatures4'];
    $cfeature5=$_POST['classfeatures5'];
    $feat1=$_POST['feat1'];
    $feat2=$_POST['feat2'];
    $feat3=$_POST['feat3'];
    $feat4=$_POST['feat4'];
    $feat5=$_POST['feat5'];
    $lang1=$_POST['lang1'];
    $lang2=$_POST['lang2'];
    $lang3=$_POST['lang3'];
    $aw1=$_POST['aw1'];
    $aw2=$_POST['aw2'];
    $aw3=$_POST['aw3'];
    $aw4=$_POST['aw4'];
    $aw5=$_POST['aw5'];
    $enc1=$_POST['enc1'];
    $enc2=$_POST['enc2'];
    $enc3=$_POST['enc3'];
    $enc4=$_POST['enc4'];
    $enc5=$_POST['enc5'];
    $dai1=$_POST['dai1'];
    $dai2=$_POST['dai2'];
    $dai3=$_POST['dai3'];
    $dai4=$_POST['dai4'];
    $dai5=$_POST['dai5'];
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
    $slot1=$_POST['slot1'];
    $slot2=$_POST['slot2'];
    $slot3=$_POST['slot3'];
    $slot4=$_POST['slot4'];
    $slot5=$_POST['slot5'];
    $slot6=$_POST['slot6'];
    $slot7=$_POST['slot7'];
    $slot8=$_POST['slot8'];
    $slot9=$_POST['slot9'];
    $slot10=$_POST['slot10'];
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
    $basicinfo['diety']=$diety;
    $basicinfo['notes']='';
    
    //abilsco array
    $abilsco['str']=$str;
    $abilsco['con']=$con;
    $abilsco['dex']=$dex;
    $abilsco['int']=$int;
    $abilsco['wis']=$wis;
    $abilsco['cha']=$cha;
    
    //defs
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
    
    //features
    $features['race feature1']=$rfeature1;
    $features['race feature2']=$rfeature2;
    $features['race feature3']=$rfeature3;
    $features['race feature4']=$rfeature4;
    $features['race feature5']=$rfeature5;
    $features['class feature1']=$cfeature1;
    $features['class feature2']=$cfeature2;
    $features['class feature3']=$cfeature3;
    $features['class feature4']=$cfeature4;
    $features['class feature5']=$cfeature5;
    
    //feats and languages
    $feat['feat1']=$feat1;
    $feat['feat2']=$feat2;
    $feat['feat3']=$feat3;
    $feat['feat4']=$feat4;
    $feat['feat5']=$feat5;
    $feat['lang1']=$lang1;
    $feat['lang2']=$lang2;
    $feat['lang3']=$lang3;
    
    //powers
    $powers['at will1']=$aw1;
    $powers['at will2']=$aw2;
    $powers['at will3']=$aw3;
    $powers['at will4']=$aw4;
    $powers['at will5']=$aw5;
    $powers['enc1']=$enc1;
    $powers['enc2']=$enc2;
    $powers['enc3']=$enc3;
    $powers['enc4']=$enc4;
    $powers['enc5']=$enc5;
    $powers['dai1']=$dai1;
    $powers['dai2']=$dai2;
    $powers['dai3']=$dai3;
    $powers['dai4']=$dai4;
    $powers['dai5']=$dai5;
    
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
    $equip['slot1']=$slot1;
    $equip['slot2']=$slot2;
    $equip['slot3']=$slot3;
    $equip['slot4']=$slot4;
    $equip['slot5']=$slot5;
    $equip['slot6']=$slot6;
    $equip['slot7']=$slot7;
    $equip['slot8']=$slot8;
    $equip['slot9']=$slot9;
    $equip['slot10']=$slot10;
    
    
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
    
    //json encode
    $charstats['Basic Info']=$basicinfo;
    $charstats['Ability Scores']=$abilsco;
    $charstats['Defenses']=$defs;
    $charstats['Attacks']=$atks;
    $charstats['Hit Points']=$hp;
    $charstats['Features']=$features;
    $charstats['Feats and Langs']=$feat;
    $charstats['Powers']=$powers;
    $charstats['Equipment']=$equip;
    $charstats['Skills']=$skills;
    
    //checking accounts to see if they've been here and made a char before
    $characcounts=file_get_contents('../json/accounts.json');
    $accountsdata=json_decode($characcounts,true);
    foreach($accountsdata['users'] as $i)
    {
        if($i['user'] == $user)
        {
            $err=true;
        }
    }
    if($err == true)
    {
        //grabbing char contents
        $charpd=file_get_contents("../json/chars/$user/$user"."list.json");
        $charpddecode=json_decode($charpd);
        
        //creating json object
        $charpddecode[]=$charstats;
        
        //pushing json object to charfile
        $finchar=json_encode($charpddecode);
        file_put_contents("../json/chars/$user/$user"."list.json",$finchar);
        header("location:../html/charselect.html");
    }
    else
    {
        $newarr['user']=$user;
        $newarr['list']="../json/chars/$user/$user"."list.json";
        array_push($accountsdata['users'],$newarr);
        $finaccjson=json_encode($accountsdata);
        file_put_contents('../json/accounts.json',$finaccjson);
        
        //making char directory
        mkdir("../json/chars/$user");
        $charpage="../json/chars/$user/$user"."list.json";
        $charpagefp=fopen($charpage,'w+');
        fclose($charpagefp);
        
        //creating init.json
        $jsoninit=file_get_contents("../json/chars/$user/$user"."init.json");
        $jsoninitdc=json_decode($jsoninit);
        $jsoninitdc['user']=$user;
        $jsoninitdc['char']=$character;
        $finjsoninit=json_encode($jsoninitdc);
        file_put_contents("../json/chars/$user/$user"."init.json",$finjsoninit);
        
        //grabbing contents after closing the made page
        $charpd=file_get_contents("../json/chars/$user/$user"."list.json");
        $charpddecode=json_decode($charpd);
        
        //creating json object
        $charpddecode[]=$charstats;
        
        //pushing json object to charfile
        $finchar=json_encode($charpddecode);
        file_put_contents("../json/chars/$user/$user"."list.json",$finchar);
        header("location:../html/charselect.html");
    }
    echo("<hr/>");
    echo($finchar);
?>