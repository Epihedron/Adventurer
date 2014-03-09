//my ghetto ass way of getting all the functions to work again. there will be a time where we won't need to reload.
function ttr(){setTimeout(function()
{
	location.reload();
},25)}

//change character name
$('#character').dblclick(function()
	{
		var ogval = $('#character').html();

		$('#character').html('<input type="text"/>');
		$('input').focus();
		$('input').focusout(function()
		{
			if($('input').val() == '')
			{
				$('#character').html(ogval);
			}
			else
			{
				var nval = $('input').val();
				$.ajax(
				{
					url:'../php/changeatt.php',
					type:'post',
					data:{changename:nval},
					success:function(d){console.log(d);},
					fail:function(){console.log('change data WASNT sent');}
				});
				ttr();
			}
		});
	});

//change character stat function
function ccstat(id,tbl,clm)
{
	var ogval = id.html();

	id.html('<input id="temp" type="text"/>');
	$('#temp').focus();
	$('#temp').focusout(function()
	{
		if($('#temp').val() == '')
		{
			id.html(ogval);
		}
		else
		{
			var nval = $('#temp').val();
			$.ajax(
			{
				url:'../php/changeatt.php',
				type:'post',
				data:{table:tbl,column:clm,og:ogval,nv:nval},
				success:function(d){console.log(d);},
				fail:function(){console.log('change data WASNT sent');}
			});
			//ttr();
		}
	});
}

//change character power function
function ccpower(id,tbl,clm,tp)
{
	var ogval = id.html();
	var ooog = id.text();

	id.html('<input id="temp" type="text"/>');
	$('#temp').focus();
	$('#temp').focusout(function()
	{
		if($('#temp').val() == '')
		{
			id.html(ogval);
		}
		else
		{
			var nval = $('#temp').val();
			$.ajax(
			{
				url:'../php/changeatt.php',
				type:'post',
				data:{table:tbl,column:clm,og:ooog,nv:nval,type:tp},
				success:function(d){console.log(d);},
				fail:function(){console.log('change data WASNT sent');}
			});
			ttr();
		}
	});
}

//change skill function
function ccskill(id,skill,col)
{
	var nval=(id.hasClass('resulthl'))?nval='':nval=skill;
	$.ajax(
	{
		url:'../php/changeatt.php',
		type:'post',
		data:{'skillcol':col,'newskill':nval},
		success:function(d){console.log(d);},
		fail:function(){console.log('Could not send skill change');}
	});
	ttr();
}

//change attributes
$('#level').dblclick(function(){ccstat($(this),'characters','level')});
$('#currenthealth').dblclick(function(){ccstat($(this),'characters','currenthp')});
$('#maxhealth').dblclick(function(){ccstat($(this),'characters','maxhp')});
$('#race').dblclick(function(){ccstat($(this),'characters','race')});
$('#class').dblclick(function(){ccstat($(this),'characters','class')});
$('#age').dblclick(function(){ccstat($(this),'characters','age')});
$('#xp').dblclick(function(){ccstat($(this),'characters','xp')});
$('#gender').dblclick(function(){ccstat($(this),'characters','gender')});
$('#height').dblclick(function(){ccstat($(this),'characters','height')});
$('#weight').dblclick(function(){ccstat($(this),'characters','weight')});
$('#deity').dblclick(function(){ccstat($(this),'characters','deity')});
$('#speed').dblclick(function(){ccstat($(this),'characters','speed')});
$('#str').dblclick(function(){ccstat($(this),'characters','strength')});
$('#con').dblclick(function(){ccstat($(this),'characters','constitution')});
$('#dex').dblclick(function(){ccstat($(this),'characters','dexterity')});
$('#int').dblclick(function(){ccstat($(this),'characters','intelligence')});
$('#wis').dblclick(function(){ccstat($(this),'characters','wisdom')});
$('#cha').dblclick(function(){ccstat($(this),'characters','charisma')});

//change attacks
$('#atkclass').dblclick(function(){ccstat($(this),'characters','atkclass')});
$('#atkfeat').dblclick(function(){ccstat($(this),'characters','atkfeat')});
$('#atkmisc').dblclick(function(){ccstat($(this),'characters','atkmisc')});
$('#damfeat').dblclick(function(){ccstat($(this),'characters','damfeat')});
$('#dammisc').dblclick(function(){ccstat($(this),'characters','dammisc')});

//change defenses
$('#armor').dblclick(function(){ccstat($(this),'characters','armor')});
$('#classac').dblclick(function(){ccstat($(this),'characters','armorclass')});
$('#acmisc').dblclick(function(){ccstat($(this),'characters','armormisc')});
$('#classfort').dblclick(function(){ccstat($(this),'characters','fortclass')});
$('#fortmisc').dblclick(function(){ccstat($(this),'characters','fortmisc')});
$('#classref').dblclick(function(){ccstat($(this),'characters','refclass')});
$('#refmisc').dblclick(function(){ccstat($(this),'characters','refmisc')});
$('#classwill').dblclick(function(){ccstat($(this),'characters','willclass')});
$('#willmisc').dblclick(function(){ccstat($(this),'characters','willmisc')});

//change powers
function upp(id,sqltype)
{
	id.delegate('*','dblclick',function()
	{
		ccpower($(this),'powers','power',sqltype);
	});
}
upp($('#atwillpowers'),'at will');
upp($('#encounterpowers'),'encounter');
upp($('#dailypowers'),'daily');
upp($('#utilitypowers'),'utility');

//change class features and race features
$('#classfeatures').delegate('*','dblclick',function(){ccstat($(this),'cfeatures','cfeature');});
$('#racefeatures').delegate('*','dblclick',function(){ccstat($(this),'rfeatures','rfeature');});

//change feats
$('#feats').delegate('*','dblclick',function(){ccstat($(this),'feats','feat');});

//change languages
$('#langs').delegate('*','dblclick',function(){ccstat($(this),'languages','language');});

//change skills
$('#acro').dblclick(function(){ccskill($(this),'hasacro','acrobatics');});
$('#arc').dblclick(function(){ccskill($(this),'hasarc','arcane');});
$('#ath').dblclick(function(){ccskill($(this),'hasath','athletics');});
$('#bluff').dblclick(function(){ccskill($(this),'hasbluff','bluff');});
$('#dip').dblclick(function(){ccskill($(this),'hasdip','diplomacy');});
$('#dung').dblclick(function(){ccskill($(this),'hasdung','dungeoneering');});
$('#end').dblclick(function(){ccskill($(this),'hasend','endurance');});
$('#heal').dblclick(function(){ccskill($(this),'hasheal','heal');});
$('#his').dblclick(function(){ccskill($(this),'hashis','history');});
$('#ins').dblclick(function(){ccskill($(this),'hasins','insight');});
$('#inti').dblclick(function(){ccskill($(this),'hasinti','intimidation');});
$('#nat').dblclick(function(){ccskill($(this),'hasnat','nature');});
$('#perc').dblclick(function(){ccskill($(this),'hasperc','perception');});
$('#rel').dblclick(function(){ccskill($(this),'hasrel','religion');});
$('#ste').dblclick(function(){ccskill($(this),'hasste','stealth');});
$('#stre').dblclick(function(){ccskill($(this),'hasstre','streetwise');});
$('#thiev').dblclick(function(){ccskill($(this),'hasthiev','thievery');});

//change equipment
$('#head').dblclick(function(){ccstat($(this),'characters','headslot')});
$('#neck').dblclick(function(){ccstat($(this),'characters','neckslot')});
$('#earmor').dblclick(function(){ccstat($(this),'characters','chestslot')});
$('#arms').dblclick(function(){ccstat($(this),'characters','armsslot')});
$('#hands').dblclick(function(){ccstat($(this),'characters','handsslot')});
$('#finger1').dblclick(function(){ccstat($(this),'characters','finger1')});
$('#finger2').dblclick(function(){ccstat($(this),'characters','finger2')});
$('#waist').dblclick(function(){ccstat($(this),'characters','waistslot')});
$('#legs').dblclick(function(){ccstat($(this),'characters','legsslot')});
$('#feet').dblclick(function(){ccstat($(this),'characters','feetslot')});

//change inventory
$('#inventory').delegate('*','dblclick',function(){ccstat($(this),'inventory','item');});

//change wealth
$('#copper').dblclick(function(){ccstat($(this), 'wealth','copper');});
$('#silver').dblclick(function(){ccstat($(this), 'wealth','silver');});
$('#gold').dblclick(function(){ccstat($(this), 'wealth','gold');});
$('#platinum').dblclick(function(){ccstat($(this), 'wealth','platinum');});

//change notes
$('#notes').dblclick(function(){ccstat($(this),'characters','notes');});

//adding value to list models
$('.addbutton').click(function()
{
	var list = $(this).prev();
	var addbox = "<li><input class='liinp' type='text'/></li>"
	
	list.append(addbox);

	$('.liinp').focus();
	$('.liinp').focusout(function()
	{
		var val=$(this).val();
		var type=list.attr('id');

		if(val=='')
		{
			$(this).parent().remove();
		}
		else
		{
			$.ajax(
			{
				url:'../php/init.php',
				type:'post',
				data:{'newval':val,'newtype':type},
				success:function(d){console.log(d);},
				fail:function(){console.log('unable to send data');}
			});
			ttr();
		}
	});
});
