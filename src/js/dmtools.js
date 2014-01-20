//login check
var user;
$.ajax({
	url:'../php/init.php',
	type:'post',
	data:{userquery:1},
	success:function(data)
	{
		user = data;
		if(user=="")
		{
			alert('You must login');
			setTimeout(function()
				{
					window.location.href='../../index.html';
				}
			);
		}
		else
		{
			$('#user').text(user);
			//loading user json dm data
			$.ajax({
				url:'../json/chars/'+user+'/'+user+'dm.json',
				success:function(data)
				{
					//silence is golden
				},
				error:function()
				{
					$.ajax({
						url:'../php/init.php',
						type:'post',
						data:{'mkdm':user},
						success:function()
						{
							alert('Looks like your first time here, welcome!');
						},
						error:function()
						{
							console.error('Unable to send file creation request.');
						}
					});
				}
			});
		}
	},
	error:function()
	{
		alert('ajax encounter a problem');
		window.location.href = '../index.html';
	}
});

//info refresh ajax call
function dataref()
{
	$.ajax({
		url:'../php/init.php',
		type:'post',
		data:{userquery:1},
		success:function(data)
		{
			user = data;
			$.ajax({
				url:'../json/chars/'+user+'/'+user+'dm.json',
				success:function(data)
				{
					//refreshing data on page with data from json file
				}
			});
		}
	});
}

//menu buttons
$('#main').click(function()
	{
		window.location.href='../html/main.html';
	}
);
$('#logout').click(function()
	{
		window.location.href='../php/logout.php';
	}
);
$('#addadvent').click(function()
	{
		var newadvent = prompt('Enter characters name.');
		if(newadvent)
		{
			$.ajax(
				{
					url:'../php/dmtoolsinit.php',
					type:'post',
					data:{'newchar':newadvent},
					fail:function(){console.log('did not send new character data')}
				});
		}
	});