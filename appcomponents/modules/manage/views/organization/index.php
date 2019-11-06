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
                        <button id="addBtn" type="button" class="btn btn-info btn-sm addBtn" style="display: inline-block;" title="追加">
                            <span class="fa fa-plus" aria-hidden="true">&nbsp;&nbsp;追加<?=(isset($uuid) ? $uuid : "") ?></span>
                        </button>

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
                            <!-- <th width="100px">支部类型</th> -->
                            <th width="100px">审批状态</th>
                            <th width="90px">操作</th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                            <td>



                            </td>
                            <td align="center">

                                <div class="gridlist" title="1">
                                    1
                                </div>

                            </td>
                            <td>
                                <div class="gridlist" title="121212123">121212123</div>
                            </td>
                            <td>
                                <div class="gridlist" title=""></div>
                            </td>
                            <td>
                                <div class="gridlist" title="党总支">党总支</div>
                            </td>

                            <td align="center">
                                <div class="gridlist" title="已通过">

                                    已通过
                                </div>
                            </td>
                            <td class="buttonList">

                                <div class="btn-group">
                                    <div data-toggle="dropdown" class="btn btn-warning btn-sm dropdown-toggle">操作 <span class="caret"></span></div>
                                    <ul class="dropdown-menu" id="9b98b74dfa4545b89a0f9dd43c84b1a7" data-pk="{&quot;strGuid&quot;:&quot;9b98b74dfa4545b89a0f9dd43c84b1a7&quot;}">
                                        <li><a class="viewBtn" style="display: inline-block;" title="查看">查看</a></li>




                                    </ul>
                                </div>

                            </td>
                        </tr>

                        <tr>
                            <td>



                            </td>
                            <td align="center">

                                <div class="gridlist" title="2">
                                    2
                                </div>

                            </td>
                            <td>
                                <div class="gridlist" title="党小组三部">党小组三部</div>
                            </td>
                            <td>
                                <div class="gridlist" title=""></div>
                            </td>
                            <td>
                                <div class="gridlist" title="党支部">党支部</div>
                            </td>

                            <td align="center">
                                <div class="gridlist" title="已通过">

                                    已通过
                                </div>
                            </td>
                            <td class="buttonList">

                                <div class="btn-group">
                                    <div data-toggle="dropdown" class="btn btn-warning btn-sm dropdown-toggle">操作 <span class="caret"></span></div>
                                    <ul class="dropdown-menu" id="bb685d01dbfd4d5a9e1a9d1864ce602f" data-pk="{&quot;strGuid&quot;:&quot;bb685d01dbfd4d5a9e1a9d1864ce602f&quot;}">
                                        <li><a class="viewBtn" style="display: inline-block;" title="查看">查看</a></li>




                                    </ul>
                                </div>

                            </td>
                        </tr>

                        <tr>
                            <td>



                            </td>
                            <td align="center">

                                <div class="gridlist" title="3">
                                    3
                                </div>

                            </td>
                            <td>
                                <div class="gridlist" title="石门村金海组党组织">石门村金海组党组织</div>
                            </td>
                            <td>
                                <div class="gridlist" title="13807452991">13807452991</div>
                            </td>
                            <td>
                                <div class="gridlist" title=""></div>
                            </td>

                            <td align="center">
                                <div class="gridlist" title="已通过">

                                    已通过
                                </div>
                            </td>
                            <td class="buttonList">

                                <div class="btn-group">
                                    <div data-toggle="dropdown" class="btn btn-warning btn-sm dropdown-toggle">操作 <span class="caret"></span></div>
                                    <ul class="dropdown-menu" id="a2bbd0a4907f4e5da60384a2cf2ae8e6" data-pk="{&quot;strGuid&quot;:&quot;a2bbd0a4907f4e5da60384a2cf2ae8e6&quot;}">
                                        <li><a class="viewBtn" style="display: inline-block;" title="查看">查看</a></li>




                                    </ul>
                                </div>

                            </td>
                        </tr>

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

                            <td align="center">
                                <div class="gridlist" title="">


                                </div>
                            </td>
                            <td class="buttonList"></td>
                        </tr>

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

                            <td align="center">
                                <div class="gridlist" title="">


                                </div>
                            </td>
                            <td class="buttonList"></td>
                        </tr>

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

                            <td align="center">
                                <div class="gridlist" title="">


                                </div>
                            </td>
                            <td class="buttonList"></td>
                        </tr>

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

                            <td align="center">
                                <div class="gridlist" title="">


                                </div>
                            </td>
                            <td class="buttonList"></td>
                        </tr>

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

                            <td align="center">
                                <div class="gridlist" title="">


                                </div>
                            </td>
                            <td class="buttonList"></td>
                        </tr>

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

                            <td align="center">
                                <div class="gridlist" title="">


                                </div>
                            </td>
                            <td class="buttonList"></td>
                        </tr>

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

                            <td align="center">
                                <div class="gridlist" title="">


                                </div>
                            </td>
                            <td class="buttonList"></td>
                        </tr>

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

                            <td align="center">
                                <div class="gridlist" title="">


                                </div>
                            </td>
                            <td class="buttonList"></td>
                        </tr>

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

                            <td align="center">
                                <div class="gridlist" title="">


                                </div>
                            </td>
                            <td class="buttonList"></td>
                        </tr>

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

                            <td align="center">
                                <div class="gridlist" title="">


                                </div>
                            </td>
                            <td class="buttonList"></td>
                        </tr>

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

                            <td align="center">
                                <div class="gridlist" title="">


                                </div>
                            </td>
                            <td class="buttonList"></td>
                        </tr>

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

                            <td align="center">
                                <div class="gridlist" title="">


                                </div>
                            </td>
                            <td class="buttonList"></td>
                        </tr>

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

                            <td align="center">
                                <div class="gridlist" title="">


                                </div>
                            </td>
                            <td class="buttonList"></td>
                        </tr>

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

                            <td align="center">
                                <div class="gridlist" title="">


                                </div>
                            </td>
                            <td class="buttonList"></td>
                        </tr>

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

                            <td align="center">
                                <div class="gridlist" title="">


                                </div>
                            </td>
                            <td class="buttonList"></td>
                        </tr>

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

                            <td align="center">
                                <div class="gridlist" title="">


                                </div>
                            </td>
                            <td class="buttonList"></td>
                        </tr>

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

                            <td align="center">
                                <div class="gridlist" title="">


                                </div>
                            </td>
                            <td class="buttonList"></td>
                        </tr>

                        </tbody>
                    </table>
                    <input type="hidden" id="total" value="1">
                    <input type="hidden" id="hasnext" value="">
                    <input type="hidden" id="nowpage" value="1">
                    <input type="hidden" id="dataCnt" value="3">
                    <input type="hidden" id="dataCountLEN" value="20">
                </div>
                <!-- 分页  -->
                <div id="page" class="row"><div class="listpage listpagebox" clickflg="true"><div class="col-xs-7" style="text-align:right;"><span id="firstpage" style="padding:0 0.5rem;"><a style="color:#676a6c;" href="javascript:;"><span class="fa fa-step-backward"></span></a></span><span id="frontpage" style="padding:0 0.5rem;"><a style="color:#676a6c;" href="javascript:;"><span class="fa fa-backward"></span></a></span><span style="padding:0 0.5rem;"><input type="text" id="pagenum" maxlength="4" style="text-align:center;border:1px solid #e5e6e7;width: 4rem;"> 共 <span id="totalnum">1</span> 页</span><span id="nextpage" style="padding:0 0.5rem;"><a style="color:#676a6c;" href="javascript:;"><span class="fa fa-forward"></span></a></span><span id="lastpage" style="padding:0 0.5rem;"><a style="color:#676a6c;" href="javascript:;"><span class="fa fa-step-forward"></span></a></span></div><div class="col-xs-5" style="text-align:right;">每页<span id="len">20</span>条 共 <span id="datanum">3</span> 条 <span id="currentpage" style="display:none;">1</span></div></div></div>
            </div>
        </div>
    </div>
