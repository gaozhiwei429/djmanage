<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<?= Html::cssFile('@web/static/theme/css/fishBone.css?v=' . date("ymd"), ['rel' => "stylesheet"]) ?>
<div class="layui-card">
    <?php
    if (isset($title) && !empty($title)) {
        ?>
        <div class="layui-header">
            <div class="pull-left"><span><?= Html::encode($title ? $title : (isset($this->title) ? $this->title : null)) ?></span></div>
        </div>
        <?php
    }
    ?>
    <div class="layui-card-body">
        <div class="layui-row layui-col-space15">
            <div class="layui-col-md12">
                <div class="layui-col-md4">
                    <div class="layui-form">
                        <div class="layui-inline" style="width: 100px;">
                            <select name="city" lay-verify="">
                                <option value="01">地区</option>
                                <option value="02">打印机序号</option>
                            </select>  
                        </div>  
                        <div class="layui-inline">
                            <input type="text" name="title"   style="width:150px; display:inline;"  value="<?php echo $map; ?>"  placeholder="请输入地址或打印机序号" autocomplete="on" class="layui-input listwhe">
                        </div>
                    </div>
                </div>

                <div class="layui-col-md8">
                    <div class="layui-form">
                        <div class="layui-inline selectauto">
                            <select name="city" lay-verify=""  lay-filter="selected">
                                <option value="" >请选择打印机状态</option>
                                <option value="0" <?php if(empty($printerStatus) && $printerStatus!==""){ ?> selected="selected"<?php } ?> >空闲</option>
                                <option value="1" <?php if($printerStatus==1){ ?>selected="selected"<?php } ?> >工作中</option>
                            </select>  
                        </div> 
                        <div class="layui-inline">
                            <button class="layui-btn fromSbumit">
                                搜索
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="layui-col-md6">

                <form autocomplete="off" onsubmit="return false;" data-auto="true" method="post">
                    <table class="layui-hide layui-table" id="dataList"></table>
                </form>

                <div id="page"></div>
            </div>
            <div class="layui-col-md6">
                <div class="layui-tab layui-tab-brief" lay-filter="TabBrief">
                    <ul class="layui-tab-title">
                        <li class="layui-this">设备参数</li>
                        <li>设备状态</li>
                        <li>设备时间</li>
                        <li>历史信息</li>
                    </ul>
                    <div class="layui-tab-content">
                        <div class="layui-tab-item layui-show">
                            <div class="layui-col-md12 loadingClass" style="height:300px;text-align: center;line-height: 150px;">
                                <i class="layui-icon layui-icon-loading layui-icon layui-anim layui-anim-rotate layui-anim-loop" style="font-size:50px;"></i>
                            </div>
                            <div class="layui-block modelInfo" style="display:none;"> 
                                <image src="" style="width: 150px;height: 150px;">
                            </div>
                            <table class="layui-hide layui-table" id="modelInfo"></table>
                        </div>
                        
                        <div class="layui-tab-item">
                            <div class="layui-block macInfo"> 
                                <image src=""  style="width: 150px;height: 150px;">
                            </div>

                            <div class="layui-col-md12 macStr"> 

                            </div>
                        </div>
                        
                        <div class="layui-tab-item">
                             <div class="layui-col-md12 layui-form">
                                <div class="layui-form-item padding-10">
                                    <h3>
                                        打印机型号:<span class="centst"></span>
                                    </h3>
                                    <div class="layui-inline">
                                        时间范围:
                                    </div>
                                    <div class="layui-inline "> 
                                        <input type="text" id="test1"  class="layui-input" value="开始时间" >
                                    </div>
                                    <div class="layui-inline">
                                        -
                                    </div>
                                    <div class="layui-inline  endTimeOne"> 
                                        <input type="text" id="test2" class="layui-input" value="结束时间">
                                    </div>

                                    <div class="layui-inline ">
                                        <button class="layui-btn formSel">
                                            搜索
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="layui-col-md12">
                                <div class="layui-form-item padding-10">
                                    <div style="font-size:18px">
                                        打印机使用情况
                                    </div>
                                    <div class="layui-card-body">
                                        <div class="layui-carousel layadmin-carousel layadmin-dataview" data-anim="fade" lay-filter="LAY-index-custom">
                                            <div carousel-item id="LAY-index-custom">
                                                <div><i class="layui-icon layui-icon-loading1 layadmin-loading"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="layui-col-md12">
                                <div class="layui-card">
                                    <div class="layui-card-header">堆积面积图</div>
                                    <div class="layui-card-body">
                                        <div class="layui-carousel layadmin-carousel layadmin-dataview" data-anim="fade" lay-filter="LAY-index-time">
                                            <div carousel-item id="LAY-index-time">
                                                <div><i class="layui-icon layui-icon-loading1 layadmin-loading"></i></div>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="layui-tab-item">
                            <div class="layui-col-md12 layui-form">
                                <div class="layui-form-item padding-10">
                                    <div class="layui-inline eventObj">
                                        <select name="city" lay-verify="">
                                            <option value="">请选择一个事件</option>
                                            <option value="1">出库</option>
                                            <option value="2">入库</option>
                                            <option value="3">绑定</option>
                                            <option value="4">报修</option>
                                            <option value="5">打印</option>
                                            <option value="6">下载历史</option>
                                        </select>  
                                    </div>
                                    <div class="layui-inline "> 
                                        <input type="text" id="test3"  class="layui-input" value="开始时间">
                                    </div>
                                    <div class="layui-inline">
                                        -
                                    </div>
                                    <div class="layui-inline endTime"> 
                                        <input type="text" id="test4" class="layui-input" value="结束时间">
                                    </div>

                                    <div class="layui-inline ">
                                        <button class="layui-btn eventSelect">
                                            搜索
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="layui-col-md12">
                                <div id="divline" class="layui-col-md10" style="display:none;">
                                    <div class="layui-carousel layadmin-carousel layadmin-dataview" data-anim="fade" lay-filter="LAY-index-moreline">
                                        <div carousel-item id="LAY-index-moreline">
                                            <div><i class="layui-icon layui-icon-loading1 layadmin-loading"></i></div>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                            <div class="layui-col-md12">
                                <div id="timeline" class="layui-col-md10" style="margin-left: 10%;">
                                </div>
                            </div>
                            <div class="layui-col-md12">
                                <div id="divcent" class="layui-col-md10" style="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>      
            </div>
        </div>
    </div>
</div>
<?= Html::jsFile('@web/static/layuiadmin/layui/layui.js?v=' . date("ymd"), ['type' => "text/javascript"]) ?>
<?= Html::jsFile('@web/static/js/jquery.SuperSlide.2.1.1.js?v=' . date("ymd"), ['type' => "text/javascript"]) ?>
<?= Html::jsFile('@web/static/js/fishBone.js?v=' . date("ymd"), ['type' => "text/javascript"]) ?>
<script type="application/javascript">
$(document).ready(function () {
    layui.config({
        base: '/static/layuiadmin/' //指定 layuiAdmin 项目路径，本地开发用 src，线上用 dist
        , version: '2.4.5'
    }).extend({
        index: './lib/index' //主入口模块
    }).use(['index', 'console', 'form', 'sample', 'laydate', 'senior', 'table', 'laypage', 'layer', 'element', 'util'], function () {
        var laypage = layui.laypage
                , laydate = layui.laydate
                , element = layui.element
                , table = layui.table;
        form = layui.form;
        form.render();
 
        var now = new Date();
        var start = now.getTime() - 2*12 *30 * 24 * 60 * 60 * 1000;  // 将当前时间转换为时间戳
        var trindex = 0;
        var layer = layui.layer;
        var storage = window.localStorage;
        var userData = storage.getItem("userData");
        var headerParams = JSON.parse(userData);
        var tableHeight=50;
        var selected=GetUrlParam("printerStatus") ? GetUrlParam("printerStatus") : "";
        var dates=now.getTime()-356*24 * 60 * 60 * 1000;
        element.on('tab(TabBrief)', function (data) {
            if (data.index == 2) {
                laydate.render({
                          elem: '#test1',
                          value:new Date(dates),
                          type: 'datetime', // 可选择年、月、日、时、分、秒
                          min: start, // 规定最小日期
                          done: function (value) {
                              // value为第一个日期选择框选择的日期
                              const start2 = new Date(value).getTime();
                              const end = start2 + 12*30 * 24 * 60 * 60 * 1000;
                              const elemId = "end2Time" + new Date().getTime();
                              // 当第一个日期选择框选择完日期后，将类选择器endTime里的内容清空，给它重新添加内容，且新添加元素的id是动态改变的，这样第二个日期框在第一个日期框每次选择完后会重新渲染
                              $('.endTimeOne').empty().append(`<input type="text" class="layui-input" id="${elemId}">`)
                              laydate.render({
                                  elem: `#${elemId}`,
                                  type: 'datetime',
                                  min: start2, // 最小日期不得小于第一个日期选择框的值
                                  max: end  // 最大日期在24小时内
                              })
                          }
                      });

              laydate.render({ 
                  elem: '#test2',
                  type: 'datetime',
                  value:new Date(),
              })
              service(1);
            }
            if (data.index == 3) {
                  laydate.render({
                     elem: '#test3',
                     type: 'datetime', // 可选择年、月、日、时、分、秒
                     value:new Date(dates),
                     min: start, // 规定最小日期
                     done: function (value) {
                         // value为第一个日期选择框选择的日期
                         const start2 = new Date(value).getTime();
                         const end = start2 + 12*30 * 24 * 60 * 60 * 1000;
                         const elemId = "endTime2" + new Date().getTime();
                         // 当第一个日期选择框选择完日期后，将类选择器endTime里的内容清空，给它重新添加内容，且新添加元素的id是动态改变的，这样第二个日期框在第一个日期框每次选择完后会重新渲染
                         $('.endTime').empty().append(`<input type="text" class="layui-input" id="${elemId}">`)
                         laydate.render({
                             elem: `#${elemId}`,
                             type: 'datetime',
                             min: start2, // 最小日期不得小于第一个日期选择框的值
                             max: end  // 最大日期在24小时内
                         })
                     }
                 });
                 laydate.render({ 
                     elem: '#test4',
                     type: 'datetime',
                     value:new Date(),
                 })
                $("#divline").hide();
                $("#divcent").empty();
                eventobj();
            }
        });

        var service = function (type=0) {
            var modelurl = "<?= Url::to(['common/bind-printer/service-time']); ?>";
            var endTime = $(".endTimeOne input").val();
            var startTime = $("#test1").val();
            if(endTime=="结束时间"){
                 endTime=$("#test2").val();
            }
            var Params = {};
            if(type!=1){
              Params.endTime = endTime;
              Params.startTime = startTime;   
            }
            var numberstr = $("div[lay-id='dataList'] tr").eq(trindex + 1).find("[data-field='numberstr'] div").text();
            var typeCode=$("div[lay-id='dataList'] tr").eq(trindex + 1).find("[data-field='typeCode'] div").text();
            $(".centst").html(typeCode);
            Params.numberstr = numberstr;
            getinfo(modelurl,Params,function (data) {
               var leisure={};
                 leisure.series=[
                    {value: data.percent.percent,name: '打印时间'},
                    {value: data.percent.count, name: '空闲时间'},
                ];
                var list=[];
                $.each(data.line,function(i,c){
                    list.push([
                        i*1000,
                        c
                    ]);
                })
               renderTimeRatio(leisure);
               renderCustom(list);
            })
        }
        var eventobj = function () {
             $("#divline").hide();
            $("#divcent").empty();
            var modelurl = "<?= Url::to(['common/bind-printer/get-print-model-list']); ?>";
            var Params = {};
            var event = $(".eventObj select").val();
            var endTime = $(".endTime input").val();
            if(endTime=="结束时间"){
                 endTime=$("#test4").val();
                  if(endTime=="结束时间"){
                     return false;
                  }
            }
            var startTime = $("#test3").val();
            var numberstr = $("div[lay-id='dataList'] tr").eq(trindex + 1).find("[data-field='numberstr'] div").text();
            Params.numberstr = numberstr;
            Params.event = event;
			Params.endTime = endTime;
			Params.startTime = startTime;
			
           
            getinfo(modelurl, Params, showEventdata);
        }

        $(document).on("click", ".eventSelect", function (obj) {
            eventobj();
        })

        $(document).on("click", ".formSel", function (obj) {
            service();
        })
        
        //监听提交
        var params = {
        };
        var selfUrl = window.location.href;
        var page = GetUrlParam("p") ? GetUrlParam("p") : 1;
        var size = GetUrlParam("size") ? GetUrlParam("size") : 10;
        params.p = page;
        params.size = size;
        params.count = 0;
        params.printerStatus = selected;
        if ($(".listwhe").val() !== "") {

        }
        var getinfo = function (url, params, callback) {
            $.ajax({
                type: "post",
                url: url,
                contentType: "application/json;charset=utf-8",
                data: JSON.stringify(params),
                dataType: "json",
                beforeSend: function (XMLHttpRequest) {
                    for (var i in headerParams) {
                        XMLHttpRequest.setRequestHeader(i, headerParams[i]);
                    }
                },
                success: function (result) {
                    if (result.code == 0) {
                        callback(result.data);
                    }

                }
            })
        } 
        var sourceDates = [];
        var showEventdata = function (data) {
            var datac = [];
            if (data.dataList !== undefined) {
                sourceDates = data.dataList;
                $.each(data.dataList, function (i, value) {
                    var list = {};
                    list.sourceDate = "";
                    list.sourceDate = "<div class='layui-col-md12 cilickdiv' data-id='" + i + "'>";
                    $.each(value, function (j, datav) {
                       if("打印信息:"==datav){
                             moreline(); 
                        }
                        if (j == 0) {
                            list.sourceDate += datav + "<br/>";
                        }
                    });
                    list.sourceDate += "</div>";
                    list.colorLevel = "";
                    datac.push(list);
                });
            }
            $("#timeline").fishBone(datac);
        }
        var moreline=function(){
            var modelurl = "<?= Url::to(['common/bind-printer/line-service-time']); ?>";
            var startTime = $("#test3").val();
            var endTime = $(".endTime input").val();
            if(endTime=="结束时间"){
                 endTime=$("#test4").val();
                 if(endTime=="结束时间"){
                     return false;
                  }
            }
            
            var Params = {};
            var numberstr = $("div[lay-id='dataList'] tr").eq(trindex + 1).find("[data-field='numberstr'] div").text();
            Params.numberstr = numberstr;
            Params.endTime = endTime;
            Params.startTime = startTime;
            getinfo(modelurl,Params,function (data) {
               var  list={};
                $("#divline").show();
                list.legend=["平台温度","喷头温度"];
                list.series=[];
                if(Object.getOwnPropertyNames(data.line.ppTemp).length>0){
                    var ppTemp=[];
                    $.each(data.line.ppTemp,function(i,c){
                          ppTemp.push([
                              i*1000,
                              c
                          ]);
                      })
                    
                     list.series.push({
                         name:"平台温度",
                         type:"line",
                         data:ppTemp
                     });
                }
                if(Object.getOwnPropertyNames(data.line.ptorTemp).length>0){
                     var ptorTemp=[];
                      $.each(data.line.ptorTemp,function(i,c){
                          ptorTemp.push([
                              i*1000,
                              c
                          ]);
                      })
                      list.series.push({
                         name:"喷头温度",
                         type:"line",
                         data:ptorTemp
                     });
                }
              renderMoreline(list);
            })
        }
        $(document).on("click", ".cilickdiv", function (obj) {
            var index = $(this).data("id");
            cnetval = sourceDates[index];
            var sourceDate = "";
            sourceDate = "<div class='layui-col-md12'>";
            $.each(cnetval, function (j, datav) {
                 if("打印信息:"==datav){
                      moreline(); 
                 }
                sourceDate += datav + "<br/>";
            });
            sourceDate += "</div>"; 
            $("#divcent").empty();
            $("#divcent").append($(sourceDate));
        })


        var printInfoShow = function (data) {
            $(".loadingClass").hide();
            $(".modelInfo").show();
            table.render({
                elem: '#modelInfo'
                , id: "modelInfo"
                , data: data.modelInfo.table
                , cellMinWidth: 80 //全局定义常规单元格的最小宽度，layui 2.2.1 新增
                , cols: [[
                        {field: 'PropertyName1'}
                        , {field: 'PropertyValue1'}
                        , {field: 'PropertyName2'}
                        , {field: 'PropertyValue2'}
                    ]], done: function () {
                    $("div[lay-id='modelInfo'] thead").hide();
                    $(".modelInfo img").attr("src", data.Print.img);
                }
            })
            $(".macInfo img").attr("src", data.Print.img);
            var dynamicInfoHtml = "<table class='layui-table'  lay-filter='demo'><tbody><tr>";
            if (data.macInfo !== undefined) {
                var flag = 0;
                var time = "";
                if (data.Print.name !== undefined) {
                    flag++;
                    dynamicInfoHtml += "<td>打印机名称:</td>";
                    dynamicInfoHtml += "<td>" + data.Print.name + "</td>";
                }
                console.log(data.macInfo[0]);
                $.each(data.macInfo[0], function (i, value) {
                    if (i == "mac") {
                        flag++;
                        dynamicInfoHtml += "<td>MAC地址:</td>";
                        dynamicInfoHtml += "<td>" + value + "</td>";
                    }
                    if (i == "moduName") {
                        flag++;
                        dynamicInfoHtml += "<td>模型名称:</td>";
                        dynamicInfoHtml += "<td>" + value + "</td>";
                    }
                    if (i == "restMemory") {
                        flag++;
                        dynamicInfoHtml += "<td>剩余内存:</td>";
                        dynamicInfoHtml += "<td>" + value + "MB</td>";
                    }
                    if (i == "printProgress") {
                        flag++;
                        dynamicInfoHtml += "<td>已完成:</td>";
                        dynamicInfoHtml += "<td>" + value.substr(0, value.indexOf(".") + 3) + "%</td>";
                    }
                    if (i == "ppTemp") {
                        flag++;
                        dynamicInfoHtml += "<td>打印平台温度:</td>";
                        dynamicInfoHtml += "<td>" + value + "</td>";
                    }
                    if (i == "ptorTemp") {
                        flag++;
                        dynamicInfoHtml += "<td>打印头温度:</td>";
                        dynamicInfoHtml += "<td>" + value + "</td>";
                    }
                    if (i == "moduPrintTime") {
                        flag++;
                        dynamicInfoHtml += "<td>已用时间:</td>";
                        dynamicInfoHtml += "<td>" + value + "</td>";
                    }
                    if (i == "ipInfo") {
                        flag++;
                        dynamicInfoHtml += "<td>IP和端口:</td>";
                        dynamicInfoHtml += "<td>" + value + "</td>";
                    }
                    if (i == "workState") {
                        var status = "";
                        if (value == "1") {
                            status = "空闲";
                        } else if (value == "2") {
                            status = "工作中";
                        } else {
                            status = "故障";
                        }
                        flag++;
                        dynamicInfoHtml += "<td>状态:</td>";
                        dynamicInfoHtml += "<td>" + status + "</td>";
                    }
                    if (i == "workingH") {
                        time += value + "h";
                    }
                    if (i == "workingM") {
                        time += value + "m";
                    }
                    if (flag % 2 == 0) {
                        dynamicInfoHtml += "</tr><tr>";
                    }
                });
                if (time) {
                    flag++;
                    dynamicInfoHtml += "<td>累计工作时间:</td>";
                    dynamicInfoHtml += "<td>" + time + "</td>";
                    if (flag % 2 == 0) {
                        dynamicInfoHtml += "</tr><tr>";
                    }
                }
                if (flag % 2 == 0) {
                    dynamicInfoHtml += "</tr><tr>";
                }
            }
            dynamicInfoHtml += "</tr>";
            dynamicInfoHtml += "</tbody></table>";
            $(".macStr").empty();
            $(".macStr").append($(dynamicInfoHtml));
        };
        var getprintlist = "<?= Url::to(['common/bind-printer/get-printer-info']); ?>";

        //打印机列表数据获取
        $.ajax({
            type: "post",
            url: "<?= Url::to(['common/bind-printer/get-map-printer-list']); ?>",
            contentType: "application/json;charset=utf-8",
            data: JSON.stringify(params),
            dataType: "json",
            beforeSend: function (XMLHttpRequest) {
                for (var i in headerParams) {
                    XMLHttpRequest.setRequestHeader(i, headerParams[i]);
                }
            },
            success: function (result) {
                form.render();
                params.count = result.data.count;
                if (result.code == 0 || params.count!=0 ) {
                    table.render({
                        elem: '#dataList'
                        , id: "dataList"
                        , data: result.data.dataList
                        , cellMinWidth: 80 //全局定义常规单元格的最小宽度，layui 2.2.1 新增
                        , cols: [[
                                {checkbox: true, fixed: true, width: 30}
                                , {field: 'sort', title: '序号'}
                                , {field: 'numberstr', title: '序列号'}
                                //,{field:'macAddress', title: 'MAC'}
                                , {field: 'typeCode', title: '型号'}
                                , {field: 'printerStatus', title: '状态', toolbar: "#Jstatus"}
                                , {field: 'bd_diqu_name', title: '地区', minWidth: 160}
                                , {field: 'concern_status', title: '是否关注', toolbar: "#JconcernStatus", minWidth: 120}
                            ]]
                        , done: function (res, curr, count) {
                            //自定义样式
                            laypage.render({
                                elem: 'page'
                                , count: params.count
                                , theme: '#1E9FFF'
                                , curr: parseInt(page) || 1 //当前页
                                , jump: function (obj, first) {
                                    if (!first) { //一定要加此判断，否则初始时会无限刷新
                                        selfUrl = changeURLArg(selfUrl, 'p', obj.curr);
                                        selfUrl = changeURLArg(selfUrl, 'size', size);
                                        selfUrl = changeURLArg(selfUrl, 'printerStatus', selected);
                                        self.location = selfUrl;
                                    }
                                }
                            });
                            //如果是异步请求数据方式，res即为你接口返回的信息。
                            //如果是直接赋值的方式，res即为：{data: [], count: 99} data为当前页数据、count为数据总长度
                            console.log(res);
                            //得到当前页码
                            console.log(curr);
                            //得到数据总量
                            console.log(count);
                        }
                    })

                    var numberstr = $("div[lay-id='dataList'] tr").eq(1).find("[data-field='numberstr'] div").text();
                    var typeCode = $("div[lay-id='dataList'] tr").eq(1).find("[data-field='typeCode'] div").text();
                    var printinfo = {
                        'numberstr': numberstr,
                        'typeCode': typeCode
                    }; 
                    getinfo(getprintlist, printinfo, printInfoShow);
                } else if (result.code == 5001) {
                    layer.msg(result.msg, {
                        icon: 2,
                        time: 2000 //2秒关闭（如果不配置，默认是3秒）
                    }, function () {
                        top.location.href = "../user/login"
                    });
                } else {
                    layer.msg(result.msg, {icon: 2});
                }
            },
            error: function () {
                table.render({
                    elem: '#dataList',
                    id: "dataList",
                    limit: 0,
                    height: tableHeight,
                    size: 'sm',
                    data: []
                })
            }
        });

        var groupListGtml = "";
        var groupList = '<?= isset($group) ? json_encode($group) : json_encode([]) ?>';
        var groupList = JSON.parse(groupList);
        if (groupList !== undefined) {
            $.each(groupList, function (i, value) {
                groupListGtml += "<option value=" + value.id + ">" + value.name + "</option>"
            })
        }
        $(document).off("click",".fromSbumit");
        $(document).on("click", ".fromSbumit", function () {
            selfUrl = changeURLArg(selfUrl, 'p',1);
            selfUrl = changeURLArg(selfUrl, 'size',size);
            selfUrl = changeURLArg(selfUrl,'printerStatus',selected);
            selfUrl = changeURLArg(selfUrl,'map',"");
            self.location = selfUrl;
        })
        
        form.on('select(selected)', function(data){
             selected=data.value;
        })
        
        $(document).on("click", "div[lay-id='dataList'] tr", function (obj) {
            var numberstr = $(this).find("[data-field='numberstr'] div").text();
            var typeCode = $(this).find("[data-field='typeCode'] div").text();
            var printinfo = {
                'numberstr': numberstr,
                'typeCode': typeCode
            };
            getinfo(getprintlist, printinfo, printInfoShow);
            $(".layui-tab li").eq(0).click();
            $(".loadingClass").show();
            $(".modelInfo").hide();
            trindex = $(this).data('index');
        })
        //监听锁定操作 
        form.on('checkbox(concern_status)', function (obj) {
            var status = obj.elem.checked === true ? 1 : 0;
            var type = $(this).data('type');
            var params = {};
            params.status = status;
            params.mac = this.value;
            if (status > 0) {
                layer.open({
                    type: 1
                    , skin: 'layui-layer-demo' //样式类名
                    , closeBtn: 0 //不显示关闭按钮
                            //            ,anim: 2
                    , shadeClose: true //开启遮罩关闭
                    , resize: true
                    , content: ['<ul class="layui-form" style="margin: 10px;">'
                                , '<li class="layui-form-item">'
                                , '<input type="hidden" value="' + status + '" name="status" /><input type="hidden" value="' + this.value + '" name="mac" />'
                                , '<label class="layui-form-label">选择分组</label>'
                                , '<div class="layui-input-block">'
                                , '<select name="concern_group_id">' + groupListGtml
                                , '<select>'
                                , '</div>'
                                , '</li>'
                                , '<li class="layui-form-item" style="text-align:center;">'
                                , '<button type="submit" lay-submit lay-filter="concern" class="layui-btn">提交</button>'
                                , '</li>'
                                , '</ul>'].join('')
                    , success: function (layero) {
                        form.render();
                        layero.find('.layui-layer-content').css('overflow', 'visible');
                        form.on('submit(concern)', function (data) {
                            //                    layer.msg(JSON.stringify(data.field));
                            $.ajax({
                                type: "post",
                                url: "<?= Url::to(['common/concern/edit']); ?>",
                                contentType: "application/json;charset=utf-8",
                                data: JSON.stringify(data.field),
                                dataType: "json",
                                beforeSend: function (XMLHttpRequest) {
                                    for (var i in headerParams) {
                                        XMLHttpRequest.setRequestHeader(i, headerParams[i]);
                                    }
                                },
                                success: function (result) {
                                    form.render();
                                    if (result.code == 0) {
                                        layer.msg(result.msg, {
                                            icon: 1,
                                            time: 1000 //2秒关闭（如果不配置，默认是3秒）
                                        }, function () {
                                            layer.closeAll();
                                        });
                                    } else if (result.code == 5001) {
                                        layer.msg(result.msg, {
                                            icon: 2,
                                            time: 2000 //2秒关闭（如果不配置，默认是3秒）
                                        }, function () {
                                            top.location.href = "../user/login"
                                        });
                                    } else {
                                        layer.msg(result.msg, {icon: 2});
                                    }
                                },
                                error: function () {
                                    table.render({
                                        elem: '#dataList',
                                        id: "dataList",
                                        limit: 0,
                                        height: tableHeight,
                                        size: 'sm',
                                        data: []
                                    })
                                }
                            });
                        });
                        form.render();
                    }
                });
            } else {
                $.ajax({
                    type: "post",
                    url: "<?= Url::to(['common/concern/edit']); ?>",
                    contentType: "application/json;charset=utf-8",
                    data: JSON.stringify(params),
                    dataType: "json",
                    beforeSend: function (XMLHttpRequest) {
                        for (var i in headerParams) {
                            XMLHttpRequest.setRequestHeader(i, headerParams[i]);
                        }
                    },
                    success: function (result) {
                        form.render();
                        if (result.code == 0) {
                            layer.msg(result.msg, {
                                icon: 1,
                                time: 1000 //2秒关闭（如果不配置，默认是3秒）
                            }, function () {
                                layer.closeAll();
                            });
                        } else if (result.code == 5001) {
                            layer.msg(result.msg, {
                                icon: 2,
                                time: 2000 //2秒关闭（如果不配置，默认是3秒）
                            }, function () {
                                top.location.href = "../user/login"
                            });
                        } else {
                            layer.msg(result.msg, {icon: 2});
                        }
                    },
                    error: function () {
                        table.render({
                            elem: '#dataList',
                            id: "dataList",
                            limit: 0,
                            height: tableHeight,
                            size: 'sm',
                            data: []
                        })
                    }
                });
            }
        });
    })
});

</script>

<script type="text/html" id="JconcernStatus">
    {{#  if(d.concern_status == "1"){ }}
    <input type="checkbox" name="concern_status" class="layui-btn layui-btn-primary" data-status="{{d.concern_status}}" value="{{d.macAddress}}" title="取消" lay-filter="concern_status" checked>
    <!--    <button class="layui-btn layui-btn-primary" data-id="{{d.id}}"  name="concern_status" lay-skin="concern_status" >已关注</button>-->
    {{# }else{ }}
    <input type="checkbox" name="concern_status" class="layui-btn layui-btn-danger" data-status="{{d.concern_status}}" value="{{d.macAddress}}" title="关注" lay-filter="concern_status">
    <!--    <button class="layui-btn layui-btn-danger" data-id="{{d.id}}" name="concern_status" lay-skin="concern_status">去关注</button>-->
    {{#  } }}
</script>

<script type="text/html" id="Jstatus">
    {{#  if(d.printerStatus ==0){ }}
    空闲
    {{# }else if(d.printerStatus ==1) { }}
    工作中
    {{# }else{ }}
    故障
    {{#  } }}
</script>


<script type="text/html" id="JconcernGroup">
    {{#  if(d.concern_group_id !== "0"){ }}
    {{d.concern_group_name}}
    {{# }else{ }}
    暂无
    {{#  } }}
</script>