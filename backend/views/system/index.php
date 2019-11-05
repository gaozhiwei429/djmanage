<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */

?>
<div id="content-left-box" class="content-left-box fl" style="height: 693px;">
    <div id="content-left" class="content-left  fl">
        <aside class="sec" style="height: 693px;">
            <dl class="left-menu shop_3" data-type="sub_commodity" data-title="商品管理">
                <dt class="active">
                    <i class="icon-menu-v2 commodity"></i>                                <span id="shop_3" data-id="3">商品管理</span>
                </dt>
            </dl><dl class="left-menu shop_0" data-type="sub_lmgl" data-title="类目管理">
                <dt>
                    <i class="icon-menu-v2 lmgl"></i>                                <span id="shop_0" data-id="0">类目管理</span>
                </dt>
            </dl><dl class="left-menu shop_0" data-type="sub_flgl" data-title="分类管理">
                <dt>
                    <i class="icon-menu-v2 flgl"></i>                                <span id="shop_0" data-id="0">分类管理</span>
                </dt>
            </dl><dl class="left-menu shop_4" data-type="sub_tags" data-title="分组管理">
                <dt>
                    <i class="icon-menu-v2 tags"></i>                                <span id="shop_4" data-id="4">分组管理</span>
                </dt>
            </dl><dl class="left-menu shop_0" data-type="sub_spdr" data-title="商品导入">
                <dt>
                    <i class="icon-menu-v2 spdr"></i>                                <span id="shop_0" data-id="0">商品导入</span>
                </dt>
            </dl><dl class="left-menu shop_0" data-type="sub_spdc" data-title="商品导出">
                <dt>
                    <i class="icon-menu-v2 spdc"></i>                                <span id="shop_0" data-id="0">商品导出</span>
                </dt>
            </dl>                        <dl class="col_dis" style="height: 700px;"></dl>
        </aside>
        <aside class="third">
            <div class="third_box">
                <ul class="sub_commodity" data-parent="商品管理" style="display:block">
                    <a href="http://tp.weifenxiao.com/Item/lists/item_status/onsale">
                        <li class="subshop_0 active">
                            出售中商品                                                                        </li>
                    </a><a href="http://tp.weifenxiao.com/Item/add">
                        <li class="subshop_1 ">
                            发布商品                                                                        </li>
                    </a><a href="http://tp.weifenxiao.com/Item/lists/item_status/onsku">
                        <li class="subshop_11 ">
                            仓库中商品                                                                        </li>
                    </a><a href="http://tp.weifenxiao.com/Item/lists/item_status/outstock">
                        <li class="subshop_12 ">
                            已售罄商品                                                                        </li>
                    </a><a href="http://tp.weifenxiao.com/Item/lists/item_status/warn">
                        <li class="subshop_13 ">
                            警戒商品                                                                        </li>
                    </a>                </ul><ul class="sub_lmgl" data-parent="类目管理" style="display:none">
                    <a href="http://tp.weifenxiao.com/Item/category_list">
                        <li class="subshop_0 ">
                            自定义类目                                                                        </li>
                    </a>                </ul><ul class="sub_flgl" data-parent="分类管理" style="display:none">
                    <a href="http://tp.weifenxiao.com/Item/list_class">
                        <li class="subshop_0 ">
                            商品分类                                                                        </li>
                    </a>                </ul><ul class="sub_tags" data-parent="分组管理" style="display:none">
                    <a href="http://tp.weifenxiao.com/Item/list_group">
                        <li class="subshop_0 ">
                            商品分组                                                                        </li>
                    </a><a href="http://tp.weifenxiao.com/Item/add_group">
                        <li class="subshop_2 ">
                            添加分组                                                                        </li>
                    </a>                </ul><ul class="sub_spdr" data-parent="商品导入" style="display:none">
                    <a href="http://tp.weifenxiao.com/Item/import_fromfiles">
                        <li class="subshop_1 ">
                            淘宝数据包                                                                        </li>
                    </a><a href="http://tp.weifenxiao.com/Item/item_import">
                        <li class="subshop_3 ">
                            备份商品                                                                        </li>
                    </a>                </ul><ul class="sub_spdc" data-parent="商品导出" style="display:none">
                    <a href="http://tp.weifenxiao.com/Item/item_export">
                        <li class="subshop_0 ">
                            批量导出                                                                        </li>
                    </a><a href="http://tp.weifenxiao.com/Item/sku_export">
                        <li class="subshop_1 ">
                            商品规格导出                                                                        </li>
                    </a>                </ul>        </div>
            <div class="bg_corl j-toggle-hide" style="top: 636px;">
                <img src="goodsindex_files/simgle_right_third.png">
                <p>收起</p>
            </div>
        </aside>    </div>
</div>
<!-- end content-left -->
<div id="content-right-box" class="content-right-box">
    <div class="content-right">

<h1 class="content-right-title">商品列表<a class="gicon-info-sign gicon_linkother" href="http://tp.weifenxiao.com/Help/lists/id/40.html" target="_blank"></a></h1>
    <input type="hidden" name="supplier_id" value="">
    <a href="http://tp.weifenxiao.com/Item/add" class="btn btn-success">发布商品</a>

    <form action="" method="post">
        <div class="tables-searchbox newcearchbox">
            <select name="group_id" class="select small newselect">
                <option value="-1" selected="selected">所有分组</option>
                <option value="0">未分组</option>
                <option value="2045144">新建商品分组</option>            </select>
            <select name="class_id" class="select small newselect">
            <option value="-1" selected="selected">所有分类</option>
            <option value="0">未分类</option>
            <option value="109693">分类1</option><option value="109694">&nbsp;&nbsp;└─分类2</option>        </select>
                        <input type="hidden" name="item_status" value="onsale">
            <input type="text" placeholder="商品名称" class="input small" name="title">
            <input type="text" placeholder="商家编码" class="input mini" name="goods_no">
            <input type="hidden" class="isout" name="item_export" value="0">
            <input type="hidden" class="isout" name="show_type" value="0">
            <button class="btn btn-primary search" style="line-height:26px;"><i class="gicon-search white"></i>查询</button>
            <button style="line-height:26px;" class="btn btn-success export"><i class="gicon-share white"></i>商品导出</button>            <input type="hidden" value="" class="is_repurchase">
        </div>
        <div class="tabs clearfix mgt10">
            <a href="http://tp.weifenxiao.com/Item/lists/item_status/onsale" class="active tabs_a fl">出售中(<span class="status_onsale">11</span>)</a>
                        <a href="http://tp.weifenxiao.com/Item/lists/item_status/onsku" class=" tabs_a fl">仓库中(<span class="status_onsku">0</span>)</a>
            <a href="http://tp.weifenxiao.com/Item/lists/item_status/outstock" class=" tabs_a fl">已售罄(<span class="status_outstock">0</span>)</a>
            <a href="http://tp.weifenxiao.com/Item/lists/item_status/warn" class=" tabs_a fl">警戒(<span class="status_warn">0</span>)</a>
                    </div>
        <div class="grounp_chenge_box fr">
            <span class="grtt">每页显示商品数量:</span>
            <a class="intem  cur " href="javascript:;">10</a>
            <a class="intem  " href="javascript:;">20</a>
            <a class="intem  " href="javascript:;">40</a>
            <a class="intem  " href="javascript:;">50</a>
        </div><!-- 启 -->
    </form>
    <!-- end tabs -->

    <table class="wxtables mgt10">
        <colgroup>
            <col width="2%">
            <col width="8%">
            <col width="18%">
            <col width="10%">
            <col width="7%">
            <col width="11%">
            <col width="11%">
            <col width="33%">
        </colgroup>
        <thead>
        <tr class="po_list">
            <td><i class="icon_check"></i></td>
            <td colspan="2">商品<span></span></td>
            <td class="cursor_pointer">
                总销量
                    <span class="order_arrow">
                    <a href="http://tp.weifenxiao.com/Item/lists/item_status/onsale/real_sales/up/show_type/0" class="up "><b></b></a>
                <a href="http://tp.weifenxiao.com/Item/lists/item_status/onsale/real_sales/down/show_type/0" class="down "><b></b></a>
                </span>
                                </td>
            <td>排序<span></span></td>
            <td class="cursor_pointer">创建时间
                <span class="order_arrow">
                    <a href="http://tp.weifenxiao.com/Item/lists/item_status/onsale/create_time/up" class="up "><b></b></a>
                    <a href="http://tp.weifenxiao.com/Item/lists/item_status/onsale/create_time/down" class="down "><b></b></a>
                </span>
            </td>
            <td class="cursor_pointer">更新时间
                <span class="order_arrow">
                    <a href="http://tp.weifenxiao.com/Item/lists/item_status/onsale/update_time/up" class="up "><b></b></a>
                    <a href="http://tp.weifenxiao.com/Item/lists/item_status/onsale/update_time/down" class="down "><b></b></a>
                </span>
            </td>
            <td>操作<span></span></td>
        </tr>
        </thead>
        <tbody>
                    
					<tr class="new">
                    <td>
                        <input type="checkbox" class="checkbox table-ckbs" data-id="1250151" data-name="商品名称">
                    </td><!-- 博 -->
                    <td>
                        <div class="goodswrap">
                            <a href="http://m5.weifenxiao.com/Item/detail/id/1250151/Fwvw/Kna9/sid/8075714.html" class="block" target="_blank" title="商品名称">
                                <div class="table-item-img">
                                                                                <img src="goodsindex_files/5db58631e18c2.jpg" alt="">                                                                            
                                                                    </div>
                            </a>
                        </div>
                    </td>
                    <td>
                        <div class="goodswrap">
                            <a href="http://m5.weifenxiao.com/Item/detail/id/1250151/Fwvw/Kna9/sid/8075714.html" class="block" target="_blank" title="商品名称">
                                <div class="table-item-info">
                                    <p>
                                                                                商品名称                                    </p>
                                                                        <span class="price">¥111.00                                      
                                    </span>
                                </div>
                            </a>
                            <i class="edit-item j-getedit" title="编辑商品标题" data-title="商品名称" data-id="1250151"></i>
                            <i class="edit-item edit-price j-getprice" title="编辑价格" data-price="111.00" data-id="1250151"></i>
                        </div>
                        <div class="stockwrap">
                            <span>库存：100000</span>
                            <i class="edit-item j-geteditstock" data-id="1250151" data-num="100000" title="编辑库存量"></i>
                        </div>
                        <div class="class_name">
                            <span>分类：分类1 分类2</span>
                            <i class="edit-item j-geteditclassName" title="编辑分类" data-id="1250151" data-cid="109693 109694"></i>
                        </div>
                                                                        <!-- 科 -->
                                                                     
                    </td>
                    <td>0</td>
                                            <td>
                        <div class="serialwrap">
                            <span>0</span>
                            <i class="edit-item j-geteditserial" data-id="1250151" data-serial="0" title="编辑排序"></i>
                        </div>
                    </td>
                    <td>2019-10-27 23:41:08</td>
                    <td>2019-10-27 23:41:08</td>
                    <td>
                        <a href="javascript:;" class="btn btn-new mgt5 j-repurchase" title="复购" data-id="1250151" data-price="" data-directonemoney="" data-directonerate="" data-directtwomoney="" data-directtworate="" data-directthreemoney="" data-directthreerate="" data-fxcommission="" data-agencyonemoney="" data-agencyonerate="" data-agencytwomoney="" data-agencytworate="" data-agencythreemoney="" data-agencythreerate="" data-dlcommission="" data-getlower="" data-storemoney="" data-storerate="" data-storecommission="" data-staffmoney="" data-staffrate="" data-staffcommission="" data-dlset="" data-memberlevelprice="[]" data-directonelevelmoney="[]" data-directtwolevelmoney="[]" data-storegraderankcommission="[{id: 67, level: &quot;顶级门店&quot;, pri: &quot;2&quot;, rate: &quot;&quot;},{id: 96, level: &quot;美滋滋啊&quot;, pri: &quot;&quot;, rate: &quot;&quot;}]" data-directthreelevelmoney="[]" data-staffrankcommission="[]" data-storerankcommission="[]" data-storerankawardcommission="[]" data-storeaward="" data-storeawardrate="" data-isawardcommission="">复购</a>
                        <a href="javascript:;" class="btn btn-new j-copyitem" title="复制商品" data-id="1250151">复制商品</a>
                        <a href="http://tp.weifenxiao.com/Item/item_qrcode/id/1250151" target="_blank" class="btn btn-new " title="二维码图片" data-id="1250151">二维码图片</a>
                        <a href="javascript:;" class="btn btn-new j-copy" title="复制地址" data-copy="http://m5.weifenxiao.com/Item/detail/id/1250151/Fwvw/Kna9/sid/8075714.html">复制地址</a>                        <a href="http://tp.weifenxiao.com/Item/add_step2/item_status/onsale/p/1/id/1250151/Is/update" class="btn btn-new width" title="修改">编辑</a>
                        <a href="javascript:;" class="btn btn-new j-del" title="删除" data-id="1250151" data-name="商品名称">删除</a>
                                                <a href="javascript:;" class="btn btn-new j-qrcode" title="二维码" data-id="1250151">二维码</a>                        <a href="javascript:;" class="btn btn-new mgt5 j-recommend" data-id="1250151">置顶</a>
                                                                                                                                <a href="javascript:;" class="btn btn-new j-video" data-id="1250151" data-url="" data-code="/Public/fencode/item_id/1250151">短视频介绍</a>                    </td>
                </tr>
				<tr class="new">
                    <td>
                        <input type="checkbox" class="checkbox table-ckbs" data-id="1250150" data-name="商品名称">
                    </td><!-- 博 -->
                    <td>
                        <div class="goodswrap">
                            <a href="http://m5.weifenxiao.com/Item/detail/id/1250150/Gm34/cHfB/sid/8075714.html" class="block" target="_blank" title="商品名称">
                                <div class="table-item-img">
                                                                                <img src="goodsindex_files/5db58631e18c2.jpg" alt="">                                                                            
                                                                    </div>
                            </a>
                        </div>
                    </td>
                    <td>
                        <div class="goodswrap">
                            <a href="http://m5.weifenxiao.com/Item/detail/id/1250150/Gm34/cHfB/sid/8075714.html" class="block" target="_blank" title="商品名称">
                                <div class="table-item-info">
                                    <p>
                                                                                商品名称                                    </p>
                                                                        <span class="price">¥111.00                                      
                                    </span>
                                </div>
                            </a>
                            <!--<div class="editinfo info-title">-->
                                <!--<div class="contxt_hd">-->
                                    <!--<span class="contxt_hd_l"></span>-->
                                    <!--<p>编辑商品标题</p>-->
                                    <!--<span class="Jcancel"><img src="/Public/images/close_blue.png"></span>-->
                                <!--</div>-->
                                <!--<div class="context_bd">-->
                                    <!--<ul>-->
                                        <!--<li>-->
                                            <!--<span>商品标题</span>-->
                                            <!--<textarea class="editable" name="title">商品名称</textarea>-->
                                        <!--</li>-->
                                    <!--</ul>-->
                                    <!--<a href="javascript:;" class="j-safetitle" data-id="1250150">保存</a>-->
                                <!--</div>-->
                            <!--</div>-->
                            <i class="edit-item j-getedit" title="编辑商品标题" data-title="商品名称" data-id="1250150"></i>
                            <i class="edit-item edit-price j-getprice" title="编辑价格" data-price="111.00" data-id="1250150"></i>
                        </div>
                        <div class="stockwrap">
                            <span>库存：100000</span>
                            <i class="edit-item j-geteditstock" data-id="1250150" data-num="100000" title="编辑库存量"></i>
                        </div>
                        <div class="class_name">
                            <span>分类：分类1 分类2</span>
                            <i class="edit-item j-geteditclassName" title="编辑分类" data-id="1250150" data-cid="109693 109694"></i>
                        </div>
                                                                        <!-- 科 -->
                                                                     
                    </td>
                    <td>0</td>
                                            <td>
                        <div class="serialwrap">
                            <span>0</span>
                            <i class="edit-item j-geteditserial" data-id="1250150" data-serial="0" title="编辑排序"></i>
                        </div>
                    </td>
                    <td>2019-10-27 23:41:06</td>
                    <td>2019-10-27 23:41:06</td>
                    <td>
                        <a href="javascript:;" class="btn btn-new mgt5 j-repurchase" title="复购" data-id="1250150" data-price="" data-directonemoney="" data-directonerate="" data-directtwomoney="" data-directtworate="" data-directthreemoney="" data-directthreerate="" data-fxcommission="" data-agencyonemoney="" data-agencyonerate="" data-agencytwomoney="" data-agencytworate="" data-agencythreemoney="" data-agencythreerate="" data-dlcommission="" data-getlower="" data-storemoney="" data-storerate="" data-storecommission="" data-staffmoney="" data-staffrate="" data-staffcommission="" data-dlset="" data-memberlevelprice="[]" data-directonelevelmoney="[]" data-directtwolevelmoney="[]" data-storegraderankcommission="[{id: 67, level: &quot;顶级门店&quot;, pri: &quot;2&quot;, rate: &quot;&quot;},{id: 96, level: &quot;美滋滋啊&quot;, pri: &quot;&quot;, rate: &quot;&quot;}]" data-directthreelevelmoney="[]" data-staffrankcommission="[]" data-storerankcommission="[]" data-storerankawardcommission="[]" data-storeaward="" data-storeawardrate="" data-isawardcommission="">复购</a>
                        <a href="javascript:;" class="btn btn-new j-copyitem" title="复制商品" data-id="1250150">复制商品</a>
                        <a href="http://tp.weifenxiao.com/Item/item_qrcode/id/1250150" target="_blank" class="btn btn-new " title="二维码图片" data-id="1250150">二维码图片</a>
                        <a href="javascript:;" class="btn btn-new j-copy" title="复制地址" data-copy="http://m5.weifenxiao.com/Item/detail/id/1250150/Gm34/cHfB/sid/8075714.html">复制地址</a>                        <a href="http://tp.weifenxiao.com/Item/add_step2/item_status/onsale/p/1/id/1250150/Is/update" class="btn btn-new width" title="修改">编辑</a>
                        <a href="javascript:;" class="btn btn-new j-del" title="删除" data-id="1250150" data-name="商品名称">删除</a>
                                                <a href="javascript:;" class="btn btn-new j-qrcode" title="二维码" data-id="1250150">二维码</a>                        <a href="javascript:;" class="btn btn-new mgt5 j-recommend" data-id="1250150">置顶</a>
                                                                                                                                <a href="javascript:;" class="btn btn-new j-video" data-id="1250150" data-url="" data-code="/Public/fencode/item_id/1250150">短视频介绍</a>                    </td>
                </tr><tr class="new">
                    <td>
                        <input type="checkbox" class="checkbox table-ckbs" data-id="1250149" data-name="商品名称">
                    </td><!-- 博 -->
                    <td>
                        <div class="goodswrap">
                            <a href="http://m5.weifenxiao.com/Item/detail/id/1250149/Pz0lm/tn7Qll/sid/8075714.html" class="block" target="_blank" title="商品名称">
                                <div class="table-item-img">
                                                                                <img src="goodsindex_files/5db58631e18c2.jpg" alt="">                                                                            
                                                                    </div>
                            </a>
                        </div>
                    </td>
                    <td>
                        <div class="goodswrap">
                            <a href="http://m5.weifenxiao.com/Item/detail/id/1250149/Pz0lm/tn7Qll/sid/8075714.html" class="block" target="_blank" title="商品名称">
                                <div class="table-item-info">
                                    <p>
                                                                                商品名称                                    </p>
                                                                        <span class="price">¥111.00                                      
                                    </span>
                                </div>
                            </a>
                            <!--<div class="editinfo info-title">-->
                                <!--<div class="contxt_hd">-->
                                    <!--<span class="contxt_hd_l"></span>-->
                                    <!--<p>编辑商品标题</p>-->
                                    <!--<span class="Jcancel"><img src="/Public/images/close_blue.png"></span>-->
                                <!--</div>-->
                                <!--<div class="context_bd">-->
                                    <!--<ul>-->
                                        <!--<li>-->
                                            <!--<span>商品标题</span>-->
                                            <!--<textarea class="editable" name="title">商品名称</textarea>-->
                                        <!--</li>-->
                                    <!--</ul>-->
                                    <!--<a href="javascript:;" class="j-safetitle" data-id="1250149">保存</a>-->
                                <!--</div>-->
                            <!--</div>-->
                            <i class="edit-item j-getedit" title="编辑商品标题" data-title="商品名称" data-id="1250149"></i>
                            <i class="edit-item edit-price j-getprice" title="编辑价格" data-price="111.00" data-id="1250149"></i>
                        </div>
                        <div class="stockwrap">
                            <span>库存：100000</span>
                            <i class="edit-item j-geteditstock" data-id="1250149" data-num="100000" title="编辑库存量"></i>
                        </div>
                        <div class="class_name">
                            <span>分类：分类1 分类2</span>
                            <i class="edit-item j-geteditclassName" title="编辑分类" data-id="1250149" data-cid="109693 109694"></i>
                        </div>
                                                                        <!-- 科 -->
                                                                     
                    </td>
                    <td>0</td>
                                            <td>
                        <div class="serialwrap">
                            <span>0</span>
                            <i class="edit-item j-geteditserial" data-id="1250149" data-serial="0" title="编辑排序"></i>
                        </div>
                    </td>
                    <td>2019-10-27 23:41:04</td>
                    <td>2019-10-27 23:41:04</td>
                    <td>
                        <a href="javascript:;" class="btn btn-new mgt5 j-repurchase" title="复购" data-id="1250149" data-price="" data-directonemoney="" data-directonerate="" data-directtwomoney="" data-directtworate="" data-directthreemoney="" data-directthreerate="" data-fxcommission="" data-agencyonemoney="" data-agencyonerate="" data-agencytwomoney="" data-agencytworate="" data-agencythreemoney="" data-agencythreerate="" data-dlcommission="" data-getlower="" data-storemoney="" data-storerate="" data-storecommission="" data-staffmoney="" data-staffrate="" data-staffcommission="" data-dlset="" data-memberlevelprice="[]" data-directonelevelmoney="[]" data-directtwolevelmoney="[]" data-storegraderankcommission="[{id: 67, level: &quot;顶级门店&quot;, pri: &quot;2&quot;, rate: &quot;&quot;},{id: 96, level: &quot;美滋滋啊&quot;, pri: &quot;&quot;, rate: &quot;&quot;}]" data-directthreelevelmoney="[]" data-staffrankcommission="[]" data-storerankcommission="[]" data-storerankawardcommission="[]" data-storeaward="" data-storeawardrate="" data-isawardcommission="">复购</a>
                        <a href="javascript:;" class="btn btn-new j-copyitem" title="复制商品" data-id="1250149">复制商品</a>
                        <a href="http://tp.weifenxiao.com/Item/item_qrcode/id/1250149" target="_blank" class="btn btn-new " title="二维码图片" data-id="1250149">二维码图片</a>
                        <a href="javascript:;" class="btn btn-new j-copy" title="复制地址" data-copy="http://m5.weifenxiao.com/Item/detail/id/1250149/Pz0lm/tn7Qll/sid/8075714.html">复制地址</a>                        <a href="http://tp.weifenxiao.com/Item/add_step2/item_status/onsale/p/1/id/1250149/Is/update" class="btn btn-new width" title="修改">编辑</a>
                        <a href="javascript:;" class="btn btn-new j-del" title="删除" data-id="1250149" data-name="商品名称">删除</a>
                                                <a href="javascript:;" class="btn btn-new j-qrcode" title="二维码" data-id="1250149">二维码</a>                        <a href="javascript:;" class="btn btn-new mgt5 j-recommend" data-id="1250149">置顶</a>
                                                                                                                                <a href="javascript:;" class="btn btn-new j-video" data-id="1250149" data-url="" data-code="/Public/fencode/item_id/1250149">短视频介绍</a>                    </td>
                </tr><tr class="new">
                    <td>
                        <input type="checkbox" class="checkbox table-ckbs" data-id="1250148" data-name="商品名称">
                    </td><!-- 博 -->
                    <td>
                        <div class="goodswrap">
                            <a href="http://m5.weifenxiao.com/Item/detail/id/1250148/jVWbc/9xPG/sid/8075714.html" class="block" target="_blank" title="商品名称">
                                <div class="table-item-img">
                                                                                <img src="goodsindex_files/5db58631e18c2.jpg" alt="">                                                                            
                                                                    </div>
                            </a>
                        </div>
                    </td>
                    <td>
                        <div class="goodswrap">
                            <a href="http://m5.weifenxiao.com/Item/detail/id/1250148/jVWbc/9xPG/sid/8075714.html" class="block" target="_blank" title="商品名称">
                                <div class="table-item-info">
                                    <p>
                                                                                商品名称                                    </p>
                                                                        <span class="price">¥111.00                                      
                                    </span>
                                </div>
                            </a>
                            <!--<div class="editinfo info-title">-->
                                <!--<div class="contxt_hd">-->
                                    <!--<span class="contxt_hd_l"></span>-->
                                    <!--<p>编辑商品标题</p>-->
                                    <!--<span class="Jcancel"><img src="/Public/images/close_blue.png"></span>-->
                                <!--</div>-->
                                <!--<div class="context_bd">-->
                                    <!--<ul>-->
                                        <!--<li>-->
                                            <!--<span>商品标题</span>-->
                                            <!--<textarea class="editable" name="title">商品名称</textarea>-->
                                        <!--</li>-->
                                    <!--</ul>-->
                                    <!--<a href="javascript:;" class="j-safetitle" data-id="1250148">保存</a>-->
                                <!--</div>-->
                            <!--</div>-->
                            <i class="edit-item j-getedit" title="编辑商品标题" data-title="商品名称" data-id="1250148"></i>
                            <i class="edit-item edit-price j-getprice" title="编辑价格" data-price="111.00" data-id="1250148"></i>
                        </div>
                        <div class="stockwrap">
                            <span>库存：100000</span>
                            <i class="edit-item j-geteditstock" data-id="1250148" data-num="100000" title="编辑库存量"></i>
                        </div>
                        <div class="class_name">
                            <span>分类：分类1 分类2</span>
                            <i class="edit-item j-geteditclassName" title="编辑分类" data-id="1250148" data-cid="109693 109694"></i>
                        </div>
                                                                        <!-- 科 -->
                                                                     
                    </td>
                    <td>0</td>
                                            <td>
                        <div class="serialwrap">
                            <span>0</span>
                            <i class="edit-item j-geteditserial" data-id="1250148" data-serial="0" title="编辑排序"></i>
                        </div>
                    </td>
                    <td>2019-10-27 23:41:00</td>
                    <td>2019-10-27 23:41:00</td>
                    <td>
                        <a href="javascript:;" class="btn btn-new mgt5 j-repurchase" title="复购" data-id="1250148" data-price="" data-directonemoney="" data-directonerate="" data-directtwomoney="" data-directtworate="" data-directthreemoney="" data-directthreerate="" data-fxcommission="" data-agencyonemoney="" data-agencyonerate="" data-agencytwomoney="" data-agencytworate="" data-agencythreemoney="" data-agencythreerate="" data-dlcommission="" data-getlower="" data-storemoney="" data-storerate="" data-storecommission="" data-staffmoney="" data-staffrate="" data-staffcommission="" data-dlset="" data-memberlevelprice="[]" data-directonelevelmoney="[]" data-directtwolevelmoney="[]" data-storegraderankcommission="[{id: 67, level: &quot;顶级门店&quot;, pri: &quot;2&quot;, rate: &quot;&quot;},{id: 96, level: &quot;美滋滋啊&quot;, pri: &quot;&quot;, rate: &quot;&quot;}]" data-directthreelevelmoney="[]" data-staffrankcommission="[]" data-storerankcommission="[]" data-storerankawardcommission="[]" data-storeaward="" data-storeawardrate="" data-isawardcommission="">复购</a>
                        <a href="javascript:;" class="btn btn-new j-copyitem" title="复制商品" data-id="1250148">复制商品</a>
                        <a href="http://tp.weifenxiao.com/Item/item_qrcode/id/1250148" target="_blank" class="btn btn-new " title="二维码图片" data-id="1250148">二维码图片</a>
                        <a href="javascript:;" class="btn btn-new j-copy" title="复制地址" data-copy="http://m5.weifenxiao.com/Item/detail/id/1250148/jVWbc/9xPG/sid/8075714.html">复制地址</a>                        <a href="http://tp.weifenxiao.com/Item/add_step2/item_status/onsale/p/1/id/1250148/Is/update" class="btn btn-new width" title="修改">编辑</a>
                        <a href="javascript:;" class="btn btn-new j-del" title="删除" data-id="1250148" data-name="商品名称">删除</a>
                                                <a href="javascript:;" class="btn btn-new j-qrcode" title="二维码" data-id="1250148">二维码</a>                        <a href="javascript:;" class="btn btn-new mgt5 j-recommend" data-id="1250148">置顶</a>
                                                                                                                                <a href="javascript:;" class="btn btn-new j-video" data-id="1250148" data-url="" data-code="/Public/fencode/item_id/1250148">短视频介绍</a>                    </td>
                </tr><tr class="new">
                    <td>
                        <input type="checkbox" class="checkbox table-ckbs" data-id="1250147" data-name="商品名称">
                    </td><!-- 博 -->
                    <td>
                        <div class="goodswrap">
                            <a href="http://m5.weifenxiao.com/Item/detail/id/1250147/1RS89/0SBty1/sid/8075714.html" class="block" target="_blank" title="商品名称">
                                <div class="table-item-img">
                                                                                <img src="goodsindex_files/5db58631e18c2.jpg" alt="">                                                                            
                                                                    </div>
                            </a>
                        </div>
                    </td>
                    <td>
                        <div class="goodswrap">
                            <a href="http://m5.weifenxiao.com/Item/detail/id/1250147/1RS89/0SBty1/sid/8075714.html" class="block" target="_blank" title="商品名称">
                                <div class="table-item-info">
                                    <p>
                                                                                商品名称                                    </p>
                                                                        <span class="price">¥111.00                                      
                                    </span>
                                </div>
                            </a>
                            <!--<div class="editinfo info-title">-->
                                <!--<div class="contxt_hd">-->
                                    <!--<span class="contxt_hd_l"></span>-->
                                    <!--<p>编辑商品标题</p>-->
                                    <!--<span class="Jcancel"><img src="/Public/images/close_blue.png"></span>-->
                                <!--</div>-->
                                <!--<div class="context_bd">-->
                                    <!--<ul>-->
                                        <!--<li>-->
                                            <!--<span>商品标题</span>-->
                                            <!--<textarea class="editable" name="title">商品名称</textarea>-->
                                        <!--</li>-->
                                    <!--</ul>-->
                                    <!--<a href="javascript:;" class="j-safetitle" data-id="1250147">保存</a>-->
                                <!--</div>-->
                            <!--</div>-->
                            <i class="edit-item j-getedit" title="编辑商品标题" data-title="商品名称" data-id="1250147"></i>
                            <i class="edit-item edit-price j-getprice" title="编辑价格" data-price="111.00" data-id="1250147"></i>
                        </div>
                        <div class="stockwrap">
                            <span>库存：100000</span>
                            <i class="edit-item j-geteditstock" data-id="1250147" data-num="100000" title="编辑库存量"></i>
                        </div>
                        <div class="class_name">
                            <span>分类：分类1 分类2</span>
                            <i class="edit-item j-geteditclassName" title="编辑分类" data-id="1250147" data-cid="109693 109694"></i>
                        </div>
                                                                        <!-- 科 -->
                                                                     
                    </td>
                    <td>0</td>
                                            <td>
                        <div class="serialwrap">
                            <span>0</span>
                            <i class="edit-item j-geteditserial" data-id="1250147" data-serial="0" title="编辑排序"></i>
                        </div>
                    </td>
                    <td>2019-10-27 23:40:55</td>
                    <td>2019-10-27 23:40:55</td>
                    <td>
                        <a href="javascript:;" class="btn btn-new mgt5 j-repurchase" title="复购" data-id="1250147" data-price="" data-directonemoney="" data-directonerate="" data-directtwomoney="" data-directtworate="" data-directthreemoney="" data-directthreerate="" data-fxcommission="" data-agencyonemoney="" data-agencyonerate="" data-agencytwomoney="" data-agencytworate="" data-agencythreemoney="" data-agencythreerate="" data-dlcommission="" data-getlower="" data-storemoney="" data-storerate="" data-storecommission="" data-staffmoney="" data-staffrate="" data-staffcommission="" data-dlset="" data-memberlevelprice="[]" data-directonelevelmoney="[]" data-directtwolevelmoney="[]" data-storegraderankcommission="[{id: 67, level: &quot;顶级门店&quot;, pri: &quot;2&quot;, rate: &quot;&quot;},{id: 96, level: &quot;美滋滋啊&quot;, pri: &quot;&quot;, rate: &quot;&quot;}]" data-directthreelevelmoney="[]" data-staffrankcommission="[]" data-storerankcommission="[]" data-storerankawardcommission="[]" data-storeaward="" data-storeawardrate="" data-isawardcommission="">复购</a>
                        <a href="javascript:;" class="btn btn-new j-copyitem" title="复制商品" data-id="1250147">复制商品</a>
                        <a href="http://tp.weifenxiao.com/Item/item_qrcode/id/1250147" target="_blank" class="btn btn-new " title="二维码图片" data-id="1250147">二维码图片</a>
                        <a href="javascript:;" class="btn btn-new j-copy" title="复制地址" data-copy="http://m5.weifenxiao.com/Item/detail/id/1250147/1RS89/0SBty1/sid/8075714.html">复制地址</a>                        <a href="http://tp.weifenxiao.com/Item/add_step2/item_status/onsale/p/1/id/1250147/Is/update" class="btn btn-new width" title="修改">编辑</a>
                        <a href="javascript:;" class="btn btn-new j-del" title="删除" data-id="1250147" data-name="商品名称">删除</a>
                                                <a href="javascript:;" class="btn btn-new j-qrcode" title="二维码" data-id="1250147">二维码</a>                        <a href="javascript:;" class="btn btn-new mgt5 j-recommend" data-id="1250147">置顶</a>
                                                                                                                                <a href="javascript:;" class="btn btn-new j-video" data-id="1250147" data-url="" data-code="/Public/fencode/item_id/1250147">短视频介绍</a>                    </td>
                </tr><tr class="new">
                    <td>
                        <input type="checkbox" class="checkbox table-ckbs" data-id="1250146" data-name="商品名称">
                    </td><!-- 博 -->
                    <td>
                        <div class="goodswrap">
                            <a href="http://m5.weifenxiao.com/Item/detail/id/1250146/rPwx/vGO0Va/sid/8075714.html" class="block" target="_blank" title="商品名称">
                                <div class="table-item-img">
                                                                                <img src="goodsindex_files/5db58631e18c2.jpg" alt="">                                                                            
                                                                    </div>
                            </a>
                        </div>
                    </td>
                    <td>
                        <div class="goodswrap">
                            <a href="http://m5.weifenxiao.com/Item/detail/id/1250146/rPwx/vGO0Va/sid/8075714.html" class="block" target="_blank" title="商品名称">
                                <div class="table-item-info">
                                    <p>
                                                                                商品名称                                    </p>
                                                                        <span class="price">¥111.00                                      
                                    </span>
                                </div>
                            </a>
                            <!--<div class="editinfo info-title">-->
                                <!--<div class="contxt_hd">-->
                                    <!--<span class="contxt_hd_l"></span>-->
                                    <!--<p>编辑商品标题</p>-->
                                    <!--<span class="Jcancel"><img src="/Public/images/close_blue.png"></span>-->
                                <!--</div>-->
                                <!--<div class="context_bd">-->
                                    <!--<ul>-->
                                        <!--<li>-->
                                            <!--<span>商品标题</span>-->
                                            <!--<textarea class="editable" name="title">商品名称</textarea>-->
                                        <!--</li>-->
                                    <!--</ul>-->
                                    <!--<a href="javascript:;" class="j-safetitle" data-id="1250146">保存</a>-->
                                <!--</div>-->
                            <!--</div>-->
                            <i class="edit-item j-getedit" title="编辑商品标题" data-title="商品名称" data-id="1250146"></i>
                            <i class="edit-item edit-price j-getprice" title="编辑价格" data-price="111.00" data-id="1250146"></i>
                        </div>
                        <div class="stockwrap">
                            <span>库存：100000</span>
                            <i class="edit-item j-geteditstock" data-id="1250146" data-num="100000" title="编辑库存量"></i>
                        </div>
                        <div class="class_name">
                            <span>分类：分类1 分类2</span>
                            <i class="edit-item j-geteditclassName" title="编辑分类" data-id="1250146" data-cid="109693 109694"></i>
                        </div>
                                                                        <!-- 科 -->
                                                                     
                    </td>
                    <td>0</td>
                                            <td>
                        <div class="serialwrap">
                            <span>0</span>
                            <i class="edit-item j-geteditserial" data-id="1250146" data-serial="0" title="编辑排序"></i>
                        </div>
                    </td>
                    <td>2019-10-27 23:38:20</td>
                    <td>2019-10-27 23:38:20</td>
                    <td>
                        <a href="javascript:;" class="btn btn-new mgt5 j-repurchase" title="复购" data-id="1250146" data-price="" data-directonemoney="" data-directonerate="" data-directtwomoney="" data-directtworate="" data-directthreemoney="" data-directthreerate="" data-fxcommission="" data-agencyonemoney="" data-agencyonerate="" data-agencytwomoney="" data-agencytworate="" data-agencythreemoney="" data-agencythreerate="" data-dlcommission="" data-getlower="" data-storemoney="" data-storerate="" data-storecommission="" data-staffmoney="" data-staffrate="" data-staffcommission="" data-dlset="" data-memberlevelprice="[]" data-directonelevelmoney="[]" data-directtwolevelmoney="[]" data-storegraderankcommission="[{id: 67, level: &quot;顶级门店&quot;, pri: &quot;2&quot;, rate: &quot;&quot;},{id: 96, level: &quot;美滋滋啊&quot;, pri: &quot;&quot;, rate: &quot;&quot;}]" data-directthreelevelmoney="[]" data-staffrankcommission="[]" data-storerankcommission="[]" data-storerankawardcommission="[]" data-storeaward="" data-storeawardrate="" data-isawardcommission="">复购</a>
                        <a href="javascript:;" class="btn btn-new j-copyitem" title="复制商品" data-id="1250146">复制商品</a>
                        <a href="http://tp.weifenxiao.com/Item/item_qrcode/id/1250146" target="_blank" class="btn btn-new " title="二维码图片" data-id="1250146">二维码图片</a>
                        <a href="javascript:;" class="btn btn-new j-copy" title="复制地址" data-copy="http://m5.weifenxiao.com/Item/detail/id/1250146/rPwx/vGO0Va/sid/8075714.html">复制地址</a>                        <a href="http://tp.weifenxiao.com/Item/add_step2/item_status/onsale/p/1/id/1250146/Is/update" class="btn btn-new width" title="修改">编辑</a>
                        <a href="javascript:;" class="btn btn-new j-del" title="删除" data-id="1250146" data-name="商品名称">删除</a>
                                                <a href="javascript:;" class="btn btn-new j-qrcode" title="二维码" data-id="1250146">二维码</a>                        <a href="javascript:;" class="btn btn-new mgt5 j-recommend" data-id="1250146">置顶</a>
                                                                                                                                <a href="javascript:;" class="btn btn-new j-video" data-id="1250146" data-url="" data-code="/Public/fencode/item_id/1250146">短视频介绍</a>                    </td>
                </tr>        </tbody>
        <!-- 技 -->
    </table>
    <!-- end wxtables -->
    <div class="tables-btmctrl clearfix">
        <div class="mgb10">
            <a href="javascript:;" class="btn btn-primary btn_table_selectAll">全选</a>
                <a href="javascript:;" class="btn btn-primary btn_table_Cancle">取消</a>
                <a href="javascript:;" class="btn btn-primary btn_table_offshelf">下架</a>
                                    <a href="javascript:;" class="btn btn-primary btn_table_delAll">删除</a>
                <a href="javascript:;" class="btn btn-primary btn_table_groupAll">分组</a>
                <a href="javascript:;" class="btn btn-primary btn_delete_groupAll">批量取消分组</a>
                <a href="javascript:;" class="btn btn-primary btn_table_setLevel">开/关折扣</a>
                <a href="javascript:;" class="btn btn-primary j_alibaba">导入1688</a>                <a href="javascript:;" class="btn btn-primary j_postfee">运费</a>
                    <a href="javascript:;" class="btn btn-primary batch_update_price">修改价格</a>
                    <a href="javascript:;" class="btn btn-primary batch_update_num">修改库存</a>
                    <a href="javascript:;" class="btn btn-primary batch_update_class">分类</a>
                                            </div>
        <hr>
        <div class="mgt10">
            <div class="paginate">
                <a href="javascript:;" class="prev disabled"></a><a class="cur">1</a><a href="http://tp.weifenxiao.com/Item/lists/item_status/onsale/p/2.html">2</a><a href="http://tp.weifenxiao.com/Item/lists/item_status/onsale/p/2.html" class="next"></a>            </div>
            <!-- end paginate -->
        </div>
    </div>
    </div>
    <div class="footer">© 2019 启博软件 , Inc. All rights reserved.</div>
</div>