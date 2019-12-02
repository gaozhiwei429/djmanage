<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Url;
/* @var $this yii\web\View */
$this->title = '北京往全保科技有限公司';
?>

<!-- 顶部菜单区域 开始 -->
<div class="framework-topbar">
    <div class="topbar-head pull-left">
        <a href="/" class="topbar-logo pull-left">
            <?= Html::img('@web/static/images/common/logo1.png', [
                'alt'=>'管理系统',
                'style' => 'width:160px;height:50px; bottom:10%; left:40%;',
                'id' => 'array',
                'class' => 'resize',
            ]);?>
            <sup> V1.0</sup></a>
    </div>
    <?php
    if(isset($menus)) {
    foreach($menus as $oneMenu) {
    ?>
    <a data-menu-node="m-<?=isset($oneMenu['id']) ? $oneMenu['id'] : 0;?>" data-open="<?=isset($oneMenu['url']) ? $oneMenu['url'] : '';?>" class="topbar-btn pull-left transition"><?php if(!empty($oneMenu['icon'])) {?> <span class="font-s13 <?=isset($oneMenu['icon']) ? $oneMenu['icon'] : ''?>"></span>&nbsp; <?php } ?><?=isset($oneMenu['title']) ? $oneMenu['title'] : ''?></a>
    <?php
        }
    }
    ?>
    <div class="pull-right">
        <?php
        if(isset($userInfo['id']) && !empty($userInfo['id'])) {
        ?>
        <div class="dropdown">
            <a href="#" class="dropdown-toggle topbar-btn text-center transition" data-toggle="dropdown">
                <span class="glyphicon glyphicon-user font-s13"></span>
                <?=isset($userInfo['username']) ? $userInfo['username'] : ''?>
                <span class="toggle-icon glyphicon glyphicon-menu-up transition font-s13"></span>
            </a>
            <ul class="dropdown-menu">
                <li class="topbar-btn"><a data-modal="<?= Url::to(['manage-user/pass']); ?>?id=<?=isset($userInfo['id']) ? $userInfo['id'] : ''?>" data-title="修改密码"><i class="glyphicon glyphicon-lock"></i> 修改密码</a></li>
                <li class="topbar-btn"><a data-modal="<?= Url::to(['manage-user/info']); ?>?id=<?=isset($userInfo['id']) ? $userInfo['id'] : ''?>" data-title="个人信息"><i class="glyphicon glyphicon-lock"></i> 个人信息</a></li>
                <li class="topbar-btn"><a data-modal="<?= Url::to(['manage-user/edit-info']); ?>?id=<?=isset($userInfo['id']) ? $userInfo['id'] : ''?>" data-title="编辑个人信息"><i class="glyphicon glyphicon-lock"></i> 编辑个人信息</a></li>
                <!--
                <?php
                if(isset($menuUrl) && !empty($menuUrl) && in_array(trim(Url::to(['/manage/concern/index']),"/"), $menuUrl)) {
                ?>
                    <li class="topbar-btn">
                        <a data-open="<?= Url::to(['manage/concern/index']); ?>"><i class="glyphicon glyphicon-th-list"></i> 我的关注</a>
                    </li>
                <?php
                }
                ?>
                <?php
                if(isset($menuUrl) && !empty($menuUrl) && in_array(trim(Url::to(['/manage/concern-group/index']),"/"), $menuUrl)) {
                    ?>
                    <li class="topbar-btn">
                        <a data-open="<?= Url::to(['manage/concern-group/index']); ?>"><i class="glyphicon glyphicon-bed"></i> 关注分组</a>
                    </li>
                <?php
                }
                ?>
                <?php
                if(isset($menuUrl) && !empty($menuUrl) && in_array(trim(Url::to(['/store/renewal/index']),"/"), $menuUrl)) {
                    ?>
                    <li class="topbar-btn">
                        <a data-open="<?= Url::to(['store/renewal/index']); ?>"><i class="glyphicon glyphicon-bed"></i>商城续租</a>
                    </li>
                <?php
                }
                ?>
                <?php
                if(isset($menuUrl) && !empty($menuUrl) && in_array(trim(Url::to(['/store/repair/index']),"/"), $menuUrl)) {
                    ?>
                    <li class="topbar-btn">
                        <a data-open="<?= Url::to(['store/repair/index']); ?>"><i class="glyphicon glyphicon-th-list"></i>商城报修</a>
                    </li>
                <?php
                }
                ?>
                -->
                <li class="topbar-btn">
                    <a data-href="<?= Url::to(['user/logout']); ?>" data-confirm="确定要退出登录吗？"><i class="glyphicon glyphicon-log-out"></i> 退出登录</a>
                </li>
            </ul>
        </div>

        <?php
        } else {
        ?>
        <div class="topbar-info-item">
            <a data-href="<?= Url::to(['user/login']); ?>" data-toggle="dropdown" class=" topbar-btn text-center">
                <span class='glyphicon glyphicon-user'></span> 立即登录 </span>
            </a>
        </div>
        <?php
        }
        ?>
    </div>
    <a class="topbar-btn pull-right transition" data-tips-text="刷新" data-reload="true" style="width:50px"><span class="glyphicon glyphicon-refresh font-s12"></span></a>
</div>
<!-- 顶部菜单区域 结束 -->

<!-- 左则菜单区域 开始 -->
<div class="framework-leftbar">
    <?php
//    if(isset($menus)) {
//        echo "<pre>";
//        print_r($menus);die;
    foreach($menus as $oneMenu) {
    ?>
<!--    {foreach $menus as $oneMenu}-->
        <?php
        if(isset($oneMenu['sub']) && !empty($oneMenu['sub'])){
        ?>
    <!--{notempty name='$oneMenu.sub'}-->
    <div class="leftbar-container hide notselect" data-menu-layout="m-<?=isset($oneMenu['id']) ? $oneMenu['id'] : ''?>">
        <div class="line-top">
            <i class="layui-icon font-s12">&#xe65f;</i>
        </div>
        <?php
        if(isset($oneMenu['sub']) && !empty($oneMenu['sub'])){
            foreach($oneMenu['sub'] as $twoMenu) {
                if(isset($twoMenu['sub']) && !empty($twoMenu['sub'])){
        ?>

        <div data-submenu-layout="m-<?=isset($oneMenu['id']) ? $oneMenu['id'] : ''?>-<?=isset($twoMenu['id']) ? $twoMenu['id'] : ''?>">
<a class='menu-title transition'>
<?php
if(isset($twoMenu['icon']) && !empty($twoMenu['icon'])) {
?>
<span class="fa <?=isset($twoMenu['icon']) ? $twoMenu['icon'] : ''?> font-icon"></span>
<?php
}
?>
<?=isset($twoMenu['title']) ? $twoMenu['title'] : ''?><i class='layui-icon pull-right font-s12 transition'>&#xe619;</i>
</a>
            <div style="text-align: left;">
<?php
foreach($twoMenu['sub'] as $thrMenu) {
?>
<a class='transition' data-open="<?=isset($thrMenu['url']) ? Url::to([$thrMenu['url']]) : ''?>" data-menu-node="m-<?=isset($oneMenu['id']) ? $oneMenu['id'] : ''?>-<?=isset($twoMenu['id']) ? $twoMenu['id'] : ''?>-<?=isset($thrMenu['id']) ? $thrMenu['id'] : ''?>">
<?php
if(isset($thrMenu['icon']) && !empty($thrMenu['icon'])) {
?>
<span class="<?=isset($thrMenu['icon']) ? $thrMenu['icon'] : ''?>  font-icon"></span><?php }?><?=isset($thrMenu['title']) ? $thrMenu['title'] : ''?>
</a>
<?php
}
?>
            </div>
        </div>
        <?php
            } else {
        ?>
        <div data-submenu-layout="m-<?=isset($oneMenu['id']) ? $oneMenu['id'] : ''?>-<?=isset($twoMenu['id']) ? $twoMenu['id'] : ''?>">
            <a class='menu-title transition'>
                <?php
                if(isset($twoMenu['icon']) && !empty($twoMenu['icon'])) {
                ?>
                    <span class="<?=isset($twoMenu['icon']) ? $twoMenu['icon'] : ''?> font-icon"></span>&nbsp;
                <?php
                }
                ?>
                <?=isset($twoMenu['title']) ? $twoMenu['title'] : ''?><i class='layui-icon pull-right font-s12 transition'>&#xe619;</i>
            </a>
            <div>
                <?php
                foreach($twoMenu['sub'] as $thrMenu) {
                ?>
                    <a class='transition' data-open="<?=isset($thrMenu['url']) ? Url::to([$thrMenu['url']]) : ''?>" data-menu-node="m-<?=isset($oneMenu['id']) ? $oneMenu['id'] : ''?>-<?=isset($twoMenu['id']) ? $twoMenu['id'] : ''?>-<?=isset($thrMenu['id']) ? $thrMenu['id'] : ''?>">
                        <?php
                        if(isset($thrMenu['icon']) && !empty($thrMenu['icon'])) {
                            ?>
                        <span class="<?=isset($thrMenu['icon']) ? $thrMenu['icon'] : ''?>  font-icon"></span>&nbsp;
                <?php
                        }
                        ?>
                        <?=isset($thrMenu['title']) ? $thrMenu['title'] : ''?>
                    </a>
                <?php
                }
                ?>
            </div>
        </div>
        <?php
        }
        }
        }
        ?>
    </div>
    <!--{/notempty}-->
<!--    {/foreach}-->

    <?php
        }
    }
    ?>
</div>
<!-- 左则菜单区域 结束 -->

<!-- 右则内容区域 开始 -->
<div class="framework-body"></div>
<!-- 右则内容区域 结束 -->
