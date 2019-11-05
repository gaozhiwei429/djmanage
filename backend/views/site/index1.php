<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Url;
/* @var $this yii\web\View */
$this->title = '北京往全保科技有限公司';
?>


<!-- 右下角悬浮logo -->
<div class="header">
    <div class="inner clearfix">
        <div class="fl">
            <a href="http://tp.weifenxiao.com/" class="header-logo">
                <img src="/static/images/common/logo.png" width="auto" height="100%">
            </a>
        </div>
        <!-- end logo -->
        <div class="header-nav fl">
            <ul class="header-nav-list clearfix">
                <?php
                if(isset($menus)) {
                    foreach($menus as $k=>$oneMenu) {
                        ?>
                        <li class="fl icon_0<?=isset($k) ? $k+1 : 1;?> <?=($k==0) ? "active" : "";?>">
                            <a class=" hd_item" href="<?= Url::to([$oneMenu['url']]); ?>" data-menu-node="m-<?=isset($oneMenu['id']) ? $oneMenu['id'] : 0;?>" data-open="<?=isset($oneMenu['url']) ? $oneMenu['url'] : '';?>" target="<?=isset($oneMenu['target']) ? $oneMenu['target'] : '';?>">
                                <p><?=isset($oneMenu['title']) ? $oneMenu['title'] : ''?></p></a>
                        </li>
                    <?php
                    }
                }
                ?>
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
                        <div class="shop-img" style="background-image: url(/static/images/common/def_shop-logo.png);"></div>

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
                            <br>有效期至：<font style="color:red">[2019-10-25]</font>
                        </p>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- end header -->
<div class="container">
    <div class="inner style_v2 clearfix">
        <div id="content-left-box" class="content-left-box fl" style="height: 693px; overflow: hidden; outline: currentcolor none medium;" tabindex="1">
            <div id="content-left" class="content-left content-left-home fl" style="height: 703px;">
                <div class="menu-box">
                    <dl class="left-menu shop_0">
                        <dt>
                            <i class="icon-menu-v2 dpzx"></i>
                            <span id="shop_0" data-id="0">店铺装修</span>
                            <i class="icon-pull"></i>
                        </dt>
                        <dd><a href="http://tp.weifenxiao.com/Shop/list_homepage">店铺主页</a></dd><dd><a href="http://tp.weifenxiao.com/Shop/user_center">会员主页</a></dd><dd><a href="http://tp.weifenxiao.com/Shop/navigation">店铺导航</a></dd>                                    </dl><dl class="left-menu shop_3">
                        <dt>
                            <i class="icon-menu-v2 commodity"></i>
                            <span id="shop_3" data-id="3">商品管理</span>
                            <i class="icon-pull"></i>
                        </dt>
                        <dd><a href="http://tp.weifenxiao.com/Item/lists/item_status/onsale">出售中商品</a></dd><dd><a href="http://tp.weifenxiao.com/Item/lists/item_status/outstock">已售罄商品</a></dd><dd><a href="http://tp.weifenxiao.com/Item/lists/item_status/warn">警戒商品</a></dd>                                    </dl><dl class="left-menu shop_0">
                        <dt>
                            <i class="icon-menu-v2 cwcz"></i>
                            <span id="shop_0" data-id="0">财务操作</span>
                            <i class="icon-pull"></i>
                        </dt>
                        <dd><a href="http://tp.weifenxiao.com/Dist/apply_list">提现申请</a></dd>                                    </dl><dl class="left-menu shop_0">
                        <dt>
                            <i class="icon-menu-v2 jytj"></i>
                            <span id="shop_0" data-id="0">交易数据</span>
                            <i class="icon-pull"></i>
                        </dt>
                        <dd><a href="http://tp.weifenxiao.com/Statistics/tradeSituation">交易概况</a></dd><dd><a href="http://tp.weifenxiao.com/Statistics/itemSituation">商品概况</a></dd><dd><a href="http://tp.weifenxiao.com/Statistics/order_chart">订单统计</a></dd>                                    </dl><dl class="left-menu shop_0">
                        <dt>
                            <i class="icon-menu-v2 hytj"></i>
                            <span id="shop_0" data-id="0">会员数据</span>
                            <i class="icon-pull"></i>
                        </dt>
                        <dd><a href="http://tp.weifenxiao.com/Statistics/userSituation">会员概况</a></dd>                                    </dl><dl class="left-menu shop_0">
                        <dt>
                            <i class="icon-menu-v2 yxtj"></i>
                            <span id="shop_0" data-id="0">营销数据</span>
                            <i class="icon-pull"></i>
                        </dt>
                        <dd><a href="http://tp.weifenxiao.com/Statistics/couponStatistics">优惠券统计</a></dd>                                    </dl><dl class="left-menu shop_21">
                        <dt>
                            <i class="icon-menu-v2 cog"></i>
                            <span id="shop_21" data-id="21">系统设置</span>
                            <i class="icon-pull"></i>
                        </dt>
                        <dd><a href="http://tp.weifenxiao.com/System/shopInfo">店铺信息</a></dd>                                    </dl>                </div>
                <!-- <div class="drawer-box"></div> -->
            </div>
        </div>
        <!-- end content-left -->
        <div id="content-right-box" class="content-right-box">
            <div class="content-right">
                <h1 class="content-right-title">欢迎您！</h1>
                <div class="btn_config"><i class="icon_config"></i><span>配置</span></div>
                <div class="home_config_box_overlay"></div> <!-- 遮罩层 -->
                <div id="home_config_box">
                    <div class="config_panel">
                        <h2 class="config_title"><i class="icon"></i>配置首页展示面板</h2>
                        <div class="config_info">
                            <div class="config_options">
                                <div class="config_row">
                                    <h3>订单</h3>
                                    <div class="config_row_options">
                                        <div class="config_row_item has-success">
                                            <label class="config_checkbox_wrapper">
                                    <span class="config_checkbox">
                                        <input type="checkbox" class="config_checkbox_input" data-id="chart_ddzs" value="1">
                                        <span class="config_checkbox_inner"></span>
                                    </span>
                                                <span class="config_txt">订单笔数趋势图</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="config_row_options">
                                        <div class="config_row_item has-success">
                                            <label class="config_checkbox_wrapper">
                                    <span class="config_checkbox">
                                        <input type="checkbox" class="config_checkbox_input" data-id="chart_ddbspei" value="1">
                                        <span class="config_checkbox_inner"></span>
                                    </span>
                                                <span class="config_txt">订单笔数占比图</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="config_row_options">
                                        <div class="config_row_item has-success">
                                            <label class="config_checkbox_wrapper">
                                    <span class="config_checkbox">
                                        <input type="checkbox" class="config_checkbox_input" data-id="chart_ddje" value="1">
                                        <span class="config_checkbox_inner"></span>
                                    </span>
                                                <span class="config_txt">订单金额趋势图</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="config_row_options">
                                        <div class="config_row_item has-success">
                                            <label class="config_checkbox_wrapper">
                                    <span class="config_checkbox">
                                        <input type="checkbox" class="config_checkbox_input" data-id="chart_ddtjpei" value="1">
                                        <span class="config_checkbox_inner"></span>
                                    </span>
                                                <span class="config_txt">订单金额占比图</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="config_row">
                                    <h3>商城利润</h3>
                                    <div class="config_row_options">
                                        <div class="config_row_item has-success">
                                            <label class="config_checkbox_wrapper">
                                    <span class="config_checkbox">
                                        <input type="checkbox" class="config_checkbox_input" data-id="mall_accounted" value="1">
                                        <span class="config_checkbox_inner"></span>
                                    </span>
                                                <span class="config_txt">商城利润对比图</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="config_row_options">
                                        <div class="config_row_item has-success">
                                            <label class="config_checkbox_wrapper">
                                    <span class="config_checkbox">
                                        <input type="checkbox" class="config_checkbox_input" data-id="mall_trend" value="1">
                                        <span class="config_checkbox_inner"></span>
                                    </span>
                                                <span class="config_txt">商城利润趋势图</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="config_row">
                                    <h3>交易完成订单</h3>
                                    <div class="config_row_options">
                                        <div class="config_row_item has-success">
                                            <label class="config_checkbox_wrapper">
                                    <span class="config_checkbox">
                                        <input type="checkbox" class="config_checkbox_input" data-id="chart_jywcdd" value="1">
                                        <span class="config_checkbox_inner"></span>
                                    </span>
                                                <span class="config_txt">交易完成订单笔数趋势图</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="config_row_options">
                                        <div class="config_row_item has-success">
                                            <label class="config_checkbox_wrapper">
                                    <span class="config_checkbox">
                                        <input type="checkbox" class="config_checkbox_input" data-id="chart_jywcddpei" value="1">
                                        <span class="config_checkbox_inner"></span>
                                    </span>
                                                <span class="config_txt">交易完成订单佣金支出占比图</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="config_row">
                                    <h3>分销订单</h3>
                                    <div class="config_row_options">
                                        <div class="config_row_item has-success">
                                            <label class="config_checkbox_wrapper">
                                    <span class="config_checkbox">
                                        <input type="checkbox" class="config_checkbox_input" data-id="chart_fxddzs" value="1">
                                        <span class="config_checkbox_inner"></span>
                                    </span>
                                                <span class="config_txt">分销订单笔数趋势图</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="config_row_options">
                                        <div class="config_row_item has-success">
                                            <label class="config_checkbox_wrapper">
                                    <span class="config_checkbox">
                                        <input type="checkbox" class="config_checkbox_input" data-id="chart_fxddtjpei" value="1">
                                        <span class="config_checkbox_inner"></span>
                                    </span>
                                                <span class="config_txt">分销订单金额占比图</span>
                                            </label>
                                        </div>
                                    </div>

                                    <!-- <div class="config_row_options">
                                        <div class="config_row_item has-success">
                                            <label class="config_checkbox_wrapper">
                                                <span class="config_checkbox">
                                                    <input type="checkbox" class="config_checkbox_input" data-id="chart_mmpv" value="1">
                                                    <span class="config_checkbox_inner"></span>
                                                </span>
                                                <span class="config_txt">最近15分钟实时PV情况</span>
                                            </label>
                                        </div>
                                    </div> -->
                                </div>
                                <div class="config_row">
                                    <h3>排行榜</h3>
                                    <div class="config_row_options">
                                        <div class="config_row_item has-success">
                                            <label class="config_checkbox_wrapper">
                                    <span class="config_checkbox">
                                        <input type="checkbox" class="config_checkbox_input" data-id="ranking_goods" value="1">
                                        <span class="config_checkbox_inner"></span>
                                    </span>
                                                <span class="config_txt">商品畅销榜</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="config_row_options">
                                        <div class="config_row_item has-success">
                                            <label class="config_checkbox_wrapper">
                                    <span class="config_checkbox">
                                        <input type="checkbox" class="config_checkbox_input" data-id="ranking_members" value="1">
                                        <span class="config_checkbox_inner"></span>
                                    </span>
                                                <span class="config_txt">下级会员英雄榜</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="config_row">
                                    <h3>会员数量</h3>
                                    <div class="config_row_options">
                                        <div class="config_row_item has-success">
                                            <label class="config_checkbox_wrapper">
                                    <span class="config_checkbox">
                                        <input type="checkbox" class="config_checkbox_input" data-id="chart_xzhy" value="1">
                                        <span class="config_checkbox_inner"></span>
                                    </span>
                                                <span class="config_txt">新增会员趋势图</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="config_row_options">
                                        <div class="config_row_item has-success">
                                            <label class="config_checkbox_wrapper">
                                    <span class="config_checkbox">
                                        <input type="checkbox" class="config_checkbox_input" data-id="chart_fxsslpei" value="1">
                                        <span class="config_checkbox_inner"></span>
                                    </span>
                                                <span class="config_txt">分销商数量占比图</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="config_button">
                                <button type="button" class="config_btn config_btn_confirm config_btn_primary">
                                    <span>确 定</span>
                                </button>
                                <button type="button" class="config_btn config_btn_cancel">
                                    <span>取 消</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="shop-wrap" style="min-height:72px;">
                    <div class="zh_infor_box clearfix" data-type="/Shop/getTongJi" id="getTongJi">
                        <div class="zh_infor_left">

                            <div class="zh_infor_tt">
                                <i class="lit_icon mfl"></i>
                                <span class="itt"><b>当前账号：</b></span>15910987706        <span class="head-hint">注：首页统计数据30分钟更新一次。</span>
                            </div>
                            <div class="zh_infor_cent" style="margin-top:8px;">
                                <div class="zh_infor_item">
                                    <a href="http://tp.weifenxiao.com/User/agent_list" data-ripple="ripple">
                                        <div class="zh_infor_item_icon"><img src="index_files/icon_fxss.png" alt=""></div>
                                        <div class="zh_infor_item_con">
                                            <span class="zh_title">会员数</span>
                                            <span class="zh_data">0</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="zh_infor_item" data-ripple="ripple">
                                    <a href="javascript:;">
                                        <div class="zh_infor_item_icon"><img src="index_files/icon_zhye.png" alt=""></div>
                                        <div class="zh_infor_item_con">
                                            <span class="zh_title">账户余额</span>
                                            <span class="zh_data">0</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="zh_infor_item" data-ripple="ripple">
                                    <a href="http://tp.weifenxiao.com/Dist/apply_list">
                                        <div class="zh_infor_item_icon"><img src="index_files/icon_sqtx.png" alt=""></div>
                                        <div class="zh_infor_item_con">
                                            <span class="zh_title">申请提现笔数</span>
                                            <span class="zh_data">0</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="zh_infor_item" data-ripple="ripple">
                                    <a href="javascript:;">
                                        <div class="zh_infor_item_icon"><img src="index_files/icon_yzcyj.png" alt=""></div>
                                        <div class="zh_infor_item_con">
                                            <span class="zh_title">已支出佣金<i href="javascript:;" class="tips gicon-info-sign" data-trigger="hover" data-placement="left" data-content="提成收入 + 卖家调整（增加）+代理商佣金收入 + 分红提成+门店奖励 + 门店佣金+员工佣金+众筹订单佣金+众筹订单代理商佣金+订货商佣金收入+代理商销售奖收入+订货商销售奖收入 - 卖家调整（减少）"></i></span>
                                            <span class="zh_data">0</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="zh_infor_item" data-ripple="ripple">
                                    <a href="javascript:;">
                                        <div class="zh_infor_item_icon"><img src="index_files/icon_yjye.png" alt=""></div>
                                        <div class="zh_infor_item_con">
                                            <span class="zh_title">佣金余额<i href="javascript:;" class="tips gicon-info-sign" data-trigger="hover" data-placement="left" data-content="所有用户的佣金余额之和"></i></span>
                                            <span class="zh_data">0</span>
                                        </div>
                                    </a>
                                    <span class="ripple" style="top: -92.3333px; left: 72px; width: 220.667px; height: 220.667px; animation-duration: 1s; background: rgb(238, 246, 238) none repeat scroll 0% 0%; opacity: 0.4;"></span></div>
                                <div class="zh_infor_item" data-ripple="ripple">
                                    <a href="javascript:;">
                                        <div class="zh_infor_item_icon"><img src="index_files/icon_dsyyj.png" alt=""></div>
                                        <div class="zh_infor_item_con">
                                            <span class="zh_title">待收益佣金</span>
                                            <span class="zh_data">0</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="zh_infor_right mgt10">
                            <div class="zh_infor_tt">
                                <i class="lit_icon mfr"></i>
                                <span class="itt"><b>库存提醒：</b></span><a href="http://tp.weifenxiao.com/Item/lists/item_status/warn">有<span class="red">0</span>件商品已达到警戒库存</a>
                            </div>
                            <div class="zh_infor_cent" style="margin-top:8px;">
                                <div class="zh_infor_item" data-ripple="ripple">
                                    <a href="http://tp.weifenxiao.com/Item/lists/item_status/onsale">
                                        <div class="zh_infor_item_icon"><img src="index_files/icon_cszsps.png" alt=""></div>
                                        <div class="zh_infor_item_con">
                                            <span class="zh_title">出售中的商品数</span>
                                            <span class="zh_data">0</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="zh_infor_item" data-ripple="ripple">
                                    <a href="http://tp.weifenxiao.com/Item/lists/item_status/onsku">
                                        <div class="zh_infor_item_icon"><img src="index_files/icon_ckzsps.png" alt=""></div>
                                        <div class="zh_infor_item_con">
                                            <span class="zh_title">仓库中商品数</span>
                                            <span class="zh_data">0</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="zh_infor_item" data-ripple="ripple">
                                    <a href="http://tp.weifenxiao.com/Item/lists/item_status/outstock">
                                        <div class="zh_infor_item_icon"><img src="index_files/icon_ysqsps.png" alt=""></div>
                                        <div class="zh_infor_item_con">
                                            <span class="zh_title">已售罄的商品数</span>
                                            <span class="zh_data">0</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="zh_infor_item" data-ripple="ripple">
                                    <a href="http://tp.weifenxiao.com/Order/lists/status/0">
                                        <div class="zh_infor_item_icon"><img src="index_files/icon_dfkdds.png" alt=""></div>
                                        <div class="zh_infor_item_con">
                                            <span class="zh_title">待付款订单数</span>
                                            <span class="zh_data">0</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="zh_infor_item" data-ripple="ripple">
                                    <a href="http://tp.weifenxiao.com/Order/lists/status/1">
                                        <div class="zh_infor_item_icon"><img src="index_files/icon_dfhdds.png" alt=""></div>
                                        <div class="zh_infor_item_con">
                                            <span class="zh_title">待发货订单数</span>
                                            <span class="zh_data">0</span>
                                        </div>
                                    </a>
                                    <span class="ripple" style="top: -53.3333px; left: 4.00005px; width: 220.667px; height: 220.667px; animation-duration: 1s; background: rgb(238, 246, 238) none repeat scroll 0% 0%; opacity: 0.4;"></span></div>
                                <div class="zh_infor_item" data-ripple="ripple">
                                    <a href="http://tp.weifenxiao.com/Order/exchange">
                                        <div class="zh_infor_item_icon"><img src="index_files/icon_dtdds.png" alt=""></div>
                                        <div class="zh_infor_item_con">
                                            <span class="zh_title">待退/换货订单数</span>
                                            <span class="zh_data">0</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div></div>
                </div>
                <!-- 数据统计 -->
                <div class="shop-wrap">
                    <div class="shop-title">
                        <i class="lit_icon"></i>
            <span class="itt"><b>数据统计</b>
        </span></div>
                    <div id="tBodyGetTotalCcount" class="dataItem-box">    <div class="data-box">
                            <div class="dataItems">
                                <span class="num1">0</span>
                            </div>
                            <div class="dataItems">总计订单数
                                <a href="javascript:;" class="tips gicon-info-sign" data-trigger="hover" data-placement="left" data-content="状态为已付款、待收货、交易完成的订单总数"></a>
                            </div>
                            <!-- <div class="dataItems">环比增幅
                                <span class="num2 data-rise">% <i class="icon-tablesData"></i>
                                </span>
                            </div> -->
                        </div>
                        <div class="data-box">
                            <div class="dataItems">
                                <span class="num1">0</span>
                            </div>
                            <div class="dataItems">总消费金额
                            </div>
                            <!-- <div class="dataItems">环比增幅
                                <span class="num2 data-rise">% <i class="icon-tablesData"></i>
                                </span>
                            </div> -->
                        </div>

                        <div class="data-box">
                            <div class="dataItems">
                                <span class="num1">0</span>
                            </div>
                            <div class="dataItems">本月订单数</div>
                            <!-- <div class="dataItems">环比增幅
                                <span class="num2 data-rise">% <i class="icon-tablesData"></i>
                                </span>
                            </div> -->
                        </div>
                        <div class="data-box">
                            <div class="dataItems">
                                <!--<span class="num1">0</span>-->
                                <span class="num1">0</span>
                            </div>
                            <div class="dataItems">本月消费金额</div>
                            <!-- <div class="dataItems">环比增幅
                                <span class="num2 data-rise"> % <i class="icon-tablesData"></i>
                                </span>
                            </div> -->
                        </div>
                        <!--
                        <td class="bdr">
                            <div class="dataItems">昨日店铺浏览量</div>
                            <div class="dataItems">
                                <span class="num1"></span>
                            </div>
                            <div class="dataItems">环比增幅
                                <span class="num2 data-rise"> % <i class="icon-tablesData"></i>
                                </span>
                            </div>
                        </td>
                        --></div>
                </div>
                <div class="chartDrag-box clearfix ui-sortable">
                    <!-- 订单笔数趋势图 -->

                    <!-- 订单金额趋势图 -->
                    <!-- <div class="chartWrap chartDrag clearfix chartDrag1" data-ordernum="1"> -->





                    <!-- <div class="chartWrap chartDrag clearfix chartDrag2" data-ordernum="2"> -->
                    <!-- 分销订单笔数趋势图 -->


                    <!-- 商城利润占比图 -->


                    <!-- 商城利润趋势图 -->




                    <!-- <div class="chartWrap chartDrag clearfix chartDrag2" data-ordernum="4"> -->








                    <!-- pv值 -->

                    <div class="shop-wrap chartDrag show width100 fl ui-sortable-handle" data-ordernum="0">
                        <div class="shop-title pos-abs">
                            <i class="lit_icon"></i>
                <span class="itt j-pull">
                    <b>订单笔数趋势图</b>
                </span>
                            <div class="fxddzs-info fr" style="margin-right: 60px;">
                                <div class="live-today fl">
                                    <span>今日付款订单数：</span><strong id="ddzs_t" style="color:#ff9015;">0</strong>
                                </div>
                                <div class="live-yesterday fr">
                                    <span>昨日付款订单数：</span><strong id="ddzs_y" style="color:#ff9015;">0</strong>
                                </div>
                            </div>
                            <div class="legend-ico">
                                <div class="legend-box">
                                    <div class="live-today">
                                        <span>今日未付款订单数：</span><strong id="jywcdd_t">0</strong>
                                    </div>
                                    <div class="live-yesterday">
                                        <span id="legend-y">昨日未付款订单数：</span><strong id="jywcdd_y">0</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="shop-content">
                            <div class="table-loading" id="loading_chart_ddzs" style="display: none;">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-warning progress-bar-striped active" style="width: 100%;"></div>
                                </div>
                            </div>
                            <div id="chart_ddzs" class="mgt7 txtCenter j-chartPanel" style="height: 300px; user-select: none; position: relative;" _echarts_instance_="ec_1572009985993"><div style="position: relative; overflow: hidden; width: 1374px; height: 300px; padding: 0px; margin: 0px; border-width: 0px;"><canvas style="position: absolute; left: 0px; top: 0px; width: 1374px; height: 300px; user-select: none; padding: 0px; margin: 0px; border-width: 0px;" data-zr-dom-id="zr_0" width="1374" height="300"></canvas></div><div></div></div>
                        </div>
                    </div><div class="shop-wrap chartDrag show width50 fl ui-sortable-handle" style="display: none;">
                        <div class="shop-title pos-abs z-index2">
                            <i class="lit_icon"></i>
                            <span class="itt"><b>商城利润对比图</b><i href="javascript:;" class="tips gicon-info-sign" data-trigger="hover" data-placement="left" data-content="上周与上上周利润占比"></i></span>
                        </div>
                        <div class="mall_profits">
                            <div class="table-loading loading_mall_accounted1">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-warning progress-bar-striped active" style="width: 100%;"></div>
                                </div>
                            </div>
                            <div id="mall_accounted"></div>
                        </div>
                    </div><div class="shop-wrap chartDrag show width50 fl ui-sortable-handle" style="display: none;">
                        <div class="shop-title pos-abs z-index2" style="width:auto;">
                            <i class="lit_icon"></i>
                            <span class="itt"><b>商城利润趋势图</b><i href="javascript:;" class="tips gicon-info-sign" data-trigger="hover" data-placement="left" data-content="利润额 = 订单实付金额 - 佣金 - 运费 - 商品税费 - 商品成本价（商品成本价优先级：1.SKU成本价；2.商品成本价；3.SKU供货价；4.商品供货价）"></i></span>
                        </div>
                        <div class="mall_screening">
                            <input type="text" id="start" autocomplete="off" name="start_time" placeholder="开始时间" class="input mini Wdate" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})">
                            <span class="mgr5">至</span>
                            <input type="text" id="end" autocomplete="off" name="end_time" placeholder="结束时间" class="input mini Wdate" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})">
                            <button class="btn btn-primary" style="vertical-align:-2px;"><i class="gicon-search white"></i>查询</button>
                        </div>
                        <div class="mall_profits">
                            <div class="table-loading loading_mall_accounted2">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-warning progress-bar-striped active" style="width: 100%;"></div>
                                </div>
                            </div>
                            <div id="mall_trend"></div>
                        </div>
                    </div><div class="shop-wrap chartDrag show chartDrag1 width50 fl ui-sortable-handle">
                        <div class="shop-title pos-abs shop-title_show">
                            <i class="lit_icon"></i>
                            <span class="itt"><b>订单金额趋势图</b> </span>
                            <div class="legend-ico legend-ico-small">
                                <div class="legend-box">
                                    <div class="live-today live-today1">
                                        <span>当天付款订单金额：</span><strong id="ddjezs_t">当天创建并付款的订单总金额</strong>
                                    </div>
                                    <div class="live-yesterday live-yesterday1">
                                        <span>当天所有订单金额：</span><strong id="ddjezs_y">当天创建的所有订单总金额</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="shop-content">
                            <div class="table-loading" id="loading_chart_ddje" style="display: none;">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-warning progress-bar-striped active" style="width: 100%;"></div>
                                </div>
                            </div>
                            <div id="chart_ddje" class="mgt7 txtCenter j-chartPanel" style="height: 250px; user-select: none; position: relative;" _echarts_instance_="ec_1572009985991"><div style="position: relative; overflow: hidden; width: 661px; height: 250px; padding: 0px; margin: 0px; border-width: 0px;"><canvas style="position: absolute; left: 0px; top: 0px; width: 661px; height: 250px; user-select: none; padding: 0px; margin: 0px; border-width: 0px;" data-zr-dom-id="zr_0" width="661" height="250"></canvas></div><div></div></div>
                        </div>
                    </div><div class="shop-wrap chartDrag show width50 fl ui-sortable-handle">
                        <div class="shop-title pos-abs z-index2">
                            <i class="lit_icon"></i>
                            <span class="itt"><b>订单金额占比图</b></span>
                        </div>
                        <div class="shop-content">
                            <div class="table-loading" id="loading_chart_ddtjpei" style="display: none;">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-warning progress-bar-striped active" style="width: 100%;"></div>
                                </div>
                            </div>
                            <div id="chart_ddtjpei" class="mgt7 txtCenter j-chartPanel" style="height: 250px; user-select: none; position: relative;" _echarts_instance_="ec_1572009985998"><div style="position: relative; overflow: hidden; width: 661px; height: 250px; padding: 0px; margin: 0px; border-width: 0px;"><canvas style="position: absolute; left: 0px; top: 0px; width: 661px; height: 250px; user-select: none; padding: 0px; margin: 0px; border-width: 0px;" data-zr-dom-id="zr_0" width="661" height="250"></canvas></div><div></div></div>
                        </div>
                    </div><div class="shop-wrap chartDrag show width50 fl ui-sortable-handle">
                        <div class="shop-title pos-abs">
                            <i class="lit_icon"></i>
                <span class="itt j-pull">
                    <b>分销订单笔数趋势图</b>
                </span>

                            <div class="fxddzs-info fr">
                                <div class="live-today fl">
                                    <span>今日分销订单笔数：</span><strong id="fxddzs_t">0</strong>
                                </div>
                                <div class="live-yesterday fr">
                                    <span>昨日分销订单笔数：</span><strong id="fxddzs_y">0</strong>
                                </div>
                            </div>
                        </div>
                        <div class="shop-content">
                            <div class="table-loading" id="loading_chart_fxddzs" style="display: none;">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-warning progress-bar-striped active" style="width: 100%;"></div>
                                </div>
                            </div>
                            <div id="chart_fxddzs" class="mgt7 txtCenter j-chartPanel" style="height: 250px; user-select: none; position: relative;" _echarts_instance_="ec_1572009985996"><div style="position: relative; overflow: hidden; width: 661px; height: 250px; padding: 0px; margin: 0px; border-width: 0px;"><canvas style="position: absolute; left: 0px; top: 0px; width: 661px; height: 250px; user-select: none; padding: 0px; margin: 0px; border-width: 0px;" data-zr-dom-id="zr_0" width="661" height="250"></canvas></div><div></div></div>
                        </div>
                    </div><div class="shop-wrap chartDrag show width50 fl ui-sortable-handle">
                        <div class="shop-title pos-abs z-index2">
                            <i class="lit_icon"></i>
                            <span class="itt"><b>分销订单金额占比图</b></span>
                        </div>
                        <div class="shop-content" style="display:relative;">
                            <div class="table-loading" id="loading_chart_fxddtjpei" style="display: none;">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-warning progress-bar-striped active" style="width: 100%;"></div>
                                </div>
                            </div>
                            <div id="chart_fxddtjpei" class="mgt7 txtCenter j-chartPanel" style="height: 250px; user-select: none; position: relative;" _echarts_instance_="ec_1572009985997"><div style="position: relative; overflow: hidden; width: 661px; height: 250px; padding: 0px; margin: 0px; border-width: 0px;"><canvas style="position: absolute; left: 0px; top: 0px; width: 661px; height: 250px; user-select: none; padding: 0px; margin: 0px; border-width: 0px;" data-zr-dom-id="zr_0" width="661" height="250"></canvas></div><div></div></div>
                        </div>
                    </div><div class="shop-wrap chartDrag show width50 fl ui-sortable-handle" style="display: none;">
                        <div class="shop-title pos-abs z-index2">
                            <i class="lit_icon"></i>
                            <span class="itt"><b>交易完成订单笔数趋势图</b></span>
                            <div class="jywcdd-info fr">
                                <div class="live-today fl">
                                    <span>今日交易完成订单笔数：</span><strong id="jywcdd_t"></strong>
                                </div>
                                <div class="live-yesterday fr">
                                    <span>昨日交易完成订单笔数：</span><strong id="jywcdd_y"></strong>
                                </div>
                            </div>
                        </div>
                        <div class="shop-content" style="display:relative;">
                            <div class="table-loading" id="loading_chart_jywcdd" style="display: none;">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-warning progress-bar-striped active" style="width: 100%;"></div>
                                </div>
                            </div>
                            <div id="chart_jywcdd" class="mgt7 txtCenter j-chartPanel" style="height: 250px; user-select: none; position: relative;" _echarts_instance_="ec_1572009985995"><div style="position: relative; overflow: hidden; width: 0px; height: 250px; padding: 0px; margin: 0px; border-width: 0px;"><canvas style="position: absolute; left: 0px; top: 0px; width: 0px; height: 250px; user-select: none; padding: 0px; margin: 0px; border-width: 0px;" data-zr-dom-id="zr_0" width="0" height="250"></canvas></div><div></div></div>
                        </div>
                    </div><div class="shop-wrap chartDrag show width50 fl ui-sortable-handle" style="display: none;">
                        <div class="shop-title pos-abs z-index2">
                            <i class="lit_icon"></i>
                            <span class="itt"><b>交易完成订单佣金支出占比图</b></span>
                        </div>
                        <div class="shop-content" style="display:relative;">
                            <div class="table-loading" id="loading_chart_jywcddpei" style="display: none;">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-warning progress-bar-striped active" style="width: 100%;"></div>
                                </div>
                            </div>
                            <div id="chart_jywcddpei" class="mgt7 txtCenter j-chartPanel" style="height: 250px; user-select: none; position: relative;" _echarts_instance_="ec_1572009985999"><div style="position: relative; overflow: hidden; width: 0px; height: 250px; padding: 0px; margin: 0px; border-width: 0px;"><canvas style="position: absolute; left: 0px; top: 0px; width: 0px; height: 250px; user-select: none; padding: 0px; margin: 0px; border-width: 0px;" data-zr-dom-id="zr_0" width="0" height="250"></canvas></div><div></div></div>
                        </div>
                    </div><div class="shop-wrap chartDrag show width50 fl ui-sortable-handle" style="display: none;">
                        <div class="shop-title pos-abs z-index2">
                            <i class="lit_icon"></i>
                            <span class="itt"><b>订单笔数占比图</b></span>
                        </div>
                        <div class="shop-content">
                            <div class="table-loading" id="loading_chart_ddbspei" style="display: none;">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-warning progress-bar-striped active" style="width: 100%;"></div>
                                </div>
                            </div>
                            <div id="chart_ddbspei" class="mgt7 txtCenter j-chartPanel" style="height: 250px; user-select: none; position: relative;" _echarts_instance_="ec_1572009985992"><div style="position: relative; overflow: hidden; width: 0px; height: 250px; padding: 0px; margin: 0px; border-width: 0px;"><canvas style="position: absolute; left: 0px; top: 0px; width: 0px; height: 250px; user-select: none; padding: 0px; margin: 0px; border-width: 0px;" data-zr-dom-id="zr_0" width="0" height="250"></canvas></div><div></div></div>
                        </div>
                    </div><div class="shop-wrap chartDrag show chartDrag3 fl ui-sortable-handle" data-ordernum="3">
                        <div class="shop-title pos-abs">
                            <i class="lit_icon"></i>
                    <span class="itt"><b>最近15分钟实时PV情况</b>
                </span></div>
                        <div class="shop-content">
                            <div class="table-loading" id="loading_chart_mmpv" style="display: none;">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-warning progress-bar-striped active" style="width: 100%;"></div>
                                </div>
                            </div>
                            <div id="chart_mmpv" class="mgt7 txtCenter j-chartPanel" style="height: 250px; user-select: none; position: relative;" _echarts_instance_="ec_1572009985994"><div style="position: relative; overflow: hidden; width: 1374px; height: 250px; padding: 0px; margin: 0px; border-width: 0px;"><canvas style="position: absolute; left: 0px; top: 0px; width: 1374px; height: 250px; user-select: none; padding: 0px; margin: 0px; border-width: 0px;" data-zr-dom-id="zr_0" width="1374" height="250"></canvas></div><div></div></div>
                        </div>
                    </div><div class="shop-wrap chartDrag show width50 fl ui-sortable-handle" style="display: none;">
                        <div class="shop-title pos-abs z-index2">
                            <i class="lit_icon"></i>
                            <span class="itt"><b>商品畅销榜</b></span>
                            <div class="more_info fr">
                                <a href="http://tp.weifenxiao.com/Item/saleslists" target="_blank" class="h_blue">查看更多</a>
                            </div>
                        </div>
                        <div class="shop-content" style="display:relative;">
                            <div class="table-loading" id="loading_ranking_goods" style="display: none;">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-warning progress-bar-striped active" style="width: 100%;"></div>
                                </div>
                            </div>
                            <div id="ranking_goods" class="mgt7 txtCenter j-chartPanel ranking_box" style="height: 250px;"><div class="diy_table">
                                    <div class="diy_thead">
                                        <div class="diy_tr clearfix">
                                            <div class="diy_td">排名</div>
                                            <div class="diy_td">商品图</div>
                                            <div class="diy_td">商品名称</div>
                                            <div class="diy_td">销量</div>
                                        </div>
                                    </div>
                                    <div class="diy_tbody">

                                    </div>
                                </div></div>
                        </div>
                    </div><div class="shop-wrap chartDrag show width50 fl ui-sortable-handle" style="display: none;">
                        <div class="shop-title pos-abs z-index2">
                            <i class="lit_icon"></i>
                            <span class="itt"><b>下级会员英雄榜</b></span>
                            <div class="more_info fr">
                                <a href="http://tp.weifenxiao.com/Chart/lower" target="_blank" class="h_blue">查看更多</a>
                            </div>
                        </div>
                        <div class="shop-content" style="display:relative;">
                            <div class="table-loading" id="loading_ranking_members" style="display: none;">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-warning progress-bar-striped active" style="width: 100%;"></div>
                                </div>
                            </div>
                            <div id="ranking_members" class="mgt7 txtCenter j-chartPanel ranking_box" style="height: 250px;"><div class="diy_table">
                                    <div class="diy_thead">
                                        <div class="diy_tr clearfix">
                                            <div class="diy_td">排名</div>
                                            <div class="diy_td">会员头像</div>
                                            <div class="diy_td">会员昵称</div>
                                            <div class="diy_td">本月下级会员</div>
                                        </div>
                                    </div>
                                    <div class="diy_tbody">

                                    </div>
                                </div></div>
                        </div>
                    </div><div class="shop-wrap chartDrag show width50 fl ui-sortable-handle" style="display: none;">
                        <div class="shop-title pos-abs z-index2">
                            <i class="lit_icon"></i>
                            <span class="itt"><b>新增会员趋势图</b></span>
                        </div>
                        <div class="shop-content" style="display:relative;">
                            <div class="table-loading" id="loading_chart_xzhy" style="display: none;">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-warning progress-bar-striped active" style="width: 100%;"></div>
                                </div>
                            </div>
                            <div id="chart_xzhy" class="mgt7 txtCenter j-chartPanel" style="height: 250px; user-select: none; position: relative;" _echarts_instance_="ec_1572009986000"><div style="position: relative; overflow: hidden; width: 100px; height: 250px; padding: 0px; margin: 0px; border-width: 0px;"><canvas style="position: absolute; left: 0px; top: 0px; width: 100px; height: 250px; user-select: none; padding: 0px; margin: 0px; border-width: 0px;" data-zr-dom-id="zr_0" width="100" height="250"></canvas></div><div></div></div>
                        </div>
                    </div><div class="shop-wrap chartDrag show width50 fl ui-sortable-handle" style="display: none;">
                        <div class="shop-title pos-abs z-index2">
                            <i class="lit_icon"></i>
                            <span class="itt"><b>分销商数量占比图</b></span>
                        </div>
                        <div class="shop-content" style="display:relative;">
                            <div class="table-loading" id="loading_chart_fxsslpei" style="display: none;">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-warning progress-bar-striped active" style="width: 100%;"></div>
                                </div>
                            </div>
                            <div id="chart_fxsslpei" class="mgt7 txtCenter j-chartPanel" style="height: 250px; user-select: none; position: relative;" _echarts_instance_="ec_1572009986001"><div style="position: relative; overflow: hidden; width: 0px; height: 250px; padding: 0px; margin: 0px; border-width: 0px;"><canvas style="position: absolute; left: 0px; top: 0px; width: 0px; height: 250px; user-select: none; padding: 0px; margin: 0px; border-width: 0px;" data-zr-dom-id="zr_0" width="0" height="250"></canvas></div><div></div></div>
                        </div>
                    </div></div>


                <!-- 续费弹窗 -->
                <div class="renew_overlay"></div>
                <div id="renew_box" class="renew_box_con">
                    <h2 class="renew_ico">续费</h2>
                    <i class="close_box J_close_box">×</i>
                    <div class="renew_box_detail">
                        <div class="renew_box_mid">
                            <form action="" method="post">
                                <div class="item clearfix">
                                    <span class="fl left">续费方式：</span>
                                    <span class="fl renew_type"></span>
                                </div>
                                <div class="item clearfix">
                                    <span class="fl left">对公支付宝账户：</span>
                                    <span class="fl">杭州启博科技有限公司</span>
                                </div>
                                <div class="item clearfix">
                                    <label class="fl left">付款金额：</label>
                                    <input type="text" name="renew_price" placeholder="续费金额，联系客服专员" class="fl">
                                </div>
                                <div class="item clearfix">
                                    <label class="fl left">付款说明：</label>
                                    <input type="text" name="renew_info" placeholder="如需备注，请填写备注信息" class="fl">
                                </div>
                                <div class="item clearfix">
                                    <a href="javascript:;" class="pay_btn fl">确认支付</a>
                                </div>
                            </form>
                            <div class="item clearfix">
                                <span class="fl left">对公银行账号：</span>
                                <span class="fl bank"><img src="index_files/JH_bank_home.png"><span class="tip">如有问题请联系客服专员</span></span>
                            </div>
                            <div class="item clearfix">
                                <span class="fl left">续费客服：</span>
                    <span class="tel fl">
                        <img src="index_files/tel_icon.png"><span>0571-56509929</span>
                    </span>
                                <div class="chat_mode fl">
                                    <a href="tencent://message/?uin=80068391" class="qq_chat"><img src="index_files/qq_chat.png"></a>
                                    <!--<a href="http://www.taobao.com/webww/ww.php?ver=3&touid=%E6%B7%98%E5%BA%97%E9%80%9A&siteid=cntaobao&status=1&charset=utf-8" target="_blank" class="ww_chat"><img src="/Public/images/ww_chat.png" /></a>-->
                                </div>
                            </div>
                        </div>
                        <!-- <div class="renew_box_bottom">

                        </div>


                        <div class="renew_box_top">
                            <h2></h2>

                        </div> -->
                    </div>
                </div>
