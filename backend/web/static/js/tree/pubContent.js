var content = {};
var home = {};
var checkAll;
var checkboxes;

content.maxFileSize = 100;
content.timeLength = 0;
content.showPagenumListFunction;
/*页面初始化汇总方法*/
content.initPage = function(that,menuId,pageWindow,jsonButtonList){
	content["menuId"] = menuId;
	home.tempPk = null;
	home.tempParameter=null;
	home.boolIsNullList=false;//默认是否加载数据
	home.showPagenumListFunction(1);//加载列表第一页
	content.loadPage(that);//分页标签初始化
	content.initPageButton(that);//按钮初始化
	content.checkInit();//列表复选框初始化
	content.searchMoreInit();// 更多搜索栏初始化
	setTimeout("content.setPageZero()",content.timeLength)//分页置零
	$(".searchMoreBtn").attr("title","高级搜索");
	$(".freshBtn").attr("title","刷新");
	$(".isShowRevokeBtn").attr("title","显示撤销");
	$("#backBtn").attr("type","button");//解决IE10弹窗在输入框回车自动关层
	$('body').addClass("searchPage");
};
//无数据列表页码置零
content.setPageZero = function(){
	if(0 == $("#total").val()){
		$("#pagenum").val($("#total").val());
	}
};
//分页样式
content.loadPage = function(that,fn){
	var thatPageObj = $("#page",that);
	thatPageObj.html(
		"<div class='listpage listpagebox'>"+
			"<div class='col-xs-7' style='text-align:right;'>"+
				"<span id='firstpage' style='padding:0 0.5rem;'><a style='color:#676a6c;' href='javascript:;'><span class='fa fa-step-backward'></span></a></span>"+
				"<span id='frontpage' style='padding:0 0.5rem;'><a style='color:#676a6c;' href='javascript:;'><span class='fa fa-backward'></span></a></span>"+
				"<span style='padding:0 0.5rem;'><input type='text' id='pagenum' maxlength='4' style='text-align:center;border:1px solid #e5e6e7;width: 4rem;'/> 共 <span id='totalnum'></span> 页</span>"+	
				"<span id='nextpage' style='padding:0 0.5rem;'><a style='color:#676a6c;' href='javascript:;'><span class='fa fa-forward'></span></a></span>"+
				"<span id='lastpage' style='padding:0 0.5rem;'><a style='color:#676a6c;' href='javascript:;'><span class='fa fa-step-forward'></span></a></span>"+
			"</div>"+
			"<div class='col-xs-5' style='text-align:right;'>"+
				"每页<span id='len'></span>条 共 <span id='datanum'></span> 条 <span id='currentpage' style='display:none;'></span></span>"+
			"</div>"+
		"</div>"
	);
	/*过滤字符*/
	$('#pagenum',that).on('keyup',function(event){ 
		if(event.keyCode == 8 || event.keyCode == 46 || event.keyCode == 13) {
			return;
		}
		var jump_no = $("#pagenum",that).val();
		var patrn = /^[0-9]+$/;
		if(!patrn.test(jump_no)){
			$("#pagenum",that).val($("#nowpage",that).val());
			return;
		}
	});
	/*回车跳转到指定页*/
	$('#pagenum',that).on('keypress',function(event){ 
		if(event.keyCode == 13) {  
			var jump_no = $("#pagenum",that).val();
			if (jump_no != ''){
				var total= $("#total",that).val();
				//限制数字格式字符串
				var patrn = /^[0-9]+$/;
	        	if(!patrn.test(jump_no)){
	        		$("#pagenum",that).val($("#nowpage",that).val());
	        		return;
	        	}
				if (parseInt(jump_no)>parseInt(total)){
					$("#pagenum",that).val(total);
					jump_no = total;
				}
				if(parseInt(jump_no)<=0){
					$("#pagenum",that).val(1);
					jump_no = 1;
				}
				content.clickFlag = false;
				setTimeout(function(){
					$('#windowlist-content').animate({scrollTop:0},1000);
					$('body,html').animate({scrollTop:0},1000);
					if(fn){
						fn(jump_no)
					}else{
						home.showPagenumListFunction(jump_no);
					}
					var listPage = $('.listpage',that);
					listPage.attr('clickFlg','true');
				},content.timeLength);
			}
        }  
    });
};
//分页按钮初始化
content.initPageButton = function(that,fn){
	setTimeout(function(){
		//获取高级搜索条件数量
		content.getSearchMoreCount();
	}, 600);
	var listPage = $('.listpage',that);
	listPage.attr('clickFlg','true');
	$(".listpage span",that).click(function() {
		if(listPage.attr('clickFlg') == 'false'){
			return;
		}
		listPage.attr('clickFlg','true');
		var thepage = $(this).attr("id");
		var topage;
		var currentpage = $("#currentpage",that).html();
		if (thepage === "firstpage"){
			if(parseInt(currentpage) == 1){
				return ;
			}
			content.clickFlag = false;
			setTimeout(function(){
				$('#windowlist-content',that).animate({scrollTop:0},1000);
				$('body,html').animate({scrollTop:0},1000);
				if(fn){
					fn(1);
				}else{
					home.showPagenumListFunction(1);
				}
				listPage.attr('clickFlg','true');
			},content.timeLength);
		}else if (thepage === "lastpage"){
			var total= $("#total",that).val();
			if (parseInt(currentpage)>=parseInt(total)){
				return;
			}
			content.clickFlag = false;
			setTimeout(function(){
				$('#windowlist-content',that).animate({scrollTop:0},1000);
				$('body,html').animate({scrollTop:0},1000);
				if(fn){
					fn($("#totalnum",that).html());
				}else{
					home.showPagenumListFunction($("#totalnum",that).html());
				}
				listPage.attr('clickFlg','true');
			},content.timeLength);
		}else if (thepage === "frontpage"){
			if (currentpage != ''){
				topage = parseInt(currentpage) - 1;
				if(parseInt(topage)<=0){
					return;
				}
				var r = /^\+?[1-9][0-9]*$/;		//正整数 
			    if (!r.test(topage)) {
			    	topage = '1';
			    }
				content.clickFlag = false;
				setTimeout(function(){
					$('#windowlist-content',that).animate({scrollTop:0},1000);
					$('body,html').animate({scrollTop:0},1000);
					if(fn){
						fn(topage);
					}else{
						home.showPagenumListFunction(topage);
					}
					listPage.attr('clickFlg','true');
				},content.timeLength);
			}
		}else if (thepage === "nextpage"){
			if (currentpage != ''){
				topage = parseInt(currentpage) + 1;
	
				var total= $("#total",that).val();
				if (parseInt(topage)>parseInt(total)){
					topage = total;
					return;
				}
				content.clickFlag = false;
				setTimeout(function(){
					$('#windowlist-content',that).animate({scrollTop:0},1000);
					$('body,html').animate({scrollTop:0},1000);
					if(fn){
						fn(topage);
					}else{
						home.showPagenumListFunction(topage);
					}
					listPage.attr('clickFlg','true');
				},content.timeLength);
			}
		}else{
			$("#frontpage",that).show(); 
			$("#nextpage",that).show();
			$("#firstpage",that).show(); 
			$("#lastpage",that).show();
			listPage.attr('clickFlg','true');
		}
	});
};
//列表按钮初始化
content.initButton = function (that,jsonButtonList){ 
	if(typeof(strMenuParameter)=="undefined" || strMenuParameter==null || strMenuParameter!='workbench'){
		$(".input-group input[type='text'].form-control",that).focus();
	}
	if(jsonButtonList!=null){
		$(jsonButtonList).each(function(){
		    //显示权限列表中的按钮
		    //$(this)[0].code.length>0 ? $("."+$(this)[0].code,that).show() : "";
			if ($(this)[0].code.length>0){
				$("."+$(this)[0].code,that).show();
				$("."+$(this)[0].code,that).css("display","inline-block");
			}
			//列表权限左右开关样式，显示文字
			if ($("."+$(this)[0].code,that).hasClass("switch")){
				return true;
			}else if($("."+$(this)[0].code,that).hasClass("showText")){
				//特殊列表权限显示文字
				$(".showText",that).show();
				$(".showText",that).css("display","inline-block");
				return true;
			}
		    //修改权限列表中的按钮title
		    $(this)[0].name.length>0 ? $("."+$(this)[0].code,that).attr("title",$(this)[0].name) : "";
		    if($(this)[0].name.length>0){
		    	var jq = $("#contentsContainerList ."+$(this)[0].code,that);
		    	try{
		    		jq.html($(this)[0].name);
		    	}catch(e){}
		    }
		});
		//删除操作列按钮
		$("#contentsContainerList .buttonList",that).each(function(){
			var btnThis = $(this);
			var len = btnThis.find("a").length;
			var max = btnThis.find(".maxMore").length !=0 ? true : false;
			btnThis.find("a").each(function(index,element){
				if($(this).css('display') == "none"){
					$(this).remove();
				}
				//增加更多按钮
				//1.ul增加样式maxMore开关
				//2.操作内大于3个按钮显示“更多”
				//3.文字长度大于6增加样式listMax
				if (max){
					if (len > 2 && index == 2){
						$(this).parent().after("<li><a class='moreBtn' title='更多' style='display: inline-block;'>更多</a></li>");
					}
					if (index > 2){
						$(this).css('display','none');
					}
				}
				if ($(this).text().length > 6){
					$(this).addClass("listMax");
				}
			});
			if((btnThis.find("a").length == 0 && 
					btnThis.find(".switch").length == 0 &&
					btnThis.find("input").length == 0) ||
					btnThis.find(".switch").css('display') == "none" ||
					btnThis.find(".sortBtn").css('display') == "none"){
				if (btnThis.find(".showText").length == 0){
					btnThis.html("");
				}
			}
		});
		//删除top的大按钮
		$(".nochecked button",that).each(function(){
			if($(this).css('display') == "none" && !$(this).hasClass("returnBtn")){
				$(this).remove();
			}
		});
	}
	setTimeout("content.setPageZero()",content.timeLength)//分页置零
	//更多按钮
	$(".buttonList .moreBtn",that).click(function() {
		$(this).parent().parent().find("a").each(function(){
			$(this).css("display","inline-block");
		});
		var btnThis = $(this);
		setTimeout(function(){
			btnThis.parent().parent().parent().addClass("open");
			btnThis.remove();
		}, 100);
	});
};
//url路径组装
content.getUrl = function (baseUrl,parameter){
	var resultUrl = new Array();
	resultUrl.push(baseUrl);
	if(content["menuId"]===undefined){
		return (resultUrl.join(""));
	}
	if(parseInt(baseUrl.indexOf('?'))===-1){
		resultUrl.push("?");
	}else{
		resultUrl.push("&");
	}
	resultUrl.push("menuId=");
	resultUrl.push(content["menuId"]);
	resultUrl.push("&boolIsNullList=");
	resultUrl.push(home.boolIsNullList);
	resultUrl.push("&openType=program");
	if(parseInt(arguments.length) ===2 && parseInt(parameter.length) > 0){
		if(parameter.substring(0,1)!=="&"){
			parameter = "&" + parameter;
		}
		resultUrl.push(content.encodeURI(parameter));
	}
	//传递动作code
	var strActionCode = "";
	if(typeof(jsonButtonList)!="undefined" && jsonButtonList!=null && jsonButtonList.length>0){
		$(jsonButtonList).each(function(){
			if ($(this)[0].code == "subordinateBtn"){//管理下级
				strActionCode += ","+$(this)[0].code;
			}else if ($(this)[0].code == "thisLevelBtn"){//管理本级
				strActionCode += ","+$(this)[0].code;
			}else if ($(this)[0].code == "setupBtn"){//管理本级
				strActionCode += ","+$(this)[0].code;
			}
		});
		if(strActionCode.length>0)
			strActionCode += ",";
	}
	resultUrl.push("&strActionCode="+strActionCode);
	return (resultUrl.join(""));
};
//解决字符串乱码
content.encodeURI = function(value){
	return encodeURI(encodeURI(value));
};
//删除/失效按钮样式变化
content.setDelButtonState = function (document) {
    var checkedCount = content.checkSelectedCount("onecheck", document);
    content.setBtnClass(checkedCount, document);
}
//设置按钮样式
content.setBtnClass = function (selectedCount, objLink) {
	var objBtn1 = $(".nochecked", objLink).find(".deleteAllBtn");
	var objBtn2 = $(".nochecked", objLink).find(".loseAllBtn");
	var objBtn3 = $(".nochecked", objLink).find(".readAllBtn");
	if (selectedCount && parseInt(selectedCount) > 0) {
	    objBtn1.attr("disabled",false);
	    objBtn2.attr("disabled",false);
	    objBtn3.attr("disabled",false);
	} else {
	    objBtn1.attr("disabled",true);
	    objBtn2.attr("disabled",true);
	    objBtn3.attr("disabled",true);
	}
};
//列表选中数统计
content.checkSelectedCount = function (name, objFrom) {
    var checkedCount = 0;
    var allCount = 0;
    var eChecks = $("table input[class*='" + name + "']", objFrom);
    if (eChecks.length == 0){
    	return (checkedCount);
    }

    for (var i = 0; i < eChecks.length; i++) {
        if (eChecks[i].style.display == "none")
            continue;
        allCount++;
        if (eChecks[i].checked) {
            checkedCount++;
        }
    }
    return (checkedCount);
};
//列表checkbox控制全选和取消全选
content.checkInit = function(fn,dom){
	if(dom == null ||typeof( dom) == undefined  ){
		dom = window.document;
	}
	if($(".i-checks",dom).length == 0){
		return;
	}
    $(".i-checks",dom).iCheck({checkboxClass: "icheckbox_square-green", radioClass: "iradio_square-green"});
	checkAll = $('input.checkAll',dom);
	checkboxes = $('input.onecheck',dom);
	checkAll.on('ifChecked ifUnchecked', function(event) {
		if (event.type == 'ifChecked') {
			checkboxes.iCheck('check');
		} else {
			checkboxes.iCheck('uncheck');
		}
		content.setDelButtonState(dom);
	});
	checkboxes.on('ifChanged', function(event){
		if(checkboxes.filter(':checked').length == checkboxes.length) {
			checkAll.prop('checked', 'checked');
		} else {
			checkAll.removeAttr('checked');
		}
		checkAll.iCheck('update');
		content.setDelButtonState(dom);
		if(fn && !$(this).hasClass("checkAll")){
			fn(this);
		}
	});
}
//table获取选择的ids
content.getIdSelections = function(){
	return $.map(checkboxes, function (row) {
		if(true == row.checked){
			var strTitles=$(row).data('strtitles');
			if(strTitles != undefined && strTitles !='undefined'){
				return row.value+String.fromCharCode(27)+strTitles;
			}else{
				return row.value
			}
		}
	});
}
//更多搜索初始化
content.searchMoreInit = function(){
	//列表页高级搜索效果实现
	$(".collapse-link").click(function() {
	    var o = $(this).closest("div.ibox"),
	    e = $(this).find("i"),
	    i = o.find("div.ibox-content");
	    i.slideToggle(200),
	    e.toggleClass("fa-chevron-up").toggleClass("fa-chevron-down"),
	    o.toggleClass("").toggleClass("border-bottom"),
	    setTimeout(function() {
	        o.resize(),
	        o.find("[id^=map-]").resize()
	    },
	    50)
	});
	//搜索栏折叠
	$("#searchMoreBtn").click(function(){
		$("#searchMore").slideToggle(500);
		setTimeout(function(){
			content.getSearchMoreCount();
		}, 600);
	});
	//开窗
	$("#searchMoreBtnWindow").click(function(){
		var n = $("#searchMoreWindow .row").length;
		var h = 0;
		if(n==1){
			h = 140;
		}else if(n==2){
			h = 185;
		}
		var nHeight = 0;
		if($("#searchMoreWindow").is(":hidden")){
			nHeight = 0-h;
			$("#windowlist-content").height($("#windowlist-content").height()+nHeight);
		}else{
			nHeight = h;
		}
		$("#searchMoreWindow").slideToggle(500, function(){
			if($("#searchMoreWindow").is(":hidden")){
				$("#windowlist-content").height($("#windowlist-content").height()+nHeight);
			}
		});
	});
}
//日期加减天数
content.getDate = function(date,n){
	var newDate = new Date(date);
	newDate.setDate(newDate.getDate()+n);  
	return newDate.getFullYear()+"-"+(newDate.getMonth()+1)+"-"+newDate.getDate();
}
content.getDateFormat = function(date,n){
	var newDate = new Date(date);
	newDate.setDate(newDate.getDate()+n);  
	var mouth ;
	if (newDate.getMonth()+1>9) {
		mouth = newDate.getMonth()+1;
	} else{
		mouth = "0"+(newDate.getMonth()+1);
	}
	var day ;
	if (newDate.getDate()>9) {
		day = newDate.getDate();
	} else{
		day = "0"+newDate.getDate();
	}
	return newDate.getFullYear()+"-"+mouth+"-"+day;
}
//选中复选框
content.setCheck = function(value){
	checkboxes.each(function(){
		if(this.value==value){
			$(this).iCheck('check');
		}
	});
}
//ajaxPost请求
content.ajaxPost = function(strUrl,dataParemeter,callback){
	$(".bottomButton button").attr("disabled","disabled");
	if(typeof(strMenuParameter) !="undefined" && dataParemeter["strMenuParameter"]!=null && dataParemeter["strMenuParameter"]==='workbench'){
		openLoadWorkbench();
	}else{
		top.openLoad();
	}
    $.ajax({
       type: "post",
       url: strUrl,
       data: dataParemeter,
       success: function (result) {
    	   if(dataParemeter["strMenuParameter"]!=null && dataParemeter["strMenuParameter"]==='workbench'){
    		   closeLoadWorkbench();
    		}else{
    			top.closeLoad();
    		}
    	   if (result.indexOf("logout") != -1) {
    		   top.logout();
    		   return;
    	   }else{
    		   callback(result);
    	   }
       },
       error: function (data) {
    	   if(dataParemeter["strMenuParameter"]!=null && dataParemeter["strMenuParameter"]==='workbench'){
    		   closeLoadWorkbench();
    		}else{
    			top.closeLoad();
    		}
    	   top.failMsg("系统错误!");
       },
       complete: function (data) {
    	   $(".bottomButton button").removeAttr("disabled");
       }
    });
}

//ajaxLoad同步 wjj add
content.ajaxSynPost = function(strUrl,dataParemeter,callback){
	top.openLoad();
    $.ajax({
       type: "post",
       url: strUrl,
       async: false,//设置成同步
       data: dataParemeter,
       success: function (result) {
    	   top.closeLoad();
    	   if (result.indexOf("logout") != -1) {
    		   top.logout();
    		   return;
    	   }else{
    		   callback(result);
    	   }
       },
       error: function (data) {
    	   top.closeLoad();
    	   top.failMsg("系统错误!");
       }
    });
}
//wjj end

//ajaxLoad请求
content.ajaxLoad = function(id,strUrl,dataParemeter,callback){
	if(typeof(strMenuParameter) !="undefined" && dataParemeter["strMenuParameter"]!=null && dataParemeter["strMenuParameter"]==='workbench'){
		openLoadWorkbench();
	}else{
		top.openLoad();
	}
	$(id).load(strUrl,dataParemeter,function(response,status,xhr){
 	    if (response.indexOf("logout") != -1) {
 		   top.logout();
 		   return;
 	    }
		if (status == "error"){
 		   top.logout("网络请求异常，请重新登录！");
		   return;
		}
		if(typeof(strMenuParameter) !="undefined" && dataParemeter["strMenuParameter"]!=null && dataParemeter["strMenuParameter"]==='workbench'){
			closeLoadWorkbench();
		}else{
	 	   	top.closeLoad();
		}
 	   	callback();
 	   	//初始化方法，在pubFunction.js内
 	    initFun();
	});
}

content.getSearchMoreCount = function(){
	if(!$("#searchMore").is(":hidden")){
		$(".searchMoreNum").hide();
	}else{
		if($(".searchMoreNum").length>0){
			var n=0;
			var formList = $("#searchMore form");
			for(i=0;i<formList.length;i++){
				if($(formList[i]).css('display') == 'none')
					continue;
				var domInput = $("input", formList[i]);
				for(j=0;j<domInput.length;j++){
					if(domInput[j].type=="checkbox" || domInput[j].value =="请选择"){
						continue;
					}
					if($(domInput[j]).val().length>0){
						n++;
					}
				}
				var domSelect = $("select.chosen-select", formList[i]);
				for(k=0;k<domSelect.length;k++){
					if($(domSelect[k]).val() !=null && $(domSelect[k]).val().length>0){
						n++;
					}
				}
			}
			if(n>0){
				$(".searchMoreNum").show();
				$(".searchMoreNum").html(n);
			}else{
				$(".searchMoreNum").hide();
				$(".searchMoreNum").html("");
			}
		}else{
			var n=0;
			var formList = $("#searchMore form");
			for(i=0;i<formList.length;i++){
				if($(formList[i]).css('display') == 'none')
					continue;
				var domInput = $("input", formList[i]);
				for(j=0;j<domInput.length;j++){
					if(domInput[j].type=="checkbox" || domInput[j].value =="请选择"){
						continue;
					}
					if($(domInput[j]).val().length>0){
						n++;
					}
				}
				var domSelect = $("select.chosen-select", formList[i]);
				for(k=0;k<domSelect.length;k++){
					if($(domSelect[k]).val() !=null && $(domSelect[k]).val().length>0){
						n++;
					}
				}
			}
			if(n>0){
				$("#searchMoreBtn").append("<div class='searchMoreNum'></div>");
				$(".searchMoreNum").html(n);
			}
		}
	}
}