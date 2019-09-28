/**
 @Name：layuiAdmin 主页示例
 @Author：star1029
 @Site：http://www.layui.com/admin/
 @License：GPL-2
 */

layui.define(function (exports) {
    var admin = layui.admin;
    //区块轮播切换
    layui.use(['admin', 'carousel'], function () {
        var $ = layui.$
                , admin = layui.admin
                , carousel = layui.carousel
                , element = layui.element
                , device = layui.device();
        //轮播切换
        $('.layadmin-carousel').each(function () {
            var othis = $(this);
            carousel.render({
                elem: this
                , width: '100%'
                , arrow: 'none'
                , interval: othis.data('interval')
                , autoplay: othis.data('autoplay') === true
                , trigger: (device.ios || device.android) ? 'click' : 'hover'
                , anim: othis.data('anim')
            });
        });
        element.render('progress');
    });
    //八卦新闻
    layui.use(['carousel', 'echarts'], function () {
        var $ = layui.$
                , carousel = layui.carousel
                , echarts = layui.echarts;
        var echartsApp = [], options = [
            {
                title: {
                    subtext: '完全实况球员数据',
                    textStyle: {
                        fontSize: 14
                    }
                },
                tooltip: {
                    trigger: 'axis'
                },
                legend: {
                    x: 'left',
                    data: ['罗纳尔多', '舍普琴科']
                },
                polar: [
                    {
                        indicator: [
                            {text: '进攻', max: 100},
                            {text: '防守', max: 100},
                            {text: '体能', max: 100},
                            {text: '速度', max: 100},
                            {text: '力量', max: 100},
                            {text: '技巧', max: 100}
                        ],
                        radius: 130
                    }
                ],
                series: [
                    {
                        type: 'radar',
                        center: ['50%', '50%'],
                        itemStyle: {
                            normal: {
                                areaStyle: {
                                    type: 'default'
                                }
                            }
                        },
                        data: [
                            {value: [97, 42, 88, 94, 90, 86], name: '舍普琴科'},
                            {value: [97, 32, 74, 95, 88, 92], name: '罗纳尔多'}
                        ]
                    }
                ]
            }
        ]
                , elemDataView = $('#LAY-index-pageone').children('div')
                , renderDataView = function (index) {
                    echartsApp[index] = echarts.init(elemDataView[index], layui.echartsTheme);
                    echartsApp[index].setOption(options[index]);
                    window.onresize = echartsApp[index].resize;
                };
        //没找到DOM，终止执行
        if (!elemDataView[0])
            return;
        renderDataView(0);
    });
    //访问量
    layui.use(['carousel', 'echarts'], function () {
        var $ = layui.$
                , carousel = layui.carousel
                , echarts = layui.echarts;
        var echartsApp = [], options = [
            {
                tooltip: {
                    trigger: 'axis'
                },
                calculable: true,
                legend: {
                    data: ['访问量', '下载量', '平均访问量']
                },
                xAxis: [
                    {
                        type: 'category',
                        data: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月']
                    }
                ],
                yAxis: [
                    {
                        type: 'value',
                        name: '访问量',
                        axisLabel: {
                            formatter: '{value} 万'
                        }
                    },
                    {
                        type: 'value',
                        name: '下载量',
                        axisLabel: {
                            formatter: '{value} 万'
                        }
                    }
                ],
                series: [
                    {
                        name: '访问量',
                        type: 'line',
                        data: [900, 850, 950, 1000, 1100, 1050, 1000, 1150, 1250, 1370, 1250, 1100]
                    },
                    {
                        name: '下载量',
                        type: 'line',
                        yAxisIndex: 1,
                        data: [850, 850, 800, 950, 1000, 950, 950, 1150, 1100, 1240, 1000, 950]
                    },
                    {
                        name: '平均访问量',
                        type: 'line',
                        data: [870, 850, 850, 950, 1050, 1000, 980, 1150, 1000, 1300, 1150, 1000]
                    }
                ]
            }
        ]
                , elemDataView = $('#LAY-index-pagetwo').children('div')
                , renderDataView = function (index) {
                    echartsApp[index] = echarts.init(elemDataView[index], layui.echartsTheme);
                    echartsApp[index].setOption(options[index]);
                    window.onresize = echartsApp[index].resize;
                };
        //没找到DOM，终止执行
        if (!elemDataView[0])
            return;
        renderDataView(0);
    });
    //地图
    layui.use(['carousel', 'echarts'], function () {
        var $ = layui.$
                , carousel = layui.carousel
                , echarts = layui.echarts;
        var echartsApp = [], options = [
            {
                title: {
                    text: '全国3D打印机使用用户分布图',
                    subtext: '不完全统计'
                },
                tooltip: {
                    trigger: 'item'
                },
                dataRange: {
                    orient: 'horizontal',
                    min: 0,
                    max: 60000,
                    text: ['高', '低'],
                    splitNumber: 0
                },
                series: [
                    {
                        name: '全国3D打印机使用用户分布图',
                        type: 'map',
                        mapType: 'china',
                        selectedMode: 'multiple',
                        itemStyle: {
                            normal: {label: {show: true}},
                            emphasis: {label: {show: true}}
                        }, data: [
                            {name: '西藏', value: 60},
                            {name: '北京', value: 60},
                        ]

                    }
                ]
            }
        ]
                , elemDataView = $('#LAY-index-pagethree').children('div')
                , renderDataView = function (index, geoJson) {
                    echarts.registerMap('china', geoJson);
                    echartsApp[index] = echarts.init(elemDataView[index], layui.echartsTheme);
                    echartsApp[index].setOption(options[index]);
                    window.onresize = echartsApp[index].resize;
                };
        //没找到DOM，终止执行
        if (!elemDataView[0])
            return;
        $.extend(window, {
            renderMap: function (data, index = 0, callback) {
                $.get("/static/layuiadmin/json/map/china.json", function (geoJson) {
                    options[index].series[0].data = data;
                    renderDataView(0, geoJson);
                    echartsApp[index].on('click', function (params) {
                        callback(params);
                    });
                })

            }

        })
        //renderDataView(0);  
    });
    //各类产品销售统计
    layui.use(['carousel', 'echarts'], function () {
        var $ = layui.$
                , carousel = layui.carousel
                , echarts = layui.echarts;
        var echartsApp = [], options = [
            {
                title: {
                    text: '各类产品销售统计',
                },
                tooltip: {
                    trigger: 'axis'
                },
                legend: {
                    data: ['3D打印机', '配件/耗材', '模型', '教材/课程']
                },
                calculable: true,
                xAxis: [
                    {
                        type: 'category',
                        data: ['1月', '2月', '3月', '4月', '5月', '6月', '7月']
                    }
                ],
                yAxis: [
                    {
                        type: 'value'
                    }
                ],
                series: [
                    {
                        name: '3D打印机',
                        type: 'bar',
                        data: [2.0, 4.9, 7.0, 23.2, 25.6, 76.7, 135.6],
                    },
                    {
                        name: '配件/耗材',
                        type: 'bar',
                        data: [2.6, 5.9, 9.0, 26.4, 28.7, 70.7, 175.6],
                    },
                    {
                        name: '模型',
                        type: 'bar',
                        data: [2.6, 5.9, 9.0, 26.4, 28.7, 70.7, 175.6],
                    },
                    {
                        name: '教材/课程',
                        type: 'bar',
                        data: [2.6, 5.9, 9.0, 26.4, 28.7, 70.7, 175.6],
                    }
                ]
            }
        ]
                , elemDataView = $('#LAY-index-heapbar').children('div')
                , renderDataView = function (index) {
                    echartsApp[index] = echarts.init(elemDataView[index], layui.echartsTheme);
                    echartsApp[index].setOption(options[index]);
                    window.onresize = echartsApp[index].resize;
                };
        $.extend(window, {
            renderHistogram: function (data, index = 0) {

                options[index].legend.data = data.legend;
                options[index].xAxis[0].data = data.xAxis;
                options[index].series = data.series;
                renderDataView(0);
            }

        })
        //没找到DOM，终止执行
        if (!elemDataView[0])
            return;
    });
    layui.use(['carousel', 'echarts'], function () {
        var $ = layui.$
                , carousel = layui.carousel
                , echarts = layui.echarts;
        //堆积面积图
        var echheaparea = [], heaparea = [
            {
                tooltip: {
                    trigger: 'axis'
                },
                legend: {
                    data: ['IOS', 'Android', '网站', '公众号']
                },
                calculable: true,
                xAxis: [
                    {
                        type: 'category',
                        boundaryGap: false,
                        data: ['周一', '周二', '周三', '周四', '周五', '周六', '周日']
                    }
                ],
                yAxis: [
                    {
                        type: 'value'
                    }
                ],
                series: [
                    {
                        name: 'IOS',
                        type: 'line',
                        stack: '总量',
                        itemStyle: {normal: {areaStyle: {type: 'default'}}},
                        data: [120, 132, 101, 134, 90, 230, 210]
                    },
                    {
                        name: 'Android',
                        type: 'line',
                        stack: '总量',
                        itemStyle: {normal: {areaStyle: {type: 'default'}}},
                        data: [220, 182, 191, 234, 290, 330, 310]
                    },
                    {
                        name: '网站',
                        type: 'line',
                        stack: '总量',
                        itemStyle: {normal: {areaStyle: {type: 'default'}}},
                        data: [150, 232, 201, 154, 190, 330, 410]
                    },
                    {
                        name: '公众号',
                        type: 'line',
                        stack: '总量',
                        itemStyle: {normal: {areaStyle: {type: 'default'}}},
                        data: [320, 332, 301, 334, 390, 330, 320]
                    }
                ]
            }
        ]
                , elemheaparea = $('#LAY-index-heaparea').children('div')
                , renderheaparea = function (index) {
                    echheaparea[index] = echarts.init(elemheaparea[index], layui.echartsTheme);
                    echheaparea[index].setOption(heaparea[index]);
                    window.onresize = echheaparea[index].resize;
                };
        $.extend(window, {
            renderHistogramt: function(data, index = 0) {
                heaparea[index].legend.data = data.legend;
                console.log( data.xAxis);
                heaparea[index].xAxis[0].data = data.xAxis;
                heaparea[index].series = data.series;
                renderheaparea(0);
            }
        })
        if (!elemheaparea[0])
            return;
        renderheaparea(0);
    })

    //饼状图
    layui.use(['carousel', 'echarts'], function () {
        var $ = layui.$
                , carousel = layui.carousel
                , echarts = layui.echarts;
        var echartsApp = [], options = [
            {
                title: {

                },
                legend: {
                    orient: 'vertical',
                    left: 'left',
                    data: ['打印时间', '空闲时间', ]
                },
                series: [
                    {
                        name: '访问来源',
                        type: 'pie',
                        radius: '55%',
                        center: ['50%', '60%'],
                        data: [
                            {value: 335, name: '打印时间'},
                            {value: 310, name: '空闲时间'},
                        ],
                    }
                ]
            }
        ]
                , elemDataView = $('#LAY-index-time').children('div')
                , renderDataView = function (index) {
                    echartsApp[index] = echarts.init(elemDataView[index], layui.echartsTheme);
                    echartsApp[index].setOption(options[index]);
                    window.onresize = echartsApp[index].resize;
                };
        $.extend(window, {
            renderTimeRatio: function (data, index = 0) {
                if(typeof(data.legend)!="undefined"){
                    options[index].legend.data=data.legend;
                }
                options[index].series[0].data =data.series;
                renderDataView(0);
            }

        })
        //没找到DOM，终止执行
        if (!elemDataView[0])
            return;
    });
    //横向图形标示
    layui.use(['carousel', 'echarts'], function () {
        var $ = layui.$
                , carousel = layui.carousel
                , echarts = layui.echarts;
        var echartsApp = [], options = [{
                tooltip: {
                    trigger: 'axis',
                    axisPointer: {// 坐标轴指示器，坐标轴触发有效
                        type: 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
                    }
                },
                legend: {
                    data: ['XGM-5A', 'XGM-5C', 'XGM-3A', '触摸屏', '教材']
                },
                grid: {
                    left: '3%',
                    right: '4%',
                    bottom: '3%',
                    containLabel: true
                },
                xAxis: {
                    type: 'value'
                },
                yAxis: {
                    type: 'category',
                    data: ['北京', '上海', '广州', '山东', '河南', '河北', '台湾']
                },
                series: [
                ,
                    {
                        name: 'XGM-5C',
                        type: 'bar',
                        stack: '总量',
                        label: {
                            normal: {
                                show: true,
                                position: 'insideRight'
                            }
                        },
                        data: [120, 132, 101, 134, 90, 230, 210]
                    },
                    {
                        name: 'XGM-3A',
                        type: 'bar',
                        stack: '总量',
                        label: {
                            normal: {
                                show: true,
                                position: 'insideRight'
                            }
                        },
                        data: [220, 182, 191, 234, 290, 330, 310]
                    },
                    {
                        name: '触摸屏',
                        type: 'bar',
                        stack: '总量',
                        label: {
                            normal: {
                                show: true,
                                position: 'insideRight'
                            }
                        },
                        data: [150, 212, 201, 154, 190, 330, 410]
                    },
                    {
                        name: '教材',
                        type: 'bar',
                        stack: '总量',
                        label: {
                            normal: {
                                show: true,
                                position: 'insideRight'
                            }
                        },
                        data: [820, 832, 901, 934, 1290, 1330, 1320]
                    }
                ]
            }], elemheaparea = $('#LAY-index-crosswise').children('div')
                , renderDataView = function (index) {
                    echartsApp[index] = echarts.init(elemheaparea[index], layui.echartsTheme);
                    echartsApp[index].setOption(options[index]);
                    window.onresize = echartsApp[index].resize;
                };
        $.extend(window, {
            renderCrosswise: function (data, index = 0) {
                options[index].legend.data=data.legend;
                options[index].series =data.series;
                options[index].yAxis.data =data.yAxis;
                renderDataView(0);
            }
        });
        //没找到DOM，终止执行
        if (!elemheaparea[0])
            return;
        //renderDataView(0);
    })
    //自定义柱状图
    layui.use(['carousel', 'echarts'], function () {
        var $ = layui.$
                , carousel = layui.carousel
                , echarts = layui.echarts;
        var echartsApp = [], option = [{
                xAxis: {
                    type: 'time',
                },
                yAxis: {
                    min: 0,
                    max: 4,
                    axisLabel: {
                        formatter: function (value) {
                            var texts = [];
                            if (value == 0) {
                                texts.push('空闲');
                            } else if (value <= 1) {
                                texts.push('使用');
                            } else if (value <= 2) {
                                texts.push('');
                            } else if (value <= 3) {
                                texts.push('');
                            }
                            return texts;
                        }
                    }
                },
                series: [
                    {
                        smooth: false,
                        name: '步数',
                        type: 'line',
                        step: 'end',
                        data: []
                    },
                ]
            }], elemheaparea = $('#LAY-index-custom').children('div')
                , renderDataView = function (index) {
                    echartsApp[index] = echarts.init(elemheaparea[index], layui.echartsTheme);
                    echartsApp[index].setOption(option[index]);
                    window.onresize = echartsApp[index].resize;
                };
        $.extend(window, {
            renderCustom: function (data, index = 0) {
                option[index].series[0].data=data;
                renderDataView(0);
            }
        });
        //没找到DOM，终止执行
        if (!elemheaparea[0])
            return;
    })
  //访问量
    layui.use(['carousel', 'echarts'], function () {
        var $ = layui.$
                , carousel = layui.carousel
                , echarts = layui.echarts;
        var echartsApp = [], options = [
            {
                legend: {data:["平台温度", "喷头温度"]},
                xAxis: {
                    type: 'time',
                },
                yAxis: {
                    type: 'value',
                },
                series: [
                    {
                        name: '访问量',
                        type: 'line',
                        data: [[1554977809000, 110]]
                    },
                    {
                        name: '下载量',
                        type: 'line',
                        data: [[15549719000, 80]]
                    },
                ]
            }
        ]
                , elemDataView = $('#LAY-index-moreline').children('div')
                , renderDataView = function (index) {
                    echartsApp[index] = echarts.init(elemDataView[index], layui.echartsTheme);
                    echartsApp[index].setOption(options[index]);
                    window.onresize = echartsApp[index].resize;
                };
          $.extend(window, {
            renderMoreline: function (data, index = 0) {
                options[index].series=data.series;
                options[index].legend.data=data.legend;
                renderDataView(0);
            }
        });
        //没找到DOM，终止执行
        if (!elemDataView[0])
            return;
    });
    //项目进展
    layui.use('table', function () {
        var $ = layui.$
                , table = layui.table;
        table.render({
            elem: '#LAY-index-prograss'
            , url: layui.setter.base + 'json/console/prograss.js' //模拟接口
            , cols: [[
                    {type: 'checkbox', fixed: 'left'}
                    , {field: 'prograss', title: '任务'}
                    , {field: 'time', title: '所需时间'}
                    , {field: 'complete', title: '完成情况'
                        , templet: function (d) {
                            if (d.complete == '已完成') {
                                return '<del style="color: #5FB878;">' + d.complete + '</del>'
                            } else if (d.complete == '进行中') {
                                return '<span style="color: #FFB800;">' + d.complete + '</span>'
                            } else {
                                return '<span style="color: #FF5722;">' + d.complete + '</span>'
                            }
                        }
                    }
                ]]
            , skin: 'line'
        });
    });
    //回复留言
    admin.events.replyNote = function (othis) {
        var nid = othis.data('id');
        layer.prompt({
            title: '回复留言 ID:' + nid
            , formType: 2
        }, function (value, index) {
            //这里可以请求 Ajax
            //…
            layer.msg('得到：' + value);
            layer.close(index);
        });
    };
    exports('sample', {})
});