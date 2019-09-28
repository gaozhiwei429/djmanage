<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="layui-card">
<?php
if(isset($title) && !empty($title)) {
    ?>
    <div class="layui-header notselect">
        <div class="pull-left"><span><?= Html::encode($title ? $title : (isset($this->title) ? $this->title : null)) ?></span></div>
        <div class="pull-right margin-right-15 nowrap">
            <?php
            if(isset($menuUrl) && !empty($menuUrl) && in_array(Url::to(['/role/add']), $menuUrl)) {
                ?>
                <button data-modal='<?= Url::to(['/role/add']); ?>' data-title="添加角色" class='layui-btn layui-btn-sm layui-btn-primary'>添加角色</button>
            <?php
            }
            ?>
            <?php
            if(isset($menuUrl) && !empty($menuUrl) && in_array(Url::to(['/role/del']), $menuUrl)) {
            ?>
                <button data-update data-field='delete' data-action='<?= Url::to(['/role/del']); ?>' class='layui-btn layui-btn-sm layui-btn-primary'>删除角色</button>
            <?php
            }
            ?>
        </div>
    </div>
<?php
}
?>
<!--{/notempty}-->
    <div class="layui-card-body">
        <form autocomplete="off" onsubmit="return false;" data-auto="true" method="post">
            <input type="hidden" value="resort" name="action">
            <table class="layui-hide" id="dataList"></table>
        </form>
        <div id="page"></div>
    </div>
</div>
<script type="application/javascript">
layui.use(['table', 'laypage', 'layer'], function(){
    var storage=window.localStorage;
    var table = layui.table;
    var userData = storage.getItem("userData");
    var headerParams = JSON.parse(userData);
    var params = [];
    params.p=1;
    params.size = 10;
    params.count = 0;
    $.ajax({
        type: "post",
        url:"<?= Url::to(['manage/role/get-list']); ?>",
        contentType: "application/json;charset=utf-8",
        data :params,
        dataType: "json",
        beforeSend: function (XMLHttpRequest) {
            for(var i in headerParams) {
                XMLHttpRequest.setRequestHeader(i, headerParams[i]);
            }
        },
        success:function(result){
            if(result.code == 0) {
                params.count = result.data.count;
                table.render({
                    elem: '#dataList'
                    ,id:"dataList"
                    ,data:result.data.dataList
                    ,cellMinWidth: 80 //全局定义常规单元格的最小宽度，layui 2.2.1 新增
                    ,cols: [[
                        {checkbox: true, fixed: true}
                        ,{field:'id', title: 'ID'}
                        ,{field:'role_name', title: '角色名称'}
                        ,{field:'desc', title: '描述'}
                        ,{field:'status', title: '状态',toolbar:"#Jstatus"}// ,templet:function(d){return d.status ==1 ? "启用" : "禁用";}
                        ,{field:'create_time', title: '添加时间', minWidth: 100} //minWidth：局部定义当前单元格的最小宽度，layui 2.2.1 新增
//                        ,{width: '20%', title: '操作'}
                        ,{field:'right', title: '操作', minWidth: 100, width:'15%',toolbar:"#barDemo"}
                    ]]
                    ,done: function(res, curr, count){
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
                layer.msg('同上', {
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

    var laypage = layui.laypage
        ,layer = layui.layer;
    //自定义样式
    laypage.render({
        elem: 'page'
        ,count: params.count
        ,theme: '#1E9FFF'
    });
});
</script>
<script type="text/html" id="barDemo">
    <?php
    if(isset($menuUrl) && !empty($menuUrl) && in_array(trim(Url::to(['admin/role/forbid']),"/"), $menuUrl)) {
    ?>
    <a class="layui-btn layui-btn-radius layui-btn-sm layui-btn-normal" lay-event="detail" data-update="{{d.id}}" data-action="<?=Url::to(['/role/forbid']);?>?id={{d.id}}">禁用</a>
    <?php
    }
    ?>
    <?php
    if(isset($menuUrl) && !empty($menuUrl) && in_array(trim(Url::to(['admin/role/resume']),"/"), $menuUrl)) {
        ?>
        <a class="layui-btn layui-btn-radius layui-btn-sm layui-btn-warm" lay-event="detail" data-update="{{d.id}}" data-action="<?=Url::to(['/role/resume']);?>?id={{d.id}}">启用</a>
    <?php
    }
    ?>
    <?php
    if(isset($menuUrl) && !empty($menuUrl) && in_array(trim(Url::to(['admin/role/apply']),"/"), $menuUrl)) {
        ?>
        <a class="layui-btn layui-btn-radius layui-btn-sm layui-btn-danger" data-open="<?=Url::to(['/role/apply']);?>?id={{d.id}}" lay-event="apply">授权</a>
    <?php
    }
    ?>
    <a class="layui-btn layui-btn-radius layui-btn-sm layui-btn-normal" lay-event="edit">授权</a>
    <a class="layui-btn layui-btn-radius layui-btn-sm layui-btn-mini" lay-event="edit">编辑</a>
    <a class="layui-btn layui-btn-radius layui-btn-sm layui-btn-danger" lay-event="del">删除</a>
</script>
<script type="text/html" id="Jstatus">
    {{#  if(d.status ==0){ }}
    未知
    {{# }if(d.status ==2) { }}
    禁用
    {{# }if(d.status ==1) { }}
    启用
    {{#  } }}
</script>