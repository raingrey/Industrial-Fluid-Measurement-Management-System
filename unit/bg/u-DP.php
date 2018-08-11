<?php

/*****************DataProtocol*****************************/
include('../../SecurityAndMysql.php');
@$DBC=MysqlCon();
mysql_select_db("tcp",$DBC);

$post=postfilter();

//SDI	Save Data Identify data
if($post['cmd']=="SDI"){
	SaveDataIdentifyData($post);
	exit(0);
}
//CDI	Cancle Data Identify data
if($post['cmd']=="CDI"){
	CancleDataIdentifyData($post);
	exit(0);
}

function SaveDataIdentifyData($post){
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
function CancleDataIdentifyData($post){
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
	//0x20 is the max addr if addr is correct
	if($post['bytenumber']>20){
		$result['meterID']=$post['meterid'];
		$result['result']="byteNumber超出20";
		echo json_encode($result,JSON_UNESCAPED_UNICODE);
	}
	if(mysql_query("delete from DataIdentify where meterID=".$post['meterid']." and address=".$post['modbusaddr'])){
		$result['meterID']=$post['meterid'];
		$result['result']="ModBus协议信息已清除";
	}else{
		$result['meterID']=$post['meterid'];
		$result['result']=mysql_error();
	}
	echo json_encode($result,JSON_UNESCAPED_UNICODE);
}










?>
