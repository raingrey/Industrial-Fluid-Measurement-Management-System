<?php

/*****************Registe*****************************/
/*********************************
filename: registe - used to user registe
2017-10-30
@Dark Jadeite
made for u-R.js
Check registe info repeate and save registe data to mysql which is correct
2018-6-18
@Dark Jadeite
我特么就纳了个闷儿了，这逼玩意儿重复验证咋就不鸡巴好用呢！！！！！操！
2018-8-11
@dark_jadeite
mysql查忙了就会没数据也会返回一段为0空间
mysql查int的时候给入字符串会查出空值项
***********************************/
include('./SecurityAndMysql.php');
@$DBC=MysqlCon();
mysql_select_db("tcp",$DBC);
error_reporting(0);//error report forbidden
$post=NULL;
$post=postfilter($post);

if($post['cmd']=='CUNR'){
	CheckUserNameRepeat($post);
}
function CheckUserNameRepeat($post){

	if(preg_match("/^[\x{4e00}-\x{9fa5}A-Z_a-z0-9]+$/u",$post['un'])){
		$sql="SELECT account FROM Staff WHERE name='".$post['un']."'";
		if($x=mysql_query($sql)){
			//大傻逼，mysql_fetch_array有没有东西都会返回值
			//看不出有没有查出东西来
			$y=mysql_fetch_array($x);
			if($y['account']>0){
				$result['result']="重复";
			}else{
				$result['result']="可以使用";
			}
		}else{
			$result['result']="mysql_error()".$sql;
		}
	}else{
		$result['result']="格式存在问题";
	}
	echo json_encode($result,JSON_UNESCAPED_UNICODE);
}



if($post['cmd']=='CEMR'){
	CheckEmailRepeat($post);
}
function CheckEmailRepeat($post){
	if(preg_match("/^[a-z0-9\.\-]+\@([a-zA-Z0-9\-]+\.)+([a-zA-Z0-9]{2,4})$/",$post['em'])){
		$sql="SELECT account FROM Staff WHERE email='".$post['em']."'";
		if($x=mysql_query($sql)){
			$y=mysql_fetch_array($x);
			if($y['account']>0){
				$result['result']="重复";
			}else{
				$result['result']="可以使用";
			}
		}else{
			$result['result']=mysql_error();
		}
	}else{
		$result['result']="格式存在问题";
	}
	echo json_encode($result,JSON_UNESCAPED_UNICODE);
}

if($post['cmd']=='CTNR'){
	CheckTelNumberRepeat($post);
}
function CheckTelNumberRepeat($post){
	if(preg_match("/^([0-9\-]{6,18})+$/",$post['tn'])){
		$sql="SELECT account FROM Staff WHERE tel=".$post['tn'];
		if($x=mysql_query($sql)){
			$y=mysql_fetch_array($x);
			if($y['account']>0){
				$result['result']="重复";
			}else{
				$result['result']="可以使用";
			}
		}else{
			$result['result']=mysql_error();
		}
	}else{
		$result['result']="格式存在问题";
	}	echo json_encode($result,JSON_UNESCAPED_UNICODE);
}


/////////////////////////////////////////////////生成随机数

if($post["cmd"]=="SRI"){
	SaveRegisteInfo($post);
}

function SaveRegisteInfo($post){
	if(preg_match("/^[\x{4e00}-\x{9fa5}A-Z_a-z0-9]+$/u",$post['un'])&&(!preg_match("/^[0-9]+$/u",$post['un']))&&preg_match("/^[a-z0-9\.\-]+\@([a-zA-Z0-9\-]+\.)+([a-zA-Z0-9]{2,4})$/",$post['em'])&&preg_match("/^([0-9\-]{6,18})+$/",$post['tn'])){
		$sql="SELECT account FROM Staff WHERE name='".$post['un']."' or tel =".$post['tn']." or email='".$post['em']."' or name ='".$post['tn']."'";
		if($x=mysql_query($sql)){
			$y=mysql_fetch_array($x);
			if($y['account']>0){
				$result['result']="注册信息存在重复".$y['account'];
			}else{
				if(preg_match("/^[a-fA-F0-9]+$/",$post['pw'])){
					$sql="insert into Staff(name,companyname,tel,email,password) values ('".$post['un']."','".$post['cn']."','".$post['tn']."','".$post['em']."','".$post['pw']."')";
					if(mysql_query($sql)){ 
						$result['result']="注册成功";
					}else{
						$result['result']="数据库出错";
					}
				}else{
					$result['result']="错误";
				}
			}
		}
	}else{
		$result['result']="严重错误";
	}
	echo json_encode($result,JSON_UNESCAPED_UNICODE);
}
mysql_close($DBC);

?>
