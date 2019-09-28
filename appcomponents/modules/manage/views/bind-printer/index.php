<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */

?>
<div class="layui-card">
    <div class="layui-header notselect">
        <div class="pull-left"><span><?= Html::encode($title ? $title : (isset($this->title) ? $this->title : null)) ?></span></div>
        <div class="pull-right margin-right-15 nowrap">
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
    var groupListGtml = "";
    var groupList = '<?=isset($group) ? json_encode($group) : json_encode([])?>';
    var groupList = JSON.parse(groupList);
    if(groupList !== undefined) {
        $.each(groupList, function(i, value){
            groupListGtml+="<option value="+value.id+">"+value.name+"</option>"
        })
    }
    $.ajax({
        type: "post",
        url:"<?= Url::to(['common/bind-printer/get-data-list']); ?>",
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
                        ,{field:'numberstr', title: '打印机序列号', minWidth: 240}
                        ,{field:'model_name', title: '型号'}
                        ,{field:'print_name', title: '打印机名称', minWidth: 140}
                        ,{field:'bd_diqu_name', title: '地区', minWidth: 160}
                        ,{field:'mac', title: 'mac地址', minWidth: 140}
                        ,{field:'machine_date', title: '生产日期', minWidth: 120}
                        ,{field:'province_code', title: '城市编码'}
                        ,{field:'model_code', title: '型号编码'}
//                        ,{field:'sequence_number', title: '自然序号'}
                        ,{field:'dynamicInfo', title: '状态', toolbar:"#Jstatus"}
//                        ,{field:'create_time', title: '绑定时间'}
                        ,{field:'concern_status', title: '是否关注', toolbar:"#JconcernStatus", minWidth: 120}
                        ,{field:'concern_group_name', title: '关注分组', toolbar:"#JconcernGroup", minWidth: 120}
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
    form.on('checkbox(concern_status)', function(obj){
        var status = obj.elem.checked===true ? 1 : 0;
        var type = $(this).data('type');
        params.status = status;
        params.bind_printer_id = this.value;
//        layer.tips(this.value + ' ' + this.name + '：'+ obj.elem.checked, obj.othis);
        if(status>0) {
            layer.open({
                type: 1
                ,skin: 'layui-layer-demo' //样式类名
                ,closeBtn: 0 //不显示关闭按钮
//            ,anim: 2
                ,shadeClose: true //开启遮罩关闭
                ,resize: true
                ,content: ['<ul class="layui-form" style="margin: 10px;">'
                    ,'<li class="layui-form-item">'
                    ,'<input type="hidden" value="'+status+'" name="status" /><input type="hidden" value="'+this.value+'" name="bind_printer_id" />'
                    ,'<label class="layui-form-label">选择分组</label>'
                    ,'<div class="layui-input-block">'
                    ,'<select name="concern_group_id">'+groupListGtml
                    ,'<select>'
                    ,'</div>'
                    ,'</li>'
                    ,'<li class="layui-form-item" style="text-align:center;">'
                    ,'<button type="submit" lay-submit lay-filter="concern" class="layui-btn">提交</button>'
                    ,'</li>'
                    ,'</ul>'].join('')
                ,success: function(layero){
                    form.render();
                    layero.find('.layui-layer-content').css('overflow', 'visible');
                    form.on('submit(concern)', function(data){
//                    layer.msg(JSON.stringify(data.field));
                        $.ajax({
                            type: "post",
                            url:"<?= Url::to(['common/concern/edit']); ?>",
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
                url:"<?= Url::to(['common/concern/edit']); ?>",
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
    {{#  if(d.dynamicInfo !== undefined && d.dynamicInfo.state == "1"){ }}
    空闲
    {{# }else if(d.dynamicInfo !== undefined && d.dynamicInfo.state == "2") { }}
    工作中
    {{# }else if(d.dynamicInfo === undefined) { }}
    未获取
    {{# }else{ }}
    故障
    {{#  } }}
</script>
<script type="text/html" id="JconcernStatus">
    {{#  if(d.concern_status == "1"){ }}
    <input type="checkbox" name="concern_status" class="layui-btn layui-btn-primary" data-status="{{d.concern_status}}" value="{{d.id}}" title="取消" lay-filter="concern_status" checked>
<!--    <button class="layui-btn layui-btn-primary" data-id="{{d.id}}"  name="concern_status" lay-skin="concern_status" >已关注</button>-->
    {{# }else{ }}
    <input type="checkbox" name="concern_status" class="layui-btn layui-btn-danger" data-status="{{d.concern_status}}" value="{{d.id}}" title="关注" lay-filter="concern_status">
<!--    <button class="layui-btn layui-btn-danger" data-id="{{d.id}}" name="concern_status" lay-skin="concern_status">去关注</button>-->
    {{#  } }}
</script>
<script type="text/html" id="JconcernGroup">
{{#  if(d.concern_group_id !== "0"){ }}
{{d.concern_group_name}}
{{# }else{ }}
暂无
{{#  } }}
</script>
<script type="text/html" id="barDemo">
    <?php
    if(isset($menuUrl) && !empty($menuUrl) && in_array(trim(Url::to(['manage/bind-printer/info']),"/"), $menuUrl)) {
        ?>
        <a class="layui-btn layui-btn-radius layui-btn-sm layui-btn-mini" data-modal="<?=Url::to(['manage/bind-printer/info']);?>?id={{d.id}}" data-title="打印机详情">查看</a>
    <?php
    }
    ?>
</script>