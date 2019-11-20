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
                    <button id="isShowRevokeBtn" type="button" class="btn btn-info btn-sm isShowRevokeBtn" title="显示撤销">
                        <span id="isShowRevoke" class="fa fa-eye" aria-hidden="true">&nbsp;&nbsp;显示撤销</span>
                    </button>
                    <button id="freshBtn" type="button" class="btn btn-info btn-sm freshBtn" title="刷新">
                        <span class="fa fa-refresh" aria-hidden="true">&nbsp;&nbsp;刷新</span>
                    </button>
                    <?php
                    if(isset($menuUrl) && !empty($menuUrl) && in_array(trim(Url::to(['manage/news/add']),"/"), $menuUrl)) {
                        ?>
                        <button id="addBtn" type="button" class="btn btn-info btn-sm addBtn"
                                style="display: inline-block;" title="追加">
                                <span class="fa fa-plus"
                                      aria-hidden="true">&nbsp;&nbsp;追加<?= (isset($uuid) ? $uuid : "") ?></span>
                        </button>

                    <?php
                    }
                    ?>
                </div>
                <div class="col-sm-5">
                    <div class="input-group searchclick">
                        <input type="text" placeholder="请输入党组织名称" class="form-control" id="textstrAdmName" name="textstrAdmName" maxlength="50" autocomplete="off">
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
                        <th>党组织名称</th>
                        <th width="160px">电话号码</th>
                        <th width="100px">组织类型</th>
                        <!--                             <th width="100px">支部类型</th>-->
                        <th width="100px">审批状态</th>
                        <th width="90px">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(isset($organizationList)) {
                        $flag = 0;
                        for($i=0; $i<=20; $i++) {
                            if($i<$organizationList['count']){
                                if(isset($organizationList['dataList']) && !empty($organizationList['dataList'])) {
                                    foreach($organizationList['dataList'] as $datak=>$dataInfo) {
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
                                                <div class="gridlist" title="<?=isset($dataInfo['contacts']) ? $dataInfo['contacts'] : ""?>">
                                                    <?=isset($dataInfo['contacts']) ? $dataInfo['contacts'] : ""?>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="gridlist" title="<?=(isset($dataInfo['organization_type']) && isset($organizationTypeArr[$dataInfo['organization_type']])) ? $organizationTypeArr[$dataInfo['organization_type']] : ""?>">
                                                    <?=(isset($dataInfo['organization_type']) && isset($organizationTypeArr[$dataInfo['organization_type']])) ? $organizationTypeArr[$dataInfo['organization_type']] : ""?>
                                                </div>
                                            </td>
                                            <!--
    <td>
        <div class="gridlist" title="<?=(isset($dataInfo['branch_type']) && isset($branchTypeArr[$dataInfo['branch_type']])) ? $branchTypeArr[$dataInfo['branch_type']] : ""?>">
            <?=(isset($dataInfo['branch_type']) && isset($branchTypeArr[$dataInfo['branch_type']])) ? $branchTypeArr[$dataInfo['branch_type']] : ""?>
        </div>
    </td>-->
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
                            }
                            ?>
                            <tr>
                                <td>

                                </td>
                                <td align="center">

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
                                <!--    <td>-->
                                <!--        <div class="gridlist" title=""></div>-->
                                <!--    </td>-->

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
                <input type="hidden" id="dataCnt" value="<?=isset($organizationList['count']) ? $organizationList['count'] : ""?>">
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
                        <span id="datanum"><?=isset($organizationList['count']) ? $organizationList['count'] : ""?></span> 条
                        <span id="currentpage" style="display:none;">1</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
