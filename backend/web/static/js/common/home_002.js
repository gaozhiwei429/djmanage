$(function(){function e(e){return 0!=e&&void $.ajax({url:"/statistics/profit",type:"GET",dataType:"JSON",success:function(e){console.log(e);var t=e.week_ratio;if(t){var o=[];$(".loading_mall_accounted1").hide(),$("#mall_accounted").show(),0===t.last_week_profit&&0===t.two_week_ago_profit?w=!0:(w=!1,t.last_week_profit&&o.push({value:t.last_week_profit,name:"上周利润",selected:!0}),t.two_week_ago_profit&&o.push({value:t.two_week_ago_profit,name:"前一周利润"})),a(o,w)}}})}function t(e){return 0!=e&&void $.ajax({url:"/statistics/profit",type:"GET",dataType:"JSON",data:{start_date:v,end_date:end},success:function(e){if(0===e.status)HYD.hint("danger",e.msg);else{var t=e.return_data;if(0===t||""==t)S=!0,o(a,i,S);else{S=!1;var a=[],i=[];$.each(t,function(e,t){$(".loading_mall_accounted2").hide(),$("#mall_trend").show(),a.unshift(t.day),i.unshift(t.total_order_profit)}),o(a,i)}}}})}function o(e,t,o){var a=echarts.init(document.getElementById("mall_trend")),i={tooltip:{backgroundColor:"#fff",borderColor:"#333",borderWidth:2,textStyle:{color:"#000"},formatter:"{b}<br/>{a}: {c}"},grid:{left:"8%",right:"2%",top:"3%",bottom:"11%"},xAxis:{data:e,axisLine:{show:!0},axisTick:{show:!0},axisLabel:{show:!0,textStyle:{color:"#70739e",fontSize:12}},axisLine:{lineStyle:{color:"#e5e5e5",width:1,type:"dotted"}}},yAxis:[{type:"value",splitLine:{show:!1},axisTick:{show:!1},axisLabel:{show:!0,textStyle:{color:"#8b8fa5",fontSize:12},formatter:function(e,t){var e;return e=e>=1e3||e<-1e3?e/1e3+"k":e}},axisLine:{lineStyle:{color:"#e5e5e5",width:1,type:"dotted"}}},{type:"value",name:"",nameTextStyle:{color:"#ebf8ac"},position:"right",splitLine:{show:!1},splitLine:{show:!0,lineStyle:{width:1,type:"dotted",color:["#e5e5e5"]}},axisTick:{show:!1},axisLine:{show:!1},axisLabel:{show:!1}},{type:"value",gridIndex:0,min:50,max:100,splitNumber:8,splitLine:{show:!1},axisLine:{show:!1},axisTick:{show:!1},axisLabel:{show:!1},splitArea:{show:!1}}],series:[{name:"商城利润金额",type:"bar",barWidth:15,itemStyle:{normal:{color:new echarts.graphic.LinearGradient(0,0,0,1,[{offset:0,color:"#7661f6"},{offset:1,color:"#24c2f7"}])}},data:t,animationDelay:function(e){return 100*e}},{name:"商城利润金额",type:"line",yAxisIndex:1,smooth:!0,showAllSymbol:!0,symbol:"circle",symbolSize:5,itemStyle:{color:"#fff"},lineStyle:{color:"rgba(35,184,238, 1)"},areaStyle:{color:"rgba(5,140,255, 0)"},data:t,animationDelay:function(e){return 100*e},animationDelayUpdate:function(e){return 1e4*e},animationDurationUpdate:function(e){return 1e4*e}}]};a.setOption(i,!0),1==o?a.showLoading({text:"暂无数据",color:"rgba(255, 255, 255, 0)",textColor:"#000"}):a.hideLoading()}function a(e,t){var o=echarts.init(document.getElementById("mall_accounted")),a={tooltip:{trigger:"item",formatter:"{b}：{c}元",backgroundColor:"#fff",borderColor:"#333",borderWidth:2,textStyle:{color:"#000"},axisPointer:{type:"line"}},series:[{name:"",type:"pie",selectedMode:"single",radius:[0,"86%"],label:{normal:{formatter:"{b}：{c}元",rich:{b:{fontSize:14,lineHeight:33},per:{padding:[2,4]}}}},itemStyle:{emphasis:{shadowBlur:10,shadowOffsetX:0,shadowColor:"rgba(0, 0, 0, 0.5)"},normal:{color:function(e){var t=["#4381e6","#25c1f7"];return t[e.dataIndex]}}},data:e}]};o.setOption(a,!0),1==t?o.showLoading({text:"暂无数据",color:"rgba(255, 255, 255, 0)",textColor:"#000"}):o.hideLoading()}!function(){$(".J_renew_btn").click(function(){$("#renew_box").show(),$(".renew_overlay").show(),$("body,html").css({overflow:"hidden"})}),$(".J_close_box").click(function(){$("#renew_box").hide(),$(".renew_overlay").hide(),$("body,html").css({overflow:"initial"})});var e=$(".time_tip b").text(),t=(30-e)/30*100+"%";$(".J_scroll_bar b").css({width:t});var o=($(".J_scroll_bar b").width(),$(".J_scroll_bar").width()),a=e/30*o-$(".time_tip").outerWidth()/2;$(".time_tip").css({right:a})}(),$("#content-left-box").niceScroll({cursorcolor:"#ccc"});var i,r,n,s,d,l,c,h,f,p,m,a,o,u=mall_currentAjax1=!1;chartsResize=function(e){for(var t=e.length,o=0;o<t;o++){var a=e[o];a&&a.resize({width:"auto"})}},$(window).resize(function(){chartsResize([i,r,n,s,d,l,c,h,f,p,m])}),$(document).on("mouseover",".tips",function(){var e=$(this),t=e.data("content"),o=e.offset(),a={width:e.outerWidth(!0),height:e.outerHeight(!0)},i=e.data("placement");if(this.tip=null,t=void 0==t||""==t?t=e.text():t,null==this.$tip){var r=$("#tpl_tooltips").html();if(void 0==r||""==r)return;var n=_.template(r,{content:t,placement:i});this.$tip=$(n),$("body").append(this.$tip);var s=0,d=0,l=this.$tip.outerWidth(!0),c=this.$tip.outerHeight(!0);switch(i){case"top":s=o.top+a.height+5,d=o.left-5;break;case"bottom":s=o.top-c-5,d=o.left-5;break;case"left":s=o.top-a.height/2,d=o.left+a.width+5;break;case"right":s=o.top+a.height/2-c/2,d=o.left-l-5}this.$tip.css({top:s,left:d})}this.$tip.stop(!0,!0).fadeIn(300)}),$(document).on("mouseout",".tips",function(){this.$tip&&this.$tip.stop(!0,!0).fadeOut(300)});var y,g=$(".chartDrag-box"),x=g.find(".chartDrag.show"),b=(x.length,[{id:"chart_ddzs",sort:0,show:!0,content:{}},{id:"mall_accounted",sort:1,show:!1,content:{}},{id:"mall_trend",sort:2,show:!1,content:{}},{id:"chart_ddje",sort:3,show:!0,content:{}},{id:"chart_ddtjpei",sort:4,show:!0,content:{}},{id:"chart_fxddzs",sort:5,show:!0,content:{}},{id:"chart_fxddtjpei",sort:6,show:!0,content:{}},{id:"chart_jywcdd",sort:7,show:!1,content:{}},{id:"chart_jywcddpei",sort:8,show:!1,content:{}},{id:"chart_ddbspei",sort:9,show:!1,content:{}},{id:"chart_mmpv",sort:10,show:!0,content:{}},{id:"ranking_goods",sort:11,show:!1,content:{}},{id:"ranking_members",sort:12,show:!1,content:{}},{id:"chart_xzhy",sort:13,show:!1,content:{}},{id:"chart_fxsslpei",sort:14,show:!1,content:{}}]);"undefined"!=typeof localStorage?(y=localStorage.getItem("home_config"),y=y&&y.length>0?$.parseJSON(y):b,u=1==y[1].show,1==y[2].show?mall_currentAjax1=!0:mall_currentAjax1=!1,_.each(y,function(e,t){HYD.home.add(e)}),$(".chartDrag-box").sortable({revert:!0,cursor:"move",placeholder:"chartDragArea",helper:"clone",items:".chartDrag",opacity:.6,activate:function(e,t){t.item.hasClass("width50")&&$(".chartDragArea").addClass("width50"),$(".chartDragArea").html(t.item),$(".chartDragArea .shop-wrap").css({display:"block"})},update:function(e,t){console.log(HYD.home.LModules),HYD.home.reCalcSort()}}).disableSelection()):console.log("抱歉! 您的浏览器不支持 web 存储，请升级或使用其他浏览器！"),$(document).on("click",".btn_config",function(){"undefined"!=typeof localStorage?($("#home_config_box .config_checkbox_input").each(function(e,t){var o=$(t),a=o.data("id"),i=!1;if(_.each(HYD.home.LModules,function(e,t){e.id==a&&(i=!0)}),!i){var r={id:a,sort:0,show:!1,content:{}};HYD.home.LModules.push(r)}_.each(HYD.home.LModules,function(e,t){e.id==a&&(1==e.show?(o.attr("checked",!0),o.parents(".config_checkbox").addClass("config_checkbox_checked")):(o.attr("checked",!1),o.parents(".config_checkbox").removeClass("config_checkbox_checked")))})}),$("#home_config_box").css({transform:"translate(0,0)"}),$(".home_config_box_overlay").show()):console.log("抱歉! 您的浏览器不支持 web 存储，请升级或使用其他浏览器！")}),$(document).on("change","#home_config_box .config_checkbox_input",function(){var e=$(this);e.is(":checked")?e.parents(".config_checkbox").addClass("config_checkbox_checked"):e.parents(".config_checkbox").removeClass("config_checkbox_checked")}),$(document).on("click","#home_config_box .config_btn_confirm",function(){$("#home_config_box .config_checkbox_input").each(function(e,t){var o=$(t),a=o.data("id");_.each(HYD.home.LModules,function(e,t){if(e.id==a)return o.is(":checked")?e.show=!0:e.show=!1,!1})}),HYD.home.reCalcSort(),_.each(HYD.home.LModules,function(e,t){HYD.home.add(e)}),$(".home_config_box_overlay").hide(),$("#home_config_box").css({transform:"translate(100%,0)"}),1==y[1].show?(u=!0,e(u)):u=!1,1==y[2].show?(mall_currentAjax1=!0,t(mall_currentAjax1)):mall_currentAjax1=!1}),$(document).on("click","#home_config_box .config_btn_cancel,.home_config_box_overlay",function(){$(".home_config_box_overlay").hide(),$("#home_config_box").css({transform:"translate(100%,0)"})}),$(document).ready(function(){$.ajax({url:"/Home/ajaxShowBeianInfo",type:"POST",dataType:"JSON",success:function(e){1==e.status?e.show_domain_beian?($(".filing_domain").show(),$(".shade").show()):e.show_domain_beian||($(".filing_domain").hide(),$(".shade").hide()):$.Error(e.msg)}})}),$(document).ready(function(){$.ajax({url:"",type:"POST",dataType:"JSON",success:function(e){1==e.status?e.show_domain_beian?($(".Concern_qb").show(),$(".Concern_shade").show()):e.show_domain_beian||($(".Concern_qb").hide(),$(".Concern_shade").hide()):$.Error(e.msg)}})}),function(){$(".cb-contain").each(function(){var e=$(this).width();$(this).find(".j-chartPanel").css("width",e+"px")});var e=$("#tBodyGetTotalCcount");$.post("/Shop/getHeadDataCount",{},function(t){1==t.status?e.html(t.content):e.find("td").html(t.msg)},"json"),$("div.cb-contain,#getTongJi").each(function(){var e=$(this),t=e.data("type");t&&$.post(t,{},function(t){e.html(t.msg),setTimeout(function(){var e=new Ripple({opacity:.4,speed:1,bgColor:"#eef6ee",cursor:!0});e.addEvent()},1)},"json")})}(),$.ajax({url:"/Shop/mmpv?v="+Math.round(100*Math.random()),type:"post",dataType:"json",success:function(e){if(1==e.status){var t=e.mmpvList;$("#loading_chart_mmpv").hide(),$("#chart_mmpv").show(),i=echarts.init(document.getElementById("chart_mmpv")),option={tooltip:{trigger:"axis",backgroundColor:"#fff",borderColor:"#333",borderWidth:2,textStyle:{color:"#000"},axisPointer:{type:"line",snap:!1}},color:["#0080ff","#4cd5ce"],grid:{left:"0%",right:"1.5%",bottom:"3%",containLabel:!0},legend:{icon:"circle",itemWidth:8,itemHeight:8,right:"1%",data:["pv数"]},xAxis:[{type:"category",boundaryGap:!1,data:t.minute,splitLine:{show:!0,lineStyle:{type:"dashed",width:.5}},axisTick:{show:!1}}],yAxis:[{type:"value",axisLine:{show:!1},splitLine:{lineStyle:{type:"dashed",width:.5}},axisTick:{show:!1}}],series:[{name:"pv数",type:"line",smooth:!0,itemStyle:{normal:{color:"#4381e6"}},areaStyle:{normal:{color:new echarts.graphic.LinearGradient(0,0,0,1,[{offset:0,color:"#d1e1ff"},{offset:.5,color:"#dde9fe"},{offset:1,color:"#fff"}])}},symbolSize:5,data:t.series_today}]},i.setOption(option)}else $("#loading_chart_mmpv").hide(),$("#chart_mmpv").css({height:"auto","margin-top":"30px"}).text("暂无数据").show()}}),function(){function e(){$.ajax({url:"/Shop/orderTotal?v="+Math.round(100*Math.random()),type:"post",dataType:"json",success:function(e){if(1==e.status){var t=e.orderList;$("#ddzs_t").text(t.series_today[6]),$("#ddzs_y").text(t.series_today[5]),$("#jywcdd_t").text(t.end_today[6]),$("#jywcdd_y").text(t.end_today[5]),$("#loading_chart_ddzs").hide(),$("#chart_ddzs").show(),r=echarts.init(document.getElementById("chart_ddzs")),option={tooltip:{trigger:"axis",backgroundColor:"#fff",borderColor:"#333",borderWidth:2,textStyle:{color:"#000"},axisPointer:{type:"line"}},color:["#0080ff","#4cd5ce"],grid:{left:"0.5%",right:"1.5%",bottom:"8%",height:"250",containLabel:!0},legend:{itemWidth:8,itemHeight:8,bottom:"0%",data:[{icon:"circle",name:"付款订单笔数"},{name:"未付款订单笔数"}]},xAxis:[{type:"category",boundaryGap:!1,data:t.day,splitLine:{show:!0,lineStyle:{type:"dashed",width:.5}},axisTick:{show:!1}}],yAxis:[{type:"value",minInterval:1,axisLine:{show:!1},splitLine:{lineStyle:{type:"dashed",width:.5}},axisTick:{show:!1}}],series:[{name:"付款订单笔数",type:"line",smooth:!0,barWidth:40,symbol:"circle",data:t.series_today,areaStyle:{normal:{color:new echarts.graphic.LinearGradient(0,0,0,1,[{offset:0,color:"#fecf9b"},{offset:.5,color:"#fce6cd"},{offset:1,color:"#fff"}])}},itemStyle:{normal:{color:"#ff9015"}}},{name:"未付款订单笔数",type:"line",smooth:!0,barWidth:40,data:t.end_today,symbolSize:5,lineStyle:{normal:{color:"#ffce97",type:"dashed"}},itemStyle:{normal:{color:"#ff9015"}}}]},r.setOption(option)}else $("#loading_chart_ddzs").hide(),$("#chart_ddzs").css("height","auto").text("暂无数据").show()}})}e()}();var w=!1;e(u);var v=end="",S=!1;$(".mall_screening button.btn").click(function(){v=$('.mall_screening input[name="start_time"]').val(),end=$('.mall_screening input[name="end_time"]').val(),mall_currentAjax1=!0,t(mall_currentAjax1)}),t(mall_currentAjax1),$.ajax({url:"/Shop/orderNumPie?v="+Math.round(100*Math.random()),type:"post",dataType:"json",success:function(e){if(1==e.status){var t=e.data;$("#loading_chart_ddbspei").hide(),$("#chart_ddbspei").show(),f=echarts.init(document.getElementById("chart_ddbspei"));var o=function(){var e={tooltip:{trigger:"item",formatter:" {b} <br/> 金额：{c} <br/> 占比：{d}%",backgroundColor:"#fff",borderColor:"#333",borderWidth:2,textStyle:{color:"#000"},axisPointer:{type:"line"}},series:[{type:"pie",radius:"70%",center:["50%","50%"],startAngle:120,label:{normal:{show:!0,formatter:"{b|b}：{d|d}%",formatter:function(e){var t=["{a|"+e.name+"}","{b|"+e.percent+"%}"];return t.join("：")},rich:{a:{fontSize:14},b:{fontSize:18}}},emphasis:{show:!0}},data:[{value:t.unpaid_num,name:"未付款订单笔数",itemStyle:{normal:{color:"#4381e6"}}},{value:t.paid_num,name:"付款订单笔数",selected:"true",itemStyle:{normal:{color:"#e061ae"}}}]}],backgroundColor:"#fff"};return e};f.setOption(o())}else $("#loading_chart_ddbspei").hide(),$("#chart_ddbspei").css("height","auto").text("暂无数据").show()}}),$.ajax({url:"/Shop/orderPriceTotal?v="+Math.round(100*Math.random()),type:"post",dataType:"json",success:function(e){if(1==e.status){var t=e.orderList;$("#loading_chart_ddje").hide(),$("#chart_ddje").show(),n=echarts.init(document.getElementById("chart_ddje")),option={color:["#4381e6","#ff9b2c"],tooltip:{trigger:"axis",backgroundColor:"#fff",borderColor:"#333",borderWidth:2,textStyle:{color:"#000"},axisPointer:{type:"line"}},legend:{color:["#4381e6","#ff9b2c"],icon:"circle",itemWidth:8,itemHeight:8,right:"7%",textStyle:{lineHeight:12},data:[{name:"当天付款订单金额"},{name:"当天所有订单金额"}]},grid:{left:"0.5%",right:"3%",bottom:"3%",height:"200",containLabel:!0},xAxis:[{type:"category",boundaryGap:!1,data:t.day,splitLine:{show:!0,lineStyle:{type:"dashed",width:.5}},axisTick:{show:!1}}],yAxis:[{type:"value",minInterval:1,axisLine:{show:!1},splitLine:{lineStyle:{type:"dashed",width:.5}},axisTick:{show:!1}}],series:[{name:"当天付款订单金额",type:"line",smooth:!0,itemStyle:{normal:{color:"#4381e6"}},symbolSize:5,data:t.t},{name:"当天所有订单金额",type:"line",smooth:!0,itemStyle:{normal:{color:"#ff9b2c"}},symbolSize:5,data:t.f}]},n.setOption(option)}else $("#loading_chart_ddje").hide(),$("#chart_ddje").css("height","auto").text("暂无数据").show()}}),$.ajax({url:"/Shop/orderPie?v="+Math.round(100*Math.random()),type:"post",dataType:"json",success:function(e){if(1==e.status){var t=e.orderList;$("#loading_chart_ddtjpei").hide(),$("#chart_ddtjpei").show(),s=echarts.init(document.getElementById("chart_ddtjpei"));var o=function(){var e={tooltip:{trigger:"item",formatter:" {b} <br/> 金额：{c} <br/> 占比：{d}%",backgroundColor:"#fff",borderColor:"#333",borderWidth:2,textStyle:{color:"#000"},axisPointer:{type:"line"}},series:[{type:"pie",radius:"70%",center:["50%","50%"],startAngle:120,label:{normal:{show:!0,formatter:"{b|b}：{d|d}%",formatter:function(e){var t=["{a|"+e.name+"}","{b|"+e.percent+"%}"];return t.join("：")},rich:{a:{fontSize:14},b:{fontSize:18}}},emphasis:{show:!0}},data:[{value:t.total_fee,name:"付款订单金额占比",itemStyle:{normal:{color:"#ff9b2c"}}},{value:t.Ftotal_fee,name:"未付款订单金额占比",selected:"true",itemStyle:{normal:{color:"#4381e6"}}}]}],backgroundColor:"#fff"};return e};s.setOption(o())}else $("#loading_chart_ddtjpei").hide(),$("#chart_ddtjpei").css("height","auto").text("暂无数据").show()}}),$.ajax({url:"/Shop/orderFxTotal?v="+Math.round(100*Math.random()),type:"post",dataType:"json",success:function(e){if(1==e.status){var t=e.orderList;$("#fxddzs_t").text(t.series_today[6]),$("#fxddzs_y").text(t.series_today[5]),$("#loading_chart_fxddzs").hide(),$("#chart_fxddzs").show(),d=echarts.init(document.getElementById("chart_fxddzs")),option={tooltip:{trigger:"axis",backgroundColor:"#fff",borderColor:"#333",borderWidth:2,textStyle:{color:"#000"},axisPointer:{type:"line",label:{formatter:function(e){window.toolParams=e}}},formatter:function(e){var t=toolParams.seriesData[0].name+"<br/>"+toolParams.seriesData[0].marker+toolParams.seriesData[0].seriesName+": "+toolParams.seriesData[0].value;return t}},color:["#0080ff","#4cd5ce"],grid:{left:"0.5%",right:"3%",bottom:"3%",height:"200",containLabel:!0},xAxis:[{type:"category",data:t.day,axisPointer:{type:"shadow"},splitLine:{show:!0,lineStyle:{type:"dashed",width:.5}},axisTick:{show:!1}}],yAxis:[{type:"value",minInterval:1,axisLine:{show:!1},splitLine:{lineStyle:{type:"dashed",width:.5}},axisTick:{show:!1}}],series:[{name:"分销订单笔数",type:"line",smooth:!0,itemStyle:{normal:{color:"#4381E6",lineStyle:{width:1,color:"#4381E6"},areaStyle:{color:"#f3f8ff"}}},data:t.series_today},{name:"",type:"bar",data:[]},{name:"分销订单笔数",type:"bar",itemStyle:{normal:{color:new echarts.graphic.LinearGradient(0,0,0,1,[{offset:0,color:"#0050DF"},{offset:1,color:"#00B5E2"}]),barStyle:{color:"#00B5E2",width:"10px"},areaStyle:{color:"#00B5E2"}}},data:t.series_today},{name:"",type:"bar",data:[]}]},d.setOption(option)}else $("#loading_chart_fxddzs").hide(),$("#chart_fxddzs").css("height","auto").text("暂无数据").show()}}),$.ajax({url:"/Shop/orderfxpie?v="+Math.round(100*Math.random()),type:"post",dataType:"json",success:function(e){if(1==e.status){var t=e.orderList;$("#loading_chart_fxddtjpei").hide(),$("#chart_fxddtjpei").show(),l=echarts.init(document.getElementById("chart_fxddtjpei"));var o=function(){var e={tooltip:{trigger:"item",formatter:" {b} <br/> 金额：{c} <br/> 占比：{d}%",backgroundColor:"#fff",borderColor:"#333",borderWidth:2,textStyle:{color:"#000"},axisPointer:{type:"line"}},series:[{type:"pie",radius:"70%",center:["50%","50%"],startAngle:120,label:{normal:{show:!0,formatter:"{b|b}：{d|d}%",formatter:function(e){var t=["{a|"+e.name+"}","{b|"+e.percent+"%}"];return t.join("：")},rich:{a:{fontSize:14},b:{fontSize:18}}},emphasis:{show:!0}},data:[{value:(t.total_fee-t.Ftotal_fee).toFixed(2),name:"其他订单",itemStyle:{normal:{color:"#4381e6"}}},{value:t.Ftotal_fee,name:"分销订单",selected:"true",itemStyle:{normal:{color:"#fb75a2"}}}]}],backgroundColor:"#fff"};return e};l.setOption(o())}else $("#loading_chart_fxddtjpei").hide(),$("#chart_fxddtjpei").css("height","auto").text("暂无数据").show()}}),$.ajax({url:"/Shop/orderEndTotal?v="+Math.round(100*Math.random()),type:"post",dataType:"json",success:function(e){if(1==e.status){var t=e.data;$("#loading_chart_jywcdd").hide(),$("#chart_jywcdd").show(),c=echarts.init(document.getElementById("chart_jywcdd"));var o={tooltip:{trigger:"axis",backgroundColor:"#fff",borderColor:"#333",borderWidth:2,textStyle:{color:"#000"},axisPointer:{type:"line"}},grid:{left:"0.5%",right:"3%",bottom:"8%",height:"200",containLabel:!0},xAxis:[{type:"category",boundaryGap:!1,data:t.day,splitLine:{show:!0,lineStyle:{type:"dashed",width:.5}},axisTick:{show:!1}}],yAxis:[{type:"value",minInterval:1,axisLine:{show:!1},splitLine:{lineStyle:{type:"solid",width:.5}},axisTick:{show:!1}}],series:[{name:"交易完成订单笔数",type:"line",smooth:!0,barWidth:40,data:t.end_today,symbolSize:5,lineStyle:{normal:{color:"#61a7ff",type:"solid"}},itemStyle:{normal:{color:"#61a7ff"}},areaStyle:{normal:{color:new echarts.graphic.LinearGradient(0,0,0,1,[{offset:0,color:"#b3d5ff"},{offset:1,color:"#fff"}])}}}]};c.setOption(o)}else $("#loading_chart_jywcdd").hide(),$("#chart_jywcdd").css("height","auto").text("暂无数据").show()}}),$.ajax({url:"/Shop/endOrderCommissionPie?v="+Math.round(100*Math.random()),type:"post",dataType:"json",success:function(e){if(1==e.status){var t=e.data;$("#loading_chart_jywcddpei").hide(),$("#chart_jywcddpei").show(),h=echarts.init(document.getElementById("chart_jywcddpei"));var o=function(){var e={tooltip:{trigger:"item",formatter:" {b} <br/> 金额：{c} <br/> 占比：{d}%",backgroundColor:"#fff",borderColor:"#333",borderWidth:2,textStyle:{color:"#000"},axisPointer:{type:"line"}},series:[{type:"pie",radius:"70%",center:["50%","50%"],startAngle:120,label:{normal:{show:!0,formatter:function(e){var t=["{a|"+e.name+"}","{b|"+e.percent+"%}"];return t.join("：")},rich:{a:{fontSize:14},b:{fontSize:18}}}},data:[{value:(t.total_income-t.total_commission).toFixed(2),name:"剩余金额",itemStyle:{normal:{color:"#4381e6"}}},{value:t.total_commission,name:"佣金支出",selected:"true",itemStyle:{normal:{color:"#f44b53"}}}]}],backgroundColor:"#fff"};return e};h.setOption(o())}else $("#loading_chart_jywcddpei").hide(),$("#chart_jywcddpei").css("height","auto").text("暂无数据").show()}}),$.ajax({url:"/Shop/monthItemSalesRank?v="+Math.round(100*Math.random()),type:"get",dataType:"json",success:function(e){if(1==e.status){var t=e.data.slice(0,5);$("#loading_ranking_goods").hide(),$("#ranking_goods").show();var o=$("#tpl_ranking_goods").html(),a=$(_.template(o,{data:t}));$("#ranking_goods").append(a)}else $("#loading_ranking_goods").hide(),$("#ranking_goods").css("height","auto").text("暂无数据").show()}}),$.ajax({url:"/Shop/monthLowersRank?v="+Math.round(100*Math.random()),type:"get",dataType:"json",success:function(e){if(1==e.status){var t=e.data.slice(0,5);$("#loading_ranking_members").hide(),$("#ranking_members").show();var o=$("#tpl_ranking_members").html(),a=$(_.template(o,{data:t}));$("#ranking_members").append(a)}else $("#loading_ranking_members").hide(),$("#ranking_members").css("height","auto").text("暂无数据").show()}}),$.ajax({url:"/Shop/addedMember?v="+Math.round(100*Math.random()),type:"post",dataType:"json",success:function(e){if(1==e.status){var t=e.userList;console.log(t),$("#loading_chart_xzhy").hide(),$("#chart_xzhy").show(),p=echarts.init(document.getElementById("chart_xzhy")),option={tooltip:{trigger:"axis",backgroundColor:"#fff",borderColor:"#333",borderWidth:2,textStyle:{color:"#000"},axisPointer:{type:"line"}},legend:{color:["#8f6de5","#b38fff"],icon:"circle",itemWidth:8,itemHeight:8,right:"2%",textStyle:{lineHeight:12},data:[{name:"当月新增会员数"},{name:"上月新增会员数"}]},grid:{left:"0.5%",right:"3%",bottom:"3%",height:"200",containLabel:!0},xAxis:[{type:"category",boundaryGap:!1,data:t.day,splitLine:{show:!0,lineStyle:{type:"dashed",width:.5}},axisTick:{show:!1}}],yAxis:[{type:"value",minInterval:1,axisLine:{show:!1},splitLine:{lineStyle:{type:"dashed",width:.5}},axisTick:{show:!1}}],series:[{name:"当月新增会员数",type:"line",smooth:!0,lineStyle:{normal:{color:"#8f6de5"}},itemStyle:{normal:{color:"#8f6de5"}},symbolSize:5,data:t.t},{name:"上月新增会员数",type:"line",smooth:!0,lineStyle:{normal:{color:"#b38fff",type:"dashed"}},itemStyle:{normal:{color:"#b38fff"}},symbolSize:5,data:t.f}]},p.setOption(option)}else $("#loading_chart_xzhy").hide(),$("#chart_xzhy").css("height","auto").text("暂无数据").show()}}),$.ajax({url:"/Shop/userAgentProportion?v="+Math.round(100*Math.random()),type:"post",dataType:"json",success:function(e){if(1==e.status){var t=e.userList;$("#loading_chart_fxsslpei").hide(),$("#chart_fxsslpei").show(),m=echarts.init(document.getElementById("chart_fxsslpei"));var o=function(){var e={tooltip:{trigger:"item",formatter:" {b} <br/> 金额：{c} <br/> 占比：{d}%",backgroundColor:"#fff",borderColor:"#333",borderWidth:2,textStyle:{color:"#000"},axisPointer:{type:"line"}},series:[{type:"pie",radius:"70%",center:["50%","50%"],startAngle:120,label:{normal:{show:!0,formatter:function(e){var t=["{a|"+e.name+"}","{b|"+e.percent+"%}"];return t.join("：")},rich:{a:{fontSize:14},b:{fontSize:18}}}},data:[{value:t.other_totle,name:"其他会员数量",itemStyle:{normal:{color:"#4381e6"}}},{value:t.agent_total,name:"分销商数量",selected:"true",itemStyle:{normal:{color:"#bd6dfc"}}}]}],backgroundColor:"#fff"};return e};m.setOption(o())}else $("#loading_chart_fxsslpei").hide(),$("#chart_fxsslpei").css("height","auto").text("暂无数据").show()}}),$(".pay_btn").click(function(){var e=parseFloat($('input[name="renew_price"]').val()),t=$('input[name="renew_info"]').val();return""==e||isNaN(e)?(HYD.hint("danger","付款金额不能为空"),!1):""==t?(HYD.hint("danger","付款说明不能为空"),!1):void $.ajax({url:"/Shop/PayRenew?v="+Math.round(100*Math.random()),type:"post",dataType:"json",beforeSend:function(){$.jBox.showloading()},data:{renew_price:e,renew_info:t},success:function(e){1==e.status?window.location.href=e.url:HYD.hint("danger",e.msg),$.jBox.hideloading()}})}),_QV_="%e6%9d%ad%e5%b7%9e%e5%90%af%e5%8d%9a%e7%a7%91%e6%8a%80%e6%9c%89%e9%99%90%e5%85%ac%e5%8f%b8%e7%89%88%e6%9d%83%e6%89%80%e6%9c%892018%2f01%2f19+0%3a00",function(){var e=$(".fxsitem").find(".fxsinfo").slice(0,16),t=$(".fxsitem").find(".fxsinfo").slice(16,32),o=$(".fxsitem").find(".fxsinfo").slice(32,48),a=$(".fxsitem").find(".fxsinfo").slice(48,64),i='<div class="allWrapper"><div class="fxswrapper exta-wraper0 clearfix"></div><div class="fxswrapper exta-wraper1 clearfix"></div><div class="fxswrapper exta-wraper2 clearfix"></div><div class="fxswrapper exta-wraper3 clearfix"></div></div>';$(".fxsmain").children(".fxsitem").append(i),$(".exta-wraper0").append(e),$(".exta-wraper1").append(t),$(".exta-wraper2").append(o),$(".exta-wraper3").append(a);var r=function(e){var t=$(".fxspageicon").children("span.cur").index(),o=500,e=e;e=3!=t?e?e:t+1:0,$(".allWrapper").animate({top:"-260px"},o,function(){var t=$(this).children(".fxswrapper").eq(0);$(".allWrapper").css("top","0").append(t),$(".fxspageicon").children("span").eq(e).addClass("cur").siblings("span").removeClass("cur")})},n=setInterval(function(){r()},3e3);$(".fxsitem").hover(function(){clearInterval(n),n=null},function(){n=setInterval(function(){r()},3e3)}),$(".fxsinfo").live({mouseover:function(){$(this).children(".fxscode,.fxscode2").show()},mouseleave:function(){$(this).children(".fxscode,.fxscode2").hide()}})}(),function(){var e=$("body").height()-61;$("#content-left").css("height",e),$(".drawer-box").addClass("pull"),$("#content-left dt").on("click",function(){$(this).is(".active")?($(this).removeClass("active").find(".icon-pull").removeClass("cur"),$(this).siblings("dd").hide()):($(this).parent().siblings("dl").find("dt").removeClass("active").find(".icon-pull").removeClass("cur"),$(this).parent().siblings("dl").find("dd").hide(),$(this).addClass("active").find(".icon-pull").addClass("cur"),$(this).siblings("dd").fadeIn(500))});
    var t=$("#content-right-box").width();
    $(window).scroll(function(){
        var e=($(this).scrollTop(),$("body").height(),$("#content-right-box").width());
        e!=t&&(chartsResize([i,r,n,s,d,l,c,h,f,p,m]),t=e)
    })
}()});