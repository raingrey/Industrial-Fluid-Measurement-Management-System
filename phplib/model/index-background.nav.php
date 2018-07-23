<?php
function getDGUnit($post)
{
	$dataBaseConnect=connectMysql();
	mysql_select_db("DGsql",$dataBaseConnect);
	if($_SESSION['company']!=null)
	{
		$sql="select basicattrname,unitname from 仪表归属 where companyname='".$_SESSION['company']."' and 员工及职位='".$_SESSION['username']."'";
		$unitRes=mysql_query($sql);
		while($result[]=mysql_fetch_array($unitRes));
		mysql_close($dataBaseConnect);
		return $result;
	}		
	else
	{
		mysql_close($dataBaseConnect);
 		return null;
	}
}

function getDGUnitDetail($post)
{
	$dataBaseConnect=connectMysql();
	mysql_select_db("DGsql",$dataBaseConnect);
	if($_SESSION['company']!=null)
	{
		$sql="select instantflowunit,unitname from RailedMeterSet where companyname='".$_SESSION['company']."' and basicattrname='".$post['basicattrname']."'";
		$unitRes=mysql_query($sql);
		while($result[]=mysql_fetch_array($unitRes));
		mysql_close($dataBaseConnect);

	}		
	else
	{
		mysql_close($dataBaseConnect);
 		return null;
	}
}

?>
