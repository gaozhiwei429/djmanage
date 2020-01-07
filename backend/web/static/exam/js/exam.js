/**
 * Created by 明明 on 2017/6/11.
 */
//设置时间
var timeFlag = 0;
var time;
var mistiming = 0;
function setTime() {
    //$.post('resultSubmit.php', function (data) {
    //    var result = JSON.parse(data);
    //    var startTime = result.startTime;
    //    var endTime = result.endTime;
    //    getServiceTime(startTime, endTime);
    //});
    function getServiceTime(startTime, endTime) {
        var submitTime = new Date(endTime); //截止时间
        var nowTime = new Date(startTime);
        mistiming = submitTime.getTime() - nowTime.getTime();
        console.log(mistiming);
        if (mistiming == 0) {
            clearInterval(time);
            timeFlag = 1;
            $('#time').html(0 + "时" + 0 + "分" + 0 + "秒");
            $('#endResult').html('考试结束！！！');
            return;
        }
        //距离结束的天数
//            var d = Math.floor(t / 1000 / 60 / 60 / 24);
        var h = Math.floor(mistiming / 1000 / 60 / 60 % 24);
        var m = Math.floor(mistiming / 1000 / 60 % 60);
        var s = Math.floor(mistiming / 1000 % 60);
        $('#time').html(h + "时" + m + "分" + s + "秒");
    }
}

//页面加载完成，获取服务器端的时间
time = setInterval(setTime, 1000);

$('#submit').click(function () {
    if (confirm("确定交卷？？")) {
        clearInterval(time);
        submit();
    } else {
        if (timeFlag == 1) {
            clearInterval(time);
        }
    }
});

function submit() {
    var radioArray = new Array();//选择题数组
    var judgmentArray = new Array();//判断题数组
    var completionArray = new Array();//填空题数组
    var quesId = $('.quesId');
    var radio = $('.radio');
    var judgment = $('.judgment');
    var completion = $('.completion');

//        获取选择题数据
    radio.each(function (i) {
        var id = $(this).html();
        var radioResult = $('.radio_item input[name=radio_' + (i + 1) + ']:checked').val();
        var data = {};
        data.id = id;
        data.value = radioResult;
        radioArray.push(data);
    });
    var radioData = JSON.stringify(radioArray);

//        获取判断题数据
    judgment.each(function (i) {
        var id = $(this).html();
        var judgmentResult = $('.judgment_item input[name=judgment_' + (i + 1) + ']:checked').val();
        var data = {};
        data.id = id;
        data.value = judgmentResult;
        judgmentArray.push(data);
    });
    var judgmentData = JSON.stringify(judgmentArray);

//        获取填空题数据
    completion.each(function (i) {
        var id = $(this).html();
        var completionResult = $('.completion_result input[name=completion_' + (i + 1) + ']').val();
        var data = {};
        data.id = id;
        data.value = completionResult;
        completionArray.push(data);
    });
    var completionData = JSON.stringify(completionArray);

    var json = {
        radioResult: radioData,
        judgmentResult: judgmentData,
        completionResult: completionData
    };
    $.post('resultSubmit.php', json, function (data) {
        var result = JSON.parse(data);
        if (result.code != 1) {
            var $toastContent = $("<span>" + result.message + "</span>");
            Materialize.toast($toastContent, 2000);
        } else {
            var $toastContent = $("<span>" + result.message + "</span>");
            Materialize.toast($toastContent, 2000);
            setTimeout(function () {
                window.location.href = '../view/personal.php';
            }, 3000);
        }
    });
}