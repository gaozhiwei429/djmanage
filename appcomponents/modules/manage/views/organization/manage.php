<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */
?>
<?=Html::cssFile('@web/static/css/tree/bootstrap.min.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
<?=Html::cssFile('@web/static/css/tree/custom.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
<?=Html::cssFile('@web/static/css/tree/font-awesome.min.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
<?=Html::cssFile('@web/static/css/tree/animate.min.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
<?=Html::cssFile('@web/static/css/tree/style.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
<?=Html::cssFile('@web/static/css/tree/platform.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
<?=Html::cssFile('@web/static/css/tree/style.min.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
<div class="layui-card">
    <div class="layui-header notselect">
        <div class="pull-left"><span><?= Html::encode($title ? $title : (isset($this->title) ? $this->title : null)) ?></span></div>
        <div class="pull-right margin-right-15 nowrap">
            <?php
            if(isset($menuUrl) && !empty($menuUrl) && in_array(trim(Url::to(['manage/news/add']),"/"), $menuUrl)) {
                ?>
                <button data-open='<?=Url::to(['manage/news/edit']);?>' class='layui-btn layui-btn-sm layui-btn-primary'>添加</button>
            <?php
            }
            ?>
            <?php
            if(isset($menuUrl) && !empty($menuUrl) && in_array(trim(Url::to(['manage/news/del']),"/"), $menuUrl)) {
                ?>
                <button data-update data-field='delete' data-action='<?=Url::to(['manage/news/del']);?>'  class='layui-btn layui-btn-sm layui-btn-primary'>删除</button>
            <?php
            }
            ?>
        </div>
    </div>
    <div class="layui-card-body gray-bg searchPage">
        <div class="wrapper wrapper-content animated fadeInUp">
        <table style="clear:both;">
			<tbody><tr>
				<td style="vertical-align: top; width: 30%;" class="treeParent">
					<div id="tree" class="searchPage left-tree jstree jstree-1 jstree-default" style="width: 417.9px;" role="tree" aria-multiselectable="true" tabindex="0" aria-activedescendant="00000000000000000000000000000000" aria-busy="false">
                        <ul class="jstree-container-ul jstree-children" role="group">
                            <li role="treeitem" aria-selected="false" aria-level="1" aria-labelledby="00000000000000000000000000000000_anchor" aria-disabled="true" aria-expanded="true" id="00000000000000000000000000000000" class="jstree-node  jstree-open jstree-last">
                                <i class="jstree-icon jstree-ocl" role="presentation"></i>
                                <a class="jstree-anchor  jstree-disabled" href="#" tabindex="-1" id="00000000000000000000000000000000_anchor">
                                    <i class="jstree-icon jstree-themeicon" role="presentation"></i>基层单位
                                </a><ul role="group" class="jstree-children">
                                    <li role="treeitem" aria-selected="true" aria-level="2" aria-labelledby="04c0a2dbe7de4b2da4428685eba7a90d_anchor" aria-expanded="true" id="04c0a2dbe7de4b2da4428685eba7a90d" class="jstree-node  jstree-open jstree-last">
                                        <i class="jstree-icon jstree-ocl" role="presentation"></i>
                                        <a class="jstree-anchor jstree-clicked" href="#" tabindex="-1" id="04c0a2dbe7de4b2da4428685eba7a90d_anchor">
                                            <i class="jstree-icon jstree-themeicon" role="presentation"></i>上级党委
                                        </a>
                                        <ul role="group" class="jstree-children">
                                            <li role="treeitem" aria-selected="false" aria-level="3" aria-labelledby="c4d89315b054446cb00cb22a0c973209_anchor" id="c4d89315b054446cb00cb22a0c973209" class="jstree-node  jstree-leaf">
                                                <i class="jstree-icon jstree-ocl" role="presentation"></i>
                                                <a class="jstree-anchor" href="#" tabindex="-1" id="c4d89315b054446cb00cb22a0c973209_anchor">
                                                    <i class="jstree-icon jstree-themeicon jstree-file jstree-themeicon-custom" role="presentation"></i>
                                                    <span class="partylose"><i class="fa fa-trash"></i>&nbsp;基层党委</span>
                                                </a>
                                            </li>
                                            <li role="treeitem" aria-selected="false" aria-level="3" aria-labelledby="5b15570367b14396a9b5b58ada891488_anchor" aria-expanded="true" id="5b15570367b14396a9b5b58ada891488" class="jstree-node  jstree-open">
                                                <i class="jstree-icon jstree-ocl" role="presentation"></i>
                                                <a class="jstree-anchor" href="#" tabindex="-1" id="5b15570367b14396a9b5b58ada891488_anchor">
                                                    <i class="jstree-icon jstree-themeicon" role="presentation"></i>社区党委
                                                </a>
                                                <ul role="group" class="jstree-children"><li role="treeitem" aria-selected="false" aria-level="4" aria-labelledby="cc18ec83b97e44abaf8c3b4d2326db33_anchor" aria-expanded="true" id="cc18ec83b97e44abaf8c3b4d2326db33" class="jstree-node  jstree-open jstree-last">
                                                        <i class="jstree-icon jstree-ocl" role="presentation"></i>
                                                        <a class="jstree-anchor" href="#" tabindex="-1" id="cc18ec83b97e44abaf8c3b4d2326db33_anchor">
                                                            <i class="jstree-icon jstree-themeicon" role="presentation"></i>社区党总支
                                                        </a>
                                                        <ul role="group" class="jstree-children">
                                                            <li role="treeitem" aria-selected="false" aria-level="5" aria-labelledby="eb97fe55cb7348dea8b5c284014dd9f8_anchor" aria-expanded="true" id="eb97fe55cb7348dea8b5c284014dd9f8" class="jstree-node  jstree-open jstree-last">
                                                                <i class="jstree-icon jstree-ocl" role="presentation"></i>
                                                                <a class="jstree-anchor" href="#" tabindex="-1" id="eb97fe55cb7348dea8b5c284014dd9f8_anchor">
                                                                    <i class="jstree-icon jstree-themeicon" role="presentation"></i>社区党支部
                                                                </a>
                                                                <ul role="group" class="jstree-children">
                                                                    <li role="treeitem" aria-selected="false" aria-level="6" aria-labelledby="761d090f5f4047b2b32e3462ce2da63d_anchor" id="761d090f5f4047b2b32e3462ce2da63d" class="jstree-node  jstree-leaf">
                                                                        <i class="jstree-icon jstree-ocl" role="presentation"></i>
                                                                        <a class="jstree-anchor" href="#" tabindex="-1" id="761d090f5f4047b2b32e3462ce2da63d_anchor">
                                                                            <i class="jstree-icon jstree-themeicon jstree-file jstree-themeicon-custom" role="presentation"></i>党小组一部
                                                                        </a>
                                                                    </li>
                                                                    <li role="treeitem" aria-selected="false" aria-level="6" aria-labelledby="e46e79056bd94c8c919024512ebead75_anchor" aria-expanded="true" id="e46e79056bd94c8c919024512ebead75" class="jstree-node  jstree-open">
                                                                        <i class="jstree-icon jstree-ocl" role="presentation"></i>
                                                                        <a class="jstree-anchor" href="#" tabindex="-1" id="e46e79056bd94c8c919024512ebead75_anchor">
                                                                            <i class="jstree-icon jstree-themeicon" role="presentation"></i>党小组二部
                                                                        </a>
                                                                        <ul role="group" class="jstree-children">
                                                                            <li role="treeitem" aria-selected="false" aria-level="7" aria-labelledby="34d229a5a91641fcbfd264de84cfbf2d_anchor" id="34d229a5a91641fcbfd264de84cfbf2d" class="jstree-node  jstree-leaf jstree-last">
                                                                                <i class="jstree-icon jstree-ocl" role="presentation"></i>
                                                                                <a class="jstree-anchor" href="#" tabindex="-1" id="34d229a5a91641fcbfd264de84cfbf2d_anchor">
                                                                                    <i class="jstree-icon jstree-themeicon jstree-file jstree-themeicon-custom" role="presentation"></i>XX党小组
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </li>
                                                                    <li role="treeitem" aria-selected="false" aria-level="6" aria-labelledby="3074dff52aff420fa15cd48e478d6b36_anchor" id="3074dff52aff420fa15cd48e478d6b36" class="jstree-node  jstree-leaf jstree-last">
                                                                        <i class="jstree-icon jstree-ocl" role="presentation"></i>
                                                                        <a class="jstree-anchor" href="#" tabindex="-1" id="3074dff52aff420fa15cd48e478d6b36_anchor">
                                                                            <i class="jstree-icon jstree-themeicon jstree-file jstree-themeicon-custom" role="presentation"></i>党小组三部
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li role="treeitem" aria-selected="false" aria-level="3" aria-labelledby="5d04db9b4438402f89a28bfa1bfe640c_anchor" aria-expanded="true" id="5d04db9b4438402f89a28bfa1bfe640c" class="jstree-node  jstree-open">
                                                <i class="jstree-icon jstree-ocl" role="presentation"></i>
                                                <a class="jstree-anchor" href="#" tabindex="-1" id="5d04db9b4438402f89a28bfa1bfe640c_anchor">
                                                    <i class="jstree-icon jstree-themeicon" role="presentation"></i>企业党委
                                                </a>
                                                <ul role="group" class="jstree-children">
                                                    <li role="treeitem" aria-selected="false" aria-level="4" aria-labelledby="397c78d95b2e4626b7904ef4e002ba38_anchor" aria-expanded="true" id="397c78d95b2e4626b7904ef4e002ba38" class="jstree-node  jstree-open jstree-last">
                                                        <i class="jstree-icon jstree-ocl" role="presentation"></i>
                                                        <a class="jstree-anchor" href="#" tabindex="-1" id="397c78d95b2e4626b7904ef4e002ba38_anchor">
                                                            <i class="jstree-icon jstree-themeicon" role="presentation"></i>车间党总支
                                                        </a>
                                                        <ul role="group" class="jstree-children">
                                                            <li role="treeitem" aria-selected="false" aria-level="5" aria-labelledby="7ac7acf314b4433f8a533e6e3f4cb197_anchor" aria-expanded="true" id="7ac7acf314b4433f8a533e6e3f4cb197" class="jstree-node  jstree-open">
                                                                <i class="jstree-icon jstree-ocl" role="presentation"></i>
                                                                <a class="jstree-anchor" href="#" tabindex="-1" id="7ac7acf314b4433f8a533e6e3f4cb197_anchor">
                                                                    <i class="jstree-icon jstree-themeicon" role="presentation"></i>日班党支部
                                                                </a>
                                                                <ul role="group" class="jstree-children"><li role="treeitem" aria-selected="false" aria-level="6" aria-labelledby="0856138af3674a5a9bf96f9b402b0b5d_anchor" id="0856138af3674a5a9bf96f9b402b0b5d" class="jstree-node  jstree-leaf">
                                                                        <i class="jstree-icon jstree-ocl" role="presentation"></i>
                                                                        <a class="jstree-anchor" href="#" tabindex="-1" id="0856138af3674a5a9bf96f9b402b0b5d_anchor">
                                                                            <i class="jstree-icon jstree-themeicon jstree-file jstree-themeicon-custom" role="presentation"></i>第一党小组
                                                                        </a>
                                                                    </li>
                                                                    <li role="treeitem" aria-selected="false" aria-level="6" aria-labelledby="99e2cedfb8ec410f95a85538d5c731a4_anchor" id="99e2cedfb8ec410f95a85538d5c731a4" class="jstree-node  jstree-leaf jstree-last">
                                                                        <i class="jstree-icon jstree-ocl" role="presentation"></i>
                                                                        <a class="jstree-anchor" href="#" tabindex="-1" id="99e2cedfb8ec410f95a85538d5c731a4_anchor">
                                                                            <i class="jstree-icon jstree-themeicon jstree-file jstree-themeicon-custom" role="presentation"></i>第二党小组
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                            <li role="treeitem" aria-selected="false" aria-level="5" aria-labelledby="2c7a2a067e124caab418a2d47c262ae7_anchor" aria-expanded="true" id="2c7a2a067e124caab418a2d47c262ae7" class="jstree-node  jstree-open jstree-last">
                                                                <i class="jstree-icon jstree-ocl" role="presentation"></i>
                                                                <a class="jstree-anchor" href="#" tabindex="-1" id="2c7a2a067e124caab418a2d47c262ae7_anchor">
                                                                    <i class="jstree-icon jstree-themeicon" role="presentation"></i>车间甲班党支部
                                                                </a>
                                                                <ul role="group" class="jstree-children">
                                                                    <li role="treeitem" aria-selected="false" aria-level="6" aria-labelledby="7a8ea0fc57a648cf9c3bf8a3992687cb_anchor" id="7a8ea0fc57a648cf9c3bf8a3992687cb" class="jstree-node  jstree-leaf">
                                                                        <i class="jstree-icon jstree-ocl" role="presentation"></i>
                                                                        <a class="jstree-anchor" href="#" tabindex="-1" id="7a8ea0fc57a648cf9c3bf8a3992687cb_anchor">
                                                                            <i class="jstree-icon jstree-themeicon jstree-file jstree-themeicon-custom" role="presentation"></i>第一党小组
                                                                        </a>
                                                                    </li>
                                                                    <li role="treeitem" aria-selected="false" aria-level="6" aria-labelledby="4217ad81b52d47838ec6d54af143bd11_anchor" id="4217ad81b52d47838ec6d54af143bd11" class="jstree-node  jstree-leaf jstree-last">
                                                                        <i class="jstree-icon jstree-ocl" role="presentation"></i>
                                                                        <a class="jstree-anchor" href="#" tabindex="-1" id="4217ad81b52d47838ec6d54af143bd11_anchor">
                                                                            <i class="jstree-icon jstree-themeicon jstree-file jstree-themeicon-custom" role="presentation"></i>第二党小组
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li role="treeitem" aria-selected="false" aria-level="3" aria-labelledby="35a479fba0d3482eb95a30d4d7998e8a_anchor" aria-expanded="true" id="35a479fba0d3482eb95a30d4d7998e8a" class="jstree-node  jstree-open">
                                                <i class="jstree-icon jstree-ocl" role="presentation"></i>
                                                <a class="jstree-anchor" href="#" tabindex="-1" id="35a479fba0d3482eb95a30d4d7998e8a_anchor">
                                                    <i class="jstree-icon jstree-themeicon" role="presentation"></i>学校党委
                                                </a>
                                                <ul role="group" class="jstree-children">
                                                    <li role="treeitem" aria-selected="false" aria-level="4" aria-labelledby="eea5b6e8fb2940729d4b28f792ef0d28_anchor" id="eea5b6e8fb2940729d4b28f792ef0d28" class="jstree-node  jstree-leaf jstree-last">
                                                        <i class="jstree-icon jstree-ocl" role="presentation"></i>
                                                        <a class="jstree-anchor" href="#" tabindex="-1" id="eea5b6e8fb2940729d4b28f792ef0d28_anchor">
                                                            <i class="jstree-icon jstree-themeicon jstree-file jstree-themeicon-custom" role="presentation"></i>学部党支部
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li role="treeitem" aria-selected="false" aria-level="3" aria-labelledby="c1439e7a6df449b9815a179bb5e4f4e0_anchor" aria-expanded="true" id="c1439e7a6df449b9815a179bb5e4f4e0" class="jstree-node  jstree-open">
                                                <i class="jstree-icon jstree-ocl" role="presentation"></i>
                                                <a class="jstree-anchor" href="#" tabindex="-1" id="c1439e7a6df449b9815a179bb5e4f4e0_anchor">
                                                    <i class="jstree-icon jstree-themeicon" role="presentation"></i>集团党委
                                                </a>
                                                <ul role="group" class="jstree-children">
                                                    <li role="treeitem" aria-selected="false" aria-level="4" aria-labelledby="1b66650e01be403ea43a701cfc7ed85f_anchor" id="1b66650e01be403ea43a701cfc7ed85f" class="jstree-node  jstree-leaf jstree-last">
                                                        <i class="jstree-icon jstree-ocl" role="presentation"></i>
                                                        <a class="jstree-anchor" href="#" tabindex="-1" id="1b66650e01be403ea43a701cfc7ed85f_anchor">
                                                            <i class="jstree-icon jstree-themeicon jstree-file jstree-themeicon-custom" role="presentation"></i>第一党支部
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li role="treeitem" aria-selected="false" aria-level="3" aria-labelledby="f428511c259e431081b929b22716a5f8_anchor" id="f428511c259e431081b929b22716a5f8" class="jstree-node  jstree-leaf jstree-last">
                                                <i class="jstree-icon jstree-ocl" role="presentation"></i>
                                                <a class="jstree-anchor" href="#" tabindex="-1" id="f428511c259e431081b929b22716a5f8_anchor">
                                                    <i class="jstree-icon jstree-themeicon jstree-file jstree-themeicon-custom" role="presentation"></i>党组织2
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
				</td>		
				<td>
			        <div class="ibox float-e-margins margin-bottom-0">
			            <div class="ibox-content">
			                <div class="row">
			                    <div class="col-sm-12">
									<div class="row m-b-sm">
										<div class="col-sm-5 buttonList nochecked">
											<button id="freshBtn" type="button" class="btn btn-info btn-sm freshBtn" title="刷新">
											    <span class="fa fa-refresh" aria-hidden="true">&nbsp;&nbsp;刷新</span>
											</button>
											<button id="addBtn" type="button" class="btn btn-info btn-sm addBtn" style="display: inline-block;" title="追加">
												<span class="fa fa-plus" aria-hidden="true">&nbsp;&nbsp;追加</span>
											</button>
											
										</div>
			                            <div class="col-sm-5 col-sm-offset-2">
			                            </div>
									</div>                        
			                        <!-- 列表  -->
									<div class="table-responsive" id="contentsContainerList"><!--?xml version="1.0" encoding="utf-8" ?-->


<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th width="40px">
                <div class="icheckbox_square-green" style="position: relative;">
                    <input type="checkbox" class="i-checks checkAll" name="input[]" style="position: absolute; opacity: 0;">
                    <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins>
                </div>
            </th>
            <th width="60px">序号</th>
            <th>人员姓名</th>
            <th width="150px">职务</th>
            <th width="150px">任职日期</th>
            <th width="90px">操作</th>
        </tr>
	 </thead>
     <tbody>
		
        <tr>
			<td>
				
				<div class="icheckbox_square-green" style="position: relative;">
                    <input type="checkbox" class="i-checks onecheck" name="input[]" value="db3a9309459742a390f5233712181313" style="position: absolute; opacity: 0;">
                    <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;">

                    </ins>
                </div>
				
			</td>
			<td align="center">
				
				<div class="gridlist" title="1">
					1
				</div>
				
			</td>
			<td align="left">
				
       				<div class="gridlist" title="马玉平">马玉平</div>
       				
       		</td>
       		
			<td align="center">
       			<div class="gridlist" title="书记">书记</div>
       		</td>
       		<td align="center">
       			
					<div class="gridlist" title="2019-09-20">2019-09-20</div>
                
       		</td>
       		
			       	
       		<td class="buttonList">
                
                	<div class="btn-group"> 
                       	<div data-toggle="dropdown" class="btn btn-warning btn-sm dropdown-toggle">操作 <span class="caret"></span>
                       	</div>
                       	<ul class="dropdown-menu" data-pk="{&quot;strGuid&quot;:&quot;db3a9309459742a390f5233712181313&quot;}">
                           	<li>
			                	<a class="editBtn" style="display: inline-block;" title="修改">修改</a>
                           	</li>
                           	<li>
								
                           	</li>
                       	</ul>
                   	</div>
				
             </td>	
		</tr>
     	
        <tr>
			<td>
				
				<div class="icheckbox_square-green" style="position: relative;"><input type="checkbox" class="i-checks onecheck" name="input[]" value="ee95076492024295a18cf59f63fbda84" style="position: absolute; opacity: 0;">
                    <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins>
                </div>
				
			</td>
			<td align="center">
				
				<div class="gridlist" title="2">
					2
				</div>
				
			</td>
			<td align="left">
				
       				<div class="gridlist" title="赵晓龙">赵晓龙</div>
       				
       		</td>
       		
			<td align="center">
       			<div class="gridlist" title="书记">书记</div>
       		</td>
       		<td align="center">
       			
					<div class="gridlist" title="2019-09-19">2019-09-19</div>
                
       		</td>
       		
			       	
       		<td class="buttonList">
                
                	<div class="btn-group"> 
                       	<div data-toggle="dropdown" class="btn btn-warning btn-sm dropdown-toggle">操作 <span class="caret"></span>
                       	</div>
                       	<ul class="dropdown-menu" data-pk="{&quot;strGuid&quot;:&quot;ee95076492024295a18cf59f63fbda84&quot;}">
                           	<li>
			                	<a class="editBtn" style="display: inline-block;" title="修改">修改</a>
                           	</li>
                           	<li>
								
                           	</li>
                       	</ul>
                   	</div>
				
             </td>	
		</tr>
     	
        <tr>
			<td>
				
				<div class="icheckbox_square-green" style="position: relative;"><input type="checkbox" class="i-checks onecheck" name="input[]" value="0e09cad6b0dc40f388cf6c4dd6fa507e" style="position: absolute; opacity: 0;">
                    <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins>
                </div>
				
			</td>
			<td align="center">
				
				<div class="gridlist" title="3">
					3
				</div>
				
			</td>
			<td align="left">
				
       				<div class="gridlist" title="贾连军">贾连军</div>
       				
       		</td>
       		
			<td align="center">
       			<div class="gridlist" title="副书记">副书记</div>
       		</td>
       		<td align="center">
       			
					<div class="gridlist" title="2019-09-19">2019-09-19</div>
                
       		</td>
       		
			       	
       		<td class="buttonList">
                
                	<div class="btn-group"> 
                       	<div data-toggle="dropdown" class="btn btn-warning btn-sm dropdown-toggle">操作 <span class="caret"></span>
                       	</div>
                       	<ul class="dropdown-menu" data-pk="{&quot;strGuid&quot;:&quot;0e09cad6b0dc40f388cf6c4dd6fa507e&quot;}">
                           	<li>
			                	<a class="editBtn" style="display: inline-block;" title="修改">修改</a>
                           	</li>
                           	<li>
								
                           	</li>
                       	</ul>
                   	</div>
				
             </td>	
		</tr>
     	
        <tr>
			<td>
				
			</td>
			<td align="center">
				
			</td>
			<td align="left">
					
       		</td>
       		
			<td align="center">
       			<div class="gridlist" title=""></div>
       		</td>
       		<td align="center">
       			
       		</td>
       		
			       	
       		<td class="buttonList"></td>	
		</tr>
     	
        <tr>
			<td>
				
			</td>
			<td align="center">
				
			</td>
			<td align="left">
					
       		</td>
       		
			<td align="center">
       			<div class="gridlist" title=""></div>
       		</td>
       		<td align="center">
       			
       		</td>
       		
			       	
       		<td class="buttonList"></td>	
		</tr>
     	
        <tr>
			<td>
				
			</td>
			<td align="center">
				
			</td>
			<td align="left">
					
       		</td>
       		
			<td align="center">
       			<div class="gridlist" title=""></div>
       		</td>
       		<td align="center">
       			
       		</td>
       		
			       	
       		<td class="buttonList"></td>	
		</tr>
     	
        <tr>
			<td>
				
			</td>
			<td align="center">
				
			</td>
			<td align="left">
					
       		</td>
       		
			<td align="center">
       			<div class="gridlist" title=""></div>
       		</td>
       		<td align="center">
       			
       		</td>
       		
			       	
       		<td class="buttonList"></td>	
		</tr>
     	
        <tr>
			<td>
				
			</td>
			<td align="center">
				
			</td>
			<td align="left">
					
       		</td>
       		
			<td align="center">
       			<div class="gridlist" title=""></div>
       		</td>
       		<td align="center">
       			
       		</td>
       		
			       	
       		<td class="buttonList"></td>	
		</tr>
     	
        <tr>
			<td>
				
			</td>
			<td align="center">
				
			</td>
			<td align="left">
					
       		</td>
       		
			<td align="center">
       			<div class="gridlist" title=""></div>
       		</td>
       		<td align="center">
       			
       		</td>
       		
			       	
       		<td class="buttonList"></td>	
		</tr>
     	
        <tr>
			<td>
				
			</td>
			<td align="center">
				
			</td>
			<td align="left">
					
       		</td>
       		
			<td align="center">
       			<div class="gridlist" title=""></div>
       		</td>
       		<td align="center">
       			
       		</td>
       		
			       	
       		<td class="buttonList"></td>	
		</tr>
     	
        <tr>
			<td>
				
			</td>
			<td align="center">
				
			</td>
			<td align="left">
					
       		</td>
       		
			<td align="center">
       			<div class="gridlist" title=""></div>
       		</td>
       		<td align="center">
       			
       		</td>
       		
			       	
       		<td class="buttonList"></td>	
		</tr>
     	
        <tr>
			<td>
				
			</td>
			<td align="center">
				
			</td>
			<td align="left">
					
       		</td>
       		
			<td align="center">
       			<div class="gridlist" title=""></div>
       		</td>
       		<td align="center">
       			
       		</td>
       		
			       	
       		<td class="buttonList"></td>	
		</tr>
     	
        <tr>
			<td>
				
			</td>
			<td align="center">
				
			</td>
			<td align="left">
					
       		</td>
       		
			<td align="center">
       			<div class="gridlist" title=""></div>
       		</td>
       		<td align="center">
       			
       		</td>
       		
			       	
       		<td class="buttonList"></td>	
		</tr>
     	
        <tr>
			<td>
				
			</td>
			<td align="center">
				
			</td>
			<td align="left">
					
       		</td>
       		
			<td align="center">
       			<div class="gridlist" title=""></div>
       		</td>
       		<td align="center">
       			
       		</td>
       		
			       	
       		<td class="buttonList"></td>	
		</tr>
     	
        <tr>
			<td>
				
			</td>
			<td align="center">
				
			</td>
			<td align="left">
					
       		</td>
       		
			<td align="center">
       			<div class="gridlist" title=""></div>
       		</td>
       		<td align="center">
       			
       		</td>
       		
			       	
       		<td class="buttonList"></td>	
		</tr>
     	
        <tr>
			<td>
				
			</td>
			<td align="center">
				
			</td>
			<td align="left">
					
       		</td>
       		
			<td align="center">
       			<div class="gridlist" title=""></div>
       		</td>
       		<td align="center">
       			
       		</td>
       		
			       	
       		<td class="buttonList"></td>	
		</tr>
     	
        <tr>
			<td>
				
			</td>
			<td align="center">
				
			</td>
			<td align="left">
					
       		</td>
       		
			<td align="center">
       			<div class="gridlist" title=""></div>
       		</td>
       		<td align="center">
       			
       		</td>
       		
			       	
       		<td class="buttonList"></td>	
		</tr>
     	
        <tr>
			<td>
				
			</td>
			<td align="center">
				
			</td>
			<td align="left">
					
       		</td>
       		
			<td align="center">
       			<div class="gridlist" title=""></div>
       		</td>
       		<td align="center">
       			
       		</td>
       		
			       	
       		<td class="buttonList"></td>	
		</tr>
     	
        <tr>
			<td>
				
			</td>
			<td align="center">
				
			</td>
			<td align="left">
					
       		</td>
       		
			<td align="center">
       			<div class="gridlist" title=""></div>
       		</td>
       		<td align="center">
       			
       		</td>
       		
			       	
       		<td class="buttonList"></td>	
		</tr>
     	
        <tr>
			<td>
				
			</td>
			<td align="center">
				
			</td>
			<td align="left">
					
       		</td>
       		
			<td align="center">
       			<div class="gridlist" title=""></div>
       		</td>
       		<td align="center">
       			
       		</td>
       		
			       	
       		<td class="buttonList"></td>	
		</tr>
     	
    </tbody>
</table>
<input type="hidden" id="total" value="1">
<input type="hidden" id="hasnext" value="">
<input type="hidden" id="nowpage" value="1">
<input type="hidden" id="dataCnt" value="3">
<input type="hidden" id="dataCountLEN" value="20">
</div>
			                        <!-- 分页  -->
									<div id="page" class="row"><div class="listpage listpagebox" clickflg="true">
                                            <div class="col-xs-7" style="text-align:right;">
                                                <span id="firstpage" style="padding:0 0.5rem;">
                                                    <a style="color:#676a6c;" href="javascript:;">
                                                        <span class="fa fa-step-backward"></span>
                                                    </a>
                                                </span>
                                                <span id="frontpage" style="padding:0 0.5rem;">
                                                    <a style="color:#676a6c;" href="javascript:;">
                                                        <span class="fa fa-backward"></span>
                                                    </a>
                                                </span>
                                                <span style="padding:0 0.5rem;">
                                                    <input type="text" id="pagenum" maxlength="4" style="text-align:center;border:1px solid #e5e6e7;width: 4rem;"> 共 <span id="totalnum">1</span> 页</span>
                                                <span id="nextpage" style="padding:0 0.5rem;">
                                                    <a style="color:#676a6c;" href="javascript:;">
                                                        <span class="fa fa-forward"></span>
                                                    </a>
                                                </span>
                                                <span id="lastpage" style="padding:0 0.5rem;">
                                                    <a style="color:#676a6c;" href="javascript:;"><span class="fa fa-step-forward"></span></a>
                                                </span>
                                            </div>
                                            <div class="col-xs-5" style="text-align:right;">每页<span id="len">20</span>条 共 <span id="datanum">3</span> 条 <span id="currentpage" style="display:none;">1</span>
                                            </div>
                                        </div>
                                    </div>
			                    </div>
			                </div>
			            </div>
			        </div>
				</td>
			</tr>
		</tbody></table>
    </div>
	</div>
</div>


<script type="text/javascript">
var menuId = "300bd2907b1a4e55b00e665aa7cd628d";
var jsonButtonList = [{"code":"addBtn","name":"追加"},{"code":"editBtn","name":"修改"},{"code":"viewBtn","name":"查看"}];
var mid = 0;//左侧menu的ID
var searchUrl = "base/postAssignPartyAction!searchResultListPage.action";
var insertUrl ="base/postAssignPartyAction!gotoInsert.action";
var updateUrl ="base/postAssignPartyAction!gotoUpdate.action";
var deleteUrl = "base/postAssignPartyAction!deleteBatch.action";
var ztreeUrl = "/dj_web/partyaffairs/partyAdministrativeSearchAction!partyAdministrativeTree.action";
//判断第1次加载树
var firstTree = 1;
var state = 1;
$(function () {
	$(".left-tree").width($(".wrapper-content").width()*0.3)
	$(".treeParent").width("30%")
	top.openLoad();
	showTreeMenu();//加载左侧树
	$(".addBtn").click(function (){
		top.openWindow({
			title: '追加页面',
			area: [openWidth, '280px'],
			maxmin:true,
			content: content.getUrl(insertUrl+'?postAssignParty.strDeptGuid='+mid)
		});
	});
});
function showTreeMenu(){
 	$('#tree').jstree('destroy');
  		$.get(ztreeUrl+"?partyAdministrative.boolPublicValue=true&strIsDiff=2",function(data){	
    	$("#tree").jstree({
            "core": {
                "data": eval(data)
            }
        }).on('changed.jstree',function(e,data){
        	setTimeout(function(){
        		mid= data.instance.get_node(data.selected[0]).id;
                parentName= data.instance.get_node(data.selected[0]).text;
                state= data.instance.get_node(data.selected[0]).data;
               	firstTree = 2;
               	if(state == 2){
       				$("#addBtn").hide();
       			}
               	home.showPagenumListFunction(1);
        	},100);
        	
        });
	});
}
function editInfo(strGuid){
	if(strGuid != null && strGuid.length > 0){
		top.openWindow({
			title: '修改页面',
			area: [openWidth, '280px'],
			maxmin:true,
			content: content.getUrl(updateUrl,"postAssignParty.strGuid="+strGuid+"&postAssignParty.strDeptGuid="+mid)
		});
	}
}
function deleteInfo(ids){
	top.openConfirm(function(){
		var dataParemeter = {"ids":ids};
		content.ajaxPost(content.getUrl(deleteUrl),dataParemeter,function(result){
			if($.trim(result) == "ok"){
				top.successMsg("操作成功！");
				var currentPage = $("#currentpage").html();
				home.showPagenumListFunction(currentPage);
			}else if($.trim(result) == "error"){
				top.failMsg("操作失败！");
			}
			top.closeConfirm();
			return;
		});
	});
}
home.showPagenumListFunction = {};
home.showPagenumListFunction = function (currentPage) {
	if (firstTree == 1){
    	return;
    }
    parameter = {
	    "postAssignParty.strDeptGuid":mid,
    }
	if(null == home.tempParameter){
		home.tempParameter = parameter;
	}
	home.tempParameter["pageInfo.currentPage"] = currentPage;
	content.ajaxLoad("#contentsContainerList",content.getUrl(searchUrl),home.tempParameter,function(){
		localInitPage();
		if(state == 2){
			$("#addBtn").hide();
		}
	});
};
</script>
