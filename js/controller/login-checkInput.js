///////////////////////////使用xmlhttp必备函数
xmlhttp="";
function startXMLHttp()
{
	if(window.XMLHttpRequest)
        {
        	xmlhttp=new XMLHttpRequest();
        }
        else
        {
        	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
}
///////////////////////////使用xmlhttp必备函数

function getRandomCode()
{
	startXMLHttp();
        xmlhttp.onreadystatechange=function()
        {
		
        	if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                	randomCode=xmlhttp.responseText;
   //     document.getElementById("xxxx").innerHTML=randomCode;
                }
                else
                {

                }

	}
        xmlhttp.open("POST","../../phplib/model/login-check.php",true);
        xmlhttp.setRequestHeader("content-type","application/x-www-form-urlencoded");
        xmlhttp.send("phpCommand=getRandomCode&username="+document.getElementById("username").value);
}
////////////////////////md5(md5(密码)+登录随机码)_计算函数——————使用这个函数之前必须在html中引入md5.js
function md5Password()
{
	var a="";
        randomCode=parseInt(randomCode);	//xml的responseText回来的数据末尾有其他符号，这里从第一位转换正整数，以清洗掉末尾的不明符号
        randomCode=String(randomCode);		//转换回字符串
        a=hex_md5(document.getElementById("password").value)+randomCode;
        document.getElementById("password").value=hex_md5(a);
}
////////////////////////md5计算函数——————使用这个函数之前必须在html中引入md5.js


////////////////////////判断注册信息重复
function checkRepeat(checkSelect,value)
{
	var checkResult;
	startXMLHttp();
	xmlhttp.onreadystatechange=function()
        {

        	if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                	checkResult=xmlhttp.responseText;
	//		document.getElementById("emailCheckWarn").innerHTML=checkResult;
			if(checkSelect=="userName")
			{
				if(checkResult=="重复")	document.getElementById("userNameCheckWarn").innerHTML="重复，请重新输入";
				else		document.getElementById("userNameCheckWarn").innerHTML="可以使用";
			}
			
			if(checkSelect=="email")
			{
				if(checkResult=="重复")	document.getElementById("emailCheckWarn").innerHTML="重复，请重新输入";
				else		document.getElementById("emailCheckWarn").innerHTML="可以使用";
			}
			if(checkSelect=="telNumber")
			{
				if(checkResult=="重复")	document.getElementById("telNumberCheckWarn").innerHTML="重复，请重新输入";
				else		document.getElementById("telNumberCheckWarn").innerHTML="可以使用";
			}
                }
                else
                {
                }

	}
        xmlhttp.open("POST","../phplib/model/registe-check.php",true);
        xmlhttp.setRequestHeader("content-type","application/x-www-form-urlencoded");
	if(checkSelect=="userName")	xmlhttp.send("phpCommand=checkRepeatUsername&username="+document.getElementById("username").value);
	if(checkSelect=="email")	xmlhttp.send("phpCommand=checkRepeatEmail&email="+document.getElementById("email").value);
	if(checkSelect=="telNumber")	xmlhttp.send("phpCommand=checkRepeatTelNumber&telnumber="+document.getElementById("telnumber").value);

}

document.getElementById("companyCheckWarn").style.color="#ff0000";
document.getElementById("userNameCheckWarn").style.color="#ff0000";
document.getElementById("emailCheckWarn").style.color="#ff0000";
document.getElementById("telNumberCheckWarn").style.color="#ff0000";
document.getElementById("passwordCheckWarn").style.color="#ff0000";
document.getElementById("passwordConfirmCheckWarn").style.color="#ff0000";
//判断公司名符合规则——只允许中文文字/数字/大小写字母
function checkCompanyName(obj)
{
	var reg=new RegExp("[^A-Za-z\u4e00-\u9fa5]");
	if(obj.value.length=='0')
	{
		document.getElementById("companyCheckWarn").innerHTML="不能为空";
		return;
	}
	if(reg.test(obj.value))
	{
		document.getElementById("companyCheckWarn").innerHTML="存在非法字符，公司名只可由大小写字母和汉字组成";
		return;
	}else
	{
		document.getElementById("companyCheckWarn").innerHTML="字符检查通过";
		//这里到数据库检查用户名是否重复
	}

}
//判断用户名符合规则——只允许中文文字/数字/大小写字母/下划线
function checkUserName(obj)
{
	var reg=new RegExp("[^A-Z_a-z0-9\u4e00-\u9fa5]");
	if(obj.value.length=='0')
	{
		document.getElementById("userNameCheckWarn").innerHTML="不能为空";
		return;
	}
	if(reg.test(obj.value))
	{
		document.getElementById("userNameCheckWarn").innerHTML="存在非法字符，用户名只可由数字,大小写字母和汉字组成";
		return;
	}else
	{
		document.getElementById("userNameCheckWarn").innerHTML="字符检查通过，正在查询是否存在相同用户名";
		//这里到数据库检查用户名是否重复
		checkRepeat("userName",obj.value);



	}

}
function checkEmail(obj)
{
	var reg=new RegExp("([A-Z_a-z0-9\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})");
	if(obj.value.length=='0')
	{
		document.getElementById("emailCheckWarn").innerHTML="不能为空";
		return;
	}
	if(reg.test(obj.value))
	{
		document.getElementById("emailCheckWarn").innerHTML="字符检查通过，正在查询是否重复";
//ajax检查email重复

		checkRepeat("email",obj.value);
	}
	else
	{
		document.getElementById("emailCheckWarn").innerHTML="不符合规则";
		return;
	}
}

function checkTelNumber(obj)
{
	var reg=new RegExp("[0-9\-]");
	if(obj.value.length<=7)
	{
		document.getElementById("telNumberCheckWarn").innerHTML="不会少于7位";
		return;
	}
	if(reg.test(obj.value))
	{
		document.getElementById("telNumberCheckWarn").innerHTML="检查通过，正在查询是否重复";
		checkRepeat("telNumber",obj.value);
	}
	else
	{
		document.getElementById("telNumberCheckWarn").innerHTML="存在不允许的符号";
		return;
	}

}

function checkPassword(obj)
{
	var reg=new RegExp("((.?)+[A-Z_a-z]+(.?)+[0-9]+(.?)+)|((.?)+[0-9]+(.?)+[a-z_A-Z]+(.?)+)");
	if(obj.value.length<8)
	{
		document.getElementById("passwordCheckWarn").innerHTML="长度不小于8位";
		return;
	}
	if(reg.test(obj.value))
	{
		document.getElementById("passwordCheckWarn").innerHTML="   通过";
		return;
	}
	else
	{
		document.getElementById("passwordCheckWarn").innerHTML="必须同时包含数字和字母";
		return;
	}
}

function checkConfirmPassword(obj)
{
	if(obj.value==document.getElementById("password").value)
		document.getElementById("passwordConfirmCheckWarn").innerHTML="正确，请记住密码";
	else 	
		document.getElementById("passwordConfirmCheckWarn").innerHTML="需要与密码一致，请重新输入";
}
