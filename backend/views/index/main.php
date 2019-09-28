<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<title>layuiAdmin 控制台主页一</title>
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
<?= Html::cssFile('@web/static/layuiadmin/layui/css/layui.css?v=' . date("ymd"), ['rel' => "stylesheet"]) ?>
<?= Html::cssFile('@web/static/layuiadmin/style/admin.css?v=' . date("ymd"), ['rel' => "stylesheet"]) ?>

<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md8">
            <div class="layui-row layui-col-space15">
                <div class="layui-col-md6">
                    <div class="layui-card">
                        <div class="layui-card-header">
                            <a data-open="<?= Url::to(['common/repertory/show-repertory']); ?>">
                                待办事项
                            </a>
                        </div>
                        <div class="layui-card-body">

                            <div class="layui-carousel layadmin-carousel layadmin-backlog">
                                <div carousel-item class="Backlog">
                                    <ul class="layui-row layui-col-space10">
                                        <li class="layui-col-xs6">
                                            <a data-open="<?= Url::to(['common/repertory/show-repertory']); ?>" class="layadmin-backlog-body">
                                                <h3>待发货</h3>
                                                <p><cite>66</cite></p>
                                            </a>
                                        </li>
                                        <li class="layui-col-xs6">
                                            <a data-open="<?= Url::to(['common/repertory/show-repertory']); ?>" class="layadmin-backlog-body">
                                                <h3>待出库</h3>
                                                <p><cite>99</cite></p>
                                            </a>
                                        </li>
                                        <li class="layui-col-xs6">
                                            <a data-open="<?= Url::to(['common/repertory/show-repertory']); ?>" class="layadmin-backlog-body">
                                                <h3>待审核</h3>
                                                <p><cite>20</cite></p>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="layui-col-md6">
                    <div class="layui-card">
                        <div class="layui-card-header">
                            <a data-open="<?= Url::to(['common/repertory/show-inventory']); ?>">库存显示</a>
                        </div>
                        <div class="layui-card-body">

                            <div class="layui-carousel layadmin-carousel layadmin-backlog">
                                <div carousel-item class="Inventory">
                                    <ul class="layui-row layui-col-space10">
                                        <li class="layui-col-xs6">
                                            <a data-open="<?= Url::to(['common/repertory/show-inventory']); ?>" class="layadmin-backlog-body">
                                                <h3>打印机</h3>
                                                <p><cite>66</cite></p>
                                            </a>
                                        </li>
                                        <li class="layui-col-xs6">
                                            <a data-open="<?= Url::to(['common/repertory/show-inventory']); ?>" class="layadmin-backlog-body">
                                                <h3>打印机配件</h3>
                                                <p><cite>12</cite></p>
                                            </a>
                                        </li>
                                        <li class="layui-col-xs6">
                                            <a data-open="<?= Url::to(['common/repertory/show-inventory']); ?>" class="layadmin-backlog-body">
                                                <h3>打印机耗材</h3>
                                                <p><cite>99</cite></p>
                                            </a>
                                        </li>

                                    </ul>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="layui-col-md12">
                    <div class="layui-card">
                        <div class="layui-card-header">
                            访问量
                        </div>
                        <div class="layui-card-body">
                            <div class="layui-carousel layadmin-carousel layadmin-dataview" data-anim="fade" lay-filter="LAY-index-pagetwo">
                                <div carousel-item id="LAY-index-pagetwo">
                                    <div><i class="layui-icon layui-icon-loading1 layadmin-loading"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="layui-col-sm12">
                    <div class="layui-card">
                        <div class="layui-card-header">全国3D打印机使用用户分布图</div>
                        <div class="layui-card-body">
                            <div class="layui-row layui-col-space15">
                                <div class="layui-col-sm9">
                                    <div class="layui-carousel layadmin-carousel layadmin-dataview" data-anim="fade" lay-filter="LAY-index-
                                         ">
                                        <div carousel-item id="LAY-index-pagethree">
                                            <div><i class="layui-icon layui-icon-loading1 layadmin-loading"></i></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="layui-col-sm3"  style="margin-top: 50px;border:1px solid #1a1b1b;">
                                    <div class="layui-col-sm12" style="text-align: center;">
                                        <div class="layui-col-sm12">
                                            <i class="layui-icon-home-printerdesk" style="font-size:25px; color: #1E9FFF;float:left;padding:15px 0px 0px 0px;"></i> 
                                            <div class="layui-col-sm9" style="float:right;">
                                                <p>桌面打印机</p>    
                                                <p style="color:#00b8ff;">
                                                    <span class="deskNum">40</span>台
                                                </p>
                                            </div>
                                        </div>
                                        <div class="layui-col-sm9" style="padding:15px 0px 0px 10px;">
                                            <div class="layui-col-sm3">
                                                <span class="layui-badge-dot layui-bg-orange"></span>
                                            </div>
                                            <div class="layui-col-sm9">
                                                <p>打印中</p>    
                                                <p class="deskWorkNum">23</p>
                                            </div>
                                        </div>

                                        <div class="layui-col-sm9" style="padding:15px 0px 0px 10px;">
                                            <div class="layui-col-sm3">
                                                <span class="layui-badge-dot layui-bg-gray"></span>
                                            </div>
                                            <div class="layui-col-sm9">
                                                <p>空闲中</p>    
                                                <p class="deskRestNum">23</p>
                                            </div>
                                        </div>
                                    </div>
                                <!-- <div class="layui-col-sm6" style="text-align: center;">
                                        <div class="layui-col-sm12">
                                            <i class="layui-icon-home-printermetal" style="font-size:25px; color: #1E9FFF;float:left;padding:15px 0px 0px 0px;"></i> 
                                            <div class="layui-col-sm9" style="float:right;">
                                                <p>金属打印机</p>    
                                                <p style="color:#ff8100;">
                                                    <span class="metalNum">20</span>
                                                    台
                                                </p>
                                            </div>
                                        </div>
                                        <div class="layui-col-sm9" style="padding:15px 0px 0px 10px;">
                                            <div class="layui-col-sm3">
                                                <span class="layui-badge-dot layui-bg-orange"></span>
                                            </div>
                                            <div class="layui-col-sm9">
                                                <p>打印中</p>    
                                                <p class="metalWorkNum">23</p>
                                            </div>
                                        </div>

                                        <div class="layui-col-sm9" style="padding:15px 0px 0px 10px;">
                                            <div class="layui-col-sm3">
                                                <span class="layui-badge-dot layui-bg-gray"></span>
                                            </div>
                                            <div class="layui-col-sm9" style="text-">
                                                <p>空闲中</p>    
                                                <p class="metalRestNum">23</p>
                                            </div>
                                        </div>
                                    </div>--> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="layui-col-md12">
                    <div class="layui-card">

                        <div class="layui-card-header">
                            <div class="layui-col-md3" style="float:left;">
                                <span>各类产品销售统计</span>
                            </div>
                            <div class="layui-col-md3" style="float:right;">
                                <button class="layui-btn  layui-btn-xs funcs" data-type="1" >整天</button>
                                <button class="layui-btn  layui-btn-xs funcs" data-type="2" >本年</button>
                                <button class="layui-btn  layui-btn-xs funcs" data-type="3">本周</button>
                            </div>
                        </div>

                        <div class="layui-card-body">
                            <div class="layui-carousel layadmin-carousel layadmin-dataview" data-anim="fade" lay-filter="LAY-index-heapbar">
                                <div carousel-item id="LAY-index-heapbar">
                                    <div><i class="layui-icon layui-icon-loading1 layadmin-loading"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="layui-col-md4">
            <div class="layui-card">
                <div class="layui-card-header">订单管理</div>
                <div class="layui-card-body">
                    <div class="layui-tab layui-tab-brief" lay-filter="component-tabs-brief">
                        <ul class="layui-tab-title">
                            <li class="layui-this" lay-id="0">全部</li>
                            <li lay-id="1">待配货</li>
                            <li lay-id="2">待出库</li>
                            <li lay-id="3">待退款</li>
                        </ul>
                        <div class="layui-tab-content">
                            <div class="layui-tab-item layui-show">
                                <form autocomplete="off" onsubmit="return false;" data-auto="true" method="post">
                                    <input type="hidden" value="resort" name="action">
                                    <table class="layui-hide" id="dataList"></table>
                                </form>
                                <div id="page"></div>
                            </div>
                            <div class="layui-tab-item">
                                <form autocomplete="off" onsubmit="return false;" data-auto="true" method="post">
                                    <input type="hidden" value="resort" name="action">
                                    <table class="layui-hide" id="dataList1"></table>
                                </form>
                                <div id="page1"></div>
                            </div>
                            <div class="layui-tab-item">
                                <form autocomplete="off" onsubmit="return false;" data-auto="true" method="post">
                                    <input type="hidden" value="resort" name="action">
                                    <table class="layui-hide" id="dataList2"></table>
                                </form>
                                <div id="page2"></div>
                            </div>
                            <div class="layui-tab-item">
                                <form autocomplete="off" onsubmit="return false;" data-auto="true" method="post">
                                    <input type="hidden" value="resort" name="action">
                                    <table class="layui-hide" id="dataList3"></table>
                                </form>
                                <div id="page3"></div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>

        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-header">新增用户量</div>
                <div class="layui-card-body">
                    <div class="layui-carousel layadmin-carousel layadmin-dataview" data-anim="fade" lay-filter="LAY-index-heaparea">
                        <div carousel-item id="LAY-index-heaparea">
                            <div><i class="layui-icon layui-icon-loading1 layadmin-loading"></i></div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="layui-card">
                <div class="layui-card-header">打印机使用情况</div>
                <div class="layui-card-body layadmin-takerates" lay-filter="takerates">
                    <div class="layui-progress" lay-showPercent="yes">
                        <h3>全部</h3>
                        <div class="layui-progress-bar" lay-percent="99%"></div>
                    </div>

                    <div class="layui-progress" lay-showPercent="yes">
                        <h3>XGM-3A</h3>
                        <div class="layui-progress-bar layui-bg-red" lay-percent="40%"></div>
                    </div>

                </div>
            </div>
        </div>
            <div class="layui-col-md12">
           <div class="layui-card">
                <div class="layui-card-header">打印机报修统计</div>
                <div class="layui-card-body">
                    <div class="layui-tab layui-tab-brief" lay-filter="repairs-tabs-brief">
                        <ul class="layui-tab-title">
                            <li class="layui-this" lay-id="0">全部</li>
                            <li lay-id="1">已经受理</li>
                            <li lay-id="2">未受理</li>
                            <li lay-id="3">已完成</li>
                        </ul>
                        
                        <div class="layui-tab-content repairsContent">
                            <div class="layui-tab-item layui-show">
                                <form autocomplete="off" onsubmit="return false;" data-auto="true" method="post">
                                    <input type="hidden" value="resort" name="action">
                                    <table class="layui-hide" id="RepairsList"></table>
                                </form>
                                <div id="repairspage"></div>
                            </div>
                            <div class="layui-tab-item">
                                <form autocomplete="off" onsubmit="return false;" data-auto="true" method="post">
                                    <input type="hidden" value="resort" name="action">
                                    <table class="layui-hide" id="RepairsList1"></table>
                                </form>
                                <div id="repairspage1"></div>
                            </div>
                            <div class="layui-tab-item">
                                <form autocomplete="off" onsubmit="return false;" data-auto="true" method="post">
                                    <input type="hidden" value="resort" name="action">
                                    <table class="layui-hide" id="RepairsList2"></table>
                                </form>
                                <div id="repairspage2"></div>
                            </div>
                            <div class="layui-tab-item">
                                <form autocomplete="off" onsubmit="return false;" data-auto="true" method="post">
                                    <input type="hidden" value="resort" name="action">
                                    <table class="layui-hide" id="RepairsList3"></table>
                                </form>
                                <div id="repairspage3"></div>
                            </div>
                        </div>
                    </div>
            </div>
        </div> 
       </div> 
            
    </div>
</div>



<?= Html::jsFile('@web/static/layuiadmin/layui/layui.js?v=' . date("ymd"), ['type' => "text/javascript"]) ?>
<script>
layui.config({
    base: '/static/layuiadmin/' //指定 layuiAdmin 项目路径，本地开发用 src，线上用 dist
    , version: '2.4.5'
}).extend({
    index: './lib/index' //主入口模块
}).use(['index', 'console', 'sample', 'senior', 'laytpl', 'layer', 'element', 'util','form', 'table', 'laypage'], function () {
    var laypage = layui.laypage
        ,form = layui.form;
    var storage=window.localStorage;
    var table = layui.table;
    var userData = storage.getItem("userData");
    var headerParams = JSON.parse(userData);
    var element = layui.element;
    var istatus=1;
    var GraphicProportion = function (data) {
        if (data.count == 0) {
            $(".layadmin-takerates").html(
                    '<div class="layui-none">暂无数据</div>'
                    );
        }
        var countp = (Math.round(data.is_count / data.count * 10000) / 100.00);

        var counts = '<div class="layui-progress" lay-showPercent="yes">'
                + ' <h3>全部</h3>'
                + '<div class="layui-progress-bar" lay-percent="' + countp + '%"></div>'
                + '</div>';

        $.each(data.list, function (i, k) {
            if (i != "") {
                var proportion = (Math.round(k / data.count * 10000) / 100.00);
                var lis = '<div class="layui-progress" lay-showPercent="yes">'
                        + ' <h3>' + i + '</h3>'
                        + '<div class="layui-progress-bar layui-bg-red" lay-percent="' + proportion + '%"></div>'
                        + '</div>';
                counts += lis;
            }

        })
        $(".layadmin-takerates").html(counts);
        element.init();
        element.render('progress', "takerates")
    }


    var asynSell = function (data) {
        var list = {};
        var legend = [];
        var xAxis = [];
        var series = [];
        for (var kys in data.keys) {
            legend.push(data.keys[kys]);
            var map = {
            };
            map.name = data.keys[kys];
            map.type = 'bar';
            for (var ky in data.data) {
                if (ky == kys) {
                    map.data = data.data[ky];
                }
            }
            series.push(map);
        }
        for (var k in  data.date) {
            xAxis.push(data.date[k].replace("_", "-"));
        }
        list.legend = legend;
        list.xAxis = xAxis;
        list.series = series;
        renderHistogram(list);

    }


    var WorkingState = function (data) {
        $.each(data, function (i, k) {
            $("." + i).html(k);
        })
    }
    var  callbackFunc=function(data){
          var uri="<?= Url::to(['common/map/index']); ?>";
          window.location.href = '#'+uri+"?map="+data.name;

    }
    var asynMap = function (data) {
        var list = [];
        $.each(data, function (i, k) {
            var obj = {};
            obj.name = k.bd_province_name;
            obj.value = k.counts;
            list.push(obj);
        })
        renderMap(list,0,callbackFunc);


    }
    $.ajax({
        type: "post",
        url: "<?= Url::to(['common/graphic/get-main']); ?>",
        contentType: "application/json;charset=utf-8",
        data: JSON.stringify({typeStr: "1,2,3,4,5"}),
        dataType: "json",
        beforeSend: function (XMLHttpRequest) {
            for (var i in headerParams) {
                XMLHttpRequest.setRequestHeader(i, headerParams[i]);
            }
        },
        success: function (result) {
            if (result.code == 0) {
                $(".Backlog").find("cite").eq(0).html(result.data.getBacklog.WaitSendCount);
                $(".Backlog").find("cite").eq(1).html(result.data.getBacklog.WaitOutCount);
                $(".Backlog").find("cite").eq(2).html(result.data.getBacklog.WaitApproveCount);
                $(".Inventory").find("cite").eq(0).html(result.data.getInventory.print);
                $(".Inventory").find("cite").eq(1).html(result.data.getInventory.parts);
                $(".Inventory").find("cite").eq(2).html(result.data.getInventory.consumable);
                GraphicProportion(result.data.getUsageRate);
                WorkingState(result.data.getPercent);
                asynMap(result.data.getMapRendering);
                return true;
            } else {
                layer.alert(result.msg, {icon: 2}, function (index) {
                    return false;
                });
                return false;
            }
        },
        error: function () {
           
            layer.alert("更新数据异常", {icon: 2}, function (index) {
                return false;
            });
            return false;
            
        }
    })

    var ajaxData=function(ajaxurl,data,callback){
         $.ajax({
            type: 'POST',
            url:ajaxurl,
            data: data,
            dataType:"JSON",
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                istatus=1;
                layer.alert("更新数据异常", {icon: 2}, function (index) {
                    return false;
                });
                return false;
            }, 
            success: function (res) {
                callback(res);
            }
        });
    } 
    var getUser=function(){
         var url = '<?= Url::to(['passport/user/week-user']); ?> ';
         ajaxData(url,{},function(res){
            if(res.code==0){
                var data=res.data;
                var list=[];
                $.each(data.yaxe,function(i,c){
                    list.push(
                        {
                           name:c,
                           type:'line',
                           stack:'总量',
                           itemStyle:{'normal': {'areaStyle': {'type': 'default'}}},
                           data:data.data[i]
                        }
                    );
                })
               var xAxis=[];
               $.each(data.xAxis,function(i,c){
                    xAxis.push(c);
               })
               var datac={
                   legend:data.yaxe,
                   xAxis:xAxis,
                   series:list,
                };
                renderHistogramt(datac);
            }
         });
         
    }
    getUser();

    $(document).on('click', '.funcs', function () {
        var type = $(this).data("type");
        $(this).parent("div").find(".funcs").addClass('layui-btn-primary');
        $(this).removeClass('layui-btn-primary');
        $.ajax({
            type: "post",
            url: "<?= Url::to(['common/graphic/type-list']); ?>",
            data: JSON.stringify({type: type}),
            contentType: "application/json;charset=utf-8",
            dataType: "json",
            beforeSend: function (XMLHttpRequest) {
                for (var i in headerParams) {
                    XMLHttpRequest.setRequestHeader(i, headerParams[i]);
                }
            },
            success: function (result) {
                if (result.code == 0) {
                    asynSell(result.data);
                    return true;
                } else {
                    layer.alert(result.msg, {icon: 2}, function (index) {
                        return false;
                    });
                    return false;
                }
            },
            error: function () {
                layer.alert("获取数据异常", {icon: 2}, function (index) {
                    return false;
                });
                return false;
            }
        })
    });
    $(".funcs").eq(2).click();

    //订单切换
    var OrderListHtml = "";
    var orderDataList = {};
    var page = GetUrlParam("p") ? GetUrlParam("p") : 1;
    var size = GetUrlParam("size") ? GetUrlParam("size") : 5;
    orderDataList = getOrderList(page,size,-10,"dataList","page");
    element.on('tab(component-tabs-brief)', function(obj){
        if(obj.index==0) {
            if(orderDataList === undefined) {
                getOrderList(page,size,-10,"dataList","page");
            }
        } else if(obj.index==1) {
            getOrderList(page,size,30,"dataList1","page1");
        } else if(obj.index==2) {
            getOrderList(page,size,20,"dataList2","page2");
        } else if(obj.index==3) {
            getOrderList(page,size,50,"dataList3","page3");
        } else {
            $(".layui-tab-content .layui-show").html("暂无数据");
        }
    });

    //设备参数
    function getOrderList(p,size,status,objectId="dataList",pageId="page") {
        var params = {};
        params.p=p;
        params.size = size;
        params.count = 0;
        params.status = status;
        $.ajax({
            type: "post",
            url:"<?= Url::to(['order/order/get-list']); ?>",
            contentType: "application/json;charset=utf-8",
            data :JSON.stringify(params),
            dataType: "json",
            beforeSend: function (XMLHttpRequest) {
                for(var i in headerParams) {
                    XMLHttpRequest.setRequestHeader(i, headerParams[i]);
                }
            },
            success:function(result){
                params.count = result.data.count;
                if(result.code == 0) {
                    table.render({
                        elem: '#'+objectId
                        ,id:objectId
                        ,data:result.data.dataList
//                        ,cellMinWidth: 40 //全局定义常规单元格的最小宽度，layui 2.2.1 新增
                        ,cols: [[
                            ,{field:'order_no', title: '订单号'}
                            ,{field:'username', title: '用户名'}
                            ,{field:'status', title: '状态',toolbar:"#Jstatus"}
                            ,{field:'right', title: '操作',toolbar:"#barDemo"}
                        ]]
                        ,done: function(res, curr, count){
                            //自定义样式
                            laypage.render({
                                elem: pageId
                                ,count: params.count
                                ,limit:size
                                ,theme: '#1E9FFF'
                                ,curr: parseInt(p) || 1 //当前页
                                ,jump : function(obj, first){
                                    if(!first){ //一定要加此判断，否则初始时会无限刷新
                                       p=obj.curr;
                                       getOrderList(p,size,status,objectId,pageId);
                                    }
                                }
                            });
                        }
                    })
                } else if(result.code == 5001) {
                    layer.msg(result.msg, {
                        icon: 2,
                        time: 2000 //2秒关闭（如果不配置，默认是3秒）
                    }, function(){
                        top.location.href="../user/login"
                    });
                }else {
                    layer.msg(result.msg, {icon: 2});
                }
            },
            error: function () {
                table.render({
                    elem: '#'+objectId,
                    id: objectId,
                    limit: 0,
                    height: tableHeight,
                    size: 'sm',
                    data:[]
                })
            }
        });
    }
    

  var  RepairsList=function(p,size,status,objectId="RepairsList",pageId="repairspage"){
       if(istatus!=1){
           return false;
       }
       console.log(istatus);
      istatus=0;
      var url = '<?= Url::to(['repairs/repair/home-repair']); ?>';
     
      var params = {};
        params.p=p;
        params.size = size;
        params.count = 0;
        params.status = status;
        ajaxData(url,params,function(result){
         params.count = result.data.count;
                if(result.code == 0) {
                    table.render({
                        elem: '#'+objectId
                        ,id:objectId
                        ,data:result.data.dataList
//                        ,cellMinWidth: 40 //全局定义常规单元格的最小宽度，layui 2.2.1 新增
                        ,cols: [[
                             {field:'id', title: 'id'}
                            ,{field:'numberstr', title: '打印机序号'}
                            ,{field:'create_time', title: '报修时间'}
                            ,{field:'status', title: '状态',toolbar:"#RepairsSt"}
                            ,{field:'numberstr', title: '操作',toolbar:"#barRepairs"}
                        ]]
                        ,done: function(res, curr, count){
                            //自定义样式
                            laypage.render({
                                elem: pageId
                                ,count: params.count
                                ,limit:size
                                ,theme: '#1E9FFF'
                                ,curr: parseInt(p) || 1 //当前页
                                ,jump : function(obj, first){
                                    if(!first){ //一定要加此判断，否则初始时会无限刷新
                                       p=obj.curr;
                                       RepairsList(p,size,status,objectId,pageId);
                                    }
                                }
                            });
                            //如果是异步请求数据方式，res即为你接口返回的信息。
                            //如果是直接赋值的方式，res即为：{data: [], count: 99} data为当前页数据、count为数据总长度
                        }
                    })
                } else if(result.code == 5001) {
                    layer.msg(result.msg, {
                        icon: 2,
                        time: 2000 //2秒关闭（如果不配置，默认是3秒）
                    }, function(){
                        top.location.href="../user/login"
                    });
                }else {
                    layer.msg(result.msg, {icon: 2});
                }
          istatus=1;
          
      })
      
   }
    //订单切换
    var RepairsListHtml = "";
    var RepairsDataList = {};
    var page = GetUrlParam("p") ? GetUrlParam("p") : 1;
    var size = GetUrlParam("size") ? GetUrlParam("size") : 5;
    RepairsDataList = RepairsList(page,size,1,"RepairsList","repairspage");

    element.on('tab(repairs-tabs-brief)', function(obj){
        if(obj.index==0) {
            if(RepairsDataList === undefined) {
                RepairsList(page,size,1,"RepairsList","repairspage");
            }
        } else if(obj.index==1) {
            RepairsList(page,size,2,"RepairsList1","repairspage1");
        } else if(obj.index==2) {
            RepairsList(page,size,3,"RepairsList2","repairspage2");
        } else if(obj.index==3) {
            RepairsList(page,size,4,"RepairsList3","repairspage3");
        } else {
            $(".repairsContent .layui-show").html("暂无数据");
        }
    }); 
    
    
    
 
    
    
});

</script>

<script type="text/html" id="barDemo">

    <?php
//    if(isset($menuUrl) && !empty($menuUrl) && in_array(trim(Url::to(['/ledger/order/info']),"/"), $menuUrl)) {
        ?>
        <a class="layui-btn layui-btn-radius layui-btn-sm layui-btn-mini" data-modal="<?=Url::to(['/ledger/order/info']);?>?id={{d.id}}" data-title="订单详情">查看</a>
    <?php
//    }
    ?>
</script>

<script type="text/html" id="Jstatus">
    {{#  if(d.status ==0){ }}
    已取消
    {{# }if(d.status ==-1) { }}
    已删除
    {{# }if(d.status ==5) { }}
    购物车
    {{# }if(d.status ==10) { }}
    待支付
    {{# }if(d.status ==20) { }}
    已支付
    {{# }if(d.status ==30) { }}
    已发货
    {{# }if(d.status ==40) { }}
    已过期
    {{# }if(d.status ==50) { }}
    申请退款
    {{# }if(d.status ==60) { }}
    退款中
    {{# }if(d.status ==70) { }}
    已退款
    {{# }if(d.status ==80) { }}
    已签收
    {{#  } }}
</script>

<script type="text/html" id="RepairsSt">
    {{#  if(d.status ==1){ }}
    未受理
    {{# }if(d.status ==2) { }}
    受理中
    {{# }if(d.status ==3) { }}
    受理中
    {{# }if(d.status ==4) { }}
    已完成
    {{# } }}
</script>

<script type="text/html" id="barRepairs">
    <a class="layui-btn layui-btn-radius layui-btn-sm layui-btn-mini" data-modal="<?=Url::to(['/store/repair/show-popups']);?>?id={{d.id}}" data-title="详情">查看</a>
</script>


