<?php
include('security.php');
$username=$post[username];
$email=$post[email];
$phpcommand=$post[phpcommand];
$company=$post[company];
$telnumber=$post[telnumber];
$password=$post[pwd];
$submit=$post[submit];
$passwordconfirm=$post[pwdconfirm];

//echo $username;
//echo $email;
//echo $phpcommand;
//echo $telnumber;
include('mysqlFunction.php');
$dataBaseConnect=connectMysql();
mysql_select_db("DGsql",$dataBaseConnect);

///////////////////////////////字段名
$loadname="登录名";
$emailname="电子邮箱";
$telnumbername="手机号码";

/////////////////////////////////////////////处理注册（用户公司这个还没写），用户名和电子邮箱名的重复查询
if($phpcommand!=NULL)
{
	if($username!=NULL&&$phpcommand="checkRepeatUsername")
		echo checkRepeatData($loadname,$username);
	if($email!=NULL&&$phpcommand=="checkRepeatEmail")
		echo checkRepeatData($emailname,$email);
	if($telnumber!=NULL&&$phpcommand=="checkRepeatTelNumber")
		echo checkRepeatData($telnumbername,$telnumber);
}

function checkRepeatData($var,$name)
{
	$sql="SELECT 用户编号 FROM 用户 WHERE $var='".$name."'";
	if(mysql_fetch_array(mysql_query($sql)))	return "重复";

}
/////////////////////////////////////////////处理注册（用户公司这个还没写），用户名和电子邮箱名的重复查询

////////////////////////////////////////////处理注册，信息入库，密码MD5
if($submit!=NULL)
{
	if(preg_match("/^[\x{4e00}-\x{9fa5}A-Z_a-z0-9]+$/u",$username)&&preg_match("/^[\x{4e00}-\x{9fa5}A-Z_a-z0-9]+$/u",$company)&&preg_match("/^[a-z0-9\.\-]+\@([a-zA-Z0-9\-]+\.)+([a-zA-Z0-9]{2,4})$/",$email)&&preg_match("/^([0-9\-]{6,18})+$/",$telnumber)&&(strlen($password)>7&&$password==$passwordconfirm)&&(checkRepeatData($loadname,$username)!="重复")&&(checkRepeatData($emailname,$email)!="重复")&&(checkRepeatData($telnumbername,$telnumber)!="重复"))
	{
		$password=md5($password);
		if(preg_match("/^[a-zA-Z0-9]+$/",$password))
		{
			$sql="insert into 用户 (用户公司,登录名,电子邮箱,手机号码,创建时间,登录密码) values ('".$company."','".$username."','".$email."','".$telnumber."',Now(),'".$password."')";
			$result=mysql_query($sql); 
			if($result)	echo '<script type="text/javascript">	window.location="../../webpage/page-login.html";</script>';
			else		echo '<script type="text/javascript">	location.href=history.go(-1);</script>';
		}else		echo '<script type="text/javascript">	location.href=history.go(-1);</script>';
	}else		echo '<script type="text/javascript">	location.href=history.go(-1);</script>';
}
mysql_close($dataBaseConnect);



?>
