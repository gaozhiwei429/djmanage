<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */
?>
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
        <div class="pull-left"><span><?= Html::encode($title ? $title : (isset($this->title) ? $this->title : null)) ?></span></div>
        <div class="pull-right margin-right-15 nowrap">
            <?php
            if(isset($menuUrl) && !empty($menuUrl) && in_array(trim(Url::to(['manage/cms/leaders-edit']),"/"), $menuUrl)) {
                ?>
                <button data-open='<?=Url::to(['manage/cms/leaders-edit']);?>' class='layui-btn layui-btn-sm layui-btn-primary'>添加人物</button>
            <?php
            }
            ?>
            <?php
            if(isset($menuUrl) && !empty($menuUrl) && in_array(trim(Url::to(['manage/cms/leaders-edit']),"/"), $menuUrl)) {
                ?>
                <button data-update data-field='delete' data-action='<?=Url::to(['manage/cms/leaders-edit']);?>'  class='layui-btn layui-btn-sm layui-btn-primary'>删除</button>
            <?php
            }
            ?>
        </div>
    </div>
    <div class="layui-card-body">
        <!-- 表单搜索 开始 -->
        <form autocomplete="off" onsubmit="return false;" data-auto="true" method="post">
            <input type="hidden" value="resort" name="action">
            <input type="hidden" value="" name="ids" id="JtableIds">
            <table class="layui-hide" id="dataList" lay-filter="text"></table>
        </form>
        <div id="page"></div>
        <!-- 表单搜索 结束 -->
    </div>
</div>
<script type="application/javascript">
layui.use(['form', 'table', 'laypage', 'layer'], function(){
    var laypage = layui.laypage;
    var form = layui.form
        ,element = layui.element;
    var jq = layui.jquery
        ,$ = layui.jquery;
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
        url:"<?= Url::to(['common/leaders/get-list']); ?>",
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
//                        ,cellMinHeight: 500
                    ,cols: [[
                        {checkbox: true, fixed: true, width: 30}
                        ,{field:'id', title: 'ID', width: 30}
                        ,{field:'full_name', title: '姓名', minWidth: 100}
                        ,{field:'avatar_img', title: '头像', minWidth: 100, minHidth: 200, toolbar:"#Jimg"}
                        ,{field:'life_start_date', title: '生世', minWidth: 300, toolbar:"#Jlife"}
                        ,{field:'status', title: '状态', width: 80, toolbar:"#Jstatus"}//,toolbar:"#Jstatus"
                        ,{field:'sort', title: '排序',"type":"text","edit":"text","width":100}
                        ,{field:'right', title: '操作', minWidth: 120,toolbar:"#barDemo"}
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
                        layer.closeAll();
                    }
                })
            } else if(result.code == 5001) {
                layer.msg(result.msg, {
                    icon: 2,
                    time: 2000 //2秒关闭（如果不配置，默认是3秒）
                }, function(){
                    top.location.href="../user/login"
                });
                top.location.href="../user/login"
            }else {
                layer.msg(result.msg, {icon: 2},function(){
                    layer.closeAll();
                });
                layer.closeAll();
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

    //监听单元格编辑
    table.on('edit(text)', function(obj){ //注：edit是固定事件名，test是table原始容器的属性 lay-filter="对应的值"
        var params = {};
        params.id = obj.data.id;
        params.sort = obj.data.sort;
        $.ajax({
            type: "post",
            url: "<?= Url::to(['common/leaders/set-sort']); ?>",
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
                    },function(){
                        layer.closeAll();
                    });
                    layer.closeAll();
                    return true;
                } else if(result.code == 5001){
                    layer.msg(result.msg, {
                        icon: 2,
                        shade: 0.6,
                        time: 2000 //2秒关闭（如果不配置，默认是3秒）
                    }, function(){
                        top.location.href="../user/login"
                    });
                    top.location.href="../user/login"
                    return true;
                } else {
                    layer.msg(result.msg, {
                        time: 2000,
                        shade: 0.6,
                        icon: 2
                    },function(){
                        layer.closeAll();
                    });
                    layer.closeAll();
                    return true;
                }
            },
            error: function () {
                layer.msg("系统异常", {
                    time: 2000,
                    shade: 0.6,
                    icon: 2
                },function(){
                    layer.closeAll();
                });
                layer.closeAll();
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
            params.id=id;
        }
        params.status=status;
        $.ajax({
            type: "post",
            url: "<?= Url::to(['common/leaders/set-status']); ?>",
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
                    },function(){
                        layer.closeAll();
                    });
                    layer.closeAll();
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
                    },function(){
                        layer.closeAll();
                    });
                    layer.closeAll();
                    return true;
                }
            },
            error: function () {
                layer.msg("系统异常", {
                    time: 2000,
                    shade: 0.6,
                    icon: 2
                },function(){
                    layer.closeAll();
                });
                layer.closeAll();
                return true;
            }
        })
    });
    form.render(); //更新全部，防止input多选和单选框不显示问题
});
</script>

<script type="text/html" id="Jstatus">
    {{#  if(d.status ==0){ }}
    <input type="checkbox" name="status" lay-skin="switch" lay-text="上线|下线" lay-filter="status" data-id="{{d.id}}" data-status="{{d.status}}" value="{{d.id}}"/>
    {{# }if(d.status ==1) { }}
    <input type="checkbox" name="status" lay-skin="switch" lay-text="上线|下线" lay-filter="status" data-id="{{d.id}}" data-status="{{d.status}}" value="{{d.id}}" checked />
    {{#  } }}
</script>

<script type="text/html" id="Jimg">
    {{#  if(d.avatar_img!=""){ }}
    <img src="{{d.avatar_img}}">
    {{# }else{ }}
    暂无
    {{#  } }}
</script>
<script type="text/html" id="Jlife">
    {{#  if(d.life_start_date!=""){ }}
    {{d.life_start_date}}至{{d.life_end_date}}
    {{# }else{ }}
    暂无
    {{#  } }}
</script>
<script type="text/html" id="barDemo">
    <a class="layui-btn layui-btn-normal layui-btn-xs" data-open="<?=Url::to(['manage/cms/leaders-edit']);?>?id={{d.id}}">
        修改
    </a>
    <a class="layui-btn layui-btn-danger layui-btn-xs">
        删除
    </a>
</script>