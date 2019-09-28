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
        if(isset($menuUrl) && !empty($menuUrl) && in_array(Url::to(['admin/node/clear']), $menuUrl)) {
        ?>
            <button data-load='<?=Url::to(['admin/node/clear']);?>' class='layui-btn layui-btn-sm layui-btn-primary'>清理无效记录</button>
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
    <ul class="layui-tab-title">
        <?php
        foreach($groups as $key=>$group) {
        ?>
            <li>
                <?php
                if(isset($group['node']['title']) && !empty($group['node']['title'])) {

                ?>
                    <?=$group['node']['title']?></li>
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
        ?>
    </ul>
    <div class="layui-tab-content">
        <?php
        foreach($groups as $key=>$group) {
        ?>
        <div class="layui-tab-item">
            <table class="layui-table border-none" lay-skin="line">
                <?php
                if(isset($group['list'])){
                    if(empty($group['list'])) {
                ?>
                <p class="help-block text-center well">没 有 记 录 哦！</p>
                <?php
                }else{
                ?>
                <!--{foreach $group.list as $key=>$vo}-->
                <?php
                $i=1;
                foreach($group['list'] as $key=>$vo) {
                ?>
                <tr>
                    <td class='text-left nowrap'>
                        <span class="color-desc"><?=$vo['spl'];?></span> <?=$vo['node'];?>
                    <?php
//                    if(in_array(Url::to([$vo['node']."/save"]), $menuUrl)) {
                    ?>
                    &nbsp;<input autocomplete="off" class='layui-input layui-input-inline title-input' name='title' data-node="<?=$vo['node'];?>" value="<?=$vo['title'];?>">
                    <?php
//                    }
                    ?>
<!--                        {if auth("$classuri/save")}&nbsp;<input autocomplete="off" class='layui-input layui-input-inline title-input' name='title' data-node="{$vo.node}" value="{$vo.title}">{/if}-->
                    </td>
                    <td class='text-left nowrap'>
<!--                        {if auth("$classuri/save") and $vo.spt eq 1}-->
                    <?php
                    if($vo['spt']==1) {
                    ?>
                        <label class="color-desc think-checkbox">
                            <input data-login-group="<?=$vo['node'];?>" type="checkbox"> 全部加入登录控制
                        </label>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <label class="notselect margin-left-15 color-desc think-checkbox">
                            <input data-auth-group="<?=$vo['node'];?>" type="checkbox"> 全部加入权限控制
                        </label>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <label class="notselect margin-left-15 color-desc think-checkbox">
                            <input data-menu-group="<?=$vo['node'];?>" type="checkbox"> 全部加入菜单节点选择器
                        </label>
                    <?php
                    }
                    ?>
                    <?php
//                    if(in_array(Url::to([$vo['node']."/save"]), $menuUrl) && $vo['spt']==2) {
                        if($vo['spt']==2) {
                    ?>
<!--                        {if auth("$classuri/save") and $vo.spt eq 2}-->
                        <span class="color-desc">&nbsp;&nbsp;├─&nbsp;</span>
                        <label class="notselect margin-right-15 think-checkbox">
                            <!--{notempty name='vo.is_login'}-->
                        <?php
                        if(empty($vo['is_login'])) {
                        ?>
                            <input data-login-filter="<?=$vo['node'];?>" checked='checked' class="check-box login_<?=$vo['id'];?>_<?=$key;?>" type='checkbox' value='1' name='is_login' data-node="<?=$vo['node'];?>" onclick="!this.checked && ($('.auth_<?=$vo['id'];?>_<?=$key;?>')[0].checked = !!this.checked)">
                        <?php
                        }else{
                        ?>
                            <input data-login-filter="<?=$vo['node'];?>" class="check-box login_<?=$vo['id'];?>_<?=$key;?>" type='checkbox' value='1' name='is_login' data-node="<?=$vo['node'];?>" onclick="!this.checked && ($('.auth_<?=$vo['id'];?>_<?=$key;?>')[0].checked = !!this.checked)">
                        <?php
                        }
                        ?>
                            <!--{else}-->
<!--                            <input data-login-filter="{$vo.pnode}" class="check-box login_{$k}_{$key}" type='checkbox' value='1' name='is_login' data-node="{$vo.node}" onclick="!this.checked && ($('.auth_{$k}_{$key}')[0].checked = !!this.checked)">-->
                            <!--{/notempty}-->
                            加入登录控制
                        </label>
                        <span class="color-desc">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;├─&nbsp;</span>
                        <label class="notselect margin-right-15 think-checkbox">
                            <!--{notempty name='vo.is_auth'}-->
                        <?php
                        if($vo['is_auth']) {
                        ?>
                            <input data-auth-filter="<?=$vo['pnode'];?>" name='is_auth' data-node="<?=$vo['node'];?>" checked='checked' class="check-box auth_<?=$vo['id'];?>_<?=$key;?>" type='checkbox' onclick="this.checked && ($('.login_<?=$vo['id'];?>_<?=$key;?>')[0].checked = !!this.checked)" value='1'>
                        <?php
                        }else{
                        ?>
                            <!--{else}-->
                            <input data-auth-filter="<?=$vo['pnode'];?>" name='is_auth' data-node="<?=$vo['node'];?>" class="check-box auth_<?=$vo['id'];?>_<?=$key;?>" type='checkbox' value='1' onclick="this.checked && ($('.login_<?=$vo['id'];?>_<?=$key;?>')[0].checked = !!this.checked)">
                            <!--{/notempty}-->
                        <?php
                        }
                        ?>
                            加入权限控制
                        </label>
                        <span class="color-desc">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;├─&nbsp;</span>
                        <label class="notselect think-checkbox">
                            <!--{notempty name='vo.is_menu'}-->
                        <?php
                        if($vo['is_menu']) {
                        ?>
                            <input data-menu-filter="<?=$vo['pnode'];?>" name='is_menu' data-node="<?=$vo['node'];?>" checked='checked' class='check-box menu_<?=$vo['id'];?>_<?=$key;?>' type='checkbox' value='1'>
                            <!--{else}-->
                        <?php
                        }else{
                        ?>
                            <input data-menu-filter="<?=$vo['pnode'];?>" name='is_menu' data-node="<?=$vo['node'];?>" class='check-box menu_<?=$vo['id'];?>_<?=$key;?>' type='checkbox' value='1'>
                            <!--{/notempty}-->
                        <?php
                        }
                        ?>
                            加入菜单节点选择器
                        </label>
                    <?php
                    }
                    ?>
                    </td>
                    <td data-tips-filter="<?=$vo['pnode'];?>" class="loading-tips nowrap full-width"></td>
                </tr>
                <?php
                    $i++;
                }
                ?>
                <?php
                }
                ?>
            </table>
        </div>
        <?php
        }
        }
        ?>
    </div>
</div>

<!--{if auth("$classuri/save")}-->
<script>
    $(function () {

        syncLoginGroup.call(this);
        $('[data-login-group]').on('click', function () {
            var twoNode = this.getAttribute('data-login-group');
            if (!checkRequestStatus(twoNode)) {
                this.checked = !this.checked;
                return $.msg.tips('正在处理中, 请稍候...');
            }
            var checked = !!this.checked;
            $('[data-login-filter="' + twoNode + '"]').map(function () {
                if (!(this.checked = checked)) {
                    $('[data-auth-filter="' + twoNode + '"]').map(function () {
                        this.checked = false;
                    });
                }
                update(this);
            });
        });

        syncAuthGroup.call(this);
        $('[data-auth-group]').on('click', function () {
            var twoNode = this.getAttribute('data-auth-group');
            if (!checkRequestStatus(twoNode)) {
                this.checked = !this.checked;
                return $.msg.tips('正在处理中, 请稍候...');
            }
            var checked = !!this.checked;
            $('[data-auth-filter="' + twoNode + '"]').map(function () {
                if ((this.checked = checked)) {
                    $('[data-login-filter="' + twoNode + '"]').map(function () {
                        this.checked = checked;
                    });
                }
                update(this);
            });
        });

        syncMenuGroup.call(this);
        $('[data-menu-group]').on('click', function () {
            var twoNode = this.getAttribute('data-menu-group');
            if (!checkRequestStatus(twoNode)) {
                this.checked = !this.checked;
                return $.msg.tips('正在处理中, 请稍候...');
            }
            var checked = !!this.checked;
            $('[data-menu-filter="' + twoNode + '"]').map(function () {
                this.checked = checked;
                update(this);
            });
        });

        // 更新触发更新
        $('input.check-box').on('click', function () {
            update(this);
        });

        $('input.title-input').on('blur', function () {
            update(this);
        });

        // 数据自动更新
        function update(self) {
            var $item = $(self).parents('tr'), data = {list: []};
            $item.find('input').map(function () {
                var value = this.type === 'text' ? this.value : (this.checked ? 1 : 0);
                data.list.push({name: this.name, value: value, node: this.getAttribute('data-node')});
            });
            $item.find('.loading-tips').html('<p class="color-green"><i class="fa fa-spinner fa-spin"></i> 更新数据...</p>');
            $.form.load('{:url("save")}', data, 'post', function (ret) {
                if (ret.code === 0) {
                    var tips = '<p class="color-red"><i class="fa fa-close"></i> 更新异常</p>';
                    return $item.find('.loading-tips').html(tips), false;
                }
                return $item.find('.loading-tips').html(''), false;
            }, false);
            return syncLoginGroup(), syncMenuGroup(), syncAuthGroup();
        }

        // 状态网络处理状态
        function checkRequestStatus(twoNode) {
            var status = true;
            $('.loading-tips[data-tips-filter="' + twoNode + '"]').map(function () {
                $(this).html() && (status = false);
            });
            return status;
        }

        // 同步登录分组状态
        function syncLoginGroup() {
            $('[data-login-group]').map(function () {
                var node = this.getAttribute('data-login-group'), checked = true;
                $('[data-login-filter="' + node + '"]').map(function () {
                    this.checked || (checked = false);
                });
                this.checked = checked;
            });
        }

        // 同步权限分组状态
        function syncAuthGroup() {
            $('[data-auth-group]').map(function () {
                var node = this.getAttribute('data-auth-group'), checked = true;
                $('[data-auth-filter="' + node + '"]').map(function () {
                    this.checked || (checked = false);
                });
                this.checked = checked;
            });
        }

        // 同步菜单分组状态
        function syncMenuGroup() {
            $('[data-menu-group]').map(function () {
                var node = this.getAttribute('data-menu-group'), checked = true;
                $('[data-menu-filter="' + node + '"]').map(function () {
                    this.checked || (checked = false);
                });
                this.checked = checked;
            });
        }
    });
</script>
<!--{/if}-->
</div>