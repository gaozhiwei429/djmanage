<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */
?>
<?=Html::cssFile('@web/static/plugs/layui/css/main.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
<?=Html::cssFile('@web/static/plugs/layui/css/form.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
<?=Html::cssFile('@web/static/plugs/layui/css/layer.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
<?=Html::cssFile('@web/static/plugs/layui/css/modules/laydate/default/laydate.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
<?=Html::cssFile('@web/static/plugs/layui/css/layui.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
<?=Html::cssFile('@web/static/theme/css/console.css?v='.date("ymd"), ['rel' => "stylesheet"])?>

<script>window.ROOT_URL = '__ROOT__';</script>
<?=Html::jsFile('@web/static/plugs/jquery/pace.min.js?v='.date("ymd"), ['type' => "text/javascript"])?>
<?=Html::jsFile('@web/static/plugs/layui/layui.all.js?v='.date("ymd"), ['type' => "text/javascript"])?>
<?=Html::jsFile('@web/static/admin.js?v='.date("ymd"), ['type' => "text/javascript"])?>
<?=Html::jsFile('@web/static/js/jquery.cookie.js?v='.date("ymd"), ['type' => "text/javascript"])?>
<div class="layui-card">
    <div class="layui-card-body">
        <!-- 表单搜索 开始 -->
        <form autocomplete="off" onsubmit="return false;" data-auto="true" method="post">
            <input type="hidden" value="resort" name="action">
            <input type="hidden" value="" name="ids" id="JtableIds">
            <input type="hidden" value="" name="peoples" id="Jpeoples">
            <input type="hidden" value="" name="organizations" id="JorganizationIds">
            <table class="layui-hide" id="dataList" lay-filter="text"></table>
        </form>
        <div id="page"></div>
        <!-- 表单搜索 结束 -->
    </div>
</div>
<script type="application/javascript">
    layui.use(['form', 'table', 'laypage', 'layer', 'element', 'jquery', 'laydate'], function(){
        var laypage = layui.laypage
            ,form = layui.form;
        var element = layui.element;
        var storage=window.localStorage;
        var table = layui.table
            ,jq = layui.jquery
            ,$ = layui.jquery
            ,layer = layui.layer;
        $.cookie('dangyuanIds', "<?=isset($userIds) ? $userIds : ""?>");
        $.cookie('dangyuanNames', "<?=isset($full_name_list) ? $full_name_list : ""?>");
        var type = "<?=isset($type) ? $type : 0?>";
        var params = {};
        var page = GetUrlParam("p") ? GetUrlParam("p") : 1;
        var size = GetUrlParam("size") ? GetUrlParam("size") : 10;
        var title = GetUrlParam("title") ? GetUrlParam("title") : "";
        params.p=page;
        params.size = size;
        params.count = 0;
        params.title = title;
        params.type = type;
        var userData = storage.getItem("userData");
        var headerParams = JSON.parse(userData);
        //监听提交
        var selfUrl = window.location.href;
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
            url:"<?=Url::to(['common/dangyuan/get-list']);?>?organization_id=<?=isset($organization_id) ? $organization_id : 0;?>",
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
                    });
                    params.count =result.data.count;
                    table.render({
                        elem: '#dataList'
                        ,id:"dataList"
                        ,data:result.data.dataList
                        , limit: size//显示的数量
                        ,cellMinWidth: 80 //全局定义常规单元格的最小宽度，layui 2.2.1 新增
//                    ,cellMinHeight: 80
                        ,cols: [[
                            {checkbox: true, fixed: true, width: 30}
                            ,{field:'id', title: 'ID', width: 30}
                            ,{field:'full_name', title: '用户姓名', minWidth: 100}
                            ,{field:'level_title', title: '职务', minWidth: 100}
                            ,{field:'organization_title', title: '党组织', minWidth: 200}
                            ,{field:'username', title: '手机号', minWidth: 100}
                        ]]
                        ,done: function(res, curr, count){
                            var checkboxArr = $.cookie('dangyuanIds').split(',');
                            if(checkboxArr.length!=0) {
                                $.each(res.data, function(i, item){
                                    $.each(checkboxArr,function(j,val){
                                        if(item.user_id==val) {
                                            var index= res.data[i]['LAY_TABLE_INDEX'];
                                            $('tr[data-index=' + index + '] input[type="checkbox"]').prop('checked', true);
                                            $('tr[data-index=' + index + '] input[type="checkbox"]').next().addClass('layui-form-checked');
                                        }
                                    });
                                });
                            }
                            //自定义样式
                            laypage.render({
                                elem: 'page'
                                ,count: params.count
                                , limit: size//显示的数量
                                ,theme: '#1E9FFF'
                                ,curr: parseInt(page) || 1 //当前页
                                ,jump : function(obj, first){
                                    if($.cookie('dangyuanIds') !="" && $.cookie('dangyuanIds') != undefined) {
                                        selfUrl = changeURLArg(selfUrl,'userIds',$.cookie('dangyuanIds'));
                                    }
                                    if(type !="" && type != undefined) {
                                        selfUrl = changeURLArg(selfUrl,'type',type);
                                    }
                                    if(!first){ //一定要加此判断，否则初始时会无限刷新
                                        selfUrl = changeURLArg(selfUrl,'p',obj.curr);
                                        selfUrl = changeURLArg(selfUrl,'size',size);
                                        self.location = selfUrl;
                                    }
                                }
                            });
                            layer.closeAll();
                        }
                    });
                    layer.closeAll();
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
                    elem: '#dataList'
                    ,id:"dataList"
                    ,limit: 0,
                    height: 500,
                    size: 'sm',
                    data:[]
                });
            }
        });
        var emp = [];
        var people = [];
        var organization_ids = [];
        table.on('checkbox(text)', function(obj){
            if($.cookie('dangyuanIds') !="" && $.cookie('dangyuanIds') != undefined) {
                emp = $.cookie('dangyuanIds').split(',');
            }
            if($.cookie('dangyuanNames') !="" && $.cookie('dangyuanNames') != undefined) {
                people = $.cookie('dangyuanNames').split(',');
            }
            if(obj.checked==true) {
                organization_ids.push(obj.data.organization_id);
                emp.push(obj.data.user_id);
                $.cookie('dangyuanIds', emp.join(','));
                people.push(obj.data.full_name);
                $.cookie('dangyuanNames', people.join(','));
            } else {
                organization_ids.pop(obj.data.organization_id);
                emp.pop(obj.data.user_id);
                $.cookie('dangyuanIds', emp.join(','));
                people.pop(obj.data.full_name);
                $.cookie('dangyuanNames', people.join(','));
            }
            $("#JtableIds").val($.cookie('dangyuanIds'));
            $("#Jpeoples").val($.cookie('dangyuanNames'));
            $("#JorganizationIds").val(organization_ids.join(''));
            console.log($("#Jpeoples").val());
            console.log($("#JtableIds").val());
        });
        $("#JtableIds").val($.cookie('dangyuanIds'));
        $("#Jpeoples").val($.cookie('dangyuanNames'));
        form.render(); //更新全部，防止input多选和单选框不显示问题
    })
</script>