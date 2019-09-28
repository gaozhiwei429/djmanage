<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */

?>

<style type="text/css">

.layui-table-cell{
    height:40px;
    line-height: 40px;
}
</style>
<div class="layui-card">
    <div class="layui-header notselect">
        <div class="pull-left"><span><?= Html::encode($title ? $title : (isset($this->title) ? $this->title : null)) ?></span></div>
        <div class="pull-right margin-right-15 nowrap">
            <?php
            if(isset($menuUrl) && !empty($menuUrl) && in_array(trim(Url::to(['store/goods/add']),"/"), $menuUrl)) {
                ?>
                <button data-open='<?=Url::to(['goods/edit']);?>' class='layui-btn layui-btn-sm layui-btn-primary'>添加产品</button>
            <?php
            }
            ?>
            <?php
            if(isset($menuUrl) && !empty($menuUrl) && in_array(trim(Url::to(['store/goods/del']),"/"), $menuUrl)) {
                ?>
                <button data-update data-field='delete' data-action='<?=Url::to(['store/goods/del']);?>'  class='layui-btn layui-btn-sm layui-btn-primary'>删除产品</button>
            <?php
            }
            ?>
        </div>
    </div>
    <div class="layui-card-body">
        <!-- 表单搜索 开始 -->
        <form autocomplete="off" class="layui-form" onsubmit="return false;" data-auto="true" method="get">
            <div class="layui-form-item layui-inline">
                <label class="layui-form-label">产品名称</label>
                <div class="layui-input-inline">
                    <input name="name" value="<?=$name ? $name : "";?>" placeholder="请输入产品名称" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item layui-inline">
                <button class="layui-btn layui-btn-primary" lay-submit="" lay-filter="commit"><i class="layui-icon">&#xe615;</i> 搜 索</button>
            </div>
        </form>
        <!-- 表单搜索 结束 -->
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
//        selfUrl+=paramsStr;
        selfUrl = changeURLArg(selfUrl,"p",1);
        location.href = selfUrl;
    });
    $.ajax({
        type: "post",
        url:"<?= Url::to(['project/project/get-list']); ?>",
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
//                    ,cellMinHeight: 80
                    ,cols: [[
                        {checkbox: true, fixed: true, width: 30}
                        ,{field:'id', title: 'ID', width: 30}
                        ,{field:'name', title: '产品名称', minWidth: 100}
                        ,{field:'cover_url', title: '封面图片', width: 160, height: 100,toolbar:"#Jimg"}
                        ,{field:'status', title: '状态', toolbar:"#Jstatus", unresize: true}//,toolbar:"#Jstatus"
                        ,{field:'stock_num', title: '库存数量'}
                        ,{field:'create_time', title: '创建时间'}
                        ,{field:'price', title: '原价'}
                        ,{field:'now_price', title: '现价'}
                        ,{field:'is_hot', title: '热门推荐',toolbar:"#Jhot"}
                        ,{field:'collection_num', title: '收藏数'}
                        ,{field:'download_num', title: '下载数'}
                        ,{field:'buy_num', title: '购买数'}
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
            url: "<?= Url::to(['project/project/set-status']); ?>",
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
                    layer.alert("更新成功", {icon: 1}, function(index){
                        return false;
                    });
//                    layer.tips("更新成功");
                    return true;
                } else {
                    layer.alert(result.msg, {icon: 2}, function(index){
                        return false;
                    });
                    return false;
                }
            },
            error: function () {
                layer.alert("更新数据异常", {icon: 2}, function(index){
                    return false;
                });
                return false;
            }
        })
    });
    //监听状态的操作
    form.on('switch(is_hot)', function(obj){
        var params = {};
        var is_hot = obj.elem.checked ? 1 : 0;
        var id = obj.elem.value;
        if(id) {
            params.id=id;
        }
        params.is_hot=is_hot;
        $.ajax({
            type: "post",
            url: "<?= Url::to(['project/project/set-is-hot']); ?>",
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
                    layer.alert("更新成功", {icon: 1}, function(index){
                        return false;
                    });
//                    layer.tips("更新成功");
                    return true;
                } else {
                    layer.alert(result.msg, {icon: 2}, function(index){
                        return false;
                    });
//                    layer.tips(result.msg);
                    return false;
                }
            },
            error: function () {
                layer.alert("更新数据异常", {icon: 2}, function(index){
                    return false;
                });
//                layer.tips("更新数据异常");
                return false;
            }
        })
    });
});
</script>
<script type="text/html" id="Jstatus">
    {{#  if(d.status ==0){ }}
    <input type="checkbox" name="status" lay-skin="switch" lay-text="上线|下线" lay-filter="status" data-id="{{d.id}}" data-status="{{d.status}}" value="{{d.id}}"  category-status="{{d.status}}"/>
    {{# }if(d.status ==1) { }}
    <input type="checkbox" name="status" lay-skin="switch" lay-text="上线|下线" lay-filter="status" data-id="{{d.id}}" data-status="{{d.status}}" value="{{d.id}}"  category-status="{{d.status}}" checked />
    {{#  } }}
</script>
<script type="text/html" id="Jhot">
    {{#  if(d.is_hot ==0){ }}
    <input type="checkbox" name="is_hot" lay-skin="switch" lay-text="是|否" lay-filter="is_hot" data-id="{{d.id}}" data-status="{{d.is_hot}}" value="{{d.id}}"  category-status="{{d.is_hot}}" />
    {{# }if(d.is_hot ==1) { }}
    <input type="checkbox" name="is_hot" lay-skin="switch" lay-text="是|否" lay-filter="is_hot" data-id="{{d.id}}" data-status="{{d.is_hot}}" value="{{d.id}}"  category-status="{{d.is_hot}}" checked />
    {{#  } }}
</script>
<script type="text/html" id="Jimg">
    {{#  if(d.cover_url!=""){ }}
    <div class="layui-inline">
        <img src="{{d.cover_url}}" class="layui-circle">
    </div>
    {{# }else{ }}
    暂无
    {{#  } }}
</script>
<script type="text/html" id="barDemo">

    <?php
    if(isset($menuUrl) && !empty($menuUrl) && in_array(trim(Url::to(['store/goods/info']),"/"), $menuUrl)) {
    ?>
    <a class="layui-btn layui-btn-radius layui-btn-sm layui-btn-mini" data-modal="<?=Url::to(['/goods/info']);?>?id={{d.id}}">查看</a>
    <?php
    }
    ?>
    <?php
    if(isset($menuUrl) && !empty($menuUrl) && in_array(trim(Url::to(['store/goods/edit']),"/"), $menuUrl)) {
    ?>
    <a class="layui-btn layui-btn-radius layui-btn-sm layui-btn-mini" data-open="<?=Url::to(['/goods/edit']);?>?id={{d.id}}">编辑</a>
    <?php
    }
    ?>
    <a class="layui-btn layui-btn-radius layui-btn-sm layui-btn-danger" data-modal="<?=Url::to(['/goods/edit']);?>?id={{d.id}}">禁用</a>
</script>