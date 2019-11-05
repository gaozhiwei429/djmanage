<?php
use yii\helpers\Html;
$this->title = "北京往全保科技有限公司";
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<!-- 满足有些用户在手机端访问的需要 -->
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Expires" content="0">

<link rel="shortcut icon" href="http://tp.weifenxiao.com/favicon.ico">
<title><?= Html::encode($this->title) ?> - 智慧党建</title>
<!-- 线上环境 -->
<?=Html::cssFile('@web/static/css/common/component-min.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
<?=Html::cssFile('@web/static/css/common/jbox-min.css?v='.date("ymd"), ['rel' => "stylesheet"])?>

<!-- <link rel="stylesheet" href="/Public/css/home/Shop/home.css"> -->
<!-- 首页新样式 -->
<?=Html::cssFile('@web/static/css/common/new_home.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
<!-- 涟漪样式 -->
<!-- <link rel="stylesheet" href="/Public/plugins/ripple/ripple.css"> -->
<?=Html::cssFile('@web/static/css/common/WdatePicker.css?v='.date("ymd"), ['rel' => "stylesheet"])?>

<?=Html::cssFile('@web/static/css/common/toolbox.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
<?=Html::cssFile('@web/static/css/common/ripple.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
</head>
<?php $this->head() ?>
<body class="cp-bodybox">
<?php $this->beginBody() ?>

<div class="chuanbobao_cover"></div>
<!--[if lt IE 9]>
<div class="alert alert-danger disable-del txtCenter" id="tipLowIEVer">
    <h4>系统检测到您使用的浏览器版本过低，为达到更好的体验效果请升级您的浏览器，我们为您推荐：</h4>
    <p>
        <a href="https://www.google.com.hk/chrome/" target="_blank">Chrome浏览器</a>
        <a href="http://www.firefox.com.cn/download/" target="_blank">Firefox浏览器</a>
        <a href="http://www.maxthon.cn/" target="_blank">遨游浏览器</a>
        <a href="http://se.360.cn/" target="_blank">360浏览器</a>
        <a href="http://www.liebao.cn/" target="_blank">猎豹浏览器</a>
    </p>
</div>
<![endif]-->

<?= $content ?>
            </div>
            <div class="footer">© 2019 启博软件 , Inc. All rights reserved.</div>
        </div>
        <!-- end content-right -->

        <!--<a href="javascript:;" class="btn-leftMenuFold" id="j-btn-leftMenuFold" ></a>-->
    </div>
</div>
<a href="#" id="j-gotop" class="gotop" title="回到顶部" style="left: 1593px;"></a>
<!-- end gotop -->
<!--end front template  -->
<!--测试-->

<?=Html::jsFile('@web/static/js/common/lib-min.js?v='.date("ymd"), ['type' => "text/javascript"])?>
<?=Html::jsFile('@web/static/js/common/jquery.js?v='.date("ymd"), ['type' => "text/javascript"])?>
<?=Html::jsFile('@web/static/js/common/clipboard.js?v='.date("ymd"), ['type' => "text/javascript"])?>
<?=Html::jsFile('@web/static/js/common/clipboard-min.js?v='.date("ymd"), ['type' => "text/javascript"])?><!-- 复制事件兼容浏览器不支持flash -->

<!-- 线上环境 -->
<?=Html::jsFile('@web/static/js/common/component-min.js?v='.date("ymd"), ['type' => "text/javascript"])?>
<?=Html::jsFile('@web/static/js/common/public.js?v='.date("ymd"), ['type' => "text/javascript"])?>
<script>
    var need_verify_set = false;
</script>

<!--[if lt IE 10]>
<?=Html::jsFile('@web/static/js/common/jquery.placeholder-min.js?v='.date("ymd"), ['type' => "text/javascript"])?>
<script>
    $(function(){
        //修复IE下的placeholder
        $('.input,.textarea').placeholder();
    });
</script>
<![endif]-->


<?=Html::jsFile('@web/static/js/common/highcharts.js?v='.date("ymd"), ['type' => "text/javascript"])?>
<?=Html::jsFile('@web/static/js/common/echarts_v4.js?v='.date("ymd"), ['type' => "text/javascript"])?>
<?=Html::jsFile('@web/static/js/common/WdatePicker.js?v='.date("ymd"), ['type' => "text/javascript"])?>
<?=Html::jsFile('@web/static/js/common/jquery-ui.js?v='.date("ymd"), ['type' => "text/javascript"])?>
<!-- 涟漪效果 -->
<?=Html::jsFile('@web/static/js/common/ripple.js?v='.date("ymd"), ['type' => "text/javascript"])?>
<!-- 左侧菜单滚动条 -->
<?=Html::jsFile('@web/static/js/common/jquery_002.js?v='.date("ymd"), ['type' => "text/javascript", 'charset'=>"UTF-8"])?>
<?=Html::jsFile('@web/static/js/common/home.js?v='.date("ymd"), ['type' => "text/javascript"])?>
<?=Html::jsFile('@web/static/js/common/public.js?v='.date("ymd"), ['type' => "text/javascript"])?>
<?=Html::jsFile('@web/static/js/common/home_002.js?v='.date("ymd"), ['type' => "text/javascript"])?>

<script type="text/javascript">
    $(".member_down").click(function() {
        $('li').removeClass('active');
        $(this).addClass('active');
    });
</script>
<script type="text/javascript">
    var val = $(".member_down_box span:last-child").find('a').html();
    if(val == '小程序代理商'){
        $(".member_down_box span:last-child").find('a').css('padding','0px');
    }
</script>
<script>

    //获取装修模块下滑动商品布局的高度
    $(function(){
        var setSliderHeight = function() {
            $(".J_sliderGoods").each(function(){
                var $this = $(this),
                    liwidth =$this.find("li").width(),
                    liheight = $this.find("li").height();

                $this.css({
                    "height":liheight
                })
                    .find("li").css("width",liwidth-2);

            })
        };

        setSliderHeight();
    })

</script>
<script>
    (function(){
        // var col_dis = $("body").height() -$(".sec .left-menu").length*40 -71;
        // $(".col_dis").css("height",col_dis);
        var secH = $("body").height()-71;
        $("#content-left .sec").css("height",secH);
        $("#content-left-box").css("height",secH);
    })();
</script>
<?=Html::jsFile('@web/static/js/common/toolbox.js?v='.date("ymd"), ['type' => "text/javascript"])?>
</body>
</html>
<?php $this->endPage() ?>