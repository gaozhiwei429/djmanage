<?php
/**
 * 文件上传接口
 * @文件名称: UploadController.php
 * @author: jawei
 * @Email: gaozhiwei429@sina.com
 * @Mobile: 15910987706
 * @Date: 2018-12-01
 * @Copyright: 2017 北京往全保科技有限公司. All rights reserved.
 * 注意：本内容仅限于北京往全保科技有限公司内部传阅，禁止外泄以及用于其他的商业目的
 */
namespace appcomponents\modules\common\controllers;
use appcomponents\modules\common\CommonService;
use source\controllers\ManageBaseController;
use source\libs\Common;
use source\libs\DmpLog;
use source\manager\BaseService;
use Yii;
class UploadController extends ManageBaseController
{
    public function beforeAction($action){
        $this->noLogin = true;
        return parent::beforeAction($action);
    }
    /**
     * 腾讯cos文件上传
     * @return array
     */
    public function actionImages() {
        $user_id = 11;
//        if (Yii::$app->request->isPost) {
            $commonService = new CommonService();
//            $ret = $commonService->uploadImg($user_id, $_FILES);
            $local_path = "";
            $key = "";
            if(isset($_FILES['files']['name']) && !empty($_FILES['files']['name'])) {
                $key = $_FILES['files']['name'];
            }
            if(isset($_FILES['files']['tmp_name']) && !empty($_FILES['files']['tmp_name'])) {
                $local_path = $_FILES['files']['tmp_name'];
            }
            if(!empty($local_path) && !empty($key)) {
                $ret = $commonService->uploadTencentCos($user_id, $local_path, $key);
                return $ret;
            }
//        }
        return BaseService::returnErrData([], 500, '提交方式异常');
    }
    /**
     * 阿里云oss文件上传服务
     * @return array
     */
    public function actionAliFile() {
        $commonService = new CommonService();
        $local_path = "";
        $key = "";
        if(isset($_FILES['file']['name']) && !empty($_FILES['file']['name'])) {
            $keyArr = explode('.', $_FILES['file']['name']);
            $key = Common::getRandChar(10).".".(isset($keyArr[1]) ? $keyArr[1] : "jpg");
        }
        if(isset($_FILES['file']['tmp_name']) && !empty($_FILES['file']['tmp_name'])) {
            $local_path = $_FILES['file']['tmp_name'];
        }
        if(!empty($local_path) && !empty($key)) {
            $ret = $commonService->uploadAlioss($this->user_id, $local_path, $key);
            //如下为了配合layui的编辑器文件上传来使用
            if(BaseService::checkRetIsOk($ret)) {
                $filePath = BaseService::getRetData($ret);
                $data = [
                    'src'=>$filePath,
                    'title'=>isset($keyArr[0]) ? $keyArr[0] : "星格玛3D打印",
                ];
                return BaseService::returnOkData($data);
            }
            return $ret;
        }
        return BaseService::returnErrData([], 500, '提交方式异常');
    }
}
