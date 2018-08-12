<?php

/*****************Login*****************************/
/*********************************
filename: Login - used to user login
2017-10-30
@Dark Jadeite
made for u-L.js
Send Random Code and Check Login Info Correct 
***********************************/
include('./SecurityAndMysql.php');
@$DBC=MysqlCon();
mysql_select_db("tcp",$DBC);
error_reporting(0);//error report forbidden
$post=NULL;
$post=postfilter($post);
//$_SESSION['salt']=0;
if($post["cmd"]=="GS"){
	CheckUserAndGetSalt($post);
}
function CheckUserAndGetSalt($post){

		$result['salt']=rand(1,99999);
		$_SESSION['salt']=$result['salt'];
		$result['result']="OK";

//大傻逼，没有的用户申盐就不能成功，那大家就都知道你有啥用户了
/*	if(preg_match("/^[\x{4e00}-\x{9fa5}A-Z_a-z0-9]+$/u",$post['un'])||preg_match("/^[a-z0-9\.\-]+\@([a-zA-Z0-9\-]+\.)+([a-zA-Z0-9]{2,4})$/",$post['un'])||preg_match("/^([0-9\-]{6,18})+$/",$post['un'])){
		$sql="SELECT account FROM Staff WHERE name='".$post['un']."' or tel ='".$post['un']."' or email='".$post['un']."'";
		if(($x=mysql_query($sql))){
			if($y=mysql_fetch_array($x)){
				$sql="update Staff set random=".$result['salt']." where account = ".$y['account'];
				if(mysql_query($sql)){ 
					$result['salt']=rand(1,99999);
					$_SESSION['salt']=$result['salt'];
					$result['result']="OK";
//				}else{
//					$result['salt']=NULL;
//					$result['result']=mysql_error();
				}

			}else{
//				$result['result']="申盐失败";
				$result['result']="OK";
				$result['salt']=NULL;
			}
		}else{
//			$result['result']=mysql_error();
			$result['result']="OK";
			$result['salt']=NULL;
		}
	}else{
		$result['salt']=NULL;
		$result['result']="格式存在问题";
	}
*/
	echo json_encode($result,JSON_UNESCAPED_UNICODE);
}
if($post["cmd"]=="LOGIN"){
	CheckPasswordAndMakeSession($post);
}
function CheckPasswordAndMakeSession($post){
	/*要把三种验证分开，匹配后再执行登录验证,否则int 与字串的验证会必真*/
	//纯数字比为电话号码
	if(preg_match("/^([0-9\-]{6,18})+$/",$post['un']))
		$sql="SELECT account,name,password FROM Staff WHERE tel=".$post['un'];
	else if(preg_match("/^[\x{4e00}-\x{9fa5}A-Z_a-z0-9]+$/u",$post['un']))
		$sql="SELECT account,name,password FROM Staff WHERE name='".$post['un']."'";
	else if(preg_match("/^[a-z0-9\.\-]+\@([a-zA-Z0-9\-]+\.)+([a-zA-Z0-9]{2,4})$/",$post['un']))
		$sql="SELECT account,name,password FROM Staff WHERE email='".$post['un']."'";
	else{
		$result['result']="格式存在问题";
		goto CheckPasswordAndMakeSession_end;
	}

	if($x=mysql_query($sql)){
		$y=mysql_fetch_array($x);
		if($y['account']>0){
			$pw=md5($y['password'].$_SESSION['salt']);
			if($pw==$post['pw']){
				$_SESSION['account']=$y['account'];
				$result['result']="登录成功";
				$result['un']=$y['name'];
			}else{
//				$result['result']=$sql;
				$result['result']="登录失败";
			}
		}else{
			$result['result']="无法登录";
		}
	}else{
		$result['result']=mysql_error();
	}
CheckPasswordAndMakeSession_end:
//echo $result." password=".$pw." sqlpassword=".$y['password']." random=".$y['random'];
	echo json_encode($result,JSON_UNESCAPED_UNICODE);
}





mysql_close($DBC);

?>
