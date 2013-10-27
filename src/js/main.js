var today;
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
			//the date
			function makeArray() 
			{
				for (i = 0; i<makeArray.arguments.length; i++)
				this[i + 1] = makeArray.arguments[i];
			}

			var months = new makeArray('January','February','March','April','May',
			'June','July','August','September','October','November','December');
			var date = new Date();
			var day = date.getDate();
			var month = date.getMonth() + 1;
			var yy = date.getYear();
			var year = (yy < 1000) ? yy + 1900 : yy;
			$("#user").text(data);
			$("#date").text(day + " " + months[month] + " " + year);
		}
	},
	error:function()
	{
		alert('ajax encounter a problem');
		window.location.href = '../index.html';
	}
});
$("#forums").click(function()
	{
		window.location.href = 'http://numaria.createaforum.com';
	}
);
$("#logout").click(function()
	{
    	window.location.href = '../php/logout.php';
	}
);
$("#chars").click(function()
	{
    	window.location.href = '../html/charselect.html';
	}
);
$("#account").click(function()
	{
   	 	window.location.href = '../html/account.html';
	}
);
$("#dmtools").click(function()
	{
   	 	window.location.href = '../html/dmtools.html';
	}
);