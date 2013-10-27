//login check
$.ajax({
	url:'../php/init.php',
	type:'post',
	data:{userquery:1},
	success:function(data)
	{
		if(data=="")
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
			//silence is golden
		}
	},
	error:function()
	{
		alert('ajax encounter a problem');
		window.location.href = '../index.html';
	}
});

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