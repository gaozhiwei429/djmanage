<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */
?>

<?=Html::cssFile('@web/static/dangjian/css/main.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
<?=Html::cssFile('@web/static/dangjian/css/form.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
<?=Html::cssFile('@web/static/dangjian/css/layer.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
<?=Html::cssFile('@web/static/dangjian/css/laydate.css?v='.date("ymd"), ['rel' => "stylesheet"])?>

<style>
    .layui-laypage-btn {
        border: 1px solid #666 !important;
    }
    .layui-form-select .layui-input{
        height: 30px;
    }
    .laytable-cell-1-0-4 {
        width: 525px;
    }
</style>
<div class="layui-card">
    <div class="layui-header notselect">
        <div class="pull-left">
<span>
<?= Html::encode($title ? $title : (isset($this->title) ? $this->title : null)) ?>
</span>
</div>
        <div class="pull-right margin-right-15 nowrap">
            <?php
            if(isset($menuUrl) && !empty($menuUrl) && in_array(trim(Url::to(['manage/news/add']),"/"), $menuUrl)) {
                ?>
                <button data-open='<?=Url::to(['manage/news/edit']);?>' class='layui-btn layui-btn-sm layui-btn-primary'>添加</button>
            <?php
            }
            ?>
            <?php
            if(isset($menuUrl) && !empty($menuUrl) && in_array(trim(Url::to(['manage/news/del']),"/"), $menuUrl)) {
                ?>
                <button data-update data-field='delete' data-action='<?=Url::to(['manage/news/del']);?>'  class='layui-btn layui-btn-sm layui-btn-primary'>删除</button>
            <?php
            }
            ?>
        </div>
    </div>
    <div class="layui-card-body gray-bg searchPage">

        <!--主体-->
        <div style="margin-bottom:0px;">

            <div class="admin-main layui-form layui-field-box">
                <blockquote class="layui-elem-quote layui-text">
                    点击排序的序号可编辑排序，数字越小排序越前            </blockquote>
                <form id="search_form" class="layui-form layui-clear " action="">
                    <a class="layui-btn  layui-btn-sm" href="http://h5dangjian.orangelite.cn/admin.php/department/add.html">添加部门</a>
                    <div class="" style="float: right;">
                        <script>
                            let renderArr = [];
                        </script>
                    </div>
                </form>
                <div class="layui-clear">
                    <table class="layui-hide" id="demo" lay-filter="test">
</table>
                    <div class="layui-form layui-border-box layui-table-view" lay-filter="LAY-table-1" lay-id="testReload" style=" ">
                        <div class="layui-table-box">
                            <div class="layui-table-header">
                                <table class="layui-table" cellspacing="0" cellpadding="0" border="0">
                                    <thead>
                                    <tr>
<th data-field="id" data-key="1-0-0" data-unresize="true" class="">
                                            <div class="layui-table-cell laytable-cell-1-0-0 laytable-cell-text" align="center">
<span>ID</span>
</div>
                                        </th>
                                        <th data-field="name" data-key="1-0-1" data-unresize="true" class="">
                                            <div class="layui-table-cell laytable-cell-1-0-1 laytable-cell-text">
<span>名称</span>
</div>
                                        </th>
                                        <th data-field="sort" data-key="1-0-2" data-unresize="true" class="">
                                            <div class="layui-table-cell laytable-cell-1-0-2 laytable-cell-text">
<span>排序</span>
</div>
                                        </th>
                                        <th data-field="toolbar" data-key="1-0-3" data-unresize="true" class="">
                                            <div class="layui-table-cell laytable-cell-1-0-3 laytable-cell-toolbar">
<span>是否显示</span>
</div>
                                        </th>
                                        <th data-field="toolbar" data-key="1-0-4" data-unresize="true" class="">
                                            <div class="layui-table-cell laytable-cell-1-0-4 laytable-cell-toolbar">
<span>操作</span>
</div>
                                        </th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="layui-table-body layui-table-main">
                                <table class="layui-table" cellspacing="0" cellpadding="0" border="0">
                                    <tbody>
                                    <?php
                                    if(isset($treeData)) {
                                        $flag = 0;
                                    foreach($treeData as $k=>$v) {
                                        ?>
                                        <tr data-index="<?= $flag; ?>" class="">
                                            <td data-field="id" data-key="1-0-0" class="" align="center">
                                                <div
                                                    class="layui-table-cell laytable-cell-1-0-0 laytable-cell-text"><?= isset($v['id']) ? $v['id'] : ""; ?></div>
                                            </td>
                                            <td data-field="name" data-key="1-0-1" class="">
<div class="layui-table-cell laytable-cell-1-0-1 laytable-cell-text"><?= isset($v['flag']) ? $v['flag'] : ""; ?><?= isset($v['title']) ? $v['title'] : ""; ?></div>
                                            </td>
                                            <td data-field="sort" data-key="1-0-2" data-edit="text" class="">
                                                <div
                                                    class="layui-table-cell laytable-cell-1-0-2 laytable-cell-text"><?= isset($v['sort']) ? $v['sort'] : ""; ?></div>
                                            </td>
                                            <td data-field="toolbar" data-key="1-0-3" data-off="true" class="">
                                                <div class="layui-table-cell laytable-cell-1-0-3 laytable-cell-toolbar">
                                                    <input type="checkbox" lay-skin="switch" name="show"
                                                           lay-text="显示|隐藏" lay-filter="switchshow"
                                                           data-url="/admin.php/department/updatestatus.html"
                                                           data-id="<?= isset($v['id']) ? $v['id'] : ""; ?>" value=""
                                                           checked="checked">

                                                    <div class="layui-unselect layui-form-switch layui-form-onswitch"
                                                         lay-skin="_switch">
                                                        <em>显示</em>
                                                        <i>
                                                        </i>
                                                    </div>
                                                </div>
                                            </td>
                                            <td data-field="toolbar" data-key="1-0-4" data-off="true" class="">
                                                <div class="layui-table-cell laytable-cell-1-0-4 laytable-cell-toolbar">
                                                    <a class="layui-btn layui-btn-warm layui-btn-xs" data-ext="?id=49"
                                                       lay-event="/admin.php/department/add.html?id=49">添加子部门</a>
                                                    <a class="layui-btn layui-btn-normal layui-btn-xs" data-ext="?id=49"
                                                       lay-event="/admin.php/department/edit.html?id=49">编辑</a>
                                                    <a class="layui-btn layui-btn-danger layui-btn-xs"
                                                       data-delete-href="/admin.php/department/delete.html"
                                                       lay-event="delete">删除</a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    $flag ++;
                                    }
                                    ?>

</tbody>
</table>
</div>
</div>
</div>
<style>.laytable-cell-1-0-0{ width: 70px; }.laytable-cell-1-0-1{ width: 550px; }.laytable-cell-1-0-2{ width: 100px; }.laytable-cell-1-0-3{ width: 100px; }.laytable-cell-1-0-4{  }</style>
</div>
                </div>

                <script type="text/html" id="toolbarDemo">
                    <div class="layui-btn-container">
                        <button class="layui-btn layui-btn-sm" lay-event="getCheckData">获取选中行数据</button>
                        <button class="layui-btn layui-btn-sm" lay-event="getCheckLength">获取选中数目</button>
                        <button class="layui-btn layui-btn-sm" lay-event="isAll">验证是否全选</button>
                    </div>
                </script>

                <script type="text/html" id="toolbarExport">
                    <div class="layui-btn-container">
                        <button class="layui-btn layui-btn-sm" lay-event="exportData">导出选中的</button>
                    </div>
                </script>

                <script type="text/html" id="barDemo1">
                    {{#  if(d.show==1){ }}
                    <input type="checkbox"  lay-skin="switch" name="show" lay-text="显示|隐藏" lay-filter="switchshow"  data-url="/admin.php/department/updatestatus.html"   data-id="{{  d.id }}"  value="" checked />
                    {{#  } else { }}
                    <input type="checkbox" lay-skin="switch"  name="show" lay-text="显示|隐藏" lay-filter="switchshow"   data-url="/admin.php/department/updatestatus.html"  data-id="{{  d.id }}"  value=""  />

                    {{#  } }}
                </script>
                <script type="text/html" id="barDemo">
                    {{#  if( true ){ }}
                    <a class="layui-btn layui-btn-warm layui-btn-xs" data-ext="?id={{= d.id }}" lay-event="/admin.php/department/add.html?id={{= d.id }}">添加子部门</a>
                    {{#  } }}
                    {{#  if( true ){ }}
                    <a class="layui-btn layui-btn-normal layui-btn-xs" data-ext="?id={{= d.id }}" lay-event="/admin.php/department/edit.html?id={{= d.id }}">编辑</a>
                    {{#  } }}
                    {{#  if( true ){ }}
                    <a class="layui-btn layui-btn-danger layui-btn-xs" data-delete-href="/admin.php/department/delete.html" lay-event="delete">删除</a>
                    {{#  } }}
                </script>

                <script type="text/html" id="datetimeTpl">
                    {{formatUnixtimestamp(d)}}
                </script>
            </div>

        </div>

        <!--页面JS脚本-->
    </div>
</div>
<?=Html::jsFile('@web/static/dangjian/js/delelement.js?v='.date("ymd"), ['type' => "text/javascript"])?>
<script type="text/javascript">
    layui.use(['table', 'jquery','form','layer', 'laydate'], function () {
        var table = layui.table
            , jq = layui.jquery
            , layer = layui.layer
            , laydate = layui.laydate
            , currPage = 1
            , form = layui.form;

        let url = self.location.href;
        let tableData = {
            elem: '#demo'
            , url: url
            , defaultToolbar: []//['filter', 'print', 'exports']
            , title: 'list test'
            , toolbar: ''
            , cellMinWidth: 80
            , cols: [[{"title":"ID","field":"id","type":"text","width":70,"align":"center","sort":false},{"title":"名称","field":"name","type":"text","width":550},{"title":"排序","field":"sort","type":"text","edit":"text","width":100},{"title":"是否显示","field":"toolbar","type":"toolbar","width":100,"fixed":"right","toolbar":"#barDemo1"},{"title":"操作","field":"toolbar","type":"toolbar","fixed":"right","toolbar":"#barDemo"}]]            , page: false            , limit: 10            , response: {
                statusCode: 1
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
                case 'exportData':
                    var arr = checkStatus.data;
                    if(arr.length == 0){
                        layer.alert('请先选中', {icon: 2, time: 3000});
                        return false;
                    }
                    var arg = [];
                    for (var index in arr){
                        arg.push(arr[index].id)
                    }
                    // layer.alert(JSON.stringify(arg));
                    var body = jq(document.body),
                        form = jq("<form method='post' target='_blank'>
</form>"),
                        input;
                    form.attr({"action":'/admin.php/department/export.html'});
                    jq.each(arg,function(key,value){
                        input = jq("<input type='hidden'>");
                        input.attr({"name":'id[]'});
                        input.val(value);
                        form.append(input);
                    });

                    form.appendTo(document.body);
                    form.submit();
                    document.body.removeChild(form[0]);
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
                                if(tableData.page!=false){
                                    active['reload'] ? active['reload'].call(this, currPage) : '';
                                }
                            }, 300);
                        }
                    });
                });
            } else if (obj.event === 'edit') {
                window.location.href = "/admin.php/department/edit.html" + '?id=' + data.id;
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
            jq.post("/admin.php/department/updatefield.html", {id: data.id, field: field, value: value}, function (res) {
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

        //创建编辑器
        let uploadInst = [];
        renderArr.forEach(function (v, i) {
            if (v.type == 'editor') {
                //编辑器
                renderArr[i].editIndex = layedit.build(v.id, {
                    uploadImage: "http://h5dangjian.orangelite.cn/admin.php/department/index.html?page=1&limit=10"
                });
            } else if (v.type == 'date') {
                console.log(v)
                //日期
                laydate.render({
                    elem: v.id
                    ,range: v.range
                });
            } else if (v.type == 'datetime') {
                console.log(v)
                //日期
                laydate.render({
                    elem: v.id,
                    type: 'datetime'
                });
            } else if (v.type == 'image') {
                //单图片上传
                uploadInst[i] = upload.render({
                    elem: v.btnId
                    , url: '/Admin/Upload/upimage'
                    , before: function (obj) {
                        //预读本地文件示例，不支持ie8
                        obj.preview(function (index, file, result) {
                            jq(v.imgId).attr('src', result); //图片链接（base64）
                        });
                    }
                    , done: function (res) {
                        //如果上传失败
                        if (res.code != 200) {
                            return layer.msg(res.msg);
                        }
                        //上传成功
                        jq(v.inputId).val(res.path);
                        jq(v.imgId).attr('src', res.path).show();
                        jq(v.aId).attr('href', res.path);
                    }
                    , error: function () {
                        //演示失败状态，并实现重传
                        var demoText = jq(v.textId);
                        demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-sm layui-btn-xs demo-reload">重试</a>');
                        demoText.find('.demo-reload').on('click', function () {
                            uploadInst[i].upload();
                        });
                    }
                });
            } else if (v.type == 'excel') {
                //excel上传
                uploadInst[i] = upload.render({
                    elem: v.btnId
                    , url: '/Admin/Upload/upExcel'
                    , accept: 'file'
                    , exts: 'xls|xlsx'
                    , before: function (obj) {
                    }
                    , done: function (res) {
                        //如果上传失败
                        if (res.code != 200) {
                            return layer.msg(res.msg);
                        }
                        //上传成功
                        jq(v.inputId).val(res.path)
                    }
                    , error: function () {
                        //演示失败状态，并实现重传
                        var demoText = jq(v.textId);
                        demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-sm layui-btn-xs demo-reload">重试</a>');
                    }
                });
            }
        });
        console.log('renderArr', renderArr)

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
