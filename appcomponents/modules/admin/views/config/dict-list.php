<?php
use yii\helpers\Html;
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <?= Html::cssFile('@web/static/layuiadmin/layui/css/layui.css?v=' . date("ymd"), ['rel' => "stylesheet"]) ?>
    <?= Html::cssFile('@web/static/layuiadmin/style/admin.css?v=' . date("ymd"), ['rel' => "stylesheet"]) ?>
    <?php $this->head() ?>
</head>
<body class="framework mini">
<iframe src="<?=isset($url) ? $url : ""?>" frameborder="0" class="layadmin-iframe"></iframe>
</body>
</html>
<?= Html::jsFile('@web/static/layuiadmin/layui/layui.js?v=' . date("ymd"), ['type' => "text/javascript"]) ?>
<script>
    layui.config({
        base: '/static/layuiadmin/' //指定 layuiAdmin 项目路径，本地开发用 src，线上用 dist
        , version: '2.4.5'
    }).extend({
        index: './lib/index' //主入口模块
    }).use(['form','laydate','table','layer','element','index',"laypage"], function () {

    });
</script>
