<?php
use yii\helpers\Url;
use \yii\helpers\Html;
/* @var $this yii\web\View */
?>
<?=Html::cssFile('@web/static/css/inputTags.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
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
        <div style="margin-bottom:0px;">
            <div class="admin-main layui-form layui-field-box">
                <!-- layui-btn-sm -->
                <button class="layui-btn layui-btn-sm" onclick="window.history.go(-1);">返回</button>
                <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
                    <legend>编辑三会一课</legend>
                </fieldset>

                <form autocomplete="off" class="layui-form" onsubmit="return false;" data-auto="true" action="#">
                    <input type="hidden" name="id" class="layui-input" value="<?=isset($dataInfo['id']) ? $dataInfo['id']:"";?>">

                    <div class="layui-form-item">
                        <label class="layui-form-label">
                            <span class="require-text">*</span>所属栏目
                        </label>
                        <div class="layui-input-inline">
                            <select name="metting_type_id" lay-verify="required" lay-search="">
                                <option value="" <?=(isset($dataInfo['type']) && $dataInfo['type']==0) ? "selected":"";?>>栏目选择</option>
                                <?php
                                if(isset($mettingTypeDataList)) {
                                    foreach($mettingTypeDataList as $mettingTypeData) {
                                        ?>
                                        <option value="<?=isset($mettingTypeData['id']) ? $mettingTypeData['id'] : 0;?>" <?=(isset($dataInfo['metting_type_id']) && $mettingTypeData['id']==$dataInfo['metting_type_id']) ? "selected":"";?>><?=isset($mettingTypeData['title']) ? $mettingTypeData['title'] : "";?></option>
                                    <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">
                            <span class="require-text">*</span>所属党组织
                        </label>
                        <div class="layui-input-inline">
                            <select name="organization_id" lay-verify="required" lay-search="">
                                <option value="" <?=(isset($dataInfo['organization_id']) && $dataInfo['organization_id']==0) ? "selected":"";?>>栏目选择</option>
                                <?php
                                if(isset($treeData) && !empty($treeData)) {
                                    foreach($treeData as $treeInfo) {
                                ?>
<option value="<?=isset($treeInfo['id']) ? $treeInfo['id'] : 0;?>" <?=(isset($dataInfo['organization_id']) && $treeInfo['id']==$dataInfo['organization_id']) ? "selected" : "";?>><?=isset($treeInfo['title']) ? $treeInfo['title'] : "";?></option>';
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label"><span class="require-text">*</span>会议主题</label>
                        <div class="layui-input-inline">
                            <input type="text" name="title" lay-verify="title" placeholder="请输入会议主题至少2个字符" class="layui-input" value=<?=isset($dataInfo['title']) ? $dataInfo['title']:"";?>>
                        </div>
                        <div class="layui-form-mid layui-word-aux">在三会一课上显示的会议主题</div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label"><span class="require-text">*</span>地点</label>
                        <div class="layui-input-inline">
                            <input type="text" name="address" lay-verify="address" placeholder="请输入会议地点至少2个字符" class="layui-input" value=<?=isset($dataInfo['address']) ? $dataInfo['address']:"";?>>
                        </div>
                        <div class="layui-form-mid layui-word-aux">在三会一课上显示的会议地点</div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">会议要求</label>
                        <div class="layui-input-inline">
                            <textarea name="content" style="width:400px; height:220px; border:0; padding:2px 6px"><?=isset($dataInfo['content']) ? $dataInfo['content']:"";?></textarea>
                        </div>
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
                            <span class="require-text"></span>时间
                        </label>
                        <div class="layui-input-inline">
                            <input type="text" name="startandenddate" id="startandenddate" autocomplete="off" placeholder="请选择考试周期" class="layui-input" value="<?=(isset($dataInfo['start_time'])&&!empty($dataInfo['start_time'])) ? $dataInfo['start_time']." - ":"";?><?=(isset($dataInfo['end_time'])&&!empty($dataInfo['end_time'])) ? $dataInfo['end_time']:"";?>">
                        </div>
                    </div>

    <div class="layui-form-item">
        <label class="layui-form-label"><span class="require-text">*</span>主持人</label>
        <div class="layui-input-inline">
            <input type="text" id="iselectpeople_1" readonly unselectable="on" placeholder="请选择主持人" class="layui-input" value="<?=isset($dataInfo['president_people']) ? $dataInfo['president_people']:"";?>">
        </div>
        <span class="info" onclick='getJoinPeoples("1", "<?=isset($dataInfo['president_userid']) ? $dataInfo['president_userid']:"";?>")' >&nbsp;<a class="selfmodal btn" href="javascript:;">选择主持人</a></span>
        <input type="hidden" id="iselectquestions_1" name="president_userid" value="<?=isset($dataInfo['president_userid']) ? $dataInfo['president_userid']:"";?>" />
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label"><span class="require-text">*</span>主讲人</label>
        <div class="layui-input-inline">
            <input type="text" id="iselectpeople_2" readonly unselectable="on" placeholder="请选择主讲人" class="layui-input" value="<?=isset($dataInfo['speaker_people']) ? $dataInfo['speaker_people']:"";?>">
        </div>
        <span class="info" onclick='getJoinPeoples("2", "<?=isset($dataInfo['speaker_userid']) ? $dataInfo['speaker_userid']:"";?>")' >&nbsp;<a class="selfmodal btn" href="javascript:;">选择主讲人</a></span>
        <input type="hidden" id="iselectquestions_2" name="speaker_userid" value="<?=isset($dataInfo['speaker_userid']) ? $dataInfo['speaker_userid']:"";?>" />
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">
            <span class="require-text">*</span>人员
        </label>
        <div class="layui-input-block" id="JoinPeoples">
            <input type="radio" name="join_peoples" value="0" title="全体党员" <?=(isset($dataInfo['join_peoples'])&&$dataInfo['join_peoples']==0) ? "checked='checked'":"checked='checked'";?> lay-filter="join_peoples">
            <input type="radio" name="join_peoples" value="<?=(isset($dataInfo['join_peoples'])&&$dataInfo['join_peoples']) ? $dataInfo['join_peoples'] :"" ?>" title="指定党员" <?=(isset($dataInfo['join_peoples'])&&$dataInfo['join_peoples']) ? "checked='checked'":"";?> lay-filter="join_peoples">
        </div>
    </div>
    <div class="layui-form-item" id="choiceUser" style="display: none;">
        <label class="layui-form-label">
            <span class="require-text">*</span>
            指定党员
        </label>
        <div class="layui-input-block" style="display: flex;">
            <div class="tags" id="iselectpeople_3" style="width: 80%;margin: 0px;padding: 0px 10px;">
                <ul id="tags-list">
                    <li><em><?=isset($dataInfo['join_people_list']) ? $dataInfo['join_people_list']:"";?></em></li>
                </ul>
            </div>
            <span class="info" onclick='getJoinPeoples("3", "<?=isset($dataInfo['join_peoples']) ? $dataInfo['join_peoples']:"";?>")' >&nbsp;<a class="selfmodal btn" href="javascript:;">选择党员</a></span>
            <input type="hidden" id="iselectquestions_3" name="join_peoples" value="<?=isset($dataInfo['join_peoples']) ? $dataInfo['join_peoples']:"";?>" />
            <input type="hidden" id="organizationIds" name="organizationIds" value="<?=isset($dataInfo['organization_ids']) ? $dataInfo['organization_ids']:"";?>" />
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
layui.use(['form', 'table','laydate', 'layer'], function(){
    var table = layui.table
        ,form = layui.form
        ,jq = layui.jquery
        ,$ = layui.jquery;
    var laydate = layui.laydate;
    var storage=window.localStorage;
    var userData = storage.getItem("userData");
    var headerParams = JSON.parse(userData);
    <?php
    if(isset($dataInfo['join_peoples']) && $dataInfo['join_peoples']!=0){
    ?>
    $("#choiceUser").show();
    <?php
    }
    ?>
    form.on('radio(join_peoples)', function (data) {
        if (data.value == undefined || data.value == null || data.value != 0 || data.value == "") {
            $("#choiceUser").show();
        } else {
            $("#choiceUser").hide();
        }
    });
    //常规用法
    laydate.render({
        elem: '#startandenddate'
        ,range: true
        ,min: '2019-01-01 00:00:00' //最小日期
        ,max: '2099-12-31 23:59:59' //最大日期
        ,type: "datetime"
    });
    //自定义验证规则
    form.verify({
        title: function(value){
            if(value.length < 2){
                return '会议主题至少2个字符！';
            }
        }
    });
    //监听提交
    form.on('submit(submitLevel)', function(data){
        $.ajax({
            type: "post",
            url: "<?= Url::to(['common/metting/edit']); ?>",
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
/**
 * @param type [1单项选择、2多项选择、3判断、4解答、5填空]
 * @param articleId
 * @param questionNum
 */
function getJoinPeoples(type, joinPeoples){
    var userIds = $("#iselectquestions_"+type).val();
    if(type==3) {
        var organization_id = $('select[name="organization_id"]').val();
        if(organization_id==0 || organization_id=="" || organization_id==undefined) {
            layer.msg("请选择党组织", {
                time: 2000,
                shade: 0.6,
                icon: 2
            });
            return false;
        }
        var index = layer.open({
            type: 2
            ,title: "人员选择"
            ,area: ['80%', '85%'] //宽高
            ,content: "<?= Url::to(['/manage/dangyuan/list']); ?>?organization_id="+organization_id+"&userIds="+userIds
            ,shade: 0.6 //遮罩透明度
            ,maxmin: true //允许全屏最小化
            ,anim: 5 //0-6的动画形式，-1不开启
            ,btn: ['确定', '取消']
            ,yes: function(index, layero){
                //按钮【按钮一】的回调
                var body = layer.getChildFrame('body', index); //得到iframe页的body内容
                var selectData = body.find("#JtableIds").val();
                var peopleData = body.find("#Jpeoples").val();
                var organizationIds = body.find("#JorganizationIds").val();
                $("#iselectquestions_"+type).val(selectData);
                if(peopleData) {
                    $("#iselectpeople_"+type).val(peopleData);
                    var html = "<li><em>"+peopleData+"</em></li>";
                    $("#tags-list").html(html);
                }
                layer.close(index);
                return true;
            }
            ,btn2: function(index, layero){
//                $.cookie('checkbox', null);
                //按钮【按钮二】的回调
                layer.closeAll();
                return true;
                //return false 开启该代码可禁止点击该按钮关闭
            }
            ,cancel: function(){
                //右上角关闭回调
                layer.closeAll();
                return true;
                //return false 开启该代码可禁止点击该按钮关闭
            }
        });
    } else {
        var index = layer.open({
            type: 2
            ,title: "人员选择"
            ,area: ['80%', '85%'] //宽高
            ,content: "<?= Url::to(['/manage/dangyuan/list']); ?>?type="+type+"&userIds="+userIds
            ,shade: 0.6 //遮罩透明度
            ,maxmin: true //允许全屏最小化
            ,anim: 5 //0-6的动画形式，-1不开启
            ,btn: ['确定', '取消']
            ,yes: function(index, layero){
                //按钮【按钮一】的回调
                var body = layer.getChildFrame('body', index); //得到iframe页的body内容
                var selectData = body.find("#JtableIds").val();
                var peopleData = body.find("#Jpeoples").val();
                var organizationIds = body.find("#JorganizationIds").val();
                $("#iselectquestions_"+type).val(selectData);
                if(peopleData) {
                    $("#iselectpeople_"+type).val(peopleData);
                }
                layer.close(index);
                return true;
            }
            ,btn2: function(index, layero){
//                $.cookie('checkbox', null);
                //按钮【按钮二】的回调
                layer.closeAll();
                return true;
                //return false 开启该代码可禁止点击该按钮关闭
            }
            ,cancel: function(){
                //右上角关闭回调
                layer.closeAll();
                return true;
                //return false 开启该代码可禁止点击该按钮关闭
            }
        });
    }
}
</script>