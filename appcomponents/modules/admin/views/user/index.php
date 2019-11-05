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
            if(isset($menuUrl) && !empty($menuUrl) && in_array(trim(Url::to(['admin/user/add']),"/"), $menuUrl)) {
            ?>
<!--            <button data-action='--><?//=Url::to(['admin/user/add']);?><!--' class='layui-btn layui-btn-sm layui-btn-primary'>添加用户</button>-->
            <?php
            }
            ?>
            <?php
            if(isset($menuUrl) && !empty($menuUrl) && in_array(trim(Url::to(['admin/user/del']),"/"), $menuUrl)) {
                ?>
                <button data-update data-field='delete' data-action='<?=Url::to(['admin/user/del']);?>'  class='layui-btn layui-btn-sm layui-btn-primary'>删除用户</button>
            <?php
            }
            ?>
        </div>
    </div>
    <div class="layui-card-body">
        <!-- 表单搜索 开始 -->
        <form autocomplete="off" class="layui-form" onsubmit="return false;" data-auto="true" method="get">
            <div class="layui-form-item layui-inline">
                <label class="layui-form-label">用户名</label>
                <div class="layui-input-inline">
                    <input name="username" value="<?=$username ? $username : "";?>" placeholder="请输入注册手机号" class="layui-input">
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
    var username = GetUrlParam("username") ? GetUrlParam("username") : "";
    var j = {};
    params.p=page;
    params.size = size;
    params.count = 0;
    params.username = username;
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
        url:"<?= Url::to(['passport/user/get-list']); ?>",
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
                        ,{field:'id', title: 'ID'}
                        ,{field:'username', title: '用户名'}
                        ,{field:'source', title: '来源',toolbar:"#Jsource"}
                        ,{field:'sex', title: '性别',toolbar:"#Jsex"}
                        ,{field:'status', title: '状态',toolbar:"#Jstatus"}
                        ,{field:'create_time', title: '注册时间'}
                        ,{field:'email', title: '绑定邮箱'}
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
});
</script>
<script type="text/html" id="Jstatus">
    {{#  if(d.status ==0){ }}
    已屏蔽
    {{# }if(d.status ==1) { }}
    有效
    {{#  } }}
</script>
<script type="text/html" id="Jsource">
    {{#  if(d.source ==0){ }}
    PC
    {{# }if(d.source ==1) { }}
    Android
    {{# }if(d.source ==2) { }}
    Ios
    {{# }if(d.source ==3) { }}
    H5
    {{#  } }}
</script>
<script type="text/html" id="Jsex">
    {{#  if(d.sex ==1){ }}
    男
    {{# }if(d.status ==2) { }}
    女
    {{# }if(d.status ==0) { }}
    未知
    {{#  } }}
</script>
<script type="text/html" id="barDemo">

<?php
if(isset($menuUrl) && !empty($menuUrl) && in_array(trim(Url::to(['admin/user/info']),"/"), $menuUrl)) {
?>
<a class="layui-btn layui-btn-radius layui-btn-sm layui-btn-mini" data-modal="<?=Url::to(['admin/user/info']);?>?id={{d.id}}" data-title="账户详情">查看</a>
<?php
}
?>
</script>