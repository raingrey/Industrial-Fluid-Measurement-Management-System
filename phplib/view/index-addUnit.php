									<div class="inputframe">
                                                                                <span>传感器名称：</span>
                                                                                <input type="text" id="sensorName1" placeholder="当前仪表单元的传感器">
                                                                                <p>请输入当前仪表单元连接的传感器名称</p>
                                                                        </div>
                                                                        <div class="inputframe">
                                                                                <span>传感器信号上限：</span>
                                                                                <input type="text" id="sensor1SignalUpperLimit" placeholder="传感器信号
上限（必填)">
                                                                                <p>导轨仪表单元将根据传感器信号上下限解析4-20mA电流信号</p>
                                                                        </div>                                                  
                                                                        <div class="inputframe">
                                                                                <span>传感器信号下限：</span>
                                                                                <input type="text" id="sensor1SignalLowerLimit" placeholder="传感器信号
下限(必填)">
                                                                                <p>导轨仪表单元将根据传感器信号上下限解析4-20mA电流信号</p>
                                                                        </div>                                                  
                                                                        <div class="inputframe">
                                                                                <span>传感器信号报警上限：</span>
                                                                                <input type="text" id="sensor1AlarmUpperLimit" placeholder="信号值超过>此设定值将引发报警">
                                                                                <p>系统运行中传感器信号超过此设定值将发出警报提示</p>
                                                                        </div>
                                                                        <div class="inputframe">
                                                                                <span>传感器信号报警下限：</span>
                                                                                <input type="text" id="sensor1AlarmLowerLimit" placeholder="信号值低于>此设定值将引发报警">
                                                                                <p>系统运行中传感器信号低于此设定值将发出警报提示</p>
                                                                        </div>                                                  
                                                                        <div class="inputframe">
                                                                                <span>传感器信号固定值：</span>
                                                                                <input type="text" id="sensor1FixedValue" placeholder="传感器固定值">
                                                                                <p>当现场某传感器参数一般没有变化，则可在不接传感器的情况下，通过此选项
设定现场固定值加入流量计算</p>
                                                                        </div>
                                                                        <div class="inputframe">
                                                                                <span>阻尼时间：</span>
                                                                                <input type="text" id="sensor1DampingTim" placeholder="设定仪表对流量变
化的反应速度">
                                                                                <p>当管道中流量波动剧烈(如风机鼓风不稳定)引起流量数据跳变，可增加阻尼时
间降低仪表反应速度，减少流量跳变</p>
                                                                        </div>
                                                                        <div class="inputframe">
                                                                                <span>小信号切除：</span>
                                                                                <input type="text" id="sensor1SmallSignalResection" placeholder="小信号
切除">
                                                                                <p>对与可忽略信号可设定小流量切除值降低扰动</p>
                                                                        </div>

