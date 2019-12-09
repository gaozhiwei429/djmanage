<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */
?>
<div class="ibox-content">
    <div class="row">
        <div class="col-sm-12">
            <div class="row m-b-sm">
                <div class="col-sm-7 buttonList nochecked">
<!--                    <button id="isShowRevokeBtn" type="button" class="btn btn-info btn-sm isShowRevokeBtn" title="显示撤销">-->
<!--                        <span id="isShowRevoke" class="fa fa-eye" aria-hidden="true">&nbsp;&nbsp;显示撤销</span>-->
<!--                    </button>-->
<!--                    <button id="freshBtn" type="button" class="btn btn-info btn-sm freshBtn" title="刷新">-->
<!--                        <span class="fa fa-refresh" aria-hidden="true">&nbsp;&nbsp;刷新</span>-->
<!--                    </button>-->
                    <a data-modal="<?= Url::to(['manage/session/edit?']); ?>?id=<?=isset($userInfo['id']) ? $userInfo['id'] : ''?>" data-title="添加课件">
                        <button id="addBtn" type="button" class="btn btn-info btn-sm addBtn" style="display: inline-block;" title="添加课件">
                            <span class="fa fa-plus" aria-hidden="true">&nbsp;&nbsp;添加课件<?= (isset($sections_uuid) ? $sections_uuid : "") ?></span>
                        </button>
                    </a>
                </div>
                <div class="col-sm-5">
                    <div class="input-group searchclick">
                        <input type="text" placeholder="请输入课件名称" class="form-control" id="textstrAdmName" name="textstrAdmName" maxlength="50" autocomplete="off">
                        <span class="input-group-btn"><button type="button" class="btn btn-primary" id="searchbtn">搜索</button></span>
                    </div>
                </div>
            </div>
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
                    <tbody>
                    <?php
                    if(isset($sessionListData)) {
                        $flag = 0;
                        for($i=0; $i<=20; $i++) {
                            if(isset($sessionListData['count']) && $i<$sessionListData['count']){
                                if(isset($sessionListData['dataList']) && !empty($sessionListData['dataList'])) {
                                    foreach($sessionListData['dataList'] as $datak=>$dataInfo) {
                                        $i++;
                                        ?>
                                        <tr>
                                            <td>
                                            </td>
                                            <td align="center">
                                                <div class="gridlist" title="<?=isset($dataInfo['id']) ? $dataInfo['id'] : ""?>">
                                                    <?=isset($dataInfo['id']) ? $dataInfo['id'] : ""?>
                                                </div>

                                            </td>
                                            <td>
                                                <div class="gridlist" title="<?=isset($dataInfo['title']) ? $dataInfo['title'] : ""?>">
                                                    <?=isset($dataInfo['title']) ? $dataInfo['title'] : ""?>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="gridlist" title="<?=isset($dataInfo['format']) ? $dataInfo['format'] : ""?>">
                                                    <?=isset($dataInfo['format']) ? $dataInfo['format'] : ""?>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="gridlist" title="<?=isset($dataInfo['size']) ? $dataInfo['size'] : ""?>">
                                                    <?=isset($dataInfo['size']) ? $dataInfo['size'] : ""?>
                                                </div>
                                            </td>
                                            <td align="center">
                                                <div class="gridlist" title="已通过">

                                                    已通过
                                                </div>
                                            </td>
                                            <td class="buttonList">
                                                <div class="btn-group">
                                                    <div data-toggle="dropdown" class="btn btn-warning btn-sm dropdown-toggle">操作 <span class="caret"></span></div>
                                                    <ul class="dropdown-menu" id="<?=isset($dataInfo['uuid']) ? $dataInfo['uuid'] : ""?>" data-pk='{"strGuid":"<?=isset($dataInfo['uuid']) ? $dataInfo['uuid'] : ""?>"}'>
                                                        <li><a class="viewBtn" style="display: inline-block;" title="查看">查看</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                }
                            }else {

                                ?>
                                <tr>
                                    <td>
                                    </td>
                                    <td align="center">
                                        <div class="gridlist"></div>
                                    </td>
                                    <td>
                                        <div class="gridlist"></div>
                                    </td>
                                    <td>
                                        <div class="gridlist"></div>
                                    </td>
                                    <td>
                                        <div class="gridlist"></div>
                                    </td>
                                    <td align="center">
                                        <div class="gridlist"></div>
                                    </td>
                                    <td class="buttonList">
                                        <div class="btn-group"></div>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
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
                                <td class="buttonList"></td>
                            </tr>
                        <?php
                        }
                    }
                    ?>
                    </tbody>
                </table>
                <input type="hidden" id="total" value="1">
                <input type="hidden" id="hasnext" value="">
                <input type="hidden" id="nowpage" value="1">
                <input type="hidden" id="dataCnt" value="<?=isset($sessionListData['count']) ? $sessionListData['count'] : ""?>">
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
                        <span id="datanum"><?=isset($sessionListData['count']) ? $sessionListData['count'] : ""?></span> 条
                        <span id="currentpage" style="display:none;">1</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="application/javascript">
    layui.use(['form', 'table', 'laypage', 'layer'], function(){
        var laypage = layui.laypage;
        var form = layui.form
            ,element = layui.element;
        var storage=window.localStorage;
        var table = layui.table;
        var userData = storage.getItem("userData");
        var headerParams = JSON.parse(userData);
        //监听提交
        var params = {};
        var selfUrl = window.location.href;
        var page = GetUrlParam("p") ? GetUrlParam("p") : 1;
        var size = GetUrlParam("size") ? GetUrlParam("size") : 10;
        params.p=page;
        params.size = size;
        params.count = 0;
        form.on('submit(commit)', function(data){
            var paramsStr = "";
            $.each(data.field, function(i, item){
                selfUrl = changeURLArg(selfUrl,i,item);
            });
            selfUrl = changeURLArg(selfUrl,"p",1);
            location.href = selfUrl;
        });
        $.ajax({
            type: "post",
            url:"<?= Url::to(['common/course/get-list']); ?>",
            contentType: "application/json;charset=utf-8",
            data :JSON.stringify(params),
            dataType: "json",
            beforeSend: function (XMLHttpRequest) {
                for(var i in headerParams) {
                    XMLHttpRequest.setRequestHeader(i, headerParams[i]);
                }
            },
            success:function(result){
                params.count = result.data.count;
                if(result.code == 0) {
                    table.render({
                        elem: '#dataList'
                        ,id:"dataList"
                        ,data:result.data.dataList
                        ,cellMinWidth: 80 //全局定义常规单元格的最小宽度，layui 2.2.1 新增
                        ,cols: [[
                            {checkbox: true, fixed: true}
                            ,{field:'id', title: 'ID', width: 60}
                            ,{field:'title', title: '名称', minWidth: 120}
                            ,{field:'pic_url', title: '封面图片', minWidth: 100, height: 100,toolbar:"#Jimg"}
                            ,{field:'sort', title: '排序', width: 40}
                            ,{field:'status', title: '状态',toolbar:"#Jstatus", width: 60}
                            ,{field:'create_time', title: '创建时间', minWidth: 120}
                            ,{field:'course_type_title', title: '所属分类', minWidth: 120}
                            ,{field:'right', title: '操作', minWidth: 180,toolbar:"#barDemo"}
                        ]]
                        ,done: function(res, curr, count){
                            //自定义样式
                            laypage.render({
                                elem: 'page'
                                ,count: params.count
                                ,theme: '#1E9FFF'
                                ,curr: parseInt(page) || 1 //当前页
                                ,jump : function(obj, first){
                                    if(!first){ //一定要加此判断，否则初始时会无限刷新
                                        selfUrl = changeURLArg(selfUrl,'p',obj.curr);
                                        selfUrl = changeURLArg(selfUrl,'size',size);
                                        self.location = selfUrl;
                                    }
                                }
                            });
                            //如果是异步请求数据方式，res即为你接口返回的信息。
                            //如果是直接赋值的方式，res即为：{data: [], count: 99} data为当前页数据、count为数据总长度
                            console.log(res);

                            //得到当前页码
                            console.log(curr);

                            //得到数据总量
                            console.log(count);
                        }
                    })
                } else if(result.code == 5001) {
                    layer.msg(result.msg, {
                        icon: 2,
                        time: 2000 //2秒关闭（如果不配置，默认是3秒）
                    }, function(){
                        top.location.href="../user/login"
                    });
                }else {
                    layer.msg(result.msg, {icon: 2});
                }
            },
            error: function () {
                table.render({
                    elem: '#dataList',
                    id: "dataList",
                    limit: 0,
                    height: tableHeight,
                    size: 'sm',
                    data:[]
                })
            }
        });
        element.render();
    });
</script>