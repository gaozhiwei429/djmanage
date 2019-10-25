<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>
<?= Html::cssFile('@web/static/layuiadmin/style/admin.css?v=' . date("ymd"), ['rel' => "stylesheet"]) ?>
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

        <div class="layadmin-carousel layadmin-backlog">
            <div carousel-item class="Backlog Inventory">
                <ul class="layui-row layui-col-space10">
                    <li class="layui-col-xs2">
                        <a href="javascript:;" class="layadmin-backlog-body">
                            <h3>打印机</h3>
                            <p><cite>66</cite></p>
                        </a>
                    </li>
                    <li class="layui-col-xs2">
                        <a href="javascript:;" class="layadmin-backlog-body">
                            <h3>打印机配件</h3>
                            <p><cite>99</cite></p>
                        </a>
                    </li>
                    <li class="layui-col-xs2">
                        <a href="javascript:;" class="layadmin-backlog-body">
                            <h3>打印机耗材</h3>
                            <p><cite>20</cite></p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="layui-row">
            <div class="layui-col-md12">
                <div class="layadmin-carousel layadmin-dataview" data-anim="fade" lay-filter="LAY-index-crosswise">
                    <div carousel-item id="LAY-index-crosswise">
                        <div>
                           <i class="layui-icon layui-icon-loading1 layadmin-loading"></i>
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
    }).use(['index', 'sample', 'layer','form','element', 'util'], function () {
        var laypage = layui.laypage
                , laydate = layui.laydate
                , element = layui.element
                , table = layui.table;
        form = layui.form;
        form.render();
        var storage = window.localStorage;
        var userData = storage.getItem("userData");
        var headerParams = JSON.parse(userData);
        var selUser=0;
        var selGoods=0;
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
        
       var pielist=function(){
         var url="<?= Url::to(['common/repertory/get-inventory']); ?>";
         getinfo(url,[],function(res){
             var data={};
             var legend=[];
             var series=[];
             var yAxis=[];
          
             $.each(res.model,function(i,k){
                 legend.push(k);
             })
              $.each(res.region,function(i,k){
                 yAxis.push(k);
             })
             $.each(res.temp,function(i,k){
                 var eValue=eval('res.model.'+i); 
                 var klist=[];
                 $.each(k,function(c,l){
                     klist.push(l);
                 })
                 series.push({
                        name: eValue,
                        type: 'bar',
                        stack: '总量',
                        label: {
                            normal: {
                                show: true,
                                position: 'insideRight'
                            }
                        },
                        data: klist
                 });
             })
             data.legend=legend;
             data.series=series;
             data.yAxis=yAxis;
             renderCrosswise(data);
             $(".Inventory").find("cite").eq(0).html(res.type.print);
             $(".Inventory").find("cite").eq(1).html(res.type.parts);
             $(".Inventory").find("cite").eq(2).html(res.type.consumable);
         });
       }
       pielist();
    })
</script>
