/*****************ManageFlowMeter*****************************/
var DataIdentify = {
	"cmd"	:	"",
	"meterID":	"",
	"dataName":	"",
	"modbusAddr":	"",
	"byteNumber":	"",
	"dataType":	""
}
var FMINFO=new Object();
/********************Generate flow meter button*********************/
/********************Apply flow meter button handler****************/
/********************Add flow meter infomation to page**************/
/********************Add flow meter protocol to page****************/
/**Apply flow meter information/protocol changer and deleter********/
$.post(
	"../unit/bg/u-MFM.php",
	{"cmd":"GMI"},
	function(data){
		j=0;
		for(i in data){
			if(data[i].meterID){
				FMINFO[j]=data[i];
				if(!FMINFO[j].meterName){
					FMINFO[j].meterName=data[i].meterID;
				}
				if(!($("#FMBID"+FMINFO[j].meterID).length>0)){
					$("#monitor").append("<button type='button' class='bk-margin-10 btn btn-primary btn-lg' id='FMBID"+FMINFO[j].meterID+"'>仪表-"+FMINFO[j].meterName+"</button>");
					$("#FMBID"+FMINFO[j].meterID).click(FMINFO[j],function(t){
						$("#MIDP").html("");
						if(!($("#MI"+t.data.meterID).length>0)){
							$("#MIDP").append("<div id='MI"+t.data.meterID+"'></div>");
						}
//						alert(t.data.meterID);
						AddMIToDOM("MI"+t.data.meterID,t.data);
						$.post(
							"./unit/bg/u-MFM.php",
							{"cmd":"GDP","meterid":t.data.meterID},
							function(data){
								for(i in data){
									if(data[i].meterID){
										if(!($("#DP"+data[i].meterID).length>0)){
											$("#MIDP").append("<div id='DP"+data[i].meterID+data[i].ord+"'></div>");
											AddDPToDOM("DP"+data[i].meterID+data[i].ord,data[i]);
								}
									}
								}
							},
						"json");
					});
				}
				j++;
			}
		}
		$("#monitor").append("<span id='MIDP'></span>");
//导航栏回弹问题
//		$.getScript("../assets/js/core.min.js");
//		$.getScript("../assets/js/pages/ui-portlets.js");
	},
"json");
/********************Generate flow meter button*********************/
/********************Apply flow meter button handler****************/
/********************Add flow meter infomation to page**************/
/********************Add flow meter protocol to page**************/
/**Apply flow meter information/protocol changer and deleter********/



function AddDPToDOM(thisid,data0){
//			alert(data0.meterID);
	$.post(
		"./unit/bg/u-MFMDP.html",
		function(data){
			$("#"+thisid).html(data);
			$("#"+thisid+" .inputMeterID1").val(data0.meterID);
//			alert(data0.ord);
			if(data0.ord<"7")
				$("#"+thisid+" .dataRealName").val(data0.ord);
			else{
				$("#"+thisid+" .udfdata").css('display','block');
				$("#"+thisid+" .dataRealName").val(0);
				$("#"+thisid+" .udfdataname").val(data0.dataName);
			}
			$("#"+thisid+" .alias").val(data0.dataName);
			$("#"+thisid+" .addrNum").val(data0.address);
			$("#"+thisid+" .dataType").val(data0.dataType);
			$("#"+thisid+" .dataType").val(data0.dataType);
			$("#"+thisid+" .byteNumber").val(data0.byteNumber);
//						alert(data0);


			$("#"+thisid+" .btnSDI").click(function(t){
				t.preventDefault();
				DataIdentify.cmd="SDI";
				DataIdentify.meterID=$("#"+thisid+" .inputMeterID1").val();
				if(($("#"+thisid+" .alias").val().length==0))
					DataIdentify.dataName=$("#"+thisid+" .dataRealName option:selected").text();
				else
					DataIdentify.dataName=$("#"+thisid+" .alias").val();
				DataIdentify.ord=$("#"+thisid+" .dataRealName option:selected").val();
				DataIdentify.modbusAddr=$("#"+thisid+" .addrNum").val();
				DataIdentify.dataType=$("#"+thisid+" .dataType").val();
				DataIdentify.byteNumber=$("#"+thisid+" .byteNumber").val();


				if((isName($("#"+thisid+" .alias").val())==false)&&($("#"+thisid+" .alias").val().length!=0)){
					$("#"+thisid+" .alias").next("p").css("color","red");
					return;
				}
				if(isAddrNum($("#"+thisid+" .addrNum").val())==false){
					$("#"+thisid+" .addrNum").next("p").css("color","red");
					return;
				}
				if((isName($("#"+thisid+" .udfdataname").val())==false)&&($("#"+thisid+" .udfdataname").val().length!=0)){
					$("#"+thisid+" .udfdataname").next("p").css("color","red");
					return;
				}
			//alert("xxxxxxxo");
				$.post(	"unit/bg/u-MFM.php",
					DataIdentify,
					function(data){
						if(data.result=="ModBus协议信息已保存"){
							$("#"+thisid+" .DP").children(".alert-danger").remove();
							$("#"+thisid+" .inputDTUID").attr("readonly",true);
							$("#"+thisid+" .panel-body").prepend("<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'>×</button>仪表 <span class='dimid'>"
							+DataIdentify.meterID+"</span>,数据阶 <span class='dio'>"
							+DataIdentify.ord+"</span>,数据名 <span class='didn'>"
							+DataIdentify.dataName+"</span>,地址 <span class='dimba'>"
							+DataIdentify.modbusAddr+"</span>,数据类型 <span class='didt'>"
							+DataIdentify.dataType+"</span>,数据大小 <span class='dibn'>"
							+DataIdentify.byteNumber+"</span>字节(byte).<strong>保存成功!</strong><button type='reset' class='bk-margin-5 btn btn-warning btn-xs' onclick='CancleDataIdentify($(this))'>取消保存</button></div>");
						}else{
							$("#DP").append("<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>×</button>仪表 "+data.meterID+"<strong>保存失败!详情请致电15304006188。</strong>服务器返回信息："+data.result+"</div>");
						}
					},"json");
			});
			$("#"+thisid+" .btnCDI").click(function(t){
				t.preventDefault();
				DataIdentify.cmd="CDI";
				DataIdentify.meterID=$("#"+thisid+" .inputMeterID1").val();
				if(($("#"+thisid+" .alias").val().length==0))
					DataIdentify.dataName=$("#"+thisid+" .dataRealName option:selected").text();
				else
					DataIdentify.dataName=$("#"+thisid+" .alias").val();
				DataIdentify.ord=$("#"+thisid+" .dataRealName option:selected").val();
				DataIdentify.modbusAddr=$("#"+thisid+" .addrNum").val();
				DataIdentify.dataType=$("#"+thisid+" .dataType").val();
				DataIdentify.byteNumber=$("#"+thisid+" .byteNumber").val();


				if(isAddrNum($("#"+thisid+" .addrNum").val())==false){
					$("#"+thisid+" .addrNum").next("p").css("color","red");
					return;
				}
			//alert("xxxxxxxo");
				$.post(	"unit/bg/u-MFM.php",
					DataIdentify,
					function(data){
						if(data.result=="ModBus协议信息已清除"){
							$("#"+thisid+" .DP").remove();
						}else{
							$("#"+thisid+" .panel-body").append("<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>×</button>序号 "+data.meterID+"的仪表 <strong>清除失败!详情请致电15304006188。</strong>服务器返回信息："+data.result+"</div>");
						}
							$("#"+thisid+" .inputMeterID1").val(DataIdentify.meterID);

					},"json");
			});


		}
	);

}

function CancleDataIdentify(obj){
	DataIdentify.cmd="CDI";
	DataIdentify.meterID=obj.parent(".alert-success").children(".dimid").text();
	DataIdentify.ord=obj.parent(".alert-success").children(".dio").text();
	DataIdentify.dataName=obj.parent(".alert-success").children(".didn").text();
	DataIdentify.modbusAddr=obj.parent(".alert-success").children(".dimba").text();
	DataIdentify.dataType=obj.parent(".alert-success").children(".didt").text();
	DataIdentify.byteNumber=obj.parent(".alert-success").children(".dibn").text();
	$.post(	"unit/bg/u-MFM.php",
		DataIdentify,
		function(data){
			if(data.result=="ModBus协议信息已清除"){
				$("#DP"+DataIdentify.meterID+DataIdentify.ord).remove();
			}else{
				$("#DP"+DataIdentify.meterID+DataIdentify.ord+" .DP").append("<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>×</button>序号 "+data.meterID+"的仪表 <strong>清除失败!详情请致电15304006188。</strong>服务器返回信息："+data.result+"</div>");
			}
		},"json");
}


function AddMIToDOM(thisid,data0){
//alert(MID.meterID);
	$.post(
		"./unit/bg/u-MFMMI.html",
		function(data){
			$("#"+thisid).html(data);
			$("#"+thisid+" .inputMeterID").val(data0.meterID);
			$("#"+thisid+" .inputDTUID").val(data0.DTUID);
			$("#"+thisid+" .inputModBusAddr").val(data0.deviceNumber);

			$("#"+thisid+" .btnSMI").click(function(t){ 
				t.preventDefault();
				MeterIdentify.cmd="UMI";
				MeterIdentify.meterID=$("#"+thisid+" .inputMeterID").val();
				MeterIdentify.DTUID=$("#"+thisid+" .inputDTUID").val();
				MeterIdentify.modbusAddr=$("#"+thisid+" .inputModBusAddr").val();
				if(isDTUID(MeterIdentify.DTUID) == false){
					$("#inputDTUID").next("p").css("color","red");
					return;
				}
				if(isModBusAddr(MeterIdentify.modbusAddr)== false){
					alert(MeterIdentify.modbusAddr);
					$("#inputModBusAddr").next("p").css("color","red");
					return;
				}

				$.post(	"unit/bg/u-MFM.php",
					MeterIdentify,
					function(data){
						if(data.result=="仪表信息已保存"){
							$("#"+thisid+" .panel-body").append("<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'>×</button>序号 "+data.meterID+"的仪表 <strong>更新成功!。</strong></div>");
							$("#"+thisid+" .inputModBusAddr").attr("readonly",true);
							$("#"+thisid+" .inputDTUID").attr("readonly",true);
							$("#"+thisid+" .inputmeterid").val(data.meterID).attr("readonly",true).css("color","green");
						}else{
							$("#"+thisid+" .panel-body").append("<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>×</button>序号 "+data.meterID+"的仪表 <strong>保存失败!详情请致电15304006188。</strong>服务器返回信息："+data.result+"</div>");
						}
					},"json");
			});

			$("#"+thisid+" .btnCMI").click(function(t){
				t.preventDefault();
				midtmp=$("#"+thisid+" .inputMeterID").val();
	
				$.post(	"./unit/bg/u-MFM.php",
					{"cmd":"CMI","meterid":midtmp},
					function(data){
//alert(data);
						if(data.meterID!="0"){
							$("#MIDP").html("");
							$("#FMBID"+data.meterID).remove();
							$("#"+thisid).append("<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'>×</button>序号 "+data.meterID+"的仪表 <strong>已经清除!</strong>服务器返回信息："+data.result+"</div>");
							$("#"+thisid+" .inputModBusAddr").removeAttr("readonly");
							$("#"+thisid+" .inputDTUID").removeAttr("readonly");
							$("#"+thisid+" .inputmeterid").val("").removeAttr("readonly").css("color","red");
						}else{
							$("#"+thisid+" .panel-body").append("<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>×</button>序号 "+data.meterID+"的仪表 <strong>清除失败!详情请致电15304006188。</strong>服务器返回信息："+data.result+"</div>");
						}
				},"json");
			});



//						alert(data0);
		}
	);
}



function isDTUID(dtuid){
	var reg= /^\d{15}$/;
	return reg.test(dtuid);
}
function isModBusAddr(modbusaddr){
	if((modbusaddr<256))
		return true;
	else
		return false;
}


