var n = new Date();
var d = n.toDateString();
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
            window.location.href='../../index.html';
        }
        else
        {
            $("#user").text(data);
        }
    },
    error:function()
    {
        alert('ajax encounter a problem');
    }
});
//submission with validation
$('#submit').click(function ()
{
    var err = 0;
    
    $('input').each(function()
    {
        if($(this).val().length == 0)
        {
            err += 1;
            if(!$(this).next().text())
            {
                $(this).after('<span class="badresult">&#10539;</span>');
            }
        }
        else 
        {
            if($(this).next().text())
            {
                $(this).next().text('');
            }
        }
    });
    if(err>0)
    {
        alert('There are ' + err + ' fields missing. Please fill them all.');
    }
    else
    {
        $('#newcharform').submit();
    }
});
//validate to make sure field is a number
function isNumberKey(evt)
{
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
$('input').blur(function()
{
    if(!$(this).val())
    {
        if(!$(this).next().text())
        {
            $(this).after('<span class="badresult">&#10539;</span>');
        }
    }
    else if($(this).next().text())
    {
        $(this).next().text('');
    }
});
$('#date').text(d);
//to main button
$(".menubutton:nth-child(2)").click(function()
    {
        window.location.href='../html/charselect.html'
    }
);
//after document loads
$(document).ready(function()
{
    //back and forward buttons
    var i = 0;
    var imax = 9;
    var imin = 0;
    $('fieldset').hide();
    $('#basicinfo').show();
    $('#forward').click(function()
        {
            if(i>=imin && i<imax)
            {
                $('fieldset:eq('+i+')').hide();
                i=i+1;
                $('fieldset:eq('+i+')').show();
            }
            else if(i==imax)
            {
                $('fieldset:eq('+i+')').hide();
                i=imin;
                $('fieldset:eq('+i+')').show();
            }
        }
    );
    $('#backward').click(function()
        {
            if(i>imin && i<=imax)
            {
                $('fieldset:eq('+i+')').hide();
                i=i-1;
                $('fieldset:eq('+i+')').show();
            }
            else if(i==imin)
            {
                $('fieldset:eq('+i+')').hide();
                i=imax;
                $('fieldset:eq('+i+')').show();
            }
        }
    );
    //test button
    $(".menubutton:nth-child(3)").click(function()
        {

        }
    );

    //adding fields to chosen group inputs
    // function adddelfield(x)
    // {
    //     x.append("<input type='text'maxchar='100'class='lgtxt'/><img class='deletebutton'/>");
    //     $('.deletebutton').click(function()
    //         {
    //             $(this).prev().remove();
    //             $(this).remove();
    //         }
    //     );
    // }
    $('#addracefeature').click(function()
        {
            $('#racefeaturelist').append("<img onclick='$(this).next().remove(),$(this).remove()'class='deletebutton'/><li><input name='rfeat[]'type='text'maxchar='100'class='lgtxt'/></li>");
        }
    );
    $('#addclassfeature').click(function()
        {
            $('#classfeaturelist').append("<img onclick='$(this).next().remove(),$(this).remove()'class='deletebutton'/><li><input name-'cfeat[]'type='text'maxchar='100'class='lgtxt'/></li>");
        }
    );
    $('#addfeat').click(function()
        {
            $('#featslist').append("<img onclick='$(this).next().remove(),$(this).remove()'class='deletebutton'/><li><input name='feat[]'type='text'maxchar='100'class='lgtxt'/></li>");
        }
    );
    $('#addlang').click(function()
        {
            $('#langslist').append("<img class='deletebutton'/><li><input type='text'maxchar='100'class='lgtxt'/></li>");
            $('.deletebutton').click(function()
                {
                    $(this).next().remove();
                    $(this).remove();
                }
            );
        }
    );
    $('#addatwill').click(function()
        {
            $('#atwillplist').append("<img class='deletebutton'/><li><input type='text'maxchar='100'class='lgtxt'/></li>");
            $('.deletebutton').click(function()
                {
                    $(this).next().remove();
                    $(this).remove();
                }
            );
        }
    );
    $('#addenc').click(function()
        {
            $('#encplist').append("<img class='deletebutton'/><li><input type='text'maxchar='100'class='lgtxt'/></li>");
            $('.deletebutton').click(function()
                {
                    $(this).next().remove();
                    $(this).remove();
                }
            );
        }
    );
    $('#adddaily').click(function()
        {
            $('#dailyplist').append("<img class='deletebutton'/><li><input type='text'maxchar='100'class='lgtxt'/></li>");
            $('.deletebutton').click(function()
                {
                    $(this).next().remove();
                    $(this).remove();
                }
            );
        }
    );
    $('#addinv').click(function()
        {
            $('#invlist').append("<img class='deletebutton'/><li><input type='text'maxchar='100'class='lgtxt'/></li>");
            $('.deletebutton').click(function()
                {
                    $(this).next().remove();
                    $(this).remove();
                }
            );
        }
    );
    $('#addutil').click(function()
        {
            $('#utilityplist').append("<img class='deletebutton'/><li><input type='text'maxchar='100'class='lgtxt'/></li>");
            $('.deletebutton').click(function()
                {
                    $(this).next().remove();
                    $(this).remove();
                }
            );
        }
    );
});