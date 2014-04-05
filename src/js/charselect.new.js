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
            $("#charlist").append('<li value='+i+'><input id="cb'+i+'" name="cb'+i+'" type="checkbox"><label for="cb'+i+'"><span></span><span>'+d[i]['charname']+'</span><span></span></label></li>');
		}

		//char selected
		$('#charlist li').click(function()
		{
			$.ajax(
			{
				url:'../php/init.php',
				type:'POST',
				data:{cc:d[this.value]['charname']},
				success:function(data)
				{
					data='';
				}
			});
			setTimeout("window.location.href='../html/charactersheet.html?char="+new Date().getTime()+"';",300);
		});
	},
	fail: function() {
		console.log('unable to send charlist query');
	}
});

//hide/reveal character check boxes
$('#visibility-toggle').click(function(){
  if ( $('.me-select label::before').css('visibility') == 'hidden' )
    $('.me-select label::before').css('visibility','visible');
  else
    $('.me-select label::before').css('visibility','hidden');
});
$(document).on('click', '#visibility-toggle',  function(event) {
    $("input[type=checkbox], #checkbox,  .controls-toggle").fadeToggle(150);
    $("#visibility-toggle").toggleClass("darkgreen");
});
