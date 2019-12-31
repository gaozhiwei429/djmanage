<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<!DOCTYPE html>
<html><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="UTF-8">
<title>智慧党建系统后台管理</title>
<link rel="stylesheet" href="/static/plugs/layui/css/layui.common.css" media="all">
<link rel="stylesheet" href="/static/plugs/layui/css/main.css" media="all">
<link rel="stylesheet" href="/static/plugs/layui/css/form.css">
<style>
    .layui-upload-img {
        width: 92px;
        height: 92px;
        margin: 0 10px 10px 0;
    }
    .require-text {
        color:#DC524B;
    }
    .layui-form-item .layui-input-inline {
        float: left;
        width: 120px;
    }
</style>
<!--[if lt IE 9]>
<script src="__CSS__/html5shiv.min.js"></script>
<script src="__CSS__/respond.min.js"></script>
<![endif]-->
<!--<script src="/static/js/jquery-1.9.1.min.js"></script>-->
<script type="text/javascript" src="/static/plugs/layui/layui.js"></script>
<link id="layuicss-layer" rel="stylesheet" href="/static/plugs/layui/css/layer.css" media="all">
<link id="layuicss-laydate" rel="stylesheet" href="/static/plugs/layui/css/modules/laydate/default/laydate.css" media="all"></head>
<!--主体-->
<div style="margin-bottom:0px;">
    <div class="admin-main layui-form layui-field-box">
        <button class="layui-btn layui-btn-sm" onclick="window.history.go(-1);">返回</button>
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>添加用户</legend>
        </fieldset>
        <form autocomplete="off" class="layui-form" onsubmit="return false;" data-auto="true" action="#">
    <input type="hidden" name="organization_id" value="<?=isset($organization_id) ? $organization_id : "";?>" class="layui-input">
            <script>
                let renderArr = [];
            </script>

            <div class="layui-form-item" id="addDepBtnItem">
                <label class="layui-form-label">
                    <span class="require-text">*</span>
                    添加党员
                </label>
                <div class="layui-input-inline" style="width: auto;">
                    <a href="javascript:void(0);" title="增加党员" id="addDepBtn" class="layui-btn layui-btn-primary">+</a>
                </div>
                <div class="layui-form-mid layui-word-aux">最少添加一个党员</div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn layui-btn-sm" lay-submit="" lay-filter="*">立即提交</button>
                    <!--<button type="reset" class="layui-btn layui-btn-primary">重置</button>-->
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript" src="/static/dangjian/js/delelement.js"></script>
<!--页面JS脚本-->
<script type="text/javascript">
layui.use(['form', 'layedit', 'laydate', 'jquery', 'upload'], function () {
    var form = layui.form
        , layer = layui.layer
        , layedit = layui.layedit
        , laydate = layui.laydate
        , jq = layui.jquery
        , upload = layui.upload;
    var storage=window.localStorage;
    var userData = storage.getItem("userData");
    var headerParams = JSON.parse(userData);
    //创建编辑器
    let uploadInst = [];

    //监听指定开关
    form.on('switch(switchTest)', function (data) {
        layer.msg('开关checked：' + (this.checked ? 'true' : 'false'), {
            offset: '6px'
        });
        layer.tips('温馨提示：请注意开关状态的文字可以随意定义，而不仅仅是ON|OFF', data.othis)
    });
    //监听提交
    form.on('submit(*)', function (data) {
        console.log(data.elem) //被执行事件的元素DOM对象，一般为button对象
        console.log(data.form) //被执行提交的form对象，一般在存在form标签时才会返回
        console.log(data.field) //当前容器的全部表单字段，名值对形式：{name: value}
        let url = "<?=Url::to(['/common/dangyuan/edit']);?>";
        jq.ajax({
            type: "post",
            url:url,
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
                    layer.msg(result.msg);
                    setTimeout(function () {
                        window.history.go(-1)
                    }, 1000);
                } else if(result.code == 5001) {
                    layer.alert('登录状态异常', {icon: 2}, function(index){
                        top.location.href="../user/login";
                    });
                } else {
                    return layer.msg(result.msg);
                }
            },
            error: function () {
                layer.alert('网络环境异常请检查', {icon: 2});
            }
        });
        return false; //阻止表单跳转。如果需要表单跳转，去掉这段即可。
    });
    var organizationHtml = "";
    <?php
    if(isset($treeData) && !empty($treeData)) {
    $flag = 0;
    foreach($treeData as $treeInfo) {
    if(isset($organization_id) && $treeInfo['id']==$organization_id) {
    $flag = 1;
    } else if(isset($organization_id) && $organization_id==0){
    $flag = 1;
    } else {
    $flag = 0;
    }
    ?>
    organizationHtml+='<option value="<?=isset($treeInfo['id']) ? $treeInfo['id'] : 0;?>" <?=$flag==0 ? 'disabled="disabled"' : "";?> ><?=isset($treeInfo['flag']) ? $treeInfo['flag'] : "";?><?=isset($treeInfo['title']) ? $treeInfo['title'] : "";?></option>';
    <?php
            }
        }
    ?>
    var levelHtml = "";
    <?php
    if(isset($levelData) && !empty($levelData)) {
    foreach($levelData as $levelInfo) {
    ?>
    levelHtml+='<option value="<?=isset($levelInfo['id']) ? $levelInfo['id'] : 0;?>"><?=isset($levelInfo['title']) ? $levelInfo['title'] : "";?></option>';
    <?php
            }
        }
    ?>
    jq('#addDepBtn').click(function () {
        var i = jq('.dep-item').length;
        i++;
        console.log(i)
        var html = '<div class="layui-form-item dep-item">\n' +
            '                <label class="layui-form-label">账号手机号' + i + '</label>\n' +
            '                <div class="layui-input-inline">\n' +
'<input type="text" name="mobile[]['+i+']" value="" class="layui-input" onblur=\'javaScript:checkoutUser(this.value,"<?=isset($organization_id) ? $organization_id : "";?>");\'>\n' +
            '                </div>\n' +
            '                <label class="layui-form-label">所在党组织' + i + '</label>\n' +
            '                <div class="layui-input-inline" style="width: 200px;">\n' +
            '                    <select name="department[]['+i+']">\n' +
            '                        \n' +
            '                        <option value="0">请选择党组织</option>\n' +
            organizationHtml +
            '                    </select>\n' +
            '                </div>\n' +
            '\n' +
            '                <label class="layui-form-label" style="width: 30px;">职务</label>\n' +
            '                <div class="layui-input-inline">\n' +
            '                    <select name="level[]['+i+']">\n' +
            levelHtml+
            '                    </select>\n' +
            '                </div>\n' +

            '                <label class="layui-form-label" style="width: 30px;">党费</label>\n' +
            '                <div class="layui-input-inline">\n' +
            '<input type="text" name="paid_up[]['+i+']" value="" class="layui-input">\n' +
            '                </div>\n' +
            '                <a href="javascript:void(0);" class="layui-btn del-dep-btn">-</a>\n' +
            '            </div>'
        jq('#addDepBtnItem').before(html);
        form.render('select');
    });

});
//输入框的值改变时触发
function checkoutUser(date,organization_id) {
    var form = layui.form;
    var $ = layui.jquery;
    var storage=window.localStorage;
    var userData = storage.getItem("userData");
    var headerParams = JSON.parse(userData);
    var params = {};
    params.username = date;
    params.organization_id = organization_id;
    let url = "<?=Url::to(['/common/dangyuan/check-is-add']);?>";
    $.ajax({
        type: "post",
        url:url,
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
                return true;
            } else if(result.code == 5001) {
                layer.alert('登录状态异常', {icon: 2}, function(index){
                    top.location.href="../user/login";
                });
            } else {
                return layer.msg(result.msg);
            }
        },
        error: function () {
            layer.alert('网络环境异常请检查', {icon: 2});
        }
    });
}
</script>
</body></html>