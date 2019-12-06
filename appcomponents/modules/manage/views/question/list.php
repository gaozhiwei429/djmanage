<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */
?>
<?=Html::cssFile('@web/static/dangjian/css/main.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
<?=Html::cssFile('@web/static/dangjian/css/form.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
<?=Html::cssFile('@web/static/dangjian/css/layer.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
<?=Html::cssFile('@web/static/dangjian/css/laydate.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
<?=Html::cssFile('@web/static/plugs/layui/css/layui.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
<?=Html::cssFile('@web/static/theme/css/console.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
<?=Html::cssFile('@web/static/theme/css/animate.css?v='.date("ymd"), ['rel' => "stylesheet"])?>

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
    $.cookie('checkbox', "<?=isset($questionIds) ? $questionIds : ""?>");
    var type = "<?=isset($type) ? $type : 0?>";
    var params = {};
    var page = GetUrlParam("p") ? GetUrlParam("p") : 1;
    var size = GetUrlParam("size") ? GetUrlParam("size") : 3;
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
        url:"<?= Url::to(['/common/question/get-list']); ?>",
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
                        ,{field:'title', title: '问题标题', minWidth: 100}
                        ,{field:'type', title: '类型', width: 80, toolbar:"#Jtype"}
                        ,{field:'sort', title: '排序',"width":100}
                        ,{field:'answer', title: '答案',"width":100}
                    ]]
                    ,done: function(res, curr, count){
                        var checkboxArr = $.cookie('checkbox').split(',');
                        if(checkboxArr.length!=0) {
                            $.each(res.data, function(i, item){
                                $.each(checkboxArr,function(j,val){
                                    if(item.id==val) {
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
                                if($.cookie('checkbox') !="" && $.cookie('checkbox') != undefined) {
                                    selfUrl = changeURLArg(selfUrl,'questionIds',$.cookie('checkbox'));
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
    table.on('checkbox(text)', function(obj){
        if($.cookie('checkbox') !="" && $.cookie('checkbox') != undefined) {
            emp = $.cookie('checkbox').split(',');
        }
        if(obj.checked==true) {
            emp.push(obj.data.id);
            $.cookie('checkbox', emp.join(','));
        } else {
            emp.pop(obj.data.id);
            $.cookie('checkbox', emp.join(','));
        }
        $("#JtableIds").val($.cookie('checkbox'));
        console.log($("#JtableIds").val());
    });
    $("#JtableIds").val($.cookie('checkbox'));
    form.render(); //更新全部，防止input多选和单选框不显示问题
})
</script>
<script type="text/html" id="Jstatus">
    {{#  if(d.status ==0){ }}
    <input type="checkbox" name="status" lay-skin="switch" lay-text="上线|下线" lay-filter="status" data-id="{{d.id}}" data-status="{{d.status}}" value="{{d.id}}"/>
    {{# }if(d.status ==1) { }}
    <input type="checkbox" name="status" lay-skin="switch" lay-text="上线|下线" lay-filter="status" data-id="{{d.id}}" data-status="{{d.status}}" value="{{d.id}}" checked />
    {{#  } }}
</script>

<script type="text/html" id="Jtype">
    {{#  if(d.type ==0){ }}
    未知
    {{# }else if(d.type ==1) { }}
    单项选择
    {{# }else if(d.type ==2) { }}
    多项选择
    {{# }else if(d.type ==3) { }}
    判断
    {{# }else if(d.type ==4) { }}
    解答
    {{# }else if(d.type ==5) { }}
    填空
    {{# }else { }}
    未知
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

<script type="text/html" id="Jimg">
    {{#  if(d.pic_url!=""){ }}
    <img src="{{d.pic_url}}">
    {{# }else{ }}
    暂无
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