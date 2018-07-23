<?php
function deleteTransmitter($post)
{
	if(checkBasicAttrNameExist_del($post)!=null)
	{
		$sql="select basicattrname from 传感器信息 where companyname='".$_SESSION[company]."' and basicattrname='".$post[basicattrname]."' and sensorname='".$post[sensorname]."'";
		$unitRes=mysql_query($sql);
		$res=mysql_fetch_array($unitRes);
		if($res!=null)
		{
			$sql="delete from 传感器信息 where companyname='".$_SESSION[company]."' and basicattrname='".$post[basicattrname]."' and sensorname='".$post[sensorname]."'";//此处为防止其他传感器信息被覆盖，同一序列号，同一sensorname才可写入
			$r="删除";
		}
	}
	else
	{
		mysql_close($dataBaseConnect);
		return "未知位号";
	}
	$a=mysql_query($sql);
	mysql_close($dataBaseConnect);
	if($a)	return $r."成功";
	else	return $r."失败";

}
function checkBasicAttrNameExist_del($post)
{
	$dataBaseConnect=connectMysql();
	mysql_select_db("DGsql",$dataBaseConnect);
	$sql="select basicattrname from RailedMeterSet where companyname='".$_SESSION[company]."' and basicattrname='".$post[basicattrname]."'";
	$unitRes=mysql_query($sql);
	return mysql_fetch_array($unitRes);

}
?>
