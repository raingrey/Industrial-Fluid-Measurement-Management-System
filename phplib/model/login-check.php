<?php
include('security.php');
include('mysqlFunction.php');
@$dataBaseConnect=connectMysql();
mysql_select_db("DGsql",$dataBaseConnect);

session_start();
/////////////////////////////////////////////////html变量///trim()移除字符串左右两侧空格tab\t换行\n回车\r垂直制表等
$username=trim($post[username]);
$password=trim($post[password]);
$phpCommand=trim($post[phpcommand]);
/////////////////////////////////////////////////html变量
//echo $username;
//echo $password;
//echo $phpCommand;
/////////////////////////////////////////////////生成随机数

//echo "x";
if($username!=NULL&&$phpCommand=="getRandomCode")
{
	$random=rand(1,99999);
	$sql="select 用户编号 from 用户 where 手机号码='".$username."' or 登录名='".$username."' or 电子邮箱='".$username."'";
	$result=mysql_fetch_array(mysql_query($sql));
	if($result)
	{	
		mysql_query("update 用户 set 登录随机数=".$random." where 用户编号='".$result[0]."'");//".$result[0]."'");
		echo $random;
	}
}
/////////////////////////////////////////////////生成随机数


/////////////////////////////////////////////////登录验证
if($username!=NULL&&$password!=NULL)
{
	$sql="select 用户所属组,用户公司,登录名,登录密码,登录随机数 from 用户 where 手机号码='".$username."' or 登录名='".$username."' or 电子邮箱='".$username."'";
	$result=mysql_fetch_array(mysql_query($sql));
	//print_r($result);
	$passwordSql=md5($result['登录密码'].$result['登录随机数']);
	if($password==$passwordSql)
	{
		$_SESSION['company']=$result['用户公司'];
		$_SESSION['username']=$result['登录名'];
		$_SESSION['usergroup']=$result['用户所属组'];
		echo $result['用户公司']."的".$result['登录名']."你好！";	
		echo '<script type="text/javascript">	window.location="../../webpage/index-background.html";</script>';
	}
	else
	{
		echo '<script type="text/javascript">	window.location="../../webpage/page-login.html";</script>';
	}
//	echo $_SESSION['username'];
//	echo $_SESSION['company'];
//	echo $_SESSION['usergroup'];
}
else	
		echo '<script type="text/javascript">	window.location="../../webpage/page-login.html";</script>xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';

mysql_close($dataBaseConnect);
?>

