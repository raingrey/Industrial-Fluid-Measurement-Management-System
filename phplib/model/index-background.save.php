<?php
function saveUpLoadBasicAttr($post)
{
////////////////////////////////////////////////////////////在RailedMeterSet中，添加基础流量信息
	if(checkBasicAttrNameExist($post)!=null)
	{
		$sql=getUpdateSQL("RailedMeterSet",$post)." where companyname='".$_SESSION[company]."' and basicattrname='".$post[basicattrname]."'";
		$r="更新";
	}
	else
	{
		$sql=getInsertSQL("RailedMeterSet",$post);
		$r="插入";
	}
	$a=mysql_query($sql);
////////////////////////////////////////////////////////////在仪表归属中，添加仪表管理组成员
	$sql="select basicattrname,员工及职位 from 仪表归属 where companyname='".$_SESSION[company]."' and basicattrname='".$post[basicattrname]."'";
	$unitRes=mysql_query($sql);
	$d=false;
	while($result=mysql_fetch_array($unitRes))
	{
		$d=true;
		if($result['basicattrname']!=null)
		{
			$b=false;
			foreach($post[adminname] as $item => $value)//对比每一个adminname是否被设定
				if(result['员工及职位']==$value)
					$b=true;
			if(!$b)//查出的管理员不在传入的成员中
			{
				$sql="insert into 仪表归属(basicattrname,companyname,员工及职位,unitname) value ('".$post[basicattrname]."','".$_SESSION[company]."','".$value."','".$post[unitname]."')";
				$a=$a&mysql_query($sql);
				$sql="delete from 仪表归属 where basicattrname='".post[basicattrname]."' and companyname='".$_SESSION[company]."' and 员工及职位='".$value."'";
				$a=$a&mysql_query($sql);
			}
		}
	}
	if(!$d)//没有搜索到成员,则直接存储
	{
		$b=false;
		foreach($post[adminname] as $item => $value)
		{
			$sql="insert into 仪表归属(basicattrname,companyname,员工及职位,unitname) value ('".$post[basicattrname]."','".$_SESSION[company]."','".$value."','".$post[unitname]."')";
			$a=$a&mysql_query($sql);
		}
	}
////////////////////////////////////////////////////////////在可连接仪表单元中，添加仪表连接单元
	$sql="select basicattrname from 仪表位置 where companyname='".$_SESSION[company]."' and basicattrname='".$post[basicattrname]."'";
	$unitRes=mysql_query($sql);
	$result=mysql_fetch_array($unitRes);
	if($result['basicattrname']!=null)
	{
		$b="";
		$i=1;
		foreach($post[unitconnect] as $item => $value)
		{
			$b=$b.",相邻仪表序列号".$i."='".$value."'";
			$i++;
			if($i>10)	break;
		}
		$sql="update 仪表位置 set basicattrname='".$post."'".$b."where companyname='".$_SESSION[company]."' and basicattrname='".$post[basicattrname]."'";
	}
	else
	{
		$b="";
		$c="";
		$i=1;
		foreach($post[unitconnect] as $item => $value)
		{
			$b=$b.",相邻仪表序列号".$i;
			$c=$c.",'".$value."'";
			$i++;
		}
		$sql="insert into 仪表位置(basicattrname,companyname".$b.") value ('".$post[basicattrname]."','".$_SESSION[company]."'".$c.")";
	}
	$a=$a&mysql_query($sql);
	mysql_close($dataBaseConnect);
	if($a)	return $r."成功";
	else 	return $r."失败";
}



function saveUpLoadTransmitter($post)
{
	if(checkBasicAttrNameExist($post)!=null)
	{
		$sql="select basicattrname from 传感器信息 where companyname='".$_SESSION[company]."' and basicattrname='".$post[basicattrname]."' and sensorname='".$post[sensorname]."'";
		$unitRes=mysql_query($sql);
		$res=mysql_fetch_array($unitRes);
		if($res!=null)
		{
			$sql=getUpDateSQL('传感器信息',$post)." where companyname='".$_SESSION[company]."' and basicattrname='".$post[basicattrname]."' and sensorname='".$post[sensorname]."'";//此处为防止其他传感器信息被覆盖，同一序列号，同一sensorname才可写入
			$r="更新";
		}
		else
		{
			$sql=getInsertSQL('传感器信息',$post);
			$r="插入";
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



function saveUpLoadPrimaryElement($post)
{
	if(checkBasicAttrNameExist($post)!=null)
	{
////////////////////////仪表属性之一次元件的sql
		$sql="select basicattrname from 仪表属性之一次元件 where companyname='".$_SESSION[company]."' and basicattrname='".$post[basicattrname]."'";
		$unitRes=mysql_query($sql);
		$res=mysql_fetch_array($unitRes);
		if($res!=null)
		{
			$sql1=getUpDateSQL("仪表属性之一次元件",$post)." where companyname='".$_SESSION[company]."' and basicattrname='".$post[basicattrname]."'";
			$x1="更新";
		}
		else
		{
			$sql1=getInsertSQL("仪表属性之一次元件",$post); 
			$x1="插入";
		}
////////////////////////仪表属性之系数的sql
		$sql="select basicattrname from 仪表属性之系数 where companyname='".$_SESSION[company]."' and basicattrname='".$post[basicattrname]."'";
		$unitRes=mysql_query($sql);
		$res=mysql_fetch_array($unitRes);
		if($res!=null)
		{
			$sql2=getUpDateSQL("仪表属性之系数",$post)." where companyname='".$_SESSION[company]."' and basicattrname='".$post[basicattrname]."'";
			$x2="更新";
		}
		else
		{
			$sql2=getInsertSQL("仪表属性之系数",$post);
			$x2="插入";
		}
	}
	else
	{
		mysql_close($dataBaseConnect);
		return "未知位号";
	}
	$r1=mysql_query($sql1);
	$r2=mysql_query($sql2);
	mysql_close($dataBaseConnect);
	if($r1&$r2)	return $x1.$x2."成功";
	else	return $x1.$x2."失败";
}



function saveUpLoadOperatingParameters($post)
{
///////////先判断basicattrname是否已有
	if(checkBasicAttrNameExist($post)!=null)
	{
/////////有了的话就可以存储
		$sql="select basicattrname from 仪表属性之工况 where companyname='".$_SESSION[company]."' and basicattrname='".$post[basicattrname]."'";
		$unitRes=mysql_query($sql);
		$res=mysql_fetch_array($unitRes);
//////////检查是否已存在此工况参数
		if($res!=null)
		{
/////////存在的话就覆盖掉
			$sql=getUpDateSQL("仪表属性之工况",$post)." where companyname='".$_SESSION[company]."' and basicattrname='".$post[basicattrname]."'";
			$r="更新";
		}
		else
		{
/////////不存在的话就新建
			$sql=getInsertSQL("仪表属性之工况",$post);
			$r="插入";
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


function saveUpLoadCommunicationParameters($post)
{
///////////先判断basicattrname是否已有
	if(checkBasicAttrNameExist($post)!=null)
	{
/////////有了的话就可以存储
		$sql="select basicattrname from 仪表属性之通讯 where companyname='".$_SESSION[company]."' and basicattrname='".$post[basicattrname]."'";
		$unitRes=mysql_query($sql);
		$res=mysql_fetch_array($unitRes);
//////////检查是否已存在此工况参数
		if($res!=null)
		{
/////////存在的话就覆盖掉
			$sql=getUpDateSQL("仪表属性之通讯",$post)." where companyname='".$_SESSION[company]."' and basicattrname='".$post[basicattrname]."'";
			$r="更新";
		}
		else
		{
/////////不存在的话就新建
			$sql=getInsertSQL("仪表属性之通讯",$post);
			$r="插入";
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


function checkBasicAttrNameExist($post)
{
	$dataBaseConnect=connectMysql();
	mysql_select_db("DGsql",$dataBaseConnect);
	$sql="select basicattrname from RailedMeterSet where companyname='".$_SESSION[company]."' and basicattrname='".$post[basicattrname]."'";
	$unitRes=mysql_query($sql);
	return mysql_fetch_array($unitRes);

}
function getUpDateSQL($column,$post)//包含公共字段：basicattr/companyname
{
	$dataBaseConnect=connectMysql();
	mysql_select_db("DGsql",$dataBaseConnect);
	$sql="select COLUMN_NAME from information_schema.COLUMNS where table_name='".$column."' and table_schema='DGsql'";//先确定要存的数据有对应字段
	$unitRes=mysql_query($sql);
	$x="update ".$column." set basicattrname='".$post[basicattrname]."',companyname='".$_SESSION[company]."'";
	while($result=mysql_fetch_array($unitRes))
	{
		foreach($post as $item => $value)
			if($item!=basicattrname&&$item!=companyname)
				if($item==$result[0])
				{
					$x=$x.",".$item."='".$value."'";
					break;
				}
	}
	return $x;
}
function getInsertSQL($column,$post)//包含了公共字段：basicattr/companyname
{
	$dataBaseConnect=connectMysql();
	mysql_select_db("DGsql",$dataBaseConnect);
	$sql="select COLUMN_NAME from information_schema.COLUMNS where table_name='".$column."' and table_schema='DGsql'";//先确定要存的数据有对应字段
	$unitRes=mysql_query($sql);
	$a="";
	$b="";
	while($result=mysql_fetch_array($unitRes))
	{
		foreach($post as $item => $value)
			if($item!='basicattrname'&&$item!='companyname')
				if($item==$result[0])
				{
					$a=$a.",".$item;
					$b=$b.",'".$value."'";
					break;
				}
	}
	return "insert into ".$column."(basicattrname,companyname".$a.") value('".$post[basicattrname]."','".$_SESSION[company]."'".$b.")";
}
?>
