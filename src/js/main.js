$.ajax({
	url:'../php/init.php',
	data:{userquery:1},
	success:function(data)
	{
		if(data=='')
		{
			alert('you must login');
		}
		else
		{
			alert('you are logged in');
		}
	},
	error:function()
	{
		alert('ajax encounter a problem');
	}
});
$(".menubutton:nth-child(3)").click(function()
	{
		window.location.href = 'http://numaria.createaforum.com';
	}
);
$(".menubutton:nth-child(4)").click(function()
	{
    	window.location.href = '../php/logout.php';
	}
);
$(".menubutton:nth-child(1)").click(function()
	{
    	window.location.href = '../html/charselect.html';
	}
);
$(".menubutton:nth-child(2)").click(function()
	{
   	 	window.location.href = '../html/account.html';
	}
);