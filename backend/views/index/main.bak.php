<?php
use yii\helpers\Html;
?>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= Html::encode($title ? $title : (isset($this->title) ? $this->title : null)) ?></title>
<?= Html::cssFile('@web/static/main/jquery.orgchart.css?v=' . date("ymd"), ['rel' => "stylesheet"]) ?>
<?= Html::cssFile('@web/static/main/index.css?v=' . date("ymd"), ['rel' => "stylesheet"]) ?>
<?=Html::jsFile('@web/static/js/jquery-1.9.1.min.js?v='.date("ymd"), ['type' => "text/javascript"])?>
<?=Html::jsFile('@web/static//main/jquery.orgchart.js?v='.date("ymd"), ['type' => "text/javascript"])?>
<div id="chart-container"></div>
<script type="text/javascript">
$(function(){
    var datascource = {
        'title': '高质量发展指数结构解析','bg_color': 'color1',
        'children': [
            { 'title': '人口','bg_color': 'color1',
                'children': [
                    { 'title': '本地劳动力变化本地劳动力变化','bg_color': 'color1'},
                    { 'title': '年轻城市分布年轻城市分布','bg_color': 'color1'}
                ]
            },
            { 'title': '产业','bg_color': 'color2',
                'children': [
                    { 'title': '一月.月活跃度','bg_color': 'color2'},
                    { 'title': '二月.月活跃度','bg_color': 'color2',
                        'children': [
                            { 'title': '(4)GDP年预期','bg_color': 'color2'},
                            { 'title': '制造业集中度','bg_color': 'color2'}
                        ]
                    },
                    {'title':'三月.月活跃度','bg_color': 'color2'}
                ]
            },
            {   'title':"环保",'bg_color': 'color3',
                'children':[
                    { 'title': '事件预警','bg_color': 'color3'},
                    { 'title': '环境口碑年度','bg_color': 'color3'}
                ]
            },
            {
                'title':"稳定",'bg_color': 'color4',
                'children':[
                    { 'title': '事件预警','bg_color': 'color4'},
                    { 'title': '监测详情','bg_color': 'color4'},
                    { 'title': '维稳效果指数','bg_color': 'color4'}
                ]
            },
            {
                'title':"社会名声",'bg_color': 'color5',
                'children':[
                    { 'title': '医疗','bg_color': 'color5'},
                    { 'title': '教育','bg_color': 'color5',
                        'children':[
                            { 'title': '路网','bg_color': 'color5'},
                            { 'title': '房产居住获得感','bg_color': 'color5'}
                        ]
                    },
                    { 'title': '公交','bg_color': 'color5'}
                ]
            },
            {
                'title':"城市配套",'bg_color': 'color6',
                'children':[
                    { 'title': '交通建设','bg_color': 'color6'},
                    { 'title': '文化建设','bg_color': 'color6'},
                    { 'title': '生活服务','bg_color': 'color6'}
                ]
            },
        ]
    };

    $('#chart-container').orgchart({
        'data' : datascource,
        'nodeContent': 'title',
        'direction': 'l2r'
    });
    $(".title:not(':first')").each(function(){
        var tit = $(this).html();
        if(strlen(tit)>20){
            $(this).addClass("special_prouduct")
        }
    })
//判断字节长度
    function strlen(str){
        var len = 0;
        for (var i=0; i<str.length; i++) {
            var c = str.charCodeAt(i);
            //单字节加1
            if ((c >= 0x0001 && c <= 0x007e) || (0xff60<=c && c<=0xff9f)) {
                len++;
            }
            else {
                len+=2;
            }
        }
        return len;
    }
//绝对居中
    resize_view();
    function resize_view(){
        var ww = $(".orgchart").width();
        var wh = $(".orgchart").height();
        var f_height = $(".orgchart>table>tr>td> .node .title").height();
        $(".orgchart").css({
            "left":"15%",
            //"top":"50%",
            //"margin-left":-((wh/2)+(f_height/2)),
            //"margin-top":-(ww/2)
        })
        if(ww > 750){
            $(".orgchart").addClass("scale")
        }
    }

    $(window).resize(function(){
        resize_view();
    })
})
</script>