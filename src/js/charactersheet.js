var user;
var schar;

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
							                    //adding attributes to char sheet
							                    //basic info
							                    $("#charname").text(d[i]['Basic Info']['character']);
							                    $("#level").text(d[i]['Basic Info']['level']);
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
							                    $("#strmod").text(0);
							                    $("#conmod").text(0);
							                    $("#dexmod").text(0);
							                    $("#intmod").text(0);
							                    $("#wismod").text(0);
							                    $("#chamod").text(0);
							                    //defenses
							                    $("#ac").text(0);
							                    $("#armor").text(0);
							                    $("#classac").text(d[i]["Defenses"]["armor class"]);
							                    $("#acmisc").text(d[i]["Defenses"]["armor misc"]);
							                    $("#fort").text(0);
							                    $("#ref").text(0);
							                    $("#will").text(0);
							                    $("#classfort").text(d[i]["Defenses"]["fort class"]);
							                    $("#classref").text(d[i]["Defenses"]["ref class"]);
							                    $("#classwill").text(d[i]["Defenses"]["will class"]);
							                    $("#fortmisc").text(d[i]["Defenses"]["fort misc"]);
							                    $("#refmisc").text(d[i]["Defenses"]["ref misc"]);
							                    $("#willmisc").text(d[i]["Defenses"]["will misc"]);
							                    //hit points
							                    $("#currenthealth").text(0);
							                    $("#maxhealth").text(d[i]["Hit Points"]["maxhp"]);
							                    $("#surges").text(0);
							                    $("#passperc").text(d[i]["Hit Points"]["pass perc"]);
							                    $("#passins").text(d[i]["Hit Points"]["pass ins"]);
							                    //attacks
							                    $("#atkbonus").text(0)
							                    $("#atkclass").text(d[i]["Attacks"]["atk class"]);
							                    $("#atkfeat").text(d[i]["Attacks"]["atk feat"]);
							                    $("#atkmisc").text(d[i]["Attacks"]["atk misc"]);
							                    $("#damfeat").text(d[i]["Attacks"]["dam feat"]);
							                    $("#dammisc").text(d[i]["Attacks"]["dam misc"]);
							                    //wealth
							                    $("#copper").text(0);
							                    $("#silver").text(0);
							                    $("#gold").text(0);
							                    $("#platinum").text(0);
							                    $("#astraldiamond").text(0);
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

//panel toggles
$('#basicinfotab').click(function()
	{
		$('#basicinfo').toggle('slow');
	}
);
$('#abilscotab').click(function()
	{
		$('#abilscoinfo').toggle('slow');
	}
);
$('#atkstab').click(function()
	{
		$('#atksinfo').toggle('slow');
	}
);
$('#defstab').click(function()
	{
		$('#defsinfo').toggle('slow');
	}
);
$('#senstab').click(function()
	{
		$('#sensinfo').toggle('slow');
	});

$('#charselect').click(function()
	{
		window.location.href='../html/charselect.html';
	}
);