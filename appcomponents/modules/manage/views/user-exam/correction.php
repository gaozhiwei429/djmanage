<?php
use yii\helpers\Url;
use \yii\helpers\Html;
/* @var $this yii\web\View */
//var_dump($examInfo);die;
//var_dump($dataInfo);die;
?>

<?=Html::jsFile('@web/static/plugs/layui/layui.all.js?v='.date("ymd"), ['type' => "text/javascript"])?>
<?=Html::jsFile('@web/static/exam/materialize/js/materialize.js?v='.date("ymd"), ['type' => "text/javascript"])?>
<?=Html::cssFile('@web/static/exam/materialize/css/materialize.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
<?=Html::cssFile('@web/static/exam/css/exam.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
<style type="text/css">
.layui-card {
    padding: 10px 15px;
}
.layui-card-body {
    padding: 0px;
}
</style>
<!--<div class="layui-card">-->
<!--    <div class="layui-card-body">-->
<!--        <div class="container-fluid">-->
<!--            <div class="row-fluid">-->
<!--                <div class="span10" id="datacontent">-->
                    <button class="layui-btn layui-btn-sm" onclick="window.history.go(-1);">返回</button>
                    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
                        <legend><?= Html::encode($title ? $title : (isset($this->title) ? $this->title : null)) ?></legend>
                    </fieldset>
                    <div id="timeBox">
                        <?=isset($passportInfo['full_name']) ? $passportInfo['full_name']."的考试批改" : "";?><span id="time"></span>
                        <p id="endResult" style="text-align: center;color: red;font-weight: bold;"></p>
                    </div>
                    <form style="padding: 10px 15px" autocomplete="off" class="layui-form" action="">
                        <input type="hidden" name="id" class="layui-input" value="<?=isset($dataInfo['id']) ? $dataInfo['id']:0;?>">
                        <?php
                        $i=1;
                        $prombleStr="";
                        $prombleNumStr="";
                        if(isset($examInfo['types']) && is_array($examInfo['types']) &&
                            isset($dataInfo['types']) && is_array($dataInfo['types']) &&
                        !empty($dataInfo['types'])) {
                            $questionArr = [];
                            foreach($examInfo['types'] as $k=>$typeArr) {
                                if($k==1) {
                                    $prombleStr = "单项选择";
                                }else if($k==2) {
                                    $prombleStr = "多项选择";
                                }else if($k==3) {
                                    $prombleStr = "判断";
                                }else if($k==4) {
                                    $prombleStr = "解答";
                                }else if($k==5) {
                                    $prombleStr = "填空";
                                }
                                if($i==1) {
                                    $prombleNumStr = "一、";
                                }else if($k==2) {
                                    $prombleNumStr = "二、";
                                }else if($k==3) {
                                    $prombleNumStr = "三、";
                                }else if($k==4) {
                                    $prombleNumStr = "四、";
                                }else if($k==5) {
                                    $prombleNumStr = "五、";
                                }
                                if(isset($typeArr['questions'])) {
                                    $questionArr = explode(',',$typeArr['questions']);
                                }
                        ?>
                        <h5><?=$prombleNumStr.$prombleStr;?>(每小题<?=isset($typeArr['score']) ? $typeArr['score'] : 0;?>分)</h5>

                                <div class="striped">
                                    <?php
                                $flag = 1;
                                        foreach($questionArr as $questionId) {
                                            if(isset($dataInfo['types']) && isset($dataInfo['types'][$questionId])){
                                    ?>
                                    <p>
                                        <span><?=$flag?></span>.
                                        <span><?=isset($dataInfo['types'][$questionId]['title']) ? $dataInfo['types'][$questionId]['title'] : ""?></span>
                                        <span class="quesId radio"><?=$questionId?></span>
                                    </p>
                                    <p class="radio_item" style="margin-left: 50px">
                    <span>
                        <p style="color: #c67605">正确答案：<?=isset($dataInfo['types'][$questionId]['answer']) ? (is_array($dataInfo['types'][$questionId]['answer']) ? implode(',',$dataInfo['types'][$questionId]['answer']) : strip_tags($dataInfo['types'][$questionId]['answer'])) : ""?></p>
                        <p style="color: #cc0066">用户提交答案：<?=isset($dataInfo['types'][$questionId]['exam_answer']) ? (is_array($dataInfo['types'][$questionId]['exam_answer']) ? implode(',',$dataInfo['types'][$questionId]['exam_answer']) : $dataInfo['types'][$questionId]['exam_answer']) : ""?></p>
                        <p>
                                <div class="layui-form-item">
                                    <label class="layui-form-label">得分：</label>
                            <?php
                            for($i=0; $i<=$typeArr['score']; $i++) {
                            ?>
                                <div class="layui-input-inline">
                                <input type="radio" name="score[<?=$questionId?>]" id="score_<?=$questionId?>_<?=$i?>" value="<?=$i?>" <?=(($dataInfo['types'][$questionId]['exam_answer']==$dataInfo['types'][$questionId]['answer'] && $typeArr['score']==$i) || $i==0) ? "checked" : ""?>>
                                <label for="radio_<?=$questionId?>_<?=$i?>"><?=$i?>分</label>
                                </div>
                            <?php
                            }
                            ?>
                                </div>
                        </p>
                    </span>
                    </p>

                                </div>
                        <?php
                                    }
                                $flag++;
                                }
                                $i++;
                            }
                        }
                        ?>
                        <div class="layui-form-item">
                            <div class="layui-input-block">
                                <button type="submit" class="layui-btn" lay-submit="" lay-filter="submitExam">立即提交</button>
                            </div>
                        </div>
<!--                        <a type="button" id="submit" class="waves-effect waves-light btn">交卷</a>-->
                    </form>

                    <div class="hiddendiv common"></div>
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

<script type="application/javascript">
layui.use(['form', 'table', 'laypage', 'layer'], function(){
    var table = layui.table
        ,form = layui.form
        ,jq = layui.jquery
        ,$ = layui.jquery;
    var storage=window.localStorage;
    var userData = storage.getItem("userData");
    var headerParams = JSON.parse(userData);
    //监听提交
    var params = {};
    //监听提交

    //监听提交
    form.on('submit(submitExam)', function(data){
        $.ajax({
            type: "post",
            url: "<?= Url::to(['common/user-exam/correction']); ?>",
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
                    layer.alert('确认批改', {icon: 1}, function(index){
                        window.history.back();
                        layer.closeAll();
                    });
                    /*layer.msg(result.msg, {
                        time: 2000,
                        shade: 0.6
                    },function(){
                        window.history.go(-1);
//                        window.location.go(-1);
//                        window.history.back();//.go(-1);
                    });*/
                    return false;
                } else if(result.code == 5001){
                    layer.msg(result.msg, {
                        icon: 2,
                        shade: 0.6,
                        time: 2000 //2秒关闭（如果不配置，默认是3秒）
                    }, function(){
                        layer.closeAll();
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
        })
        layer.closeAll();
        return false;
    });
});
</script>