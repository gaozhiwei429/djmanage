<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */
?>
<?=Html::cssFile('@web/static/plugs/layui/css/main.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
<?=Html::cssFile('@web/static/plugs/layui/css/form.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
<?=Html::cssFile('@web/static/plugs/layui/css/layer.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
<?=Html::cssFile('@web/static/plugs/layui/css/modules/laydate/default/laydate.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
<?=Html::cssFile('@web/static/plugs/layui/css/layui.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
<?=Html::cssFile('@web/static/theme/css/console.css?v='.date("ymd"), ['rel' => "stylesheet"])?>

<style>
.dis_flex {
    display: flex;
}
.search {
    background: white;
    display: flex;
    justify-content: space-between;
}
.rwo_space_around {
    display: flex;
    justify-content: space-around;
}
.row_space_between {
    display: flex;
    justify-content: space-between;
}
.row_row {
    display: flex;
    flex-direction: row;
}
.top_content {
    width: 80%;
    height: 100px;
    /*background: white;*/
    margin: 20px auto;
}
.portrait {
    display: flex;
    flex-direction: column;
}
.top_content_div{
    justify-content: center;
    align-items: center;
}
.top_content_div_title {
    margin-right: 10px;
}
.top_content_div_content {
    font-size: 38px;
    font-weight: 700;
}
.content {
    width: 80%;
    /*background: white;*/
    margin: 20px auto;
    flex-wrap: wrap;
    justify-content: space-around;
}
.content_title {
    font-size: 28px;
    text-align: center;
}
.content_detail {
    /*background: #0c64eb;*/
    color: #fff;
    /*margin: 0px auto;*/
}
.content_div {
    /*padding: 20px 14.5px;*/
    padding: 20px 15px;
    /*border-bottom: 1px solid #eee;*/
}
.current_content {
    /*width: 200px;*/
    width: 290px;
}
.current_content_title {
    color: #A6AAB8;;
    margin-top: 5px;
}
.current_content_content {
    color: #CBD0DB;
}
.current_content_div {
    font-size: 14px;
}
.current_time {
    display: flex;
    justify-content: center;
}
.current_year {
    position: relative;
    bottom: -2.5px;
}

.layui-input{
    height: 30px;
}

</style>
<div class="layui-card">
    <div class="layui-card-body gray-bg searchPage">
        <!--主体-->
<div class="admin-main layui-form">
    <div class="layui-field-box search">
        <form class="layui-form " action="/admin.php/datacount/meetinglist.html" method="get">
            <div class="layui-inline">
                <input type="text" name="date" placeholder="请选择时间" value="2019-01 - 2019-11" class="layui-input" style="width: 186px;" id="date" lay-key="1">
            </div>
            <div class="layui-inline">
                <select name="dep_id">
                    <option value="0" selected="">全部</option>
                    <option value="49"> 中心党委</option>
                    <option value="56">　&nbsp;&nbsp;&nbsp;├─  子部门</option>
                    <option value="50">　&nbsp;&nbsp;&nbsp;├─  第一党支部</option>
                    <option value="51">　&nbsp;&nbsp;&nbsp;└─  第二党支部</option>
                    <option value="2"> 集团党委</option>
                    <option value="3">　&nbsp;&nbsp;&nbsp;├─  机关党总支部</option>
                    <option value="10">　&nbsp;&nbsp;&nbsp;│ 　&nbsp;&nbsp;&nbsp;├─  机关第一党支部 【党委（学院）办公室】</option>
                    <option value="46">　&nbsp;&nbsp;&nbsp;│ 　&nbsp;&nbsp;&nbsp;│ 　&nbsp;&nbsp;&nbsp;└─  子部门</option>
                    <option value="47">　&nbsp;&nbsp;&nbsp;│ 　&nbsp;&nbsp;&nbsp;│ 　　&nbsp;&nbsp;&nbsp;└─  子子部门2</option>
                    <option value="11">　&nbsp;&nbsp;&nbsp;│ 　&nbsp;&nbsp;&nbsp;├─  机关第二党支部 （组织人事处）</option>
                    <option value="12">　&nbsp;&nbsp;&nbsp;│ 　&nbsp;&nbsp;&nbsp;├─  机关第三党支部 （纪检监察室、审计室、教学质量管理办公室）</option>
                    <option value="13">　&nbsp;&nbsp;&nbsp;│ 　&nbsp;&nbsp;&nbsp;├─  机关第四党支部（教务处、国际交流处）</option>
                    <option value="17">　&nbsp;&nbsp;&nbsp;│ 　&nbsp;&nbsp;&nbsp;├─  机关第五党支部（学生工作处、团委）</option>
                    <option value="18">　&nbsp;&nbsp;&nbsp;│ 　&nbsp;&nbsp;&nbsp;├─  机关第六党支部 （招生就业处）</option>
                    <option value="19">　&nbsp;&nbsp;&nbsp;│ 　&nbsp;&nbsp;&nbsp;├─  机关第七党支部 （后勤管理处、资产管理处）</option>
                    <option value="20">　&nbsp;&nbsp;&nbsp;│ 　&nbsp;&nbsp;&nbsp;├─  机关第八党支部 （财务处）</option>
                    <option value="21">　&nbsp;&nbsp;&nbsp;│ 　&nbsp;&nbsp;&nbsp;├─  机关第九党支部（科研处）</option>
                    <option value="22">　&nbsp;&nbsp;&nbsp;│ 　&nbsp;&nbsp;&nbsp;├─  机关第十党支部  （工会，明秀开发办、退休老干部）</option>
                    <option value="23">　&nbsp;&nbsp;&nbsp;│ 　&nbsp;&nbsp;&nbsp;├─  机关第十一党支部（继续教育中心）</option>
                    <option value="24">　&nbsp;&nbsp;&nbsp;│ 　&nbsp;&nbsp;&nbsp;├─  机关第十二党支部（图书馆）</option>
                    <option value="25">　&nbsp;&nbsp;&nbsp;│ 　&nbsp;&nbsp;&nbsp;├─  机关第十三党支部（信息网络管理中心）</option>
                    <option value="26">　&nbsp;&nbsp;&nbsp;│ 　&nbsp;&nbsp;&nbsp;├─  公共基础教学部党支部</option>
                    <option value="27">　&nbsp;&nbsp;&nbsp;│ 　&nbsp;&nbsp;&nbsp;└─  社会科学教学部党支部</option>
                    <option value="1">　&nbsp;&nbsp;&nbsp;├─  国际贸易系党总支部</option>
                    <option value="14">　&nbsp;&nbsp;&nbsp;│ 　&nbsp;&nbsp;&nbsp;├─  教工党支部</option>
                    <option value="15">　&nbsp;&nbsp;&nbsp;│ 　&nbsp;&nbsp;&nbsp;└─  学生党支部</option>
                    <option value="9">　&nbsp;&nbsp;&nbsp;├─  金融系党总支部</option>
                    <option value="38">　&nbsp;&nbsp;&nbsp;│ 　&nbsp;&nbsp;&nbsp;└─  党支部</option>
                    <option value="4">　&nbsp;&nbsp;&nbsp;├─  应用外语系党总支部</option>
                    <option value="28">　&nbsp;&nbsp;&nbsp;│ 　&nbsp;&nbsp;&nbsp;├─  教工党支部</option>
                    <option value="29">　&nbsp;&nbsp;&nbsp;│ 　&nbsp;&nbsp;&nbsp;└─  学生党支部</option>
                    <option value="5">　&nbsp;&nbsp;&nbsp;├─  会计系党总支部</option>
                    <option value="30">　&nbsp;&nbsp;&nbsp;│ 　&nbsp;&nbsp;&nbsp;├─  教工党支部</option>
                    <option value="31">　&nbsp;&nbsp;&nbsp;│ 　&nbsp;&nbsp;&nbsp;└─  学生党支部</option>
                    <option value="6">　&nbsp;&nbsp;&nbsp;├─  市场流通系党总支部</option>
                    <option value="32">　&nbsp;&nbsp;&nbsp;│ 　&nbsp;&nbsp;&nbsp;├─  教工党支部</option>
                    <option value="33">　&nbsp;&nbsp;&nbsp;│ 　&nbsp;&nbsp;&nbsp;└─  学生党支部</option>
                    <option value="7">　&nbsp;&nbsp;&nbsp;├─  旅游管理系党总支部</option>
                    <option value="34">　&nbsp;&nbsp;&nbsp;│ 　&nbsp;&nbsp;&nbsp;├─  教工党支部</option>
                    <option value="35">　&nbsp;&nbsp;&nbsp;│ 　&nbsp;&nbsp;&nbsp;└─  学生党支部</option>
                    <option value="8">　&nbsp;&nbsp;&nbsp;└─  信息工程系党总支部</option>
                    <option value="36">　　&nbsp;&nbsp;&nbsp;├─  教工党支部</option>
                    <option value="37">　　&nbsp;&nbsp;&nbsp;└─  学生党支部</option>
                    <option value="45"> 党委</option>
                    <option value="48"> 党委1</option>
                </select><div class="layui-unselect layui-form-select"><div class="layui-select-title"><input type="text" placeholder="请选择" value="全部" readonly="" class="layui-input layui-unselect"><i class="layui-edge"></i></div><dl class="layui-anim layui-anim-upbit"><dd lay-value="0" class="layui-this">全部</dd><dd lay-value="49" class=""> 中心党委</dd><dd lay-value="56" class="">　&nbsp;&nbsp;&nbsp;├─  子部门</dd><dd lay-value="50" class="">　&nbsp;&nbsp;&nbsp;├─  第一党支部</dd><dd lay-value="51" class="">　&nbsp;&nbsp;&nbsp;└─  第二党支部</dd><dd lay-value="2" class=""> 集团党委</dd><dd lay-value="3" class="">　&nbsp;&nbsp;&nbsp;├─  机关党总支部</dd><dd lay-value="10" class="">　&nbsp;&nbsp;&nbsp;│ 　&nbsp;&nbsp;&nbsp;├─  机关第一党支部 【党委（学院）办公室】</dd><dd lay-value="46" class="">　&nbsp;&nbsp;&nbsp;│ 　&nbsp;&nbsp;&nbsp;│ 　&nbsp;&nbsp;&nbsp;└─  子部门</dd><dd lay-value="47" class="">　&nbsp;&nbsp;&nbsp;│ 　&nbsp;&nbsp;&nbsp;│ 　　&nbsp;&nbsp;&nbsp;└─  子子部门2</dd><dd lay-value="11" class="">　&nbsp;&nbsp;&nbsp;│ 　&nbsp;&nbsp;&nbsp;├─  机关第二党支部 （组织人事处）</dd><dd lay-value="12" class="">　&nbsp;&nbsp;&nbsp;│ 　&nbsp;&nbsp;&nbsp;├─  机关第三党支部 （纪检监察室、审计室、教学质量管理办公室）</dd><dd lay-value="13" class="">　&nbsp;&nbsp;&nbsp;│ 　&nbsp;&nbsp;&nbsp;├─  机关第四党支部（教务处、国际交流处）</dd><dd lay-value="17" class="">　&nbsp;&nbsp;&nbsp;│ 　&nbsp;&nbsp;&nbsp;├─  机关第五党支部（学生工作处、团委）</dd><dd lay-value="18" class="">　&nbsp;&nbsp;&nbsp;│ 　&nbsp;&nbsp;&nbsp;├─  机关第六党支部 （招生就业处）</dd><dd lay-value="19" class="">　&nbsp;&nbsp;&nbsp;│ 　&nbsp;&nbsp;&nbsp;├─  机关第七党支部 （后勤管理处、资产管理处）</dd><dd lay-value="20" class="">　&nbsp;&nbsp;&nbsp;│ 　&nbsp;&nbsp;&nbsp;├─  机关第八党支部 （财务处）</dd><dd lay-value="21" class="">　&nbsp;&nbsp;&nbsp;│ 　&nbsp;&nbsp;&nbsp;├─  机关第九党支部（科研处）</dd><dd lay-value="22" class="">　&nbsp;&nbsp;&nbsp;│ 　&nbsp;&nbsp;&nbsp;├─  机关第十党支部  （工会，明秀开发办、退休老干部）</dd><dd lay-value="23" class="">　&nbsp;&nbsp;&nbsp;│ 　&nbsp;&nbsp;&nbsp;├─  机关第十一党支部（继续教育中心）</dd><dd lay-value="24" class="">　&nbsp;&nbsp;&nbsp;│ 　&nbsp;&nbsp;&nbsp;├─  机关第十二党支部（图书馆）</dd><dd lay-value="25" class="">　&nbsp;&nbsp;&nbsp;│ 　&nbsp;&nbsp;&nbsp;├─  机关第十三党支部（信息网络管理中心）</dd><dd lay-value="26" class="">　&nbsp;&nbsp;&nbsp;│ 　&nbsp;&nbsp;&nbsp;├─  公共基础教学部党支部</dd><dd lay-value="27" class="">　&nbsp;&nbsp;&nbsp;│ 　&nbsp;&nbsp;&nbsp;└─  社会科学教学部党支部</dd><dd lay-value="1" class="">　&nbsp;&nbsp;&nbsp;├─  国际贸易系党总支部</dd><dd lay-value="14" class="">　&nbsp;&nbsp;&nbsp;│ 　&nbsp;&nbsp;&nbsp;├─  教工党支部</dd><dd lay-value="15" class="">　&nbsp;&nbsp;&nbsp;│ 　&nbsp;&nbsp;&nbsp;└─  学生党支部</dd><dd lay-value="9" class="">　&nbsp;&nbsp;&nbsp;├─  金融系党总支部</dd><dd lay-value="38" class="">　&nbsp;&nbsp;&nbsp;│ 　&nbsp;&nbsp;&nbsp;└─  党支部</dd><dd lay-value="4" class="">　&nbsp;&nbsp;&nbsp;├─  应用外语系党总支部</dd><dd lay-value="28" class="">　&nbsp;&nbsp;&nbsp;│ 　&nbsp;&nbsp;&nbsp;├─  教工党支部</dd><dd lay-value="29" class="">　&nbsp;&nbsp;&nbsp;│ 　&nbsp;&nbsp;&nbsp;└─  学生党支部</dd><dd lay-value="5" class="">　&nbsp;&nbsp;&nbsp;├─  会计系党总支部</dd><dd lay-value="30" class="">　&nbsp;&nbsp;&nbsp;│ 　&nbsp;&nbsp;&nbsp;├─  教工党支部</dd><dd lay-value="31" class="">　&nbsp;&nbsp;&nbsp;│ 　&nbsp;&nbsp;&nbsp;└─  学生党支部</dd><dd lay-value="6" class="">　&nbsp;&nbsp;&nbsp;├─  市场流通系党总支部</dd><dd lay-value="32" class="">　&nbsp;&nbsp;&nbsp;│ 　&nbsp;&nbsp;&nbsp;├─  教工党支部</dd><dd lay-value="33" class="">　&nbsp;&nbsp;&nbsp;│ 　&nbsp;&nbsp;&nbsp;└─  学生党支部</dd><dd lay-value="7" class="">　&nbsp;&nbsp;&nbsp;├─  旅游管理系党总支部</dd><dd lay-value="34" class="">　&nbsp;&nbsp;&nbsp;│ 　&nbsp;&nbsp;&nbsp;├─  教工党支部</dd><dd lay-value="35" class="">　&nbsp;&nbsp;&nbsp;│ 　&nbsp;&nbsp;&nbsp;└─  学生党支部</dd><dd lay-value="8" class="">　&nbsp;&nbsp;&nbsp;└─  信息工程系党总支部</dd><dd lay-value="36" class="">　　&nbsp;&nbsp;&nbsp;├─  教工党支部</dd><dd lay-value="37" class="">　　&nbsp;&nbsp;&nbsp;└─  学生党支部</dd><dd lay-value="45" class=""> 党委</dd><dd lay-value="48" class=""> 党委1</dd></dl></div>
            </div>
            <!--<div class="layui-inline">
                <select name="cat_id">
                                        </select>
            </div>-->
            <button id="search_btn " class="layui-btn layui-btn-sm" data-type="reload">搜索</button>
        </form>
        <a href="javascript:;" id="export" class="layui-btn layui-btn-sm">导出Excel</a>
    </div>
    <div class="rwo_space_around top_content">
        <div class="dis_flex top_content_div">
            <text class="top_content_div_title">会议总数:</text>
            <text class="top_content_div_content">28</text>
        </div>
        <div class="dis_flex top_content_div">
            <text class="top_content_div_title">实到人数:</text>
            <text class="top_content_div_content">5</text>
        </div>
        <div class="dis_flex top_content_div">
            <text class="top_content_div_title">缺席人数:</text>
            <text class="top_content_div_content">894</text>
        </div>
        <div class="dis_flex top_content_div">
            <text class="top_content_div_title">请假人数:</text>
            <text class="top_content_div_content">3</text>
        </div>
    </div>
    <div class="portrait content">
        <div class="rwo_space_around content_div">
            <text class="content_title">
                <!-- <text class="current_content_div current_content_title" style="opacity:0;">2019</text> -->
                11月
                <text class="current_year current_content_div current_content_title" style="">2019</text>
            </text>
            <!-- <div class="content_detail">
                <text>查看详细</text>
            </div> -->
            <a href="/admin.php/datacount/meeting_month/time/2019-11/dep_id/0/meeting_type/2.html" class="layui-btn layui-btn-radius layui-btn-normal content_detail">查看详情</a>
            <!-- <div class="row_space_between current_content"> -->
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">会议总数</text>
                <text class="current_content_content">5</text>
            </div>
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">实到人数</text>
                <text class="current_content_content">0</text>
            </div>
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">缺席人数</text>
                <text class="current_content_content">0</text>
            </div>
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">请假人数</text>
                <text class="current_content_content">0</text>
            </div>
            <!-- </div> -->
            <!-- <div class="row_space_between current_content" style="border-top: 1px solid #ddd;margin-top: 3px;padding-top: 3px;"> -->
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">支部党员大会</text>
                <text class="current_content_content">1</text>
            </div>
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">支部委员会</text>
                <text class="current_content_content">1</text>
            </div>
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">党小组会</text>
                <text class="current_content_content">1</text>
            </div>
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">党课</text>
                <text class="current_content_content">2</text>
            </div>
            <!-- </div> -->
        </div>
        <div class="rwo_space_around content_div">
            <text class="content_title">
                <!-- <text class="current_content_div current_content_title" style="opacity:0;">2019</text> -->
                10月
                <text class="current_year current_content_div current_content_title" style="">2019</text>
            </text>
            <!-- <div class="content_detail">
                <text>查看详细</text>
            </div> -->
            <a href="/admin.php/datacount/meeting_month/time/2019-10/dep_id/0/meeting_type/2.html" class="layui-btn layui-btn-radius layui-btn-normal content_detail">查看详情</a>
            <!-- <div class="row_space_between current_content"> -->
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">会议总数</text>
                <text class="current_content_content">3</text>
            </div>
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">实到人数</text>
                <text class="current_content_content">0</text>
            </div>
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">缺席人数</text>
                <text class="current_content_content">0</text>
            </div>
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">请假人数</text>
                <text class="current_content_content">0</text>
            </div>
            <!-- </div> -->
            <!-- <div class="row_space_between current_content" style="border-top: 1px solid #ddd;margin-top: 3px;padding-top: 3px;"> -->
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">支部党员大会</text>
                <text class="current_content_content">1</text>
            </div>
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">支部委员会</text>
                <text class="current_content_content">0</text>
            </div>
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">党小组会</text>
                <text class="current_content_content">1</text>
            </div>
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">党课</text>
                <text class="current_content_content">1</text>
            </div>
            <!-- </div> -->
        </div>
        <div class="rwo_space_around content_div">
            <text class="content_title">
                <!-- <text class="current_content_div current_content_title" style="opacity:0;">2019</text> -->
                9月
                <text class="current_year current_content_div current_content_title" style="">2019</text>
            </text>
            <!-- <div class="content_detail">
                <text>查看详细</text>
            </div> -->
            <a href="/admin.php/datacount/meeting_month/time/2019-09/dep_id/0/meeting_type/2.html" class="layui-btn layui-btn-radius layui-btn-normal content_detail">查看详情</a>
            <!-- <div class="row_space_between current_content"> -->
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">会议总数</text>
                <text class="current_content_content">4</text>
            </div>
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">实到人数</text>
                <text class="current_content_content">0</text>
            </div>
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">缺席人数</text>
                <text class="current_content_content">0</text>
            </div>
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">请假人数</text>
                <text class="current_content_content">0</text>
            </div>
            <!-- </div> -->
            <!-- <div class="row_space_between current_content" style="border-top: 1px solid #ddd;margin-top: 3px;padding-top: 3px;"> -->
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">支部党员大会</text>
                <text class="current_content_content">4</text>
            </div>
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">支部委员会</text>
                <text class="current_content_content">0</text>
            </div>
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">党小组会</text>
                <text class="current_content_content">0</text>
            </div>
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">党课</text>
                <text class="current_content_content">0</text>
            </div>
            <!-- </div> -->
        </div>
        <div class="rwo_space_around content_div">
            <text class="content_title">
                <!-- <text class="current_content_div current_content_title" style="opacity:0;">2019</text> -->
                8月
                <text class="current_year current_content_div current_content_title" style="">2019</text>
            </text>
            <!-- <div class="content_detail">
                <text>查看详细</text>
            </div> -->
            <a href="/admin.php/datacount/meeting_month/time/2019-08/dep_id/0/meeting_type/2.html" class="layui-btn layui-btn-radius layui-btn-normal content_detail">查看详情</a>
            <!-- <div class="row_space_between current_content"> -->
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">会议总数</text>
                <text class="current_content_content">1</text>
            </div>
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">实到人数</text>
                <text class="current_content_content">0</text>
            </div>
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">缺席人数</text>
                <text class="current_content_content">0</text>
            </div>
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">请假人数</text>
                <text class="current_content_content">0</text>
            </div>
            <!-- </div> -->
            <!-- <div class="row_space_between current_content" style="border-top: 1px solid #ddd;margin-top: 3px;padding-top: 3px;"> -->
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">支部党员大会</text>
                <text class="current_content_content">1</text>
            </div>
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">支部委员会</text>
                <text class="current_content_content">0</text>
            </div>
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">党小组会</text>
                <text class="current_content_content">0</text>
            </div>
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">党课</text>
                <text class="current_content_content">0</text>
            </div>
            <!-- </div> -->
        </div>
        <div class="rwo_space_around content_div">
            <text class="content_title">
                <!-- <text class="current_content_div current_content_title" style="opacity:0;">2019</text> -->
                7月
                <text class="current_year current_content_div current_content_title" style="">2019</text>
            </text>
            <!-- <div class="content_detail">
                <text>查看详细</text>
            </div> -->
            <a href="/admin.php/datacount/meeting_month/time/2019-07/dep_id/0/meeting_type/2.html" class="layui-btn layui-btn-radius layui-btn-normal content_detail">查看详情</a>
            <!-- <div class="row_space_between current_content"> -->
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">会议总数</text>
                <text class="current_content_content">0</text>
            </div>
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">实到人数</text>
                <text class="current_content_content">0</text>
            </div>
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">缺席人数</text>
                <text class="current_content_content">0</text>
            </div>
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">请假人数</text>
                <text class="current_content_content">0</text>
            </div>
            <!-- </div> -->
            <!-- <div class="row_space_between current_content" style="border-top: 1px solid #ddd;margin-top: 3px;padding-top: 3px;"> -->
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">支部党员大会</text>
                <text class="current_content_content">0</text>
            </div>
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">支部委员会</text>
                <text class="current_content_content">0</text>
            </div>
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">党小组会</text>
                <text class="current_content_content">0</text>
            </div>
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">党课</text>
                <text class="current_content_content">0</text>
            </div>
            <!-- </div> -->
        </div>
        <div class="rwo_space_around content_div">
            <text class="content_title">
                <!-- <text class="current_content_div current_content_title" style="opacity:0;">2019</text> -->
                6月
                <text class="current_year current_content_div current_content_title" style="">2019</text>
            </text>
            <!-- <div class="content_detail">
                <text>查看详细</text>
            </div> -->
            <a href="/admin.php/datacount/meeting_month/time/2019-06/dep_id/0/meeting_type/2.html" class="layui-btn layui-btn-radius layui-btn-normal content_detail">查看详情</a>
            <!-- <div class="row_space_between current_content"> -->
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">会议总数</text>
                <text class="current_content_content">15</text>
            </div>
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">实到人数</text>
                <text class="current_content_content">0</text>
            </div>
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">缺席人数</text>
                <text class="current_content_content">0</text>
            </div>
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">请假人数</text>
                <text class="current_content_content">0</text>
            </div>
            <!-- </div> -->
            <!-- <div class="row_space_between current_content" style="border-top: 1px solid #ddd;margin-top: 3px;padding-top: 3px;"> -->
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">支部党员大会</text>
                <text class="current_content_content">5</text>
            </div>
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">支部委员会</text>
                <text class="current_content_content">3</text>
            </div>
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">党小组会</text>
                <text class="current_content_content">3</text>
            </div>
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">党课</text>
                <text class="current_content_content">4</text>
            </div>
            <!-- </div> -->
        </div>
        <div class="rwo_space_around content_div">
            <text class="content_title">
                <!-- <text class="current_content_div current_content_title" style="opacity:0;">2019</text> -->
                5月
                <text class="current_year current_content_div current_content_title" style="">2019</text>
            </text>
            <!-- <div class="content_detail">
                <text>查看详细</text>
            </div> -->
            <a href="/admin.php/datacount/meeting_month/time/2019-05/dep_id/0/meeting_type/2.html" class="layui-btn layui-btn-radius layui-btn-normal content_detail">查看详情</a>
            <!-- <div class="row_space_between current_content"> -->
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">会议总数</text>
                <text class="current_content_content">0</text>
            </div>
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">实到人数</text>
                <text class="current_content_content">0</text>
            </div>
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">缺席人数</text>
                <text class="current_content_content">0</text>
            </div>
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">请假人数</text>
                <text class="current_content_content">0</text>
            </div>
            <!-- </div> -->
            <!-- <div class="row_space_between current_content" style="border-top: 1px solid #ddd;margin-top: 3px;padding-top: 3px;"> -->
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">支部党员大会</text>
                <text class="current_content_content">0</text>
            </div>
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">支部委员会</text>
                <text class="current_content_content">0</text>
            </div>
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">党小组会</text>
                <text class="current_content_content">0</text>
            </div>
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">党课</text>
                <text class="current_content_content">0</text>
            </div>
            <!-- </div> -->
        </div>
        <div class="rwo_space_around content_div">
            <text class="content_title">
                <!-- <text class="current_content_div current_content_title" style="opacity:0;">2019</text> -->
                4月
                <text class="current_year current_content_div current_content_title" style="">2019</text>
            </text>
            <!-- <div class="content_detail">
                <text>查看详细</text>
            </div> -->
            <a href="/admin.php/datacount/meeting_month/time/2019-04/dep_id/0/meeting_type/2.html" class="layui-btn layui-btn-radius layui-btn-normal content_detail">查看详情</a>
            <!-- <div class="row_space_between current_content"> -->
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">会议总数</text>
                <text class="current_content_content">0</text>
            </div>
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">实到人数</text>
                <text class="current_content_content">0</text>
            </div>
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">缺席人数</text>
                <text class="current_content_content">0</text>
            </div>
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">请假人数</text>
                <text class="current_content_content">0</text>
            </div>
            <!-- </div> -->
            <!-- <div class="row_space_between current_content" style="border-top: 1px solid #ddd;margin-top: 3px;padding-top: 3px;"> -->
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">支部党员大会</text>
                <text class="current_content_content">0</text>
            </div>
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">支部委员会</text>
                <text class="current_content_content">0</text>
            </div>
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">党小组会</text>
                <text class="current_content_content">0</text>
            </div>
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">党课</text>
                <text class="current_content_content">0</text>
            </div>
            <!-- </div> -->
        </div>
        <div class="rwo_space_around content_div">
            <text class="content_title">
                <!-- <text class="current_content_div current_content_title" style="opacity:0;">2019</text> -->
                3月
                <text class="current_year current_content_div current_content_title" style="">2019</text>
            </text>
            <!-- <div class="content_detail">
                <text>查看详细</text>
            </div> -->
            <a href="/admin.php/datacount/meeting_month/time/2019-03/dep_id/0/meeting_type/2.html" class="layui-btn layui-btn-radius layui-btn-normal content_detail">查看详情</a>
            <!-- <div class="row_space_between current_content"> -->
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">会议总数</text>
                <text class="current_content_content">0</text>
            </div>
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">实到人数</text>
                <text class="current_content_content">0</text>
            </div>
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">缺席人数</text>
                <text class="current_content_content">0</text>
            </div>
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">请假人数</text>
                <text class="current_content_content">0</text>
            </div>
            <!-- </div> -->
            <!-- <div class="row_space_between current_content" style="border-top: 1px solid #ddd;margin-top: 3px;padding-top: 3px;"> -->
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">支部党员大会</text>
                <text class="current_content_content">0</text>
            </div>
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">支部委员会</text>
                <text class="current_content_content">0</text>
            </div>
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">党小组会</text>
                <text class="current_content_content">0</text>
            </div>
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">党课</text>
                <text class="current_content_content">0</text>
            </div>
            <!-- </div> -->
        </div>
        <div class="rwo_space_around content_div">
            <text class="content_title">
                <!-- <text class="current_content_div current_content_title" style="opacity:0;">2019</text> -->
                2月
                <text class="current_year current_content_div current_content_title" style="">2019</text>
            </text>
            <!-- <div class="content_detail">
                <text>查看详细</text>
            </div> -->
            <a href="/admin.php/datacount/meeting_month/time/2019-02/dep_id/0/meeting_type/2.html" class="layui-btn layui-btn-radius layui-btn-normal content_detail">查看详情</a>
            <!-- <div class="row_space_between current_content"> -->
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">会议总数</text>
                <text class="current_content_content">0</text>
            </div>
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">实到人数</text>
                <text class="current_content_content">0</text>
            </div>
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">缺席人数</text>
                <text class="current_content_content">0</text>
            </div>
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">请假人数</text>
                <text class="current_content_content">0</text>
            </div>
            <!-- </div> -->
            <!-- <div class="row_space_between current_content" style="border-top: 1px solid #ddd;margin-top: 3px;padding-top: 3px;"> -->
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">支部党员大会</text>
                <text class="current_content_content">0</text>
            </div>
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">支部委员会</text>
                <text class="current_content_content">0</text>
            </div>
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">党小组会</text>
                <text class="current_content_content">0</text>
            </div>
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">党课</text>
                <text class="current_content_content">0</text>
            </div>
            <!-- </div> -->
        </div>
        <div class="rwo_space_around content_div">
            <text class="content_title">
                <!-- <text class="current_content_div current_content_title" style="opacity:0;">2019</text> -->
                1月
                <text class="current_year current_content_div current_content_title" style="">2019</text>
            </text>
            <!-- <div class="content_detail">
                <text>查看详细</text>
            </div> -->
            <a href="/admin.php/datacount/meeting_month/time/2019-01/dep_id/0/meeting_type/2.html" class="layui-btn layui-btn-radius layui-btn-normal content_detail">查看详情</a>
            <!-- <div class="row_space_between current_content"> -->
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">会议总数</text>
                <text class="current_content_content">0</text>
            </div>
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">实到人数</text>
                <text class="current_content_content">0</text>
            </div>
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">缺席人数</text>
                <text class="current_content_content">0</text>
            </div>
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">请假人数</text>
                <text class="current_content_content">0</text>
            </div>
            <!-- </div> -->
            <!-- <div class="row_space_between current_content" style="border-top: 1px solid #ddd;margin-top: 3px;padding-top: 3px;"> -->
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">支部党员大会</text>
                <text class="current_content_content">0</text>
            </div>
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">支部委员会</text>
                <text class="current_content_content">0</text>
            </div>
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">党小组会</text>
                <text class="current_content_content">0</text>
            </div>
            <div class="portrait top_content_div current_content_div">
                <text class="current_content_title">党课</text>
                <text class="current_content_content">0</text>
            </div>
            <!-- </div> -->
        </div>
    </div>
</div>
    </div>
</div>
<?=Html::jsFile('@web/static/dangjian/js/delelement.js?v='.date("ymd"), ['type' => "text/javascript"])?>
<script type="application/javascript">
    var params = {};
    var page = GetUrlParam("p") ? GetUrlParam("p") : 1;
    var size = GetUrlParam("size") ? GetUrlParam("size") : 10;
    var title = GetUrlParam("title") ? GetUrlParam("title") : "";
    params.p=page;
    params.size = size;
    params.count = 0;
    params.title = title;
    layui.use(['form', 'table', 'laypage', 'layer', 'element', 'jquery', 'laydate'], function(){
        var laypage = layui.laypage
            ,form = layui.form;
        var element = layui.element;
        var storage=window.localStorage;
        var table = layui.table
            ,jq = layui.jquery
            ,$ = layui.jquery;
        var userData = storage.getItem("userData");
        var headerParams = JSON.parse(userData);
        //监听提交
        var selfUrl = window.location.href;
        form.on('submit(commit)', function(data){
            getProjectList(data.field,1,-1,"dataList");
        });
        let tableData = getProjectList(params, 1,-1,"dataList");

        //设备参数
        function getProjectList(params,p,size,objectId="dataList") {
//    var params = {};
            params.p=p;
            params.size = size;
            params.count = 1000;
            $.ajax({
                type: "post",
                url:"<?= Url::to(['/common/organization/get-tree-data']); ?>",
                contentType: "application/json;charset=utf-8",
                data :JSON.stringify(params),
                dataType: "json",
                beforeSend: function (XMLHttpRequest) {
                    for(var i in headerParams) {
                        XMLHttpRequest.setRequestHeader(i, headerParams[i]);
                    }
                },
                success:function(result){
                    if(result.code == 0) {
                        layer.msg(result.msg, {
                            icon: 1,
                            time: 2000 //2秒关闭（如果不配置，默认是3秒）
                        }, function(){
                            table.render({
                                elem: '#'+objectId
                                ,id:objectId
                                ,data:result.data
                                , limit: result.data.length//显示的数量
                                ,cellMinWidth: 80 //全局定义常规单元格的最小宽度，layui 2.2.1 新增
//                    ,cellMinHeight: 80
                                ,cols: [[
                                    {checkbox: true, fixed: true, width: 30}
                                    ,{field:'id', title: 'ID', width: 30}
                                    ,{field:'title', title: '党组织名称', minWidth: 100, toolbar:"#Jtitle"}
                                    ,{field:'status', title: '状态', width: 80, toolbar:"#Jstatus"}//,toolbar:"#Jstatus"
                                    ,{field:'sort', title: '排序',"type":"text","edit":"text","width":100}
                                    ,{field:'right', title: '操作', minWidth: 120,toolbar:"#barDemo"}
                                ]]
                                ,done: function(res, curr, count){
                                }
                            })
                        });
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
                        elem: '#'+objectId,
                        id:objectId,
                        limit: 0,
                        height: tableHeight,
                        size: 'sm',
                        data:[]
                    })
                }
            });
        }
        table.render(tableData);

        //监听单元格编辑
        table.on('edit(text)', function(obj){ //注：edit是固定事件名，test是table原始容器的属性 lay-filter="对应的值"
            var params = {};
            params.uuid = obj.data.uuid;
            params.sort = obj.data.sort;
            $.ajax({
                type: "post",
                url: "<?= Url::to(['common/organization/set-sort']); ?>",
                contentType: "application/json;charset=utf-8",
                data: JSON.stringify(params),
                dataType: "json",
                beforeSend: function (XMLHttpRequest) {
                    for (var i in headerParams) {
                        XMLHttpRequest.setRequestHeader(i, headerParams[i]);
                    }
                },
                success: function (result) {
                    if (result.code == 0) {
                        layer.msg(result.msg, {
                            time: 2000,
                            shade: 0.6
                        });
                        return true;
                    } else if(result.code == 5001){
                        layer.msg(result.msg, {
                            icon: 2,
                            shade: 0.6,
                            time: 2000 //2秒关闭（如果不配置，默认是3秒）
                        }, function(){
                            top.location.href="../user/login"
                        });
                        return true;
                    } else {
                        layer.msg(result.msg, {
                            time: 2000,
                            shade: 0.6,
                            icon: 2
                        });
                        return true;
                    }
                },
                error: function () {
                    layer.msg("系统异常", {
                        time: 2000,
                        shade: 0.6,
                        icon: 2
                    });
                    return true;
                }
            })
        });
        //监听状态的操作
        form.on('switch(status)', function(obj){
            var params = {};
            var status = obj.elem.checked ? 1 : 0;
            var id = obj.elem.value;
            if(id) {
                params.uuid=id;
            }
            params.status=status;
            $.ajax({
                type: "post",
                url: "<?= Url::to(['common/organization/set-status']); ?>",
                contentType: "application/json;charset=utf-8",
                data: JSON.stringify(params),
                dataType: "json",
                beforeSend: function (XMLHttpRequest) {
                    for (var i in headerParams) {
                        XMLHttpRequest.setRequestHeader(i, headerParams[i]);
                    }
                },
                success: function (result) {
                    if (result.code == 0) {
                        layer.msg(result.msg, {
                            time: 2000,
                            shade: 0.6
                        });
                        return true;
                    } else if(result.code == 5001){
                        layer.msg(result.msg, {
                            icon: 2,
                            shade: 0.6,
                            time: 2000 //2秒关闭（如果不配置，默认是3秒）
                        }, function(){
                            top.location.href="../user/login"
                        });
                        return true;
                    } else {
                        layer.msg(result.msg, {
                            time: 2000,
                            shade: 0.6,
                            icon: 2
                        });
                        return true;
                    }
                },
                error: function () {
                    layer.msg("系统异常", {
                        time: 2000,
                        shade: 0.6,
                        icon: 2
                    });
                    return true;
                }
            })
        });
        form.render(); //更新全部，防止input多选和单选框不显示问题
    })
</script>