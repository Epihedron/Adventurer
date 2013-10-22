$('#chngpass').hide();
$('#cplbl').click(function ()
    {
        $('#chngpass').slideToggle();
    }
);
function clearpassfields()
{
    document.getElementById('oldpass').value = '';
    document.getElementById('newpassagain').value = '';
    document.getElementById('newpass').value = '';
}
$(".menubutton:nth-child(1)").click(function()
	{
		window.location.href='../html/main.html';
	}
);
$(".menubutton:nth-child(2)").click(function()
	{
		window.location.href='../php/logout.php';
	}
);