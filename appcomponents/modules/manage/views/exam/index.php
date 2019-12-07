<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */
?>
<style>
    .layui-table-cell{
        height:auto;
        overflow:visible;
        text-overflow:inherit;
        white-space:normal;
    }
</style>
<div class="layui-card">
    <div class="layui-header notselect">
        <div class="pull-left"><span><?= Html::encode($title ? $title : (isset($this->title) ? $this->title : null)) ?></span></div>
        <div class="pull-right margin-right-15 nowrap">
            <?php
            if(isset($menuUrl) && !empty($menuUrl) && in_array(trim(Url::to(['manage/exam/edit']),"/"), $menuUrl)) {
                ?>
                <button data-open='<?=Url::to(['manage/exam/edit']);?>' class='layui-btn layui-btn-sm layui-btn-primary'>添加考卷</button>
            <?php
            }
            ?>
            <?php
            if(isset($menuUrl) && !empty($menuUrl) && in_array(trim(Url::to(['manage/course/del']),"/"), $menuUrl)) {
                ?>
                <button data-update data-field='delete' data-action='<?=Url::to(['manage/course/del']);?>'  class='layui-btn layui-btn-sm layui-btn-primary'>删除</button>
            <?php
            }
            ?>
        </div>
    </div>
    <div class="layui-card-body">
        <!-- 表单搜索 开始 -->
        <form autocomplete="off" onsubmit="return false;" data-auto="true" method="post">
            <input type="hidden" value="resort" name="action">
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
            url:"<?= Url::to(['common/exam/get-list']); ?>",
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
                            {checkbox: true, fixed: true, width: 30}
                            ,{field:'id', title: 'ID', width: 30}
                            ,{field:'title', title: '题库名称', minWidth: 100}
                            ,{field:'score', title: '总分', minWidth: 100}
                            ,{field:'passscore', title: '及格分数', minWidth: 100}
                            ,{field:'decide', title: '评卷方式', minWidth: 100, toolbar:"#Jdecide"}
                            ,{field:'status', title: '状态', width: 80, toolbar:"#Jstatus"}//,toolbar:"#Jstatus"
                            ,{field:'start_time', title: '考题开始时间',"type":"text",width:130, toolbar:"#JstartTime"}
                            ,{field:'overdue_time', title: '考题截止时间',"type":"text","width":130, toolbar:"#JoverdueTime"}
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
                url: "<?= Url::to(['common/exam/set-status']); ?>",
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
        element.render();
    });
</script>

<script type="text/html" id="Jstatus">
    {{#  if(d.status ==0){ }}
    结束开始
    {{# }if(d.status ==1) { }}
    开始考试
    {{# }if(d.status ==2) { }}
    终止考试
    {{#  } }}
</script>
<script type="text/html" id="Jdecide">
    {{#  if(d.decide ==0){ }}
    系统自评
    {{# }if(d.decide ==1) { }}
    党组织评卷
    {{# }if(d.status ==2) { }}
    其他
    {{#  } }}
</script>
<script type="text/html" id="JstartTime">
    {{#  if(d.start_time ==null){ }}
    长期
    {{# }if(d.start_time !=null) { }}
    {{d.start_time }}
    {{#  } }}
</script>
<script type="text/html" id="JoverdueTime">
    {{#  if(d.overdue_time ==null){ }}
    长期
    {{# }if(d.overdue_time !=null) { }}
    {{d.overdue_time }}
    {{#  } }}
</script>

<script type="text/html" id="barDemo">
    <a class="layui-btn layui-btn-normal layui-btn-xs" data-open="<?=Url::to(['manage/exam/edit']);?>?id={{d.id }}">
        修改
    </a>
    <a class="layui-btn layui-btn-danger layui-btn-xs">
        删除
    </a>
</script>