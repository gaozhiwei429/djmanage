<?php
use yii\helpers\Url;
use \yii\helpers\Html;
/* @var $this yii\web\View */
?>
<!–[if lt IE9]>
<?=Html::jsFile('@web/static/exam/styles/js/html5.js?v='.date("ymd"), ['type' => "text/javascript"])?>
<![endif]–>
<?=Html::cssFile('@web/static/dangjian/css/main.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
<?=Html::cssFile('@web/static/dangjian/css/form.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
<?=Html::cssFile('@web/static/dangjian/css/layer.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
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
                        <legend>编辑考题</legend>
                    </fieldset>
                    <form autocomplete="off" class="layui-form" onsubmit="return false;" data-auto="true" action="#">
                        <input type="hidden" name="id" class="layui-input" value="<?=isset($dataInfo['id']) ? $dataInfo['id']:"";?>">
                        <div class="layui-form-item">
                            <label class="layui-form-label"><span class="require-text">*</span>考题名称</label>
                            <div class="layui-input-inline">
                                <input type="text" name="title" lay-verify="title" autocomplete="off" placeholder="请输入考题名称至少2个字符" class="layui-input" value="<?=isset($dataInfo['title']) ? $dataInfo['title']:"";?>">
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
                                <span class="require-text">*</span>评卷方式
                            </label>
                            <div class="layui-input-inline">
                                <input type="radio" name="decide" value="1" title="党组织评卷" <?=(isset($dataInfo['decide'])&&$dataInfo['decide']) ? "checked='checked'":"checked='checked'";?>>
                                <input type="radio" name="decide" value="0" title="系统自评" <?=(isset($dataInfo['decide'])&&$dataInfo['decide']==0) ? "checked='checked'":"";?>>
                            </div>
                            <span class="layui-form-mid layui-word-aux">党组织评卷时有主观题则需要党组织在后台评分后才能显示分数，无主观题自动显示分数。</span>
                        </div>

                        <div class="layui-form-item">
                            <label class="layui-form-label">
                                <span class="require-text"></span>考试周期
                            </label>
                            <div class="layui-input-inline">
                                <input type="text" name="startandoverduedate" id="startandoverduedate" autocomplete="off" placeholder="请选择考试周期" class="layui-input" value="<?=(isset($dataInfo['start_time'])&&!empty($dataInfo['start_time'])) ? $dataInfo['start_time']." - ":"";?><?=(isset($dataInfo['overdue_time'])&&!empty($dataInfo['overdue_time'])) ? $dataInfo['overdue_time']:"";?>">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">
                                <span class="require-text">*</span>考试时间</label>
                            <div class="layui-input-inline">
                                <input type="number" lay-verify="required" name="examtime" placeholder="" class="layui-input" lay-verify="number" value="<?=isset($dataInfo['examtime']) ? $dataInfo['examtime']:60;?>">
                            </div>
                            <span class="layui-form-mid layui-word-aux">单位（分钟）</span>
                        </div>

                        <div class="layui-form-item">
                            <label class="layui-form-label">
                                <span class="require-text">*</span>试卷总分</label>
                            <div class="layui-input-inline">
                                <input type="number" lay-verify="required" name="score" placeholder="你要为本考卷设置总分" class="layui-input" lay-verify="number" value="<?=isset($dataInfo['score']) ? $dataInfo['score']:"";?>">
                            </div>
                            <span class="layui-form-mid layui-word-aux">单位（分）数字类型</span>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">
                                <span class="require-text">*</span>及格线</label>
                            <div class="layui-input-inline">
                                <input type="number" lay-verify="required" name="passscore" placeholder="设置本考卷及格分数线" class="layui-input" lay-verify="number" value="<?=isset($dataInfo['passscore']) ? $dataInfo['passscore']:"";?>">
                            </div>
                            <span class="layui-form-mid layui-word-aux">单位（分）数字类型</span>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">
                                <span class="require-text"></span>单选题</label>
                            <div class="layui-input-block">
                                <span class="info">共&nbsp;</span>
                                <input id="iselectallnumber_1" type="text" class="input-mini" needle="needle" name="types[1][number]" value="12" size="2" msg="您必须填写总题数"/>
                                <span class="info">&nbsp;题，每题&nbsp;</span><input class="input-mini" needle="needle" type="text" name="types[1][score]" value="5" size="2" msg="您必须填写每题的分值"/>
                                <span class="info">&nbsp;分，描述&nbsp;</span><input class="input-mini" type="text" name="types[1][describe]" value="" size="12"/>
                                <span class="info">&nbsp;已选题数：<a id="ialreadyselectnumber_1">14</a>&nbsp;&nbsp;题</span>
                                <span class="info">&nbsp;<a class="selfmodal btn" href="javascript:;" data-target="#modal" url="index.php?exam-master-exams-selected&questionids={iselectquestions_1}&rowsquestionids={iselectrowsquestions_1}" valuefrom="iselectquestions_1|iselectrowsquestions_1">看题</a></span>
                                <span class="info">&nbsp;<a class="selfmodal btn" href="javascript:;" data-target="#modal" url="index.php?exam-master-exams-selectquestions&search[questionsubjectid]=2&search[questiontype]=1&questionids={iselectquestions_1}&rowsquestionids={iselectrowsquestions_1}&useframe=1" valuefrom="iselectquestions_1|iselectrowsquestions_1">选题</a></span>
                                <input type="hidden" id="iselectquestions_1" name="types[1][questions]" value=""/>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">
                                <span class="require-text"></span>多选题</label>
                            <div class="layui-input-block">
                                <span class="info">共&nbsp;</span>
                                <input id="iselectallnumber_2" type="text" class="input-mini" needle="needle" name="types[2][number]" value="4" size="2" msg="您必须填写总题数"/>
                                <span class="info">&nbsp;题，每题&nbsp;</span><input class="input-mini" needle="needle" type="text" name="types[2][score]" value="2.5" size="2" msg="您必须填写每题的分值"/>
                                <span class="info">&nbsp;分，描述&nbsp;</span><input class="input-mini" type="text" name="types[2][describe]" value="" size="12"/>
                                <span class="info">&nbsp;已选题数：<a id="ialreadyselectnumber_2">4</a>&nbsp;&nbsp;题</span>
                                <span class="info">&nbsp;<a class="selfmodal btn" href="javascript:;" data-target="#modal" url="index.php?exam-master-exams-selected&questionids={iselectquestions_2}&rowsquestionids={iselectrowsquestions_2}" valuefrom="iselectquestions_2|iselectrowsquestions_2">看题</a></span>
                                <span class="info">&nbsp;<a class="selfmodal btn" href="javascript:;" data-target="#modal" url="index.php?exam-master-exams-selectquestions&search[questionsubjectid]=2&search[questiontype]=2&questionids={iselectquestions_2}&rowsquestionids={iselectrowsquestions_2}&useframe=1" valuefrom="iselectquestions_2|iselectrowsquestions_2">选题</a></span>
                                <input type="hidden" id="iselectquestions_2" name="types[2][questions]" value=""/>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">
                                <span class="require-text"></span>判断题</label>
                            <div class="layui-input-block">
                                <span class="info">共&nbsp;</span>
                                <input id="iselectallnumber_3" type="text" class="input-mini" needle="needle" name="types[3][number]" value="4" size="2" msg="您必须填写总题数"/>
                                <span class="info">&nbsp;题，每题&nbsp;</span><input class="input-mini" needle="needle" type="text" name="types[3][score]" value="2.5" size="2" msg="您必须填写每题的分值"/>
                                <span class="info">&nbsp;分，描述&nbsp;</span><input class="input-mini" type="text" name="types[3][describe]" value="" size="12"/>
                                <span class="info">&nbsp;已选题数：<a id="ialreadyselectnumber_3">4</a>&nbsp;&nbsp;题</span>
                                <span class="info">&nbsp;<a class="selfmodal btn" href="javascript:;" data-target="#modal" url="index.php?exam-master-exams-selected&questionids={iselectquestions_3}&rowsquestionids={iselectrowsquestions_3}" valuefrom="iselectquestions_3|iselectrowsquestions_3">看题</a></span>
                                <span class="info">&nbsp;<a class="selfmodal btn" href="javascript:;" data-target="#modal" url="index.php?exam-master-exams-selectquestions&search[questionsubjectid]=2&search[questiontype]=3&questionids={iselectquestions_3}&rowsquestionids={iselectrowsquestions_3}&useframe=1" valuefrom="iselectquestions_3|iselectrowsquestions_3">选题</a></span>
                                <input type="hidden" id="iselectquestions_3" name="types[3][questions]" value=""/>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">
                                <span class="require-text"></span>问答题</label>
                            <div class="layui-input-block">
                                <span class="info">共&nbsp;</span>
                                <input id="iselectallnumber_4" type="text" class="input-mini" needle="needle" name="types[4][number]" value="1" size="2" msg="您必须填写总题数"/>
                                <span class="info">&nbsp;题，每题&nbsp;</span><input class="input-mini" needle="needle" type="text" name="types[4][score]" value="10" size="2" msg="您必须填写每题的分值"/>
                                <span class="info">&nbsp;分，描述&nbsp;</span><input class="input-mini" type="text" name="types[4][describe]" value="" size="12"/>
                                <span class="info">&nbsp;已选题数：<a id="ialreadyselectnumber_4">1</a>&nbsp;&nbsp;题</span>
                                <span class="info">&nbsp;<a class="selfmodal btn" href="javascript:;" data-target="#modal" url="index.php?exam-master-exams-selected&questionids={iselectquestions_4}&rowsquestionids={iselectrowsquestions_4}" valuefrom="iselectquestions_4|iselectrowsquestions_4">看题</a></span>
                                <span class="info">&nbsp;<a class="selfmodal btn" href="javascript:;" data-target="#modal" url="index.php?exam-master-exams-selectquestions&search[questionsubjectid]=2&search[questiontype]=4&questionids={iselectquestions_4}&rowsquestionids={iselectrowsquestions_4}&useframe=1" valuefrom="iselectquestions_4|iselectrowsquestions_4">选题</a></span>
                                <input type="hidden" id="iselectquestions_4" name="types[4][questions]" value=""/>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">
                                <span class="require-text"></span>填空题</label>
                            <div class="layui-input-block">
                                <span class="info">共&nbsp;</span>
                                <input id="iselectallnumber_5" type="text" class="input-mini" needle="needle" name="types[5][number]" value="5" size="2" msg="您必须填写总题数"/>
                                <span class="info">&nbsp;题，每题&nbsp;</span><input class="input-mini" needle="needle" type="text" name="types[5][score]" value="2" size="2" msg="您必须填写每题的分值"/>
                                <span class="info">&nbsp;分，描述&nbsp;</span><input class="input-mini" type="text" name="types[5][describe]" value="" size="12"/>
                                <span class="info">&nbsp;已选题数：<a id="ialreadyselectnumber_5">0</a>&nbsp;&nbsp;题</span>
                                <span class="info">&nbsp;<a class="selfmodal btn" href="javascript:;" data-target="#modal" url="index.php?exam-master-exams-selected&questionids={iselectquestions_5}&rowsquestionids={iselectrowsquestions_5}" valuefrom="iselectquestions_5|iselectrowsquestions_5">看题</a></span>
                                <span class="info">&nbsp;<a class="selfmodal btn" href="javascript:;" data-target="#modal" url="index.php?exam-master-exams-selectquestions&search[questionsubjectid]=2&search[questiontype]=5&questionids={iselectquestions_5}&rowsquestionids={iselectrowsquestions_5}&useframe=1" valuefrom="iselectquestions_5|iselectrowsquestions_5">选题</a></span>
                                <input type="hidden" id="iselectquestions_5" name="types[5][questions]" value=""/>
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
</div>
<script type="application/javascript">
    layui.use(['form', 'table', 'laypage','laydate', 'layer'], function(){
        var table = layui.table
            ,form = layui.form
            ,jq = layui.jquery
            ,$ = layui.jquery;
        var laydate = layui.laydate;
        var storage=window.localStorage;
        var userData = storage.getItem("userData");
        var headerParams = JSON.parse(userData);
        //常规用法
        laydate.render({
            elem: '#startandoverduedate'
            ,range: true
            ,min: '2019-01-01 00:00:00' //最小日期
            ,max: '2099-12-31 23:59:59' //最大日期
        });
        //自定义验证规则
        form.verify({
            title: function(value){
                if(value.length < 2){
                    return '考题名称至少2个字符！';
                }
            }
        });
        //监听提交
        form.on('submit(submitLevel)', function(data){
            $.ajax({
                type: "post",
                url: "<?= Url::to(['common/exam/edit']); ?>",
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