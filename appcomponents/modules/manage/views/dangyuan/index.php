<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */
?>

<?=Html::cssFile('@web/static/plugs/layui/css/layui.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
<?=Html::cssFile('@web/static/css/common/main.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
<?=Html::cssFile('@web/static/dangjian/css/form.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
<style>
    .layui-laypage-btn {
        border: 1px solid #666 !important;
    }
    .my-light{
        display: inline-block;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background-color: #f00;
        vertical-align: middle;
        margin-bottom: 3px;
    }
    .my-light-red{
        background-color: #f00;
    }
    .my-light-yellow{
        background-color: #ff0;
    }
    .my-light-green{
        background-color: #0f0;
    }
    #search_form input.layui-input {
        height: 31px;
    }
</style>


<!--[if lt IE 9]>
<script src="__CSS__/html5shiv.min.js"></script>
<script src="__CSS__/respond.min.js"></script>
<![endif]-->
<?=Html::jsFile('@web/static/plugs/layui/layui.all.js?v='.date("ymd"), ['type' => "text/javascript"])?>
<div class="ibox-content">
    <div class="row">
        <div class="col-sm-12">
            <!-- 列表  -->
            <div class="table-responsive" id="contentsContainerList"><!--?xml version="1.0" encoding="utf-8" ?-->
                <!--主体-->
                <div style="margin-bottom:0px;">

                    <div class="admin-main layui-form" style="margin: 0 15px;">
                        <blockquote class="layui-elem-quote layui-text">
                            企业党委（共2人）        </blockquote>
                        <form id="search_form" class="layui-form layui-clear" action="">
                            <a class="layui-btn layui-btn-sm" href="<?=Url::to(['manage/dangyuan/edit']);?>?organization_id=<?=isset($organization_id) ? $organization_id : "";?>">添加用户</a>
                            <div class="" style="float: right;">
                                <script>
                                    let renderArr = [];
                                </script>
                                <!--<div class="layui-inline">-->
                                <!--<select name="recommend">-->
                                <!--<option value="0"-->
                                <!--selected > 是否推荐 </option>-->
                                <!--<option value="1"-->
                                <!--&gt; 推荐 </option>-->
                                <!--</select>-->
                                <!--</div>-->
                                <div class="layui-inline">
                                    <input type="text" name="keyword" autocomplete="off" lay-verify="" placeholder="请输入姓名关键字"
                                           value=""  class="layui-input">
                                </div>
                                <button id="search_btn" class="layui-btn layui-btn-sm" data-type="reload">搜索</button>
                            </div>
                        </form>
                        <div class="layui-clear">
                            <table class="layui-hide" id="demo" lay-filter="test"></table>
                        </div>

                        <!--<script type="text/html" id="toolbarDemo">-->
                        <!--<div class="layui-btn-container">-->
                        <!--<a href="/admin.php/article/edit.html" class="layui-btn layui-btn-sm" id="add">-->
                        <!--<i class="layui-icon">&#xe608;</i> 添加-->
                        <!--</a>-->
                        <!--</div>-->
                        <!--</script>-->

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
    layui.use(['table', 'jquery','form'], function () {
        var table = layui.table
            , jq = layui.jquery
            , $ = layui.jquery
            , currPage = 1
            , form = layui.form;

        let url = "<?=Url::to(['common/dangyuan/get-list']);?>?organization_id=<?=isset($organization_id) ? $organization_id : 0;?>";
        let tableData = {
            elem: '#demo'
            , url: url
            , defaultToolbar: []//['filter', 'print', 'exports']
            , title: 'list test'
            , cellMinWidth: 30
            , cols: [
                [{
                    "title": "ID",
                    "field": "id",
                    "type": "text",
                    "width": 55,
                    "align": "center",
                    "sort": false
                }, {
                    "title": "用户姓名",
                    "field": "full_name",
                    "type": "text",
                    "width": 80,
                }, {
                    "title": "职务",
                    "field": "level_title",
                    "type": "select",
                }, {
                    "title": "手机号",
                    "field": "username",
                    "type": "text",
                    "width": 120,
                }, {
                    "title": "积分",
                    "field": "point",
                    "type": "text",
                    "width": 60,
                }, {
                    "title": "红灯",
                    "field": "red_light",
                    "width": 70,
                    templet: '<div><a href="/admin.php/meeting_user/index/light/1.html?user_id={{d.id}}">\n' +
                    '                        <span class="my-light my-light-red"></span>\n' +
                    '                        <span>x\n' +
                    '                            {{d.red_light}}\n' +
                    '                        </span>\n' +
                    '                    </a></div>'
                }, {
                    "title": "黄灯",
                    "field": "yellow_light",
                    "width": 70,
                    templet: '<div><a href="/admin.php/meeting_user/index/light/2.html?user_id={{d.id}}">\n' +
                    '                        <span class="my-light my-light-yellow"></span>\n' +
                    '                        <span>x\n' +
                    '                            {{d.yellow_light}}\n' +
                    '                        </span>\n' +
                    '                    </a></div>'
                }, {
                    "title": "绿灯",
                    "field": "green_light",
                    "width": 70,
                    templet: '<div><a href="/admin.php/meeting_user/index/light/3.html?user_id={{d.id}}">\n' +
                    '                        <span class="my-light my-light-green"></span>\n' +
                    '                        <span>x\n' +
                    '                            {{d.green_light}}\n' +
                    '                        </span>\n' +
                    '                    </a></div>'
                }, {
                    "title": "操作",
                    "field": "toolbar",
                    "width": 190,
                    "type": "toolbar",
                    "fixed": "right",
                    "toolbar": "#barDemo"
                }]
            ],
            page: true
            , response: {
                statusCode: 0
            }
            ,id: 'testReload',
            done:
                function (res, curr, count) {
                    currPage = curr;
                    if (res.data.length == 0 && currPage > 1) {
                        //当前页数据为空自动切到前一页
                        active['reload'] ? active['reload'].call(this, currPage - 1) : '';
                    }
                }
        };

        let page_where = [];
        if (page_where != null && page_where != '') {
            tableData.where = page_where;
        }

        table.render(tableData);

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
