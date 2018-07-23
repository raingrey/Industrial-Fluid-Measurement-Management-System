/*****************DisplayFlowMeter*****************************/

var FMDINFO=new Object();
var FMDP=new Object();

$.post(
	"../unit/bg/u-DFM.php",
	{"cmd":"GMID"},
	function(data){
		j=0;
		for(i in data){
			if(data[i].meterID){
				FMDINFO[j]=data[i];
				if(!FMDINFO[j].meterName){
					FMDINFO[j].meterName=FMDINFO[j].meterID;
				}
				switch(FMDINFO[j].ord){
					case "1":
						if(!FMDINFO[j].dataName){
							FMDINFO[j].dataName="瞬时流量";
						}
						if(!FMDINFO[j].unit){
							FMDINFO[j].unit="未知单位-默认kg/h";
						}
					break;
					case "2":
						FMDINFO[j].dataName="累积流量";
						FMDINFO[j].unit="未知单位-默认t/h";
					break;
					case "3":
						FMDINFO[j].dataName="温度";
						FMDINFO[j].unit="未知单位-默认摄氏度";
					break;
					case "4":
						FMDINFO[j].dataName="压力";
						FMDINFO[j].unit="未知单位-默认KPa";
					break;
					case "5":
						FMDINFO[j].dataName="差压";
						FMDINFO[j].unit="未知单位-默认Pa";
					break;
					case "6":
						FMDINFO[j].dataName="更新时间";
						FMDINFO[j].unit="time";
					break;
					case "7":
						FMDINFO[j].dataName="自定义1";
						FMDINFO[j].unit="未知单位";
					break;
					case "8":
						FMDINFO[j].dataName="自定义2";
						FMDINFO[j].unit="未知单位";
					break;
					case "9":
						FMDINFO[j].dataName="自定义3";
						FMDINFO[j].unit="未知单位";
					break;
					case "10":
						FMDINFO[j].dataName="自定义4";
						FMDINFO[j].unit="未知单位";
					break;
					case "11":
						FMDINFO[j].dataName="自定义5";
						FMDINFO[j].unit="未知单位";
					break;
					case "12":
						FMDINFO[j].dataName="自定义6";
						FMDINFO[j].unit="未知单位";
					break;
					case "13":
						FMDINFO[j].dataName="自定义7";
						FMDINFO[j].unit="未知单位";
					break;
					case "14":
						FMDINFO[j].dataName="自定义8";
						FMDINFO[j].unit="未知单位";
					break;
					case "15":
						FMDINFO[j].dataName="自定义9";
						FMDINFO[j].unit="未知单位";
					break;
					case "16":
						FMDINFO[j].dataName="自定义10";
						FMDINFO[j].unit="未知单位";
					break;
					case "17":
						FMDINFO[j].dataName="自定义11";
						FMDINFO[j].unit="未知单位";
					break;
					case "18":
						FMDINFO[j].dataName="自定义12";
						FMDINFO[j].unit="未知单位";
					break;
					case "19":
						FMDINFO[j].dataName="自定义13";
						FMDINFO[j].unit="未知单位";
					break;
					case "20":
						FMDINFO[j].dataName="自定义14";
						FMDINFO[j].unit="未知单位";
					break;
					default:
					break;
					}
				j++;
			}
		}

		AddFMToDOM();
		AppendFMDINFOToPanel();
		$.post(
			"./unit/bg/u-DFM.php",
			{"cmd":"GFMDP"},
			function(data){
				j=0;
				for(i in data){
					if(data[i].meterID){
						FMDP[j]=data[i];
						j++;
					}

				}
				AppendFMDToP();
				$.getScript("../assets/js/core.min.js");
				$.getScript("../assets/js/pages/ui-portlets.js");
			},
		"json");
	},
"json");

function AppendFMDToP(){
	for(i in FMDP){
		if(FMDP[i].instantFlow&&($("#FMID"+FMDP[i].meterID+" .1").length>0)){
			$("#FMID"+FMDP[i].meterID+" .1").append(FMDP[i].instantFlow);
		}
		if(FMDP[i].totalFlow&&($("#FMID"+FMDP[i].meterID+" .2").length>0)){
			$("#FMID"+FMDP[i].meterID+" .2").append(FMDP[i].totalFlow);
		}
		if(FMDP[i].T&&($("#FMID"+FMDP[i].meterID+" .3").length>0)){
			$("#FMID"+FMDP[i].meterID+" .3").append(FMDP[i].T);
		}
		if(FMDP[i].P&&($("#FMID"+FMDP[i].meterID+" .4").length>0)){
			$("#FMID"+FMDP[i].meterID+" .4").append(FMDP[i].P);
		}
		if(FMDP[i].DP&&($("#FMID"+FMDP[i].meterID+" .5").length>0)){
			$("#FMID"+FMDP[i].meterID+" .5").append(FMDP[i].DP);
		}
		if(FMDP[i].timestamp&&($("#FMID"+FMDP[i].meterID+" .6").length>0)){
			$("#FMID"+FMDP[i].meterID+" .6").append(FMDP[i].timestamp);
		}

		if(FMDP[i].sysTime){
			$("#FMID"+FMDP[i].meterID+" .panel-body").append("<p>"+FMDP[i].sysTime+"(sysTime)</p>");
		}
	}
}

function AddFMToDOM(){
//alert(MID.meterID);

	for(i in FMDINFO){
		if(!($("#FMID"+FMDINFO[i].meterID).length>0)){
			$("#monitor").append(
				"<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12' id='FMID"+FMDINFO[i].meterID+"' data-plugin-portlet>"+
					"<div class='panel panel-primary'  data-portlet-item>"+
						"<div class='panel-heading portlet-handler'>"+
							"<h6><i class='fa fa-signal'></i>仪表-"+FMDINFO[i].meterName+"</h6>"+
							"<div class='panel-actions'>"+
								"<a href='#' class='btn-minimize'><i class='fa fa-caret-up'></i></a>"+
								"<a href='#' class='btn-close'><i class='fa fa-times'></i></a>"+
							"</div>"+
						"</div>"+
						"<div class='panel-body'>");

			$("#monitor").append(
						"</div>"+
					"</div>"+
				"</div>");
		}
	}
	//this should added after add DOM
}

function AppendFMDINFOToPanel(){
	for(i in FMDINFO){
		if(!($("#FMID"+FMDINFO[i].meterID+" ."+FMDINFO[i].ord).length>0)){
			$("#FMID"+FMDINFO[i].meterID+" .panel-body").append("<p class="+FMDINFO[i].ord+">"+FMDINFO[i].dataName+"("+FMDINFO[i].unit+"):</p>");
		}
	}
}


/******waiting for change**********
	if(FMDP.T){
		if(FMDI.T){
			$("#monitor").append("<p>"+FMDI.T+":"+FMDP.T+"-"+FMDI.TUnit+"</p>");
		}else{
			$("#monitor").append("<p>流体温度:"+FMDP.T+"-"+FMDI.TUnit+"</p>");
		}
	}
	if(FMDP.P){
		if(FMDI.P){
			$("#monitor").append("<p>"+FMDI.P+":"+FMDP.P+"-"+FMDP.TUnit+"</p>");
		}else{
			$("#monitor").append("<p>流体压力:"+FMDP.P+"-"+FMDI.PUnit+"</p>");
		}
	}
	if(FMDP.DP){
		if(FMDI.DP){
			$("#monitor").append("<p>"+FMDI.DP+":"+FMDP.DP+"-"+FMDI.DPUnit+"</p>");
		}else{
			$("#monitor").append("<p>差压:"+FMDP.DP+"-"+FMDI.DPUnit+"</p>");
		}
	}
	if(FMDS.ord7){
		if(FMDI.ord7){
			$("#monitor").append("<p>"+FMDI.ord7+":"+FMDP.ord7+"-"+FMDI.ord7Unit+"</p>");
		}else{
			$("#monitor").append("<p>自定类型:"+FMDP.ord7+"-"+FMDI.ord7Unit+"</p>");
		}
	}
	if(FMDS.ord8){
		if(FMDI.ord8){
			$("#monitor").append("<p>"+FMDI.ord8+":"+FMDP.ord8+"-"+FMDI.ord8Unit+"</p>");
		}else{
			$("#monitor").append("<p>自定类型:"+FMDP.ord8+"-"+FMDI.ord8Unit+"</p>");
		}
	}
	if(FMDS.ord9!=null){
		if(FMDI.ord9!=null){
			$("#monitor").append("<p>"+FMDI.ord9+":"+FMDP.ord9+"-"+FMDI.ord9Unit+"</p>");
		}else{
			$("#monitor").append("<p>自定类型:"+FMDP.ord9+"-"+FMDI.ord9Unit+"</p>");
		}
	}
	if(FMDS.ord10!=null){
		if(FMDI.ord10!=null){
			$("#monitor").append("<p>"+FMDI.ord10+":"+FMDP.ord10+"-"+FMDI.ord10Unit+"</p>");
		}else{
			$("#monitor").append("<p>自定类型:"+FMDP.ord10+"-"+FMDI.ord10Unit+"</p>");
		}
	}
	if(FMDS.ord11!=null){
		if(FMDI.ord11!=null){
			$("#monitor").append("<p>"+FMDI.ord11+":"+FMDP.ord11+"-"+FMDI.ord11Unit+"</p>");
		}else{
			$("#monitor").append("<p>自定类型:"+FMDP.ord11+"-"+FMDI.ord11Unit+"</p>");
		}
	}
	if(FMDS.ord12!=null){
		if(FMDI.ord12!=null){
			$("#monitor").append("<p>"+FMDI.ord12+":"+FMDP.ord12+"-"+FMDI.ord12Unit+"</p>");
		}else{
			$("#monitor").append("<p>自定类型:"+FMDP.ord12+"-"+FMDI.ord12Unit+"</p>");
		}
	}
	if(FMDS.ord13!=null){
		if(FMDI.ord13!=null){
			$("#monitor").append("<p>"+FMDI.ord13+":"+FMDP.ord13+"-"+FMDI.ord13Unit+"</p>");
		}else{
			$("#monitor").append("<p>自定类型:"+FMDP.ord13+"-"+FMDI.ord13Unit+"</p>");
		}
	}
	if(FMDS.ord14!=null){
		if(FMDI.ord14!=null){
			$("#monitor").append("<p>"+FMDI.ord14+":"+FMDP.ord14+"-"+FMDI.ord14Unit+"</p>");
		}else{
			$("#monitor").append("<p>自定类型:"+FMDP.ord14+"-"+FMDI.ord14Unit+"</p>");
		}
	}
	if(FMDS.ord15!=null){
		if(FMDI.ord15!=null){
			$("#monitor").append("<p>"+FMDI.ord15+":"+FMDP.ord15+"-"+FMDI.ord15Unit+"</p>");
		}else{
			$("#monitor").append("<p>自定类型:"+FMDP.ord15+"-"+FMDI.ord15Unit+"</p>");
		}
	}
	if(FMDS.ord16!=null){
		if(FMDI.ord16!=null){
			$("#monitor").append("<p>"+FMDI.ord16+":"+FMDP.ord16+"-"+FMDI.ord16Unit+"</p>");
		}else{
			$("#monitor").append("<p>自定类型:"+FMDP.ord16+"-"+FMDI.ord16Unit+"</p>");
		}
	}
	if(FMDS.ord17!=null){
		if(FMDI.ord17!=null){
			$("#monitor").append("<p>"+FMDI.ord17+":"+FMDP.ord17+"-"+FMDI.ord17Unit+"</p>");
		}else{
			$("#monitor").append("<p>自定类型:"+FMDP.ord17+"-"+FMDI.ord17Unit+"</p>");
		}
	}
	if(FMDS.ord18!=null){
		if(FMDI.ord18!=null){
			$("#monitor").append("<p>"+FMDI.ord18+":"+FMDP.ord18+"-"+FMDI.ord18Unit+"</p>");
		}else{
			$("#monitor").append("<p>自定类型:"+FMDP.ord18+"-"+FMDI.ord18Unit+"</p>");
		}
	}
	if(FMDS.ord19!=null){
		if(FMDI.ord19!=null){
			$("#monitor").append("<p>"+FMDI.ord19+":"+FMDP.ord19+"-"+FMDI.ord19Unit+"</p>");
		}else{
			$("#monitor").append("<p>自定类型:"+FMDP.ord19+"-"+FMDI.ord19Unit+"</p>");
		}
	}
	if(FMDS.ord20!=null){
		if(FMDI.ord20!=null){
			$("#monitor").append("<p>"+FMDI.ord20+":"+FMDP.ord20+"-"+FMDI.ord20Unit+"</p>");
		}else{
			$("#monitor").append("<p>自定类型:"+FMDP.ord20+"-"+FMDI.ord20Unit+"</p>");
		}
	}
******waiting for change**********/

/*****************DisplayFlowMeter*****************************/
