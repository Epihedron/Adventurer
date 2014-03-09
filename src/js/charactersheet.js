//global variables
var user;
var schar;
var acro=0,arca=0,athl=0,bluf=0,dipl=0,dung=0,endu=0,heal=0,hist=0,insi=0,inti=0,natu=0,perc=0,reli=0,stea=0,stre=0,thie=0;
var strm,conm,dexm,intm,wism,cham;

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
	var rX=isOdd(x);
	var y=0;
	if(rX>11)
	{
		for(var a=12;a<100;a+=2)
		{
			y+=1;
			if(rX == a)
			{
				x=y;
				return x;
			}
		}
	}

	if(rX == 10 || rX == 11)
	{
		return 0;	
	}
	
	if(rX<10)
	{
		for(var a=8;a>-100;a-=2)
		{
			y-=1;
			if(rX == a)
			{
				x=y
				return x;
			}
		}
	}
}

//ghetto reloads for now :/
function ttr(){setTimeout(function(){location.reload()},25);}

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
			url:'../php/init.php',
			type:'post',
			data:{charquery:1},
			success:function(data)
			{
				$('#character').text(data);

				//grabbing selected characters attributes
				$.ajax(
			 	{
			     		url:'../php/init.php',
					type:'post',
					data:{basicstats:1},
					success:function(data)
					{
						//find the character in the players character list
					        for(var i in data)
					        {
							var d = JSON.parse(data);
							var atkbonus,damage,ac,fort,ref,will;
				               		var lvl=d['level'];
				               		var hlvl=isOdd(lvl)/2;							           
							//adding attributes to char sheet
							//basic info
							$("#level").text(lvl);
							$("#class").text(d['class']);
							$("#race").text(d['race']);
							$("#age").text(d['age']);
							$("#xp").text(d['xp']);
							$("#gender").text(d['gender']);
							$("#height").text(d['height']);
							$("#weight").text(d['weight']);
							$("#deity").text(d.deity);
							$("#speed").text(d.speed);

							//ability scores
							$("#str").text(d.strength);
							$("#con").text(d.constitution);
							$("#dex").text(d.dexterity);
							$("#int").text(d.intelligence);
							$("#wis").text(d.wisdom);
							$("#cha").text(d.charisma);							                    
							strm=datMod(d.strength);
							conm=datMod(d.constitution);
							dexm=datMod(d.dexterity);
							intm=datMod(d.intelligence);
							wism=datMod(d.wisdom);
							cham=datMod(d.charisma);

							$("#strmod").text(strm);
							$("#conmod").text(conm);
							$("#dexmod").text(dexm);
							$("#intmod").text(intm);
							$("#wismod").text(wism);
							$("#chamod").text(cham);

							//defenses
							var fortswitch,refswitch,willswtich;							                 
							$("#armor").text(d['armor']);
							$("#classac").text(d["armorclass"]);
							$("#acmisc").text(d["armormisc"]);							                   
							$("#classfort").text(d["fortclass"]);
							$("#classref").text(d["refclass"]);
							$("#classwill").text(d["willclass"]);

							$("#fortmisc").text(d["fortmisc"]);
							$("#refmisc").text(d["refmisc"]);
							$("#willmisc").text(d["willmisc"]);							                    

							ac=10+hlvl+parseInt(d["armormisc"])+parseInt(d["armorclass"])+parseInt($('#armor').html());
							fortswitch=(strm>=conm)?fortswitch=strm:fortswitch=conm;
							refswitch=(dexm>intm)?refswitch=dexm:refswitchswitch=intm;
							willswitch=(wism>cham)?willswitch=wism:willswitch=cham;

							fort=10+hlvl+fortswitch+parseInt($("#classfort").html())+parseInt($("#fortmisc").html());
							ref=10+hlvl+refswitch+parseInt($("#classref").html())+parseInt($("#refmisc").html());
							will=10+hlvl+willswitch+parseInt($("#classwill").html())+parseInt($("#willmisc").html());

							$("#ac").text(ac);
							$("#fort").text(fort);
							$("#ref").text(ref);
							$("#will").text(will);

							//hit points
							$("#currenthealth").text(d["currenthp"]);
							$("#maxhealth").text(d["maxhp"]);
							$("#surges").text(0);

							//passive perception and insight
							var pperc,pins;

							pperc = 10+hlvl;
							pins = 10+hlvl;

							if(d['perception']){pperc+=5}
							if(d['insight']){pins+=5}

							$("#passperc").text(pperc);
							$("#passins").text(pins);

							//attacks							                    
							$("#atkclass").text(d["atkclass"]);
							$("#atkfeat").text(d["atkfeat"]);
							$("#atkmisc").text(d["atkmisc"]);
							$("#damfeat").text(d["damfeat"]);
							$("#dammisc").text(d["dammisc"]);

							atkbonus=parseInt(d["atkmisc"])+parseInt(d["atkfeat"])+parseInt(d["atkclass"])+hlvl;
							damage=parseInt(d["dammisc"])+parseInt(d["damfeat"]);

							$("#atkbonus").text(atkbonus);
							$("#damage").text(damage);

							//equipment
							var head=d['headslot'];
							var neck=d['neckslot'];
							var armor=d['chestslot'];
							var arms=d['armsslot'];
							var hands=d['handsslot'];
							var finger1=d['finger1'];
							var finger2=d['finger2'];
							var waist=d['waistslot'];
							var legs=d['legsslot'];
							var feet=d['feetslot'];

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

							//calculating skills values
							acro+=dexm;     
							if(d['acrobatics']){acro+=5;$('#acro').addClass('resulthl');}
							arca+=intm;
							if(d['arcane']){arca+=5; $('#arc').addClass('resulthl');}
							athl+=strm;
							if(d['athletics']){athl+=5; $('#ath').addClass('resulthl');}	
							bluf+=cham;
							if(d['bluff']){bluf+=5; $('#bluff').addClass('resulthl');}		
							dipl+=cham;
							if(d['diplomacy']){dipl+=5; $('#dip').addClass('resulthl');}
							dung+=wism;
							if(d['dungeoneering']){dung+=5; $('#dung').addClass('resulthl');}	
							endu+=conm;
							if(d['endurance']){endu+=5; $('#end').addClass('resulthl');}
							heal+=wism;
							if(d['heal']){heal+=5; $('#heal').addClass('resulthl');}
							hist+=intm;
							if(d['history']){hist+=5; $('#his').addClass('resulthl');}
							insi+=wism;
							if(d['insight']){insi+=5; $('#ins').addClass('resulthl');}	
							inti+=cham;
							if(d['intimidation']){inti+=5; $('#inti').addClass('resulthl');}
							natu+=wism;
							if(d['nature']){natu+=5; $('#nat').addClass('resulthl');}
							perc+=wism;
							if(d['perception']){perc+=5; $('#perc').addClass('resulthl');}
							reli+=intm;
							if(d['religion']){reli+=5; $('#rel').addClass('resulthl');}
							stea+=dexm;
							if(d['stealth']){stea+=5; $('#ste').addClass('resulthl');}	
							stre+=cham;
							if(d['streetwise']){stre+=5; $('#stre').addClass('resulthl');}
							thie+=dexm;
							if(d['thievery']){thie+=5; $('#thiev').addClass('resulthl');}

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

							//adding notes
							$('#notes').text(d['notes']);

							break;
							}
						},
						error:function(e)
						{
							alert('err');
						}
					});

					//adding weatlth to page
					$.ajax(
					{
						url:'../php/init.php',
						type:'post',
						data:{'wealth':1},
						success:function(data)
						{
							var d=JSON.parse(data);

							$('#copper').text(d['copper']);
							$('#silver').text(d['silver']);
							$('#gold').text(d['gold']);
							$('#platinum').text(d['platinum']);
						},
						error:function()
						{
							console.log('could not pull wealth');
						}
					});

					//adding features to page
					$.ajax(
					{
						url:'../php/init.php',
						type:'post',
						data:{cfeatures:1},
						success:function(data)
						{
							var d=JSON.parse(data);

							for(var i in d)
							{
								if(d[i])
								{
									$('#classfeatures').append("<li><span class='lival'>"+d[i]['cfeature']+"</span><img class='deletebutton' src='../../images/smldeletebutton.png'/></li>");
								}
							}
						},
						error:function()
						{
							console.log('could not pull class features');
						}
					});
					$.ajax(
					{
						url:'../php/init.php',
						type:'post',
						data:{rfeatures:1},
						success:function(data)
						{
							var d=JSON.parse(data);

							for(var i in d)
							{
								if(d[i])
								{
									$('#racefeatures').append("<li><span class='lival'>"+d[i]['rfeature']+"</span><img class='deletebutton' src='../../images/smldeletebutton.png'/></li>");
								}
							}
						},
						error:function()
						{
							console.log('could not pull class features');
						}
					});

					//adding feats and languages to page
					$.ajax(
					{
						url:'../php/init.php',
						type:'post',
						data:{feats:1},
						success:function(data)
						{
							var d=JSON.parse(data);

							for(var i in d)
							{
								if(d[i])
								{
									$('#feats').append("<li><span class='lival'>"+d[i]['feat']+"</span><img class='deletebutton' src='../../images/smldeletebutton.png'/></li>");
								}
							}
						},
						error:function()
						{
							console.log('could not pull class features');
						}
					});
					$.ajax(
					{
						url:'../php/init.php',
						type:'post',
						data:{languages:1},
						success:function(data)
						{
							var d=JSON.parse(data);

							for(var i in d)
							{
								if(d[i])
								{
									$('#langs').append("<li><span class='lival'>"+d[i]['language']+"</span><img class='deletebutton' src='../../images/smldeletebutton.png'/></li>");
								}
							}
						},
						error:function()
						{
							console.log('could not pull class features');
						}
					});

					//adding inventory to page
					$.ajax(
					{
						url:'../php/init.php',
						type:'post',
						data:{inventory:1},
						success:function(data)
						{
							var d=JSON.parse(data);

							for(var i in d)
							{
								if(d[i])
								{
									$('#inventory').append("<li><span class='lival'>"+d[i]['item']+"</span><img class='deletebutton' src='../../images/smldeletebutton.png'/></li>");
								}
							}
						},
						error:function()
						{
							console.log('could not pull class features');
						}
					});
					//adding powers to page
					$.ajax(
					{
						url:'../php/init.php',
						type:'post',
						data:{powers:1},
						success:function(data)
						{
							var d=JSON.parse(data);
							var awp=new Array();
							var ep=new Array();
							var dp=new Array();
							var up=new Array();

							for(var i in d)
							{
								if(d[i]['type']=='utility')
								{
									up.push(d[i]['power']);
								}
								if(d[i]['type']=='daily')
								{
									dp.push(d[i]['power']);
								}
								if(d[i]['type']=='encounter')
								{
									ep.push(d[i]['power']);
								}
								if(d[i]['type']=='at will')
								{
									awp.push(d[i]['power']);
								}
							}

							if(awp)
							{
								for(var x in awp)
								{
									$("#atwillpowers").append("<li><span class='lival'>"+awp[x]+"</span><img class='deletebutton' src='../../images/smldeletebutton.png'/></li>");
								}
							}
							if(ep)
							{
								for(var x in ep)
								{
									$("#encounterpowers").append("<li><input type='checkbox' style='float:left;'/><span class='lival'>"+ep[x]+"</span><img class='deletebutton' src='../../images/smldeletebutton.png'/></li>");
								}
							}
							if(dp)
							{
								for(var x in dp)
								{
									$("#dailypowers").append("<li><input type='checkbox'style='float:left;'/><span class='lival'>"+dp[x]+"</span><img class='deletebutton' src='../../images/smldeletebutton.png'/></li>");
								}
							}
							if(up)
							{
								for(var x in up)
								{
									$("#utilitypowers").append("<li><input type='checkbox'style='float:left;'/><span class='lival'>"+up[x]+"</span><img class='deletebutton' src='../../images/smldeletebutton.png'/></li>");
								}
							}

							//delete button business
							$('.deletebutton').click(function()
							{
								var title=$(this).parent().parent().attr('id');
								var text=$(this).prev().text();

								if(confirm('Are you sure you want to delete "'+text+'"?'))
								{
									$.ajax(
									{
										url:'../php/changeatt.php',
										type:'post',
										data:{'title':title,'text':text},
										success:function(d){console.log(d);},
										fail:function(){console.log('Did send value '+text);}
									});
									$(this).parent().remove();
								}
							});
						},
						error:function(e)
						{
							console.log('unable to grab powers');
						}
					});	
				},
				error:function()
				{
					alert('error on character select ajax call');
				}
			});
		},
    error:function()
    	{
	        alert('Character failed to load.');
	        window.location.href='../html/charselect.html';
       	}
    });
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
		window.location.href='../html/main.html';
	}
);
