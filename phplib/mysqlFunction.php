<?php
function connectMysql()
{
//address
	$localUrl="127.0.0.1";
//user
	$localUser="root";
//password
	$localPassword="ytfy1032744819";
	$dataBaseConnect=mysql_connect($localUrl,$localUser,$localPassword);

	if(!$dataBaseConnect)
	{
		die("connect failed" . mysql_error());
	}else
	{
		mysql_query("set names 'utf8'");
	}
	return $dataBaseConnect;
}

?>
