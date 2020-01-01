<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */
?>
<style type="text/css">
</style>
<?=Html::cssFile('@web/static/css/dangHistory.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
<div class="layui-card">
    <div class="layui-header notselect">
        <div class="pull-left"><span><?= Html::encode($title ? $title : (isset($this->title) ? $this->title : null)) ?></span></div>
    </div>
</div>
<div class="layui-card-body">
    <div class="dssdjt">
        <div class="dssdjt-title">
            <?= Html::img('@web/static/images/title.png', ["alt"=>""]);?></div>
        <div class="dssdjt-star"></div>
        <div class="dssdjt-content">
            <?php
            if(isset($dangTodayList) && !empty($dangTodayList)) {
            foreach($dangTodayList as $dangTodayInfo){
            ?>
            <div class="dssdjt-cont-show">
                <h2><?=isset($dangTodayInfo['title']) ? $dangTodayInfo['title'] :"";?></h2>
                <p><?=isset($dangTodayInfo['content']) ? $dangTodayInfo['content'] :"";?></p>
            </div>
            <?php
            }
            }
            ?>
        </div>
        <div class="dssdjt-cont-bg"></div>
    </div>
</div>
