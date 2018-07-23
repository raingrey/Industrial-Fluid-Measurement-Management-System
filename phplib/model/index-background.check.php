<?php
function checkUpLoadBasicAttr($post)
{
	$dataBaseConnect=connectMysql();
	mysql_select_db("DGsql",$dataBaseConnect);
	$result[result]="验证通过";
	if($_SESSION['company']!=null)
	{
		$sql="select ID from RailedMeterSet where basicattrname='".$post[basicattrname]."'";
		$unitRes=mysql_query($sql);
		$res=mysql_fetch_array($unitRes,MYSQL_NUM);
		if($res!=null)
		{
			$result[basicAttrName]="已登记使用的仪表序列号";
			$result[result]="验证失败";
		}
		else	$result[basicAttrName]="可以使用";
		if(preg_match("/^[0-9]+$/",$post[basicattrname]))	$result[basicattrname]="验证通过";
		else
		{
			$result[basicAttrName]="仪表序列号只能为数字";
			$result[result]="验证失败";
		}

		if(preg_match("/^[\x{4e00}-\x{9fa5}A-Z_a-z0-9]+$/u",$post[unitname]))	$result[unitName]="验证通过";
		else 
		{
			$result[unitName]="只能为汉字、大小写字母、数字、下划线";
			$result[result]="验证失败";
		}
		if(preg_match("/^[+-]?[0-9]+(\.[0-9]+)?$/",$post[instantflowlowerlimit]))	$result[instantFlowLowerLimit]="验证通过";
		else
		{
			$result[instantFlowLowerLimit]="瞬时流量下限只能为实数";
			$result[result]="验证失败";
		}
		if(preg_match("/^[+-]?[0-9]+(\.[0-9]+)?$/",$post[instantflowlowerlimit]))	$result[instantFlowLowerLimit]="验证通过";
		else
		{
			$result[instantFlowLowerLimit]="瞬时流量下限只能为实数";
			$result[result]="验证失败";
		}
		if(preg_match("/^[+-]?[0-9]+(\.[0-9]+)?$/",$post[instantflowalarmupperlimit])||$post[instantflowalarmupperlimit]==null)	$result[instantFlowAlarmUpperLimit]="验证通过";
		else	
		{
			$result[instantFlowAlarmUpperLimit]="瞬时流量报警上限只能为实数";
			$result[result]="验证失败";
		}
		if(preg_match("/^[+-]?[0-9]+(\.[0-9]+)?$/",$post[instantflowalarmlowerlimit])||$post[instantflowalarmlowerlimit]==null)	$result[instantFlowAlarmLowerLimit]="验证通过";
		else 
		{
			$result[instantFlowAlarmLowerLimit]="瞬时流量报警下限只能为数字";
			$result[result]="验证失败";
		}
		mysql_close($dataBaseConnect);
		return $result;
	}
	$result[result]="验证失败";
	mysql_close($dataBaseConnect);
	return $result;
}



function checkUpLoadTransmitter($post)
{
	@$dataBaseConnect=connectMysql();
	mysql_select_db("DGsql",$dataBaseConnect);
	$result[result]="验证通过";
	if($_SESSION[company]!=null)
	{
		$sql="select basicattrname from RailedMeterSet where companyname='".$_SESSION['company']."' and basicattrname='".$post[basicattrname]."'";
		$unitRes=mysql_query($sql);
		$res=mysql_fetch_array($unitRes,MYSQL_NUM);
		if($res==null)
		{
			$result[result]="验证失败";
			$result[basicAttrName]="未知位号";
		}
		else	$result[basicAttrName]="确定位号";
		if(preg_match("/^[\x{4e00}-\x{9fa5}A-Z_a-z0-9]+$/u",$post[sensorname]))	$result[sensorname]="验证通过";
		else
		{
			$result[sensorName]="传感器名称存在非法字符";
			$result[result]="验证失败";
		}
		if(preg_match("/^[+-]?[0-9]+(\.[0-9]+)?$/",$post[sensorsignalupperlimit]))	$result[sensorSignalUpperLimit]="验证通过";
		else
		{
			$result[sensorSignalUpperLimit]="传感器信号上限只能为数字";
			$result[result]="验证失败";
		}
		if(preg_match("/^[+-]?[0-9]+(\.[0-9]+)?$/",$post[sensorsignallowerlimit]))	$result[sensorSignalLowerLimit]="验证通过";
		else
		{
			$result[sensorSignalLowerLimit]="传感器信号下限只能为数字";
			$result[result]="验证失败";
		}

		if(preg_match("/^[+-]?[0-9]+(\.[0-9]+)?$/",$post[sensoralarmupperlimit])||$post[sensoralarmupperlimit]==null)	$result[sensorSignalAlarmUpperLimit]="验证通过";
		else
		{
			$result[sensorSignalAlarmUpperLimit]="传感器信号报警上限只能为数字";
			$result[result]="验证失败";
		}
		if(preg_match("/^[+-]?[0-9]+(\.[0-9]+)?$/",$post[sensoralarmlowerlimit])||$post[sensoralarmlowerlimit]==null)	$result[sensorSignalAlarmLowerLimit]="验证通过";
		else
		{
			$result[sensorSignalAlarmLowerLimit]="传感器信号报警下限只能为数字";
			$result[result]="验证失败";
		}
		if(preg_match("/^[+-]?[0-9]+(\.[0-9]+)?$/",$post[sensorfixedvalue])||$post[sensorfixedvalue]==null)	$result[sensorFixedValue]="验证通过";
		else
		{
			$result[sensorFixedValue]="传感器信号固定值只能为整数";
			$result[result]="验证失败";
		}
		if(preg_match("/^[+-]?[0-9]+(\.[0-9]+)?$/",$post[sensordampingtime])||$post[sensordampingtime]==null)	$result[sensorDampingTime]="验证通过";
		else
		{
			$result[sensorDampingTime]="阻尼时间只能为整数";
			$result[result]="验证失败";
		}
		if(preg_match("/^[+-]?[0-9]+(\.[0-9]+)?$/",$post[sensorsmallsignalresection])||$post[sensorsmallsignalresection]==null)	$result[sensorSmallSignalResection]="验证通过";
		else
		{
			$result[sensorSmallSignalResection]="阻尼时间只能为整数";
			$result[result]="验证失败";
		}
		mysql_close($dataBaseConnect);
		return $result;
	}
	mysql_close($dataBaseConnect);
	$result[result]="验证失败";
	return $result;
}



function checkUpLoadPrimaryElement($post)
{
	@$dataBaseConnect=connectMysql();
	mysql_select_db("DGsql",$dataBaseConnect);
	$result[result]="验证通过";
	if($_SESSION[company]!=null)
	{
		$sql="select basicattrname from RailedMeterSet where companyname='".$_SESSION['company']."' and basicattrname='".$post[basicattrname]."'";
		$unitRes=mysql_query($sql);
		$res=mysql_fetch_array($unitRes,MYSQL_NUM);
		if($res==null)
		{
			$result[result]="验证失败";
			$result[basicAttrName]="未知位号";
		}
		else	$result[basicAttrName]="确定位号";
		if(preg_match("/^[\x{4e00}-\x{9fa5}A-Z_a-z0-9]+$/u",$post[primaryelementname]))	$result[primaryElementName]="验证通过";
		else
		{
			$result[primaryElementName]="一次元件名称存在非法字符";
			$result[result]="验证失败";
		}
		if(preg_match("/^[+-]?[0-9]+(\.[0-9]+)?$/",$post[orificediameter]))	$result[orificeDiameter]="验证通过";
		else
		{
			$result[orificeDiameter]="管径只能为实数";
			$result[result]="验证失败";
		}
		if(preg_match("/^[+-]?[0-9]+(\.[0-9]+)?$/",$post[throttleelementexpansion])||$post[throttleelementexpansion]==null)	$result[throttleElementExpansion]="验证通过";
		else
		{
			$result[throttleElementExpansion]="节流件膨胀系数只能为实数";
			$result[result]="验证失败";
		}
		if(preg_match("/^[+-]?[0-9]+(\.[0-9]+)?$/",$post[kpoint1]))$result[kPoint1]="验证通过";
		else
		{
			$result[kPoint1]="K系数只能为实数";
			$result[result]="验证失败";
		}
		if(preg_match("/^[[0-9]$/",$post[kPoint2])||$post[kPoint2]==null)	$result[kPoint2]="验证通过";
		else
		{
			$result[kPoint2]="K系数只能为实数";
			$result[result]="验证失败";
		}
		if(preg_match("/^[+-]?[0-9]+(\.[0-9]+)?$/",$post[kpoint3])||$post[kpoint3]==null)	$result[kPoint3]="验证通过";
		else
		{
			$result[kPoint3]="K系数只能为实数";
			$result[result]="验证失败";
		}
		if(preg_match("/^[+-]?[0-9]+(\.[0-9]+)?$/",$post[kPoint4])||$post[kPoint4]==null)	$result[kPoint4]="验证通过";
		else
		{
			$result[kPoint4]="K系数只能为实数";
			$result[result]="验证失败";
		}
		if(preg_match("/^[+-]?[0-9]+(\.[0-9]+)?$/",$post[kpointinterval1])||$post[kpointinterval1]==null)	$result[kPointInterval1]="验证通过";
		else
		{
			$result[kPointInterval1]="K系数使用上界只能为实数";
			$result[result]="验证失败";
		}
											if(preg_match("/^[+-]?[0-9]+(\.[0-9]+)?$/",$post[kpointinterval2])||$post[kpointinterval2]==null)	$result[kPointInterval2]="验证通过";
		else
		{
			$result[kPointInterval2]="K系数使用上界只能为实数";
			$result[result]="验证失败";
		}
												if(preg_match("/^[+-]?[0-9]+(\.[0-9]+)?$/",$post[kpointinterval3])||$post[kpointinterval3]==null)	$result[kPointInterval3]="验证通过";
		else
		{
			$result[kPointInterval3]="K系数使用上界只能为实数";
			$result[result]="验证失败";
		}
													if(preg_match("/^[+-]?[0-9]+(\.[0-9]+)?$/",$post[kpointinterval4])||$post[kpointinterval4]==null)	$result[kPointInterval4]="验证通过";
		else
		{
			$result[kPointInterval4]="K系数使用上界只能为实数";
			$result[result]="验证失败";
		}
		if(preg_match("/^[+-]?[0-9]+(\.[0-9]+)?$/",$post[c_vcone])||$post[c_vcone]==null)	$result[C_Vcone]="验证通过";
		else
		{
			$result[C_Vcone]="V锥的流出系数只能为实数";
			$result[result]="验证失败";
		}
		mysql_close($dataBaseConnect);
		return $result;
	}
	mysql_close($dataBaseConnect);
	$result[result]="验证失败";
	return $result;
}

function checkUpLoadOperatingParameters($post)
{
	@$dataBaseConnect=connectMysql();
	mysql_select_db("DGsql",$dataBaseConnect);
	$result[result]="验证通过";
	if($_SESSION[company]!=null)
	{
		$sql="select basicattrname from RailedMeterSet where companyname='".$_SESSION['company']."' and basicattrname='".$post[basicattrname]."'";
		$unitRes=mysql_query($sql);
		$res=mysql_fetch_array($unitRes,MYSQL_NUM);
		if($res==null)
		{
			$result[result]="验证失败";
			$result[basicAttrName]="未知位号";
		}
		else	$result[basicAttrName]="确定位号";
		if(preg_match("/^[\x{4e00}-\x{9fa5}A-Z_a-z0-9]+$/u",$post[mediumname]))		$result[mediumName]="验证通过";
		else
		{
			$result[mediumName]="介质名称存在非法字符";
			$result[result]="验证失败";
		}
		if(preg_match("/^[+-]?[0-9]+(\.[0-9]+)?$/",$post[localatmospherepressure]))	$result[localAtmospherePressure]="验证通过";
		else
		{
			$result[localAtmospherePressure]="大气压值只能为实数";
			$result[result]="验证失败";
		}
		if(preg_match("/^[+-]?[0-9]+(\.[0-9]+)?$/",$post[pipediameter]))	$result[pipeDiameter]="验证通过";
		else
		{
			$result[pipeDiameter]="管径值只能为实数";
			$result[result]="验证失败";
		}
		if(preg_match("/^[+-]?[0-9]+(\.[0-9]+)?$/",$post[pipeexpansion]))	$result[pipeExpansion]="验证通过";
		else
		{
			$result[pipeExpansion]="管道材质膨胀系数只能为实数";
			$result[result]="验证失败";
		}
		if(preg_match("/^[+-]?[0-9]+(\.[0-9]+)?$/",$post[viscosity]))	$result[viscosity]="验证通过";
		else
		{
			$result[viscosity]="粘度只能为实数";
			$result[result]="验证失败";
		}
		if(preg_match("/^[+-]?[0-9]+(\.[0-9]+)?$/",$post[isentropic]))	$result[isentropic]="验证通过";
		else
		{
			$result[isentropic]="等熵指数只能为实数";
			$result[result]="验证失败";
		}
		if(preg_match("/^[+-]?[0-9]+(\.[0-9]+)?$/",$post[liquidexpansion])||$post[liquidexpansion]==null)	$result[liquisExpansion]="验证通过";
		else
		{
			$result[liquidExpansion]="液体膨胀系数只能为实数";
			$result[result]="验证失败";
		}
		if(preg_match("/^[+-]?[0-9]+(\.[0-9]+)?$/",$post[drydegree])||$post[drydegree]==null)	$result[dryDegree]="验证通过";
		else
		{
			$result[dryDegree]="干度只能为实数";
			$result[result]="验证失败";
		}
		if(preg_match("/^[+-]?[0-9]+(\.[0-9]+)?$/",$post[mediumexpansion])||$post[mediumexpansion]==null)	$result[mediumExpansion]="验证通过";
		else
		{
			$result[mediumExpansion]="V锥的介质膨胀系数只能为实数";
			$result[result]="验证失败";
		}
		if(preg_match("/^[+-]?[0-9]+(\.[0-9]+)?$/",$post[criticaltemperature])||$post[criticaltemperature]==null)	$result[criticalTemperature]="验证通过";
		else
		{
			$result[criticalTemperature]="临界温度只能为实数";
			$result[result]="验证失败";
		}
		if(preg_match("/^[+-]?[0-9]+(\.[0-9]+)?$/",$post[criticalpressure])||$post[criticalpressure]==null)	$result[criticalPressure]="验证通过";
		else
		{
			$result[criticalPressure]="临界压力只能为实数";
			$result[result]="验证失败";
		}
		mysql_close($dataBaseConnect);
		return $result;
	}
	mysql_close($dataBaseConnect);
	$result[result]="验证失败";
	return $result;
}


function checkUpLoadCommunicationParameters($post)
{
	@$dataBaseConnect=connectMysql();
	mysql_select_db("DGsql",$dataBaseConnect);
	$result[result]="验证通过";
	if($_SESSION[company]!=null)
	{
		$sql="select basicattrname from RailedMeterSet where companyname='".$_SESSION['company']."' and basicattrname='".$post[basicattrname]."'";
		$unitRes=mysql_query($sql);
		$res=mysql_fetch_array($unitRes,MYSQL_NUM);
		if($res==null)
		{
			$result[result]="验证失败";
			$result[basicAttrName]="未知位号";
		}
		else	$result[basicAttrName]="确定位号";
	
		if(preg_match("/^[+-]?[0-9]+(\.[0-9]+)?$/",$post[address485])||$post[address485]==null)	$result[address485]="验证通过";
		else
		{
			$result[address485]="485地址只能为数字";
			$result[result]="验证失败";
		}
		if(preg_match("/^[+-]?[0-9]+(\.[0-9]+)?$/",$post[freqmaupperlimit])||$post[freqmaupperlimit]==null)	$result[freqmAUpperLimit]="验证通过";
		else
		{
			$result[freqmAUpperLimit]="频率4-20mA输出上限只能为数字";
			$result[result]="验证失败";
		}

		if(preg_match("/^[+-]?[0-9]+(\.[0-9]+)?$/",$post[freqmalowerlimit])||$post[freqmalowerlimit]==null)	$result[freqmALowerLimit]="验证通过";
		else
		{
			$result[freqmALowerLimit]="频4-20mA输出下限只能为数字";
			$result[result]="验证失败";
		}	
		mysql_close($dataBaseConnect);
		return $result;
	}
	mysql_close($dataBaseConnect);
	$result[result]="验证失败";

	return $result;
}

mysql_close($dataBaseConnect);


?>
