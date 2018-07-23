$.getScript("./md5.js");
$.getScript("assets/vendor/js/jquery.cookie.js");
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
	GetSalt();
});


$("#PWI").blur(function(){
	if(Salt){
		pw=hex_md5(hex_md5($("#PWI").val())+Salt);
	}else{
		$("#PWCW").text("无法登录").css("color","red");
		window.location.href="./u-L.html";
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
				if($("#RM").is(':checked')){
					$.cookie('un',data.un,{expires:180,path:'/'});
				}else{
					$.cookie('un','',{path:'/'});
				}

				window.location.href="./bg.html";
				alert("欢迎"+data.un+"登录");
				alert("cooike"+$.cookie('un')+"登录");
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
