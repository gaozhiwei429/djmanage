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
<div class="ibox-content">
    <div class="row">
        <div class="col-sm-12">
            <!-- 列表  -->
            <div class="table-responsive" id="contentsContainerList"><!--?xml version="1.0" encoding="utf-8" ?-->
                <!--主体-->
                <div style="margin-bottom:0px;">

                    <div class="admin-main layui-form" style="margin: 0 15px;">
                        <blockquote class="layui-elem-quote layui-text">
                            <?=$dep_name?$dep_name : "全部";?>（共<span id="peopleCount">0</span>人）        </blockquote>
                        <form id="search_form" class="layui-form layui-clear" action="">
                            <?php
                            if(isset($organization_id) && !empty($organization_id)) {
                            ?>
<a class="layui-btn layui-btn-sm" href="<?=Url::to(['manage/dangyuan/edit']);?>?organization_id=<?=isset($organization_id) ? $organization_id : "";?>">添加用户</a>
                            <?php
                            }
                            ?>
                            <div class="" style="float: right;">
                                <script>
                                    let renderArr = [];
                                </script>
                                <div class="layui-inline">
                                    <input type="text" name="keyword" autocomplete="off" lay-verify="" placeholder="请输入姓名关键字"
                                           value=""  class="layui-input">
                                </div>
                                <button id="search_btn" class="layui-btn layui-btn-sm" data-type="reload">搜索</button>
                            </div>
                        </form>


                        <div class="layui-clear">
                            <table class="layui-hide" id="dataList" lay-filter="text"></table>
                            <div id="page"></div>
                        </div>

                        <script type="text/html" id="barDemo">
                            {{#  if( true ){ }}
                            <a class="layui-btn layui-btn-warm layui-btn-xs" data-ext="?id={{= d.id }}" lay-event="/admin.php/point_log/index.html?user_id={{= d.id }}">积分详情</a>
                            <a class="layui-btn layui-btn-normal layui-btn-xs" data-ext="?id={{= d.id }}" lay-event="/admin.php/user/edit.html?id={{= d.id }}">编辑</a>
                            {{#  } }}
                            {{#  if( true ){ }}
                            <a class="layui-btn layui-btn-danger layui-btn-xs" data-delete-href="/admin.php/user/delete.html?id={{= d.id }}" lay-event="delete">删除</a>
                            {{#  } }}
                        </script>

                        <script type="text/html" id="datetimeTpl">
                            {{formatUnixtimestamp(d)}}
                        </script>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
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
                params.count = result.data.count;
                $("#peopleCount").html(result.data.count);
                if(result.code == 0) {
                    table.render({
                        elem: '#dataList'
                        ,id:"dataList"
                        ,data:result.data.dataList
                        ,cellMinWidth: 80 //全局定义常规单元格的最小宽度，layui 2.2.1 新增
                        ,cols: [[
                            {checkbox: true, fixed: true, width: 30}
                            ,{field:'id', title: 'ID', width: 30}
                            ,{field:'full_name', title: '用户姓名', minWidth: 100}
                            ,{field:'level_title', title: '职务', minWidth: 100}
                            ,{field:'organization_title', title: '党组织', minWidth: 200}
                            ,{field:'username', title: '手机号', minWidth: 100}
                            ,{field:'right', title: '操作',toolbar:"#barDemo"}
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
                    size: 'sm',
                    data:[]
                })
            }
        });

        //TODO （暂无用）头工具栏事件
        table.on('toolbar(test)', function (obj) {
            var checkStatus = table.checkStatus(obj.config.id);
            switch (obj.event) {
                case 'getCheckData':
                    var data = checkStatus.data;
                    layer.alert(JSON.stringify(data));
                    break;
                case 'getCheckLength':
                    var data = checkStatus.data;
                    layer.msg('选中了：' + data.length + ' 个');
                    break;
                case 'isAll':
                    layer.msg(checkStatus.isAll ? '全选' : '未全选');
                    break;
            };
        });

        //监听行工具事件
        table.on('tool(test)', function (obj) {
            var data = obj.data;
            if (obj.event === 'delete') {
                layer.confirm('确定删除该条数据吗?',{icon: 3, title:'删除提示'}, function (index) {
                    var url = jq(obj.tr[0].innerHTML).find('a[data-delete-href]').data('deleteHref');
                    jq.post(url, {id: data.id}, function (res) {
                        if (res.code != 1) {
                            return layer.alert(res.msg, {icon: 2, time: res.wait*1000});
                        } else {
                            layer.msg(res.msg);
                            setTimeout(function () {
                                obj.del();
                                layer.close(index);
                                active['reload'] ? active['reload'].call(this, currPage) : '';
                            }, 300);
                        }
                    });
                });
            } else if (obj.event === 'edit') {
                window.location.href = "/admin.php/article/edit.html" + '?id=' + data.id;
            } else if(obj.event === 'row') {
                console.log('row')
            } else {
                window.location.href = obj.event;
            }
        });

        //TODO （暂无用）监听单元格编辑
        table.on('edit(test)', function (obj) {
            var value = obj.value //得到修改后的值
                , data = obj.data //得到所在行所有键值
                , field = obj.field; //得到字段
            /*layer.msg('[ID: '+ data.id +'] ' + field + ' 字段更改为：'+ value);*/
            jq.post("/admin.php/article/updatefield.html", {id: data.id, field: field, value: value}, function (res) {
                if (res.code != 1) {
                    return layer.msg(res.msg);
                } else {
                    layer.msg(res.msg);
                }
            });
        });

        var active = {
            reload: function (page) {
                console.log('page', page)
                page = page || 1;
                var search_form = jq('#search_form').serializeArray();
                var where = {};
                jq.each(search_form, function () {
                    where[this.name] = this.value;
                });
                console.log(where);
                //执行重载
                table.reload('testReload', {
                    page: {
                        curr: page //重新从第 1 页开始
                    }
                    , where: where
                });
            }
        };

        jq('#search_btn').on('click', function () {
            var type = jq(this).data('type');
            active[type] ? active[type].call(this) : '';
            return false;
        });


        //搜索滑动按钮
        var status=0;
        form.on('switch(switchshow)', function(data){

            loading = layer.load(2, {
                shade: [0.2,'#000']
            });

            if(data.elem.checked){
                status=1;
            }else{
                status=0;
            }
            var url  =  data.elem.getAttribute("data-url")+ "?name="+ data.elem.name + "&status="+status +'&id='+data.elem.getAttribute("data-id");

            jq.get(url,function(data){
                layer.close(loading);
                if(data.code != 200){
                    //失败
                    data.elem.checked = !data.elem.checked;
                    form.render('checkbox');
                }
                layer.msg(data.msg, {icon: 1, time: 1000});
            });
            return false;
        });


    });  // end layui use

    function formatTime(obj) {
        return formatUnixtimestamp(obj);
    }

    function formatUnixtimestamp(obj) {
        if(obj == undefined || '' == obj || null == obj){
            return '';
        }
        var obj = new Date(obj * 1000);
        var year = 1900 + obj.getYear();
        var month = "0" + (obj.getMonth() + 1);
        var date = "0" + obj.getDate();
        var hour = "0" + obj.getHours();
        var minute = "0" + obj.getMinutes();
        var second = "0" + obj.getSeconds();
        return year + "-" + month.substring(month.length - 2, month.length) + "-" + date.substring(date.length - 2, date.length)
            + " " + hour.substring(hour.length - 2, hour.length) + ":"
            + minute.substring(minute.length - 2, minute.length) + ":"
            + second.substring(second.length - 2, second.length);
    }
</script>
<?=Html::jsFile('@web/static/dangjian/js/delelement.js?v='.date("ymd"), ['type' => "text/javascript"])?>
