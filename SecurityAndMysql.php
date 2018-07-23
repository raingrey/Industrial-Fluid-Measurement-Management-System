<?php
function getfilter(){
//过滤$_GET来的数据
	foreach($_GET as $get_key=>$get_var)
	{
		if(is_numeric($get_var))
		{
			$get[strtolower($get_key)]=get_int($get_var);
		}
		else
		{
			$get[strtolower($get_key)]=get_str($get_var);
		}
	}
	return $get;
}
function postfilter(){
//过滤$_POST来的数据
	foreach($_POST as $post_key=>$post_var){
		if(is_array($post_var)){
			foreach($post_var as $item => $value){
				if(is_numeric($value))
					$post[strtolower($post_key)][strtolower($item)]=get_int($value);
				else
					$post[strtolower($post_key)][strtolower($item)]=get_str($value);
			}
		}else{
			if(is_numeric($post_var))
				$post[strtolower($post_key)]=get_int($post_var);
			else	$post[strtolower($post_key)]=get_str($post_var);
				
		}
	}
	return $post;
}
//整型过滤函数
function get_int($number)
{
	return intval($number);
}
//字符串过滤函数
function get_str($string)
{
	if(!get_magic_quotes_gpc())
	{
		return addslashes($string);
	}
	return $string;
}

session_start();
$DBC=MysqlCon();
mysql_select_db("tcp",$DBC);
if(CheckSecurity()){

}else{

}
mysql_close($DBC);

function CheckSecurity(){

}
function MysqlCon()
{
//address
	$localUrl="localhost";
//user
	$localUser="root";
//password
	$localPassword="ytfy1032744819";
	$DBC=mysql_connect($localUrl,$localUser,$localPassword);

	if(!$DBC)
	{
		die("connect failed" . mysql_error());
	}else
	{
		mysql_query("set names 'utf8'");
	}
	return $DBC;
}


?>
