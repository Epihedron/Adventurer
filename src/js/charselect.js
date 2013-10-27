var user;
//logincheck
$.ajax({
    url:'../php/init.php',
    type:'post',
    data:{userquery:1},
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
            var playerurl='../json/chars/'+user+'/'+user+'list.json';
            $.ajax(
            {
                url:playerurl,
                type:"GET",
                error:function()
                {
                    $("#charlist").text('You have no characters.');
                }
            }
            ).done(function(data)
                {
                    var i;
                    console.log(JSON.stringify(data));
                    for(i in data)
                    {
                        $("#charlist").append("<li value="+i+">"+data[i]['Basic Info']['character']+"</li>");
                    }
                    $("#charlist li").click(function()
                    {
                        var charsheet;
                        $.ajax(
                            {
                                url:'../php/init.php',
                                type:'POST',
                                data:{cc:data[this.value]['Basic Info']['character']},
                                success:function(data)
                                {
                                    console.log(data+' sent successfully');
                                },
                                error:function(e)
                                {
                                    alert('err');
                                }
                            });
                        setTimeout("window.location.href='../html/charactersheet.html';",300)
                    }
                );
                }
            );
        }
    }
);
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
$("#delchar").click(function()
{
    var p1=prompt("Enter character's name(CaSe SeNsItIvE):");
    var p2=prompt("Measure twice, cut once:");
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
        );
    }
    else
    {
        alert('The names did not match.');
    }
});