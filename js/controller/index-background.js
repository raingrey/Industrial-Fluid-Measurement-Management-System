
var basicAttr={
		"command":"",
		"basicAttrName":"",
		"adminName":[],
		"unitConnect":[],
		"instantFlowUnit":"",
		"instantFlowUpperLimit":"",
		"instantFlowLowerLimit":"",
		"instantFlowAlarmUpperLimit":"",
		"instantFlowAlarmLowerLimit":"",
	};
var transmitter=
	{
		"command":"",
		"basicAttrName":"",
		"sensorName":"",
		"sensorUnit":"",
		"sensorSignalUpperLimit":"",
		"sensorSignalLowerLimit":"",
		"sensorAlarmUpperLimit":"",
		"sensorAlarmLowerLimit":"",
		"sensorFixedValue":"",
		"sensorDampingTime":"",
		"sensorSmallSignalResection":""
	};
var primaryElement=
	{
		"basicAttrName":"",
		"command":"",
		"primaryElementName":"",
		"orificeDiameter":"",
		"throttleElementMaterial":"",
		"throttleElementExpansion":"",
		"kPoint1":"",
		"kPoint2":"",
		"kPoint3":"",
		"kPoint4":"",
		"kPoint5":"",
		"kPointInterval1":"",
		"kPointInterval2":"",
		"kPointInterval3":"",
		"kPointInterval4":"",
		"C_Vcone":""
	};
var operatingParameters=
	{
		"basicAttrName":"",
		"command":"",
		"mediumName":"",
		"localAtmospherePressure":"",
		"pipeDiameter":"",
		"pipeMaterial":"",
		"pipeExpansion":"",
		"viscosity":"",
		"isentropic":"",
		"liquidExpansion":"",
		"dryDegree":"",
		"mediumExpansion":"",
		"criticalTemperature":"",
		"criticalPressure":""
	};
var communicationParameters=
	{
		"basicAttrName":"",
		"command":"",
		"dataSyncFreq":"",
		"outputSignalType":"",
		"bandrate485":"",
		"address485":"",
		"freqmAUpperLimit":"",
		"freqmALowerLimit":""
	};

var deleteTransmitter=
	{
		"command":"",
		"basicAttrName":"",
		"sensorName":""
	
	};
var currentUserName="";
$(document).ready(function(){
	$(".active").children(".toggle-content").slideDown();
	$(".toggle").on("click",function(e){
		if(e.target.nodeName=="LABEL")//xx.target属性指向接收事件的目标DOM元素,nodName是元素名,还有放有其他DOM属性
		{
			$(this).toggleClass("active").children(".toggle-content").slideToggle();
		}
	});
	$("#adminIDBtn").droppable({
		drop: function(event,ui){
		ui.draggable.addClass("label-default").removeClass("label-success");
		},
		accept: ".adminBtn"
	});
	$("#unitAdmin").droppable({
		drop: function(event,ui){
			ui.draggable.addClass("label-success").removeClass("label-default");
		},
		hoverClass: 'btndrop-hover',
		accept: ".adminBtn"
	});
	jsonData={"command":"getCompanyStaff"};
	$.post(
		"../phplib/model/ajaxIndexBackground.php",
		jsonData,
		function(data){
			//alert(data);
			for(i in data){
				if(data[i]!=false)
				{
					$("#adminIDBtn").append("<div class='adminBtn label label-default' id='staff"+i+"' >"+data[i]+"</div>").children(".adminBtn").css({"cursor":"move","display":"inline-block"});
					$("#staff"+i).draggable();
				}
				if(data[i]==false)
				{
					currentUserName=data[Number(i)+1];
					break;
				}
			}
		},
	"json");

///////////////////////////////////////////////////////////////////////////////////
	$("#connectIDBtn").droppable({
		drop: function(event,ui){
			ui.draggable.addClass("label-default").removeClass("label-success");
		},
	accept: ".connectBtn"
	});
	$("#unitConnect").droppable({
		drop: function(event,ui){
		ui.draggable.addClass("label-success").removeClass("label-default");
		},
		hoverClass: 'btndrop-hover',
		accept: ".connectBtn"
	});
	jsonData={"command":"getCompanyUnit"};
	$.post(
		"../phplib/model/ajaxIndexBackground.php",
		jsonData,
		function(data){
			//alert(data);
			for(i in data){
				if(data[i]!=false)
				{
					$("#connectIDBtn").append("<div class='connectBtn label label-default' id='unit"+i+"' >"+data[i]+"</div>").children(".connectBtn").css({"cursor":"move","display":"inline-block"});
//					$("#connectIDBtn").append("<div style='clear:both;'></div>");
					$("#unit"+i).draggable();
				}
			}
		},
	"json");

var ChineseAtmospherePressure="";
$.getJSON("../js/lib/ChineseAtmospherePressure.json",function(data){
	$.each(data,function(i,item){
		ChineseAtmospherePressure=data;
		$("#localProvince").append(
			"<option value="+i+">"+i+"</option>\n"
		);
	});
});
$("#localProvince").blur(function(){
	$("#localCity").empty();
	$.each(ChineseAtmospherePressure,function(i,item){
		if($("#localProvince option:selected").val()==i)
			$.each(item,function(address,pressure){
				$("#localCity").append(
					"<option value="+address+">"+address+"</option>\n"
				);
			});
	});

});
$("#localCity").blur(function(){
	$.each(ChineseAtmospherePressure,function(i,item){
		if($("#localProvince option:selected").val()==i)
			$.each(item,function(address,pressure){
				if($("#localCity option:selected").val()==address)
					$("#localAtmospherePressure").val(pressure);
/////////////////这里应该把大气压存到哪里去，方便之后的存储,或者存储的时候读取input的值也行哈？
			});
	});

});

$("#basicAttrName").blur(function(){
var reg=new RegExp("[^0-9]");
	if($("#basicAttrName").val().length=='0')
	{
        	$("#basicAttrName~p").text("忘记填写仪表单元序列号").addClass("inputWarn");
		return;
	}
        if(reg.test($("#basicAttrName").val()))
	{
                $("#basicAttrName~p").text("存在非法字符，仪表单元序列号只可由数字组成").addClass("inputWarn");
                return;
        }else
        {
                $("#basicAttrName~p").text("字符检查通过，正在查询是否存在相同仪表单元序列号").addClass("inputWarn");
                //这里到数据库检查序列号是否重复
		jsonData={"command":"checkBasicAttrNameRepeat","basicAttrName":$("#basicAttrName").val()};
		$.post(
		"../phplib/model/ajaxIndexBackground.php",
		jsonData,
		function(data){
			if(data=="重复")
			{
				$("#basicAttrName~p").text("仪表单元序列号已被登记使用").addClass("inputWarn");
			}
			else
			{
				$("#basicAttrName~p").text("仪表单元序列号可用").removeClass("inputWarn");
				basicAttr.basicAttrName=$("#basicAttrName").val();
			}
		});
        }
});
$("#unitName").blur(function(){
var reg=new RegExp("[^A-Z_a-z0-9\u4e00-\u9fa5]");
	if($("#unitName").val().length=='0')
	{
        	$("#unitName~p").text("忘记填写仪表单元名称").addClass("inputWarn");
		return;
	}
        if(reg.test($("#unitName").val()))
	{
                $("#unitName~p").text("存在非法字符，用户名只可由数字,大小写字母和汉字组成").addClass("inputWarn");
                return;
        }else
        {
                $("#unitName~p").text("字符检查通过，正在查询是否存在相同用户名").addClass("inputWarn");
                //这里到数据库检查用户名是否重复
		jsonData={"command":"checkUnitNameRepeat","unitName":$("#unitName").val()};
		$.post(
		"../phplib/model/ajaxIndexBackground.php",
		jsonData,
		function(data){
			if(data=="重复")
			{
				$("#unitName~p").text("仪表单元名称重复").addClass("inputWarn");
			}
			else
			{
				$("#unitName~p").text("仪表单元名可用").removeClass("inputWarn");
				basicAttr.basicAttrName=$("#unitName").val();
			}
		});
        }
});
$("#upLoadUnitBasicAttr").click(function(){
//判断，提交输入信息
	basicAttr.command="upLoadBasicAttr";
	basicAttr.unitName=$("#unitName").val();
	basicAttr.instantFlowUnit=$("#instantFlowUnit").find("option:selected").text();
	basicAttr.instantFlowUpperLimit=$("#instantFlowUpperLimit").val();
	basicAttr.instantFlowLowerLimit=$("#instantFlowLowerLimit").val();
	basicAttr.instantFlowAlarmUpperLimit=$("#instantFlowAlarmUpperLimit").val();
	basicAttr.instantFlowAlarmLowerLimit=$("#instantFlowAlarmLowerLimit").val();
	i=0;
	$("#adminIDBtn").find(".label-success").each(function(index,item){//获得所有的管理组在label-success里的数据
		basicAttr.adminName[index]=$(item).text();
		i=index+1;
	});
		basicAttr.adminName[i]=currentUserName;
		alert(basicAttr.adminName);
	$("#connectIDBtn").find(".label-success").each(function(index,item){//获得所有的可连接仪表单元在label-success里的数据
		basicAttr.unitConnect[index]=$(item).text();
	});
//	$.each(basicAttr,function(item,value){alert("item是"+item+"_value是"+value);});
	$.post(
		"../phplib/controller/index-background.php",
		basicAttr,
		function(data){
alert(decodeURIComponent($.param(data)));//param会将data对象的数据转换称url编码的数据,然后decodeURLComponent可以将url编码数据解码出来!!!超赞的功能,这样就可以显示server发回来的数据了
			if(data.result=="登陆失效")
			{
				
			}
			if(data.result=="验证失败")
			{
				$.each(data,function(item,value){
					if(value!="验证通过")
						$.each(basicAttr,function(i,j){
							if(item==i)
								$("#"+item+" ~p").text(value).css("background-color","red");
						});
					else
							$.each(basicAttr,function(i,j){
							if(item==i)
								$("#"+item+" ~p").text(value).css("background-color","#afafaf");
						});
	
				});
				$("#upLoadUnitBasicAttr").text("仪表基本属性提交失败").css("background-color","red");
				$("#basicAttr").slideDown();
				$("#basicAttrAccordion").addClass("active");
				$("html,body").scrollTop($("#basicAttrAccordion").offset().top);
			}
			else if(data.result=="验证通过")
			{
				$("#upLoadUnitBasicAttr").text("仪表基本属性提交成功").css("background-color","#ffffff");
				$("#basicAttr").slideUp();
				$("#basicAttrAccordion").addClass("active");
				$("html,body").scrollTop($("#basicAttrAccordion").offset().top);
			}
	},"json");

});

$("#transmitterAccordion").on("click",function(){
	sensorList={"command":"getCurrentSensor"};




});

$("#upLoadTransmitter").click(function(){
	transmitter.command="upLoadTransmitter";
	transmitter.basicAttrName=$("#basicAttrName").val();
	transmitter.sensorName=$("#sensorName").val();
	transmitter.sensorUnit=$("#sensorUnit").find("option:selected").text();
	transmitter.sensorSignalUpperLimit=$("#sensorSignalUpperLimit").val();
	transmitter.sensorSignalLowerLimit=$("#sensorSignalLowerLimit").val();
	transmitter.sensorAlarmUpperLimit=$("#sensorAlarmUpperLimit").val();
	transmitter.sensorAlarmLowerLimit=$("#sensorAlarmLowerLimit").val();
	transmitter.sensorFixedValue=$("#sensorFixedValue").val();
	transmitter.sensorDampingTime=$("#sensorDampingTime").val();
	transmitter.sensorSmallSignalResection=$("#sensorSmallSignalResection").val();
	$.post(
		"../phplib/controller/index-background.php",
		transmitter,
		function(data){
alert(decodeURIComponent($.param(data)));//param会将data对象的数据转换称url编码的数据,然后decodeURLComponent可以将url编码数据解码出来!!!超赞的功能,这样就可以显示server发回来的数据了
		if(data.result!="验证通过")//验证失败要改变各行内容,并保持页面下拉
		{
			$.each(transmitter,function(i,j){
				if(item==i)
					$("#"+item+" ~p").text(value).css("background-color","red");
			});
			$("#uploadtransmitter").text("传感器信息提交失败").css("background-color","red");
			$("#transmitter").slideDown();
			$("#transmitteraccordion").addClass("active");
			$("html,body").scrollTop($("#transmitterAccordion").offset().top-100);
		}
		if(data.save=="插入成功"||data.save=="更新成功")//插入成功后要将新插入的传感器放到上部,以方便知道插入了几个,或更改删除
		{
			$("#sensorList").append("<div class='alert sensorSaved'>\n"+ 
                                "<button type='button' class='sensorModify'>修改</button>\n"+
                                "<button type='button' class='sensorDelete'>删除</button>\n"+
				"传感器名称:<span>"+transmitter.sensorName+"</span>\n"+
				"传感器单位:<span>"+transmitter.sensorUnit+"</span>\n"+
				"信号上限:<span>"+transmitter.sensorSignalUpperLimit+"</span>"+transmitter.sensorUnit+"\n"+
				"信号下限:<span>"+transmitter.sensorSignalLowerLimit+"</span>"+transmitter.sensorUnit+"\n"+
				"报警上限:<span>"+transmitter.sensorAlarmUpperLimit+"</span>"+transmitter.sensorUnit+"\n"+
				"报警下限:<span>"+transmitter.sensorAlarmLowerLimit+"</span>"+transmitter.sensorUnit+"\n"+
				"固定值:<span>"+transmitter.sensorFixedValue+"</span>"+transmitter.sensorUnit+"\n"+
				"阻尼时间:<span>"+transmitter.sensorDampingTime+"</span>\n"+
				"小信号切除:<span>"+transmitter.sensorSmallSignalResection+"</span>"+transmitter.sensorUnit+"\n"+
                        "</div>");
			$(".sensorModify").click(function(){
				$("#sensorName").val($(this).nextAll("span").eq(0).text());
				$("#sensorUnit option:contains('"+$(this).nextAll("span").eq(1).text()+"')").attr("selected","true");
				$("#sensorSignalUpperLimit").val($(this).nextAll("span").eq(2).text());
				$("#sensorSignalLowerLimit").val($(this).nextAll("span").eq(3).text());
				$("#sensorAlarmUpperLimit").val($(this).nextAll("span").eq(4).text());
				$("#sensorAlarmLowerLimit").val($(this).nextAll("span").eq(5).text());
				$("#sensorFixedValue").val($(this).nextAll("span").eq(6).text());
				$("#sensorDampingTime").val($(this).nextAll("span").eq(7).text());
				$("#sensorSmallSignalResection").val($(this).nextAll("span").eq(8).text());
				deleteTransmitter.command="deleteTransmitter";
				deleteTransmitter.sensorName=$(this).nextAll("span").eq(0).text();
				deleteTransmitter.basicAttrName=$("#basicAttrName").val();
				i=0;
				$.post(
					"../phplib/controller/index-background.php",
					deleteTransmitter,
					function(data){
						alert(data.delete);
						if(data.delete=="删除成功")	i=1;
				},"json");
				if(i==1)	$(this).parent().remove();

			});
			$(".sensorDelete").click(function(){
				deleteTransmitter.command="deleteTransmitter";
				deleteTransmitter.sensorName=$(this).nextAll("span").eq(0).text();
				deleteTransmitter.basicAttrName=$("#basicAttrName").val();
				$.post(
					"../phplib/controller/index-background.php",
					deleteTransmitter,
					function(data){
						if(data.result=="删除成功")	i=1;
				},"json");
				if(i==1)	$(this).parent().remove();
				
			});	
		}
	},"json");
});

$("#upLoadPrimaryElement").click(function(){
	primaryElement.command="upLoadPrimaryElement";
	primaryElement.basicAttrName=$("#basicAttrName").val();
	primaryElement.primaryElementName=$("#primaryElementName").val();
	primaryElement.orificeDiameter=$("#orificeDiameter").val();
	primaryElement.throttleElementMaterial=$("#throttleElementMaterial").find("option:selected").text();
	primaryElement.throttleElementExpansion=$("#throttleElementExpansion").val();
	primaryElement.kPoint1=$("#kPoint1").val();
	primaryElement.kPoint2=$("#kPoint2").val();
	primaryElement.kPoint3=$("#kPoint3").val();
	primaryElement.kPoint4=$("#kPoint4").val();
	primaryElement.kPoint5=$("#kPoint5").val();
	primaryElement.kPointInterval1=$("#kPointInterval1").val();
	primaryElement.kPointInterval2=$("#kPointInterval2").val();
	primaryElement.kPointInterval3=$("#kPointInterval3").val();
	primaryElement.kPointInterval4=$("#kPointInterval4").val();
	primaryElement.C_Vcone=$("#C_Vcone").val();
	$.post(
		"../phplib/controller/index-background.php",
		primaryElement,
		function(data){
			//alert(data);
			$.each(data,function(item,value){alert("item是"+item+"value是"+value);});
			if(data.result!="验证通过")
				$.each(data,function(item,value){
					if(value!="验证通过")
						$.each(primaryElement,function(i,j){
							if(item==i)
								$("#"+item+" ~p").text(value).css("background-color","red");
						});
				});

				$("#upLoadPrimaryElement").text("一次元件参数提交失败").css("background-color","red");
				$("#primaryElement").slideDown();
				$("#primaryElementAccordion").addClass("active");

				$("html,body").scrollTop($("#primaryElementAccordion").offset().top);
	},"json");


});


$("#upLoadOperatingParameters").click(function(){
	operatingParameters.command="upLoadOperatingParameters";
	operatingParameters.basicAttrName=$("#basicAttrName").val();
	operatingParameters.mediumName=$("#mediumName").val();
	operatingParameters.localAtmospherePressure=$("#localAtmospherePressure").val();
	operatingParameters.pipeDiameter=$("#pipeDiameter").val();
	operatingParameters.pipeMaterial=$("#pipeMaterial").find("option:selected").text();
	operatingParameters.pipeExpansion=$("#pipeExpansion").val();
	operatingParameters.viscosity=$("#viscosity").val();
	operatingParameters.isentropic=$("#isentropic").val();
	operatingParameters.liquidExpansion=$("#liquidExpansion").val();
	operatingParameters.dryDegree=$("#dryDegree").val();
	operatingParameters.mediumExpansion=$("#mediumExpansion").val();
	operatingParameters.criticalTemperature=$("#criticalTemperature").val();
	operatingParameters.criticalPressure=$("#criticalPressure").val();
	$.post(
		"../phplib/controller/index-background.php",
		operatingParameters,
		function(data){
			//alert(data);
			$.each(data,function(item,value){alert("item是"+item+"value是"+value);});
			if(data.result!="验证通过")
				$.each(data,function(item,value){
					if(value!="验证通过")
						$.each(operatingParameters,function(i,j){
							if(item==i)
								$("#"+item+" ~p").text(value).css("background-color","red");
						});
				});

				$("#upLoadOperatingParameters").text("工况参数提交失败|").css("background-color","red");
				$("#operatingParameters").slideDown();
				$("#operatingParametersAccordion").addClass("active");
				$("html,body").scrollTop($("#operatingParametersAccordion").offset().top);
	});



});



$("#upLoadCommunicationParameters").click(function(){
	communicationParameters.command="upLoadCommunicationParameters";
	communicationParameters.basicAttrName=$("#basicAttrName").val();
	communicationParameters.dataSyncFreq=30;//$("#dataSyncFreq").find("option:selected").text();
	communicationParameters.outputSignalType=$("#outputSignalType").find("option:selected").text();
	communicationParameters.bandrate485=$("#bandrate485").find("option:selected").text();
	communicationParameters.address485=$("#address485").val();
	communicationParameters.freqmAUpperLimit=$("#freq-mAUpperLimit").val();
	communicationParameters.freqmALowerLimit=$("#freq-mALowerLimit").val();
	$.post(
		"../phplib/controller/index-background.php",
		communicationParameters,
		function(data){
			//alert(data);
			$.each(data,function(item,value){alert("item是"+item+"value是"+value);});
			if(data!="验证通过")
				$.each(data,function(item,value){
					if(value!="验证通过")
						$.each(communicationParameters,function(i,j){
							if(item==i)
								$("#"+item+" ~p").text(value).css("background-color","red");
						});
				});


				$("#upLoadCommunicationParameters").text("通讯参数提交失败").css("background-color","red");
				$("#communicationParameters").slideDown();
				$("#communicationParametersAccordion").addClass("active");
				$("html,body").scrollTop($("#communicationParametersAccordion").offset().top);
	});



});




});


