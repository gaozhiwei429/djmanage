<?php
namespace appcomponents\modules\admin\controllers;
use source\controllers\ManageBaseController;
use source\manager\BaseException;
use source\manager\BaseService;
use Yii;

class ConfigController extends ManageBaseController {
    public $userLoginData = "";
    public $loginData = [];
    /**
     * 用户登录态基础类验证
     * @return array
     */
    public function beforeAction($action){
        $userToken = parent::userToken();
        $getMenuUrl = parent::getMenuUrl();
        $loginData = Yii::$app->session->get('loginData');
        if(!empty($loginData) && is_array($loginData)) {
            $this->loginData = $loginData;
            $loginStatusData = [];
            foreach($loginData as $k=>$v) {
                $loginStatusData[] = $k."=".$v;
            }
            $this->userLoginData= implode('&',$loginStatusData);
        }
        return parent::beforeAction($action);
    }

    public function actionDictList() {
        $url = "http://cert.casccloud.com:10251/SYSM/DictList.aspx?".$this->userLoginData;
        return $this->renderPartial('dict-list', [
            'title' => "参数配置管理",
            'menuUrl' => $this->menuUrl,
            'url' => $url,
        ]);
    }
    public function actionSysConfigList() {
        $url = "http://cert.casccloud.com:10251/SYSM/SysConfigList.aspx?".$this->userLoginData;
        return $this->renderPartial('sys-config-list', [
            'title' => "系统参数管理",
            'menuUrl' => $this->menuUrl,
            'url' => $url,
        ]);
    }
    public function actionDicTypeList() {
        $url = "http://cert.casccloud.com:10251/SYSM/DictTypeList.aspx?".$this->userLoginData;
        return $this->renderPartial('dic-type-list', [
            'title' => "参数类型管理",
            'menuUrl' => $this->menuUrl,
            'url' => $url,
        ]);
    }
    public function actionSysOperLogList() {
        $url = "http://cert.casccloud.com:10251/SYSM/SysOperLogList.aspx?".$this->userLoginData;
        return $this->renderPartial('sys-oper-log-list', [
            'title' => "操作日志",
            'menuUrl' => $this->menuUrl,
            'url' => $url,
        ]);
    }
    public function actionAfterSaleList() {
        $url = "http://cert.casccloud.com:10251/SYSM/AfterSaleList.aspx?".$this->userLoginData;
        return $this->renderPartial('after-sale-list', [
            'title' => "质保期管理",
            'menuUrl' => $this->menuUrl,
            'url' => $url,
        ]);
    }
}
