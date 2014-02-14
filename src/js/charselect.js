var user;
//logincheck
$.ajax({
    url:'../php/init.php',
    type:'post',
    data:{'userquery':1},
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
                $('#user').text(user);
            }
            var playerurl='../json/chars/'+user+'/'+user+'list.json?nocache='+(new Date()).getTime();

            //getting characters from character list
            //$.ajax(
            //{
            //    url:playerurl,
            //    success:function(data)
            //    {
            //        var i;
            //        console.log(JSON.stringify(data));
            //        console.log('on');
            //        for(i in data)
            //        {
            //            $("#charlist").append("<li value="+i+">"+data[i]['Basic Info']['character']+"</li>");
            //        }
            //        //character selected
            //        $("#charlist li").click(function()
            //        {
            //            var charsheet;

            //            //sending current character selection to players init
            //            $.ajax(
            //                {
            //                    url:'../php/init.php',
            //                    type:'POST',
            //                    data:{cc:data[this.value]['Basic Info']['character']},
            //                    success:function(data)
            //                    {
            //                        console.log(data+' sent successfully');
            //                        data='';
            //                    },
            //                    error:function(e)
            //                    {
            //                        alert('err');
            //                    }
            //                });
            //            setTimeout("window.location.href='../html/charactersheet.html';",300)
            //        }
            //    );
            //    },
            //    error:function()
            //    {
            //        $("#charlist").text('You have no characters.');
            //    }
            //}
            //)
        }
    }
);

//ajax for character list
$.ajax({
	url:'../php/init.php',
	type:'post',
	data:{'charlistquery':1},
	success:function(data)
	{
		var d = JSON.parse(data);
		for(var i in d)
		{
			$("#charlist").append("<li value="+i+">"+d[i]+"</li>");
		}

		//char selected
		$('#charlist li').click(function()
		{
			$.ajax(
			{
				url:'../php/init.php',
				type:'POST',
				data:{cc:d[this.value]},
				success:function(data)
				{
					console.log(data+' sent successfully');
					data='';
				}
			});
			setTimeout("window.location.href='../html/charactersheet.html';",300)
		});
	}
});

//basic menu button items
$("#tomain").click(function()
    {
        window.location.href='../html/main.html';
    }
);
$("#logout").click(function()
    {
        window.location.href='../php/logout.php';
    }
);
$("#newchar").click(function()
    {
        window.location.href='../html/newchar.html';
    }
);

//delete character
$("#delchar").click(function()
{
    var p1=prompt("Enter character's name(CaSe SeNsItIvE):");
    if(p1 != null)
        {
            var p2=prompt("Measure twice, cut once:");
            if(p2 != null)
                {
                    if(p1==p2)
                        {
                            $.ajax(
                                {
                                    url:"../php/init.php",
                                    type:"POST",
                                    data:{"delchar":p2},
                                    success:function(data)
                                    {
                                        alert(data);
                                    },
                                    error:function(err)
                                    {
                                        alert("An error was thrown:"+JSON.stringify(err));
                                    }
                                }
                            ).done(function(){location.reload(true);});
                        }
                    else
                        {
                            alert('The names did not match.');
                        }
                }
        }
});
