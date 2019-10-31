$(function() {
	// 兼容不支持flash的浏览器复制事件
	function hasFlash() {
		var swf;
		var is_Flash = false;
		if (navigator.userAgent.indexOf("MSIE") > 0) {
			try {
				var swf = new ActiveXObject("ShockwaveFlash.ShockwaveFlash");
				is_Flash = true;
			} catch (e) {
				is_Flash = false;
			}
		}
		if (navigator.userAgent.indexOf("Firefox") > 0 || navigator.userAgent.indexOf("Chrome") > 0) {
			swf = navigator.plugins["Shockwave Flash"];
			(swf) ? is_Flash = true: is_Flash = false;
		}
		//无论是否开启flash,都是用clipboard实现复制
		// if (!is_Flash) {
			if ($(".j-copy").length == 0) return;
			$(".j-copy").each(function() {
				if ($(this).siblings(".zclip")) {
					$(this).siblings(".zclip").remove();
				}
			});
			var clipboard = new Clipboard('.j-copy');
			clipboard.on('success', function(e) {
				HYD.hint("success", "内容已成功复制到您的剪贴板中");
			});
			clipboard.on('error', function(e) {
				HYD.hint("danger", "复制失败，请重新复制");
			});
		// }
	}
	hasFlash();
	/* window.onload = function() {
		hasFlash();
	} */
});