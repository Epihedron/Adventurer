//date
var n = new Date();
var d = n.toDateString();
$('#date').text(d);

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
            $("#username").text(data);
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

//validate to make sure certain fields are a number
function isNumberKey(evt)
{
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}

//validation on input escape
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

//back to main page button
$(".menubutton:nth-child(2)").click(function()
    {
        window.location.href='../html/main.html'
    }
);

//after document loads code in this function will execute
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

    //additional input fields
    $('#addracefeature').click(function()
        {
            $('#racefeaturelist').append("<div class='col-xs-10'><input class='form-control' name='rfeat[]'type='text'maxchar='100'/></div><div class='col-xs-2 button-glyphicon'><span class='glyphicon glyphicon-remove-circle' id='removeitem'></span></div>");
        }
    );
    $('#addclassfeature').click(function()
        {
            $('#classfeaturelist').append("<div class='col-xs-10'><input class='form-control' name='cfeat[]'type='text'maxchar='100'/></div><div class='col-xs-2 button-glyphicon'><span class='glyphicon glyphicon-remove-circle' id='removeitem'></span></div>");
        }
    );
    $('#addfeat').click(function()
        {
            $('#featslist').append("<div class='col-xs-10'><input class='form-control' name='feat[]'type='text'maxchar='100'/></div><div class='col-xs-2 button-glyphicon'><span class='glyphicon glyphicon-remove-circle' id='removeitem'></span></div>");
        }
    );
    $('#addlang').click(function()
        {
            $('#langslist').append("<div class='col-xs-10'><input class='form-control' name='lang[]'type='text'maxchar='100'/></div><div class='col-xs-2 button-glyphicon'><span class='glyphicon glyphicon-remove-circle' id='removeitem'></span></div>");
        }
    );
    $('#addatwill').click(function()
        {
            $('#atwillplist').append("<div class='col-xs-10'><input class='form-control' name='atwill[]'type='text'maxchar='100'/></div><div class='col-xs-2 button-glyphicon'><span class='glyphicon glyphicon-remove-circle' id='removeitem'></span></div>");
        }
    );
    $('#addenc').click(function()
        {
            $('#encplist').append("<div class='col-xs-10'><input class='form-control' name='enc[]'type='text'maxchar='100'/></div><div class='col-xs-2 button-glyphicon'><span class='glyphicon glyphicon-remove-circle' id='removeitem'></span></div>");
        }
    );
    $('#adddaily').click(function()
        {
            $('#dailyplist').append("<div class='col-xs-10'><input class='form-control' name='daily[]'type='text'maxchar='100'/></div><div class='col-xs-2 button-glyphicon'><span class='glyphicon glyphicon-remove-circle' id='removeitem'></span></div>");
        }
    );
    $('#addutil').click(function()
        {
            $('#utilityplist').append("<div class='col-xs-10'><input class='form-control' name='util[]'type='text'maxchar='100'/></div><div class='col-xs-2 button-glyphicon'><span class='glyphicon glyphicon-remove-circle' id='removeitem'></span></div>");
        }
    );
    $('#addinv').click(function()
        {
            $('#invlist').append("<div class='col-xs-10'><input class='form-control' name='inv[]'type='text'maxchar='100'/></div><div class='col-xs-2 button-glyphicon'><span class='glyphicon glyphicon-remove-circle' id='removeitem'></span></div>");
        }
    );
    $(document).on('click', '#removeitem' , function() {
        $(this).parent().prev().remove(),$(this).parent().remove();
    });
});


