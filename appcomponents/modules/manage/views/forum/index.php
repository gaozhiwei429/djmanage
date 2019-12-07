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
            if(isset($menuUrl) && !empty($menuUrl) && in_array(trim(Url::to(['manage/forum/add']),"/"), $menuUrl)) {
                ?>
                <button data-open='<?=Url::to(['manage/forum/edit']);?>' class='layui-btn layui-btn-sm layui-btn-primary'>发表话题</button>
            <?php
            }
            ?>
            <?php
            if(isset($menuUrl) && !empty($menuUrl) && in_array(trim(Url::to(['manage/forum/del']),"/"), $menuUrl)) {
                ?>
                <button data-update data-field='delete' data-action='<?=Url::to(['manage/forum/del']);?>'  class='layui-btn layui-btn-sm layui-btn-primary'>删除</button>
            <?php
            }
            ?>
        </div>
    </div>
    <div class="layui-card-body">
        <!-- 表单搜索 开始 -->
        <form autocomplete="off" onsubmit="return false;" data-auto="true" method="post">
            <input type="hidden" value="resort" name="action">
            <table class="layui-hide" id="dataList"></table>
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
        params.parent_type_id = 1;
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
            url:"<?= Url::to(['common/forum/get-list']); ?>",
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
                            ,{field:'id', title: 'ID', width: 60}
                            ,{field:'title', title: '话题', minWidth: 120}
                            ,{field:'pic_url', title: '图片', minWidth: 180, height: 100,toolbar:"#Jimg"}
                            ,{field:'full_name', title: '姓名', width: 100}
                            ,{field:'fabulous_num', title: '点赞数', width: 80}
                            ,{field:'collection_num', title: '收藏数', width: 80}
                            ,{field:'comment_num', title: '评论数', width: 80}
                            ,{field:'type', title: '所属类型', minWidth: 80,toolbar:"#Jtype"}
                            ,{field:'is_anonymous', title: '是否匿名', minWidth: 60,toolbar:"#JAnonymous"}
                            ,{field:'status', title: '状态',toolbar:"#Jstatus", width: 100}
                            ,{field:'is_hot', title: '推荐',toolbar:"#Jis_hot", width: 100}
                            ,{field:'create_time', title: '创建时间', minWidth: 140}
                            ,{field:'right', title: '操作', minWidth: 160,toolbar:"#barDemo"}
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
            var status = obj.elem.checked ? 2 : 0;
            var id = obj.elem.value;
            if(id) {
                params.id=id;
            }
            params.status=status;
            $.ajax({
                type: "post",
                url: "<?= Url::to(['common/forum/set-status']); ?>",
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
                url: "<?= Url::to(['common/forum/set-is-hot']); ?>",
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
<input type="checkbox" name="status" lay-skin="switch" lay-text="禁用|审批" lay-filter="status" data-id="{{d.id}}" data-status="{{d.status}}" value="{{d.id}}"/>
    {{# }else if(d.status ==1) { }}
<input type="checkbox" name="status" lay-skin="switch" lay-text="审批|禁用" lay-filter="status" data-id="{{d.id}}" data-status="{{d.status}}" value="{{d.id}}" />
    {{# }else if(d.status ==2) { }}
<input type="checkbox" name="status" lay-skin="switch" lay-text="审批|禁用" lay-filter="status" data-id="{{d.id}}" data-status="{{d.status}}" value="{{d.id}}" checked />
    {{#  }else{ }}
    未知
    {{#  } }}
</script>


<script type="text/html" id="Jis_hot">
    {{#  if(d.is_hot ==0){ }}
    <input type="checkbox" name="is_hot" lay-skin="switch" lay-text="推荐|不推荐" lay-filter="is_hot" data-id="{{d.id}}" data-status="{{d.is_hot}}" value="{{d.id}}"/>
    {{# }if(d.is_hot ==1) { }}
    <input type="checkbox" name="is_hot" lay-skin="switch" lay-text="推荐|不推荐" lay-filter="is_hot" data-id="{{d.id}}" data-status="{{d.is_hot}}" value="{{d.id}}" checked />
    {{#  } }}
</script>
<script type="text/html" id="Jtype">
    {{#  if(d.type ==1){ }}
    国际形势
    {{# }else if(d.type ==2) { }}
    国内党政
    {{# }else if(d.type ==3) { }}
    公司论坛
    {{#  }else{ }}
    全部
    {{#  } }}
</script>
<script type="text/html" id="JAnonymous">
    {{#  if(d.type ==0){ }}
    匿名
    {{# }else if(d.type ==1) { }}
    非匿名
    {{#  }else{ }}
    全部
    {{#  } }}
</script>
<script type="text/html" id="Jimg">
    {{#  if(d.pic_url!=""){ }}
    {{#  d.pic_url.forEach((item,index,array)=>{ }}
    <img src="{{item}}" style="width: 60px;">
    {{#  }) }}
    {{# }else{ }}
    暂无
    {{#  } }}
</script>
<script type="text/html" id="barDemo">
    <?php
    if(isset($menuUrl) && !empty($menuUrl) && in_array(trim(Url::to(['manage/forum/info']),"/"), $menuUrl)) {
        ?>
        <a class="layui-btn layui-btn-radius layui-btn-sm layui-btn-mini" lay-event="edit" data-open="<?=Url::to(['manage/forum/info']);?>?id={{d.id}}">查看</a>
    <?php
    }
    ?>
    <?php
    if(isset($menuUrl) && !empty($menuUrl) && in_array(trim(Url::to(['manage/forum/add']),"/"), $menuUrl)) {
        ?>
        <a class="layui-btn layui-btn-radius layui-btn-sm layui-btn-danger" lay-event="edit" data-open="<?=Url::to(['manage/forum/edit']);?>?id={{d.id}}">编辑</a>
    <?php
    }
    ?>
</script>