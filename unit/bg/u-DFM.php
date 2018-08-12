<?php

/*****************DisplayFlowMeter*****************************/
/*********************************
filename: unit-display flow meter
2017-9-12
@raingrey
made for u-DFM.html
get flow meter data to display
***********************************/
include('../../SecurityAndMysql.php');
if(!isset($_SESSION['account']))
	exit(0);
@$DBC=MysqlCon();
mysql_select_db("tcp",$DBC);
$post=NULL;
$post=postfilter($post);
$post['saccount']=$_SESSION['account'];

if($post['cmd']=="GMID"){
	//this shoule not be $post.this come from session
	$saccount=$post['saccount'];
	GetMeterID($saccount);
	exit(0);
}



if($post['cmd']=="GFMDP"){
	$saccount=$post['saccount'];
	GetFlowMeterDataPrimary($saccount);
	exit(0);
}
if($post['cmd']=="GFMDS"){
	GetFlowMeterDataSecondary($post);
	exit(0);
}
function GetMeterID($saccount){
	if(!is_numeric($saccount)||(strlen($saccount)>10))
		exit(0);
	$sql="select meterID from StaffMeterID where Saccount=".$saccount;
	$res=mysql_query($sql);
	while($resultx=mysql_fetch_array($res)){
		$sql="select a.meterID,a.meterName,b.ord,b.dataName,b.unit from MeterIdentify a join DataIdentify b on a.meterID=b.meterID where a.meterID=".$resultx['meterID'];
		$res0=mysql_query($sql);
		while($result[]=mysql_fetch_array($res0));
	}
	echo json_encode($result,JSON_UNESCAPED_UNICODE);
}
function GetFlowMeterDataPrimary($saccount){
	if(!is_numeric($saccount)||(strlen($saccount)>10))
		exit(0);
	$sql="select meterID from StaffMeterID where Saccount=".$saccount;
	$res=mysql_query($sql);
	while($resultx=mysql_fetch_array($res)){
		$sql="select meterID,instantFlow,totalFlow,T,P,DP,timestamp,sysTime from MeterDataPrimary where meterID=".$resultx['meterID']." order by id desc limit 1";
		$res0=mysql_query($sql);
		while($result[]=mysql_fetch_array($res0));
	}
	echo json_encode($result,JSON_UNESCAPED_UNICODE);
}
function GetFlowMeterDataSecondary($saccount){
	if(!is_numeric($saccount)||(strlen($saccount)>10))
		exit(0);
	$sql="select meterID from StaffMeterID where Saccount=".$saccount;
	$res=mysql_query($sql);
	while($resultx=mysql_fetch_array($res)){
		$sql="select meterID,order7,order8,order9,order10,order11,order12,order13,order14,order15,order16,order17,order18,order19,order20,sysTime,timestamp from MeterDataSecondary where meterID=".$resultx['meterID']." order by id desc limit 1";
		$res0=mysql_query($sql);
		while($result[]=mysql_fetch_array($res0));
	}
	echo json_encode($result,JSON_UNESCAPED_UNICODE);
}

?>
