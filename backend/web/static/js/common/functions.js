$(function(){$(document).on("click",".j-getedit",function(t){var i=$(this).data("title"),n=$(this).data("id"),e={title:i,item_id:n},a=_.template($("#tpl_good_title").html(),{data:e}),o=$(a);$.jBox.show({title:"请编辑商品标题",width:360,height:280,content:o,onOpen:function(){},btnOK:{onBtnClick:function(t){var i=t.find("input[name='itemId']").val(),n=t.find("textarea[name='title']").val();$.ajax({url:"/Item/ajax_item_edit",type:"post",data:{title:n,type:1,item_id:i},dataType:"json",beforeSend:function(){$.jBox.showloading()},success:function(t){1==t.status?(HYD.hint("success","恭喜您，保存成功!"),setTimeout(function(){window.location.reload()},1e3)):HYD.hint("danger","对不起，保存失败："+t.msg),$.jBox.hideloading()},error:function(){$.jBox.hideloading()}})}}})}),$(document).on("click",".j-geteditstock",function(t){var i=$(this);$(this).closest(".stockwrap").addClass("cur").closest("tr").siblings("tr").find(".stockwrap").removeClass("cur"),item_id=i.data("id");var n=i.data("num");$.post("/Item/getItemSku",{id:item_id},function(t){if(1==t.status){t.data.length||t.data.push({skuname:"商品库存",sku_id:item_id,num:n});var i={item_id:item_id,data:t},e=_.template($("#tpl_good_sku_edit").html(),{dataset:i}),a=$(e);$.jBox.show({title:"请编辑商品库存",width:500,height:400,content:a,onOpen:function(){},btnOK:{onBtnClick:function(t){var i=[],n=[],e=t.find("input[name='itemId']").val();t.find(".repertory_price").children(".sku-items").each(function(){var t=$(this).find('input[name="sku_num"]'),e=t.val(),a=t.data("id");i.push(e),n.push(a)}),$.ajax({url:"/Item/ajax_item_edit",type:"post",data:{type:3,item_id:e,sku_num:i,sku_id:n},dataType:"json",beforeSend:function(){$.jBox.showloading()},success:function(t){1==t.status?(HYD.hint("success","恭喜您，保存成功!"),setTimeout(function(){window.location.reload()},1e3)):HYD.hint("danger","对不起，保存失败："+t.msg),$.jBox.hideloading()},error:function(){$.jBox.hideloading()}})}}})}else HYD.hint("danger",t.msg)})}),$(document).on("click",".j-getprice",function(t){var i=$(this);i.closest(".goodswrap").addClass("cur");var n=$(this).data("id"),e=i.data("price"),a={item_id:n,price:e},o=_.template($("#tpl_good_price_edit").html(),{data:a}),s=$(o);$.jBox.show({title:"请编辑商品价格",width:360,height:220,content:s,onOpen:function(){},btnOK:{onBtnClick:function(t){var i=t.find("input[name='itemId']").val(),n=t.find("input[name='price']").val();$.ajax({url:"/Item/ajax_item_edit",type:"post",data:{price:n,type:2,item_id:i},dataType:"json",beforeSend:function(){$.jBox.showloading()},success:function(t){1==t.status?(HYD.hint("success","恭喜您，保存成功!"),setTimeout(function(){window.location.reload()},1e3)):HYD.hint("danger","对不起，保存失败："+t.msg),$.jBox.hideloading()},error:function(){$.jBox.hideloading()}})}}})}),$(document).on("click",".j-geteditserial",function(t){var i=$(this).data("id"),n=$(this).data("serial"),e={oriSerial:n,curSerial:n,item_id:i},a=_.template($("#tpl_good_serial_edit").html(),{data:e}),o=$(a);$.jBox.show({title:"请编辑商品排序",width:360,height:220,content:o,onOpen:function(){},btnOK:{onBtnClick:function(t){var i=t.find("input[name='itemId']").val(),n=t.find("input[name='serial']").val();$.ajax({url:"/Item/ajax_item_edit",type:"post",data:{serial:n,type:4,item_id:i},dataType:"json",success:function(t){1==t.status?(HYD.hint("success","恭喜您，保存成功!"),setTimeout(function(){window.location.reload()},1e3)):HYD.hint("danger","对不起，保存失败："+t.msg)}})}}})}),$(".j-geteditclassName").click(function(){var t=$(this),i=t.data("cid"),n=t.data("id");$.post("/Item/ajaxShopClass/",{},function(t){var t="[object array]"==Object.prototype.toString.call(t).toLowerCase()?t:$.parseJSON(t),e=_.template($("#tpl_item_class").html(),{data:t}),a=$(e);$.jBox.show({title:"请选择分类",width:500,height:400,content:a,onOpen:function(){if(i.length)for(var t=0;t<i.length;t++)if(i[t]){var n=i[t];a.find(".j-chang-firstfloor>label input").each(function(){var t=$(this).val();n==t&&($(this).attr("checked",!0),$(this).parents(".first_floor").addClass("on"))}),a.find(".j-change>label input").each(function(){var t=$(this).val();n==t&&($(this).attr("checked",!0),$(this).parents(".first_floor").find(".j-change").addClass("on"))}),a.find(".j-midchange>label input").each(function(){var t=$(this).val();n==t&&($(this).attr("checked",!0),$(this).parents(".mid_floor").find(".last_floor").addClass("on"),$(this).parents(".first_floor").find(".j-change").addClass("on"))})}},btnOK:{onBtnClick:function(t){$.jBox.close(t);var i=[];t.find(" .j-chang-firstfloor>label>input").each(function(){var t=$(this).attr("checked"),n=$(this).val();t&&i.push(n)}),t.find(" .j-change>label>input").each(function(){var t=$(this).attr("checked"),n=$(this).val();t&&i.push(n)}),t.find(" .j-midchange>label>input").each(function(){var t=$(this).attr("checked"),n=$(this).val();t&&i.push(n)});var e=i.join(",");$.ajax({url:"/Item/ajax_item_edit?v="+Math.round(100*Math.random()),type:"post",dataType:"json",data:{class_id:e,type:5,item_id:n},beforeSend:function(){$.jBox.showloading()},success:function(t){1==t.status?(HYD.hint("success","恭喜您，保存成功！"),setTimeout(function(){window.location.reload()},1e3)):HYD.hint("danger","对不起，保存失败："+t.msg),$.jBox.hideloading()}})}}})})}),$(document).on("click",".j-first_floor,.j-mid_floor",function(){$(this).parent(".first_floor,.mid_floor").hasClass("on")?$(this).text("+").parent(".first_floor,.mid_floor").removeClass("on"):$(this).text("-").parent(".first_floor,.mid_floor").addClass("on")}),$(document).on("change",".j-change input",function(t){var i=$(this).attr("checked"),n=$(this).parents(".first_floor");i&&n.children("label").find("input").attr("checked",!0)}),$(document).on("change",".j-midchange input",function(t){var i=$(this).attr("checked"),n=$(this).parents(".mid_floor");i&&n.children("label").find("input").attr("checked",!0)}),_QV_="%E6%9D%AD%E5%B7%9E%E5%90%AF%E5%8D%9A%E7%A7%91%E6%8A%80%E6%9C%89%E9%99%90%E5%85%AC%E5%8F%B8%E7%89%88%E6%9D%83%E6%89%80%E6%9C%89"});