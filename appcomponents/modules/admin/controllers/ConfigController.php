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
}
