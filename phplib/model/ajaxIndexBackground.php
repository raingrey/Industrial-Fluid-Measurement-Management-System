<?php
header("Content-Type:text/html;charset=utf-8");
include('security.php');
include('mysqlFunction.php');
@$dataBaseConnect=connectMysql();
mysql_select_db("DGsql",$dataBaseConnect);

session_start();
if($_SESSION['company']!=null&&$post[command]=="getCompanyStaff")
{
$sql="select 登录名 from 用户 where 用户公司='".$_SESSION['company']."'";
$staffRes=mysql_query($sql);
while($result[]=mysql_fetch_array($staffRes,MYSQL_NUM));
$result[]=$_SESSION['username'];
echo json_encode($result,JSON_UNESCAPED_UNICODE);//json直接encodemysql查出的数组会直接给unicode码。。。不能用
}

if($_SESSION['company']!=null&&$post[command]=="getCompanyUnit")
{
$sql="select basicattrname from RailedMeterSet where companyname='".$_SESSION[company]."'";
$unitRes=mysql_query($sql);
while($result[]=mysql_fetch_array($unitRes,MYSQL_NUM));
echo json_encode($result,JSON_UNESCAPED_UNICODE);//json直接encodemysql查出的数组会直接给unicode码。。。不能用

}

if($_SESSION['company']!=null&&$post[command]=="checkUnitNameRepeat")
{
$sql="select ID from RailedMeterSet where companyname='".$_SESSION['company']."' and unitname='".$post[unitname]."'";
$unitRes=mysql_query($sql);
$result=mysql_fetch_array($unitRes);
if($result!=null)	echo "重复";
}

if($_SESSION['company']!=null&&$post[command]=="checkBasicAttrNameRepeat")
{
$sql="select ID from RailedMeterSet where companyname='".$_SESSION['company']."' and basicattrname='".$post[basicattrname]."'";
$unitRes=mysql_query($sql);
$result=mysql_fetch_array($unitRes);
if($result!=null)	echo "重复";
}

mysql_close($dataBaseConnect);
?>
