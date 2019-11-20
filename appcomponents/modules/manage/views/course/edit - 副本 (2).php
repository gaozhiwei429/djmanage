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
<?=Html::jsFile('@web/static/js/draggable/jquery.dad.min.js?v='.date("ymd"), ['type' => "text/javascript"])?>
-->
<?=Html::cssFile('@web/static/css/draggable/jquery-ui.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
<?=Html::cssFile('@web/static/css/draggable/style.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
<?=Html::jsFile('@web/static/js/draggable/jquery-1.js?v='.date("ymd"), ['type' => "text/javascript"])?>
<?=Html::jsFile('@web/static/js/draggable/jquery-ui.js?v='.date("ymd"), ['type' => "text/javascript"])?>
<style>
    .jq22 { width: 100%; margin: 0 auto; font-size: 0; margin-bottom: 20px;}
    /*.jq22 .item { width: 100%; margin-bottom: 20px;}*/
    .jq22 .item1 { background-color: #1faeff;}
    .jq22 .item2 { background-color: #ff2e12;}
    .jq22 .item3 { background-color: #00c13f;}
    .jq22 .item4 { background-color: #e1b700;}
    .jq22 .item5 { background-color: #7200ac;}
    .jq22 span { display: block; height: 50px; line-height: 50px; font-size: 2rem; text-align: center; color: #fff;}
    .thead { width: 728px; height: 90px; margin: 0 auto; border-bottom: 40px solid transparent;}
</style>
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
            <table style="clear:both; width: 100%;">
                <tbody style="clear:both; width: 100%;">
                <tr>
                    <td style="vertical-align: top; width: 30%;" class="treeParent">
                        <ul id="sortable" class="ui-sortable">
                            <li class="ui-state-default ui-sortable-handle" style="">Item 1</li>
                            <li class="ui-state-default ui-sortable-handle" style="">Item 3</li>
                            <li class="ui-state-default ui-sortable-handle" style="">Item 2</li>
                            <li class="ui-state-default ui-sortable-handle" style="">Item 5</li>
                            <li class="ui-state-default ui-sortable-handle">Item 4</li>
                        </ul>
                        <!--<div id="tree" class="searchPage left-tree jstree jstree-1 jstree-default" role="tree" aria-multiselectable="true" tabindex="0" aria-activedescendant="1" aria-busy="false" style="clear:both; width: 100%;">

                            <ul class="jstree-container-ul jstree-children jq22 dad-active dad-container" role="group">

                                <li role="treeitem" aria-selected="false" aria-level="1" aria-labelledby="1_anchor" aria-disabled="true" aria-expanded="true" id="1" class=" item item1 dads-children dad-draggable-area">
                                    <i class="jstree-ocl" role="presentation"></i>
                                    <a class="jstree-anchor jstree-disabled" href="javascript:void(0)" tabindex="-1" id="1_anchor">
                                        <i class="jstree-themeicon" role="presentation"></i>习近平总书记系列重要讲话读本（2016年版）1
                                    </a>
                                </li>
                                <li role="treeitem" aria-selected="false" aria-level="2" aria-labelledby="2_anchor" aria-disabled="true" aria-expanded="true" id="2" class=" item item2 dads-children dad-draggable-area">
                                    <i class="jstree-ocl" role="presentation"></i>
                                    <a class="jstree-anchor jstree-disabled" href="javascript:void(0)" tabindex="-1" id="2_anchor">
                                        <i class="jstree-themeicon" role="presentation"></i>习近平总书记系列重要讲话读本（2016年版）2
                                    </a>
                                </li>
                                <li role="treeitem" aria-selected="false" aria-level="3" aria-labelledby="3_anchor" aria-disabled="true" aria-expanded="true" id="3" class=" item item3 dads-children dad-draggable-area">
                                    <i class="jstree-ocl" role="presentation"></i>
                                    <a class="jstree-anchor jstree-disabled" href="javascript:void(0)" tabindex="-1" id="3_anchor">
                                        <i class="jstree-themeicon" role="presentation"></i>习近平总书记系列重要讲话读本（2016年版）3
                                    </a>
                                </li>
                                <li role="treeitem" aria-selected="false" aria-level="4" aria-labelledby="4_anchor" aria-disabled="true" aria-expanded="true" id="4" class=" item item4 dads-children dad-draggable-area">
                                    <i class="jstree-ocl" role="presentation"></i>
                                    <a class="jstree-anchor jstree-disabled" href="javascript:void(0)" tabindex="-1" id="4_anchor">
                                        <i class="jstree-themeicon" role="presentation"></i>习近平总书记系列重要讲话读本（2016年版）4
                                    </a>
                                </li>
                                <li role="treeitem" aria-selected="false" class=" item">
                                    <i class="jstree-ocl" role="presentation"></i>
                                    <a class="jstree-anchor jstree-disabled" href="javascript:void(0)" tabindex="-1" id="4_anchor">
                                    <i aria-label="图标: plus" class="anticon anticon-plus"></i>添加章节
                                    </a>
                                </li>
                            </ul>
                        </div>-->
                    </td>

                    <td class="main_right_content" style="padding: 0px; margin-top: 0px; width: 70%">
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
        $( "#sortable").sortable({
            revert: true
        });
        $( "ul, li" ).disableSelection();
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
