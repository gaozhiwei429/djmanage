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

        <div class="layui-row">
            <div class="layui-col-md12 layui-form">
                <div class="layui-col-md6 layui-col-md-offset6">
                    <div class="layui-inline ">
                        <select name="city" lay-verify="" lay-filter="selUser">
                            <option value="0">请选择出库人员</option>
                            <?php foreach ($userlist as $key => $val) { ?>
                                <option value="<?= $val['mobile'] ?>"><?= $val['username'] ?></option>
                            <?php } ?>
                        </select>  
                    </div>  
                    <div class="layui-inline">
                        <select name="city" lay-verify="" lay-filter="selGoods">
                            <option value="0">请选择商品</option>
                            <?php foreach ($Project as $key => $val) { ?>
                                <option value="<?= $val['id'] ?>"><?= $val['name'] ?></option>
                            <?php } ?>
                        </select>  
                    </div> 
                    <div class="layui-inline">
                        <button class="layui-btn isoksubmit">
                            搜索
                        </button>
                    </div>
                </div> 
            </div>
        </div>
        <div class="layui-row">
            <div class="layui-col-md12 divcenter" style="text-align:center;display:none;height:150px; margin-top:150px;">暂无数据</div>
            <div class="layui-col-md12 divpic">
                <div class="layui-card">
                    <div class="layui-card-header">出库统计</div>
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
        
        form.on('select(selUser)', function(data){
             selUser=data.value;
        })
        
        form.on('select(selGoods)', function(data){
             selGoods=data.value;
        })
        
       $(document).on("click",".isoksubmit",function(){
             $(".divcenter").hide();
             $(".divpic").show();
             pielist();
       })
       var pielist=function(){
         var url="<?= Url::to(['common/repertory/get-repertory']); ?>";
         var params={};
         if(selUser!=0 && selGoods!=0 ){
             layer.msg("请选择一个维度");
             return false;
         }
         params.selUser=selUser;
         params.selGoods=selGoods;
         getinfo(url,params,function(res){
             var data={};
             var legend=[];
             var series=[];
             if(res.legend.length==0){
                 $(".divcenter").show();
                 $(".divpic").hide();
                 
             }
             $.each(res.legend,function(i,k){
                 legend.push(k);
             })
             $.each(res.series,function(i,k){
                 series.push({
                     value:k,
                     name:i,
                 });
             })
             data.legend=legend;
             data.series=series;
             renderTimeRatio(data);
         });
       }
       pielist();
    })
</script>