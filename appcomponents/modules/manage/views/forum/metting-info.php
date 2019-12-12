<?php
use yii\helpers\Url;
use \yii\helpers\Html;
/* @var $this yii\web\View */
?>
<style>
    .btn{display:inline-block;*display:inline;*zoom:1;padding:4px 12px;margin-bottom:0;font-size:14px;line-height:20px;text-align:center;vertical-align:middle;cursor:pointer;color:#333333;text-shadow:0 1px 1px rgba(255, 255, 255, 0.75);background-color:#f5f5f5;background-image:-moz-linear-gradient(top, #ffffff, #e6e6e6);background-image:-webkit-gradient(linear, 0 0, 0 100%, from(#ffffff), to(#e6e6e6));background-image:-webkit-linear-gradient(top, #ffffff, #e6e6e6);background-image:-o-linear-gradient(top, #ffffff, #e6e6e6);background-image:linear-gradient(to bottom, #ffffff, #e6e6e6);background-repeat:repeat-x;filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffffff', endColorstr='#ffe6e6e6', GradientType=0);border-color:#e6e6e6 #e6e6e6 #bfbfbf;border-color:rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);*background-color:#e6e6e6;filter:progid:DXImageTransform.Microsoft.gradient(enabled = false);border:1px solid #cccccc;*border:0;border-bottom-color:#b3b3b3;-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px;*margin-left:.3em;-webkit-box-shadow:inset 0 1px 0 rgba(255,255,255,.2), 0 1px 2px rgba(0,0,0,.05);-moz-box-shadow:inset 0 1px 0 rgba(255,255,255,.2), 0 1px 2px rgba(0,0,0,.05);box-shadow:inset 0 1px 0 rgba(255,255,255,.2), 0 1px 2px rgba(0,0,0,.05);}.btn:hover,.btn:focus,.btn:active,.btn.active,.btn.disabled,.btn[disabled]{color:#333333;background-color:#e6e6e6;*background-color:#d9d9d9;}
    .btn:active,.btn.active{background-color:#cccccc \9;}
    .btn:first-child{*margin-left:0;}
    .btn:hover,.btn:focus{color:#333333;text-decoration:none;background-position:0 -15px;-webkit-transition:background-position 0.1s linear;-moz-transition:background-position 0.1s linear;-o-transition:background-position 0.1s linear;transition:background-position 0.1s linear;}
    .btn:focus{outline:thin dotted #333;outline:5px auto -webkit-focus-ring-color;outline-offset:-2px;}
    .btn.active,.btn:active{background-image:none;outline:0;-webkit-box-shadow:inset 0 2px 4px rgba(0,0,0,.15), 0 1px 2px rgba(0,0,0,.05);-moz-box-shadow:inset 0 2px 4px rgba(0,0,0,.15), 0 1px 2px rgba(0,0,0,.05);box-shadow:inset 0 2px 4px rgba(0,0,0,.15), 0 1px 2px rgba(0,0,0,.05);}
    .btn.disabled,.btn[disabled]{cursor:default;background-image:none;opacity:0.65;filter:alpha(opacity=65);-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none;}
</style>
<div class="layui-card">
    <div class="layui-card-body">
        <div style="margin-bottom:0px;">
            <div class="admin-main layui-form layui-field-box">
                <!-- layui-btn-sm -->
                <button class="layui-btn layui-btn-sm" onclick="window.history.go(-1);">返回</button>
                <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
                    <legend>会议详情</legend>
                </fieldset>

                <form autocomplete="off" class="layui-form" onsubmit="return false;" data-auto="true" action="#">
                    <input type="hidden" name="id" class="layui-input" value="<?=isset($dataInfo['id']) ? $dataInfo['id']:"";?>">

                    <div class="layui-form-item">
                        <label class="layui-form-label"><span class="require-text">*</span>会议主题</label>
                        <div class="layui-input-block">
                            <?=isset($dataInfo['title']) ? $dataInfo['title']:"";?>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label"><span class="require-text">*</span>地点</label>
                        <div class="layui-input-block">
                            <?=isset($dataInfo['address']) ? $dataInfo['address']:"";?>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">会议要求</label>
                        <div class="layui-input-block">
                            <?=isset($dataInfo['content']) ? $dataInfo['content']:"";?>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">
                            <span class="require-text"></span>时间
                        </label>
                        <div class="layui-input-block">
                            <?=(isset($dataInfo['start_time'])&&!empty($dataInfo['start_time'])) ? $dataInfo['start_time']." - ":"";?>至<?=(isset($dataInfo['end_time'])&&!empty($dataInfo['end_time'])) ? $dataInfo['end_time']:"";?>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label"><span class="require-text">*</span>主持人</label>
                        <div class="layui-input-block">
                            <?php
                            if(isset($dataInfo['president_people']) && $dataInfo['president_people']){
                                foreach($dataInfo['president_people'] as $k=>$v) {
                                    ?>
                                    【<?=isset($v['full_name']) ? $v['full_name']:"";?>】
                                <?php
                                }
                            }
                            ?>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label"><span class="require-text">*</span>主讲人</label>
                        <div class="layui-input-block">
                            <?php
                            if(isset($dataInfo['speaker_people']) && $dataInfo['speaker_people']){
                                foreach($dataInfo['speaker_people'] as $k=>$v) {
                            ?>
                             【<?=isset($v['full_name']) ? $v['full_name']:"";?>】
                            <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </form>
                <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
                    <legend>签到详情</legend>
                </fieldset>
                    <!-- 表单搜索 开始 -->
                    <form autocomplete="off" onsubmit="return false;" data-auto="true" method="post">
                        <input type="hidden" value="resort" name="action">
                        <table class="layui-hide" id="dataList"></table>
                    </form>
                    <div id="page"></div>
                    <!-- 表单搜索 结束 -->
            </div>
        </div>
    </div>
</div>
<script type="application/javascript">
layui.use(['form', 'table', 'laypage', 'layer'], function(){
    var laypage = layui.laypage;
    var form = layui.form
        ,element = layui.element;
    var storage=window.localStorage;
    var table = layui.table;
    var userData = storage.getItem("userData");
    var headerParams = JSON.parse(userData);
    //监听提交
    var params = {};
    var selfUrl = window.location.href;
    var page = GetUrlParam("p") ? GetUrlParam("p") : 1;
    var size = GetUrlParam("size") ? GetUrlParam("size") : 10;
    params.p=page;
    params.size = size;
    params.count = 0;
    params.type_id = 0;
    form.on('submit(commit)', function(data){
        var paramsStr = "";
        $.each(data.field, function(i, item){
            selfUrl = changeURLArg(selfUrl,i,item);
        });
        selfUrl = changeURLArg(selfUrl,"p",1);
        location.href = selfUrl;
    });
    $.ajax({
        type: "post",
        url:"<?=Url::to(['common/dangyuan/get-list']);?>?organization_id=<?=isset($dataInfo['organization_id']) ? $dataInfo['organization_id'] : 0;?>",
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
                    elem: '#dataList'
                    ,id:"dataList"
                    ,data:result.data.dataList
                    ,cellMinWidth: 80 //全局定义常规单元格的最小宽度，layui 2.2.1 新增
                    ,cols: [[
                        {checkbox: true, fixed: true}
                        ,{field:'id', title: 'ID', width: 30}
                        ,{field:'full_name', title: '用户姓名', minWidth: 100}
                        ,{field:'level_title', title: '职务', minWidth: 100}
                        ,{field:'organization_title', title: '党组织', minWidth: 200}
                        ,{field:'username', title: '手机号', minWidth: 100}
                    ]]
                    ,done: function(res, curr, count){
                        //自定义样式
                        laypage.render({
                            elem: 'page'
                            ,count: params.count
                            ,theme: '#1E9FFF'
                            ,curr: parseInt(page) || 1 //当前页
                            ,jump : function(obj, first){
                                if(!first){ //一定要加此判断，否则初始时会无限刷新
                                    selfUrl = changeURLArg(selfUrl,'p',obj.curr);
                                    selfUrl = changeURLArg(selfUrl,'size',size);
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
                elem: '#dataList',
                id: "dataList",
                limit: 0,
                height: tableHeight,
                size: 'sm',
                data:[]
            })
        }
    });
    element.render();
});
</script>