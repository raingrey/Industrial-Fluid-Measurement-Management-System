$.getScript("./md5.js");
$("#CNI").blur(function(){
	var reg=new RegExp("[a-zA-Z0-9\u4e00-\u9fa5]");
	if(this.value.length=='0'){
		$("#CNCW").text("不能为空").css("color","red");
	}else if(!reg.test(this.value)){
		$("#CNCW").text("存在非法字符，用户名只可由数字,大小写字母和汉字组成").css("color","red");
	}else{
		$("#CNCW").text("可以使用").css("color","blue");
	}
});
//判断用户名符合规则——只允许中文文字/数字/大小写字母/下划线
$("#UNI").blur(function(){
	var reg=new RegExp("[a-zA-Z0-9\u4e00-\u9fa5]");
	if(this.value.length=='0'){
		$("#UNCW").text("不能为空").css("color","red");
	}else if(!reg.test(this.value)){
		$("#UNCW").text("存在非法字符，用户名只可由数字,大小写字母和汉字组成").css("color","red");
	}else{
		$("#UNCW").text(CheckUserNameRepeat()).css("color","blue");
	}
});

$("#EMI").blur(function(){
	var reg=new RegExp("([A-Z_a-z0-9\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})");
	if(this.value.length=='0'){
		$("#EMCW").text("不能为空").css("color","red");
	}else if(!reg.test(this.value)){
		$("#EMCW").text("不符合规则").css("color","red");
	}else{
		$("#EMCW").text(CheckEmailRepeat()).css("color","blue");
	}
});
$("#TNI").blur(function(){
	var reg=new RegExp("[0-9\-]");
	if(this.value.length<8){
		$("#TNCW").text("需要8位以上").css("color","red");
	}else if(!reg.test(this.value)){
		$("#TNCW").text("存在不允许的符号").css("color","red");
	}else{
		;
		$("#TNCW").text(CheckTelNumberRepeat()).css("color","blue");
	}
});
$("#PWI").blur(function(){
	var reg=new RegExp("((.?)+[A-Z_a-z]+(.?)+[0-9]+(.?)+)|((.?)+[0-9]+(.?)+[a-z_A-Z]+(.?)+)");
	if(this.value.length<8){
		$("#PWCW").text("不能少于8位").css("color","red");
	}else if(!reg.test(this.value)){
		$("#PWCW").text("必须同时包含数字和字母").css("color","red");
	}else{
		$("#PWCW").text("符合规则").css("color","green");
	}
});

$("#PWCI").blur(function(){
	if(this.value == $("#PWI").val())
		$("#PWCCW").text("请妥善保存密码").css("color","green");
	else 	
		$("#PWCCW").text("两次密码输入不一致").css("color","red");
});

$("#RB").click(function(t){
	t.preventDefault();
	$.post(
		"./u-R.php",
		{"cmd":"SRI",
		"cn":$("#CNI").val(),
		"un":$("#UNI").val(),
		"em":$("#EMI").val(),
		"pw":hex_md5($("#PWI").val()),
		"tn":$("#TNI").val()},
		function(data){
//			alert(data.result);
			window.location.href="index.html";
	},"json");

});


function CheckUserNameRepeat(){
	$.post(
		"./u-R.php",
		{"cmd":"CUNR","un":$("#UNI").val()},
		function(data){
			$("#UNCW").text(data.result).css("color","red");
	},"json");
	return "正在通讯";
}
function CheckEmailRepeat(){
	$.post(
		"./u-R.php",
		{"cmd":"CEMR",
		"em":$("#EMI").val()},
		function(data){
			$("#EMCW").text(data.result).css("color","red");
	},"json");
	return "正在通讯";

}
function CheckTelNumberRepeat(){
	$.post(
		"./u-R.php",
		{"cmd":"CTNR","tn":$("#TNI").val()},
		function(data){
			$("#TNCW").text(data.result).css("color","red");
	},"json");
	return "正在通讯";
}


