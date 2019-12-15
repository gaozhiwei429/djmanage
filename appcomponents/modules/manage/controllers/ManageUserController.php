<?php
namespace appcomponents\modules\manage\controllers;
use appcomponents\modules\manage\ManageService;
use appcomponents\modules\manage\RoleService;
use source\controllers\ManageBaseController;
use source\manager\BaseException;
use source\manager\BaseService;
use Yii;

class ManageUserController  extends ManageBaseController
{
    /**
     * 用户登录态基础类验证
     * @return array
     */
    public function beforeAction($action){
        $this->noLogin=false;
        $userToken = parent::userToken();
        $getMenuUrl = parent::getMenuUrl();
        return parent::beforeAction($action);
    }

    public function actionIndex() {
        $username = trim(Yii::$app->request->get("username", ""));
        return $this->renderPartial('index',
            [
                'username'=> $username,
                'title' => "管理员账号管理",
                'menuUrl' => $this->menuUrl,
            ]
        );
    }
    /**
     * 登录状态的数据保存
     * @return array|mixed
     */
    public function actionLoginIn() {
        $username = trim(Yii::$app->request->post('username', null));
        $password = trim(Yii::$app->request->post('password', null));
        $source = intval(Yii::$app->request->post('source', 1));
        if(!empty($username) && !empty($password)) {
            $manageService = new ManageService();
            $ret = $manageService->login($username, $password, $source);
            if(BaseService::checkRetIsOk($ret)) {
                $loginData = BaseService::getRetData($ret);
                $session = \Yii::$app->session;
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
    /**
     * 修改密码
     * @return string
     */
    public function actionPass() {
        $id = intval(Yii::$app->request->get("id", 0));
        return $this->renderPartial('pass', [
                'title' => '修改密码',
                'id' => $id,
            ]
        );
    }
    public function actionEdit() {
        //获取当前用户的角色
        $id = intval(Yii::$app->request->get("id", 0));
        $roleService = new RoleService();
        $roleIdsRet = $roleService->getRoleIds($id);
        $roleIds = BaseService::getRetData($roleIdsRet);
        $roleParams[] = [];
        $roleDataListRet = $roleService->getDatas($roleParams, [], 0, -1,['*']);
        $passportService = new ManageService();
        $userInfoRet = $passportService->getUserInfoByUserId($id);

        return $this->renderPartial('edit', [
                'title' => $id ? '编辑管理员账户' : "添加管理员账户",
                'id' => $id,
                'roleIds' => $roleIds,
                'roleDataList' => BaseService::getRetData($roleDataListRet),
                'userInfo' => BaseService::getRetData($userInfoRet),
            ]
        );
    }
}
