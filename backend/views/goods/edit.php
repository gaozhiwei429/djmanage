<?php
use yii\helpers\Url;
use \yii\helpers\Html;
/* @var $this yii\web\View */
?>
<?=Html::jsFile('@web/static/plugs/ace/ace.js?v='.date("ymd"), ['type' => "text/javascript"])?>
<style>
    select.block{
        display:none!important;
    }
</style>
<style type="text/css">
    .uploader-list {
        margin-left: -15px;
    }

    .uploader-list .info {
        position: relative;
        margin-top: -25px;
        background-color: black;
        color: white;
        filter: alpha(Opacity=80);
        -moz-opacity: 0.5;
        opacity: 0.5;
        width: 100px;
        height: 25px;
        text-align: center;
        display: none;
    }

    .uploader-list .handle {
        position: relative;
        background-color: black;
        color: white;
        filter: alpha(Opacity=80);
        -moz-opacity: 0.5;
        opacity: 0.5;
        width: 100px;
        text-align: right;
        height: 18px;
        margin-bottom: -18px;
        display: none;
    }

    .uploader-list .handle span {
        margin-right: 5px;
    }

    .uploader-list .handle span:hover {
        cursor: pointer;
    }

    .uploader-list .file-iteme {
        margin: 12px 0 0 15px;
        padding: 1px;
        float: left;
    }
</style>
<div class="layui-card">
    <div class="layui-card-body">
        <!-- 表单搜索 开始 -->
        <form autocomplete="off" class="layui-form" onsubmit="return false;" data-auto="true" action="#">
            <div class="layui-form-item">
                <label class="layui-form-label">标题</label>
                <div class="layui-input-block">
                    <?php
                    if(isset($info) && !empty($info)) {
                    ?>
                        <input name="name" value='<?=isset($info['name']) ? $info['name']:"";?>' required="required" pattern="^.{3,50}$" title="请输入正确的产品名称" placeholder="请输入3位及以上字符" class="layui-input">
                    <?php
                    } else{
                    ?>
                    <input name="name" value='' required="required" pattern="^.{3,50}$" title="请输入正确的产品名称" placeholder="请输入3位及以上字符" class="layui-input">
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="layui-form-item layui-upload">
                <label class="layui-form-label">产品封面图</label>
                <div class="layui-upload layui-input-block">
                    <input type="hidden" name="cover_url" value="<?=isset($info['cover_url']) ? $info['cover_url']:"";?>" required lay-verify="required" />
                    <button type="button" class="layui-btn layui-btn-primary" id="fileBtn"><i class="layui-icon">&#xe67c;</i>选择文件</button>
                    <button type="button" class="layui-btn layui-btn-warm" id="uploadBtn">开始上传</button>
                </div>
            </div>
            <!--<div class="layui-form-item layui-upload">
                <button type="button" class="layui-btn layui-btn-primary" id="projectBannerImg"><i class="layui-icon">&#xe67c;</i>多图片上传</button></button>
                <blockquote class="layui-elem-quote layui-quote-nm">
                    预览图：
                    <div class="layui-upload-list" id="projectBannerImgArr"></div>
                </blockquote>
            </div>-->
            <div class="layui-form-item layui-upload">
                <label class="layui-form-label">产品banner图</label>
            <button type="button" class="layui-btn layui-btn-primary" id="projectBannerImg">多图片上传</button>
                <blockquote class="layui-elem-quote layui-quote-nm" style="margin-top: 10px;width: 88%">
                预览图：
                <div class="layui-upload-list uploader-list" style="overflow: auto;" id="uploader-list">
                        <?php
                        if(isset($info['pic_url'])) {
                        foreach($info['pic_url'] as $picUrl) {
                        ?>
                            <div id="" class="file-iteme">
                                <div class="handle" style="display: none;"><span class="glyphicon glyphicon-trash"></span></div>
                                <input value="<?=(isset($picUrl)&&!is_array($picUrl)) ? $picUrl:"";?>" name="pic_url[]" class="layui-upload-img" style="display:none;">
                                <img style="width: 100px;height: 100px;" src="<?=(isset($picUrl)&&!is_array($picUrl)) ? $picUrl:"";?>">
                            </div>
                        <?php
                        }
                        }
                        ?>
                    </div>
                </blockquote>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">原价</label>
                <div class="layui-input-block">
                    <input name="price" value='<?=isset($info['price']) ? $info['price']:"";?>' required="required" pattern="^(([1-9][0-9]*\.[0-9][0-9]*)|([0]\.[0-9][0-9]*)|([1-9][0-9]*)|([0]{1}))$" title="请输入正确的金额" placeholder="请输入正确的金额" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">现价</label>
                <div class="layui-input-block">
                    <input name="now_price" value='<?=isset($info['now_price']) ? $info['now_price']:"";?>' required="required" pattern="^(([1-9][0-9]*\.[0-9][0-9]*)|([0]\.[0-9][0-9]*)|([1-9][0-9]*)|([0]{1}))$" title="请输入正确的金额" placeholder="请输入正确的金额" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">内容</label>
                <div class="layui-input-block">
                    <textarea id="layeditDemo"><?=isset($info['describe']) ? $info['describe']:"";?></textarea>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">主体材质</label>
                <div class="layui-input-inline">
                    <div class="layui-unselect layui-form-select downpanel">
                        <div class="layui-select-title">
                            <select name="main_material_id">
                            <option value="0">选择材质</option>
                            <?php
                            if(isset($materialList)){
                                foreach($materialList as $materialInfo) {
                            ?>
<option value="<?=isset($materialInfo['id']) ? $materialInfo['id'] : 0;?>" <?=(isset($info['main_material_id']) && $info['main_material_id']==$materialInfo['id']) ? "checked": "";?>><?=isset($materialInfo['name']) ? $materialInfo['name'] : "";?></option>
                            <?php
                                }
                            }
                            ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">是否上线</label>
                <div class="layui-input-block">
                    <input type="radio" name="status" value="1" title="是" <?=(isset($materialInfo['status']) && $materialInfo['status']==1) ? "checked" : "";?>>
                    <input type="radio" name="status" value="0" title="否" <?=(isset($materialInfo['status']) && $materialInfo['status']==0) ? "checked" : "";?>>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">热门推荐</label>
                <div class="layui-input-block">
                    <input type="radio" name="is_hot" value="1" title="是" <?=(isset($materialInfo['is_hot']) && $materialInfo['is_hot']==1) ? "checked" : "";?>>
                    <input type="radio" name="is_hot" value="0" title="否" <?=(isset($materialInfo['is_hot']) && $materialInfo['is_hot']==0) ? "checked" : "";?>>
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">所属分类</label>
                <div class="layui-input-inline">
                    <div class="layui-unselect layui-form-select downpanel">
                        <div class="layui-select-title">
                            <span class="layui-input layui-unselect" id="treeclass">选择栏目</span>
                            <input type="hidden" name="type_id" value="<?=isset($info['type_id']) ? $info['type_id']:0;?>">
                            <i class="layui-edge"></i>
                        </div>
                        <dl class="layui-anim layui-anim-upbit">
                            <dd>
                                <ul id="classtree"></ul>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="layui-form-item layui-upload" id="modelFile" style="display: none">
                <label class="layui-form-label">模型文件</label>
                <div class="layui-upload layui-input-block">
                    <input type="hidden" name="modelfile" value="<?=isset($info['modelfile']) ? $info['modelfile']:"";?>"/>
                    <button type="button" class="layui-btn layui-btn-primary" id="modelfileBtn"><i class="layui-icon">&#xe67c;</i>选择模型文件</button>
                    <button type="button" class="layui-btn layui-btn-warm" id="uploadFileBtn">开始上传模型</button>
                </div>
            </div>
            <div class="hr-line-dashed"></div>

            <div class="layui-form-item text-center">
                <?php
                if(isset($id)){
                ?>
                <input type='hidden' value='<?=isset($id) ? $id:0;?>' name='id'>
                <?php
                }
                ?>
                <button lay-submit="" lay-filter="commit" class="layui-btn"'>保存数据</button>
                <button class="layui-btn layui-btn-danger" type='button' data-close>取消编辑</button>
            </div>
        </form>
    </div>
</div>
<script type="application/javascript">
layui.use(['form', 'table', 'laypage', 'upload','layedit', 'tree'], function(){
    var form = layui.form;
    var layedit = layui.layedit;
    var $ = layui.jquery
        ,upload = layui.upload;
    var tree = layui.tree;
    var type_id = <?=isset($info['type_id']) ? $info['type_id']:0;?>;
    tree({
        elem: "#classtree",
        nodes: <?=$typeTree?>,
        click: function (node) {
            var $select = $($(this)[0].elem).parents(".layui-form-select");
            $select.removeClass("layui-form-selected").find(".layui-select-title span").html(node.name).end().find("input:hidden[name='type_id']").val(node.id);
            var nodes = ["10","20","40"];
            if(node.id == type_id) {
                $select.addClass("layui-form-selected");
            }
            if(nodes.indexOf(node.id)>=0) {
                $("#modelFile").hide()
            } else {
                $("#modelFile").show()
            }
        }
    });
    $(".downpanel").on("click", ".layui-select-title", function (e) {
        $(".layui-form-select").not($(this).parents(".layui-form-select")).removeClass("layui-form-selected");
        $(this).parents(".downpanel").toggleClass("layui-form-selected");
        layui.stope(e);
    }).on("click", "dl i", function (e) {
        layui.stope(e);
    });
    $(document).on("click", function (e) {
        $(".layui-form-select").removeClass("layui-form-selected");
    });
    //模型文件
    layui.use('upload',function(){
        var upload = layui.upload;
        upload.render({
            elem: '#modelfileBtn'
            ,url: '/common/upload/ali-file'
            ,accept: 'file'
            ,exts: 'gcode|STL'
            ,size: 1024 * 1000
            ,auto: false
            ,bindAction: '#uploadFileBtn'
            ,done: function(res){
                $("[name=modelfile]").val(res.data.src);
            }
        });
    });
    //图片上传
    layui.use('upload',function(){
        var upload = layui.upload;
        upload.render({
            elem: '#fileBtn'
            ,url: '/common/upload/ali-file'
            ,accept: 'image'
            ,acceptMime: 'image/*'
            ,exts: 'jpg|png|gif|bmp|jpeg'
            ,size: 1024 * 10
            ,auto: false
            ,bindAction: '#uploadBtn'
            ,done: function(res){
                $("[name=cover_url]").val(res.data.src);
            }
        });
    });
    upload.render({
        elem: '#projectBannerImg'
        ,url: '/common/upload/ali-file'
        ,multiple: true
        ,accept: 'image'
        ,acceptMime: 'image/*'
        ,exts: 'jpg|png|gif|bmp|jpeg'
        ,size: 1024 * 10
        ,before: function(obj){
            layer.msg('图片上传中...', {
                icon: 16,
                shade: 0.01,
                time: 0
            })
        }
        ,done: function(res){
            layer.close(layer.msg());//关闭上传提示窗口
            //上传完毕
            $('#uploader-list').append(
                '<div id="" class="file-iteme">' +
                '<div class="handle"><span class="glyphicon glyphicon-trash"></span></div>' +
                '<input value="'+ res.data.src +'" name="pic_url[]" class="layui-upload-img" style="display:none;">' +
                '<img style="width: 100px;height: 100px;" src='+ res.data.src +'>' +
                '<div class="info">' + res.data.title + '</div>' +
                '</div>'
            );
        }
    });
    $(document).on("mouseenter mouseleave", ".file-iteme", function(event){
        if(event.type === "mouseenter"){
            //鼠标悬浮
            $(this).children(".info").fadeIn("fast");
            $(this).children(".handle").fadeIn("fast");
        }else if(event.type === "mouseleave") {
            //鼠标离开
            $(this).children(".info").hide();
            $(this).children(".handle").hide();
        }
    });
    // 删除图片
    $(document).on("click", ".file-iteme .handle", function(event){
        $(this).parent().remove();
    });
    layedit.set({
        uploadImage: {
            url: '/common/upload/ali-file',
            accept: 'image',
            acceptMime: 'image/*',
            exts: 'jpg|png|gif|bmp|jpeg',
            size: 1024 * 10,
            done:function (data) {
                console.log(data);
            }
        }
        , height: '90%'
    });
    //,{tool: ['strong', 'italic','underline','del','|','left','center','right','|','link','unlink','face','image','|','code']}
//    layedit.build('layeditDemo'); //建立编辑器
    form.render(); //更新全部，防止input多选和单选框不显示问题
    var index = layedit.build('layeditDemo',{
        height: 180, //设置编辑器高度
        tool: [
            'html',
            'code',
            'strong' //加粗
            ,'italic' //斜体
            ,'underline' //下划线
            ,'del' //删除线
            ,'addhr'
            ,'|' //分割线
            ,'left' //左对齐
            ,'center' //居中对齐
            ,'right' //右对齐
            ,'link' //超链接
            ,'unlink' //清除链接
            ,'face' //表情
            ,'image' //插入图片
            , 'video'
            , 'anchors'
            ,'table'
            , 'fullScreen'
        ]
    }); //建立编辑器
    var storage=window.localStorage;
    var table = layui.table;
    var userData = storage.getItem("userData");
    var headerParams = JSON.parse(userData);
    //监听提交
    var params = {};
    var selfUrl = window.location.href;
    form.on('submit(commit)', function(data){
        data.field.describe = ""; //获取html
        var describe = layedit.getContent(index);
        if(describe) {
            data.field.describe =describe;
        }
        $.ajax({
            type: "post",
            url:"<?= Url::to(['project/project/edit']); ?>",
            contentType: "application/json;charset=utf-8",
            data :JSON.stringify(data.field),
            dataType: "json",
            beforeSend: function (XMLHttpRequest) {
                for(var i in headerParams) {
                    XMLHttpRequest.setRequestHeader(i, headerParams[i]);
                }
            },
            success:function(result){
                if(result.code == 0) {
                    layer.alert('提交成功', {icon: 1}, function(index){
                        parent.location.reload();
                    });
                } else if(result.code == 5001) {
                    layer.alert('登录状态异常', {icon: 2}, function(index){
                        top.location.href="../user/login";
                    });
                } else {
                    layer.alert(result.msg, {icon: 2}, function(index){
                        return false;
                    });
                }
            },
            error: function () {
                layer.alert('网络环境异常请检查', {icon: 2});
            }
        });
    });
});
</script>