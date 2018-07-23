<?php
#初始设置Mysql，为方便设置其他DB，每个DB只可运行一次
include './mysqlFunction.php';

#function initialMysqlTableForCyclingReadDataFromDG($useDB,$tableName)
#function initialMysqlTableForDGSet($useDB,$tableName)
#function initialMysqlTableForAuthority($useDB,$tableName)
#function initialMysqlTableForUserGroup($useDB,$tableName)
#function initialMysqlTableForUser($useDB,$tableName)


function initialMysqlTableForCyclingReadDataFromDG($useDB,$tableName)
{

	$firstColumn="仪表编号";
	$firstColumnType="int(20)";
	createTable($useDB,$tableName,$firstColumn,$firstColumnType);

#用户ID，即公司名称
	$column0="公司名称";
	$column0Type="text(20)";
	addColumn($useDB,$tableName,$column0,$column0Type);

#传感器1 名称 数据 单位
	$sensor1Name="传感器1";
	$sensor1NameType="text(5)";
	$sensor1Data="传感器1数据";
	$sensor1DataType="double(12,4)";
	$sensor1Unit="传感器1数据单位";
	$sensor1UnitType="text(5)";
	addColumn($useDB,$tableName,$sensor1Name,$sensor1NameType);
	addColumn($useDB,$tableName,$sensor1Data,$sensor1DataType);
	addColumn($useDB,$tableName,$sensor1Unit,$sensor1UnitType);

#传感器2 名称 数据 单位
	$sensor2Name="传感器2";
	$sensor2NameType="text(5)";
	$sensor2Data="传感器2数据";
	$sensor2DataType="double(12,4)";
	$sensor2Unit="传感器2数据单位";
	$sensor2UnitType="text(5)";
	addColumn($useDB,$tableName,$sensor2Name,$sensor2NameType);
	addColumn($useDB,$tableName,$sensor2Data,$sensor2DataType);
	addColumn($useDB,$tableName,$sensor2Unit,$sensor2UnitType);

#传感器3 名称 数据 单位
	$sensor3Name="传感器3";
	$sensor3NameType="text(5)";
	$sensor3Data="传感器3数据";
	$sensor3DataType="double(12,4)";
	$sensor3Unit="传感器3数据单位";
	$sensor3UnitType="text(5)";
	addColumn($useDB,$tableName,$sensor3Name,$sensor3NameType);
	addColumn($useDB,$tableName,$sensor3Data,$sensor3DataType);
	addColumn($useDB,$tableName,$sensor3Unit,$sensor3UnitType);

#传感器4 名称 数据 单位
	$sensor4Name="传感器4";
	$sensor4NameType="text(5)";
	$sensor4Data="传感器4数据";
	$sensor4DataType="double(12,4)";
	$sensor4Unit="传感器4数据单位";
	$sensor4UnitType="text(5)";
	addColumn($useDB,$tableName,$sensor4Name,$sensor4NameType);
	addColumn($useDB,$tableName,$sensor4Data,$sensor4DataType);
	addColumn($useDB,$tableName,$sensor4Unit,$sensor4UnitType);

#传感器5 名称 数据 单位
	$sensor5Name="传感器5";
	$sensor5NameType="text(5)";
	$sensor5Data="传感器5数据";
	$sensor5DataType="double(12,4)";
	$sensor5Unit="传感器5数据单位";
	$sensor5UnitType="text(5)";
	addColumn($useDB,$tableName,$sensor5Name,$sensor5NameType);
	addColumn($useDB,$tableName,$sensor5Data,$sensor5DataType);
	addColumn($useDB,$tableName,$sensor5Unit,$sensor5UnitType);



#瞬时量 名称 数据 单位
	$instantFlowData="瞬时流量数据";
	$instantFlowDataType="double(12,4)";
	$instantFlowUnit="瞬时流量单位";
	$instantFlowUnitType="text(5)";
	addColumn($useDB,$tableName,$instantFlowData,$instantFlowDataType);
	addColumn($useDB,$tableName,$instantFlowUnit,$instantFlowUnitType);



#累计量 数据 单位
	$totalFlowData="累积流量数据";
	$totalFlowDataType="double(20,4)";
	$totalFlowUnit="累积流量数据";
	$totalFlowUnitType="text(5)";
	addColumn($useDB,$tableName,$totalFlowData,$totalFlowDataType);
	addColumn($useDB,$tableName,$totalFlowUnit,$totalFlowUnitType);



#时间
	$timeStamp="时间戳";
	$timeStampType="timestamp(6)";
	addColumn($useDB,$tableName,$timeStamp,$timeStampType);
}



function initialMysqlTableForDGSet($useDB,$tableName)
{
	$firstColumn="仪表编号";
	$firstColumnType="int(20)";
	createTable($useDB,$tableName,$firstColumn,$firstColumnType);

#用户ID，即公司名称
	$column0="公司名称";
	$column0Type="text(20)";
	addColumn($useDB,$tableName,$column0,$column0Type);


#相接管道选择 仪表ID或其他管道节点ID
	$adjecentNode1ID="相邻管道节点1";
	$adjecentNode1IDType="int(20)";
	$adjecentNode2ID="相邻管道节点2";
	$adjecentNode2IDType="int(20)";
	$adjecentNode3ID="相邻管道节点3";
	$adjecentNode3IDType="int(20)";
	$adjecentNode4ID="相邻管道节点4";
	$adjecentNode4IDType="int(20)";
	$adjecentNode5ID="相邻管道节点5";
	$adjecentNode5IDType="int(20)";
	$adjecentNode6ID="相邻管道节点6";
	$adjecentNode6IDType="int(20)";
	$adjecentNode7ID="相邻管道节点7";
	$adjecentNode7IDType="int(20)";
	$adjecentNode8ID="相邻管道节点8";
	$adjecentNode8IDType="int(20)";
	$adjecentNode9ID="相邻管道节点9";
	$adjecentNode9IDType="int(20)";
	$adjecentNode10ID="相邻管道节点10";
	$adjecentNode10IDType="int(20)";
	addColumn($useDB,$tableName,$adjecentNode1ID,$adjecentNode1IDType);
	addColumn($useDB,$tableName,$adjecentNode2ID,$adjecentNode2IDType);
	addColumn($useDB,$tableName,$adjecentNode3ID,$adjecentNode3IDType);
	addColumn($useDB,$tableName,$adjecentNode4ID,$adjecentNode4IDType);
	addColumn($useDB,$tableName,$adjecentNode5ID,$adjecentNode5IDType);
	addColumn($useDB,$tableName,$adjecentNode6ID,$adjecentNode6IDType);
	addColumn($useDB,$tableName,$adjecentNode7ID,$adjecentNode7IDType);
	addColumn($useDB,$tableName,$adjecentNode8ID,$adjecentNode8IDType);
	addColumn($useDB,$tableName,$adjecentNode9ID,$adjecentNode9IDType);
	addColumn($useDB,$tableName,$adjecentNode10ID,$adjecentNode10IDType);
	

#传感器1 名称 信号上限 信号下限 单位 报警上限 报警下限 预留
	$sensor1Name="传感器1";
	$sensor1NameType="text(5)";
	$sensor1SignalTopRange="传感器1信号上限";
	$sensor1SignalTopRangeType="double(12,4)";
	$sensor1SignalBottomRange="传感器1信号下限";
	$sensor1SignalBottomRangeType="double(12,4)";
	$sensor1Unit="传感器1信号单位";
	$sensor1UnitType="text(5)";
	$sensor1AlarmTopRange="传感器1报警信号上限";
	$sensor1AlarmTopRangeType="double(12,4)";
	$sensor1AlarmBottomRange="传感器报警1信号下限";
	$sensor1AlarmBottomRangeType="double(12,4)";
	$sensor1Allow="传感器1扩展字段";
	$sensor1AllowType="text(20)";
	addColumn($useDB,$tableName,$sensor1Name,$sensor1NameType);
	addColumn($useDB,$tableName,$sensor1SignalTopRange,$sensor1SignalTopRangeType);
	addColumn($useDB,$tableName,$sensor1SignalBottomRange,$sensor1SignalBottomRangeType);	
	addColumn($useDB,$tableName,$sensor1Unit,$sensor1UnitType);
	addColumn($useDB,$tableName,$sensor1AlarmTopRange,$sensor1AlarmTopRangeType);
	addColumn($useDB,$tableName,$sensor1AlarmBottomRange,$sensor1AlarmBottomRangeType);
	addColumn($useDB,$tableName,$sensor1Allow,$sensor1AllowType);



#传感器2 名称 信号上限 信号下限 单位 报警上限 报警下限 预留
	$sensor2Name="传感器2";
	$sensor2NameType="text(5)";
	$sensor2SignalTopRange="传感器2信号上限";
	$sensor2SignalTopRangeType="double(12,4)";
	$sensor2SignalBottomRange="传感器2信号下限";
	$sensor2SignalBottomRangeType="double(12,4)";
	$sensor2Unit="传感器2信号单位";
	$sensor2UnitType="text(5)";
	$sensor2AlarmTopRange="传感器2报警信号上限";
	$sensor2AlarmTopRangeType="double(12,4)";
	$sensor2AlarmBottomRange="传感器2报警信号下限";
	$sensor2AlarmBottomRangeType="double(12,4)";
	$sensor2Allow="传感器2扩展字段";
	$sensor2AllowType="text(20)";
	addColumn($useDB,$tableName,$sensor2Name,$sensor2NameType);
	addColumn($useDB,$tableName,$sensor2SignalTopRange,$sensor2SignalTopRangeType);
	addColumn($useDB,$tableName,$sensor2SignalBottomRange,$sensor2SignalBottomRangeType);	
	addColumn($useDB,$tableName,$sensor2Unit,$sensor2UnitType);
	addColumn($useDB,$tableName,$sensor2AlarmTopRange,$sensor2AlarmTopRangeType);
	addColumn($useDB,$tableName,$sensor2AlarmBottomRange,$sensor2AlarmBottomRangeType);
	addColumn($useDB,$tableName,$sensor2Allow,$sensor2AllowType);


#传感器3 名称 信号上限 信号下限 单位 报警上限 报警下限 预留
	$sensor3Name="传感器3";
	$sensor3NameType="text(5)";
	$sensor3SignalTopRange="传感器3信号上限";
	$sensor3SignalTopRangeType="double(12,4)";
	$sensor3SignalBottomRange="传感器3信号下限";
	$sensor3SignalBottomRangeType="double(12,4)";
	$sensor3Unit="传感器3信号单位";
	$sensor3UnitType="text(5)";
	$sensor3AlarmTopRange="传感器3报警信号上限";
	$sensor3AlarmTopRangeType="double(12,4)";
	$sensor3AlarmBottomRange="传感器3报警信号下限";
	$sensor3AlarmBottomRangeType="double(12,4)";
	$sensor3Allow="传感器3扩展字段";
	$sensor3AllowType="text(20)";
	addColumn($useDB,$tableName,$sensor3Name,$sensor3NameType);
	addColumn($useDB,$tableName,$sensor3SignalTopRange,$sensor3SignalTopRangeType);
	addColumn($useDB,$tableName,$sensor3SignalBottomRange,$sensor3SignalBottomRangeType);	
	addColumn($useDB,$tableName,$sensor3Unit,$sensor3UnitType);
	addColumn($useDB,$tableName,$sensor3AlarmTopRange,$sensor3AlarmTopRangeType);
	addColumn($useDB,$tableName,$sensor3AlarmBottomRange,$sensor3AlarmBottomRangeType);
	addColumn($useDB,$tableName,$sensor3Allow,$sensor3AllowType);


#传感器4 名称 信号上限 信号下限 单位 报警上限 报警下限 预留
	$sensor4Name="传感器4";
	$sensor4NameType="text(5)";
	$sensor4SignalTopRange="传感器4信号上限";
	$sensor4SignalTopRangeType="double(12,4)";
	$sensor4SignalBottomRange="传感器4信号下限";
	$sensor4SignalBottomRangeType="double(12,4)";
	$sensor4Unit="传感器4信号单位";
	$sensor4UnitType="text(5)";
	$sensor4AlarmTopRange="传感器4报警信号上限";
	$sensor4AlarmTopRangeType="double(12,4)";
	$sensor4AlarmBottomRange="传感器4报警信号下限";
	$sensor4AlarmBottomRangeType="double(12,4)";
	$sensor4Allow="传感器4扩展字段";
	$sensor4AllowType="text(20)";
	addColumn($useDB,$tableName,$sensor4Name,$sensor4NameType);
	addColumn($useDB,$tableName,$sensor4SignalTopRange,$sensor4SignalTopRangeType);
	addColumn($useDB,$tableName,$sensor4SignalBottomRange,$sensor4SignalBottomRangeType);	
	addColumn($useDB,$tableName,$sensor4Unit,$sensor4UnitType);
	addColumn($useDB,$tableName,$sensor4AlarmTopRange,$sensor4AlarmTopRangeType);
	addColumn($useDB,$tableName,$sensor4AlarmBottomRange,$sensor4AlarmBottomRangeType);
	addColumn($useDB,$tableName,$sensor4Allow,$sensor4AllowType);



#传感器5 名称 信号上限 信号下限 单位 报警上限 报警下限 预留
	$sensor5Name="传感器5";
	$sensor5NameType="text(5)";
	$sensor5SignalTopRange="传感器5信号上限";
	$sensor5SignalTopRangeType="double(12,4)";
	$sensor5SignalBottomRange="传感器5信号下限";
	$sensor5SignalBottomRangeType="double(12,4)";
	$sensor5Unit="传感器5信号单位";
	$sensor5UnitType="text(5)";
	$sensor5AlarmTopRange="传感器5报警信号上限";
	$sensor5AlarmTopRangeType="double(12,4)";
	$sensor5AlarmBottomRange="传感器5报警信号下限";
	$sensor5AlarmBottomRangeType="double(12,4)";
	$sensor5Allow="传感器5扩展字段";
	$sensor5AllowType="text(20)";
	addColumn($useDB,$tableName,$sensor5Name,$sensor5NameType);
	addColumn($useDB,$tableName,$sensor5SignalTopRange,$sensor5SignalTopRangeType);
	addColumn($useDB,$tableName,$sensor5SignalBottomRange,$sensor5SignalBottomRangeType);	
	addColumn($useDB,$tableName,$sensor5Unit,$sensor5UnitType);
	addColumn($useDB,$tableName,$sensor5AlarmTopRange,$sensor5AlarmTopRangeType);
	addColumn($useDB,$tableName,$sensor5AlarmBottomRange,$sensor5AlarmBottomRangeType);
	addColumn($useDB,$tableName,$sensor5Allow,$sensor5AllowType);



#瞬时流量 瞬时量上限 单位 报警上限 报警下限 预留
	$instantFlowData="瞬时流量数据";
	$instantFlowDataType="double(12,4)";
	$instantFlowUnit="瞬时流量单位";
	$instantFlowUnitType="text(5)";
	$instantFlowTopRange="瞬时流量上限";
	$instantFlowTopRangeType="double(12,4)";
	$instantFlowBottomRange="瞬时流量下限";
	$instantFlowBottomRangeType="double(12,4)";
	$instantFlowAlarmTopRange="瞬时流量报警上限";
	$instantFlowAlarmTopRangeType="double(12,4)";
	$instantFlowAlarmBottomRange="瞬时流量报警下限";
	$instantFlowAlarmBottomRangeType="double(12,4)";
	$instantFlowAllow="瞬时流量扩展字段";
	$instantFlowAllowType="text(20)";
	addColumn($useDB,$tableName,$instantFlowData,$instantFlowDataType);
	addColumn($useDB,$tableName,$instantFlowUnit,$instantFlowUnitType);
	addColumn($useDB,$tableName,$instantFlowTopRange,$instantFlowTopRangeType);	
	addColumn($useDB,$tableName,$instantFlowBottomRange,$instantFlowBottomRangeType);	
	addColumn($useDB,$tableName,$instantFlowAlarmTopRange,$instantFlowAlarmTopRangeType);	
	addColumn($useDB,$tableName,$instantFlowAlarmBottomRange,$instantFlowAlarmBottomRangeType);	
	addColumn($useDB,$tableName,$instantFlowAllow,$instantFlowAllowType);


#最近一次同步时间
	$lastSyncTime="最近一次时间同步";
	$lastSyncTimeType="datetime";
	addColumn($useDB,$tableName,$lastSyncTime,$lastSyncTimeType);




#各项计算用参数
	$dataSyncFrequency="数据同步频率";
	$dataSyncFrequencyType="smallint(5)";	
	$outputMode="输出选项";
	$outputModeType="text(6)";
	$baudRate485="输出485波特率";
	$baudRate485Type="int(8)";
	$address485="地址485";
	$address485Type="tinyint(3)";
	$outputTopRange="频率4到20mA输出上限";
	$outputTopRangeType="double(16,4)";
	$outputBottomRange="频率4到20mA输下限";
	$outputBottomRangeType="double(16,4)";
	$dampingTime="阻尼时间";
	$dampingTimeType="float(6,2)";
	$smallSignalResection="小信号切除";
	$smallSignalResectionType="float(8,6)";

	$subsectionCorrectK1="第一点K系数_通用";
	$subsectionCorrectK1Type="float(10,6)";
	$subsectionCorrectK2="第二点K系数_通用";
	$subsectionCorrectK2Type="float(10,6)";
	$subsectionCorrectK3="第三点K系数_通用";
	$subsectionCorrectK3Type="float(10,6)";
	$subsectionCorrectK4="第四点K系数_通用";
	$subsectionCorrectK4Type="float(10,6)";
	$subsectionCorrectK5="第五点K系数_通用";
	$subsectionCorrectK5Type="float(10,6)";
	$subsectionNode1_2="1_2点K系数分段点";
	$subsectionNode1_2Type="float(10,4)";
	$subsectionNode2_3="2_3点K系数分段点";
	$subsectionNode2_3Type="float(10,4)";
	$subsectionNode3_4="3_4点K系数分段点";
	$subsectionNode3_4Type="float(10,4)";
	$subsectionNode4_5="4_5点K系数分段点";
	$subsectionNode4_5Type="float(10,4)";

	$fluidName="介质名称";	
	$fluidNameType="text(6)";
	$throttleDevice="节流装置";
	$throttleDeviceType="text(10)";
	$localAtmoPressure="当地大气压";
	$localAtmoPressureType="float(6,4)";
	$internalDiameter="管道内经";
	$internalDiameterType="float(6,2)";
	$flowMeterDiameter="节流孔_喉部_锥体_直径";
	$flowMeterDiameterType="float(6,2)";
	$pipeMaterialExpansionCoefficient="管道材质膨胀系数";
	$pipeMaterialExpansionCoefficientType="float(8,8)";
	$pipeMaterial="管道材质";
	$pipeMaterialType="text(8)";
	$flowMeterMaterialExpansionCoefficient="节流件材质膨胀系数";
	$flowMeterMaterialExpansionCoefficientType="float(8,8)";
	$flowMeterMaterial="节流件材质";
	$flowMeterMaterialType="text(8)";
	$fluidViscosicity="介质粘度";
	$fluidViscosicityType="float(8,8)";
	$isentropicIndex="等熵指数";
	$isentropicIndexType="float(6,2)";
	$fluidExpansionCofficient="介质可膨胀系数_V锥";
	$fluidExpansionCofficientType="float(6,4)";
	$dischargeCofficient="流出系数_V锥";
	$dischargeCofficientType="float(6,2)";
	$criticalPressure="临界压力";
	$criticalPressureType="float(6,4)";
	$criticalTemperature="临界温度";
	$criticalTemperatureType="float(6,2)";
	$liquidExpansitionCoefficient="液体膨胀系数";
	$liquidExpansitionCoefficientType="float(8,8)";
	$dryDegree="干度";
	$dryDegreeType="float(6,4)";
	$temperatureFixedValue="温度固定值";
	$temperatureFixedValueType="float(6,2)";
	$pressureFixedValue="压力固定值";
	$pressureFixedValueType="float(6,2)";
	$difPaFixedValue="差压固定值";
	$difPaFixedValueType="float(6,2)";

	addColumn($useDB,$tableName,$dataSyncFrequency,$dataSyncFrequencyType);
	addColumn($useDB,$tableName,$outputMode,$outputModeType);
	addColumn($useDB,$tableName,$baudRate485,$baudRate485Type);
	addColumn($useDB,$tableName,$address485,$address485Type);
	addColumn($useDB,$tableName,$outputTopRange,$outputTopRangeType);
	addColumn($useDB,$tableName,$outputBottomRange,$outputBottomRangeType);
	addColumn($useDB,$tableName,$dampingTime,$dampingTimeType);
	addColumn($useDB,$tableName,$smallSignalResection,$smallSignalResectionType);
	addColumn($useDB,$tableName,$subsectionCorrectK1,$subsectionCorrectK1Type);
	addColumn($useDB,$tableName,$subsectionCorrectK2,$subsectionCorrectK2Type);
	addColumn($useDB,$tableName,$subsectionCorrectK3,$subsectionCorrectK3Type);
	addColumn($useDB,$tableName,$subsectionCorrectK4,$subsectionCorrectK4Type);
	addColumn($useDB,$tableName,$subsectionCorrectK5,$subsectionCorrectK5Type);
	addColumn($useDB,$tableName,$subsectionNode1_2,$subsectionNode1_2Type);
	addColumn($useDB,$tableName,$subsectionNode2_3,$subsectionNode2_3Type);
	addColumn($useDB,$tableName,$subsectionNode3_4,$subsectionNode3_4Type);
	addColumn($useDB,$tableName,$subsectionNode4_5,$subsectionNode4_5Type);
	addColumn($useDB,$tableName,$fluidName,$fluidNameType);
	addColumn($useDB,$tableName,$throttleDevice,$throttleDeviceType);
	addColumn($useDB,$tableName,$localAtmoPressure,$localAtmoPressureType);
	addColumn($useDB,$tableName,$internalDiameter,$internalDiameterType);
	addColumn($useDB,$tableName,$flowMeterDiameter,$flowMeterDiameterType);
	addColumn($useDB,$tableName,$pipeMaterialExpansionCoefficient,$pipeMaterialExpansionCoefficientType);
	addColumn($useDB,$tableName,$pipeMaterial,$pipeMaterialType);
	addColumn($useDB,$tableName,$flowMeterMaterialExpansionCoefficient,$flowMeterMaterialExpansionCoefficientType);
	addColumn($useDB,$tableName,$flowMeterMaterial,$flowMeterMaterialType);
	addColumn($useDB,$tableName,$fluidViscosicity,$fluidViscosicityType);
	addColumn($useDB,$tableName,$isentropicIndex,$isentropicIndexType);
	addColumn($useDB,$tableName,$fluidExpansionCofficient,$fluidExpansionCofficientType);
	addColumn($useDB,$tableName,$dischargeCofficient,$dischargeCofficientType);
	addColumn($useDB,$tableName,$criticalPressure,$criticalPressureType);
	addColumn($useDB,$tableName,$criticalTemperature,$criticalTemperatureType);
	addColumn($useDB,$tableName,$liquidExpansitionCoefficient,$liquidExpansitionCoefficientType);
	addColumn($useDB,$tableName,$dryDegree,$dryDegreeType);
	addColumn($useDB,$tableName,$temperatureFixedValue,$temperatureFixedValueType);
	addColumn($useDB,$tableName,$pressureFixedValue,$pressureFixedValueType);
	addColumn($useDB,$tableName,$difPaFixedValue,$difPaFixedValueType);
}



function initialMysqlTableForAuthority($useDB,$tableName)
{
	$firstColumn="权限编号";
	$firstColumnType="int(20)";
	createTable($useDB,$tableName,$firstColumn,$firstColumnType);

#所有全限中0最低，99最高
	$groupAuthorityControl="组权限管理";
	$groupAuthorityControlType="tinyint(2)";
	addColumn($useDB,$tableName,$groupAuthorityControl,$groupAuthorityControlType);

	$userAuthorityControl="用户权限管理";
	$userAuthorityControlType="tinyint(2)";
	addColumn($useDB,$tableName,$userAuthorityControl,$userAuthorityControlType);
	
	$flowMeterAuthority="仪表权限";
	$flowMeterAuthorityType="tinyint(2)";
	addColumn($useDB,$tableName,$flowMeterAuthority,$flowMeterAuthorityType);

	$systemLogAuthority="系统日志权限";
	$systemLogAuthorityType="tinyint(2)";
	addColumn($useDB,$tableName,$systemLogAuthority,$systemLogAuthorityType);
/**/
}
	
function initialMysqlTableForUserGroup($useDB,$tableName)
{
	$firstColumn="用户组编号";
	$firstColumnType="int(20)";
	createTable($useDB,$tableName,$firstColumn,$firstColumnType);

	$groupName="组名称";
	$groupNameType="text(8)";
	addColumn($useDB,$tableName,$groupName,$groupNameType);

	$parentGroup="父组";
	$parentGroupType="text(8)";
	addColumn($useDB,$tableName,$parentGroup,$parentGroupType);

	$createTime="创建时间";
	$createTimeType="datetime";
	addColumn($useDB,$tableName,$createTime,$createTimeType);

	$groupDescription="组描述";
	$groupDescriptionType="text(50)";
	addColumn($useDB,$tableName,$groupDescription,$groupDescriptionType);
}

function initialMysqlTableForUser($useDB,$tableName)
{
	$firstColumn="用户编号";
	$firstColumnType="int(20)";
	createTable($useDB,$tableName,$firstColumn,$firstColumnType);

	$userGroup="用户所属组";
	$userGroupType="text(20)";
	addColumn($useDB,$tableName,$userGroup,$userGroupType);


	$userCompany="用户公司";
	$userCompanyType="text(20)";
	addColumn($useDB,$tableName,$userCompany,$userCompanyType);

	$loginName="登录名";
	$loginNameType="text(20)";
	addColumn($useDB,$tableName,$loginName,$loginNameType);
	
	$loginPassword="登录密码";
	$loginPasswordType="varchar(128)";
	addColumn($useDB,$tableName,$loginPassword,$loginPasswordType);
	
	$phoneNumber="手机号码";
	$phoneNumberType="varchar(16)";
	addColumn($useDB,$tableName,$phoneNumber,$phoneNumberType);
	
	$eMail="电子邮箱";
	$eMailType="varchar(64)";
	addColumn($useDB,$tableName,$eMail,$eMailType);
	
	$createTime="创建时间";
	$createTimeType="datetime";
	addColumn($useDB,$tableName,$createTime,$createTimeType);

	$loginTime="登陆时间";
	$loginTimeType="datetime";
	addColumn($useDB,$tableName,$loginTime,$loginTimeType);
	
	$lastLoginTime="上次登陆时间";
	$lastLoginTime="datetime";
	addColumn($useDB,$tableName,$lastLoginTime,$lastloginTimeType);

	$loginCount="登录次数";
	$loginCountType="bigint";
	addColumn($useDB,$tableName,$loginCount,$loginCountType);

/*
	*/
}
	




?>
