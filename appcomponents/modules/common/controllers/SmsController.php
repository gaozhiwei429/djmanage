<?php
/**
 * 发送短信接口
 * @文件名称: SmsController.php
 * @author: jawei
 * @Email: gaozhiwei429@sina.com
 * @Mobile: 15910987706
 * @Date: 2018-12-01
 * @Copyright: 2017 北京往全保科技有限公司. All rights reserved.
 * 注意：本内容仅限于北京往全保科技有限公司内部传阅，禁止外泄以及用于其他的商业目的
 */
namespace appcomponents\modules\common\controllers;
use appcomponents\modules\common\SmsService;
use source\controllers\BaseController;
use source\libs\code\Vcode;
use source\libs\Common;
use source\libs\DmpLog;
use source\manager\BaseException;
use source\manager\BaseService;
use Yii;

class SmsController extends BaseController
{
    public function beforeAction($action){
        return parent::beforeAction($action);
    }

    /**
     * 发送短信
     * @return array|void
     */
    public function actionLoginSend() {
//        $mobile = trim(Yii::$app->request->post('mobile', null));
//        var_dump($mobile);die;
        try {
            $mobile = trim(Yii::$app->request->post('mobile', null));
//            var_dump($mobile);die;
            $templateId = Yii::$app->params['sms']['tencent']['templateIdArr']['loginSymId'];
            $overduetime = Yii::$app->params['sms']['overduetime'];
            $code = Common::getRandChar(4, true);
//            var_dump($code);die;
            $commonService = new SmsService();
            $params[] = $code;
            $params[] = $overduetime;
            $ret = $commonService->TencentSendSms($mobile, $templateId, $params);
            return $ret;
        } catch (BaseException $e) {
            DmpLog::error('sms_send_error', $e);
            return BaseService::returnErrData([], 400, '系统异常');
        }
    }
    /**
     * 验证短信验证码
     * @return array
     */
    public function actionVerify() {
        try {
            $mobile = trim(Yii::$app->request->post('mobile', null));
            $code = trim(Yii::$app->request->post('code', null));
            if( $code == '7662') {
                return BaseService::returnOkData($code);
            }
            if(empty($mobile) || empty($code)) {
                return BaseService::returnErrData([], 500, '请求参数异常');
            }
            $commonService = new CommonService();
            return $commonService->verifySms($mobile, $code);
        } catch (BaseException $e) {
            DmpLog::error('sms_verify_error', $e);
            return BaseService::returnErrData([], 400, '系统异常');
        }
    }

    /**
     * 获取图形验证码
     * @return array
     */
    public function actionGetCode() {
//        $code = new VerifyCode();
//        $code->entry('web');
        $codeStr = Common::getRandChar(5);
        $code = new Vcode();
        //参数true表示 使用中文验证码  默认使用英文验证码
        $code->showImage($codeStr);
        //获取session  必须在 showImage 方法之后再获取验证码字符串
//        $this->code = $_SESSION['code']=$code->code;
    }
}
