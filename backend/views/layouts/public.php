<?php
use yii\helpers\Html;
$this->title = "北京星驰恒动科技发展有限公司";
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?> 管理后台</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="keywords" contents="往全保科技专注互联网技术解决方案" />
    <?=Html::cssFile('@web/static/plugs/awesome/css/font-awesome.min.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
    <?=Html::cssFile('@web/static/plugs/bootstrap/css/bootstrap.min.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
    <?=Html::cssFile('@web/static/plugs/layui/css/layui.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
    <?=Html::cssFile('@web/static/theme/css/console.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
    <?=Html::cssFile('@web/static/theme/css/animate.css?v='.date("ymd"), ['rel' => "stylesheet"])?>

    <script>window.ROOT_URL = '__ROOT__';</script>
    <?=Html::jsFile('@web/static/plugs/jquery/pace.min.js?v='.date("ymd"), ['type' => "text/javascript"])?>
    <?=Html::jsFile('@web/static/plugs/layui/layui.all.js?v='.date("ymd"), ['type' => "text/javascript"])?>
    <?=Html::jsFile('@web/static/admin.js?v='.date("ymd"), ['type' => "text/javascript"])?>
    <?php
    //Html::jsFile('@web/static/common.js?v='.date("ymd"), ['type' => "text/javascript"]);
    ?>
    <?php $this->head() ?>
</head>
<body class="framework mini">
<?php $this->beginBody() ?>
<?= $content ?>
<?=Html::jsFile('@web/static/plugs/require/require.js?v='.date("ymd"), ['type' => "text/javascript"])?>
<?=Html::jsFile('@web/static/app.js?v='.date("ymd"), ['type' => "text/javascript"])?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>