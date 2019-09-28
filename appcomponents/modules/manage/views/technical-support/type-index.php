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
            if(isset($menuUrl) && !empty($menuUrl) && in_array(trim(Url::to(['manage/technical-support/edit-type']),"/"), $menuUrl)) {
                ?>
                <button data-modal='<?=Url::to(['manage/technical-support/edit-type']);?>' class='layui-btn layui-btn-sm layui-btn-primary'>添加技术支持分类</button>
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
    params.p=page;
    params.size = size;
    params.count = 0;
    $.ajax({
        type: "post",
        url:"<?= Url::to(['/common/technical-support-type/get-types']); ?>",
        contentType: "application/json;charset=utf-8",
        data :JSON.stringify(params),
        dataType: "json",
        beforeSend: function (XMLHttpRequest) {
            for(var i in headerParams) {
                XMLHttpRequest.setRequestHeader(i, headerParams[i]);
            }
        },
        success:function(result){
            form.render();
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
                        ,{field:'name', title: '分类名称'}
                        ,{field:'status', title: '状态', toolbar:"#Jstatus"}
                        ,{field:'create_time', title: '创建时间'}
                        ,{field:'sort', title: '排序'}
                        ,{field:'right', title: '操作', minWidth: 100,toolbar:"#barDemo"}
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
    //监听锁定操作
    form.on('checkbox(status)', function(obj){
        var status = obj.elem.checked===true ? 1 : 0;
        var id = $(this).data('id');
        params.status = status;
//        layer.tips(this.value + ' ' + this.name + '：'+ obj.elem.checked, obj.othis);
        if(status>0) {
            layer.open({
                type: 1
                ,skin: 'layui-layer-demo' //样式类名
                ,closeBtn: 0 //不显示关闭按钮
//            ,anim: 2
                ,shadeClose: true //开启遮罩关闭
                ,resize: true
                ,content: [].join('')
                ,success: function(layero){
                    form.render();
                    layero.find('.layui-layer-content').css('overflow', 'visible');
                    form.on('submit(concern)', function(data){
//                    layer.msg(JSON.stringify(data.field));
                        $.ajax({
                            type: "post",
                            url:"<?= Url::to(['/common/technical-support-type/edit']); ?>",
                            contentType: "application/json;charset=utf-8",
                            data :JSON.stringify(data.field),
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
                                        time: 1000 //2秒关闭（如果不配置，默认是3秒）
                                    }, function(){
                                        layer.closeAll();
                                        parent.location.href = selfUrl;
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
                }
            });
        } else {
            $.ajax({
                type: "post",
                url:"<?= Url::to(['/common/technical-support-type/edit']); ?>",
                contentType: "application/json;charset=utf-8",
                data :JSON.stringify(params),
                dataType: "json",
                beforeSend: function (XMLHttpRequest) {
                    for(var i in headerParams) {
                        XMLHttpRequest.setRequestHeader(i, headerParams[i]);
                    }
                },
                success:function(result){
                    form.render();
                    if(result.code == 0) {
                        layer.msg(result.msg, {
                            icon: 1,
                            time: 1000 //2秒关闭（如果不配置，默认是3秒）
                        }, function(){
                            layer.closeAll();
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
                        elem: '#dataList',
                        id: "dataList",
                        limit: 0,
                        height: tableHeight,
                        size: 'sm',
                        data:[]
                    })
                }
            });
        }
    });
});
</script>
<script type="text/html" id="Jstatus">
    {{#  if(d.status !== undefined && d.status == "1"){ }}
    有效
    {{# }else if(d.status !== undefined && d.status == "2") { }}
    屏蔽
    {{# }else if(d.status === undefined && d.status == "0") { }}
    无效
    {{# }else{ }}
    无效
    {{#  } }}
</script>
<script type="text/html" id="barDemo">
<?php
if(isset($menuUrl) && !empty($menuUrl) && in_array(trim(Url::to(['manage/technical-support/type-info']),"/"), $menuUrl)) {
?>
    <a class="layui-btn layui-btn-radius layui-btn-sm layui-btn-mini" data-modal="<?=Url::to(['manage/technical-support/type-info']);?>?id={{d.id}}" data-title="技术支持分类详情">查看</a>
<?php
}
?>
<?php
if(isset($menuUrl) && !empty($menuUrl) && in_array(trim(Url::to(['manage/technical-support/edit-type']),"/"), $menuUrl)) {
?>
    <a class="layui-btn layui-btn-radius layui-btn-sm layui-btn-mini" data-modal="<?=Url::to(['manage/technical-support/edit-type']);?>?id={{d.id}}" data-title="编辑技术支持分类详情">查看</a>
<?php
}
?>
</script>