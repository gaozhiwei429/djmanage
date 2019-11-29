<!DOCTYPE html>
<html><head>
    <meta charset="UTF-8">
    <title>智慧党建系统后台管理</title>
    <link rel="stylesheet" href="http://h5dangjian.orangelite.cn/plugins/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="http://h5dangjian.orangelite.cn/css/main.css" media="all">

    
<style>
    html,body{
        height:100%;
    }
    body>div{
        height:100%;
        margin-bottom:0 !important;
    }
    .flex{
        display:flex;
    }
    .flex-col{
        flex-direction: column;
        height:100%;
        /*flex:1;*/
    }
    .flex-row{
        flex-direction: column;
        height:100%;
    }
    .flex-full-height{
        height:100%;
        flex:1;
    }
    .flex-center{
        justify-content: center;
        align-items: center;
        height:100%;
    }
    /*.flex-div-col{*/
        /*display:flex;*/
        /*flex-direction: row;*/
        /*height:100%;*/
    /*}*/
    .text-center{
        text-align: center;
    }
</style>


    <!--[if lt IE 9]>
    <script src="__CSS__/html5shiv.min.js"></script>
    <script src="__CSS__/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="http://h5dangjian.orangelite.cn/plugins/layui/layui.js"></script>
<link id="layuicss-layer" rel="stylesheet" href="http://h5dangjian.orangelite.cn/plugins/layui/css/modules/layer/default/layer.css?v=3.1.1" media="all"></head>
<body>

<!--主体-->
<div style="margin-bottom:0px;">
    
<div class="layui-fluid flex flex-col flex-full-height">
    <!--头部-->
    <div class="layui-row layui-col-space15 flex" style="height:100px;">
        <div class="layui-row layui-col-sm8">
            <div class="layui-col-sm6 flex flex-center"><img src="/assets/image/party_count.png" alt="" width="14" height="14">党员&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#FF6508"><span style="font-size:30px;">24</span>人</span></div>
            <div class="layui-col-sm6 flex flex-center"><img src="/assets/image/department.png" alt="" width="14" height="14">组织&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#FF6508"><span style="font-size:30px;">45</span>个</span></div>
        </div>
        <div class="layui-col-sm4 flex-div-col">
            <div id="sex" class="flex flex-full-height" style="user-select: none; position: relative;" _echarts_instance_="ec_1574780393876"><div style="position: relative; overflow: hidden; width: 513px; height: 85px; padding: 0px; margin: 0px; border-width: 0px; cursor: default;"><canvas style="position: absolute; left: 0px; top: 0px; width: 513px; height: 85px; user-select: none; padding: 0px; margin: 0px; border-width: 0px;" data-zr-dom-id="zr_0" width="513" height="85"></canvas></div><div style="position: absolute; display: none; border-style: solid; white-space: nowrap; z-index: 9999999; transition: left 0.4s cubic-bezier(0.23, 1, 0.32, 1) 0s, top 0.4s cubic-bezier(0.23, 1, 0.32, 1) 0s; background-color: rgba(50, 50, 50, 0.7); border-width: 0px; border-color: rgb(51, 51, 51); border-radius: 4px; color: rgb(255, 255, 255); font: 14px/21px Microsoft YaHei; padding: 5px; left: 212.549px; top: 68.725px; pointer-events: none;">男<br><span style="display:inline-block;margin-right:5px;border-radius:10px;width:10px;height:10px;background-color:blue;"></span>31</div></div>
        </div>
    </div>
    <!--中部-->
    <div class="layui-row  flex flex-full-height">
        <div class="layui-col-sm4" id="xueli" style="user-select: none; position: relative;" _echarts_instance_="ec_1574780393878"><div style="position: relative; overflow: hidden; width: 523px; height: 340px; padding: 0px; margin: 0px; border-width: 0px; cursor: default;"><canvas style="position: absolute; left: 0px; top: 0px; width: 523px; height: 340px; user-select: none; padding: 0px; margin: 0px; border-width: 0px;" data-zr-dom-id="zr_0" width="523" height="340"></canvas></div><div></div></div>
        <div class="layui-col-sm4" id="jiguan" style="user-select: none; position: relative;" _echarts_instance_="ec_1574780393877"><div style="position: relative; overflow: hidden; width: 523px; height: 340px; padding: 0px; margin: 0px; border-width: 0px; cursor: default;"><canvas style="position: absolute; left: 0px; top: 0px; width: 523px; height: 340px; user-select: none; padding: 0px; margin: 0px; border-width: 0px;" data-zr-dom-id="zr_0" width="523" height="340"></canvas></div><div></div></div>
        <div class="layui-col-sm4" id="minzu" style="user-select: none; position: relative;" _echarts_instance_="ec_1574780393879"><div style="position: relative; overflow: hidden; width: 523px; height: 340px; padding: 0px; margin: 0px; border-width: 0px; cursor: default;"><canvas style="position: absolute; left: 0px; top: 0px; width: 523px; height: 340px; user-select: none; padding: 0px; margin: 0px; border-width: 0px;" data-zr-dom-id="zr_0" width="523" height="340"></canvas></div><div></div></div>
    </div>
    <!--底部-->
    <div class="layui-row flex flex-full-height">
        <div class="layui-col-sm6" id="dangling" style="user-select: none; position: relative;" _echarts_instance_="ec_1574780393881"><div style="position: relative; overflow: hidden; width: 785px; height: 339px; padding: 0px; margin: 0px; border-width: 0px; cursor: default;"><canvas style="position: absolute; left: 0px; top: 0px; width: 785px; height: 339px; user-select: none; padding: 0px; margin: 0px; border-width: 0px;" data-zr-dom-id="zr_0" width="785" height="339"></canvas></div><div></div></div>
        <div class="layui-col-sm6" id="nianling" style="user-select: none; position: relative;" _echarts_instance_="ec_1574780393880"><div style="position: relative; overflow: hidden; width: 785px; height: 339px; padding: 0px; margin: 0px; border-width: 0px; cursor: default;"><canvas style="position: absolute; left: 0px; top: 0px; width: 785px; height: 339px; user-select: none; padding: 0px; margin: 0px; border-width: 0px;" data-zr-dom-id="zr_0" width="785" height="339"></canvas></div><div style="position: absolute; display: none; border-style: solid; white-space: nowrap; z-index: 9999999; transition: left 0.4s cubic-bezier(0.23, 1, 0.32, 1) 0s, top 0.4s cubic-bezier(0.23, 1, 0.32, 1) 0s; background-color: rgba(50, 50, 50, 0.7); border-width: 0px; border-color: rgb(51, 51, 51); border-radius: 4px; color: rgb(255, 255, 255); font: 14px/21px Microsoft YaHei; padding: 5px; left: 462px; top: 187px; pointer-events: none;">单位：人<br><span style="display:inline-block;margin-right:5px;border-radius:10px;width:10px;height:10px;background-color:#3AA1FF;"></span>小于30岁: 18</div></div>
    </div>
</div>

</div>





<script src="http://h5dangjian.orangelite.cn/plugins/echarts-en.min.js"></script>
<script src="http://h5dangjian.orangelite.cn/plugins/china.js"></script>
<!--获取数据-->
<script>
    layui.use(['layer','jquery'],function(){
        let jq = layui.jquery;
        jq.post('http://h5dangjian.orangelite.cn/admin/datacount/getReportData',{},(res)=>{
            sex(res.sex.male,res.sex.female);
            jiguan(res.jiguan);
            xueli(res.xueli);
            minzu(res.minzu);
            age(res.age);
            join(res.join);
        });
    });
</script>
<!--男女比例-->
<script>


    function sex(male=0,female=0){
        let total = male+female;

        echarts.init(document.getElementById('sex')).setOption({
            title:{
                text:'男女比例',
                left:'center'
            },
            tooltip : {
                trigger: 'item',
                position:'bottom',
                axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                    type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
                }
            },
            grid: {
                bottom: '3%',
                containLabel: true
            },
            xAxis : {
                show: false,
                axisTick : {show: false},
            },
            yAxis : [
                {
                    show:false,//纵坐标显示
                    type : 'category',
//                position:'right',//纵向坐标显示位置 可选为：left | right
//                axisTick : {show: false},
//                splitArea : {show : true},
//                splitLine:{
//                    show:false//网格线不显示
//                },
//                data : ['周一']
                }
            ],
            color: ['blue','red'],
            series : [{
                name:'男',
                type:'bar',
                barWidth:'5',
                stack: '总量',
                label: {
                    show: true,
                    position:'insideBottomLeft',
                    formatter:'男('+(male/total*100).toFixed(2)+'%)',
//                    fontFamily:'serif'
                },
                data:[male]
            },
                {
                    name:'女',
                    type:'bar',
                    stack: '总量',
                    label: {
                        show: true,
                        /*
                         *处理横坐标负半轴这边的  "柱状"  显示的数
                         *后台传过来是负数，显示时是正数
                         */
//                        formatter: function (value) {
//                            if(value.data<0){
//                                return '男';
//                            }
//                        },
                        position:'insideBottomRight',
                        formatter:'女('+(female/total*100).toFixed(2)+'%)'

                    },
                    data:[female]
                }
            ]
        });
    }

</script>

<!--学历-->
<script>
    function xueli(data){
        // 绘制图表。
        echarts.init(document.getElementById('xueli')).setOption({
            title:{
                text:"学历分布",
                textStyle:{
//                color:'#2B94B2'
                }
            },
            tooltip : {},
            series: {
                type: 'pie',
                color:['red','orange','yellow','green','cyan','blue','purple'],
                data: data,
                radius:['30%','50%']
            },

        });
    }

</script>

<!--民族-->
<script>
    function minzu(data){
        // 绘制图表。
        echarts.init(document.getElementById('minzu')).setOption({
            title:{
                text:"民族分布",
                textStyle:{
//                color:'#2B94B2'
                }
            },
            grid:{
                top:'30%',
                bottom:'30%'

            },
            tooltip : {},
            series: {
                type: 'pie',
                color:['red','orange','yellow','green','blue','indigo','purple'],
                data: data,
                radius:['30%','50%'],
            }
        });
    }

</script>

<!--党龄-->
<script>
    function join(data){
        // 基于准备好的dom，初始化echarts实例
        echarts.init(document.getElementById('dangling')).setOption({
            title: {
                text: '党龄分布',
                textStyle:{
//                color:'#000'

                }
            },
            tooltip: {},
            grid:{
//            containLabel:true
            },
            xAxis: {
                boundaryGap:true,
                data:["5年以内","5-10年","10-20年","20年以上","其他"] ,
                axisLabel:{
                    color:'#000',
                    fontSize:10
                },
                axisLine:{
                    lineStyle:{
                        color:'#EBEBEB',
                    }
                },
                axisTick:{
                    show:false
                },
            },
            yAxis: {
                name:'单位：人',
                nameTextStyle:{
                    color:'#000'
                },
                axisLabel:{
                    color:'#000',
                },
                axisLine:{
                    lineStyle:{
                        color:'#EBEBEB'
                    }
                },
                axisTick:{
                    show:false
                },
                splitLine:{
                    show:false
                },
                nameGap:10
            },
            series: [{
                name: '单位：人',
                type: 'bar',
                barWidth:'20',
                data: data,
                label:{
                    show:true,
                    position:'top',
                    color:'#000'
                },
            }],
            color: ['#328ADB']
        });
    }

</script>

<!--年龄-->
<script>
    function age(data){
        // 基于准备好的dom，初始化echarts实例
        echarts.init(document.getElementById('nianling')).setOption({
            title: {
                text: '年龄分布',
                textStyle:{
//                color:'#2B94B2'
                }
            },
            tooltip: {},
            legend: {
                data:['人数']
            },
            grid:{
                right:'20%',
                left:'15%',
                top:30,
//            containLabel:true
            },
            xAxis: {
                name:'单位：人',
                nameTextStyle:{
                    color:'#000'
                },
                axisLabel:{
                    color:'#000',
                    fontSize:10
                },
                axisLine:{
                    lineStyle:{
                        color:'#EBEBEB',
                    }
                },
                axisTick:{
                    show:false
                },
                splitLine:{
                    show:false
                },
            },
            yAxis: {
                data:["小于30岁","30-40岁","40-50岁","50-60岁","60-70岁","70岁以上","其他"] ,
                axisLabel:{
                    color:'#000',
                    rotate:0,
                    fontSize:10
                },
                axisLine:{
                    lineStyle:{
                        color:'#EBEBEB',
                    }
                },
                axisTick:{
                    show:false
                },
                splitLine:{
                    show:false
                },
            },
            series: [{
                name: '单位：人',
                type: 'bar',
                barWidth:'20',
                data: data,
                label:{
                    show:true,
                    position:'right',
                    color:'#000'
                },

            }],
            color: ['#3AA1FF']
        });
    }

</script>

<!--地图-->
<script>
    function jiguan(data){
        echarts.init(document.getElementById('jiguan')).setOption({
            title : {
                text: '籍贯分布',
                left: 'left',
                textStyle:{
//                fontSize:12
                }
            },
            tooltip : {
                trigger: 'item',
                textStyle:{
                    color:'yellow',
                    align:'left'
                },
            },
            series : [
                {
                    name: '人数',
                    type: 'map',
                    mapType: 'china',
                    roam: false,
                    label: {
                        emphasis: {
                            show: true,
                            color:'#ec0cdb'
                        },
                    },
                    itemStyle:{
                        areaColor:'#77BCEF'
                    },
                    data:data
                }
            ]
        });
    }

</script>

<!--页面JS脚本-->





</body></html>