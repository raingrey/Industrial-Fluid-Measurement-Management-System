$.getScript("./md5.js");
$("#RB").click(function(t){
	t.preventDefault();
	$.post(
		"./u-R.php",
		{"cmd":"SRI",
		"un":$("#UNI").val(),
		"em":$("#EMI").val(),
		"pw":hex_md5($("#PWI").val()),
		"tn":$("#TNI").val()},
		function(data){
//			alert(data.result);
			window.location.href="u-L.html";
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


