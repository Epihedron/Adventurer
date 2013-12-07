//global variables
var user;
var schar;
var acro=0,arca=0,athl=0,bluf=0,dipl=0,dung=0,endu=0,heal=0,hist=0,insi=0,inti=0,natu=0,perc=0,reli=0,stea=0,stre=0,thie=0;
var strm,conm,dexm,intm,wism,cham;
//different functions
//wow, made an odd number even rounded down...epic
function isOdd(x)
{
	var c=x % 2;
	if(c == 0)
	{
		return x;
	}
	else
	{
		x-=1;
		return x;
	}
}
//ability modifier function
function datMod(x)
{
	x=isOdd(x);
	var y=0;
	if(x>11)
	{
		for(var a=12;a<100;a+=2)
		{
			y+=1;
			if(x == a)
			{
				x=y;
				return x;
			}
		}
	}
}
//logincheck
$.ajax(
	{
    url:'../php/init.php',
    type:'post',
    data:{userquery:1},
    success:function(data)
        {
            user = data;
            if(user == '')
            {
                alert('YOU MUST LOG IN!');
                window.location.replace('../../index.html');
            }
            else
            {
                $('#name').text(user);
            }
            //grabbing selected character
			$.ajax(
				{
					url:'../json/chars/'+user+'/'+user+'init.json',
					success:function(data)
						{
							schar = data['char'];
							$('#character').text(schar);
							//grabbing selected characters attributes
							$.ajax(
							   {
							       url:'../json/chars/'+user+'/'+user+'list.json',
							       success:function(d)
							       {
							       		//find the character in the players character list
							           for(var i in d)
							           {
							               if(d[i]['Basic Info']['character']==$('#character').text())
							               {
							               		var atkbonus,damage,ac,fort,ref,will;
							               		var lvl=d[i]['Basic Info']['level'];
							               		var hlvl=isOdd(lvl)/2;							           
							                    //adding attributes to char sheet
							                    //basic info
							                    $("#charname").text(d[i]['Basic Info']['character']);
							                    $("#level").text(lvl);
							                    $("#class").text(d[i]['Basic Info']['class']);
							                    $("#race").text(d[i]['Basic Info']['race']);
							                    $("#age").text(d[i]['Basic Info']['age']);
							                    $("#xp").text(d[i]['Basic Info']['xp']);
							                    $("#gender").text(d[i]['Basic Info']['gender']);
							                    $("#height").text(d[i]['Basic Info']['height']);
							                    $("#weight").text(d[i]['Basic Info']['weight']);
							                    $("#diety").text(d[i]['Basic Info'].diety);
							                    $("#speed").text(d[i]['Hit Points'].speed);
							                    //ability scores
							                    $("#str").text(d[i]["Ability Scores"].str);
							                    $("#con").text(d[i]["Ability Scores"].con);
							                    $("#dex").text(d[i]["Ability Scores"].dex);
							                    $("#int").text(d[i]["Ability Scores"]['int']);
							                    $("#wis").text(d[i]["Ability Scores"].wis);
							                    $("#cha").text(d[i]["Ability Scores"].cha);							                    
							                    strm=datMod(d[i]["Ability Scores"].str);
							                    conm=datMod(d[i]["Ability Scores"].con);
							                    dexm=datMod(d[i]["Ability Scores"].dex);
							                    intm=datMod(d[i]["Ability Scores"]['int']);
							                    wism=datMod(d[i]["Ability Scores"].wis);
							                    cham=datMod(d[i]["Ability Scores"].cha);
							                    $("#strmod").text(strm);
							                    $("#conmod").text(conm);
							                    $("#dexmod").text(dexm);
							                    $("#intmod").text(intm);
							                    $("#wismod").text(wism);
							                    $("#chamod").text(cham);
							                    //defenses
							                    var fortswitch,refswitch,willswtich;							                 
							                    $("#armor").text(0);
							                    $("#classac").text(d[i]["Defenses"]["armor class"]);
							                    $("#acmisc").text(d[i]["Defenses"]["armor misc"]);							                   
							                    $("#classfort").text(d[i]["Defenses"]["fort class"]);
							                    $("#classref").text(d[i]["Defenses"]["ref class"]);
							                    $("#classwill").text(d[i]["Defenses"]["will class"]);
							                    $("#fortmisc").text(d[i]["Defenses"]["fort misc"]);
							                    $("#refmisc").text(d[i]["Defenses"]["ref misc"]);
							                    $("#willmisc").text(d[i]["Defenses"]["will misc"]);							                    
							                    ac=10+hlvl+parseInt(d[i]["Defenses"]["armor misc"])+parseInt(d[i]["Defenses"]["armor class"])+parseInt($('#armor').html());
							                    forswitch=(strm>conm)?fortswitch=strm:fortswitch=conm;
							                    refswitch=(dexm>intm)?refswitch=dexm:fortswitch=intm;
							                    willswitch=(wism>cham)?willswitch=wism:willswitch=cham;
							                    fort=10+hlvl+fortswitch+parseInt($("#classfort").html())+parseInt($("#fortmisc").html());
							                    ref=10+hlvl+refswitch+parseInt($("#classref").html())+parseInt($("#refmisc").html());
							                    will=10+hlvl+willswitch+parseInt($("#classwill").html())+parseInt($("#willmisc").html());
							                    $("#ac").text(ac);
							                    $("#fort").text(fort);
							                    $("#ref").text(ref);
							                    $("#will").text(will);
							                    //hit points
							                    $("#currenthealth").text(0);
							                    $("#maxhealth").text(d[i]["Hit Points"]["maxhp"]);
							                    $("#surges").text(0);
							                    $("#passperc").text(d[i]["Hit Points"]["pass perc"]);
							                    $("#passins").text(d[i]["Hit Points"]["pass ins"]);
							                    //attacks							                    
							                    $("#atkclass").text(d[i]["Attacks"]["atk class"]);
							                    $("#atkfeat").text(d[i]["Attacks"]["atk feat"]);
							                    $("#atkmisc").text(d[i]["Attacks"]["atk misc"]);
							                    $("#damfeat").text(d[i]["Attacks"]["dam feat"]);
							                    $("#dammisc").text(d[i]["Attacks"]["dam misc"]);
							                    atkbonus=parseInt(d[i]["Attacks"]["atk misc"])+parseInt(d[i]["Attacks"]["atk feat"])+parseInt(d[i]["Attacks"]["atk class"])+hlvl;
							                    damage=parseInt(d[i]["Attacks"]["dam misc"])+parseInt(d[i]["Attacks"]["dam feat"]);
							                    $("#atkbonus").text(atkbonus);
							                    $("#damage").text(damage);
							                    //powers
							                    var atwills=d[i]["Powers"]["at will"];
							                    var encounters=d[i]["Powers"]["encounter"];
							                    var dailys=d[i]["Powers"]["daily"];
							                    var utilities=d[i]["Powers"]["utility"];

							                    for(var x in atwills)
							                    {
							                    	$("#atwillpowers").append("<li>"+atwills[x]+"</li>");
							                    }
							                    for(var x in encounters)
							                    {
							                    	$("#encounterpowers").append("<li><input type='checkbox'style='float:left;'/>"+encounters[x]+"</li>");
							                    }
							                    for(var x in dailys)
							                    {
							                    	$("#dailypowers").append("<li><input type='checkbox'style='float:left;'/>"+dailys[x]+"</li>");
							                    }
							                    for(var x in utilities)
							                    {
							                    	$("#utilitypowers").append("<li><input type='checkbox'style='float:left;'/>"+utilities[x]+"</li>");
							                    }
							                    //features
							                    var racefeatures=d[i]["Features"]["race features"];
							                    var classfeatures=d[i]["Features"]["class features"];

							                    for(var x in racefeatures)
							                    {
							                    	$('#racefeatures').append("<li>"+racefeatures[x]+"</li>");
							                    }
							                    for(var x in classfeatures)
							                    {
							                    	$('#classfeatures').append("<li>"+classfeatures[x]+"</li>");
							                    }
							                    //feats and langs
							                    var feats=d[i]["Feats and Langs"]["feats"];
							                    var langs=d[i]["Feats and Langs"]["langs"];

							                    for(var x in feats)
							                    {
							                    	$('#feats').append("<li>"+feats[x]+"</li>");
							                    }
							                    for(var x in langs)
							                    {
							                    	$('#langs').append("<li>"+langs[x]+"</li>");
							                    }
							                    //skills
							                    var skills=d[i]["Skills"];							                  
							                    
							                    for(var x in skills)
							                    {
							                    	if(skills[x]!==null)
							                    	{
							                    		if(x=='acrobatics'){acro+=5;$('#acro').addClass("resulthl");}
							                    		if(x=='arcana'){arca+=5;$('#arc').addClass("resulthl");}
							                    		if(x=='athletics'){athl+=5;$('#ath').addClass("resulthl");}
							                    		if(x=='bluff'){bluf+=5;$('#bluff').addClass("resulthl");}
							                    		if(x=='diplomacy'){dipl+=5;$('#dip').addClass("resulthl");}
							                    		if(x=='dungeoneering'){dung+=5;$('#dung').addClass("resulthl");}
							                    		if(x=='endurance'){endu+=5;$('#end').addClass("resulthl");}
							                    		if(x=='heal'){heal+=5;$('#heal').addClass("resulthl");}
							                    		if(x=='history'){hist+=5;$('#his').addClass("resulthl");}
							                    		if(x=='insight'){insi+=5;$('#ins').addClass("resulthl");}
							                    		if(x=='intimidate'){inti+=5;$('#inti').addClass("resulthl");}
							                    		if(x=='nature'){natu+=5;$('#nat').addClass("resulthl");}
							                    		if(x=='perception'){perc+=5;$('#perc').addClass("resulthl");}
							                    		if(x=='religion'){reli+=5;$('#rel').addClass("resulthl");}
							                    		if(x=='stealth'){stea+=5;$('#ste').addClass("resulthl");}
							                    		if(x=='streetwise'){stre+=5;$('#stre').addClass("resulthl");}
							                    		if(x=='thievery'){thie+=5;$('#thiev').addClass("resulthl");}
							                    	}
							                    }
							                    //equipment
							                    var head=d[i]["Equipment"]['ehead'];
							                    var neck=d[i]["Equipment"]['eneck'];
							                    var armor=d[i]["Equipment"]['earmor'];
							                    var arms=d[i]["Equipment"]['earms'];
							                    var hands=d[i]["Equipment"]['ehands'];
							                    var finger1=d[i]["Equipment"]['efinger1'];
							                    var finger2=d[i]["Equipment"]['efinger2'];
							                    var waist=d[i]["Equipment"]['ewaist'];
							                    var legs=d[i]["Equipment"]['elegs'];
							                    var feet=d[i]["Equipment"]['efeet'];

							                    $('#head').text(head);
							                    $('#neck').text(neck);
							                    $('#earmor').text(armor);
							                    $('#arms').text(arms);
							                    $('#hands').text(hands);
							                    $('#finger1').text(finger1);
							                    $('#finger2').text(finger2);
							                    $('#waist').text(waist);
							                    $('#legs').text(legs);
							                    $('#feet').text(feet);
							                    //inventory
							                    var inventory=d[i]["Equipment"]["inventory"];

							                    for(var x in inventory)
							                    {
							                    	$('#inventory').append("<li>"+inventory[x]+"</li>");
							                    }
							                    //wealth
							                    $("#copper").text(0);
							                    $("#silver").text(0);
							                    $("#gold").text(0);
							                    $("#platinum").text(0);
							                    $("#astraldiamond").text(0);		
							                    //calculating skills values
							                    acro+=dexm;							                    
							                    arca+=intm;
							                    athl+=strm;
							                    bluf+=cham;
							                    dipl+=cham;
							                    dung+=wism;
							                    endu+=conm;
							                    heal+=wism;
							                    hist+=intm;
							                    insi+=wism;
							                    inti+=cham;
							                    natu+=wism;
							                    perc+=wism;
							                    reli+=intm;
							                    stea+=dexm;
							                    stre+=cham;
							                    thie+=dexm;
							                    //adding skills value to page
							                    $('#acro').text(acro);
							                    $('#arc').text(arca);
							                    $('#ath').text(athl);
							                    $('#bluff').text(bluf);
							                    $('#dip').text(dipl);
							                    $('#dung').text(dung);
							                    $('#end').text(endu);							                    
							                    $('#heal').text(heal);
							                    $('#his').text(hist);
							                    $('#ins').text(insi);
							                    $('#inti').text(inti);
							                    $('#nat').text(natu);
							                    $('#perc').text(perc);
							                    $('#rel').text(reli);
							                    $('#ste').text(stea);
							                    $('#stre').text(stre);
							                    $('#thiev').text(thie);

							                    break;
							               }
							           }
							       },
							       error:function(e)
							       {
							           alert('err');
							       }
							   }
							);
						},
					error:function()
						{
							alert('error on character select ajax call');
						}
				}
			);
        },
    error:function()
    	{
	        alert('Character failed to load.');
	        window.location.href='../html/charselect.html';
        }
    }
);
//hiding panels
$('#basicinfo').hide();
$('#abilscoinfo').hide();
$('#atksinfo').hide();
$('#defsinfo').hide();
$('#powersinfo').hide();
$('#featuresinfo').hide();
$('#featsandlangsinfo').hide();
$('#skillsinfo').hide();
$('#equipinfo').hide();
$('#wealthinfo').hide();
$('#notesinfo').hide();

//panel toggles
$('#basicinfotab').click(function()
	{
		$('#basicinfo').toggle('slow');
		if($('#basicinfotab').hasClass("infotab"))
		{
			$('#basicinfotab').removeClass("infotab");
			$('#basicinfotab').addClass("infotabhl");
		}		
		else
		{
			$('#basicinfotab').removeClass("infotabhl");
			$('#basicinfotab').addClass("infotab");
		}		
	}
);
$('#abilscotab').click(function()
	{
		$('#abilscoinfo').toggle('slow');
		if($('#abilscotab').hasClass("infotab"))
		{
			$('#abilscotab').removeClass("infotab");
			$('#abilscotab').addClass("infotabhl");
		}		
		else
		{
			$('#abilscotab').removeClass("infotabhl");
			$('#abilscotab').addClass("infotab");
		}
	}
);
$('#atkstab').click(function()
	{
		$('#atksinfo').toggle('slow');
		if($('#atkstab').hasClass("infotab"))
		{
			$('#atkstab').removeClass("infotab");
			$('#atkstab').addClass("infotabhl");
		}		
		else
		{
			$('#atkstab').removeClass("infotabhl");
			$('#atkstab').addClass("infotab");
		}
	}
);
$('#defstab').click(function()
	{
		$('#defsinfo').toggle('slow');
		if($('#defstab').hasClass("infotab"))
		{
			$('#defstab').removeClass("infotab");
			$('#defstab').addClass("infotabhl");
		}		
		else
		{
			$('#defstab').removeClass("infotabhl");
			$('#defstab').addClass("infotab");
		}
	}
);
$('#senstab').click(function()
	{
		$('#sensinfo').toggle('slow');
		if($('#senstab').hasClass("infotab"))
		{
			$('#senstab').removeClass("infotab");
			$('#senstab').addClass("infotabhl");
		}		
		else
		{
			$('#senstab').removeClass("infotabhl");
			$('#senstab').addClass("infotab");
		}
	}
);
$('#powerstab').click(function()
	{
		$('#powersinfo').toggle('slow');
		if($('#powerstab').hasClass("infotab"))
		{
			$('#powerstab').removeClass("infotab");
			$('#powerstab').addClass("infotabhl");
		}		
		else
		{
			$('#powerstab').removeClass("infotabhl");
			$('#powerstab').addClass("infotab");
		}
	}
);
$('#featurestab').click(function()
	{
		$('#featuresinfo').toggle('slow');
		if($('#featurestab').hasClass("infotab"))
		{
			$('#featurestab').removeClass("infotab");
			$('#featurestab').addClass("infotabhl");
		}		
		else
		{
			$('#featurestab').removeClass("infotabhl");
			$('#featurestab').addClass("infotab");
		}
	}
);
$('#featsnlangtab').click(function()
	{
		$('#featsandlangsinfo').toggle('slow');
		if($('#featsnlangtab').hasClass("infotab"))
		{
			$('#featsnlangtab').removeClass("infotab");
			$('#featsnlangtab').addClass("infotabhl");
		}		
		else
		{
			$('#featsnlangtab').removeClass("infotabhl");
			$('#featsnlangtab').addClass("infotab");
		}
	}
);
$('#skillstab').click(function()
	{
		$('#skillsinfo').toggle('slow');
		if($('#skillstab').hasClass("infotab"))
		{
			$('#skillstab').removeClass("infotab");
			$('#skillstab').addClass("infotabhl");
		}		
		else
		{
			$('#skillstab').removeClass("infotabhl");
			$('#skillstab').addClass("infotab");
		}
	}
);
$('#equipninvtab').click(function()
	{
		$('#equipinfo').toggle('slow');
		if($('#equipninvtab').hasClass("infotab"))
		{
			$('#equipninvtab').removeClass("infotab");
			$('#equipninvtab').addClass("infotabhl");
		}		
		else
		{
			$('#equipninvtab').removeClass("infotabhl");
			$('#equipninvtab').addClass("infotab");
		}
	}
);
$('#wealthtab').click(function()
	{
		$('#wealthinfo').toggle('slow');
		if($('#wealthtab').hasClass("infotab"))
		{
			$('#wealthtab').removeClass("infotab");
			$('#wealthtab').addClass("infotabhl");
		}		
		else
		{
			$('#wealthtab').removeClass("infotabhl");
			$('#wealthtab').addClass("infotab");
		}
	}
);
$('#notestab').click(function()
	{
		$('#notesinfo').toggle('slow');
		if($('#notestab').hasClass("infotab"))
		{
			$('#notestab').removeClass("infotab");
			$('#notestab').addClass("infotabhl");
		}		
		else
		{
			$('#notestab').removeClass("infotabhl");
			$('#notestab').addClass("infotab");
		}
	}
);

//back to char select button
$('#charselect').click(function()
	{
		window.location.href='../html/charselect.html';
	}
);