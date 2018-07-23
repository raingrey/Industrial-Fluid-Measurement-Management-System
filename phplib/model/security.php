<?php
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
//过滤$_POST来的数据
foreach($_POST as $post_key=>$post_var)
{
	if(is_array($post_var))
	{
		foreach($post_var as $item => $value)
		{
			if(is_numeric($value))
			{
				$post[strtolower($post_key)][strtolower($item)]=get_int($value);
			}
			else
			{
				$post[strtolower($post_key)][strtolower($item)]=get_str($value);
			}
		
		}
	}
	else
	{
	if(is_numeric($post_var))
	{
		$post[strtolower($post_key)]=get_int($post_var);
	}
	else
	{
		$post[strtolower($post_key)]=get_str($post_var);
	}	
	}
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
?>
