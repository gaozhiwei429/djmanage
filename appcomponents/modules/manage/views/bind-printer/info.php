<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>
<title><?= Html::encode($title ? $title : (isset($this->title) ? $this->title : null)) ?></title>
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
<?= Html::cssFile('@web/static/layuiadmin/layui/css/layui.css?v=' . date("ymd"), ['rel' => "stylesheet"]) ?>
<?= Html::cssFile('@web/static/layuiadmin/style/admin.css?v=' . date("ymd"), ['rel' => "stylesheet"]) ?>
<?= Html::cssFile('@web/static/theme/css/fishBone.css?v=' . date("ymd"), ['rel' => "stylesheet"]) ?>


<div class="layui-card-body">
    <div class="layui-card">
        <div class="layui-card-body">
            <div class="layui-tab layui-tab-brief" lay-filter="component-tabs-brief">
                <ul class="layui-tab-title">
                    <li class="layui-this" lay-id="1">设备参数</li>
                    <li lay-id="2">状态信息</li>
                    <li lay-id="3">打印时间</li>
                    <li lay-id="4">历史信息</li>
                </ul>
                
                <div class="layui-tab-content" style="width: 100%;">
                    <div class="layui-tab-item layui-show"></div>
                    <div class="layui-tab-item"></div>
                    <div class="layui-tab-item" style="height:500px;">
                        <div class="layui-col-md12 layui-form">
                            <div class="layui-form-item padding-10">
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
                                    <button class="layui-btn">
                                        搜索
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="layui-col-md12" style="height:300px;">
                          <div class="layui-col-md6">
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
                            <div class="layui-col-md6">
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
                    </div>
                    
                    <div class="layui-tab-item" style="min-height: 400px;">
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
<?= Html::jsFile('@web/static/layuiadmin/layui/layui.js?v=' . date("ymd"), ['type' => "text/javascript"]) ?>
<?= Html::jsFile('@web/static/js/jquery.SuperSlide.2.1.1.js?v=' . date("ymd"), ['type' => "text/javascript"]) ?>
<?= Html::jsFile('@web/static/js/fishBone.js?v='.date("ymd"),['type' => "text/javascript"]) ?>
<script type="application/javascript">
$(document).ready(function () {
    layui.config({
        base: '/static/layuiadmin/' //指定 layuiAdmin 项目路径，本地开发用 src，线上用 dist
        , version: '2.4.5'
    }).extend({
        index: './lib/index' //主入口模块
    }).use(['index', 'console', 'form', 'sample', 'laydate', 'senior', 'table', 'laypage', 'layer', 'element', 'util'], function () {
    var laypage = layui.laypage
            , form = layui.form
            , slider = layui.slider;
     var $ = layui.$
            , admin = layui.admin
            , element = layui.element
            , router = layui.router();
            
    var storage = window.localStorage;
    var table = layui.table;
    var userData = storage.getItem("userData");
    var headerParams = JSON.parse(userData);
    var id = "<?= $id ?>";
    var mac = "<?= (isset($info) && isset($info['mac']) ? $info['mac'] : "") ?>";
    var params = {}, printModelListParams = {};
    params.id = id;
    printModelListParams.mac = mac; 
    
    var now = new Date();
    var start = now.getTime() - 30 * 24 * 60 * 60 * 1000;  // 将当前时间转换为时间戳
    laydate.render({
         elem: '#test1',
         type: 'datetime', // 可选择年、月、日、时、分、秒
         min: start, // 规定最小日期
         done: function (value) {
             // value为第一个日期选择框选择的日期
             const start2 = new Date(value).getTime();
             const end = start2 + 30 * 24 * 60 * 60 * 1000;
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
     })
    //    data = [{'审理时间':'2016-12-20 至 2016-12-20','承办庭室':'XXXX','承办法官':'XXX','承办法院':'XXXXXXX法院','案件状态':'XX','案号':'(XXXX)XXXXXX第XXXX号'},{'审理时间': '2016-12-20 至 2016-12-20','承办庭室':'XXXX','承办法官':'XXX','承办法院':'XXXXXXX法院','案件状态':'XX','案号':'(XXXX)XXXXXX第XXXX号'},{'审理时间': '2016-12-20 至 2016-12-20','承办庭室':'XXXX','承办法官':'XXX','承办法院':'XXXXXXX法院','案件状态':'XX','案号':'(XXXX)XXXXXX第XXXX号(当前案件)'},{'审理时间': '2016-12-20 至 2016-12-20','承办庭室':'XXXX','承办法官':'XXX','承办法院':'XXXXXXX法院','案件状态':'XX','案号':'(XXXX)XXXXXX第XXXX号'},{'审理时间': '2016-12-20 至 2016-12-20','承办庭室':'XXXX','承办法官':'XXX','承办法院':'XXXXXXX法院','案件状态':'XX','案号':'(XXXX)XXXXXX第XXXX号'},{'审理时间': '2016-12-20 至 2016-12-20','承办庭室':'XXXX','承办法官':'XXX','承办法院':'XXXXXXX法院','案件状态':'XX','案号':'(XXXX)XXXXXX第XXXX号'},{'审理时间': '2016-12-20 至 2016-12-20','承办庭室':'XXXX','承办法官':'XXX','承办法院':'XXXXXXX法院','案件状态':'XX','案号':'(XXXX)XXXXXX第XXXX号(当前案件)'},{'审理时间': '2016-12-20 至 2016-12-20','承办庭室':'XXXX','承办法官':'XXX','承办法院':'XXXXXXX法院','案件状态':'XX','案号':'(XXXX)XXXXXX第XXXX号(当前案件)'},{'审理时间': '2016-12-20 至 2016-12-20','承办庭室':'XXXX','承办法官':'XXX','承办法院':'XXXXXXX法院','案件状态':'XX','案号':'(XXXX)XXXXXX第XXXX号(当前案件)'},{'审理时间': '2016-12-20 至 2016-12-20','承办庭室':'XXXX','承办法官':'XXX','承办法院':'XXXXXXX法院','案件状态':'XX','案号':'(XXXX)XXXXXX第XXXX号'},{'审理时间': '2016-12-20 至 2016-12-20','承办庭室':'XXXX','承办法官':'XXX','承办法院':'XXXXXXX法院','案件状态':'XX','案号':'(XXXX)XXXXXX第XXXX号(当前案件)'},{'审理时间': '2016-12-20 至 2016-12-20','承办庭室':'XXXX','承办法官':'XXX','承办法院':'XXXXXXX法院','案件状态':'XX','案号':'(XXXX)XXXXXX第XXXX号(当前案件)'},{'审理时间': '2016-12-20 至 2016-12-20','承办庭室':'XXXX','承办法官':'XXX','承办法院':'XXXXXXX法院','案件状态':'XX','案号':'(XXXX)XXXXXX第XXXX号'},{'审理时间': '2016-12-20 至 2016-12-20','承办庭室':'XXXX','承办法官':'XXX','承办法院':'XXXXXXX法院','案件状态':'XX','案号':'(XXXX)XXXXXX第XXXX号(当前案件)'}];
    //创建案件历史
    //    $(".fishBone").fishBone(data);
    //    $(function() {
    //    });
    
    var sourceDates=[];
    var showEventdata = function (data) {
        var datac = [];
        if (data.dataList !== undefined) {
            sourceDates = data.dataList;
            $.each(data.dataList, function (i, value) {
                var list = {};
                list.sourceDate = "";
                list.sourceDate = "<div class='layui-col-md12 cilickdiv' data-id='" + i + "'>";
                $.each(value, function (j, datav) {
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
      $(document).on("click", ".cilickdiv", function (obj) {
            var index = $(this).data("id");
            cnetval = sourceDates[index];
            var sourceDate = "";
            sourceDate = "<div class='layui-col-md12'>";
            $.each(cnetval, function (j, datav) {
                sourceDate += datav + "<br/>";
            });
            sourceDate += "</div>"; 
            $("#divcent").empty();
            $("#divcent").append($(sourceDate));
    })
    
    var service = function (type) {
        var modelurl = "<?= Url::to(['common/bind-printer/service-time']); ?>";
        var endTime = $(".endTimeOne input").val();
        var startTime = $("#test3").val();
        var Params = {};
        if(type!=1){
          Params.endTime = endTime;
          Params.startTime = startTime;  
        }
        Params.mac = mac;
        getinfo(modelurl, Params, function (data) {
            console.log(data);
        })
        renderTimeRatio(0);
        renderCustom(0);
  }

    $(".layui-this").trigger("click");

    $(".layui-tab ul li:first").trigger("click");

    element.render();
    var printInfoDataHtml = "", dynamicInfoHtml = "", getPrintModelListHtml = "";
    var printInfoData = {};
    printInfoData = getPrintInfo();
    getPrintModelListHtml = getPrintModelList();
    $(".layui-tab-content .layui-show").html(printInfoData.printInfoData);
    element.on('tab(component-tabs-brief)', function (obj) {
        if (obj.index == 0) {
            $(".layui-tab-content .layui-show").html(printInfoData.printInfoData);
        } else if (obj.index == 1) {
            $(".layui-tab-content .layui-show").html(printInfoData.dynamicInfo);
        } else if (obj.index == 2) {
           service();
        } else if (obj.index == 3) {
            //$(".layui-tab-content .layui-show").html(getPrintModelListHtml);
            //var html= $(".layui-tab-content .layui-show").html();
         
        } 
    });
     $(".layui-tab-content .layui-show").html(printInfoData.printInfoData);
    function getPrintModelList() {
        $.ajax({
            type: "post",
            url: "<?= Url::to(['common/bind-printer/get-print-model-list']); ?>",
            contentType: "application/json;charset=utf-8",
            data: JSON.stringify(printModelListParams),
            dataType: "json",
            beforeSend: function (XMLHttpRequest) {
                for (var i in headerParams) {
                    XMLHttpRequest.setRequestHeader(i, headerParams[i]);
                }
            },
            success: function (result) {
                if (result.code == 0) {
                    showEventdata(result.data);
                } else if (result.code == 5001) {
                    layer.msg(result.msg, {
                        icon: 2,
                        time: 2000 //2秒关闭（如果不配置，默认是3秒）
                    }, function () {
                        top.location.href = "../user/login"
                    });
                    return "<tr style='align:center;'>" + result.msg + "</tr>";
                } else {
                    layer.msg("未获取到打印记录相关的数据", {icon: 2});
                    getPrintModelListHtml = "<tr style='align:center;'>未获取到打印记录相关的数据</tr>";
                }
            },
            error: function () {
                getPrintModelListHtml = "<tr style='align:center;'>未获取到相关的数据</tr>";
            }
        });
        return getPrintModelListHtml;
    }
    //    element.render();
    //设备参数
    function getPrintInfo() {
        $.ajax({
            type: "post",
            url: "<?= Url::to(['common/bind-printer/get-info']); ?>",
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
                    printInfoDataHtml += "<table class='layui-table'><tbody>";
                    if (result.data.projectModelInfo.image !== undefined) {
                        printInfoDataHtml += "<tr>";
                        printInfoDataHtml += "<img src='" + result.data.projectModelInfo.image + "' width='150' heigh='150'></td>";
                        printInfoDataHtml += "</tr><tr>";
                    }
                    if (result.data.modelInfo !== undefined) {
                        $.each(result.data.modelInfo, function (i, value) {
                            printInfoDataHtml += "<td>" + value.PropertyName + ":</td>";
                            printInfoDataHtml += "<td>" + value.PropertyValue + "</td>";
                            if ((i + 1) % 2 == 0) {
                                printInfoDataHtml += "</tr><tr>";
                            }
                        });
                    }
                    printInfoDataHtml += "</tr>";
                    printInfoDataHtml += "</tbody></table>";

                    dynamicInfoHtml += "<table class='layui-table'><tbody><tr>";
                    if (result.data.modelInfo !== undefined) {
                        var flag = 0;
                        var time = "";
                        if (result.data.print_name !== undefined) {
                            flag++;
                            dynamicInfoHtml += "<td>打印机名称:</td>";
                            dynamicInfoHtml += "<td>" + result.data.print_name + "</td>";
                        }
                        $.each(result.data.macInfo, function (i, value) {
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
                            //                            flag++;
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

                    printInfoData.printInfoData = printInfoDataHtml;
                    printInfoData.dynamicInfo = dynamicInfoHtml;
                } else if (result.code == 5001) {
                    layer.msg(result.msg, {
                        icon: 2,
                        time: 2000 //2秒关闭（如果不配置，默认是3秒）
                    }, function () {
                        top.location.href = "../user/login"
                    });
                    return "<tr style='align:center;'>" + result.msg + "</tr>";
                } else {
                    layer.msg("未获取到相关的数据", {icon: 2});
                    return "<tr style='align:center;'>未获取到相关的数据</tr>";
                }
            },
            error: function () {
                return "<tr style='align:center;'>未获取到相关的数据</tr>";
            }
        });
        return printInfoData;
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
   });
});
</script>