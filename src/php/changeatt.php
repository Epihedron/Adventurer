<?php
	session_start();
	$user=$_SESSION['user'];

	//function for changing attributes
	function changeatt($x,$y,$z)
	{
		$user=$_SESSION['user'];
		$cf=file_get_contents("../json/chars/$user/$user"."list.json");
		$cd=json_decode($cf);
		foreach($cd as $p)
		{
			foreach($p as $g)
			{
				foreach($g as $o)
				{
					if($o == $z)
					{
						;
						break;
					}
				}
			}
		}
	}

	//change name
	if(isset($_POST['chngname']) && isset($_POST['ogname']))
	{
		$ogname=$_POST['ogname'];
		$newname=$_POST['chngname'];

		$charfile=file_get_contents("../json/chars/$user/$user"."list.json");
		$chardata=json_decode($charfile);
		foreach($chardata as $v)
		{
			foreach($v as $i)
			{
				foreach($i as &$t)
				{
					if($t == $ogname)
					{
						$t=$newname;
						print_r($newname);
						break;
					}
					else
					{
						break;
					}
				}
			}
		}
		$findata=json_encode($chardata);
		print_r($findata);
		file_put_contents("../json/chars/$user/$user"."list.json", $findata);
	}

	//change class
	if(isset($_POST['class']))
	{
		$a='class';
		$b=$_POST['class'];
		$c=$_POST['character'];
		echo changeatt($a,$b,$c);
	}
?>