<?php

/**
 * 管理账户用户相关接口请求入口操作
 * @文件名称: UserController.php
 * @author: jawei
 * @Email: gaozhiwei429@sina.com
 * @Date: 2017-12-06
 * @Copyright: 2017 北京往全包科技有限公司. All rights reserved.
 * 注意：本内容仅限于北京往全包科技有限公司内部传阅，禁止外泄以及用于其他的商业目的
 */
namespace appcomponents\modules\manage\controllers;
use appcomponents\modules\manage\ManageService;
use source\controllers\ManageBaseController;
use source\libs\Common;
use source\manager\BaseService;
use \Yii;

class UserController extends ManageBaseController
{
    /**
     * 用户登录态基础类验证
     * @return array
     */
    public function beforeAction($action){
        $this->noLogin=false;
        $userToken = parent::userToken();
        return parent::beforeAction($action);
    }
    /**
     * 注册用户列表数据获取接口
     * @return array
     */
    public function actionGetList() {
        if(!isset($this->user_id) || !$this->user_id) {
            return BaseService::returnErrData([], 5001, "当前账号登陆异常");
        }
        $username = trim(Yii::$app->request->post('username', null));
        $page = intval(Yii::$app->request->post('p', 1));
        $size = intval(Yii::$app->request->post('size', 10));
        $isindex = boolval(Yii::$app->request->post('index', false));
        $params = [];
        if($username) {
            $params[] = ['like', 'username', $username];
        }
        $orderBy = ['create_time'=>SORT_DESC];
        $passportService = new ManageService();
        return $passportService->getList($params, $orderBy, $page, $size,['*'],$isindex);
    }
    /**
     * 重置密码
     * @return array|mixed
     */
    public function actionResetPass() {
        if(!isset($this->user_id) || !$this->user_id) {
            return BaseService::returnErrData([], 5001, "当前账号登陆异常");
        }
        $user_id = trim(Yii::$app->request->post('user_id', null));
        $onepassword = trim(Yii::$app->request->post('onepassword', null));
        $twopassword = trim(Yii::$app->request->post('twopassword', null));
        if(empty($onepassword) || empty($twopassword)) {
            return BaseService::returnErrData([], 56500, "请输入修改密码");
        }
        if($onepassword!=$twopassword) {
            return BaseService::returnErrData([], 56700, "两次输入的密码不一致");
        }
        $passportService = new ManageService();
        $userInfoRet = $passportService->getUserInfoByUserId($user_id);
        if(BaseService::checkRetIsOk($userInfoRet)) {
            $userInfo = BaseService::getRetData($userInfoRet);
            $password = isset($userInfo['password']) ? $userInfo['password'] : "";
            $salt = isset($userInfo['salt']) ? $userInfo['salt'] : Common::getRandChar(6);
            $newpassport = Common::createPassword($onepassword, $salt);
            if($newpassport==$password) {
                return BaseService::returnErrData([], 57600, "输入密码不能与原密码相同");
            }
            $passportService->editPwd($user_id, $newpassport, $salt);
        }
        return $userInfoRet;
    }
    /**
     * 用户登陆接口
     * @return array|mixed
     */
    public function actionLogin() {
        $username = trim(Yii::$app->request->post('username', null));
        $password = trim(Yii::$app->request->post('password', null));
        $source = intval(Yii::$app->request->post('source', 0));
        if(!empty($username)) {
            $manageService = new ManageService();
            return $manageService->login($username, $password, $source);
        }
        return BaseService::returnErrData([], 500, "用户名或密码不能为空");
    }
    /**
     * 用户注册接口
     * @return array
     */
    public function actionRegister() {
        $username = trim(Yii::$app->request->post('username', null));
        $password = trim(Yii::$app->request->post('password', null));
        if(!empty($username) && !empty($password)) {
            $manageService = new ManageService();
            return $manageService->register($username, $password);
        }
        return BaseService::returnErrData([], 500, "用户名或密码不能为空");
    }
    /**
     * 检查用户名是否已注册
     * @return mixed
     */
    public function actionCheckExist() {
        $username = trim(Yii::$app->request->post('username', null));
        $manageService = new ManageService();
        return $manageService->checkAdmimnUserExist($username);
    }
    /**
     * 获取当前登陆用户id
     * @return mixed
     */
    public function actionGetUserInfo() {
        if(!isset($this->user_id) || !$this->user_id) {
            return BaseService::returnErrData([], 5001, "当前账号登陆异常");
        }
        $manageService = new ManageService();
        return $manageService->getUserAdminInfoByUserId($this->user_id);
    }
    /**
     * 登陆状态过期设置
     * 退出系统登陆状态
     * @return array
     */
    public function actionLogout() {
        if(!isset($this->user_id) || !$this->user_id) {
            return BaseService::returnErrData([], 5001, "当前账号登陆异常");
        }
        $user_id = $this->user_id;
        $type = isset(Yii::$app->params['user']['type']) ? Yii::$app->params['user']['type'] : 0;
        if(!$user_id) {
            return BaseService::returnErrData([], 58500, "请求参数异常");
        }
        if(!$type) {
            return BaseService::returnErrData([], 58800, "系统配置异常");
        }
        $manageService = new ManageService();
        return $manageService->logoutAdmin($user_id, $type);
    }
    /**
     * 更新用户详情数据模型接口
     * @param $params
     * @param $updateData
     * @return array
     */
    public function actionUpdateUserInfo() {
        if(!isset($this->user_id) || !$this->user_id) {
            return BaseService::returnErrData([], 5001, "当前账号登陆异常");
        }
        $mobile = trim(Yii::$app->request->post('mobile', ""));//联系电话
        $id = intval(Yii::$app->request->post('user_id', 0));//联系电话
        $nickname = trim(Yii::$app->request->post('nickname', ""));//姓名
        $email = trim(Yii::$app->request->post('email', ""));//联系邮箱
        $username = trim(Yii::$app->request->post('username', ""));
        $password = trim(Yii::$app->request->post('password', ""));
        $verifypassword = trim(Yii::$app->request->post('verifypassword', ""));
        $sex = intval(Yii::$app->request->post('sex', ""));
        $company = trim(Yii::$app->request->post('company', ""));
        $address = trim(Yii::$app->request->post('address', ""));
        $department_id = trim(Yii::$app->request->post('department_id', ""));
        $post = Yii::$app->request->post();
        $role_ids = [];
        foreach($post as $k=>$postData) {
            if(strstr($k,"role_id")) {
                $role_ids[] = $postData;
            }
        }
        if($password!=$verifypassword) {
            return BaseService::returnErrData([], 5177, "密码不一致");
        }
        if(!isset($this->user_id) || !$this->user_id) {
            return BaseService::returnErrData([], 5001, "当前账号登陆异常");
        }
//        if(empty($role_ids) || !is_array($role_ids)) {
//            return BaseService::returnErrData([], 516900, "请选择用户角色");
//        }
        // || empty($mobile) || empty($nickname) || empty($email) || empty($username)
        if(empty($mobile) && Common::pregPhonNum($username)) {
            $mobile = $username;
        }
        if(!empty($mobile) && !Common::pregPhonNum($mobile)) {
            return BaseService::returnErrData([], 517600, "请输入正确的手机号");
        }
        $manageService = new ManageService();
        return $manageService->editUserInfo(
            $id, $username, $role_ids, $password, $mobile, $email, $nickname,
            $sex, $company, $address, $department_id
        );
    }
    /**
     * 获取某个用户的登陆状态
     * @param $params
     * @param $updateData
     * @return array
     */
    public function actionCheckUserToken() {
        if(!isset($this->user_id) || !$this->user_id) {
            return BaseService::returnErrData([], 5001, "当前账号登陆状态已失效");
        }
        return BaseService::returnOkData([]);
    }
}
