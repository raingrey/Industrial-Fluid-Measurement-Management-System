$.getScript("./md5.js");
$.getScript("js/jquery.cookie.js");
var Salt="";
var pw="";

$("#UNI").mouseenter(function(){
	if($.cookie('un')){
		$("#UNI").val($.cookie('un'));
		$("#RM").attr("checked",'true');
		if(Salt){
			;
		}else{
			GetSalt();
		}
	}
});
$("#UNI").blur(function(){
	var reg1=new RegExp("([A-Z_a-z0-9\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})");
	var reg2=new RegExp("[0-9\-]");
	var reg3=new RegExp("[a-zA-Z0-9\u4e00-\u9fa5]");
	if(this.value.length=='0'){
		$("#UNCW").text("不能为空").css("color","red");
	}else if((!reg1.test(this.value))&&(!reg2.test(this.value))&&(!reg3.test(this.value))){
		$("#UNCW").text("错误").css("color","red");
	}else{

		GetSalt();
	}
});


$("#PWI").blur(function(){
	if(this.value.length=='0'){
		$("#PWCW").text("不能为空").css("color","red");
	}else{
		$("#PWCW").text("").css("color","green");
		if(Salt){
			pw=hex_md5(hex_md5($("#PWI").val())+Salt);
		}else{
			$("#PWCW").text("无法登录").css("color","red");
			window.location.href="./index.html";
		}
	}
});
$("#LOGIN").click(function(t){
	t.preventDefault;
	$("#PWI").val("");
	if(Salt){
	$.post(
		"./u-L.php",
		{"cmd":"LOGIN",
		"un":$("#UNI").val(),
		"pw":pw},
		function(data){
			Salt="";
			$("#UNCW").text(data.result).css("color","blue");
			if(data.result=="登录成功"){
/*				if($("#RM").is(':checked')){
					$.cookie('un',data.un,{expires:180,path:'/'});
				}else{
					$.cookie('un','',{path:'/'});
				}
*/
				window.location.href="./bg.html";
				alert("欢迎"+data.un+"登录");
			}
	},"json");
	}else{
		GetSalt();
		alert("服务器忙,请重试");
	}
});
function GetSalt(){
	$.post(
		"./u-L.php",
		{"cmd":"GS","un":$("#UNI").val()},
		function(data){
			$("#UNCW").text(data.result).css("color","red");
			Salt=data.salt;
	},"json");
	return "正在请求加盐";
}
