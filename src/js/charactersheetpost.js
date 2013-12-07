$('#character').dblclick(function()
	{
		$('#character').html('<input type="text"/>');
		$(this).keyup(function(e)
		{
			var x=$('input').text();
			if(event.keyCode==13)
			{
				alert(x);		
			}
		});
	}
);