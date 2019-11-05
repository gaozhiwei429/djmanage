var search = {};
var openWidth = "900px";//search页面开窗宽度
var errorCode="您不是党员，无操作权限！";
search.isPartyPermission = false;//控制操作列显示按钮（党组织数据权限），当前人以外党组织只显示按钮
search.isActionView = false;
//查看、查阅情况（通知）
search.partyPermissionBtn = new Array("viewBtn","consultBtn");//当前人以外党组织显示按钮内容
search.initPage = true;//页面是否执行初始化方法（initPage）

//特殊一级菜单下的所有程序不控制权限-用户类型权限
//一级菜单包括：系统管理、访惠聚、政务办公、超级系统管理
var userTypeAuthority = new Array("xtgl","fhj","zwbg","cjxtgl");

//特殊菜单程序不控制权限-用户类型权限
//菜单包括：党组织信息维护
var unLockMenuCodes = new Array("dzzxxwh");

var userType = top.userType;//用户类型
var jsonButtonListCurrent = [];//当前的列表权限
var viewJsonButtonList = [{"code":"viewBtn","name":"查看"}];//查看权限
$(function () {
	if(menuId!=null && menuId.length>0 && top.$("#topHidUserMenuGuids").length>0){
		if(top.$("#topHidUserMenuGuids").val().indexOf(menuId)<0){
			$("body").html('<div class="col-sm-12"><div class="middle-box text-center animated fadeInRightBig"><h3 class="font-bold">抱歉您没有访问权限</h3></div></div>');
			return;
		}
	}
	if(search.isActionView &&jsonButtonList.length == 0){
		jsonButtonList = viewJsonButtonList;
	}
	jsonButtonListCurrent = jsonButtonList;
	/* (非党员)*/
	if(userType != "2"){
		searchModuleInfo()
	}

	/* 页面公共配置加载  */
	if (search.initPage)
		content.initPage(window.document,menuId);
	
	/* 查询按钮 */
	$(".searchBtn").click(function(){
    	home.showPagenumListFunction(1);
	});
	/* 刷新按钮  */
	$(".freshBtn").click(function(){
		home.showPagenumListFunction($("#currentpage").html());
	});
	//下拉框初始化
	$(".chosen-select").chosen({ 
		no_results_text : "未找到此选项！"
	});
	/* 删除按钮 */
	$(".deleteAllBtn").click(function (){
		var ids = content.getIdSelections();
		var rex = String.fromCharCode(27);
        if(ids.length > 0){
        	var guidArr = new Array();
        	var titleArr = new Array();
        	if(ids.toString().indexOf(rex) != -1){
        		for(var i=0; i<ids.length;i++){
        			guidArr[i] = ids[i].split(rex)[0];
        			var strTitle = ids[i].split(rex)[1];
        			if(strTitle != null && strTitle!= undefined && strTitle !='undefined'){
        				titleArr[i] = strTitle;
        			}
        		}
        	}else{
        		guidArr = ids;
        	}
        	deleteInfo(guidArr.join(';'),titleArr.join(String.fromCharCode(27)));
        }else{
        	top.warningMsg("请选择数据！"); 
        }
	});
	//日期控件
	$('.bindDate').focus(function() {
	    WdatePicker({
	        dateFmt : 'yyyy-MM-dd'
	    });
	});
	$('.bindDate').click(function() {
		$dp.show();
	});
	//时间控件
	$('.bindTime').focus(function() {
	    WdatePicker({
	        dateFmt : 'yyyy-MM-dd HH:mm:00',
	        onpicked: checkDate(this)
	    });
	});
	$('.bindTime').click(function() {
		$dp.show();
	});	
});

function localInitPage(){	
	//动态赋值title
	$('.table .gridlist').each(function() {
	    var $this = $(this);
	    $this.attr("title",$.trim($this.text()));
	});
	
	$("#totalnum").html($("#total").val());
	$("#datanum").html($("#dataCnt").val());
	$("#len").html($("#dataCountLEN").val());
	$("#currentpage").html($("#nowpage").val());
	$("#pagenum").val($("#nowpage").val());
	
	//复选框初始化
	content.checkInit();
	//按钮初始化
    content.initButton(window.document,jsonButtonListCurrent);
    
	//删除按钮初始化（不能点击）
    content.setDelButtonState(window.document);
	home.tempParameter = null;
	$(".buttonList .viewBtn").click(function() {
		var id = $(this).parent().parent().data('pk');
		if (typeof(id) != "undefined") { 
			viewInfo(id.strGuid);
		} 
	});
	$(".buttonList .editBtn").click(function() {
		var id = $(this).parent().parent().data('pk');
		if (typeof(id) != "undefined") { 
			editInfo(id.strGuid);
		} 
	});
	$(".buttonList .deleteBtn").click(function() {
		var id = $(this).parent().parent().data('pk');
		if (typeof(id) != "undefined") { 
			deleteInfo(id.strGuid,id.strTitles);
		} 
	});	
	if(typeof(jsonButtonList) != "undefined"){
		$(jsonButtonList).each(function(){
			if($(this)[0].code == "subordinateBtn" ){
				search.isPartyPermission = false;
				return false;
			}
		});
	}
	if(search.isPartyPermission){
		if(userType == "2"){
			hidePartyPermission();
		}
	}
}
//删除当前人以外党组织操作列按钮
function hidePartyPermission(){
	var icbox = false;
	$("#contentsContainerList .dropdown-menu").each(function(){
		var btnThis = $(this);
		var strDataPartyGuid = btnThis.data('pk').strDataPartyGuid;
		if(top.userPartyGuid.indexOf(strDataPartyGuid) == -1){
//			btnThis.find("a").each(function(){
//				var index = $.inArray($(this).attr('class'),search.partyPermissionBtn);
//				if(index == -1){
//					$(this).remove();
//					btnThis.parent().parent().parent().find(".icheckbox_square-green").remove();
//				}
//			});

			var trThis = btnThis.parent().parent().parent();
			$(jsonButtonList).each(function(){
				var index = $.inArray($(this)[0].code,search.partyPermissionBtn);
				if(index == -1){
					trThis.find("." + $(this)[0].code).remove();
					trThis.find(".icheckbox_square-green").remove();
					icbox = true;
				}
			});
			trThis.find(".moreBtn").remove();
		}
		if(btnThis.find("a").length == 0){
			btnThis.parent().parent().html("");
		}
	});
	if (icbox){
		//重新初始化复选框，解决取消复选框点击2次问题
		content.checkInit();
	}
}
//根据用户类型显示功能权限，数组中的菜单不控制
function searchModuleInfo(){
	if ("2" == top.isPorductParty){
		errorCode = "您正在使用试用帐户部分功能受限，想体验完整功能请您注册管理员帐户！";
	}
	
	var menuCode = getQueryString("menuCode");
	var index = $.inArray(menuCode,unLockMenuCodes);
	if(index == -1){
		//查找当前菜单的一级菜单menucode进行比较
		var dataParemeter = {"menu.id":menuId};
		content.ajaxSynPost(top.searchModuleInfoUrl,dataParemeter,function(data){
			var index = $.inArray(data,userTypeAuthority);
			if(index == -1){
				switch (userType) {
				case '1'://管理员只有查看权限  
					jsonButtonListCurrent = viewJsonButtonList;//其他程序只有查看权限
					break;
				case '3'://普通用户：无权限
					top.failMsg(errorCode);
					top.closeLoad();
					top.closeTable();
					break;
				}
			}
			
		});
	}else{
		switch (userType) {
		case '3'://普通用户：无权限
			top.failMsg(errorCode);
			top.closeLoad();
			top.closeTable();
			break;
		}
	}
}
//隐藏列表复选框
function hideCheckBox(){
	var table = document.getElementById("tab");
	if(table != null){
		var trs = table.rows;  
		for(var i = 0, len = trs.length; i < len; i++){  
			var cell = trs[i].cells[0];  
			cell.style.display = 'none'; 
			cell.setAttribute("class", "display-none"); 
		}
	}
}
//显示列表复选框
function showCheckBox(){
	var table = document.getElementById("tab");
	if(table != null){
		var trs = table.rows;  
		for(var i = 0, len = trs.length; i < len; i++){  
			var cell = trs[i].cells[0];  
			cell.style.display = '';  
			cell.setAttribute("class", ""); 
		}
	}
}
//个人情况
function personalInfo(strGuid){
	if(strGuid != null && strGuid.length > 0){
		top.openWindow({
			title: '个人情况页面',
			area: ['820px', '560px'],
			maxmin:true,
			scrollbar: false,
			content: content.getUrl(personalUrl,"developApplication.strGuid="+strGuid)
		});
	}
}
//获取url参数
function getQueryString(name) { 
	var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i"); 
	var r = window.location.search.substr(1).match(reg); 
	if (r != null) return unescape(r[2]); return null; 
}

//多个分页 20190802 dj 
//dom jquer选择dom
//jsonButtonListCurrent 动作
//fn 回调查询
function multiplePage(dom,jsonButtonListCurrent,fn){
	//创建分页
	content.loadPage(dom,fn)
	//分页点击方法
	content.initPageButton(dom,fn)
	//动态赋值title
	$('.table .gridlist',dom).each(function() {
	    var $this = $(this);
	    $this.attr("title",$.trim($this.text()));
	});
	$("#totalnum",dom).html($("#total",dom).val());
	$("#datanum",dom).html($("#dataCnt",dom).val());
	$("#len",dom).html($("#dataCountLEN",dom).val());
	$("#currentpage",dom).html($("#nowpage",dom).val());
	$("#pagenum",dom).val($("#nowpage",dom).val());
	//全选
	content.checkInit(null,dom)
	//按钮初始化
    content.initButton(dom,jsonButtonListCurrent);
	//删除按钮初始化（不能点击）
    content.setDelButtonState(dom);
}