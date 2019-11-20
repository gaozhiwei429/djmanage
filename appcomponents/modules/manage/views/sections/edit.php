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
<!--<?=Html::cssFile('@web/static/css/draggable/draggable.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
<?=Html::jsFile('@web/static/js/draggable/jquery-1.12.4.js?v='.date("ymd"), ['type' => "text/javascript"])?>
<?=Html::jsFile('@web/static/js/draggable/jquery-ui.js?v='.date("ymd"), ['type' => "text/javascript"])?>-->
<style>
    ul { list-style-type: none; margin: 0; padding: 0; margin-bottom: 10px; }
    li { margin: 5px; padding: 5px; width: 150px; }
</style>
<div class="layui-card">
    <div class="layui-header notselect">
        <div class="pull-left">
            <span>
                <?= Html::encode($title ? $title : (isset($this->title) ? $this->title : null)) ?>
                <?= isset($info['title']) ? $info['title'] : null ?>
            </span>
        </div>
        <div class="pull-right margin-right-15 nowrap">
            <?php
            if(isset($menuUrl) && !empty($menuUrl) && in_array(trim(Url::to(['manage/sections/add']),"/"), $menuUrl)) {
                ?>
                <button data-model='<?=Url::to(['manage/sections/edit']);?>' class='layui-btn layui-btn-sm layui-btn-primary'>添加章节</button>
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
            <table style="clear:both; width: 100%;">
                <tbody style="clear:both; width: 100%;">
                <tr>
                    <td style="vertical-align: top; width: 30%;" class="treeParent">
                        <div style="width: 100%">章节</div>
                        <div id="tree" class="searchPage left-tree jstree jstree-1 jstree-default" role="tree" aria-multiselectable="true" tabindex="0" aria-activedescendant="1" aria-busy="false" style="clear:both; width: 100%;">

                            <ul id="sortable" class="jstree-container-ul jstree-children ui-sortable" role="group">
                                <?php
                                if(isset($sectionsList) && !empty($sectionsList)) {
                                foreach($sectionsList as $sectionsk=>$sectionsv) {
                                ?>
                                <li role="treeitem" aria-selected="false" aria-level="<?=isset($sectionsv['uuid']) ? $sectionsv['uuid'] : ""?>" aria-labelledby="<?=isset($sectionsv['uuid']) ? $sectionsv['uuid'] : ""?>_anchor" aria-disabled="true" aria-expanded="true" id="<?=isset($sectionsv['uuid']) ? $sectionsv['uuid'] : ""?>" class="jstree-node  jstree-open jstree-last">
                                    <i class="jstree-ocl" role="presentation"></i>
                                    <a class="jstree-anchor jstree-disabled" href="javascript:void(0);" tabindex="-1" id="<?=isset($sectionsv['uuid']) ? $sectionsv['uuid'] : ""?>_anchor">
                                        <i class="jstree-themeicon" role="presentation"></i><?=isset($sectionsv['title']) ? $sectionsv['title'] : ""?>
                                    </a>
                                </li>

                                <?php
                                }
                                }
                                ?>
                            </ul>
                        </div>
                    </td>

                    <td class="main_right_content" style="padding: 0px; margin-top: 0px; width: 70%">
                        <div style="width: 100%">课件</div>
                        <div class="ibox float-e-margins margin-bottom-0" style="padding: 0px; margin-top: 0px;">

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
            $("a").removeClass("jstree-clicked");
            $(this).addClass("jstree-clicked");
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
        $("#tree").children(".jstree-container-ul").children(".jstree-node").children("a").click();
        form.render(); //更新全部，防止input多选和单选框不显示问题
    });
</script>
