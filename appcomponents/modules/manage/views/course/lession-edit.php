<?php
use yii\helpers\Url;
use \yii\helpers\Html;
/* @var $this yii\web\View */
?>
<!–[if lt IE9]>
<?=Html::jsFile('@web/static/exam/styles/js/html5.js?v='.date("ymd"), ['type' => "text/javascript"])?>
<![endif]–>
<style>
    .btn{display:inline-block;*display:inline;*zoom:1;padding:4px 12px;margin-bottom:0;font-size:14px;line-height:20px;text-align:center;vertical-align:middle;cursor:pointer;color:#333333;text-shadow:0 1px 1px rgba(255, 255, 255, 0.75);background-color:#f5f5f5;background-image:-moz-linear-gradient(top, #ffffff, #e6e6e6);background-image:-webkit-gradient(linear, 0 0, 0 100%, from(#ffffff), to(#e6e6e6));background-image:-webkit-linear-gradient(top, #ffffff, #e6e6e6);background-image:-o-linear-gradient(top, #ffffff, #e6e6e6);background-image:linear-gradient(to bottom, #ffffff, #e6e6e6);background-repeat:repeat-x;filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffffff', endColorstr='#ffe6e6e6', GradientType=0);border-color:#e6e6e6 #e6e6e6 #bfbfbf;border-color:rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);*background-color:#e6e6e6;filter:progid:DXImageTransform.Microsoft.gradient(enabled = false);border:1px solid #cccccc;*border:0;border-bottom-color:#b3b3b3;-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px;*margin-left:.3em;-webkit-box-shadow:inset 0 1px 0 rgba(255,255,255,.2), 0 1px 2px rgba(0,0,0,.05);-moz-box-shadow:inset 0 1px 0 rgba(255,255,255,.2), 0 1px 2px rgba(0,0,0,.05);box-shadow:inset 0 1px 0 rgba(255,255,255,.2), 0 1px 2px rgba(0,0,0,.05);}.btn:hover,.btn:focus,.btn:active,.btn.active,.btn.disabled,.btn[disabled]{color:#333333;background-color:#e6e6e6;*background-color:#d9d9d9;}
    .btn:active,.btn.active{background-color:#cccccc \9;}
    .btn:first-child{*margin-left:0;}
    .btn:hover,.btn:focus{color:#333333;text-decoration:none;background-position:0 -15px;-webkit-transition:background-position 0.1s linear;-moz-transition:background-position 0.1s linear;-o-transition:background-position 0.1s linear;transition:background-position 0.1s linear;}
    .btn:focus{outline:thin dotted #333;outline:5px auto -webkit-focus-ring-color;outline-offset:-2px;}
    .btn.active,.btn:active{background-image:none;outline:0;-webkit-box-shadow:inset 0 2px 4px rgba(0,0,0,.15), 0 1px 2px rgba(0,0,0,.05);-moz-box-shadow:inset 0 2px 4px rgba(0,0,0,.15), 0 1px 2px rgba(0,0,0,.05);box-shadow:inset 0 2px 4px rgba(0,0,0,.15), 0 1px 2px rgba(0,0,0,.05);}
    .btn.disabled,.btn[disabled]{cursor:default;background-image:none;opacity:0.65;filter:alpha(opacity=65);-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none;}
</style>
<div class="layui-card">
    <div class="layui-card-body">
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span10" id="datacontent">
                    <button class="layui-btn layui-btn-sm" onclick="window.history.go(-1);">返回</button>
                    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
                        <legend><?= Html::encode($title ? $title : (isset($this->title) ? $this->title : null)) ?></legend>
                    </fieldset>
                    <form autocomplete="off" class="layui-form" onsubmit="return false;" data-auto="true" action="#">
                        <input type="hidden" name="id" class="layui-input" value="<?=isset($dataInfo['id']) ? $dataInfo['id']:"";?>">
                        <div class="layui-form-item">
                            <label class="layui-form-label"><span class="require-text">*</span>课件名称</label>
                            <div class="layui-input-inline">
                                <input type="text" name="title" lay-verify="title" autocomplete="off" placeholder="请输入课件名称至少2个字符" class="layui-input" value="<?=isset($dataInfo['title']) ? $dataInfo['title']:"";?>">
                            </div>
                            <div class="layui-form-mid layui-word-aux">在微党课上显示的课程课件对应的课件名称</div>
                        </div>

                        <div class="layui-form-item">
                            <label class="layui-form-label">
                                <span class="require-text">*</span>是否上线
                            </label>
                            <div class="layui-input-inline">
                                <input type="radio" name="status" value="1" title="是" <?=(isset($dataInfo['status'])&&$dataInfo['status']) ? "checked='checked'":"checked='checked'";?>>
                                <input type="radio" name="status" value="0" title="否" <?=(isset($dataInfo['status'])&&$dataInfo['status']==0) ? "checked='checked'":"";?>>
                            </div>
                        </div>

                        <div class="layui-form-item">
                            <label class="layui-form-label"><span class="require-text">*</span>课件选择</label>
                            <div class="layui-input-inline">
                                <button type="button" class="layui-btn" id="Updatefile">
                                    <i class="layui-icon">&#xe67c;</i>上传PDF文件
                                </button>
                            </div>
                        </div>
                        <input type="hidden" id="Jfile" name="file" class="layui-input" value="<?=isset($dataInfo['file']) ? $dataInfo['file']:"";?>">
                        <input type="hidden" name="size" class="layui-input" value="<?=isset($dataInfo['size']) ? $dataInfo['size']:"";?>">
                        <div class="layui-form-item">
                            <div class="layui-input-block">
                                <button type="submit" class="layui-btn" lay-submit="" lay-filter="submitLevel">立即提交</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="application/javascript">
    layui.use(['form', 'table', 'layer','upload'], function(){
        var table = layui.table
            ,form = layui.form
            ,jq = layui.jquery
            ,$ = layui.jquery;
        var upload = layui.upload;
        var storage=window.localStorage;
        var userData = storage.getItem("userData");
        var headerParams = JSON.parse(userData);
        //自定义验证规则
        form.verify({
            title: function(value){
                if(value.length < 2){
                    return '考题名称至少2个字符！';
                }
            }
        });
        //执行实例
        upload.render({
            elem: '#Updatefile' //绑定元素
            ,url: '/common/upload/ali-file'
            ,auto: true //选择文件后不自动上传
            ,multiple: true
            ,accept: 'file'
            ,acceptMime: 'file/*'
            ,exts: 'pdf|world'
            ,size: 1024 * 10
            ,choose: function(obj){
                obj.preview(function (index, file, result) {
                    var title = $('input[name="title"]').val();
                    if(title==undefined || title=="" || title==null) {
                        var filename = file.name.substring(0,file.name.lastIndexOf("."));
                        $('input[name="title"]').val(filename);
                    }
                    var size = file.size/(1024*1024);
                    alert(size);
                    $('input[name="size"]').val(size.toFixed(2));
                    alert($('input[name="size"]').val());
                });
            }
            ,before: function(obj){
                layer.msg("文件上传中", {
                    time: 2000,
                    shade: 0.6
                });
            }
            ,done: function(res){
                //假设code=0代表上传成功
                if(res.code == 0){
                    $("#Jfile").val(res.data.src)
                }
                layer.closeAll();
            }
            ,error: function(){
                //请求异常回调
            }
        });
        //监听提交
        form.on('submit(submitLevel)', function(data){
            $.ajax({
                type: "post",
                url: "<?= Url::to(['common/lession/edit']); ?>",
                contentType: "application/json;charset=utf-8",
                data: JSON.stringify(data.field),
                dataType: "json",
                beforeSend: function (XMLHttpRequest) {
                    for (var i in headerParams) {
                        XMLHttpRequest.setRequestHeader(i, headerParams[i]);
                    }
                },
                success: function (result) {
                    if (result.code == 0) {
                        layer.msg(result.msg, {
                            time: 2000,
                            shade: 0.6
                        },function(){
                            window.history.go(-1);
                        });
                        return true;
                    } else if(result.code == 5001){
                        layer.msg(result.msg, {
                            icon: 2,
                            shade: 0.6,
                            time: 2000 //2秒关闭（如果不配置，默认是3秒）
                        }, function(){
                            top.location.href="../user/login"
                        });
                        return true;
                    } else {
                        layer.msg(result.msg, {
                            time: 2000,
                            shade: 0.6,
                            icon: 2
                        });
                        return true;
                    }
                },
                error: function () {
                    layer.msg("系统异常", {
                        time: 2000,
                        shade: 0.6,
                        icon: 2
                    });
                    return true;
                }
            })
            return false;
        });
        form.render(); //更新全部，防止input多选和单选框不显示问题
    });
</script>