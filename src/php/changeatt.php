<?php
	session_start();
	$user=$_SESSION['user'];

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
?>