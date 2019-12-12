<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */
?>

<?=Html::cssFile('@web/static/css/common/main.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
<?=Html::cssFile('@web/static/plugs/layui/css/layui.js?v='.date("ymd"), ['type' => "text/javascript"])?>

<?=Html::cssFile('@web/static/plugs/layui/layui_ext/dtree/dtree.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
<?=Html::cssFile('@web/static/plugs/layui/layui_ext/dtree/font/dtreefont.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
<?=Html::jsFile('@web/static/plugs/layui/layui.all.js?v='.date("ymd"), ['type' => "text/javascript"])?>

<style>
.layui-laypage-btn {
    border: 1px solid #666 !important;
}
.layui-form-select .layui-input{
    height: 30px;
}
.laytable-cell-1-0-4 {
    width: 525px;
}
html,body{height:100%}
.dtree {
    padding-right:15px;
}
</style>
<div class="layui-card">
    <div class="layui-header notselect">
        <div class="pull-left">
<span>
<?= Html::encode($title ? $title : (isset($this->title) ? $this->title : null)) ?>
</span>
</div>
        <div class="pull-right margin-right-15 nowrap">

        </div>
    </div>
    <div class="layui-card-body gray-bg searchPage">
        <div style="margin-bottom:0px;">
            <!-- <ul id="demoTree" class="dtree" data-id="0"></ul> -->
            <div style="display: flex;flex-direction: row;padding-top: 10px;">
                <div id="dep-div" style="overflow-x: hidden;overflow-y: auto;">
                    <ul id="demoTree" class="dtree" style="padding-bottom: 40px" data-id="0"></ul>
                </div>
                <iframe style="width: 80%; border:none;overflow: hidden" id="userListIframe" src="<?=isset($hostInfo) ? $hostInfo : "";?><?=Url::to(['manage/dangyuan/index']);?>"></iframe>
            </div>

        </div>
    </div>
</div>

<!--页面JS脚本-->
<script>
layui.extend({
    dtree: '/static/plugs/layui/layui_ext/dtree/dtree'   // {/}的意思即代表采用自有路径，即不跟随 base 路径
}).use(['form', 'table', 'laypage', 'upload','layedit', 'tree', 'dtree'], function () {
    var dtree = layui.dtree, layer = layui.layer, jq = layui.jquery;
    var $ = layui.jquery;
    let bh = jq('html').height();
    jq('#dep-div').height(bh-20);
    jq('#userListIframe').height(bh-20);
    // var demoTree = [$list|raw];
    console.log('userList');
    let dataUrl = "<?=Url::to(['common/organization/get-tree']);?>";
    let dtreeData = {
        elem: "#demoTree",
        url: dataUrl,
        type: "all",
        dot: false,
    }
    if ('userList' == 'depAuth') {
        let user_id = jq("input[name='user_id']").val();
        dtreeData.url = dtreeData.url + '?scene=depAuth&user_id=' + user_id;
        dtreeData.checkbar = true;
        dtreeData.checkbarType = "no-all";
        dtreeData.checkbarData = "all";
        // dtreeData.checkbarData = "halfChoose";
    } else if ('userList' == 'choiceGroup') {
        dtreeData.checkbar = true;
        dtreeData.checkbarType = "self";
    }
    console.log(dtreeData);
    var DemoTree = dtree.render(dtreeData);

    dtree.on("node('demoTree')", function (param) {
        console.log(param);
        jq('#whole').removeClass('dtree-theme-item-this');
        if ('userList' == 'userList'){
//                let dep_auth = {"2":1,"3":1,"11":1,"12":1,"13":1,"17":1,"18":1,"19":1,"20":1,"21":1,"22":1,"23":1,"24":1,"25":1,"26":1,"27":1,"1":1,"14":1,"15":1,"10":1,"9":1,"38":1,"4":1,"28":1,"29":1,"5":1,"30":1,"31":1,"6":1,"32":1,"33":1,"7":1,"34":1,"35":1,"8":1,"36":1,"37":1};
//                console.log(dep_auth);
//                if (dep_auth[param.param.nodeId] != 1){
//                    return;
//                }
            let locationurl = "<?=isset($hostInfo) ? $hostInfo : "";?><?=Url::to(['manage/dangyuan/index']);?>" + "?organization_id=" +param.param.nodeId + "&dep_name=" + param.param.context;
            console.log(locationurl);
            jq('#userListIframe').attr('src', locationurl);
        } else if ('userList' == 'choiceUser') {
            let locationurl = "<?=isset($hostInfo) ? $hostInfo : "";?><?=Url::to(['manage/dangyuan/user-tree']);?>" + "?organization_id=" +param.param.nodeId
            jq('#userListIframe').attr('src', locationurl);
        }
        // location.href = locationurl;
    });

    jq('#whole').click(function () {
        console.log('whole');
        let _div = DemoTree.getNowNode();
        _div.removeClass('dtree-theme-item-this');
        jq(this).addClass('dtree-theme-item-this');
        let locationurl = '';
        if ('userList' == 'userList'){
            locationurl = "<?=isset($hostInfo) ? $hostInfo : "";?><?=Url::to(['common/dangyuan/get-list']);?>";
        } else if ('userList' == 'choiceUser') {
            locationurl = "<?=isset($hostInfo) ? $hostInfo : "";?><?=Url::to(['common/dangyuan/user-tree']);?>";
        }
        if (locationurl != '') {
            jq('#userListIframe').attr('src', locationurl);
        }
    });

    jq('#preserve').click(function () {
        let isChage = dtree.changeCheckbarNodes('demoTree');
        console.log(isChage);
        if (isChage === false) {
            layer.msg("请先编辑", {icon: 2, anim: 6, time: 1000});
            return;
        }
        loading = layer.load(2, {
            shade: [0.2,'#000']
        });
        let user_id = jq("input[name='user_id']").val();
        let auth = dtree.getCheckbarNodesParam('demoTree');
        let data = {
            user_id,
            auth,
        }
        postRequest("http://h5dangjian.orangelite.cn/admin.php/admin_user/editdepauth.html", data, "http://h5dangjian.orangelite.cn/admin.php/admin_user/index.html");

    });

    function postRequest (url, data, locationurl) {
        console.log('postRequest');
        jq.post(url, data, function (res) {
            if(res.code == 0){
                layer.close(loading);
                layer.msg(res.msg, {icon: 1, time: 1000}, function(){
                    location.href = locationurl;
                });
            }else{
                layer.close(loading);
                layer.msg(res.msg, {icon: 2, anim: 6, time: 1000});
            }
        });
    }
});
</script>
