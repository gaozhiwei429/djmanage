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
    .layui-form-label {
        width: 100px;
    }
    .layui-input-block {
        margin-left: 130px;
    }
    .require-text {
        color:#DC524B;
    }
</style>
<!--[if lt IE 9]>
<script src="__CSS__/html5shiv.min.js"></script>
<script src="__CSS__/respond.min.js"></script>
<![endif]-->
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
            <script>
                let renderArr = [];
            </script>
            <div class="layui-form-item">
                <label class="layui-form-label">头像</label>
                <div class="layui-input-block">
                    <div class="layui-input-inline">
                        <input type="text" name="avatar_img" placeholder="" class="layui-input" id="input1">
                    </div>
                    <div class="layui-upload">
                        <button type="button" class="layui-btn layui-btn-sm" id="layui-btn1">上传图片</button><input class="layui-upload-file" type="file" accept="undefined" name="file">
                        <div class="layui-upload-list">
                            <a target="_blank" href="">
                                <img class="layui-upload-img" id="layui-upload-img1" style="display:none;" src="">
                            </a>
                            <p id="text1"></p>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                renderArr.push({
                    type: 'image',
                    btnId: '#layui-btn1',
                    imgId: '#layui-upload-img1',
                    textId: '#text1',
                    inputId: '#input1',
                    aId: '#layui-upload-a1'
                });
            </script>
            <div class="layui-form-item">
                <label class="layui-form-label">
                    <span class="require-text">*</span>
                    姓名
                </label>
                <div class="layui-input-inline">
                    <input type="text" name="nickname" lay-verify="" placeholder="" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">
                    <span class="require-text">*</span>
                    手机号
                </label>
                <div class="layui-input-inline">
                    <input type="text" name="mobile" lay-verify="" placeholder="" class="layui-input" autocomplete="new-password">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">
                    <span class="require-text">*</span>
                    密码
                </label>
                <div class="layui-input-inline">
                    <input type="password" autocomplete="new-password" name="password" placeholder="如不修改密码请留空" value="" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">
                    <span class="require-text">*</span>
                    确认密码
                </label>
                <div class="layui-input-inline">
                    <input type="password" autocomplete="new-password" name="confirm_password" placeholder="如不修改密码请留空" value="" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item" id="addDepBtnItem">
                <label class="layui-form-label">
                    <span class="require-text">*</span>
                    添加所在部门
                </label>
                <div class="layui-input-inline" style="width: auto;">
                    <a href="javascript:void(0);" title="增加部门" id="addDepBtn" class="layui-btn layui-btn-primary">+</a>
                </div>
                <div class="layui-form-mid layui-word-aux">最少添加一个所在部门</div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">
                    <span class="require-text">*</span>
                    性别
                </label>
                <div class="layui-input-block">
                    <input type="radio" name="sex" value="0" title="保密"><div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i><div>保密</div></div>
                    <input type="radio" name="sex" value="1" title="男" checked="checked"><div class="layui-unselect layui-form-radio layui-form-radioed"><i class="layui-anim layui-icon"></i><div>男</div></div>
                    <input type="radio" name="sex" value="2" title="女"><div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i><div>女</div></div>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">
                    <span class="require-text">*</span>
                    民族
                </label>
                <div class="layui-input-inline">
                    <select name="nation">
                        <option value="" selected="selected">请选择民族</option>
                        <option value="汉族">汉族</option>
                        <option value="蒙古族">蒙古族</option>
                        <option value="回族">回族</option>
                        <option value="藏族">藏族</option>
                        <option value="维吾尔族">维吾尔族</option>
                        <option value="苗族">苗族</option>
                        <option value="彝族">彝族</option>
                        <option value="壮族">壮族</option>
                        <option value="布依族">布依族</option>
                        <option value="朝鲜族">朝鲜族</option>
                        <option value="满族">满族</option>
                        <option value="侗族">侗族</option>
                        <option value="瑶族">瑶族</option>
                        <option value="白族">白族</option>
                        <option value="土家族">土家族</option>
                        <option value="哈尼族">哈尼族</option>
                        <option value="哈萨克族">哈萨克族</option>
                        <option value="傣族">傣族</option>
                        <option value="黎族">黎族</option>
                        <option value="傈僳族">傈僳族</option>
                        <option value="佤族">佤族</option>
                        <option value="畲族">畲族</option>
                        <option value="高山族">高山族</option>
                        <option value="拉祜族">拉祜族</option>
                        <option value="水族">水族</option>
                        <option value="东乡族">东乡族</option>
                        <option value="纳西族">纳西族</option>
                        <option value="景颇族">景颇族</option>
                        <option value="柯尔克孜族">柯尔克孜族</option>
                        <option value="土族">土族</option>
                        <option value="达斡尔族">达斡尔族</option>
                        <option value="仫佬族">仫佬族</option>
                        <option value="羌族">羌族</option>
                        <option value="布朗族">布朗族</option>
                        <option value="撒拉族">撒拉族</option>
                        <option value="毛难族">毛难族</option>
                        <option value="仡佬族">仡佬族</option>
                        <option value="锡伯族">锡伯族</option>
                        <option value="阿昌族">阿昌族</option>
                        <option value="普米族">普米族</option>
                        <option value="塔吉克族">塔吉克族</option>
                        <option value="怒族">怒族</option>
                        <option value="乌孜别克族">乌孜别克族</option>
                        <option value="俄罗斯族">俄罗斯族</option>
                        <option value="鄂温克族">鄂温克族</option>
                        <option value="崩龙族">崩龙族</option>
                        <option value="保安族">保安族</option>
                        <option value="裕固族">裕固族</option>
                        <option value="京族">京族</option>
                        <option value="塔塔尔族">塔塔尔族</option>
                        <option value="独龙族">独龙族</option>
                        <option value="鄂伦春族">鄂伦春族</option>
                        <option value="赫哲族">赫哲族</option>
                        <option value="门巴族">门巴族</option>
                        <option value="珞巴族">珞巴族</option>
                        <option value="基诺族">基诺族</option>
                    </select>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">
                    <span class="require-text">*</span>
                    籍贯
                </label>
                <div class="layui-input-inline">
                    <input type="text" name="native_place" lay-verify="" placeholder="请填写籍贯" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">
                    <span class="require-text">*</span>
                    学历
                </label>
                <div class="layui-input-inline">
                    <select name="education">
                        <option value="" selected="selected">请选择学历</option>
                        <option value="1">小学</option>
                        <option value="2">初中</option>
                        <option value="3">高中（中专）</option>
                        <option value="4">大专</option>
                        <option value="5">大学</option>
                        <option value="6">硕士</option>
                        <option value="7">博士</option>
                        <option value="8">博士以上</option>
                        <option value="9">其他</option>
                    </select>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">
                    <span class="require-text">*</span>
                    入党时间
                </label>
                <div class="layui-input-inline">
                    <input type="text" name="join_organization_date" placeholder="入党时间" class="layui-input" id="LAY_date57" lay-key="1">
                </div>
            </div>
            <script>
                renderArr.push({type: 'date', id: '#LAY_date57'});
            </script>
            <div class="layui-form-item">
                <label class="layui-form-label">
                    <span class="require-text">*</span>
                    申请入党时间
                </label>
                <div class="layui-input-inline">
                    <input type="text" name="apply_organization_date" placeholder="申请入党时间" class="layui-input" id="LAY_date58" lay-key="2">
                </div>
            </div>
            <script>
                renderArr.push({type: 'date', id: '#LAY_date58'});
            </script>
            <div class="layui-form-item">
                <label class="layui-form-label">
                    <span class="require-text">*</span>
                    党员状态
                </label>
                <div class="layui-input-block">
                    <input type="radio" name="work_status" value="1" title="在岗" checked="checked"><div class="layui-unselect layui-form-radio layui-form-radioed"><i class="layui-anim layui-icon"></i><div>在岗</div></div>
                    <input type="radio" name="work_status" value="2" title="调离"><div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i><div>调离</div></div>
                    <input type="radio" name="work_status" value="3" title="退休"><div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i><div>退休</div></div>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">
                    <span class="require-text">*</span>
                    用户状态
                </label>
                <div class="layui-input-block">
                    <input type="radio" name="user_status" value="1" title="正式党员" checked="checked"><div class="layui-unselect layui-form-radio layui-form-radioed"><i class="layui-anim layui-icon"></i><div>正式党员</div></div>
                    <input type="radio" name="user_status" value="2" title="预备党员"><div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i><div>预备党员</div></div>
                    <input type="radio" name="user_status" value="3" title="入党积极分子"><div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i><div>入党积极分子</div></div>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">
                    <!-- <span class="require-text">*</span> -->
                    账号状态
                </label>
                <div class="layui-input-block">
                    <input type="radio" name="status" value="0" title="关闭" checked="checked"><div class="layui-unselect layui-form-radio layui-form-radioed"><i class="layui-anim layui-icon"></i><div>关闭</div></div>
                    <input type="radio" name="status" value="1" title="开启"><div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i><div>开启</div></div>
                </div>
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
    renderArr.forEach(function (v, i) {
        if (v.type == 'editor') {
            //编辑器
            renderArr[i].editIndex = layedit.build(v.id, {
                uploadImage: {
                    url: '/common/upload/ali-file', type: 'post'
                }
            });
        } else if (v.type == 'date') {
            console.log(v)
            //日期
            laydate.render({
                elem: v.id
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
                , url: '/common/upload/ali-file'
                , before: function (obj) {
                    //预读本地文件示例，不支持ie8
                    obj.preview(function (index, file, result) {
                        jq(v.imgId).attr('src', result); //图片链接（base64）
                    });
                }
                , done: function (res) {
                //如果上传失败
                    if (res.code != 0) {
                        return layer.msg('上传失败！' + res.msg);
                    }
                    //上传成功
                    jq(v.inputId).val(res.data.src);
                    jq(v.imgId).attr('src', res.data.src).show();
                    jq(v.aId).attr('href', res.data.src);
                }
                , error: function () {
                    //演示失败状态，并实现重传
                    var demoText = jq(v.textId);
                    demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-xs demo-reload">重试</a>');
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
                        return layer.msg('上传失败！' + res.msg);
                    }
                    //上传成功
                    jq(v.inputId).val(res.path)
                }
                , error: function () {
                    //演示失败状态，并实现重传
                    var demoText = jq(v.textId);
                    demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-xs demo-reload">重试</a>');
                }
            });
        }
    });
    console.log('renderArr', renderArr)
    //自定义验证规则
    form.verify({
        title: function (value) {
            if (value.length < 5) {
                return '标题至少得5个字符啊';
            }
        }
        , pass: [
            /^[\S]{6,12}$/
            , '密码必须6到12位，且不能出现空格'
        ]
        , content: function (value) {
            renderArr.forEach(function (v, i) {
                if (v.type == 'editor') {
                    layedit.sync(i);
                }
            });
            //layedit.sync(editIndex);
        }
    });
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
    //表单初始赋值
    form.val('example', {
        "username": "贤心" // "name": "value"
        , "password": "123456"
        , "interest": 1
        , "like[write]": true //复选框选中状态
        , "close": true //开关状态
        , "sex": "女"
        , "desc": "我爱 layui"
    });
    //多图片上传
    upload.render({
        elem: '#test2'
        , url: '/common/upload/ali-file'
        , multiple: true
        , before: function (obj) {
            //预读本地文件示例，不支持ie8
            obj.preview(function (index, file, result) {
                $('#demo2').append('<img src="' + result + '" alt="' + file.name + '" class="layui-upload-img">')
            });
        }
        , done: function (res) {
            //上传完毕
        }
    });
    var organizationHtml = "";
    <?php
    if(isset($treeData) && !empty($treeData)) {
    foreach($treeData as $treeInfo) {
    ?>
    organizationHtml+='<option value="<?=isset($treeInfo['id']) ? $treeInfo['id'] : 0;?>"><?=isset($treeInfo['flag']) ? $treeInfo['flag'] : "";?><?=isset($treeInfo['title']) ? $treeInfo['title'] : "";?></option>';
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
            '                <label class="layui-form-label">所在部门' + i + '</label>\n' +
            '                <div class="layui-input-inline" style="width: 300px;">\n' +
            '                    <select name="department[]['+i+']">\n' +
            '                        \n' +
            '                        <option value="0">请选择部门</option>\n' +
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
            '                <a href="javascript:void(0);" class="layui-btn del-dep-btn">-</a>\n' +
            '            </div>'
        jq('#addDepBtnItem').before(html);
        form.render('select');
    });
    jq('body').on('click', '.del-dep-btn', function () {
        console.log('del-dep-btn')
        jq(this).closest('.dep-item').remove();
    });
});
</script>
</body></html>