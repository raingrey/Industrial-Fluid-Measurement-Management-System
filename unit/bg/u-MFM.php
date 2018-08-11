<?php

/*****************ManageFlowMeter*****************************/
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

if($post['cmd']=="GMI"){
	//this shoule not be $post.this come from session
	$saccount=$post['saccount'];
	GetMeterID($saccount);
	exit(0);
}

if($post['cmd']=="GDP"){
	$meterid=$post['meterid'];
	GetDataProtocol($meterid);
	exit(0);
}

//SMI	Save Meter Identify data
if($post['cmd']=="UMI"){
	UpdateMeterIdentifyData($post);
	exit(0);
}
//CMI	Cancle Meter Identify data
if($post['cmd']=="CMI"){
	CancleMeterIdentifyData($post);
	exit(0);
}
if($post['cmd']=="SDI"){
	UpdateDataIdentifyData($post);
	exit(0);
}
if($post['cmd']=="CDI"){
	CancleDataIdentifyData($post);
	exit(0);
}
function UpdateDataIdentifyData($post){
	//check if ord is legitimate(smaller than 100)
	if($post['ord']>100){
		$result['meterID']=$post['meterid'];
		$result['result']="阶位错误";
		echo json_encode($result,JSON_UNESCAPED_UNICODE);
		return;
	}


	//check if meterID is legitimate(smaller than %24d)
	//check if meterID is repeat by meterID
	if(!preg_match("/^\d{1,21}$/",$post['meterid'])){
		$result['meterID']=$post['meterid'];
		$result['result']="仪表序列号错误";
		echo json_encode($result,JSON_UNESCAPED_UNICODE);
		return;
	}
	//50 is the max number of dataName
	if(strlen($post['dataname'])>50){
		$result['meterID']=$post['meterid'];
		$result['result']="数据别名字数超出50";
		echo json_encode($result,JSON_UNESCAPED_UNICODE);
		return;
	}
	//0xffff is the max addr if addr is correct
	if($post['modbusaddr']>0xffff){
		$result['meterID']=$post['meterid'];
		$result['result']="ModBus地址超出正常范围";
		echo json_encode($result,JSON_UNESCAPED_UNICODE);
		return;
	}

	//is the max byte number
	if($post['bytenumber']>20){
		$result['meterID']=$post['meterid'];
		$result['result']="数据大小超出可识别范围20";
		echo json_encode($result,JSON_UNESCAPED_UNICODE);
	}
	//28 is the max dataType number
	if($post['datatype']>29){
		$result['meterID']=$post['meterid'];
		$result['result']="数据类型超出可识别范围29";
		echo json_encode($result,JSON_UNESCAPED_UNICODE);
	}
	mysql_query("delete from DataIdentify where meterID=".$post['meterid']." and address=".$post['modbusaddr'])or die(mysql_error());
	if(mysql_query("insert into DataIdentify(ord,meterID,dataName,address,byteNumber,dataType)values(".$post['ord'].",".$post['meterid'].",'".$post['dataname']."',".$post['modbusaddr'].",".$post['bytenumber'].",".$post['datatype'].")")){
		$result['meterID']=$post['meterid'];
		$result['result']="ModBus协议信息已保存";
	}else{
		$result['meterID']=$post['meterid'];
		$result['result']=mysql_error()."详情请致电15304006188";
	}
	echo json_encode($result,JSON_UNESCAPED_UNICODE);
}


function UpdateMeterIdentifyData($post){
	//check if DTUID is legitimate
	//DTUID don't need check repeat,it can repeat
	if(!preg_match("/^\d{15}$/",$post['dtuid'])){
		$result['meterID']=0;
		$result['DTUID']=$post['dtuid'];
		$result['result']="DTUID只能为15位数字";
		echo json_encode($result,JSON_UNESCAPED_UNICODE);
		return;
	}

	//check if modbusAddr is legitimate
	//check if modbusAddr is repeat by DTUID and modbusAddr
	if($post['modbusaddr']<256){
		$sql=mysql_query("select DTUID from MeterIdentify where DTUID=".$post['dtuid']." and deviceNumber=".$post['modbusaddr'])or die(mysql_error());
		$r=mysql_fetch_array($sql);
		if(!empty($r)){
			$result['meterID']=0;
			$result['result']="仪表存在,未检测到修改";
			echo json_encode($result,JSON_UNESCAPED_UNICODE);
			return;
		}

	}else{
		$result['meterID']=0;
		$result['result']="ModBus地址只能为小于256的数字";
		echo json_encode($result,JSON_UNESCAPED_UNICODE);
		return;
	}
	//check if meterID is legitimate(smaller than %24d)
	//check if meterID is repeat by meterID

	if(!preg_match("/^\d{1,21}$/",$post['meterid'])){
			$result['meterID']=$post['meterid'];
			$result['result']="仪表序列号错误";
			echo json_encode($result,JSON_UNESCAPED_UNICODE);
			return;
	}
	mysql_query("delete from MeterIdentify where meterID=".$post['meterid'])or die(mysql_error());
	if(mysql_query("insert into MeterIdentify(meterID,meterName,DTUID,deviceNumber)values(".$post['meterid'].",".$post['metername'].",".$post['dtuid'].",".$post['modbusaddr'].")")){
		$result['meterID']=$post['meterid'];
		$result['result']="仪表信息已保存";
		echo json_encode($result,JSON_UNESCAPED_UNICODE);
		return;
	}else{
		$result['meterID']=0;
		$result['result']=mysql_error()."详情请致电15304006188";
		echo json_encode($result,JSON_UNESCAPED_UNICODE);
		return;
	}
}

function CancleMeterIdentifyData($post){
	
	//check if meterID is legitimate(smaller than %24d)
	//check if meterID is repeat by meterID
	if(preg_match("/^\d{1,21}$/",$post['meterid'])){
		$sql=mysql_query("select meterID from MeterIdentify where meterID=".$post['meterid']);
		$r=mysql_fetch_array($sql);
		if(empty($r)){
			$result['meterID']=$post['meterid'];
			$result['result']="仪表序列号不存在";
			echo json_encode($result,JSON_UNESCAPED_UNICODE);
			return;
		}
	}else{
			$result['meterID']=$post['meterid'];
			$result['result']="仪表序列号存在错误";
			echo json_encode($result,JSON_UNESCAPED_UNICODE);
			return;
	}
	if(mysql_query("insert into DropedCompanyMeterID select * from CompanyMeterID where meterID=".$post['meterid'])){
		;
	}else{
		;
	}
	if(mysql_query("insert into DropedStaffMeterID select * from StaffMeterID where meterID=".$post['meterid'])){
		;
	}else{
		;
	}
	if(mysql_query("insert into DropedMeterDataPrimary select * from MeterDataPrimary where meterID=".$post['meterid'])){
		;
	}else{
		;
	}
	if(mysql_query("insert into DropedMeterDataSecondary select * from MeterDataSecondary where meterID=".$post['meterid'])){
		;
	}else{
		;
	}
	if(mysql_query("delete from CompanyMeterID where meterID=".$post['meterid'])){
		$result['meterID']=$post['meterid'];
		$result['result']="仪表公司信息已清除;";
	}else{
		$result['meterID']=0;
		$result['result']=mysql_error();
	}
	if(mysql_query("delete from StaffMeterID where meterID=".$post['meterid'])){
		$result['meterID']=$post['meterid'];
		$result['result']=$result['result']."仪表所在公司信息已清除;";
	}else{
		$result['meterID']=0;
		$result['result']=mysql_error();
	}
	if(mysql_query("delete from MeterDataPrimary where meterID=".$post['meterid'])){
		$result['meterID']=$post['meterid'];
		$result['result']=$result['result']."仪表历史数据(primary)已清除;";
	}else{
		$result['meterID']=0;
		$result['result']=mysql_error();
	}
	if(mysql_query("delete from MeterDataSecondary where meterID=".$post['meterid'])){
		$result['meterID']=$post['meterid'];
		$result['result']=$result['result']."仪表历史数据(secondary)信息已清除;";
	}else{
		$result['meterID']=0;
		$result['result']=mysql_error();
	}

	echo json_encode($result,JSON_UNESCAPED_UNICODE);
}

function CancleDataIdentifyData($post){
	//check if meterID is legitimate(smaller than %24d)
	//check if meterID is repeat by meterID
	if(!preg_match("/^\d{1,21}$/",$post['meterid'])){
		$result['meterID']=$post['meterid'];
		$result['result']="仪表序列号错误";
		echo json_encode($result,JSON_UNESCAPED_UNICODE);
		return;
	}
	//0xffff is the max addr if addr is correct
	if($post['modbusaddr']>0xffff){
		$result['meterID']=$post['meterid'];
		$result['result']="ModBus地址超出正常范围";
		echo json_encode($result,JSON_UNESCAPED_UNICODE);
		return;
	}
	if(mysql_query("delete from DataIdentify where meterID=".$post['meterid']." and address=".$post['modbusaddr'])){
		$result['meterID']=0;
		$result['result']="ModBus协议信息已清除";
	}else{
		$result['meterID']=$post['meterid'];
		$result['result']=mysql_error();
	}
	echo json_encode($result,JSON_UNESCAPED_UNICODE);
}






function GetMeterID($saccount){
	if(!is_numeric($saccount)||(strlen($saccount)>10))
		exit(0);
	$sql="select a.meterID,b.meterName,b.DTUID,b.deviceNumber from StaffMeterID a join MeterIdentify b on a.meterID=b.meterID where Saccount=".$_SESSION['account'];
	$res0=mysql_query($sql);
	while($result[]=mysql_fetch_array($res0));
	echo json_encode($result,JSON_UNESCAPED_UNICODE);
}

function GetDataProtocol($meterid){
	if(!is_numeric($meterid)||(strlen($meterid)>10))
		exit(0);
	$sql="select meterID,ord,dataName,address,byteNumber,dataType,unit from DataIdentify where meterID=".$meterid;
	$res=mysql_query($sql);
	while($result[]=mysql_fetch_array($res));
	echo json_encode($result,JSON_UNESCAPED_UNICODE);
}
mysql_close($DBC);
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
