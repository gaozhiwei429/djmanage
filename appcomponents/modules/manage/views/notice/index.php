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
            if(isset($menuUrl) && !empty($menuUrl) && in_array(trim(Url::to(['manage/notice/add']),"/"), $menuUrl)) {
                ?>
                <button data-open='<?=Url::to(['manage/notice/edit']);?>' class='layui-btn layui-btn-sm layui-btn-primary'>添加</button>
            <?php
            }
            ?>
            <?php
            if(isset($menuUrl) && !empty($menuUrl) && in_array(trim(Url::to(['manage/notice/del']),"/"), $menuUrl)) {
                ?>
                <button data-update data-field='delete' data-action='<?=Url::to(['manage/notice/del']);?>'  class='layui-btn layui-btn-sm layui-btn-primary'>删除</button>
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
            url:"<?= Url::to(['common/notice/get-list']); ?>",
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
                            ,{field:'title', title: '名称', minWidth: 120}
                            ,{field:'pic_url', title: '封面图片', minWidth: 100, height: 100,toolbar:"#Jimg"}
                            ,{field:'sort', title: '排序', width: 40}
                            ,{field:'status', title: '状态',toolbar:"#Jstatus", width: 60}
                            ,{field:'create_time', title: '创建时间', minWidth: 120}
                            ,{field:'type', title: '所属类型', minWidth: 120,toolbar:"#Jtype"}
                            ,{field:'right', title: '操作', minWidth: 180,toolbar:"#barDemo"}
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
                    return false;
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
<script type="text/html" id="Jstatus">
    {{#  if(d.status ==0){ }}
    下线
    {{# }if(d.status ==1) { }}
    上线
    {{#  }else{ }}
    未知
    {{#  } }}
</script>
<script type="text/html" id="Jtype">
    {{#  if(d.type ==1){ }}
    重要通知
    {{# }else if(d.type ==2) { }}
    紧急通知
    {{#  }else{ }}
    全部
    {{#  } }}
</script>
<script type="text/html" id="Jimg">
    {{#  if(d.pic_url!=""){ }}
    {{#  d.pic_url.forEach((item,index,array)=>{ }}
    <img src="{{item}}">
    {{#  }) }}
    {{# }else{ }}
    暂无
    {{#  } }}
</script>
<script type="text/html" id="barDemo">
    <?php
    if(isset($menuUrl) && !empty($menuUrl) && in_array(trim(Url::to(['manage/notice/info']),"/"), $menuUrl)) {
        ?>
        <a class="layui-btn layui-btn-radius layui-btn-sm layui-btn-mini" lay-event="edit" data-open="<?=Url::to(['manage/notice/info']);?>?id={{d.id}}">查看</a>
    <?php
    }
    ?>
    <?php
    if(isset($menuUrl) && !empty($menuUrl) && in_array(trim(Url::to(['manage/notice/edit']),"/"), $menuUrl)) {
        ?>
        <a class="layui-btn layui-btn-radius layui-btn-sm layui-btn-danger" lay-event="edit" data-open="<?=Url::to(['manage/notice/edit']);?>?id={{d.id}}">编辑</a>
    <?php
    }
    ?>
</script>