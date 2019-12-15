<?php
/**
 * 入口
 * @文件名称: web.php
 * @author: jawei
 * @Email: gaozhiwei429@sina.com
 * @Mobile: 15910987706
 * @Date: 2018-12-01
 * @Copyright: 2018 北京往全保科技有限公司. All rights reserved.
 * 注意：本内容仅限于北京往全保科技有限公司内部传阅，禁止外泄以及用于其他的商业目的
 */
namespace backend\controllers;
use appcomponents\modules\manage\ManageService;
use source\manager\BaseService;
use Yii;

class UserController extends BaseController {
    public $title = '北京往全保科技有限公司';
    public $layout = 'content';
    public function beforeAction($action) {
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
    /**
     * 登录状态的数据保存
     * @return array|mixed
     */
    public function actionLoginIn() {
        $session = \Yii::$app->session;
        $code = strtolower($session->get('code'));
        $username = trim(Yii::$app->request->post('username', null));
        $password = trim(Yii::$app->request->post('password', null));
        $source = intval(Yii::$app->request->post('source', 4));
        $verify = strtolower(trim(Yii::$app->request->post('verify', null)));
        if($verify != $code) {
            return BaseService::returnErrData([], 500, "验证码输入有误,请重新输入");
        }
        if(!empty($username) && !empty($password)) {
            $manageService = new ManageService();
            $ret = $manageService->login($username, $password, $source);
            if(BaseService::checkRetIsOk($ret)) {
                $loginData = BaseService::getRetData($ret);
                $session->set('loginData', $loginData);
                return BaseService::returnOkData($loginData);
            }
            return $ret;
        }
    }
    /**
     * 前端(单页面应用)入口
     */
    public function actionLogin() {
        return $this->render('login', [
                'title' => '登录',
            ]
        );
    }
    public function actionInfo() {
        $id = intval(Yii::$app->request->post('id', 0));
        return $this->render('info', [
                'title' => '获取',
                'id' => $id,
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
            return $this->render('login', [
                    'title' => '登录',
                ]
            );
        }
        if(isset($loginData['userid'])) {
            $manageService = new ManageService();
            $manageService->logoutAdmin($loginData['userid']);
        }
        $session->set('loginData', []);
        return $this->render('login', [
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
            header("Location: ../user/login");
        }
        if(isset($loginData['userid'])) {
            return $this->render('pass', [
                    'title' => '修改密码',
                    'id' => $loginData['userid'],
                ]
            );
        }
        $session->set('loginData', []);
        header("Location: ../user/login");
    }
}