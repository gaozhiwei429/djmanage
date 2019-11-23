<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */
?>
<?=Html::cssFile('@web/static/dangjian/css/main.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
<?=Html::cssFile('@web/static/dangjian/css/form.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
<?=Html::cssFile('@web/static/dangjian/css/layer.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
<?=Html::cssFile('@web/static/dangjian/css/laydate.css?v='.date("ymd"), ['rel' => "stylesheet"])?>

<style>
    .layui-laypage-btn {
        border: 1px solid #666 !important;
    }
    .layui-form-select .layui-input{
        height: 30px;
    }
    .laytable-cell-1-0-4 {
        width: 525px;
    }
</style>
<div class="layui-card">
    <div class="layui-header notselect">
        <div class="pull-left">
<span>
<?= Html::encode($title ? $title : (isset($this->title) ? $this->title : null)) ?>
</span>
</div>
        <div class="pull-right margin-right-15 nowrap">
            <?php
            if(isset($menuUrl) && !empty($menuUrl) && in_array(trim(Url::to(['manage/news/add']),"/"), $menuUrl)) {
                ?>
                <button data-open='<?=Url::to(['manage/news/edit']);?>' class='layui-btn layui-btn-sm layui-btn-primary'>添加</button>
            <?php
            }
            ?>
            <?php
            if(isset($menuUrl) && !empty($menuUrl) && in_array(trim(Url::to(['manage/news/del']),"/"), $menuUrl)) {
                ?>
                <button data-update data-field='delete' data-action='<?=Url::to(['manage/news/del']);?>'  class='layui-btn layui-btn-sm layui-btn-primary'>删除</button>
            <?php
            }
            ?>
        </div>
    </div>
    <div class="layui-card-body gray-bg searchPage">
        <!--主体-->
        <div style="margin-bottom:0px;">
            <div class="admin-main layui-form layui-field-box">
                <blockquote class="layui-elem-quote layui-text">点击排序的序号可编辑排序，数字越小排序越前</blockquote>
                <form id="search_form" class="layui-form layui-clear " action="">
                    <a href="#">
                        <button data-open='<?=Url::to(['manage/organization/edit']);?>' class='layui-btn layui-btn-sm layui-btn-primary'>添加部门</button>
                    </a>
<!--                    <a class="layui-btn  layui-btn-sm" data-open="--><?//=Url::to(['manage/organization/edit']);?><!--">添加部门</a>-->
                    <div class="" style="float: right;">
                        <script>
                            let renderArr = [];
                        </script>
                    </div>
                </form>
                <div class="layui-tab layui-tab-brief" lay-filter="component-tabs-brief">
                    <div class="layui-tab-content">
                        <div class="layui-tab-item layui-show">
                            <form autocomplete="off" onsubmit="return false;" data-auto="true" method="post">
                                <input type="hidden" value="resort" name="action">
                                <table class="layui-hide" id="dataList" lay-filter="text"></table>
                            </form>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
<!--页面JS脚本-->
<script type="text/html" id="toolbarDemo">
    <div class="layui-btn-container">
        <button class="layui-btn layui-btn-sm" lay-event="getCheckData">获取选中行数据</button>
        <button class="layui-btn layui-btn-sm" lay-event="getCheckLength">获取选中数目</button>
        <button class="layui-btn layui-btn-sm" lay-event="isAll">验证是否全选</button>
    </div>
</script>

<script type="text/html" id="toolbarExport">
    <div class="layui-btn-container">
        <button class="layui-btn layui-btn-sm" lay-event="exportData">导出选中的</button>
    </div>
</script>

<script type="text/html" id="datetimeTpl">
    {{formatUnixtimestamp(d)}}
</script>
<?=Html::jsFile('@web/static/dangjian/js/delelement.js?v='.date("ymd"), ['type' => "text/javascript"])?>
<script type="application/javascript">
var params = {};
var page = GetUrlParam("p") ? GetUrlParam("p") : 1;
var size = GetUrlParam("size") ? GetUrlParam("size") : 10;
var title = GetUrlParam("title") ? GetUrlParam("title") : "";
params.p=page;
params.size = size;
params.count = 0;
params.title = title;
layui.use(['form', 'table', 'laypage', 'layer', 'element', 'jquery', 'laydate'], function(){
    var laypage = layui.laypage
        ,form = layui.form;
    var element = layui.element;
    var storage=window.localStorage;
    var table = layui.table
        ,jq = layui.jquery
        ,$ = layui.jquery;
    var userData = storage.getItem("userData");
    var headerParams = JSON.parse(userData);
    //监听提交
    var selfUrl = window.location.href;
    form.on('submit(commit)', function(data){
        getProjectList(data.field,1,-1,"dataList");
    });
    let tableData = getProjectList(params, 1,-1,"dataList");

    //设备参数
    function getProjectList(params,p,size,objectId="dataList") {
//    var params = {};
        params.p=p;
        params.size = size;
        params.count = 1000;
        $.ajax({
            type: "post",
            url:"<?= Url::to(['/common/organization/get-tree-data']); ?>",
            contentType: "application/json;charset=utf-8",
            data :JSON.stringify(params),
            dataType: "json",
            beforeSend: function (XMLHttpRequest) {
                for(var i in headerParams) {
                    XMLHttpRequest.setRequestHeader(i, headerParams[i]);
                }
            },
            success:function(result){
                if(result.code == 0) {
                    layer.msg(result.msg, {
                        icon: 1,
                        time: 2000 //2秒关闭（如果不配置，默认是3秒）
                    }, function(){
                        table.render({
                            elem: '#'+objectId
                            ,id:objectId
                            ,data:result.data
                            , limit: result.data.length//显示的数量
                            ,cellMinWidth: 80 //全局定义常规单元格的最小宽度，layui 2.2.1 新增
//                    ,cellMinHeight: 80
                            ,cols: [[
                                {checkbox: true, fixed: true, width: 30}
                                ,{field:'id', title: 'ID', width: 30}
                                ,{field:'title', title: '党组织名称', minWidth: 100, toolbar:"#Jtitle"}
                                ,{field:'status', title: '状态', width: 80, toolbar:"#Jstatus"}//,toolbar:"#Jstatus"
                                ,{field:'sort', title: '排序',"type":"text","edit":"text","width":100}
                                ,{field:'right', title: '操作', minWidth: 120,toolbar:"#barDemo"}
                            ]]
                            ,done: function(res, curr, count){
                            }
                        })
                    });
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
                    id:objectId,
                    limit: 0,
                    height: tableHeight,
                    size: 'sm',
                    data:[]
                })
            }
        });
    }
    table.render(tableData);

    //监听单元格编辑
    table.on('edit(text)', function(obj){ //注：edit是固定事件名，test是table原始容器的属性 lay-filter="对应的值"
        var params = {};
        params.uuid = obj.data.uuid;
        params.sort = obj.data.sort;
        $.ajax({
            type: "post",
            url: "<?= Url::to(['common/organization/set-sort']); ?>",
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
                    layer.msg(result.msg, {
                        time: 2000,
                        shade: 0.6
                    });
                    return true;
                } else if(result.code == 5001){
                    layer.msg(result.msg, {
                        icon: 2,
                        shade: 0.6,
                        time: 2000 //2秒关闭（如果不配置，默认是3秒）
                    }, function(){
                        top.location.href="../user/login"
                    });
                    return true;
                } else {
                    layer.msg(result.msg, {
                        time: 2000,
                        shade: 0.6,
                        icon: 2
                    });
                    return true;
                }
            },
            error: function () {
                layer.msg("系统异常", {
                    time: 2000,
                    shade: 0.6,
                    icon: 2
                });
                return true;
            }
        })
    });
    //监听状态的操作
    form.on('switch(status)', function(obj){
        var params = {};
        var status = obj.elem.checked ? 1 : 0;
        var id = obj.elem.value;
        if(id) {
            params.uuid=id;
        }
        params.status=status;
        $.ajax({
            type: "post",
            url: "<?= Url::to(['common/organization/set-status']); ?>",
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
                    layer.msg(result.msg, {
                        time: 2000,
                        shade: 0.6
                    });
                    return true;
                } else if(result.code == 5001){
                    layer.msg(result.msg, {
                        icon: 2,
                        shade: 0.6,
                        time: 2000 //2秒关闭（如果不配置，默认是3秒）
                    }, function(){
                        top.location.href="../user/login"
                    });
                    return true;
                } else {
                    layer.msg(result.msg, {
                        time: 2000,
                        shade: 0.6,
                        icon: 2
                    });
                    return true;
                }
            },
            error: function () {
                layer.msg("系统异常", {
                    time: 2000,
                    shade: 0.6,
                    icon: 2
                });
                return true;
            }
        })
    });
    form.render(); //更新全部，防止input多选和单选框不显示问题
})
</script>

<script type="text/html" id="Jstatus">
    {{#  if(d.status ==0){ }}
    <input type="checkbox" name="status" lay-skin="switch" lay-text="上线|下线" lay-filter="status" data-id="{{d.id}}" data-status="{{d.status}}" value="{{d.uuid}}"/>
    {{# }if(d.status ==1) { }}
    <input type="checkbox" name="status" lay-skin="switch" lay-text="上线|下线" lay-filter="status" data-id="{{d.id}}" data-status="{{d.status}}" value="{{d.uuid}}" checked />
    {{#  } }}
</script>
<script type="text/html" id="Jtitle">
    {{#  if(d.title !==""){ }}
    {{d.flag}}{{d.title}}
    {{# }else{ }}
    {{#  } }}
</script>

<script type="text/html" id="barDemo">
    <a class="layui-btn layui-btn-warm layui-btn-xs" data-open="<?=Url::to(['manage/organization/edit']);?>?parent_uuid={{d.parent_uuid }}">
        添加子部门
    </a>
    <a class="layui-btn layui-btn-normal layui-btn-xs" data-open="<?=Url::to(['manage/organization/edit']);?>?uuid={{d.uuid }}">
        修改
    </a>
    <a class="layui-btn layui-btn-danger layui-btn-xs">
        删除
    </a>
</script>
<script type="text/html" id="barDemo">
    {{#  if(d.title !==""){ }}
    {{d.flag}}{{d.title}}
    {{# }else{ }}
    {{#  } }}
</script>
