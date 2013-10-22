var n = new Date();
var d = n.toDateString();
//login check
$.get('../php/main.php',function(data)
{
    var user = $(data).find('#user').text();
    if(user == '')
    {
        alert('YOU MUST LOG IN FOOL!');
        window.location.replace('../../index.html');
    }
    else
    {
        $('#username').text(user);
    }
});
//submission
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
//valid to make sure field is a number
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
});