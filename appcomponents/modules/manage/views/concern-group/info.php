<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<title><?= Html::encode($title ? $title : (isset($this->title) ? $this->title : null)) ?></title>
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
<?=Html::cssFile('@web/static/layuiadmin/layui/css/layui.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
<?=Html::cssFile('@web/static/layuiadmin/style/admin.css?v='.date("ymd"), ['rel' => "stylesheet"])?>

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
                <div class="layui-tab-content">
                    <div class="layui-tab-item layui-show"></div>
                    <div class="layui-tab-item"></div>
                    <div class="layui-tab-item"></div>
                    <div class="layui-tab-item"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="application/javascript">
layui.use(['form', 'table', 'laypage', 'layer'], function(){
    var laypage = layui.laypage
        ,form = layui.form;
    var $ = layui.$
        ,admin = layui.admin
        ,element = layui.element
        ,router = layui.router();
    //loading层
//    var index = layer.load(1, {
//        shade: [0.1,'#fff'] //0.1透明度的白色背景
//    });
    var storage=window.localStorage;
    var table = layui.table;
    var userData = storage.getItem("userData");
    var headerParams = JSON.parse(userData);
    var id = "<?=$id?>";
    var params = {};
    params.id=id;
    $(".layui-this").trigger("click");

    element.render();
    $(".layui-tab ul li:first").trigger("click");
    var printInfoDataHtml = "",dynamicInfoHtml="";
    var printInfoData = {};
    printInfoData = getPrintInfo();
    $(".layui-tab-content .layui-show").html(printInfoData.printInfoData);
    element.on('tab(component-tabs-brief)', function(obj){
        if(obj.index==0) {
            $(".layui-tab-content .layui-show").html(printInfoData.printInfoData);
        } else if(obj.index==1) {
            $(".layui-tab-content .layui-show").html(printInfoData.dynamicInfo);
        } else if(obj.index==2) {
            $(".layui-tab-content .layui-show").html(222);
        } else if(obj.index==3) {
            $(".layui-tab-content .layui-show").html(333);
        } else {
            $(".layui-tab-content .layui-show").html("暂无数据");
        }
    });
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
                    printInfoDataHtml +="<table class='layui-table'><tbody>";
                    if(result.data.projectModelInfo.image !== undefined) {
                        printInfoDataHtml +="<tr>";
                        printInfoDataHtml +="<img src='"+result.data.projectModelInfo.image+"' width='150' heigh='150'></td>";
                        printInfoDataHtml +="</tr><tr>";
                    }
                    if(result.data.modelInfo !== undefined) {
                        $.each(result.data.modelInfo, function(i, value){
                            printInfoDataHtml +="<td>"+value.PropertyName+":</td>";
                            printInfoDataHtml +="<td>"+value.PropertyValue+"</td>";
                            if((i+1)%2==0) {
                                printInfoDataHtml +="</tr><tr>";
                            }
                        });
                    }
                    printInfoDataHtml +="</tr>";
                    printInfoDataHtml +="</tbody></table>";

                    dynamicInfoHtml +="<table class='layui-table'><tbody><tr>";
                    if(result.data.modelInfo !== undefined) {
                        var flag=0;
                        var time="";
                        if(result.data.print_name !== undefined) {
                            flag++;
                            dynamicInfoHtml += "<td>打印机名称:</td>";
                            dynamicInfoHtml += "<td>" + result.data.print_name + "</td>";
                        }
                        $.each(result.data.macInfo, function(i, value){
                            if(i=="mac") {
                                flag++;
                                dynamicInfoHtml +="<td>MAC地址:</td>";
                                dynamicInfoHtml +="<td>"+value+"</td>";
                            }
                            if(i=="moduName") {
                                flag++;
                                dynamicInfoHtml +="<td>模型名称:</td>";
                                dynamicInfoHtml +="<td>"+value+"</td>";
                            }
                            if(i=="restMemory") {
                                flag++;
                                dynamicInfoHtml +="<td>剩余内存:</td>";
                                dynamicInfoHtml +="<td>"+value+"MB</td>";
                            }
                            if(i=="printProgress") {
                                flag++;
                                dynamicInfoHtml +="<td>已完成:</td>";
                                dynamicInfoHtml +="<td>"+value.substr(0,value.indexOf(".")+3)+"%</td>";
                            }
                            if(i=="ppTemp") {
                                flag++;
                                dynamicInfoHtml +="<td>打印平台温度:</td>";
                                dynamicInfoHtml +="<td>"+value+"</td>";
                            }
                            if(i=="ptorTemp") {
                                flag++;
                                dynamicInfoHtml +="<td>打印头温度:</td>";
                                dynamicInfoHtml +="<td>"+value+"</td>";
                            }
                            if(i=="moduPrintTime") {
                                flag++;
                                dynamicInfoHtml +="<td>已用时间:</td>";
                                dynamicInfoHtml +="<td>"+value+"</td>";
                            }
                            if(i=="ipInfo") {
                                flag++;
                                dynamicInfoHtml +="<td>IP和端口:</td>";
                                dynamicInfoHtml +="<td>"+value+"</td>";
                            }
                            if(i=="workState") {
                                var status="";
                                if(value=="1"){
                                    status="空闲";
                                }else if(value=="2"){
                                    status="工作中";
                                }else{
                                    status="故障";
                                }
                                flag++;
                                dynamicInfoHtml +="<td>状态:</td>";
                                dynamicInfoHtml +="<td>"+status+"</td>";
                            }
                            if(i=="workingH") {
                                time+=value+"h";
                            }
                            if(i=="workingM") {
                                time+=value+"m";
                            }
//                            flag++;
                            if(flag%2==0) {
                                dynamicInfoHtml +="</tr><tr>";
                            }
                        });
                        if(time) {
                            flag++;
                            dynamicInfoHtml +="<td>累计工作时间:</td>";
                            dynamicInfoHtml +="<td>"+time+"</td>";
                            if(flag%2==0) {
                                dynamicInfoHtml +="</tr><tr>";
                            }
                        }
                        if(flag%2==0) {
                            dynamicInfoHtml +="</tr><tr>";
                        }
                    }
                    dynamicInfoHtml +="</tr>";
                    dynamicInfoHtml +="</tbody></table>";

                    printInfoData.printInfoData = printInfoDataHtml;
                    printInfoData.dynamicInfo = dynamicInfoHtml;
                    console.log(printInfoData)
//                    console.log(dynamicInfoHtml)
                }  else if(result.code == 5001) {
                    layer.msg(result.msg, {
                        icon: 2,
                        time: 2000 //2秒关闭（如果不配置，默认是3秒）
                    }, function(){
                        top.location.href="../user/login"
                    });
                    return "<tr style='align:center;'>"+result.msg+"</tr>";
                }else {
                    layer.msg("未获取到相关的数据", {icon: 2});
                    return "<tr style='align:center;'>未获取到相关的数据</tr>";
                }
            },
            error: function () {
                return "<tr style='align:center;'>未获取到相关的数据</tr>";
            }
        });
//            = {
//            "printInfoData":printInfoDataHtml,
//            "dynamicInfo":dynamicInfoHtml
//        };
//        printInfoData.printInfoDataHtml=printInfoDataHtml;
//        printInfoData.dynamicInfoHtml=dynamicInfoHtml;
        console.log(printInfoDataHtml)
        console.log(dynamicInfoHtml)
        console.log(printInfoData)
        return printInfoData;
    }
});
</script>