<?php

/**
 * 管理后台用户相关service
 * @文件名称: ManageService.php
 * @author: jawei
 * @Email: gaozhiwei429@sina.com
 * @Mobile: 15910987706
 * @Date: 2018-12-01
 * @Copyright: 2017 北京往全保科技有限公司. All rights reserved.
 * 注意：本内容仅限于北京往全保科技有限公司内部传阅，禁止外泄以及用于其他的商业目的
 */
namespace appcomponents\modules\manage;
use appcomponents\modules\manage\models\AdminUserModel;
use appcomponents\modules\manage\models\UserLoginTokenModel;
use source\libs\Common;
use source\libs\DmpLog;
use source\manager\BaseException;
use source\manager\BaseService;
use \Yii;
class ManageService extends BaseService
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'appcomponents\modules\manage\controllers';

    public function init()
    {
        parent::init();
    }
    /**
     *  生成安全的Token值
     * @param string $uid
     * @param string $token
     * @return string
     */
    public static function createToken($uid = '', $token = '') {
        $seeder = $uid . '|' . $token;
        if (isset($_SERVER['HTTP_USER_AGENT'])) {
            $seeder .= $_SERVER['HTTP_USER_AGENT'];
        }
        $seeder .= Yii::$app->params['user']['cookieSalt'];
        return md5($seeder);
    }
    /**
     * 创建加密sign值
     * @param $userId
     * @param $token
     * @return string
     */
    public function createSign($userId, $token) {
        $secret = Yii::$app->params['user']['secret'];
        $ret = md5(md5(mb_substr($token,0,10,'utf-8').$userId).$secret);
        return BaseService::returnOkData($ret);
    }
    /**
     *检查用户的token的合法性
     * @param $userId
     * @param $token
     * @param int $type
     * @return array
     */
    public function checkUserToken($userId, $token, $type=1) {
        $whereParams = [];
        if(!$userId || !$token || !$type) {
            return BaseService::returnErrData([], 5001, "请求参数异常");
        }
        if($userId) {
            $whereParams[] = ['=', 'user_id', $userId];
        }
        if($type) {
            $whereParams[] = ['=', 'type', $type];
        }

        $userTokenModel = new UserLoginTokenModel();
        $userTokenInfo = $userTokenModel->getInfoByParams($whereParams);
        if(!empty($userTokenInfo)) {
            if(isset($userTokenInfo['overdue_time']) && !empty($userTokenInfo['overdue_time'])) {
                $time = strtotime($userTokenInfo['overdue_time']);
                if($time< time()) {
                    return BaseService::returnErrData($userTokenInfo, 5001, "当前账号登陆状态已过期");
                }
            }
            if(isset($userTokenInfo['token']) && !empty($userTokenInfo['token'])) {
                if($userTokenInfo['token'] != $token) {
                    return BaseService::returnErrData($userTokenInfo, 5001, "当前数据不存在");
                }
                return BaseService::returnOkData($userTokenInfo);
            }
            return BaseService::returnErrData($userTokenInfo, 5001, "当前数据不存在");
        }
        return BaseService::returnErrData($userTokenInfo, 5001, "当前数据不存在");
    }
    /**
     * 验证登陆态是否合法
     * @param $userId
     * @param $token
     * @param $sign
     * @param $type
     * @return array
     */
    public function verifyToken($userId, $token, $sign, $type) {
        $verifySignRet = $this->createSign($userId, $token);
        if(BaseService::checkRetIsOk($verifySignRet)) {
            $verifySign = BaseService::getRetData($verifySignRet);
            if($verifySign != $sign) {
                return BaseService::returnErrData('', 5001, "请求参数无效");
            }
            $ret = $this->checkUserToken($userId, $token, $type);
            if(BaseService::checkRetIsOk($ret)) {
                $userTokenInfo = BaseService::getRetData($ret);
                if(!empty($userTokenInfo)) {
                    if(isset($userTokenInfo['type']) && $userTokenInfo['type'] != $type) {
                        return BaseService::returnErrData('', 5001, "请求参数无效");
                    }
                    if(isset($userTokenInfo['overdue_time']) && !empty($userTokenInfo['overdue_time'])) {
                        if($userTokenInfo['overdue_time'] <= date('Y-m-d H:i:s')) {
                            return BaseService::returnErrData('', 5001, "登陆状态已失效");
                        }
                    }
                    if(isset($userTokenInfo['token']) && $userTokenInfo['token'] != $token) {
                        return BaseService::returnErrData('', 5001, "请求参数token无效");
                    }
                    return BaseService::returnOkData($userTokenInfo);
                }
            }
            return $ret;
        }
        return $verifySignRet;
    }
    /**
     * 生成密码
     * @param $password
     * @param $salt
     */
    public function createPassword($password, $salt) {
        $newPwd = md5($password.$salt);
        $newPassword = md5(substr($newPwd,0,10));
        return $newPassword;
    }
    /**
     * 检查没有加密的密码是否和原密码一致
     * @param $password
     * @param $salt
     * @param $oldPassword
     * @return bool
     */
    public static function verifyPassword($password, $salt, $oldPassword) {
        $ret = Common::createPassword($password, $salt);
//        $pwd = md5($password.$salt);
//        $password = md5(substr($pwd,0,10));
        if($password != $oldPassword) {
            return BaseService::returnErrData(false, 500, "输入密码有误");
        }
        if(!$ret) {
            return BaseService::returnErrData(false, 500, "输入密码有误");
        }
        return BaseService::returnOkData($password);
    }
    /**
     * 通过用户名获取用户基本信息
     * @param $username
     * @return mixed
     */
    public function getAdminUserInfoByUserName($username) {
        $userModel = new AdminUserModel();
        $params['username'] = trim($username);
        $userData = $userModel->getInfoByParams($params);
        if(!empty($userData)) {
            return BaseService::returnOkData($userData);
        }
        return BaseService::returnErrData($userData, '5002', "该用户没有开通管理账号");
    }
    /**
     * 通过用户id获取用户基本信息
     * @param $username
     * @return mixed
     */
    public function getAdminUserInfoByUserId($id) {
        $userModel = new AdminUserModel();
        $params['id'] = $id;
        $userData = $userModel->getInfoByParams($params);
        if(!empty($userData)) {
            return BaseService::returnOkData($userData);
        }
        return BaseService::returnErrData($userData, '5002', "该用户没有注册账号");
    }
    /**
     * 检查用户名是否存在
     * @param $username
     * @return array
     */
    public function checkAdmimnUserExist($username) {
        $userModel = new AdminUserModel();
        $params['username'] = trim($username);
        $userData = $userModel->getInfoByParams($params);
        if(!empty($userData)) {
            return BaseService::returnOkData([]);
        }
        return BaseService::returnErrData($userData, '5002', "该用户没有注册账号");
    }
    /**
     * 注册用户
     * @param $username
     * @param $password
     * @return array
     */
    public function register($username, $password) {
        $ret = $this->getAdminUserInfoByUserName($username);
        if(BaseService::checkRetIsOk($ret)) {
            return BaseService::returnErrData([], 500, '当前账号已被注册');
        }
        $salt = Common::getRandChar(6);
        $userData = [
            'username' => $username,
            'salt' => $salt,
            'password' => Common::createPassword($password, $salt),
        ];
        return $this->addAdminUser($userData);
    }
    /**
     * 添加账号
     * @param $userData
     * @return array
     */
    public function addAdminUser($userData) {
        try {
            $userModel = new AdminUserModel();
            $user_id = $userModel->addInfo($userData);
            if($user_id) {
                return BaseService::returnOkData($user_id);
            }
            return BaseService::returnErrData([], 550, '注册失败');
        } catch (BaseException $e) {
            @DmpLog::error('passport_adduser_error', $e);
            return BaseService::returnErrData([], 520, '注册失败');
        }
    }
    /**
     * 用户PC登录
     * @param $username
     * @param $password
     * @return array|mixed
     */
    public function login($username, $password, $source=1) {
        $type = Yii::$app->params['user']['type'];
        $overduetime = Yii::$app->params['user']['overduetime'];
        $ret = $this->getAdminUserInfoByUserName($username);
        if(!BaseService::checkRetIsOk($ret)) {
            return $ret;
        }
        $userInfo = BaseService::getRetData($ret);
        $ret = $this->saveUserInfo($userInfo);
        if(!BaseService::checkRetIsOk($ret)) {
            return BaseService::returnErrData($userInfo, 525600, "登录信息存储异常");
        }
        $salt = $userInfo['salt'];//用户密码salt加密盐值
        $passwordVal = Common::createPassword($password, $salt);
        if($passwordVal != $userInfo['password']) {
            return BaseService::returnErrData([], 500, '用户名或者密码错误');
        }
        //保存登录状态
        $token = Common::getRandChar(32);
        return $this->saveLoginToken($userInfo['id'], $token, $type, $overduetime, $source);
    }
    /**
     * 用户登录token值存储表
     * @param $user_id
     * @param $token
     * @param $overduetime
     * @param $source 登陆来源
     * @param $type 用户类型
     * @return mixed
     */
    public function saveLoginToken($user_id, $token, $type, $overduetime = 0, $source =0) {
        $userTokenModel = new UserLoginTokenModel();
        $overTime = !empty($overduetime) ? $overduetime : '';
        $data = [
            'user_id' => $user_id,
            'token' => $token,
            'source' => intval($source),
            'overdue_time' => $overTime,
            'type' => $type ? $type : 0,
        ];
        $ret = $userTokenModel->addInfo($data);
        $sign = BaseService::getRetData($this->createSign($user_id, $token));
        if($ret) {
            $userAdminInfoRet = $this->getUserAdminInfoByUserId($user_id);
            $userAdminInfo = BaseService::getRetData($userAdminInfoRet);
            $loginSign = [
                'userid' => $user_id,
                'token' => $token,
                'sign' => $sign,
                'phone' => isset($userAdminInfo['username']) ? $userAdminInfo['username'] : "",
                'username' => isset($userAdminInfo['username']) ? $userAdminInfo['username'] : "",
            ];
            $saveStatus = $this->saveLoginStatus($loginSign);
            if(BaseService::checkRetIsOk($saveStatus)) {
                return BaseService::returnOkData($loginSign);
            }
            return $saveStatus;
        }
        return BaseService::returnErrData($ret, 5001, "登陆状态异常");
    }
    /**
     * 存储登录状态session
     * @param $userInfo
     * @return array
     */
    public function saveUserInfo($userInfo) {
        $loginSave = [];
        if(!empty($userInfo) && is_array($userInfo)) {
            Yii::$app->session->set('userInfo', $userInfo);
            $loginSave = Yii::$app->session->get('userInfo');
        }
        if(!empty($loginSave)) {
            return BaseService::returnOkData($loginSave);
        }
        return BaseService::returnErrData($loginSave, 530200, "登录状态存储失败");
    }
    /**
     * 存储登录状态session
     * @param $userInfo
     * @return array
     */
    public function getUserInfo() {
        $userInfo = Yii::$app->session->get('userInfo');
        if($userInfo) {
            return BaseService::returnOkData($userInfo);
        }
        return BaseService::returnErrData($userInfo, 530200, "存储登录数据不存在");
    }
    /**
     * 存储登录状态session
     * @param $loginSign
     * @return array
     */
    public function saveLoginStatus($loginSign) {
        $loginSave = false;
        if(!empty($loginSign) && is_array($loginSign)) {
            Yii::$app->session->set('loginData', $loginSign);
            $loginSave = Yii::$app->session->get('loginData');
        }
        if(!empty($loginSave)) {
            return BaseService::returnOkData($loginSave);
        }
        return BaseService::returnErrData($loginSave, 530200, "登录状态存储失败");
    }
    /**
     * 获取登录状态数据异常
     * @return array
     */
    public function getLoginStatusInfo() {
        $loginSave = Yii::$app->session->get('loginData');
        if(!empty($loginSave) && is_array($loginSave)) {
            return BaseService::returnOkData($loginSave);
        }
        return BaseService::returnErrData([], 531900, "获取登录状态数据异常");
    }
    /**
     * 获取用户的登录账户的唯一标识
     * @return int
     */
    public function getUserId() {
        $loginStatusInfoRet = $this->getLoginStatusInfo();
        $loginStatusInfo = BaseService::getRetData($loginStatusInfoRet);
        if(isset($loginStatusInfo['user_id']) && $loginStatusInfo['user_id']) {
            return $loginStatusInfo['user_id'];
        }
        return 0;
    }
    /**
     * 通过用户id获取用户基本信息
     * @param $username
     * @return mixed
     */
    public function getUserAdminInfoByUserId($id) {
        $userModel = new AdminUserModel();
        $params['id'] = $id;
        $userData = $userModel->getInfoByParams($params);
        if(!empty($userData)) {
            return BaseService::returnOkData($userData);
        }
        return BaseService::returnErrData($userData, '5002', "该用户没有注册账号");
    }
    /**
     * 用户退出登陆
     * 用户登陆状态过期
     * @param $userId
     * @param int $type
     * @return array
     */
    public function logoutAdmin($userId, $type=0) {
        if(!$type) {
            $type = isset(Yii::$app->params['user']['type']) ? Yii::$app->params['user']['type'] : 0;
        }
        $adminRet = $this->getAdminUserInfoByUserId($userId);
        if(BaseService::checkRetIsOk($adminRet)) {
            $userTokenModel = new UserLoginTokenModel();
            $userTokenParams[] = ['=', 'user_id', $userId];
            $userTokenParams[] = ['=', 'type', $type];
            $userTokenInfo = $userTokenModel->getInfoByParams($userTokenParams);
            if(!empty($userTokenInfo)) {
                $id = isset($userTokenInfo['id']) ? $userTokenInfo['id'] : 0;
                if(!empty($id)) {
                    $updateInfo['overdue_time'] = date('Y-m-d H:i:s');
                    $updateUserToken = $userTokenModel->updateInfo($id, $updateInfo);
                    if($updateUserToken) {
                        return BaseService::returnOkData($updateUserToken);
                    }
                }
            }
        }
        return BaseService::returnErrData($userId, 500, '退出异常');
    }

    /**
     * 账户信息数据获取
     * @param $addData
     * @return array
     */
    public function getList($params = [], $orderBy = [], $p = 1, $limit = 10, $fied=['*'], $index=true) {
        $Common = new Common();
        $offset = $Common->getOffset($limit, $p);
        $userModel = new AdminUserModel();
        $userList = $userModel->getListData($params, $orderBy, $offset, $limit, $fied, $index);
        if(!empty($userList)) {
            return BaseService::returnOkData($userList);
        }
        return BaseService::returnErrData($userList, 500, "暂无数据");
    }
    /**
     * 获取用户基本信息数据
     * @param $params
     * @return array
     */
    public function getUserInfoByParams($params) {
        $userModel = new AdminUserModel();
        $userData = $userModel->getInfoByParams($params);
        if(!empty($userData)) {
            return BaseService::returnOkData($userData);
        }
        return BaseService::returnErrData($userData, 544500, "用户详情数据不存在");
    }
    /**
     * 根据条件更新用户详情数据模型接口
     * @param $params
     * @param $updateData
     * @return array
     */
    public function updateUserInfoByParams($params, $updateData) {
        if(empty($params) || empty($updateData)) {
            return BaseService::returnErrData([], 544100, "请求参数异常");
        }
        $userModel = new AdminUserModel();
        $updateInfoRet = $userModel->updateInfoByParams($params, $updateData);
        if($updateInfoRet) {
            return BaseService::returnOkData($updateInfoRet);
        }
        return BaseService::returnErrData($updateInfoRet, 55200, "更新失败");
    }
    /**
     * 编辑用户基本信息
     * @param $user_id
     * @param $updateData
     * @return array
     */
    public function editInfoDataByUserId($user_id, $updateData) {
        if(intval($user_id)<=0 || empty($updateData) || !is_array($updateData)) {
            return BaseService::returnErrData([], 537600, "请求参数异常");
        }
        $rest = $this->getAdminUserInfoByUserId($user_id);
        if(BaseService::checkRetIsOk($rest)) {
            $userInfoParams['id'] = $user_id;
            $getUserInfoRet = $this->getUserInfoByParams($userInfoParams);
            if(BaseService::checkRetIsOk($getUserInfoRet)) {
                return $this->updateUserInfoByParams($userInfoParams, $updateData);
            }
            return $getUserInfoRet;
        }
        return BaseService::returnErrData([], 537700, "该用户信息不存在");
    }
    /**
     * 修改密码
     * @param $user_id
     * @param $password
     * @param string $salt
     * @return array
     */
    public function editPwd($user_id, $password, $salt="") {
        $updateData['password'] = trim($password);
        $updateData['salt'] = trim($salt);
        return $this->editInfoDataByUserId($user_id, $updateData);
    }
    /**
     * 更新用户基本信息
     * @param $id
     * @param $updateData
     * @return array
     */
    public function updateInfo($id, $updateData) {
        if(!$id || empty($updateData)) {
            return BaseService::returnErrData([], 549900, "提交参数异常");
        }
        $userModel = new AdminUserModel();
        $updateData = $userModel->updateInfo($id, $updateData);
        if($updateData) {
            return BaseService::returnOkData($updateData);
        }
        return BaseService::returnErrData($updateData, 50900, "更新数据异常");
    }
    /**
     * 编辑管理员用户基本信息
     * @param $id
     * @param $username
     * @param $role_ids
     * @param string $password
     * @param string $mobile
     * @param string $email
     * @param string $nickname
     * @return array
     * @throws \yii\db\Exception
     */
    public function editUserInfo($id, $username, $role_ids, $password="", $mobile="", $email="",  $nickname="", $sex=0, $company="", $address="", $department_id=0) {
        if(empty($mobile) && Common::pregPhonNum($username)) {
            $mobile = $username;
        }
        $checkUsernameRet = $this->checkUsername($id, $username);
        if(!BaseService::checkRetIsOk($checkUsernameRet)) {
            return $checkUsernameRet;
        }
        $userData = [];
        if(!empty($password)) {
            $salt = Common::getRandChar(6);
            $password = Common::createPassword($password, $salt);
            if($password) {
                $userData['password'] = $password;
                $userData['salt'] = $salt;
            }
        }
        if($username) {
            $userData['username'] = $username;
        }
        if($email) {
            $userData['email'] = $email;
        }
        if($nickname) {
            $userData['nickname'] = $nickname;
        }
        if($mobile) {
            $userData['mobile'] = $mobile;
        }
        if($sex) {
            $userData['sex'] = $sex;
        }
        if($company) {
            $userData['company'] = $company;
        }
        if($address) {
            $userData['address'] = $address;
        }
        if($department_id) {
            $userData['department_id'] = $department_id;
        }
        if(empty($userData)) {
            return BaseService::returnErrData([], 554700, "提交用户数据不能为空");
        }
        $tr = Yii::$app->db->beginTransaction();
        $userUpdate = false;
        //获取用户名是否被占用
        //创建或者编辑用户信息
        if($id) {
            $updateInfoRet = $this->updateInfo($id, $userData);
            if(BaseService::checkRetIsOk($updateInfoRet)) {
                $userUpdate = true;
            }
        } else {
            $updateInfoRet = $this->addAdminUser($userData);
            if(BaseService::checkRetIsOk($updateInfoRet)) {
                $userUpdate = true;
                $id = BaseService::getRetData($updateInfoRet);
            }
        }
        $roleUpdate = true;
        if(!empty($role_ids)) {
            //创建或者编辑角色信息
            $adminUserRoleService = new AdminUserRoleService();
            $editUserRoleRet = $adminUserRoleService->editUserRole($id, $role_ids);
            if(!BaseService::checkRetIsOk($editUserRoleRet)){
                $roleUpdate = false;
            }
        }

        if($userUpdate && $roleUpdate){
            $tr->commit();
            return BaseService::returnOkData($role_ids);
        }
        $tr->rollBack();
        return BaseService::returnErrData([], 560000, "系统异常");
    }
    /**
     * 检测用户名是否可用
     * @param $user_id
     * @param $username
     * @return array
     */
    public function checkUsername($user_id,$username) {
        $userModel = new AdminUserModel();
        $params[] = ['!=', 'id', $user_id];
        $params[] = ['=', 'username', $username];
        $countNum = $userModel->getCount($params);
        if($countNum) {
            return BaseService::returnErrData($countNum, 58500, "该用户名已被使用");
        }
        return BaseService::returnOkData($countNum);
    }
}
