<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */
$this->title = '系统角色管理';
?>

<!--{notempty name='title'}-->
<?php
if(isset($this->title) && !empty($this->title)) {
    ?>
    <div class="layui-header notselect">
        <div class="pull-left"><span><?= Html::encode($this->title) ?></span></div>
        <div class="pull-right margin-right-15 nowrap">
            <!--{if auth("$classuri/add")}-->
            <button data-modal='<?= Url::to(['role/add']); ?>' data-title="添加角色" class='layui-btn layui-btn-sm layui-btn-primary'>添加角色</button>
            <!--{/if}-->

            <!--{if auth("$classuri/del")}-->
            <button data-update data-field='delete' data-action='<?= Url::to(['role/del']); ?>' class='layui-btn layui-btn-sm layui-btn-primary'>删除角色</button>
            <!--{/if}-->
        </div>
    </div>
<?php
}
?>
<!--{/notempty}-->
<div class="layui-card-body">
<form autocomplete="off" onsubmit="return false;" data-auto="true" method="post">

    <!--{if empty($list)}-->
<!--    <p class="help-block text-center well">没 有 记 录 哦！</p>-->
    <!--{else}-->
    <input type="hidden" value="resort" name="action">
    <table class="layui-table" lay-skin="line">
        <thead>
        <tr>
            <th class='list-table-check-td think-checkbox'>
                <input data-auto-none="" data-check-target='.list-check-box' type='checkbox'>
            </th>
            <th class='text-left'>ID</th>
            <th class='text-left'>名称</th>
            <th class='text-left'>描述</th>
            <th class='text-center'>状态</th>
            <th class='text-left'>添加时间</th>
            <th class='text-center'></th>
        </tr>
        </thead>
        <tbody>
        <!--{foreach $list as $key=>$vo}-->
        <tr>
            <td class='list-table-check-td think-checkbox'>
                <input class="list-check-box" value='{$vo.id}' type='checkbox'>
            </td>
            <td class='text-left'>{$vo.id}</td>
            <td class='text-left'>{$vo.role_name}</td>
            <td class='text-left'>{$vo.desc|default="<span class='color-desc'>没有写描述哦！</span>"}</td>
            <td class='text-center'>
                {if $vo.status eq 0}<span>禁用</span>{elseif $vo.status eq 1}<span class="color-green">启用</span>{/if}
            </td>
            <td class="text-left nowrap">{$vo.create_at|format_datetime}</td>
            <td class='text-center nowrap'>

                {if auth("$classuri/edit")}
                <span class="text-explode">|</span>
                <a data-title="编辑角色" data-modal='{:url("$classuri/edit")}?id={$vo.id}'>编辑</a>
                {/if}

                {if auth("$classuri/apply")}
                <span class="text-explode">|</span>
                <a data-open='{:url("$classuri/apply")}?id={$vo.id}'>授权</a>
                {/if}

                {if $vo.status eq 1 and auth("$classuri/forbid")}
                <span class="text-explode">|</span>
                <a data-update="{$vo.id}" data-field='status' data-value='0' data-action='{:url("$classuri/forbid")}'>禁用</a>
                {elseif auth("$classuri/resume")}
                <span class="text-explode">|</span>
                <a data-update="{$vo.id}" data-field='status' data-value='1' data-action='{:url("$classuri/resume")}'>启用</a>
                {/if}

                {if auth("$classuri/del")}
                <span class="text-explode">|</span>
                <a data-update="{$vo.id}" data-field='delete' data-action='{:url("$classuri/del")}'>删除</a>
                {/if}

            </td>
        </tr>
        <!--{/foreach}-->
        </tbody>
    </table>
<!--    {if isset($page)}<p>{$page|raw}</p>{/if}-->
    <!--{/if}-->
</form>
</div>