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
/******************************************************************

if($post['cmd']=="GFMN"){

	$id=$post['meterid'];
	GetFlowMeterName($id);
	exit(0);
}



if($post['cmd']=="GFMDI"){

	$id=$post['meterid'];
	GetFlowMeterDataInfo($id);
	exit(0);
}
function GetMeterID($saccount){
	if(!is_numeric($saccount)||(strlen($saccount)>10))
		exit(0);
	$sql="select meterID from StaffMeterID where Saccount=".$saccount;
	$res=mysql_query($sql);
	while($result[]=mysql_fetch_array($res));
	echo json_encode($result,JSON_UNESCAPED_UNICODE);
}

function GetFlowMeterName($id){
	if(!is_numeric($id)||(strlen($id)>10))
		exit(0);
	$sql="select meterID,meterName from MeterIdentify where meterID=".$id." order by id desc limit 1";
	$res=mysql_query($sql);
	while($result[]=mysql_fetch_array($res));
	echo json_encode($result,JSON_UNESCAPED_UNICODE);
}

function GetFlowMeterDataInfo($id){
	//print_r($result);
	if(!is_numeric($id)||(strlen($id)>10))
		exit(0);
	$sql="select meterID,ord,dataName,unit from DataIdentify where meterID=".$id;
	$res=mysql_query($sql);
	while($result[]=mysql_fetch_array($res));
	echo json_encode($result,JSON_UNESCAPED_UNICODE);
}

function GetFlowMeterDataPrimary($p){
//	if($p['instantflow']==true)
		$selected= "instantFlow";
//	if($p['totalflow']==true)
		$selected= $selected.",totalFlow";
	//if($p['t']==true)
		$selected= $selected.",T";
	//if($p['p']==true)
		$selected= $selected.",P";
	//if($p['dp']==true)
		$selected= $selected.",DP";
	//if($p['timestamp']==true)
		$selected= $selected.",timestamp";
	$sql="select meterID,".$selected." from MeterDataPrimary where meterID=".$p['meterid']." order by id desc limit 1";
	$res=mysql_query($sql);
	while($result[]=mysql_fetch_array($res));
	echo json_encode($result,JSON_UNESCAPED_UNICODE);
}
function GetFlowMeterDataSecondary($p){
	if($p['order7']==true)
		$selected= "order7,";
	if($p['order8']==true)
		$selected= $selected."order8,";
	if($p['order9']==true)
		$selected= $selected."order9,";
	if($p['order10']==true)
		$selected= $selected."order10,";
	if($p['order11']==true)
		$selected= $selected."order11,";
	if($p['order12']==true)
		$selected= $selected."order12,";
	if($p['order13']==true)
		$selected= $selected."order13,";
	if($p['order14']==true)
		$selected= $selected."order14,";
	if($p['order15']==true)
		$selected= $selected."order15,";
	if($p['order16']==true)
		$selected= $selected."order16,";
	if($p['order17']==true)
		$selected= $selected."order17,";
	if($p['order18']==true)
		$selected= $selected."order18,";
	if($p['order19']==true)
		$selected= $selected."order19,";
	if($p['order20']==true)
		$selected= $selected."order20,";
	if($p['timestamp']==true)
		$selected= $selected."timestamp,";

	$sql="select meterID,".$selected." from MeterDataSecondary where meterID=".$p['meterID']." order by id desc limit 1";
	$res=mysql_query($sql);
	while($result[]=mysql_fetch_array($res));
	echo json_encode($result,JSON_UNESCAPED_UNICODE);



}
******************************************************************/
?>
