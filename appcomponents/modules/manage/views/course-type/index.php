<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */
?>

<style>
    .layui-table .title-input {
        width: auto;
        height: 28px;
        line-height: 28px;
    }

    .layui-table label {
        cursor: pointer
    }
</style>
<div class="layui-card">
    <?php
    if(isset($title) && !empty($title)) {
        ?>
        <div class="layui-header notselect">
            <div class="pull-left"><span><?= Html::encode($title ? $title : (isset($this->title) ? $this->title : null)) ?></span></div>
            <div class="pull-right margin-right-15 nowrap">
                <?php
                if(isset($menuUrl) && !empty($menuUrl) && in_array(Url::to(['manage/type/clear']), $menuUrl)) {
                    ?>
                    <button data-load='<?=Url::to(['manage/type/clear']);?>' class='layui-btn layui-btn-sm layui-btn-primary'>清理无效记录</button>
                <?php
                }
                ?>
            </div>
        </div>
    <?php
    }
    ?>
    <script>
        $(function () {
            $('.layui-tab ul.layui-tab-title li:first').trigger('click');
        });
    </script>

    <div class="layui-tab layui-tab-card layui-box">
        <!--<ul class="layui-tab-title">
            <?php
            if(isset($treeData)) {
                foreach($treeData as $key=>$info) {
            ?>
            <li class="<?=($key==0) ? "layui-this" :""?>">
                <?php
                if(isset($info['title']) && !empty($info['title'])) {
                ?>
                    <?=$info['title']?></li>
                <?php
                } else {
                ?>
                    <span class="color-desc">未配置名称</span>（<?=$key?>）
                <?php
                }
                ?>
            </li>
        <?php
                }
            }
        ?>
        </ul>-->
        <div class="layui-tab-content">
            <?php
            if(isset($treeData)) {
            foreach($treeData as $treeDataKey=>$treeDataInfo) {
            ?>
            <div class="layui-tab-item <?=($treeDataKey==0) ? "layui-show" :""?>">
            <table class="layui-table border-none" lay-skin="line">
                <tr>
                    <td class='text-left nowrap' style="float: left">
                        <span class="color-desc"><?=isset($treeDataInfo['title']) ? $treeDataInfo['title'] : "";?></span>
                    </td>
                    <td class='text-left nowrap' style="float: right">
                        <a class="layui-btn layui-btn-radius layui-btn-sm layui-btn-danger" lay-event="edit" data-open="<?=Url::to(['manage/type/add',['parent_id'=>$treeDataInfo['parent_id']]]);?>">添加</a>
                        <a class="layui-btn layui-btn-radius layui-btn-sm layui-btn-danger" lay-event="edit" data-open="<?=Url::to(['manage/type/del',['id'=>$treeDataInfo['id']]]);?>">删除</a>
                        <a class="layui-btn layui-btn-radius layui-btn-sm layui-btn-danger" lay-event="edit" data-open="<?=Url::to(['manage/type/edit',['id'=>$treeDataInfo['id']]]);?>">修改</a>
                    </td>
                </tr>
                    <?php
                    $i=1;
                    if(isset($treeDataInfo['son'])) {
                    foreach($treeDataInfo['son'] as $key=>$vo) {
                        ?>
                        <tr>
                            <td class='text-left nowrap' style="float: left">
                                <span class="color-desc">&nbsp;&nbsp;&nbsp;├<?=isset($vo['title']) ? $vo['title'] : "";?></span>
                            </td>
                            <td class='text-left nowrap' style="float: right">
                                <a class="layui-btn layui-btn-radius layui-btn-sm layui-btn-danger" data-open="<?=Url::to(['manage/type/add?parent_id='.$treeDataInfo['parent_id']]);?>">添加</a>
                                <a class="layui-btn layui-btn-radius layui-btn-sm layui-btn-danger" data-open="<?=Url::to(['manage/type/del?id='.$treeDataInfo['id']]);?>">删除</a>
                                <a class="layui-btn layui-btn-radius layui-btn-sm layui-btn-danger" data-open="<?=Url::to(['manage/type/edit?id='.$treeDataInfo['id']]);?>">修改</a>
                            </td>
                        </tr>
                        <?php
                        $i++;
                        }
                    }
                    ?>
                <tr>
                    <td data-tips-filter="<?=$treeDataInfo['title'];?>" class="loading-tips nowrap full-width"></td>
                </tr>
                <?php
                }
                ?>
            </table>
            </div>
          <?php
            }
            ?>
        </div>
    </div>
</div>