<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */

?>
<div class="layui-card">
    <div class="layui-header notselect">
        <div class="pull-left"><span><?= Html::encode($title ? $title : (isset($this->title) ? $this->title : null)) ?></span></div>
        <div class="pull-right margin-right-15 nowrap">
            <?php
            if(isset($menuUrl) && !empty($menuUrl) && in_array(trim(Url::to(['/manage/concern-group/add']),"/"), $menuUrl)) {
            ?>
                <button data-modal='<?=Url::to(['/manage/concern-group/edit']);?>' class='layui-btn layui-btn-sm layui-btn-primary'>添加分组</button>
            <?php
            }
            ?>
        </div>
    </div>
    <div class="layui-card-body">
        <form autocomplete="off" onsubmit="return false;" data-auto="true" method="post">
            <input type="hidden" value="resort" name="action">
            <table class="layui-hide" id="dataList"></table>
        </form>
        <div id="page"></div>
    </div>
</div>
<script type="application/javascript">
layui.use(['form', 'table', 'laypage', 'layer'], function(){
    var laypage = layui.laypage
        ,form = layui.form;
    var storage=window.localStorage;
    var table = layui.table;
    var userData = storage.getItem("userData");
    var headerParams = JSON.parse(userData);
    //监听提交
    var params = {};
    var selfUrl = window.location.href;
    var page = GetUrlParam("p") ? GetUrlParam("p") : 1;
    var size = GetUrlParam("size") ? GetUrlParam("size") : 10;
    var name = GetUrlParam("name") ? GetUrlParam("name") : "";
    params.p=page;
    params.size = size;
    params.count = 0;
    params.name = name;
    form.on('submit(commit)', function(data){
        var paramsStr = "";
        $.each(data.field, function(i, item){
            selfUrl = changeURLArg(selfUrl,i,item);
//            paramsStr+="&"+i+"="+item;
        });
        selfUrl = changeURLArg(selfUrl,"p",1);
//        selfUrl+=paramsStr;
        location.href = selfUrl;
    });
    $.ajax({
        type: "post",
        url:"<?= Url::to(['common/concern-group/get-list']); ?>",
        contentType: "application/json;charset=utf-8",
        data :JSON.stringify(params),
        dataType: "json",
        beforeSend: function (XMLHttpRequest) {
            for(var i in headerParams) {
                XMLHttpRequest.setRequestHeader(i, headerParams[i]);
            }
        },
        success:function(result){
            console.log(result);
            params.count = result.data.count;
            if(result.code == 0) {
                table.render({
                    elem: '#dataList'
                    ,id:"dataList"
                    ,data:result.data.dataList
                    ,cellMinWidth: 80 //全局定义常规单元格的最小宽度，layui 2.2.1 新增
                    ,cols: [[
                        {checkbox: true, fixed: true, width: 30}
                        ,{field:'id', title: 'ID'}
                        ,{field:'name', title: '分组名称'}
                        ,{field:'create_time', title: '创建时间'}
                        ,{field:'update_time', title: '更新时间'}
                        ,{field:'right', title: '操作', minWidth: 100, width:'15%',toolbar:"#barDemo"}
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
});
</script>
<script type="text/html" id="barDemo">
    <?php
    if(isset($menuUrl) && !empty($menuUrl) && in_array(trim(Url::to(['manage/concern-group/edit']),"/"), $menuUrl)) {
        ?>
        <a class="layui-btn layui-btn-radius layui-btn-sm layui-btn-mini" data-modal="<?=Url::to(['manage/concern-group/edit']);?>?id={{d.id}}" data-title="关注分组详情数据编辑">编辑</a>
    <?php
    }
    ?>
    <?php
    if(isset($menuUrl) && !empty($menuUrl) && in_array(trim(Url::to(['manage/concern-group/del']),"/"), $menuUrl)) {
        ?>
        <a class='layui-btn layui-btn-sm layui-btn-primary' data-action='<?=Url::to(['manage/concern-group/del']);?>?id={{d.id}}'>删除分组</a>
    <?php
    }
    ?>
</script>