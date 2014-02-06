//change characters name
$('#character').dblclick(function()
	{
		var ogcharname = $('#character').html();
		$('#character').html('<input type="text"/>');
		$('input').focus();
		$('input').focusout(function()
		{
			if($('input').val() == '')
			{
				$('#character').html(ogcharname);
			}
			else
			{
				var x=$('input').val();
				$.ajax(
				{
					url:'../php/changeatt.php',
					type:'post',
					data:{'chngname':x,'ogname':ogcharname},
					success:function(data)
					{
						// alert('your character was successfully changed to '+x+'.');
						console.log(data);
					}
				});
				$('#character').html(x);
			}

		});
	}
);

//change attribute function
function chngatt(x,y)
{
	x.dblclick(function()
		{
			var charname=$('#character').html();
			var og=x.html();
			x.html('<input type="text"/>');
			$('input').focus();
			$('input').focusout(function()
				{
					if($('input').val() == '')
					{
						x.html(og);
					}
					else
					{
						var newvalue=$('input').val();
						var findata = {};
						findata[y]=newvalue;
						findata['character']=charname;
						$.ajax(
							{
								url:'../php/changeatt.php',
								type:'post',
								data:findata,
								success:function(data)
								{
									x.html(newvalue);
									console.log(data);								
								},
								fail:function()
								{
									console.log('Could not send change data.');
								}
							});
					}
				});
		});
}
chngatt($('#class'),'class');