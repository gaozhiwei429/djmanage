<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
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

<div class="layui-card">
    <div class="layui-header notselect">
        <button class="layui-btn layui-btn-sm" onclick="window.history.go(-1);">返回</button>
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>添加用户</legend>
        </fieldset>
        <form autocomplete="off" class="layui-form" onsubmit="return false;" data-auto="true" action="#">
            <div class="layui-form-item">
                <label class="layui-form-label">头像</label>
                <div class="layui-input-inline">
                    <input type="text" name="avatar_img" placeholder="" class="layui-input" id="input1" value="<?=isset($passportInfo['avatar_img']) ? $passportInfo['avatar_img'] :"";?>">
                </div>
                <div class="layui-upload">
                    <button type="button" class="layui-btn layui-btn-sm" id="layui-btn1">上传图片</button><input class="layui-upload-file" type="file" accept="undefined" name="file">
                        <img class="layui-upload-img" id="layui-upload-img1" <?=(isset($passportInfo['avatar_img']) && $passportInfo['avatar_img']) ? '' :'style="display:none;""';?> src="<?=isset($passportInfo['avatar_img']) ? $passportInfo['avatar_img'] :"";?>">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">
                    <span class="require-text">*</span>
                    姓名
                </label>
                <div class="layui-input-inline">
                    <input type="text" name="full_name" lay-verify="" placeholder="" class="layui-input" value="<?=isset($passportInfo['full_name']) ? $passportInfo['full_name'] :"";?>">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label"><span class="require-text">*</span>昵称</label>
                <div class="layui-input-inline">
                    <input type="text" name="nickname" lay-verify="" placeholder="" class="layui-input" value="<?=isset($passportInfo['nickname']) ? $passportInfo['nickname'] :"";?>">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">
                    <span class="require-text">*</span>
                    手机号
                </label>
                <div class="layui-input-inline">
                    <input type="text" name="mobile" lay-verify="" placeholder="" class="layui-input" value="<?=isset($passportInfo['username']) ? $passportInfo['username'] :"";?>">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label"><span class="require-text">*</span>密码</label>
                <div class="layui-input-inline">
                    <input type="password" autocomplete="new-password" name="password" placeholder="如不修改密码请留空" value="" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label"><span class="require-text">*</span>确认密码</label>
                <div class="layui-input-inline">
                    <input type="password" autocomplete="new-password" name="confirm_password" placeholder="如不修改密码请留空" value="" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">
                    <span class="require-text">*</span>
                    性别
                </label>
                <div class="layui-input-block">
                    <input type="radio" name="sex" value="0" title="保密" <?=(isset($passportInfo['sex']) && $passportInfo['sex']==0) ? 'checked="checked"':"";?>><div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i><div>保密</div></div>
                    <input type="radio" name="sex" value="1" title="男" <?=(isset($passportInfo['sex']) && $passportInfo['sex']==1) ? 'checked="checked"':"";?>><div class="layui-unselect layui-form-radio layui-form-radioed"><i class="layui-anim layui-icon"></i><div>男</div></div>
                    <input type="radio" name="sex" value="2" title="女" <?=(isset($passportInfo['sex']) && $passportInfo['sex']==2) ? 'checked="checked"':"";?>><div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i><div>女</div></div>
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
                        <option value="汉族" <?=(isset($passportInfo['nation']) && $passportInfo['nation']=="汉族") ? 'selected="selected"' :"";?>>汉族</option>
                        <option value="蒙古族" <?=(isset($passportInfo['nation']) && $passportInfo['nation']=="蒙古族") ? 'selected="selected"' :"";?>>蒙古族</option>
                        <option value="回族" <?=(isset($passportInfo['nation']) && $passportInfo['nation']=="回族") ? 'selected="selected"' :"";?>>回族</option>
                        <option value="藏族" <?=(isset($passportInfo['nation']) && $passportInfo['nation']=="藏族") ? 'selected="selected"' :"";?>>藏族</option>
                        <option value="维吾尔族" <?=(isset($passportInfo['nation']) && $passportInfo['nation']=="维吾尔族") ? 'selected="selected"' :"";?>>维吾尔族</option>
                        <option value="苗族" <?=(isset($passportInfo['nation']) && $passportInfo['nation']=="苗族") ? 'selected="selected"' :"";?>>苗族</option>
                        <option value="彝族" <?=(isset($passportInfo['nation']) && $passportInfo['nation']=="彝族") ? 'selected="selected"' :"";?>>彝族</option>
                        <option value="壮族" <?=(isset($passportInfo['nation']) && $passportInfo['nation']=="壮族") ? 'selected="selected"' :"";?>>壮族</option>
                        <option value="布依族" <?=(isset($passportInfo['nation']) && $passportInfo['nation']=="布依族") ? 'selected="selected"' :"";?>>布依族</option>
                        <option value="朝鲜族" <?=(isset($passportInfo['nation']) && $passportInfo['nation']=="朝鲜族") ? 'selected="selected"' :"";?>>朝鲜族</option>
                        <option value="满族" <?=(isset($passportInfo['nation']) && $passportInfo['nation']=="满族") ? 'selected="selected"' :"";?>>满族</option>
                        <option value="侗族" <?=(isset($passportInfo['nation']) && $passportInfo['nation']=="侗族") ? 'selected="selected"' :"";?>>侗族</option>
                        <option value="瑶族" <?=(isset($passportInfo['nation']) && $passportInfo['nation']=="瑶族") ? 'selected="selected"' :"";?>>瑶族</option>
                        <option value="白族" <?=(isset($passportInfo['nation']) && $passportInfo['nation']=="白族") ? 'selected="selected"' :"";?>>白族</option>
                        <option value="土家族" <?=(isset($passportInfo['nation']) && $passportInfo['nation']=="土家族") ? 'selected="selected"' :"";?>>土家族</option>
                        <option value="哈尼族" <?=(isset($passportInfo['nation']) && $passportInfo['nation']=="哈尼族") ? 'selected="selected"' :"";?>>哈尼族</option>
                        <option value="哈萨克族" <?=(isset($passportInfo['nation']) && $passportInfo['nation']=="哈萨克族") ? 'selected="selected"' :"";?>>哈萨克族</option>
                        <option value="傣族" <?=(isset($passportInfo['nation']) && $passportInfo['nation']=="傣族") ? 'selected="selected"' :"";?>>傣族</option>
                        <option value="黎族" <?=(isset($passportInfo['nation']) && $passportInfo['nation']=="黎族") ? 'selected="selected"' :"";?>>黎族</option>
                        <option value="傈僳族" <?=(isset($passportInfo['nation']) && $passportInfo['nation']=="傈僳族") ? 'selected="selected"' :"";?>>傈僳族</option>
                        <option value="佤族" <?=(isset($passportInfo['nation']) && $passportInfo['nation']=="佤族") ? 'selected="selected"' :"";?>>佤族</option>
                        <option value="畲族" <?=(isset($passportInfo['nation']) && $passportInfo['nation']=="畲族") ? 'selected="selected"' :"";?>>畲族</option>
                        <option value="高山族" <?=(isset($passportInfo['nation']) && $passportInfo['nation']=="高山族") ? 'selected="selected"' :"";?>>高山族</option>
                        <option value="拉祜族" <?=(isset($passportInfo['nation']) && $passportInfo['nation']=="拉祜族") ? 'selected="selected"' :"";?>>拉祜族</option>
                        <option value="水族" <?=(isset($passportInfo['nation']) && $passportInfo['nation']=="水族") ? 'selected="selected"' :"";?>>水族</option>
                        <option value="东乡族" <?=(isset($passportInfo['nation']) && $passportInfo['nation']=="东乡族") ? 'selected="selected"' :"";?>>东乡族</option>
                        <option value="纳西族" <?=(isset($passportInfo['nation']) && $passportInfo['nation']=="纳西族") ? 'selected="selected"' :"";?>>纳西族</option>
                        <option value="景颇族" <?=(isset($passportInfo['nation']) && $passportInfo['nation']=="景颇族") ? 'selected="selected"' :"";?>>景颇族</option>
                        <option value="柯尔克孜族" <?=(isset($passportInfo['nation']) && $passportInfo['nation']=="柯尔克孜族") ? 'selected="selected"' :"";?>>柯尔克孜族</option>
                        <option value="土族" <?=(isset($passportInfo['nation']) && $passportInfo['nation']=="土族") ? 'selected="selected"' :"";?>>土族</option>
                        <option value="达斡尔族" <?=(isset($passportInfo['nation']) && $passportInfo['nation']=="达斡尔族") ? 'selected="selected"' :"";?>>达斡尔族</option>
                        <option value="仫佬族" <?=(isset($passportInfo['nation']) && $passportInfo['nation']=="仫佬族") ? 'selected="selected"' :"";?>>仫佬族</option>
                        <option value="羌族" <?=(isset($passportInfo['nation']) && $passportInfo['nation']=="羌族") ? 'selected="selected"' :"";?>>羌族</option>
                        <option value="布朗族" <?=(isset($passportInfo['nation']) && $passportInfo['nation']=="布朗族") ? 'selected="selected"' :"";?>>布朗族</option>
                        <option value="撒拉族" <?=(isset($passportInfo['nation']) && $passportInfo['nation']=="撒拉族") ? 'selected="selected"' :"";?>>撒拉族</option>
                        <option value="毛难族" <?=(isset($passportInfo['nation']) && $passportInfo['nation']=="毛难族") ? 'selected="selected"' :"";?>>毛难族</option>
                        <option value="仡佬族" <?=(isset($passportInfo['nation']) && $passportInfo['nation']=="仡佬族") ? 'selected="selected"' :"";?>>仡佬族</option>
                        <option value="锡伯族" <?=(isset($passportInfo['nation']) && $passportInfo['nation']=="锡伯族") ? 'selected="selected"' :"";?>>锡伯族</option>
                        <option value="阿昌族" <?=(isset($passportInfo['nation']) && $passportInfo['nation']=="阿昌族") ? 'selected="selected"' :"";?>>阿昌族</option>
                        <option value="普米族" <?=(isset($passportInfo['nation']) && $passportInfo['nation']=="普米族") ? 'selected="selected"' :"";?>>普米族</option>
                        <option value="塔吉克族" <?=(isset($passportInfo['nation']) && $passportInfo['nation']=="塔吉克族") ? 'selected="selected"' :"";?>>塔吉克族</option>
                        <option value="怒族" <?=(isset($passportInfo['nation']) && $passportInfo['nation']=="怒族") ? 'selected="selected"' :"";?>>怒族</option>
                        <option value="乌孜别克族" <?=(isset($passportInfo['nation']) && $passportInfo['nation']=="乌孜别克族") ? 'selected="selected"' :"";?>>乌孜别克族</option>
                        <option value="俄罗斯族" <?=(isset($passportInfo['nation']) && $passportInfo['nation']=="俄罗斯族") ? 'selected="selected"' :"";?>>俄罗斯族</option>
                        <option value="鄂温克族" <?=(isset($passportInfo['nation']) && $passportInfo['nation']=="鄂温克族") ? 'selected="selected"' :"";?>>鄂温克族</option>
                        <option value="崩龙族" <?=(isset($passportInfo['nation']) && $passportInfo['nation']=="崩龙族") ? 'selected="selected"' :"";?>>崩龙族</option>
                        <option value="保安族" <?=(isset($passportInfo['nation']) && $passportInfo['nation']=="保安族") ? 'selected="selected"' :"";?>>保安族</option>
                        <option value="裕固族" <?=(isset($passportInfo['nation']) && $passportInfo['nation']=="裕固族") ? 'selected="selected"' :"";?>>裕固族</option>
                        <option value="京族" <?=(isset($passportInfo['nation']) && $passportInfo['nation']=="京族") ? 'selected="selected"' :"";?>>京族</option>
                        <option value="塔塔尔族" <?=(isset($passportInfo['nation']) && $passportInfo['nation']=="塔塔尔族") ? 'selected="selected"' :"";?>>塔塔尔族</option>
                        <option value="独龙族" <?=(isset($passportInfo['nation']) && $passportInfo['nation']=="独龙族") ? 'selected="selected"' :"";?>>独龙族</option>
                        <option value="鄂伦春族" <?=(isset($passportInfo['nation']) && $passportInfo['nation']=="鄂伦春族") ? 'selected="selected"' :"";?>>鄂伦春族</option>
                        <option value="赫哲族" <?=(isset($passportInfo['nation']) && $passportInfo['nation']=="赫哲族") ? 'selected="selected"' :"";?>>赫哲族</option>
                        <option value="门巴族" <?=(isset($passportInfo['nation']) && $passportInfo['nation']=="门巴族") ? 'selected="selected"' :"";?>>门巴族</option>
                        <option value="珞巴族" <?=(isset($passportInfo['nation']) && $passportInfo['nation']=="珞巴族") ? 'selected="selected"' :"";?>>珞巴族</option>
                        <option value="基诺族" <?=(isset($passportInfo['nation']) && $passportInfo['nation']=="基诺族") ? 'selected="selected"' :"";?>>基诺族</option>
                    </select>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">
                    <span class="require-text">*</span>
                    籍贯
                </label>
                <div class="layui-input-inline">
                    <input type="text" name="native_place" placeholder="请填写籍贯" class="layui-input" value="<?=isset($passportInfo['native_place']) ? $passportInfo['native_place'] :"";?>">
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
                        <option value="1" <?=(isset($passportInfo['education']) && $passportInfo['education']==1) ? 'selected="selected"' :"";?>>小学</option>
                        <option value="2" <?=(isset($passportInfo['education']) && $passportInfo['education']==2) ? 'selected="selected"' :"";?>>初中</option>
                        <option value="3" <?=(isset($passportInfo['education']) && $passportInfo['education']==3) ? 'selected="selected"' :"";?>>高中（中专）</option>
                        <option value="4" <?=(isset($passportInfo['education']) && $passportInfo['education']==4) ? 'selected="selected"' :"";?>>大专</option>
                        <option value="5" <?=(isset($passportInfo['education']) && $passportInfo['education']==5) ? 'selected="selected"' :"";?>>大学</option>
                        <option value="6" <?=(isset($passportInfo['education']) && $passportInfo['education']==6) ? 'selected="selected"' :"";?>>硕士</option>
                        <option value="7" <?=(isset($passportInfo['education']) && $passportInfo['education']==7) ? 'selected="selected"' :"";?>>博士</option>
                        <option value="8" <?=(isset($passportInfo['education']) && $passportInfo['education']==8) ? 'selected="selected"' :"";?>>博士以上</option>
                        <option value="9" <?=(isset($passportInfo['education']) && $passportInfo['education']==9) ? 'selected="selected"' :"";?>>其他</option>
                    </select>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">
                    <span class="require-text">*</span>
                    入党时间
                </label>
                <div class="layui-input-inline">
                    <input type="text" name="join_organization_date" placeholder="入党时间" class="layui-input" id="LAY_date57" value="<?=isset($passportInfo['join_organization_date']) ? $passportInfo['join_organization_date'] :"";?>">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">
                    <span class="require-text">*</span>
                    申请入党时间
                </label>
                <div class="layui-input-inline">
                    <input type="text" name="apply_organization_date" placeholder="申请入党时间" class="layui-input" id="LAY_date58" value="<?=isset($passportInfo['apply_organization_date']) ? $passportInfo['apply_organization_date'] :"";?>">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">
                    <span class="require-text">*</span>
                    党员状态
                </label>
                <div class="layui-input-block">
                    <input type="radio" name="organization_status" value="1" title="在岗" <?=(isset($passportInfo['organization_status']) && $passportInfo['organization_status']==1) ? 'checked="checked"':"";?>><div class="layui-unselect layui-form-radio layui-form-radioed"><i class="layui-anim layui-icon"></i><div>在岗</div></div>
                    <input type="radio" name="organization_status" value="2" title="调离" <?=(isset($passportInfo['organization_status']) && $passportInfo['organization_status']==2) ? 'checked="checked"':"";?>><div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i><div>调离</div></div>
                    <input type="radio" name="organization_status" value="3" title="退休" <?=(isset($passportInfo['organization_status']) && $passportInfo['organization_status']==2) ? 'checked="checked"':"";?>><div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i><div>退休</div></div>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">
                    <span class="require-text">*</span>
                    用户状态
                </label>
                <div class="layui-input-block">
                    <input type="radio" name="user_status" value="1" title="正式党员" <?=(isset($passportInfo['user_status']) && $passportInfo['user_status']==1) ? 'checked="checked"':"";?>><div class="layui-unselect layui-form-radio layui-form-radioed"><i class="layui-anim layui-icon"></i><div>正式党员</div></div>
                    <input type="radio" name="user_status" value="2" title="预备党员" <?=(isset($passportInfo['user_status']) && $passportInfo['user_status']==2) ? 'checked="checked"':"";?>><div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i><div>预备党员</div></div>
                    <input type="radio" name="user_status" value="3" title="入党积极分子" <?=(isset($passportInfo['user_status']) && $passportInfo['user_status']==3) ? 'checked="checked"':"";?>><div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i><div>入党积极分子</div></div>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">
                    <!-- <span class="require-text">*</span> -->
                    账号状态
                </label>
                <div class="layui-input-block">
                    <input type="radio" name="status" value="0" title="关闭" <?=(isset($passportInfo['status']) && $passportInfo['status']==0) ? 'checked="checked"':"";?>><div class="layui-unselect layui-form-radio layui-form-radioed"><i class="layui-anim layui-icon"></i><div>关闭</div></div>
                    <input type="radio" name="status" value="1" title="开启" <?=(isset($passportInfo['status']) && $passportInfo['status']==1) ? 'checked="checked"':"";?>><div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i><div>开启</div></div>
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

    laydate.render({
        elem: '#LAY_date57'
    });
    laydate.render({
        elem: '#LAY_date58'
    });
    upload.render({
        elem: '#layui-btn1'
        ,url: '/common/upload/ali-file'
        ,multiple: true
        ,accept: 'image'
        ,acceptMime: 'image/*'
        ,exts: 'jpg|png|gif|bmp|jpeg'
        ,size: 1024 * 10
        ,before: function(obj){
            layer.msg('图片上传中...', {
                icon: 16,
                shade: 0.01,
                time: 0
            })
        }
        ,done: function(res){
            layer.close(layer.msg());//关闭上传提示窗口
            //上传完毕
            $("#layui-upload-img1").attr("src",res.data.src);
            $('input[name="avatar_img"]').val(res.data.src);
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
        let url = "<?=Url::to(['/passport/user/edit']);?>";
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
    form.render();
});
</script>
</body></html>