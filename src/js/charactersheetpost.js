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
					data:,
					success:function(d){console.log(d);$(id).text(nval);},
					fail:function(){console.log('change data WASNT sent');}
				});
			}
		});
	});

//change character stat function
function ccstat(id,tbl,clm)
{
	var ogval = $(id).html();

	$(id).html('<input type="text"/>');
	$('input').focus();
	$('input').focusout(function()
	{
		if($('input').val() == '')
		{
			$(id).html(ogval);
		}
		else
		{
			var nval = $('input').val();
			$.ajax(
			{
				url:'../php/changeatt.php',
				type:'post',
				data:{table:tbl,column:clm,og:ogval,nv:nval},
				success:function(d){console.log(d);$(id).text(nval);},
				fail:function(){console.log('change data WASNT sent');}
			});
		}
	});
}

//change attributes
