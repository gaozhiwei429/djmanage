/**
 * Created by 明明 on 2017/6/11.
 */
$(function () {
    $('#subBtn').click(function () {
        var isChecked = $('#rememberPassword').prop('checked');
        var usernamVal = $('#username').val();
        var passwordVal = $('#password').val();

        if (!usernamVal) {
            Materialize.toast("请输入用户名", 2000);
            return;
        }

        if (!passwordVal) {
            Materialize.toast("请输入密码", 2000);
            return;
        }

        if ($('#slide').val() < 100) {
            Materialize.toast("请进行拖动验证", 2000);
            return;
        }

        var con = {username: usernamVal, password: passwordVal};
        $.post("../api/login.php", con, function (data) {
            var result = JSON.parse(data);
            if (result.code < 1) {
                window.location.href = "../view/personal.php";
            }
            Materialize.toast(result.msg, 2000);
        });
    });
});