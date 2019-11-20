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
            if(isset($menuUrl) && !empty($menuUrl) && in_array(trim(Url::to(['manage/sections/edit']),"/"), $menuUrl)) {
            ?>
            <a href="javascript:void(0);" data-modal="<?=Url::to(['manage/sections/edit?course_uuid=']).(isset($info['uuid']) ? $info['uuid'] : "");?>" data-title="添加章节">

            <button class='layui-btn layui-btn-sm layui-btn-primary'>添加章节</button>
            </a>
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
                        <?php
                        if(!isset($sectionsList) || empty($sectionsList)) {
                            ?>
                            <div class="ibox-content">
                            <div class="row">
                            <div class="col-sm-12">
                            <!-- 列表  -->
                            <div class="table-responsive" id="contentsContainerList"><!--?xml version="1.0" encoding="utf-8" ?-->
                            <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th width="40px">
                                    <div class="icheckbox_square-green" style="position: relative;"><input type="checkbox" class="i-checks checkAll" name="input[]" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div>
                                </th>
                                <th width="60px">序号</th>
                                <th>课件名称</th>
                                <th width="160px">文件类型</th>
                                <th width="160px">文件大小</th>
                                <th width="100px">审批状态</th>
                                <th width="90px">操作</th>
                            </tr>
                            </thead>
                            <?php
                            for($i=0; $i<=20; $i++) {
                        ?>
                            <tbody>
                            <tr>
                                <td></td>
                                <td align="center">
                                    <div class="gridlist" title=""></div>
                                </td>
                                <td>
                                    <div class="gridlist" title=""></div>
                                </td>
                                <td>
                                    <div class="gridlist" title=""></div>
                                </td>
                                <td>
                                    <div class="gridlist" title=""></div>
                                </td>
                                <td>
                                    <div class="gridlist" title=""></div>
                                </td>

                                <td align="center">
                                    <div class="gridlist" title="">
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                    <?php
                            }
                            ?>
                            </table>
                                <input type="hidden" id="total" value="1">
                                <input type="hidden" id="hasnext" value="">
                                <input type="hidden" id="nowpage" value="1">
                                <input type="hidden" id="dataCnt" value="">
                                <input type="hidden" id="dataCountLEN" value="20">
                            </div>
                                <!-- 分页  -->
                                <div id="page" class="row">
                                    <div class="listpage listpagebox" clickflg="true">
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
                                <input type="text" id="pagenum" maxlength="4" style="text-align:center;border:1px solid #e5e6e7;width: 4rem;">
                                共 <span id="totalnum">1</span>页
                            </span>
                            <span id="nextpage" style="padding:0 0.5rem;">
                                <a style="color:#676a6c;" href="javascript:;">
                                    <span class="fa fa-forward"></span>
                                </a>
                            </span>
                            <span id="lastpage" style="padding:0 0.5rem;">
                                <a style="color:#676a6c;" href="javascript:;">
                                    <span class="fa fa-step-forward"></span>
                                </a>
                            </span>
                                        </div>
                                        <div class="col-xs-5" style="text-align:right;">每页<span id="len">20</span>条 共
                                            <span id="datanum"></span> 条
                                            <span id="currentpage" style="display:none;">1</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                            </div>
                            <?php
                        }
                    ?>
                        </div>
                    </td>
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
                <?php
                if(isset($sectionsList) && !empty($sectionsList)) {
                ?>
                $(".main_right_content .float-e-margins").load("<?= Url::to(['manage/session/index?sections_uuid=']); ?>"+id);
                <?php
                }
                ?>
                layer.close(loading);
            });
        });

        <?php
        if(isset($sectionsList) && !empty($sectionsList)) {
        ?>
        $("#tree").children(".jstree-container-ul").children(".jstree-node").children("a").click();
        <?php
        }
        ?>
        form.render(); //更新全部，防止input多选和单选框不显示问题
    });
</script>
