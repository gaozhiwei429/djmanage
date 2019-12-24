<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */
?>
<div class="layui-card">
    <div class="layui-header notselect">
        <div class="pull-left"><span><?= Html::encode($title ? $title : (isset($this->title) ? $this->title : null)) ?></span></div>
    </div>
</div>

<div class="layui-card-body">
    <form class="layui-form" action="">
        <input type="hidden" name="id" value="<?=isset($info['id']) ? $info['id']:"";?>" class="layui-input">
        <div class="layui-form-item layui-upload">
            <label class="layui-form-label">banner封面图</label>
            <div class="layui-upload layui-input-block">
                <input type="hidden" name="pic_url" value="<?=isset($info['pic_url']) ? $info['pic_url']:"";?>" required lay-verify="required" />
                <button type="button" class="layui-btn layui-btn-primary" id="fileBtn"><i class="layui-icon">&#xe67c;</i>选择文件</button>
                <button type="button" class="layui-btn layui-btn-warm" id="uploadBtn">开始上传</button>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">banner名称</label>
            <div class="layui-input-inline">
                <input type="text" name="title" value="<?=isset($info['title']) ? $info['title']:"";?>" lay-verify="title" autocomplete="off" placeholder="请输入banner名称" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-inline">
                <label class="layui-form-label">排序</label>
                <div class="layui-input-inline">
                    <input type="text" name="sort" value="<?=isset($info['sort']) ? $info['sort']:"";?>" lay-verify="required|number" autocomplete="off" placeholder="请输入排序值" class="layui-input">
                </div>
            </div>
        </div>

        <div class="layui-form-item">
            <div class="layui-inline">
                <label class="layui-form-label">过期时间</label>
                <div class="layui-input-inline">
                    <input type="text" name="overdue_time" id="date" value="<?=isset($info['overdue_time']) ? date('Y-m-d', strtotime($info['overdue_time'])):"";?>" lay-verify="date" placeholder="yyyy-MM-dd" autocomplete="off" class="layui-input">
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-inline">
                <label class="layui-form-label">跳转链接</label>
                <div class="layui-input-inline">
                    <input type="text" name="url" class="layui-input" value="<?=isset($info['url']) ? $info['url']:"";?>">
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-inline">
                <label class="layui-form-label">新闻id</label>
                <div class="layui-input-inline">
                    <input type="text" name="news_id" class="layui-input" value="<?=(isset($info['news_id']) && $info['news_id']) ? $info['news_id']:"";?>" placeholder="请输入新闻id">
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">是否上线</label>
            <div class="layui-input-inline">
                <input type="radio" name="status" value="1" title="是" <?=(isset($info['status']) && $info['status']==1) ? "checked" : "";?>>
                <input type="radio" name="status" value="0" title="否" <?=(isset($info['status']) && $info['status']==0) ? "checked" : "";?>>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">选择模块</label>
            <div class="layui-input-inline">
                <div class="layui-unselect layui-form-select downpanel">
                    <div class="layui-select-title">
                        <select name="type">
                    <option value="0" <?=(isset($info['type']) && $info['type']==0) ? "selected" : "";?>>请选择</option>
                    <option value="1" <?=(isset($info['type']) && $info['type']==1) ? "selected" : "";?>>首页</option>
                    <option value="2" <?=(isset($info['type']) && $info['type']==2) ? "selected" : "";?>>学习</option>
                    <option value="3" <?=(isset($info['type']) && $info['type']==3) ? "selected" : "";?>>组织</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>
</div>

<script>
    layui.use(['form', 'table', 'laypage', 'layer', 'upload','laydate'], function(){
    var form = layui.form;
    var storage=window.localStorage;
    var $ = layui.jquery
        ,upload = layui.upload
        ,layer = layui.layer;
    var laydate = layui.laydate;
    //常规用法
    laydate.render({
        elem: '#date'
    });
    var userData = storage.getItem("userData");
    var headerParams = JSON.parse(userData);
    //监听提交
    var params = {};
    var selfUrl = window.location.href;
    var id = "<?=isset($id) ? $id : 0;?>";
    if(id>0) {
        params.id=id;
    }
    //图片上传
    layui.use('upload',function(){
        upload.render({
            elem: '#fileBtn'
            ,url: '/common/upload/ali-file'
            ,accept: 'image'
            ,acceptMime: 'image/*'
            ,exts: 'jpg|png|gif|bmp|jpeg'
            ,size: 1024 * 10
            ,auto: false
            ,bindAction: '#uploadBtn'
            ,choose: function(obj) {
                obj.preview(function(index, file, result) {
                    var img = new Image();
                    img.onload = function() {
                        if ((img.width/img.height) > 1.7) {
                            layer.msg('图片尺寸【长/高】比例不能大于1.7');
                        }
                    };
                    img.src = result;
                });
            },
            before: function(obj) {
                layer.load();
            }
            ,done: function(res){
                layer.closeAll('loading');
                $("[name=pic_url]").val(res.data.src);
            }
        });
    });
    //监听提交
    form.on('submit(formDemo)', function(data){
        var r = /^\+?[1-9][0-9]*$/;　　//判断是否为正整数
        if(data.field.news_id.length > 0 && !r.test(data.field.news_id)){
            layer.msg("请输入正确的新闻id", {
                icon: 2,
                time: 2000 //2秒关闭（如果不配置，默认是3秒）
            });
            return false;
        }
        var prg = /^(?:http(s)?:\/\/)?[\w.-]+(?:\.[\w\.-]+)+[\w\-\._~:/?#[\]@!\$&'\*\+,;=.]+$/;
        if(data.field.url.length > 0 &&  !prg.test(data.field.url)){
            layer.msg("请输入正确的url", {
                icon: 2,
                time: 2000 //2秒关闭（如果不配置，默认是3秒）
            });
            return false;
        }
        $.ajax({
            type: "post",
            url:"<?= Url::to(['common/banner/edit']); ?>",
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
                        time: 2000 //2秒关闭（如果不配置，默认是3秒）
                    }, function(){
                        window.history.back();
                    });
                } else if(result.code == 5001) {
                    layer.msg(result.msg, {
                        icon: 2,
                        time: 2000 //2秒关闭（如果不配置，默认是3秒）
                    }, function(){
                        top.location.href="../user/login"
                    });
                }else {
                    layer.msg(result.msg, {
                        icon: 2,
                        time: 2000 //2秒关闭（如果不配置，默认是3秒）
                    });
                    return false;
                }
            },
            error: function () {
                layer.msg("网络异常！", {
                    icon: 1,
                    time: 2000 //2秒关闭（如果不配置，默认是3秒）
                });
                return false;
            }
        });
        return false;
    });
    form.render(); //更新全部，防止input多选和单选框不显示问题
});
</script>