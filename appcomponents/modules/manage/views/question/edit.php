<?php
use yii\helpers\Url;
use \yii\helpers\Html;
/* @var $this yii\web\View */
?>
<?=Html::cssFile('@web/static/dangjian/css/main.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
<?=Html::cssFile('@web/static/dangjian/css/form.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
<?=Html::cssFile('@web/static/dangjian/css/layer.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
<style>
    .layui-form-label {
        width: 100px;
        padding: 10px 15px 7px;
    }
    .layui-input-block {
        margin-left: 130px;
    }
    .require-text {
        color:#DC524B;
    }
    .layui-form-item .layui-input-inline {
        width: 195px;
    }
</style>
<div class="layui-card">
    <div class="layui-card-body">
        <div style="margin-bottom:0px;">
            <div class="admin-main layui-form layui-field-box">
                <!-- layui-btn-sm -->
                <button class="layui-btn layui-btn-sm" onclick="window.history.go(-1);">返回</button>
                <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
                    <legend>编辑考题</legend>
                </fieldset>

                <form autocomplete="off" class="layui-form" onsubmit="return false;" data-auto="true" action="#">
                    <input type="hidden" name="id" class="layui-input" value="<?=isset($dataInfo['id']) ? $dataInfo['id']:"";?>">
                    <div class="layui-form-item">
                        <label class="layui-form-label"><span class="require-text">*</span>考题名称</label>
                        <div class="layui-input-inline">
                            <input type="text" name="title" lay-verify="title" placeholder="请输入考题名称至少2个字符" class="layui-input" value=<?=isset($dataInfo['title']) ? $dataInfo['title']:"";?>>
                        </div>
                        <div class="layui-form-mid layui-word-aux">在所在党组织上显示的考题名称</div>
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
                        <label class="layui-form-label">
                            <span class="require-text">*</span>考题类型
                        </label>
                        <div class="layui-input-inline">
                            <select name="type" lay-verify="required" lay-search="" id="selectType"  lay-filter="selectType">
                                <option value="" <?=(isset($dataInfo['type']) && $dataInfo['type']==0) ? "selected":"";?>>类型选择</option>
                                <option value="1" <?=(isset($dataInfo['type']) && $dataInfo['type']==1) ? "selected":"";?>>单项选择</option>
                                <option value="2" <?=(isset($dataInfo['type']) && $dataInfo['type']==2) ? "selected":"";?>>多项选择</option>
                                <option value="3" <?=(isset($dataInfo['type']) && $dataInfo['type']==3) ? "selected":"";?>>判断</option>
                                <option value="4" <?=(isset($dataInfo['type']) && $dataInfo['type']==4) ? "selected":"";?>>解答</option>
                                <option value="5" <?=(isset($dataInfo['type']) && $dataInfo['type']==5) ? "selected":"";?>>填空</option>
                            </select>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">
                            <span class="require-text">*</span>难度
                        </label>
                        <div class="layui-input-inline">
                            <select class="combox" name="level" needle="needle" lay-verify="required" msg="您必须为要添加的试题设置一个难度">
                                <option value="1" <?=isset($dataInfo['level']) && $dataInfo['level']==1 ? "selected":"";?>>易</option>
                                <option value="2" <?=isset($dataInfo['level']) && $dataInfo['level']==2 ? "selected":"";?>>中</option>
                                <option value="3" <?=isset($dataInfo['level']) && $dataInfo['level']==3 ? "selected":"";?>>难</option>
                            </select>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">备选项</label>
                        <div class="layui-input-block">
                            <textarea id="layeditProblem" name="problem"><?=isset($dataInfo['problem']) ? $dataInfo['problem']:"";?></textarea>
                            <div class="layui-form-mid layui-word-aux">无选择项的请不要填写，如填空题、问答题等主观题。</div>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">参考答案：</label>
                        <div id="answerbox_1" class="answerbox">
                            <div class="layui-input-block">
                                <input type="radio" name="targs[questionanswer1]" value="A" <?=isset($dataInfo['answer']) &&$dataInfo['answer']=="A" ? "checked" : "";?>>A
                                <input type="radio" name="targs[questionanswer1]" value="B" <?=isset($dataInfo['answer']) &&$dataInfo['answer']=="B" ? "checked" : "";?>>B
                                <input type="radio" name="targs[questionanswer1]" value="C" <?=isset($dataInfo['answer']) &&$dataInfo['answer']=="C" ? "checked" : "";?>>C
                                <input type="radio" name="targs[questionanswer1]" value="D" <?=isset($dataInfo['answer']) &&$dataInfo['answer']=="D" ? "checked" : "";?>>D
                                <input type="radio" name="targs[questionanswer1]" value="E" <?=isset($dataInfo['answer']) &&$dataInfo['answer']=="E" ? "checked" : "";?>>E
                            </div>
                        </div>
                        <div id="answerbox_2" style="display:none;" class="answerbox">
                            <div class="layui-input-block">
                                <input type="checkbox" name="targs[questionanswer2][1]" value="A" <?=isset($dataInfo['answer']) && is_array($dataInfo['answer']) && in_array("A", $dataInfo['answer']) ? "checked" : "";?>>A
                                <input type="checkbox" name="targs[questionanswer2][2]" value="B" <?=isset($dataInfo['answer']) && is_array($dataInfo['answer']) && in_array("B", $dataInfo['answer']) ? "checked" : "";?>>B
                                <input type="checkbox" name="targs[questionanswer2][3]" value="C" <?=isset($dataInfo['answer']) && is_array($dataInfo['answer']) && in_array("C", $dataInfo['answer']) ? "checked" : "";?>>C
                                <input type="checkbox" name="targs[questionanswer2][4]" value="D" <?=isset($dataInfo['answer']) && is_array($dataInfo['answer']) && in_array("D", $dataInfo['answer']) ? "checked" : "";?>>D
                                <input type="checkbox" name="targs[questionanswer2][5]" value="E" <?=isset($dataInfo['answer']) && is_array($dataInfo['answer']) && in_array("E", $dataInfo['answer']) ? "checked" : "";?>>E
                            </div>
                        </div>
                        <div id="answerbox_3" class="answerbox" style="display:none;">
                            <div class="layui-input-inline">
                                <input type="radio" name="targs[questionanswer3]" value="A" <?=isset($dataInfo['answer']) && $dataInfo['answer']=="A" ? "checked" : "";?>>对
                                <input type="radio" name="targs[questionanswer3]" value="B" <?=isset($dataInfo['answer']) && $dataInfo['answer']=="B" ? "checked" : "";?>>错
                            </div>
                        </div>
                        <div id="answerbox_4" class="answerbox" style="display:none;">
                            <div class="layui-input-block">
                                <textarea cols="72" rows="7" id="layeditAnswer" name="targs[questionanswer4]"><?=isset($dataInfo['answer']) ? $dataInfo['answer']:"";?></textarea>
                            </div>
                        </div>
                        <div id="answerbox_5" class="answerbox" style="display:none;">
                            <div class="layui-input-block">
                                <input type="text" name="targs[questionanswer5]" autocomplete="off" placeholder="请输入答案" class="layui-input" value="<?=isset($dataInfo['answer']) ? $dataInfo['answer']:"";?>">
                            </div>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">习题解析</label>
                        <div class="layui-input-block">
                            <textarea id="layeditQuestiondescribe" name="analysis"><?=isset($dataInfo['analysis']) ? $dataInfo['analysis']:"";?></textarea>
                        </div>
                    </div>
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
<script type="application/javascript">
layui.use(['form', 'table', 'laypage', 'upload','layedit'], function(){
    var layedit = layui.layedit;
    var layedit2 = layui.layedit;
    var layedit3 = layui.layedit;
    var table = layui.table
        ,form = layui.form
        ,jq = layui.jquery
        ,$ = layui.jquery;
    var storage=window.localStorage;
    var userData = storage.getItem("userData");
    var headerParams = JSON.parse(userData);

    //自定义验证规则
    form.verify({
        title: function(value){
            if(value.length < 2){
                return '试题名称至少2个字符！';
            }
        }
    });
    var select = <?=(isset($dataInfo['type']) && $dataInfo['type']) ? $dataInfo['type'] : 0;?>;
    $(".answerbox").hide();
    $("#answerbox"+"_"+select).show();
    form.on('select(selectType)', function(data){
        var val=data.value;
        $(".answerbox").hide();
        $("#answerbox"+"_"+val).show();
        if(parseInt(val) == 0)$("#selectnumber").hide();
        else $("#selectnumber").show();
    });
    layedit.set({
        uploadImage: {
            url: '/common/upload/ali-file',
            accept: 'image',
            acceptMime: 'image/*',
            exts: 'jpg|png|gif|bmp|jpeg',
            size: 1024 * 10,
            done:function (data) {
                console.log(data);
            }
        }
        , height: '90%'
    });
    layedit2.set({
        uploadImage: {
            url: '/common/upload/ali-file',
            accept: 'image',
            acceptMime: 'image/*',
            exts: 'jpg|png|gif|bmp|jpeg',
            size: 1024 * 10,
            done:function (data) {
                console.log(data);
            }
        }
        , height: '90%'
    });
    layedit3.set({
        uploadImage: {
            url: '/common/upload/ali-file',
            accept: 'image',
            acceptMime: 'image/*',
            exts: 'jpg|png|gif|bmp|jpeg',
            size: 1024 * 10,
            done:function (data) {
                console.log(data);
            }
        }
        , height: '90%'
    });

    var index1 = layedit.build('layeditQuestiondescribe',{
        height: 180, //设置编辑器高度
        tool: [
            'html',
            'code',
            'strong' //加粗
            ,'italic' //斜体
            ,'underline' //下划线
            ,'del' //删除线
            ,'addhr'
            ,'|' //分割线
            ,'left' //左对齐
            ,'center' //居中对齐
            ,'right' //右对齐
            ,'link' //超链接
            ,'unlink' //清除链接
            ,'face' //表情
            ,'image' //插入图片
            , 'video'
            , 'anchors'
            ,'table'
            , 'fullScreen'
        ]
    });//建立编辑器
    var index2 = layedit2.build('layeditProblem',{
        height: 180, //设置编辑器高度
        tool: [
            'html',
            'code',
            'strong' //加粗
            ,'italic' //斜体
            ,'underline' //下划线
            ,'del' //删除线
            ,'addhr'
            ,'|' //分割线
            ,'left' //左对齐
            ,'center' //居中对齐
            ,'right' //右对齐
            ,'link' //超链接
            ,'unlink' //清除链接
            ,'face' //表情
            ,'image' //插入图片
            , 'video'
            , 'anchors'
            ,'table'
            , 'fullScreen'
        ]
    });//建立编辑器
    var index3 = layedit3.build('layeditAnswer',{
        height: 180, //设置编辑器高度
        tool: [
            'html',
            'code',
            'strong' //加粗
            ,'italic' //斜体
            ,'underline' //下划线
            ,'del' //删除线
            ,'addhr'
            ,'|' //分割线
            ,'left' //左对齐
            ,'center' //居中对齐
            ,'right' //右对齐
            ,'link' //超链接
            ,'unlink' //清除链接
            ,'face' //表情
            ,'image' //插入图片
            , 'video'
            , 'anchors'
            ,'table'
            , 'fullScreen'
        ]
    });//建立编辑器
    //监听提交
    form.on('submit(submitLevel)', function(data){
        data.field.problem = layedit2.getContent(index2);
        data.field.analysis = layedit.getContent(index1);
        $.ajax({
            type: "post",
            url: "<?= Url::to(['common/question/edit']); ?>",
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
                    return false;
                } else if(result.code == 5001){
                    layer.msg(result.msg, {
                        icon: 2,
                        shade: 0.6,
                        time: 2000 //2秒关闭（如果不配置，默认是3秒）
                    }, function(){
                        top.location.href="../user/login"
                    });
                    return false;
                } else {
                    layer.msg(result.msg, {
                        time: 2000,
                        shade: 0.6,
                        icon: 2
                    });
                    return false;
                }
            },
            error: function () {
                layer.msg("系统异常", {
                    time: 2000,
                    shade: 0.6,
                    icon: 2
                });
                return false;
            }
        });
        return false;
    });
    form.render(); //更新全部，防止input多选和单选框不显示问题
});
</script>