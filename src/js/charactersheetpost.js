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
					success:function(d){console.log(d);$('#character').text(nval);},
					fail:function(){console.log('change data WASNT sent');}
				});
			}
		});
	});

//change character stat function
function ccstat(id,tbl,clm)
{
	var ogval = id.html();

	id.html('<input type="text"/>');
	$('input').focus();
	$('input').focusout(function()
	{
		if($('input').val() == '')
		{
			id.html(ogval);
		}
		else
		{
			var nval = $('input').val();
			$.ajax(
			{
				url:'../php/changeatt.php',
				type:'post',
				data:{table:tbl,column:clm,og:ogval,nv:nval},
				success:function(d){console.log(d);id.text(nval);},
				fail:function(){console.log('change data WASNT sent');}
			});
		}
	});
}

//change character stat function
function ccpower(id,tbl,clm,tp)
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
				data:{table:tbl,column:clm,og:ogval,nv:nval,type:tp},
				success:function(d){console.log(d);id.text(nval);},
				fail:function(){console.log('change data WASNT sent');}
			});
		}
	});
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
$('#atwillpowers').delegate('*','dblclick',function()
{
	var elm=$(this);	
	ccpower(elm,'powers','power','at will');
});

//change class features and race features

//change feats

//change languages

//change skills

//change equipment

//change inventory

//change wealth

//change notes
