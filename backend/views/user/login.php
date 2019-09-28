<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<?=Html::cssFile('@web/static/theme/css/login.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
<div class="login-container">
    <!-- 动态云层动画 开始 -->
    <div class="clouds-container">
        <div class="clouds clouds-footer"></div>
        <div class="clouds"></div>
        <div class="clouds clouds-fast"></div>
    </div>
    <!-- 动态云层动画 结束 -->

    <!-- 顶部导航条 开始 -->
    <div class="header notselect">

        <div class="topbar-head pull-left">
            <?= Html::img('@web/static/theme/img/login/logo.jpg', [
                'alt'=>'管理系统',
                'style' => 'width:420px;height:80px; margin-left:120px;',
                'id' => 'array',
                'class' => 'resize',
            ]);?>
            <a href="/" class="topbar-logo pull-left"><sup> V1.0</sup></a>
        </div>
        <!--<span class="title notselect">管理系统 <sup>V1.0</sup>

        </span>-->
        <ul>
            <li><a href="javascript:void(0)" target="_blank">帮助</a></li>
            <li>
                <a href="http://sw.bos.baidu.com/sw-search-sp/software/9e6bc213b9d0b/ChromeStandalone_63.0.3239.132_Setup.exe">推荐使用谷歌浏览器</a>
            </li>
        </ul>
    </div>
    <!-- 顶部导航条 结束 -->

    <!-- 页面表单主体 开始 -->
    <div class="container">
        <form autocomplete="off" onsubmit="return false" action="" data-time="0.001" data-auto="true" class="content layui-form animated fadeInDown">
            <div class="people">
                <div class="tou"></div>
                <div id="left-hander" class="initial_left_hand transition"></div>
                <div id="right-hander" class="initial_right_hand transition"></div>
            </div>
            <ul>
                <li class="username">
                    <i></i>
                    <input required pattern="^\S{2,}$" name="username" value="" type="text" autofocus="autofocus" autocomplete="off" title="请输入2位及以上的字符" placeholder="请输入用户名/手机号码">
                </li>
                <li class="password">
                    <i></i>
                    <input required pattern="^\S{4,}$" name="password" value="" type="password" autocomplete="off" title="请输入4位及以上的字符" placeholder="请输入密码">
                </li>
                <li class="text-center">
                    <button type="button" id="login" class="layui-btn layui-disabled" data-form-loaded="立 即 登 入" style="background-color: #f47920">正 在 载 入</button>
                </li>
            </ul>
        </form>
    </div>
    <!-- 页面表单主体 结束 -->

    <!-- 底部版权信息 开始 -->
    <div class="footer notselect">
        版权所有***
        <span>|</span> <a target="_blank" href="http://www.miitbeian.gov.cn">备案号</a>
    </div>
    <!-- 底部版本信息 结束 -->
</div>

<script>
layui.use('table', function(){
    $(function () {
        $('[name="password"]').on('focus', function () {
            $('#left-hander').removeClass('initial_left_hand').addClass('left_hand');
            $('#right-hander').removeClass('initial_right_hand').addClass('right_hand')
        }).on('blur', function () {
            $('#left-hander').addClass('initial_left_hand').removeClass('left_hand');
            $('#right-hander').addClass('initial_right_hand').removeClass('right_hand')
        });
        $('#login').click(function(){
            var username = $('[name="username"]').val();
            var password = $('[name="password"]').val();
            var openid = $(this).attr('data');
            var url = "<?= Url::to(['/user/login-in']); ?>";
            $.post(url,{username:username,password:password},function(data){
                var data = JSON.parse(data); //由JSON字符串转换为JSON对象
                if(data.code != 0){
                    layer.msg(data.msg,{icon: 5});
                    return;
                }
                var storage=window.localStorage;
                var userData = JSON.stringify(data.data)
                storage.setItem("userData",userData);
                layer.msg(data.msg, {
                    icon: 6,//成功的表情
                    time: 1000 //1秒关闭（如果不配置，默认是3秒）
                }, function(){
                    location.href="<?= Url::to(['site/index']); ?>";
                });
            })
        });
    });
});
</script>