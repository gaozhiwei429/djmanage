! function (t, e) {
    "use strict";
    if (void 0 === n || !n) var n = function (t) {
        var e = {
            opacity: .5,
            speed: .6,
            bgColor: "#ffffff",
            cursor: !0
        };
        this.option = this.extend(t, e), this.isltIE9() || this.init()
        // console.log(this.option)
    };
    n.prototype = {
        createEle: function (t) {
            return e.createElement(t)
        },
        extend: function (t, e) {
            var n = JSON.parse(JSON.stringify(e));
            for (var i in t) n[i] = t[i];
            return n
        },
        isltIE9: function () {
            return !!/MSIE6.0|MSIE7.0|MSIE8.0|MSIE9.0/i.test(window.navigator.userAgent.replace(/[ ]/g, "").split(";")[1] || '')
        },
        getPosition: function (t) {
            var e = this.getBoundingClientRect(),
                n = Math.max(e.width, e.height);
            return {
                range: n,
                x: t.clientX - e.left - n / 2,
                y: t.clientY - e.top - n / 2
            }
        },
        loadCss: function () {
            var t = e.scripts,
                n = t[t.length - 1].src,
                i = n.substring(0, n.lastIndexOf("/") + 1);
            e.head.appendChild(function () {
                var t = e.createElement("link");
                return t.href = "/Public/plugins/ripple/ripple.css", t.type = "text/css", t.rel = "styleSheet", t.id = "ripplecss", t
            }())
        },
        addEvent: function () {
            var t = this;
            $('[data-ripple="ripple"]').hover(function(n){
                if(this._flag) return false;
                n.stopPropagation();
                this._flag = true;
                var i = t.getPosition.call(this, n),
                    o = e.createElement("span");
                    o.className = "ripple", o.style.top = i.y + "px", o.style.left = i.x + "px", o.style.width = i.range + "px", o.style.height = i.range + "px", o.style.animationDuration = t.option.speed + "s", o.style.background = t.option.bgColor, o.style.opacity = t.option.opacity, o.addEventListener("animationend", function () {
                        this.parentNode.removeChild(this)
                    }, !1), this.appendChild(o)
            },function(){
                this._flag=false;
            })
        }
    }, n.prototype.init = function () {
        this.loadCss();
        var n = this;
    }, t.Ripple = n
}(window, document);