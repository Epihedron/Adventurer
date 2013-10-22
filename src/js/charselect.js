var user;
//logincheck
$.get('../php/main.php',function(data)
{
    user = $(data).find('#user').text();
    if(user == '')
    {
        alert('YOU MUST LOG IN FOOL!');
        window.location.replace('../../index.html');
    }
    else
    {
        $('#user').text(user);
    }
    var playerurl='../json/chars/'+user+'/'+user+'list.json';

    //charlist
    $.ajax(
    {
        url:playerurl,
        success:function(data)
        {
            var i;
            for(i in data)
            {
                $("#charlist").append("<li value="+i+">"+JSON.stringify(data[i]['Basic Info']['character'])+"</li>");
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
                    setTimeout("window.location.href='../html/charsheet.html';",300)
                });
        },
        error:function()
        {
            $("#charlist").text('You have no characters.');
        }
    });
});
$(".menubutton:nth-child(2)").click(function()
    {
        window.location.href='../html/main.html';
    }
);
$(".menubutton:nth-child(3)").click(function()
    {
        window.location.href='../php/logout.php';
    }
);
$(".menubutton:nth-child(1)").click(function()
    {
        window.location.href='../html/newchar.html';
    }
);
