<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */
$this->title = '系统角色管理';
?>
<ul id="zTree" class="ztree loading">
    <li></li>
</ul>
<div class="hr-line-dashed"></div>
<div class="layui-form-item text-center">
    <button class="layui-btn" data-submit-role type='button'>保存数据</button>
    <button class="layui-btn layui-btn-danger" type='button' onclick="window.history.back()">取消编辑</button>
</div>

<!--{/notempty}-->
<div class="layui-card-body">
<?=Html::cssFile('@web/static/plugs/ztree/zTreeStyle/zTreeStyle.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
<?=Html::jsFile('@web/static/plugs/ztree/jquery.ztree.all.min.js?v='.date("ymd"), ['type' => "text/javascript"])?>
<script>
$(function () {
    var storage=window.localStorage;
    var table = layui.table;
    var userData = storage.getItem("userData");
    var headerParams = JSON.parse(userData);
    var params = {};
    window.roleForm = new function () {
        this.data = {};
        this.ztree = null;
        this.setting = {
            view: {showLine: false, showIcon: false, dblClickExpand: false},
            check: {enable: true, nocheck: false, chkboxType: {"Y": "ps", "N": "ps"}},
            callback: {
                beforeClick: function (treeId, treeNode) {
                    if (treeNode.children.length < 1) {
                        window.roleForm.ztree.checkNode(treeNode, !treeNode.checked, null, true);
                    } else {
                        window.roleForm.ztree.expandNode(treeNode);
                    }
                    return false;
                }
            }
        };
        this.getData = function (self) {
            var index = $.msg.loading();
            jQuery.get('<?=Url::to(['admin/role/apply', 'id' => $role_id,'action'=>'getNode']);?>', {}, function (ret) {
                $.msg.close(index);
                self.data = renderChildren(ret.data, 1);
                self.showTree();

                function renderChildren(data, level) {
                    var childrenData = [];
                    for (var i in data) {
                        var children = {};
                        children.open = true;
                        children.node = data[i].node;
                        children.name = data[i].title || data[i].node;
                        children.checked = data[i].checked || false;
                        children.children = renderChildren(data[i]._sub_, level + 1);
                        childrenData.push(children);
                    }
                    return childrenData;
                }
            }, 'JSON');
        };
        this.showTree = function () {
            this.ztree = jQuery.fn.zTree.init(jQuery("#zTree"), this.setting, this.data);
            while (true) {
                var reNodes = this.ztree.getNodesByFilter(function (node) {
                    return (!node.node && node.children.length < 1);
                });
                if (reNodes.length < 1) {
                    break;
                }
                for (var i in reNodes) {
                    this.ztree.removeNode(reNodes[i]);
                }
            }
        };
        this.submit = function () {
            var params = {};
            var nodes = [];
            var data = this.ztree.getCheckedNodes(true);
            for (var i in data) {
                (data[i].node) && nodes.push(data[i].node);
            }
            params.id = "<?=$role_id?>";
            params.nodes = nodes;
            $.ajax({
                type: "post",
                url:"<?=Url::to(['manage/role/save', 'id' => $role_id,'action'=>'getNode']);?>",
                contentType: "application/json;charset=utf-8",
                data :JSON.stringify(params),
                dataType: "json",
                beforeSend: function (XMLHttpRequest) {
                    for(var i in headerParams) {
                        XMLHttpRequest.setRequestHeader(i, headerParams[i]);
                    }
                },
                success:function(result) {
                    if (result.code == 0) {
                        layer.msg('保存成功', {
                            icon: 1,
                            time: 2000 //2秒关闭（如果不配置，默认是3秒）
                        }, function(){
                            window.history.back();
//                            top.location.href="../user/login"
                        });
                    } else if(result.code == 5001) {
                        layer.msg('同上', {
                            icon: 2,
                            time: 2000 //2秒关闭（如果不配置，默认是3秒）
                        }, function(){
                            top.location.href="../user/login"
                        });
                }else {
                    layer.msg(result.msg, {icon: 2});
                }
            },error: function () {

                }
            });
//            $.form.load("<?//=Url::to(['admin/role/save', 'id' => $role_id,'action'=>'getNode']);?>//", {id:'<?//=$role_id?>//',nodes: nodes}, 'post');
        };
        this.getData(this);
    };

    $('[data-submit-role]').on('click', function () {
//        alert("<?//=Url::to(['admin/role/save', 'id' => $role_id,'action'=>'getNode']);?>//");
//        $.form.load("<?//=Url::to(['admin/role/save', 'id' => $role_id,'action'=>'getNode']);?>//", {id:'<?//=$role_id?>//',nodes: nodes}, 'post');

        window.roleForm.submit();
    });
});
</script>
</div>

<style>
    ul.ztree li {
        white-space: normal !important
    }

    ul.ztree li span.button.switch {
        margin-right: 5px
    }

    ul.ztree ul ul li {
        display: inline-block;
        white-space: normal
    }

    ul.ztree > li {
        padding: 15px 25px 15px 15px;
    }

    ul.ztree > li > ul {
        margin-top: 12px;
        border-top: 1px solid rgba(0, 0, 0, .1);
    }

    ul.ztree > li > ul > li {
        padding: 5px
    }

    ul.ztree > li > a > span {
        font-size: 15px;
        font-weight: 700
    }
</style>