<?php

namespace appcomponents\modules\common;
use Qcloud\Sms\SmsSingleSender;
use source\manager\BaseService;
use Yii;
/**
 * common module definition class
 */
class SmsService extends BaseService
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'appcomponents\modules\common\controllers';
    public $mobile;
    public $nationcode;
    /**
     * @inheritdoc
     */
    public function init() {
        parent::init();
    }
    /**
     * @param $mobile 接受短信手机号
     * @param $templateId 短信模板id
     * @param $params 参数
     * @param string $sign 签名
     * @param string $nationcode 国家码
     */
    public function TencentSendSms($mobile, $templateId, $params=[], $sign="瑞安科技", $nationcode="86") {
        $appkey = Yii::$app->params['sms']['tencent']['appkey'];
        $appid = Yii::$app->params['sms']['tencent']['appid'];
//        $strRand = time();
//        $time = $strRand;
//        $host = Yii::$app->params['sms']['tencent']['host'].$time;
//        $sig = Common::SHA256Hex("appkey=$appkey&random=$strRand&time=$time&mobile=$mobile");
        $ssender = new SmsSingleSender($appid, $appkey);
        $result = $ssender->sendWithParam($nationcode, $mobile, $templateId, $params, $sign, "", "");  // 签名参数未提供或者为空时，会使用默认签名发送短信
        $resultData = json_decode($result, true);
        if(isset($resultData['result']) && $resultData['result'] ==0) {

            return BaseService::returnOkData([]);
        }
        return BaseService::returnErrData($result);
    }
}
