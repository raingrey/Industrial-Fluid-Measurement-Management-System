<?php
include('../model/security.php');
include('../model/mysqlFunction.php');
include('../model/index-background.check.php');
include('../model/index-background.save.php');
include('../model/index-background.del.php');
include('../model/index-background.nav.php');

session_start();
if($_SESSION[company]!=null)
{
if($post[command]=="getDGUnit")
{
	$result=getDGUnit($post);
	echo json_encode($result,JSON_UNESCAPED_UNICODE);
}
if($post[command]=="getDGUnitDetail")
{
	$result=getDGUnitDetail($post);
	echo json_encode($result,JSON_UNESCAPED_UNICODE);
}
if($post[command]=="deleteTransmitter")
{
	$result[delete]=deleteTransmitter($post);
	echo json_encode($result,JSON_UNESCAPED_UNICODE);
}
if($post[command]=="upLoadBasicAttr")
{
	$result=checkUpLoadBasicAttr($post);
	if($result[result]=="验证通过")
	{
		$result[save]=saveUpLoadBasicAttr($post);
	}
////////////这儿还没完，还得把存的结果反馈一下
	else if($result[result]=="验证失败")	
	{
	}	
	else 
	{
		$result[result]="通讯失败";
	}
	echo json_encode($result,JSON_UNESCAPED_UNICODE);
}

if($post[command]=="upLoadTransmitter")
{
	$result=checkUpLoadTransmitter($post);
	if($result[result]=="验证通过")
		$result[save]=saveUpLoadTransmitter($post);
	else if($result[result]=="验证失败")
	{
	}	
	else 
	{
		$result[result]="通讯失败";
	}
	echo json_encode($result,JSON_UNESCAPED_UNICODE);
}

if($post[command]=="upLoadPrimaryElement")
{
	$result=checkUpLoadPrimaryElement($post);
	if($result[result]=="验证通过")
		$result[save]=saveUpLoadPrimaryElement($post);
	else if($result[result]=="验证失败")
	{
	}
	else 
	{
		$result[result]="通讯失败";
	}
	echo json_encode($result,JSON_UNESCAPED_UNICODE);
}

if($post[command]=="upLoadOperatingParameters")
{
	$result=checkUpLoadOperatingParameters($post);
	if($result[result]=="验证通过")
		$result[save]=saveUpLoadOperatingParameters($post);
	else if($result[result]=="验证失败")
	{
	}
	else 
	{
		$result[result]="通讯失败";
	}
	echo json_encode($result,JSON_UNESCAPED_UNICODE);
}

if($post[command]=="upLoadCommunicationParameters")
{
	$result=checkUpLoadCommunicationParameters($post);
	if($result[result]=="验证通过")
		$result[save]=saveUpLoadCommunicationParameters($post);
	else if($result[result]=="验证失败")
	{
	}
	else 
	{
		$result[result]="通讯失败";
	}
	echo json_encode($result,JSON_UNESCAPED_UNICODE);
}
}/**/
else
{
		$result[result]="登录失效";
		echo json_encode($result,JSON_UNESCAPED_UNICODE);

}
?>
