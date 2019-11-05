<?php
namespace appcomponents\modules\admin\controllers;
use appcomponents\modules\manage\ManageService;
use appcomponents\modules\passport\PassportService;
use source\controllers\ManageBaseController;
use source\manager\BaseException;
use source\manager\BaseService;
use Yii;

class UserController extends  ManageBaseController {
    public $title = '系统角色管理';
    public $layout = 'content';
    public function beforeAction($action) {
        parent::getMenuUrl();
        return parent::beforeAction($action);
    }
    public function actionIndex() {
        $username = trim(Yii::$app->request->get("username", ""));
//        var_dump($this->menuUrl);die;
        return $this->renderPartial('index',
            [
                'username'=> $username,
                'title' => "用户管理",
                'menuUrl' => $this->menuUrl,
            ]
        );
    }
    public function actionInfo() {
        $id = intval(Yii::$app->request->get('id', 0));
        $passportService = new PassportService();
        $passportInfoRet = $passportService->getUserInfoByUserId($id);
        return $this->renderPartial('info', [
                'title' => '用户信息',
                'id' => $id,
                'userInfo' => BaseService::getRetData($passportInfoRet),
            ]
        );
    }
    /**
     * 退出登录
     */
    public function actionLogout() {
        $session = \Yii::$app->session;
        $loginData = $session->get('loginData');
        if(empty($loginData)) {
            return $this->renderPartial('login', [
                    'title' => '登录',
                ]
            );
        }
        if(isset($loginData['userid'])) {
            $manageService = new ManageService();
            $manageService->logoutAdmin($loginData['userid']);
        }
        $session->set('loginData', []);
        return $this->renderPartial('login', [
                'title' => '登录',
            ]
        );
    }

    /**
     * 修改密码
     * @return string
     */
    public function actionPass() {
        $session = \Yii::$app->session;
        $loginData = $session->get('loginData');
        if(empty($loginData)) {
            return $this->renderPartial('login', [
                    'title' => '登录',
                ]
            );
        }
        if(isset($loginData['userid'])) {
            return $this->renderPartial('pass', [
                    'title' => '修改密码',
                    'id' => $loginData['userid'],
                ]
            );
        }
        $session->set('loginData', []);
        return $this->renderPartial('login', [
                'title' => '登录',
            ]
        );
    }
}
