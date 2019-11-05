<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="layui-card">
<div class="layui-layer layui-layer-page" id="layui-layer15" type="page" times="15" showtime="0" contype="string" style="z-index: 19891029; width: 800px; top: 134px; left: 17.5px;"><div class="layui-layer-title" style="cursor: move;">编辑角色</div><div id="" class="layui-layer-content"><form autocomplete="off" class="layui-form layui-box modal-form-box" action="/admin/role/edit.html?id=1&amp;spm=m-63-64-65&amp;open_type=modal" data-auto="true" method="post" data-listen="true" novalidate="novalidate">

    <div class="layui-form-item">
        <label class="layui-form-label label-required">角色名称</label>
        <div class="layui-input-block">
            <input type="text" name="role_name" value="业务员" required="required" title="请输入角色名称" placeholder="请输入角色名称" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label label-required">角色描述</label>
        <div class="layui-input-block">
            <textarea placeholder="请输入角色描述" required="required" title="请输入角色描述" class="layui-textarea" name="desc">业务员</textarea>
        </div>
    </div>

    <div class="hr-line-dashed"></div>

    <div class="layui-form-item text-center">
        <input type="hidden" value="1" name="id">        <button class="layui-btn" type="submit">保存数据</button>
        <button class="layui-btn layui-btn-danger" type="button" data-confirm="" data-close="">取消编辑</button>
    </div>

</form>
</div><span class="layui-layer-setwin"><a class="layui-layer-ico layui-layer-close layui-layer-close1" href="javascript:;"></a></span><span class="layui-layer-resize"></span></div>
</div>
<script type="application/javascript">
layui.use(['table', 'laypage', 'layer'], function(){
    var storage=window.localStorage;
    var table = layui.table;
    var userData = storage.getItem("userData");
    var headerParams = JSON.parse(userData);
    var params = [];
    params.p=1;
    params.size = 1;
    params.count = 0;
    $.ajax({
        type: "post",
        url:"<?= Url::to(['manage/role/get-list']); ?>",
        contentType: "application/json;charset=utf-8",
        data :params,
        dataType: "json",
        beforeSend: function (XMLHttpRequest) {
            for(var i in headerParams) {
                XMLHttpRequest.setRequestHeader(i, headerParams[i]);
            }
        },
        success:function(result){
            if(result.code == 0) {
                params.count = result.data.count;
//            return;
                table.render({
                    elem: '#test'
                    ,id:"test"
                    ,data:result.data.dataList
                    ,cellMinWidth: 80 //全局定义常规单元格的最小宽度，layui 2.2.1 新增
                    ,cols: [[
                        {checkbox: true, fixed: true}
                        ,{field:'id', title: 'ID'}
                        ,{field:'role_name', title: '角色名称'}
                        ,{field:'desc', title: '描述'}
                        ,{field:'status', title: '状态' ,templet:function(d){return d.status ==1 ? "启用" : "禁用";}}
                        ,{field:'create_time', title: '添加时间', minWidth: 100} //minWidth：局部定义当前单元格的最小宽度，layui 2.2.1 新增
//                        ,{width: '20%', title: '操作'}
                        ,{field:'right', title: '操作', minWidth: 100, width:'30%',toolbar:"#barDemo"}
                    ]]
                    ,done: function(res, curr, count){
                        //如果是异步请求数据方式，res即为你接口返回的信息。
                        //如果是直接赋值的方式，res即为：{data: [], count: 99} data为当前页数据、count为数据总长度
                        console.log(res);

                        //得到当前页码
                        console.log(curr);

                        //得到数据总量
                        console.log(count);
                    }
                })
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

    var laypage = layui.laypage
        ,layer = layui.layer;
    //自定义样式
    laypage.render({
        elem: 'page'
        ,count: params.count
        ,theme: '#1E9FFF'
    });
});
</script>
<script type="text/html" id="barDemo">
    <?php
    if(isset($menuUrl) && !empty($menuUrl) && in_array(Url::to(['/role/add']), $menuUrl)) {
        ?>
        <a class="layui-btn layui-btn-radius layui-btn-sm layui-btn-disabled" lay-event="detail">禁用</a>
    <?php
    }
    ?>
    <a class="layui-btn layui-btn-radius layui-btn-sm layui-btn-normal" lay-event="edit">授权</a>
    <a class="layui-btn layui-btn-radius layui-btn-sm layui-btn-mini" lay-event="edit">编辑</a>
    <a class="layui-btn layui-btn-radius layui-btn-sm layui-btn-danger" lay-event="del">删除</a>
</script>
<script type="text/html" id="Jstatus">
    {{#  if(d.status ==0){ }}
    未知
    {{# }if(d.status ==2) { }}
    禁用
    {{# }if(d.status ==1) { }}
    启用
    {{#  } }}
</script>