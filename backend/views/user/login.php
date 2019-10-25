<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<meta charset="UTF-8">
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Expires" content="0">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<link rel="shortcut icon" href="http://tp.weifenxiao.com/favicon.ico">
<title>登录微分销</title>
<?=Html::cssFile('@web/static/css/common/component-min.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
<?=Html::cssFile('@web/static/css/common/jbox-min.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
<?=Html::cssFile('@web/static/css/common/common_login_reg?v='.date("ymd"), ['rel' => "stylesheet"])?>
<div class="plp-bg " id="plp-bg">
    <div class="login">
        <a href="javascript:;" class="logo"></a>
        <div class="login-inner">
            <h1 class="login-title">登录微分销</h1>
            <div class="login-item mgb20"><!-- 博 -->
                <input type="text" class="clearError" id="ipt_account" placeholder="请输入手机号码" tabindex="1" value="15910987706">
                <a href="javascript:;" class="clearIpt j-clearIpt"><i class="gicon-remove"></i></a>
            </div>
            <div class="login-item mgb20">
                <input type="password" class="clearError" id="ipt_pwd" placeholder="请输入密码" tabindex="2">
                <a href="javascript:;" class="clearIpt j-clearIpt"><i class="gicon-remove"></i></a>
            </div>
            <div class="clearfix mgb10">
                <div class="login-item code fl">
                    <input type="text" class="clearError" id="ipt_code" placeholder="验证码" data-autohide="1" tabindex="3">
                    <a href="javascript:;" class="clearIpt j-clearIpt"><i class="gicon-remove"></i></a>
                </div>
                <div class="code-img fl mgl5">
                    <?= Html::img('/common/sms/get-code?d='.time(), ["class"=>"j-codeReresh","id"=>"code-img-enti"]);?>
                </div>
                <div class="fl mgl5">
                    <a href="javascript:;" class="j-codeReresh" id="code-refresh">换一张</a>
                </div>
            </div>
            <div>
                <a href="javascript:;" class="login-btn" id="btn_login" tabindex="4">登录</a>
                <input type="hidden" name="is_binding" value="" id="ipt-is_binding">
                <input type="hidden" name="type" value="" id="ipt-type">
            </div><!-- 科 -->

            <!-- <div class="login-locationnow">
                <a href="/Public/forget" class="fr">忘记密码？</a>
            </div> -->

        </div>
        <div class="third-login-con">
            <div class="third-login-hd">第三方登录</div>
            <ul>
                <li data-target="weixin">
                    <a href="http://tp.weifenxiao.com/Public/oauthLogin/type/weixin.html">
                        <?= Html::img('@web/static/images/common/third_login_01.png', []);?>
                        <span>微信登录</span>
                    </a>

                </li>
                <li data-target="qq">
                    <a href="http://tp.weifenxiao.com/Public/oauthLogin/type/qq.html">
                        <?= Html::img('@web/static/images/common/third_login_03.png', []);?>
                        <span>QQ账号</span>
                    </a>
                </li>
                <li data-target="sina">
                    <a href="http://tp.weifenxiao.com/Public/oauthLogin/type/sina.html">
                        <?= Html::img('@web/static/images/common/third_login_05.png', []);?>
                        <span id="wb_connect_btn">微博账号</span>
                    </a>
                </li>
            </ul>
        </div>			<div class="login-register">
            <a href="http://tp.weifenxiao.com/Public/register" class="fl">没有账号？立即注册</a>				<a href="http://tp.weifenxiao.com/Public/forget" class="fr">忘记密码？</a>
        </div>
    </div>
    <!-- end login -->
    <div class="tooltips" data-origin="ipt_account" data-currentleft="0" style="top: 246.567px; left: 898.5px;">
        <span class="tooltips-arrow tooltips-arrow-left"><em>◆</em><i>◆</i></span>
        <span class="tooltips-content">请输入手机号码或邮箱</span>
    </div>

    <div class="tooltips" data-origin="ipt_pwd" data-currentleft="0" style="top: 306.567px; left: 898.5px;">
        <span class="tooltips-arrow tooltips-arrow-left"><em>◆</em><i>◆</i></span>
        <span class="tooltips-content">请输入密码</span>
    </div>

    <div class="tooltips" data-origin="ipt_code" data-currentleft="0" style="top: 366.567px; left: 730.5px;">
        <span class="tooltips-arrow tooltips-arrow-left"><em>◆</em><i>◆</i></span>
        <span class="tooltips-content">请输入验证码</span><!-- 技 -->
    </div>
    <!-- end tooltips -->
    <p class="content-title">@以“区块链技术”驱动社交新经济</p>
    <canvas style="width: 1600px; height: 764px;" width="3200" height="1528"></canvas></div>



<script type="text/j-template" id="tpl_hint">
    <div class="hint hint-<%= type %>"><%= content %></div>
</script>
<!-- end hint -->

<?=Html::jsFile('@web/static/js/common/lib-min.js?v='.date("ymd"), ['type' => "text/javascript"])?>
<?=Html::jsFile('@web/static/js/common/jquery.js?v='.date("ymd"), ['type' => "text/javascript"])?>
<?=Html::jsFile('@web/static/js/common/component-min.js?v='.date("ymd"), ['type' => "text/javascript"])?>
<?=Html::jsFile('@web/static/js/common/common_login_reg.js?v='.date("ymd"), ['type' => "text/javascript"])?>
<?=Html::jsFile('@web/static/js/common/wxLogin.js?v='.date("ymd"), ['type' => "text/javascript"])?>
<?=Html::jsFile('@web/static/js/common/point-line.js?v='.date("ymd"), ['type' => "text/javascript"])?>
<?=Html::jsFile('@web/static/js/common/login.js?v='.date("ymd"), ['type' => "text/javascript"])?>

<!--[if lt IE 10]>
<?=Html::jsFile('@web/static/js/jquery.placeholder-min.js?v='.date("ymd"), ['type' => "text/javascript"])?>
<script>
    $(function(){
        //修复IE下的placeholder
        $('input').placeholder();
    });
</script>
<![endif]-->

<script>
    $(function(){
    });
</script>
<!-- end session hint -->
