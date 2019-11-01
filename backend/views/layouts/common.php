<?php
use yii\helpers\Html;
$this->title = "北京往全保科技有限公司";
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <!-- 满足有些用户在手机端访问的需要 -->

    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">

    <link rel="shortcut icon" href="http://tp.weifenxiao.com/favicon.ico">
    <title><?= Html::encode($this->title) ?> - 微分销</title>
    <!-- 线上环境 -->
    <?=Html::cssFile('@web/static/css/common/component-min.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
    <?=Html::cssFile('@web/static/css/common/jbox-min.css?v='.date("ymd"), ['rel' => "stylesheet"])?>

    <!-- diy css start-->
    <?=Html::cssFile('@web/static/css/common/style.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
    <?=Html::cssFile('@web/static/css/common/diy-min.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
    <?=Html::cssFile('@web/static/css/common/uploadifive.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
    <?=Html::cssFile('@web/static/css/common/colorpicker.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
    <?=Html::cssFile('@web/static/css/common/lists.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
    <style>
        #albums{z-index:999998;}
        .setfxs-pic {
            display: block;
        }
        .shop_evaluate_top span img{
            width:20px;
        }
        .describe_evaluate .star_evaluate{
            display: inline-block;
            margin-top: 5px;
        }
        .describe_evaluate .star_evaluate ul li{
            display: inline-block;
        }
        .describe_evaluate .star_evaluate ul li img{
            width: 22px;
            vertical-align: middle;
        }
        .w160{
            width: 160px!important;
        }
        .supplier_list{
            background: #fff;
            border: 1px solid #ccc;
            width: 198px;
            padding: 0 0 3px;
            margin-top: -3px;
            position: absolute;
            border-bottom-left-radius: 4px;
            border-bottom-right-radius: 4px;
            z-index: 100;
            display: none;
            border-top-color: #fff;
        }
        .supplier_list li{
            line-height: 20px;
            cursor: pointer;
            padding: 1px 26px 1px 24px;
            background: url(/static/images/common/arr2_right.png) no-repeat;
            background-size: 6px 9px;
            background-position: 177px 7px;
        }
        .supplier_list li:hover{
            background-color: #eaeaea;
        }
        .supplier_list li:nth-last-child(1){
            border-bottom: none;
        }
        .supplier_list .spinner{
            width: 150px;
            text-align: center;
            background: none;
        }
        .supplier_list .spinner span{
            width: 10px;
            height: 10px;
            background-color: #ccc;
            border-radius: 100%;
            display: inline-block;
            -webkit-animation: bouncedelay 1.4s infinite ease-in-out;
            animation: bouncedelay 1.4s infinite ease-in-out;
            /* Prevent first frame from flickering when animation starts */
            -webkit-animation-fill-mode: both;
            animation-fill-mode: both;
        }
        .supplier_list .spinner .bounce1{
            -webkit-animation-delay: -0.32s;
            animation-delay: -0.32s;
        }
        .supplier_list .spinner .bounce2{
            -webkit-animation-delay: -0.16s;
            animation-delay: -0.16s;
        }
        @-webkit-keyframes bouncedelay {
            0%, 80%, 100% { -webkit-transform: scale(0.0) }
            40% { -webkit-transform: scale(1.0) }
        }

        @keyframes bouncedelay {
            0%, 80%, 100% {
                transform: scale(0.0);
                -webkit-transform: scale(0.0);
            } 40% {
                  transform: scale(1.0);
                  -webkit-transform: scale(1.0);
              }
        }
        input[name="supplier_name"]{
            background: url(/static/images/common/sle.png) no-repeat;
            background-size: 20px 19px;
            padding-left: 28px;
            background-position: 2px 4px;
        }
        .pricetype-control{
            line-height:28px;
        }
        .pricetype-control input[type="checkbox"]{
            vertical-align:bottom;
            margin-left:10px;
        }
        .pricetype-control input[type="checkbox"]:first-child{
            margin-left:0;
        }
        .class_name {
            position: relative;
        }
        .class_name .tooltips {
            display:none;
            top:-7px;
            width:100%;
            left:175px;
        }
        /* 感叹号样式 */
        .box_show {
            display: inline-block;
            background-color: #118bd8;
            color: #fff;
            font-size: 12px;
            width: 18px;
            line-height: 18px;
            text-align: center;
            border-radius: 50%;
            position: relative;
        }
        /* 弹窗样式 */
        .content_box {
            display: none;
            position: absolute;
            background-color: #118bd8;
            color: #fff;
            border-radius: 4px;
            height: auto;
            max-width: 300px;
            border: 1px solid #999;
            bottom: 20px;
            text-align: left;
            margin-top: 5px;
            padding: 5px;
        }
        div.content-right {
            min-width: 1000px;
        }

        tr.new .btn-new:nth-child(-n+3),
        tr.new .btn-new:nth-child(n+7):nth-child(-n+100){
            color: #1b8bff;
            background: #ecf5ff;
            border: 1px solid #b3d8ff;
        }
        tr.new .btn-new:nth-child(-n+3):hover,
        tr.new .btn-new:nth-child(n+7):nth-child(-n+100):hover{
            color: #fff;
            background: #409eff;
            border: 1px solid #409eff;
        }

        tr.new .btn-new:nth-child(n+4):nth-child(-n+6){
            color: #fe9f37;
            background: #fdf6ec;
            border: 1px solid #f5dab1;
        }
        tr.new .btn-new:nth-child(n+4):nth-child(-n+6):hover{
            color: #fff;
            background: #eab376;
            border: 1px solid #eab376;
        }
        /* 大于1696px时为一行4个按钮 */
        @media screen and (min-width: 1696px) {
            tr.new .btn-new:nth-child(-n+4):nth-child(-n+100),
            tr.new .btn-new:nth-child(n+9):nth-child(-n+100){
                color: #1b8bff;
                background: #ecf5ff;
                border: 1px solid #b3d8ff;
            }
            tr.new .btn-new:nth-child(-n+4):nth-child(-n+100):hover,
            tr.new .btn-new:nth-child(n+9):nth-child(-n+100):hover{
                color: #fff;
                background: #409eff;
                border: 1px solid #409eff;
            }

            tr.new .btn-new:nth-child(n+5):nth-child(-n+8){
                color: #fe9f37;
                background: #fdf6ec;
                border: 1px solid #f5dab1;
            }
            tr.new .btn-new:nth-child(n+5):nth-child(-n+8):hover{
                color: #fff;
                background: #eab376;
                border: 1px solid #eab376;
            }
        }
        /* 一行2个按钮 */
        @media screen and (min-width: 1301px) and (max-width: 1390px) {
            tr.new .btn-new:nth-child(-n+2):nth-child(-n+100),
            tr.new .btn-new:nth-child(n+5):nth-child(-n+100){
                color: #1b8bff;
                background: #ecf5ff;
                border: 1px solid #b3d8ff;
            }
            tr.new .btn-new:nth-child(-n+2):nth-child(-n+100):hover,
            tr.new .btn-new:nth-child(n+5):nth-child(-n+100):hover{
                color: #fff;
                background: #409eff;
                border: 1px solid #409eff;
            }

            tr.new .btn-new:nth-child(n+3):nth-child(-n+4){
                color: #fe9f37;
                background: #fdf6ec;
                border: 1px solid #f5dab1;
            }
            tr.new .btn-new:nth-child(n+3):nth-child(-n+4):hover{
                color: #fff;
                background: #eab376;
                border: 1px solid #eab376;
            }
        }
    </style>

    <?=Html::cssFile('@web/static/css/common/WdatePicker.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
    <?=Html::cssFile('@web/static/css/common/toolbox.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
</head>
<?php $this->head() ?>
<body class="cp-bodybox">

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


<!-- 右下角悬浮logo -->
<div class="header">
    <div class="inner clearfix blue">
        <div class="fl">
            <a href="http://tp.weifenxiao.com/" class="header-logo">
                <img src="goodsindex_files/logo.png" width="auto" height="100%">            </a>
        </div>
        <!-- end logo -->
        <div class="header-nav fl">
            <ul class="header-nav-list clearfix">
                <li class="fl icon_09  ">
                    <a href="http://tp.weifenxiao.com/Shop/home" class=" hd_item">
                        <p>首页        </p></a>
                </li>
                <li class="fl icon_01  ">
                    <a href="http://tp.weifenxiao.com/Shop/list_homepage" class=" hd_item">
                        <p>店铺        </p></a>
                </li>
                <li class="fl icon_02 active ">
                    <a href="http://tp.weifenxiao.com/Item/lists/item_status/onsale" class=" hd_item">
                        <p>商品        </p></a>
                </li>
                <li class="fl icon_03  ">
                    <a href="http://tp.weifenxiao.com/Order/lists" class=" hd_item">
                        <p>订单        </p></a>
                </li>
                <li class="fl icon_04  member_down">
                    <a href="http://tp.weifenxiao.com/User/lists" class=" hd_item">
                        <p>会员        </p></a>
                </li>
                <li class="fl icon_06  ">
                    <a href="http://tp.weifenxiao.com/Ump/index" class=" hd_item">
                        <p>营销        </p></a>
                </li>
                <li class="fl icon_05  ">
                    <a href="http://tp.weifenxiao.com/Dist/apply_list" class=" hd_item">
                        <p>财务        </p></a>
                </li>
                <li class="fl icon_15  ">
                    <a href="http://tp.weifenxiao.com/Statistics/tradeSituation" class=" hd_item">
                        <p>数据        </p></a>
                </li>
                <li class="fl icon_07  ">
                    <a href="http://tp.weifenxiao.com/System/shopInfo" class=" hd_item">
                        <p>设置        </p></a>
                </li>
                <li class="fl icon_18  ">
                    <a href="http://tp.weifenxiao.com/Shop/community" class=" hd_item">
                        <p>内容电商        </p></a>
                </li>
                <li class="fl icon_21  ">
                    <a href="http://tp.weifenxiao.com/Label/community_video" class=" hd_item">
                        <p>视频卖货        </p></a>
                </li>
                <li class="fl line"></li><li class="fl icon_30  ">
                    <a href="http://tp.weifenxiao.com/WlService/setting.html" target="_blank" class=" hd_item">
                        <p>微聊客服        </p></a>
                </li>
                <li class="fl icon_32  ">
                    <a href="http://tp.weifenxiao.com/System/chuanbobao" target="_blank" class=" hd_item">
                        <p>传播宝        </p></a>
                </li>
            </ul>
            <!---->
        </div>

        <!-- end header-nav -->

        <div class="header-right fr">
        <span class="account_inbox_switch">
            <a href="http://tp.weifenxiao.com/System/notice_list" class="header_mail"></a>
                            </span>
            <ul class="header-ctrl clearfix">
                <li class="header-ctrl-item fl">
                    <a href="javascript:;" class="header-ctrl-item-parent">
                        <div class="shop-img" style="background-image: url( /Public/images/def_shop-logo.png);"></div>

                        <span class="name">15910987706</span>
                    </a>
                    <ul class="header-ctrl-item-children">
                        <div class="triangle-up"></div>
                        <li>
                            <a href="http://tp.weifenxiao.com/Help/lists" target="_blank"><em class="ac_icon ac_icon_help"></em>帮助中心</a>
                        </li>
                        <li>
                            <a href="http://nabizds.vipgz1.idcfengye.com/pdf" target="_blank"><em class="ac_icon ac_icon_make"></em>操作文档</a>
                        </li>
                        <li>
                            <a href="http://tp.weifenxiao.com/Public/updateLog" target="_blank"><em class="ac_icon ac_icon_update"></em>更新日志</a>
                        </li>                    <li>
                            <a href="http://tp.weifenxiao.com/System/console" target="_blank"><em class="ac_icon ac_icon_order"></em>提交工单</a>
                        </li>                    <li>
                            <a href="http://tp.weifenxiao.com/System/updatepwd"><em class="ac_icon ac_icon_password"></em>修改密码</a>
                        </li>
                        <li>
                            <a href="http://tp.weifenxiao.com/System/shopInfo"><em class="ac_icon ac_icon_set"></em>设置</a>
                        </li>
                        <li>
                            <a href="http://tp.weifenxiao.com/Public/logout"><em class="ac_icon ac_icon_logout"></em>退出</a>
                        </li>
                        <p class="limit_time">
                            <strong>版本：</strong><font style="color:red">免费版</font>
                            <br>有效期至：<font style="color:red">[2019-10-29]</font>                                                </p>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- end list -->

        <!--<span class="header-welcome fr ">-->
        <!--<a href="javascript:;" title="15910987706" class="tips" data-trigger="hover" data-placement="top" data-content='<strong>版本：</strong><font style="color:red">免费版</font>'>15910987706</a>-->
        <!---->
        <!--</span>-->
        <!-- end header-welcome -->

    </div>
</div>
    <!-- end header -->
<div class="container">
    <div class="inner style_v2 clearfix">

        <?= $content ?>
        <!-- end content-right -->

        <!--<a href="javascript:;" class="btn-leftMenuFold" id="j-btn-leftMenuFold" ></a>-->
    </div>
</div>
</body>
</html>
<?php $this->endPage() ?>