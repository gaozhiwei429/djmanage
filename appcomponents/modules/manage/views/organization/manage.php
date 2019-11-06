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
			<tbody>
            <tr>
                <?php
                if(isset($treeData)) {
                    foreach($treeData as $k=>$v) {
                        ?>
                        <td style="vertical-align: top; width: 30%;" class="treeParent">
                            <div id="tree" class="searchPage left-tree jstree jstree-1 jstree-default" style="width: 417.9px;" role="tree" aria-multiselectable="true" tabindex="0" aria-activedescendant="<?=isset($v['uuid']) ? $v['uuid'] : ""?>" aria-busy="false">

                                <ul class="jstree-container-ul jstree-children" role="group">
                                    <li role="treeitem" aria-selected="false" aria-level="1" aria-labelledby="<?=isset($v['uuid']) ? $v['uuid'] : ""?>_anchor" aria-disabled="true" aria-expanded="true" id="<?=isset($v['uuid']) ? $v['uuid'] : ""?>" class="jstree-node  jstree-open jstree-last">
                                        <i class="jstree-icon jstree-ocl" role="presentation"></i>
                                        <a class="jstree-anchor  jstree-disabled" href="javascript:void(0)" tabindex="-1" id="<?=isset($v['uuid']) ? $v['uuid'] : ""?>_anchor">
                                            <i class="jstree-icon jstree-themeicon" role="presentation"></i><?=isset($v['title']) ? $v['title'] : ""?>
                                        </a>
                                        <?php
                                        if(isset($v['son'])) {
                                            foreach($v['son'] as $sonk=>$sonv) {
                                                ?>
                                                <ul role="group" class="jstree-children">
                                                    <li role="treeitem" aria-selected="true" aria-level="2" aria-labelledby="<?=isset($sonv['uuid']) ? $sonv['uuid'] : ""?>_anchor" aria-expanded="true" id="<?=isset($sonv['uuid']) ? $sonv['uuid'] : ""?>" class="jstree-node <?=(!isset($sonv['son'])|| empty($sonv['son'])) ? "jstree-leaf" : " jstree-open"?> jstree-last">
                                                        <i class="jstree-icon jstree-ocl" role="presentation"></i>
                                                        <a class="jstree-anchor jstree-clicked" href="javascript:void(0)" tabindex="-1" id="<?=isset($sonv['uuid']) ? $sonv['uuid'] : ""?>_anchor">
                                                            <i class="jstree-icon jstree-themeicon <?=(!isset($sonv['son']) || empty($sonv['son'])) ? "jstree-file jstree-themeicon-custom jstree-ocl" : ""?> <?=(!isset($sonv['son'])|| empty($sonv['son'])) ? "jstree-file jstree-themeicon-custom jstree-ocl" : ""?>" role="presentation"></i><?=isset($sonv['title']) ? $sonv['title'] : ""?>
                                                        </a>
                                                        <?php
                                                        if(isset($sonv['son'])) {
                                                            foreach($sonv['son'] as $sonToSonk=>$sonToSonv) {
                                                                ?>
                                                                <ul role="group" class="jstree-children">
                                                                    <li role="treeitem" aria-selected="false" aria-level="3" aria-labelledby="<?=isset($sonToSonv['uuid']) ? $sonToSonv['uuid'] : ""?>_anchor" id="<?=isset($sonToSonv['uuid']) ? $sonToSonv['uuid'] : ""?>" class="jstree-node <?=(!isset($sonToSonv['son'])|| empty($sonToSonv['son'])) ? "jstree-leaf" : " jstree-open"?>">
                                                                        <i class="jstree-icon jstree-ocl" role="presentation"></i>
                                                                        <a class="jstree-anchor <?=(isset($sonToSonv['son']) && empty($sonToSonv['son'])) ? "jstree-file jstree-themeicon-custom " : ""?>" href="javascript:void(0)" tabindex="-1" id="<?=isset($sonToSonv['uuid']) ? $sonToSonv['uuid'] : ""?>_anchor">
                                                                            <i class="jstree-icon jstree-themeicon <?=(isset($sonToSonv['son']) && empty($sonToSonv['son'])) ? "jstree-clicked" : ""?> <?=(!isset($sonToSonv['son'])|| empty($sonToSonv['son'])) ? "jstree-file jstree-themeicon-custom jstree-ocl" : ""?>" role="presentation"></i>
                                                                            &nbsp;<?=isset($sonToSonv['title']) ? $sonToSonv['title'] : ""?>
                                                                        </a>
                                                                        <?php
                                                                        if(isset($sonToSonv['son'])) {
                                                                            foreach ($sonToSonv['son'] as $sonChildSonk => $sonChildSonv) {
                                                                                ?>
                                                                        <ul role="group" class="jstree-children">
                                                                            <li role="treeitem" aria-selected="false" aria-level="4" aria-labelledby="<?=isset($sonChildSonv['uuid']) ? $sonChildSonv['uuid'] : ""?>_anchor" aria-expanded="true" id="<?=isset($sonChildSonv['uuid']) ? $sonChildSonv['uuid'] : ""?>" class="jstree-node  <?=(!isset($sonChildSonv['son'])|| empty($sonChildSonv['son'])) ? "jstree-leaf" : " jstree-open"?>">
                                                                                <i class="jstree-icon jstree-ocl" role="presentation"></i>
                                                                                <a class="jstree-anchor" href="javascript:void(0)" tabindex="-1" id="<?=isset($sonChildSonv['uuid']) ? $sonChildSonv['uuid'] : ""?>_anchor">
                                                                                    <i class="jstree-icon jstree-themeicon <?=(!isset($sonChildSonv['son'])|| empty($sonChildSonv['son'])) ? "jstree-file jstree-themeicon-custom jstree-ocl" : ""?>" role="presentation"></i><?=isset($sonChildSonv['title']) ? $sonChildSonv['title'] : ""?>
                                                                                </a>
                                                                                <?php
                                                                                if(isset($sonChildSonv['son'])) {
                                                                                foreach ($sonChildSonv['son'] as $sonChilderSonk => $sonChilderSonv) {
                                                                                ?>
                                                                                <ul role="group" class="jstree-children">
                                                                                    <li role="treeitem" aria-selected="false" aria-level="5" aria-labelledby="<?=isset($sonChilderSonv['uuid']) ? $sonChilderSonv['uuid'] : ""?>_anchor" aria-expanded="true" id="<?=isset($sonChilderSonv['uuid']) ? $sonChilderSonv['uuid'] : ""?>" class="jstree-node <?=(!isset($sonChilderSonv['son'])|| empty($sonChilderSonv['son'])) ? "jstree-leaf" : " jstree-open"?>">
                                                                                        <i class="jstree-icon jstree-ocl" role="presentation"></i>
                                                                                        <a class="jstree-anchor" href="javascript:void(0)" tabindex="-1" id="<?=isset($sonChilderSonv['uuid']) ? $sonChilderSonv['uuid'] : ""?>_anchor">
                                                                                            <i class="jstree-icon jstree-themeicon <?=(!isset($sonChilderSonv['son'])|| empty($sonChilderSonv['son'])) ? "jstree-file jstree-themeicon-custom jstree-ocl" : ""?>" role="presentation"></i><?=isset($sonChilderSonv['title']) ? $sonChilderSonv['title'] : ""?>
                                                                                        </a>

                                                                                        <?php
                                                                                        if(isset($sonChilderSonv['son'])) {
                                                                                                ?>
                                                                                            <ul role="group" class="jstree-children">
                                                                                                <?php
                                                                                                foreach ($sonChilderSonv['son'] as $sonChilderSonk1 => $sonChilderSonv1) {
                                                                                                    ?>
                                                                                                <li role="treeitem" aria-selected="false" aria-level="7" aria-labelledby="<?=isset($sonChilderSonv1['uuid']) ? $sonChilderSonv1['uuid'] : ""?>_anchor" id="<?=isset($sonChilderSonv1['uuid']) ? $sonChilderSonv1['uuid'] : ""?>" class="jstree-node <?=(!isset($sonChilderSonv1['son'])|| empty($sonChilderSonv1['son'])) ? "jstree-leaf" : " jstree-open"?>">
                                                                                                    <i class="jstree-icon jstree-ocl" role="presentation"></i>
                                                                                                    <a class="jstree-anchor" href="javascript:void(0)" tabindex="-1" id="<?=isset($sonChilderSonv1['uuid']) ? $sonChilderSonv1['uuid'] : ""?>_anchor">
                                                                                                        <i class="jstree-icon jstree-themeicon <?=(!isset($sonChilderSonv1['son'])|| empty($sonChilderSonv1['son'])) ? "jstree-file jstree-themeicon-custom jstree-ocl" : ""?>" role="presentation"></i><?=isset($sonChilderSonv1['title']) ? $sonChilderSonv1['title'] : ""?>
                                                                                                    </a>
                                                                                                    <?php
                                                                                                    if(isset($sonChilderSonv1['son'])) {
                                                                                                        ?>
                                                                                                        <ul role="group" class="jstree-children">
                                                                                                            <?php
                                                                                                            foreach ($sonChilderSonv1['son'] as $sonChilderSonk2 => $sonChilderSonv2) {
                                                                                                                ?>
                                                                                                                <li role="treeitem" aria-selected="false" aria-level="7" aria-labelledby="<?=isset($sonChilderSonv2['uuid']) ? $sonChilderSonv2['uuid'] : ""?>_anchor" id="<?=isset($sonChilderSonv2['uuid']) ? $sonChilderSonv2['uuid'] : ""?>" class="jstree-node <?=(!isset($sonChilderSonv2['son'])|| empty($sonChilderSonv2['son'])) ? "jstree-leaf" : " jstree-open"?>">
                                                                                                                    <i class="jstree-icon jstree-ocl" role="presentation"></i>
                                                                                                                    <a class="jstree-anchor" href="javascript:void(0)" tabindex="-1" id="<?=isset($sonChilderSonv2['uuid']) ? $sonChilderSonv2['uuid'] : ""?>_anchor">
                                                                                                                        <i class="jstree-icon jstree-themeicon jstree-file jstree-themeicon-custom" role="presentation"></i><?=isset($sonChilderSonv2['title']) ? $sonChilderSonv2['title'] : ""?>
                                                                                                                    </a>
                                                                                                                </li>
                                                                                                            <?php
                                                                                                            }
                                                                                                            ?>
                                                                                                        </ul>
                                                                                                    <?php
                                                                                                    }
                                                                                                    else {
                                                                                                    ?>
                                                                                            <?php
                                                                                            }
                                                                                            ?>
                                                                                                <?php
                                                                                                }
                                                                                                ?>
                                                                                </ul>
                                                                                        <?php
                                                                                        } else {
                                                                                        ?>
                                                                                        <li role="treeitem" aria-selected="false" aria-level="6" aria-labelledby="<?=isset($sonChilderSonv['uuid']) ? $sonChilderSonv['uuid'] : ""?>_anchor" id="<?=isset($sonChilderSonv['uuid']) ? $sonChilderSonv['uuid'] : ""?>" class="jstree-node <?=(!isset($sonChilderSonv['son'])|| empty($sonChilderSonv['son'])) ? "jstree-leaf" : " jstree-open"?>">
                                                                                            <i class="jstree-icon jstree-ocl" role="presentation"></i>
                                                                                            <a class="jstree-anchor" href="javascript:void(0)" tabindex="-1" id="<?=isset($sonChilderSonv['uuid']) ? $sonChilderSonv['uuid'] : ""?>_anchor">
                                                                                                <i class="jstree-icon jstree-themeicon jstree-file jstree-themeicon-custom" role="presentation"></i><?=isset($sonChilderSonv['title']) ? $sonChilderSonv['title'] : ""?>
                                                                                            </a>
                                                                                        </li>
                                                                                        <?php
                                                                                }
                                                                                    ?>
                                                                            </li>
                                                                                </ul>
                                                                            </li>
                                                                                <?php
                                                                                }
                                                                                }
                                                                                ?>
                                                                        </ul>
                                                                            <?php
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </li>

                                                                </ul>
                                                            <?php
                                                            }
                                                        }
                                                        ?>
                                                    </li>
                                                </ul>
                                            <?php
                                            }
                                        }
                                        ?>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    <?php
                    }
                }
                ?>

				<td class="main_right_content" style="padding: 0px; margin-top: 0px;">
                    <div class="ibox float-e-margins margin-bottom-0" style="padding: 0px; margin-top: 0px;">
<!--                        <iframe frameborder="0" scrolling="yes" style="width: 100%; padding: 0px; margin-top: 0px;" src="" id="aa">-->
<!--                        </iframe>-->
                    </div>
                </td>

			</tr>
		</tbody></table>
    </div>
	</div>
</div>


<script type="text/javascript">
layui.use(['form', 'table', 'laypage', 'layer', 'upload','laydate'], function(){
    var form = layui.form;
    var storage=window.localStorage;
    var $ = layui.jquery;

    //获取src值
    $(".jstree-anchor").on("click",function(){
        var id =$(this).parent().attr("id");
        layui.use(['layer', 'form'], function(){
            loading = layer.load(5000, {
                shade: false,
                time: 2*1000
            });
            $(".main_right_content .float-e-margins").load("<?= Url::to(['manage/organization/index?uuid=']); ?>"+id);
            layer.close(loading);
        });
//        alert("<?//= Url::to(['manage/organization/index?id=']); ?>//"+id);
//        $(".main_right_content iframe").attr("src","<?//= Url::to(['manage/organization/index?id=']); ?>//"+id);
//        (".main_right_content iframe").content(id);
    });
    form.render(); //更新全部，防止input多选和单选框不显示问题
});
</script>
