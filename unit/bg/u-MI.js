/*****************MeterIdentify*****************************/
/**********************************************************
 * made for u-MI.html
 * this should loaded after u-MI.html
 * @raingrey 2017/9/11
 * */
$("#applyMeterID").click(function(t){
	t.preventDefault();
	$("#inputMeterID").attr("readonly",true);
	$.post(	"u-MI.php",
		{"cmd":"applyMeterID"},
		function(data){
			$("#inputMeterID").val(data.meterID).attr("readonly",true);
		},
		"json");
});
