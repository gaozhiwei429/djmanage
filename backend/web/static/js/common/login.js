$(function(){
    var e=function(){
        var e=_.random(0,1e3);$("#code-img-enti").attr("src","/common/sms/get-code?d="+e)
    };
    1==$("#plp-bg").length&&new Wonder({
        el:"#plp-bg",dotsNumber:100,lineMaxLength:300,dotsAlpha:.5,speed:1.5,clickWithDotsNumber:5
    });
    var o=function(){
        var o=$("#ipt_account"),c=$("#ipt_pwd"),r=$("#ipt_code"),i=$("#ipt-is_binding"),a=$("#ipt-type"),t=o.val(),n=c.val(),s=r.val(),d=i.val(),h=a.val();
        return ""==t?(LoginShowError(o,"请输入用户名！"),void o.select().focus()):""==n?(LoginShowError(c,"请输入密码!"),
            void c.select().focus()):""==s?(LoginShowError(r,"请输入验证码！"),void r.select().focus()):(
    $.ajax({
        url:"/user/login-in?v="+Math.round(100*Math.random()),
        type:"post",
        dataType:"json",
        data:{username:t,password:n,verify:s,is_binding:d,type:h},
        beforeSend:function(){
            $.jBox.showloading()
        },
        success:function(i){
            if(0==i.code) {
                var storage=window.localStorage;
                var userData = JSON.stringify(i.data)
                storage.setItem("userData",userData);
                //$.cookie("cache_account",t,{expires:30,path:"/"}),
                //    $("#rd_remember").is(":checked")?($.cookie("cache_pwd",n,{expires:30,path:"/"}),$.cookie("cache_pwd_checked",!0,{expires:30,path:"/"})):(
                //        $.cookie("cache_pwd","",{expires:30,path:"/"}),
                //            $.cookie("cache_pwd_checked",!1,{expires:30,path:"/"})
                //    ),
                    window.location.href="/site/index";
            } else{
                switch(i.tab){
                    case"username":LoginShowError(o,i.msg),o.select().focus();break;case"password":LoginShowError(c,i.msg),c.select().focus();break;case"verify":LoginShowError(r,i.msg),r.select().focus();break;case"unknown":alert(i.msg)
                }
                //i.url&&setTimeout(function(){
                //    location.href="/site/index";
                //    //window.location.href=i.url
                //},2e3),e()
            }
            $.jBox.hideloading()
        }
    }),!1)};
    //$("#ipt_account").val($.cookie("cache_account")).focus(),
    //    $("#ipt_pwd").val($.cookie("cache_pwd")),
    //    $("#rd_remember").attr("checked","true"==$.cookie("cache_pwd_checked")),
        $(".j-codeReresh").click(e),$("#btn_login").click(o),
        $(".clearError").bind("keypress click",function(e){
            var c=window.event?e.keyCode:e.which;return 13==c?void o():void LoginClearError($(this))
        }
        ),_QV_="%E6%9D%AD%E5%B7%9E%E5%90%AF%E5%8D%9A%E7%A7%91%E6%8A%80%E6%9C%89%E9%99%90%E5%85%AC%E5%8F%B8%E7%89%88%E6%9D%83%E6%89%80%E6%9C%89"});