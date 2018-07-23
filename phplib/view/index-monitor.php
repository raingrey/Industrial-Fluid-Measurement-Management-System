<?php
session_start();
include('../model/mysqlFunction.php');
$dataBaseConnect=connectMysql();
mysql_select_db("DGsql",$dataBaseConnect);
$sql="select basicattrname,instantflowunit,最近一次同步时间 from RailedMeterSet where companyname='".$_SESSION['company']."'";
$meterRes=mysql_query($sql);
$meterResult=array();

while($meterRow=mysql_fetch_array($meterRes))//一次mysql_fetch_array()只能出一条信息，得一直循环到空才能得到全部查到的结果
{
	$instantFlowResult=null;
	$sensorResult=null;
	$meterResult[]=$meterRow['basicattrname'];

	mysql_select_db("DGData",$dataBaseConnect);
	$sql="select instantflow,timeStamp from 瞬时流量 where basicattrname='".$meterRow['basicattrname']."' and companyname='".$_SESSION['company']."' order by timeStamp desc limit 0,1";
	$instantFlowRes=mysql_query($sql);
	$instantFlowResult=mysql_fetch_array($instantFlowRes);
	unset($instantFlowRes);//销毁查询结果，免得占内存

	$sql="select totalflow from 累计流量 where basicattrname='".$meterRow['basicattrname']."' and companyname='".$_SESSION['companyname']."'";
	$totalFlowRes=mysql_query($sql);
	$totalFlowResult=mysql_fetch_array($totalFlowRes);
	unset($totalFlowRes);//销毁查询结果，免得占内存

	mysql_select_db("DGsql",$dataBaseConnect);
	$sql="select sensorname,sensorunit from 传感器信息 where basicattrname='".$meterRow['basicattrname']."' and companyname='".$_SESSION['companyname']."'";
	$sensorRes=mysql_query($sql);
	$i=0;
	while($sensorResult[]=mysql_fetch_array($sensorRes))	$i++;
	unset($sensorRes);//销毁查询结果，免得占内存

	
	echo '
						<div id="DGunit'.$meterRow["basicattrname"].'"  class="DGunit">
							'.$meterRow[basicattrname].'
							<div id="DGdata'.$meterRow['basicattrname'].'" style="display:none;">
								<ul>
									<li>瞬时量：&nbsp'.$instantFlowResult["instantflow"].'&nbsp'.$meterRow['瞬时流量单位'].'
									<li>累积量：&nbsp'.$totalFlowResult["totalflow"].'&nbsp'.$meterRow['instantflow单位'];
			/*添加累积量*/
	$j=0;
	mysql_select_db("DGData",$dataBaseConnect);
	for(;$j<$i;$j++)
	{
		$sensorDataResult=null;
		$sql="select sensordata from 传感器数据 where basicattrname='".$meterRow['basicattrname']."' and companyname='".$_SESSION['companyname']."'and sensorname='".$sensorResult[$j]['sensorname']."' order by timeStamp desc limit 0,1";
		$sensorDataRes=mysql_query($sql);
		$sensorDataResult=mysql_fetch_array($sensorDataRes);
		unset($sensorDataRes);//销毁查询结果，免得占内存
		echo	'
									<li>'.$sensorResult[$j]['sensorname'].'&nbsp'.$sensorDataResult["sensordata"].'&nbsp'.$sensorResult[$j]['信号单位'];
	}
	echo '
									<li>上次同步时间：'.$meterRow['最近一次同步时间'];
	echo '
								</ul>
							</div>
						</div>
';//YES这个是好用的
}
?>
	<script type="text/javascript">
		var DGclicked=new Array();
		var DGunitNum=new Array();
		$(document).ready(function(){
/*获取查到结果条数，即将要显示的按钮数*/
		<?php
		$i=0;
		foreach($result as $key=>$value)
			$i++;			
		echo "clickedNum=".$i.";";	
		?>
		/*初始化DGclicked标志数组*/
		i=0;
		while(i<=clickedNum)
		{
			DGclicked[i]="unclicked";
			i++;
		}		
/*定义每个按钮的处理函数*/
		<?php

		$i=0;
		foreach($meterResult as $key => $value)
		{
			$x="#DGunit".$value;//带#按钮id
			$y="#DGdata".$value;
			echo '$("'.$x.'").click(function(){
				
							
				if(DGclicked['.$key.']=="clicked")
				{
					DGclicked['.$key.']="unclicked";
					$("'.$y.'").css("display","none").slideUp("100").removeClass("DGdata");
					$("'.$x.'").animate({marginBottom:"30px",marginRight:"0px"},"fast");
				}
				else 
				{
					DGclicked['.$key.']="clicked";
					$("'.$x.'").animate({marginBottom:"300px",marginRight:"80px"});
					$("'.$y.'").addClass("DGdata").animate({width:"250",height:"250"},"fast").slideDown("100");
				}
			});
			$("'.$x.'").mouseenter(function(){
				$("'.$x.'").css("box-shadow","0 2px 2px 2px ");
			});
			$("'.$x.'").mouseleave(function(){
				$("'.$x.'").css("box-shadow","0 0 0 0");

			});';
			
		}
		?>
	});
	</script>

