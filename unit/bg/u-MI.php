<?php

/*****************MeterIdentify*****************************/
include('../../SecurityAndMysql.php');
@$DBC=MysqlCon();
mysql_select_db("tcp",$DBC);

$post=postfilter();
$post['saccount']=$_SESSION['account'];
$post['caccount']=0;
//SMI	Save Meter Identify data
if($post['cmd']=="SMI"){
	SaveMeterIdentifyData($post);
	exit(0);
}
//CMI	Cancle Meter Identify data
if($post['cmd']=="CMI"){
	CancleMeterIdentifyData($post);
	exit(0);
}
if($post['cmd']=="AMID"){
	ApplyMeterID();
	exit(0);
}

function SaveMeterIdentifyData($post){
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
			$result['result']="当前ModBus总线已存在此地址";
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
	if(preg_match("/^\d{1,21}$/",$post['meterid'])){
		$sql=mysql_query("select meterID from MeterIdentify where meterID=".$post['meterid']);
		$r=mysql_fetch_array($sql);
		if(!empty($r)){
			$result['meterID']=$post['meterid'];
			$result['result']="仪表序列号已被使用";
			echo json_encode($result,JSON_UNESCAPED_UNICODE);
			return;
		}
	}else{
			$result['meterID']=$post['meterid'];
			$result['result']="仪表序列号错误";
			echo json_encode($result,JSON_UNESCAPED_UNICODE);
			return;
	}
	if(mysql_query("insert into MeterIdentify(meterID,DTUID,deviceNumber)values(".$post['meterid'].",".$post['dtuid'].",".$post['modbusaddr'].")")){
		if(InsertToCompanyAndStaff($post)){
			$result['meterID']=$post['meterid'];
			$result['result']="仪表信息已保存";
			echo json_encode($result,JSON_UNESCAPED_UNICODE);
			return;
		}else{
			$result['meterID']=$post['meterid'];
			$result['result']=mysql_error()."详情请致电15304006188";
			echo json_encode($result,JSON_UNESCAPED_UNICODE);
			return;

		}
	}else{
		$result['meterID']=0;
		$result['result']=mysql_error()."详情请致电15304006188";
		echo json_encode($result,JSON_UNESCAPED_UNICODE);
		return;
	}
}
function InsertToCompanyAndStaff($post){
	if(mysql_query("insert into CompanyMeterID(Caccount,meterID)values(".$post['caccount'].",".$post['meterid'].")")){
		if(mysql_query("insert into StaffMeterID(Saccount,meterID)values(".$post['saccount'].",".$post['meterid'].")")){
			return true;
		}else	return false;
	}else	return false;
}
function CancleMeterIdentifyData($post){
	if(!preg_match("/^\d{15}$/",$post['dtuid'])){
		$result['meterID']=0;
		$result['DTUID']=$post['dtuid'];
		$result['result']="DTUID存在错误";
		echo json_encode($result,JSON_UNESCAPED_UNICODE);
		return;
	}

	//check if modbusAddr is legitimate
	//check if modbusAddr is repeat by DTUID and modbusAddr
	if($post['modbusaddr']<256){
		$sql=mysql_query("select DTUID from MeterIdentify where DTUID=".$post['dtuid']." and deviceNumber=".$post['modbusaddr'])or die(mysql_error());
		$r=mysql_fetch_array($sql);
		if(empty($r)){
			$result['meterID']=0;
			$result['result']="当前ModBus总线不存在此地址".$r;
			echo json_encode($result,JSON_UNESCAPED_UNICODE);
			return;
		}

	}else{
		$result['meterID']=0;
		$result['result']="ModBus地址数据存在错误";
		echo json_encode($result,JSON_UNESCAPED_UNICODE);
	}
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
	if(mysql_query("delete from MeterIdentify where meterID=".$post['meterid']." and deviceNumber=".$post['modbusaddr'])){
		$result['meterID']=$post['meterid'];
		$result['result']="仪表信息已清除";
	}else{
		$result['meterID']=0;
		$result['result']=mysql_error();
	}

	echo json_encode($result,JSON_UNESCAPED_UNICODE);
}
function ApplyMeterID(){
	$sql=mysql_query("select max(meterID) from MeterIdentify")or die(mysql_error());
	if($r=mysql_fetch_array($sql)){
		$result['meterID']=$r[0]+1;
	}else{
		$result['meterID']=0;
	}
	echo json_encode($result,JSON_UNESCAPED_UNICODE);
}

mysql_close($DBC);
?>
