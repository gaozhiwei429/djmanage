<?php
/**
 * 用户相关接口请求入口操作
 * @文件名称: UserController.php
 * @author: jawei
 * @Email: gaozhiwei429@sina.com
 * @Date: 2017-12-06
 * @Copyright: 2017 北京往全包科技有限公司. All rights reserved.
 * 注意：本内容仅限于北京往全包科技有限公司内部传阅，禁止外泄以及用于其他的商业目的
 */
namespace appcomponents\modules\passport\controllers;
use appcomponents\modules\common\SmsService;
use appcomponents\modules\passport\PassportService;
use source\controllers\UserBaseController;
use source\libs\Common;
use source\manager\BaseService;
use Yii;
class UserController extends UserBaseController {
    /**
     * 用户登录态基础类验证
     * @return array
     */
    public function beforeAction($action){
        $this->noLogin = false;
        $userToken = $this->userToken();
        return parent::beforeAction($action);
    }
    /**
     * 获取用户列表信息
     * @return array
     */
    public function actionGetList() {
        if (!isset($this->user_id) || !$this->user_id) {
            return BaseService::returnErrData([], 5001, "当前账号登陆异常");
        }
        $page = intval(Yii::$app->request->post('p', 1));
        $size = intval(Yii::$app->request->post('size', 10));
        $newsService = new PassportService();
        $params = [];
        return $newsService->getListRmoveIndex($params, ['id'=>SORT_DESC], $page, $size,['*'], true, true);
    }
    /**
     * 详情数据状态编辑
     * @return array
     */
    public function actionSetStatus() {
        if (!isset($this->user_id) || !$this->user_id) {
            return BaseService::returnErrData([], 5001, "当前账号登陆异常");
        }
        $id = intval(Yii::$app->request->post('id', 0));
        $status = intval(Yii::$app->request->post('status',  0));
        $bannerService = new PassportService();
        if(empty($id)) {
            return BaseService::returnErrData([], 58000, "请求参数异常，请填写完整");
        }
        $dataInfo['status'] = $status;
        return $bannerService->updateInfoById($id, $dataInfo);
    }
    /**
     * 用户登陆接口
     * @return array|mixed
     */
    public function actionLogin() {
        $username = trim(Yii::$app->request->post('username', null));
        $password = trim(Yii::$app->request->post('password', null));
        $source = intval(Yii::$app->request->post('source', 0));
        $device_code = trim(Yii::$app->request->post('device_code', ""));
        $version = trim(Yii::$app->request->post('version', 1.0));
        if(!empty($username)) {
            $passportService = new PassportService();
            return $passportService->login($username, $password, $source, $version, $device_code);
        }
        return BaseService::returnErrData([], 500, "用户名或密码不能为空");
    }

    /**
     * 用户登陆接口
     * @return array|mixed
     */
    public function actionLoginByCode() {
        $username = trim(Yii::$app->request->post('username', null));
        $mobileCode = trim(Yii::$app->request->post('mobileCode', null));
        $source = intval(Yii::$app->request->post('source', 0));
        $device_code = trim(Yii::$app->request->post('device_code', ""));
        $version = trim(Yii::$app->request->post('version', 1.0));
        if(empty($mobileCode)) {
            return BaseService::returnErrData([], 56100, "短信验证码不能为空");
        }
        if(empty($username)) {
            return BaseService::returnErrData([], 56100, "短信验证码不能为空");
        }

        $smsService = new SmsService();
        $smsRet = $smsService->verifyCode($username, $mobileCode);
        if(!BaseService::checkRetIsOk($smsRet)) {
            return $smsRet;
        }
        $passportService = new PassportService();
        return $passportService->loginByUsername($username, $source, $version, $device_code);
    }
    /**
     * 用户注册接口
     * @return array
     */
    public function actionRegister() {
        $username = trim(Yii::$app->request->post('username', null));
        $password = trim(Yii::$app->request->post('password', null));
        $mobileCode = trim(Yii::$app->request->post('mobileCode', null));
        $source = intval(Yii::$app->request->post('source', 1));
        $version = trim(Yii::$app->request->post('version', 1.0));
        if(empty($username) || empty($password)){
            return BaseService::returnErrData([], "55500", "用户名密码不能为空");
        }
        if(empty($mobileCode)){
            return BaseService::returnErrData([], "56000", "短信验证码不能为空");
        }
        $smsService = new SmsService();
        $ret = $smsService->verifyCode($username, $mobileCode);
        if(!BaseService::checkRetIsOk($ret)) {
            return $ret;
        }
        if(!empty($username) && !empty($password)) {
            $passportService = new PassportService();
            return $passportService->register($username, $password, $source, $version);
        }
        return BaseService::returnErrData([], 500, "用户名或密码不能为空");
    }
    /**
     * 检查用户名是否已注册
     * @return mixed
     */
    public function actionCheckExist() {
        $username = trim(Yii::$app->request->post('username', null));
        $passportService = new PassportService();
        return $passportService->checkUserExist($username);
    }
    /**
     * 获取当前登陆用户id
     * @return mixed
     */
    public function actionGetUserInfo() {
        if(!isset($this->user_id) || !$this->user_id) {
            return BaseService::returnErrData([], 5001, "当前账号登陆异常");
        }
        $passportService = new PassportService();
        return $passportService->getUserInfoByUserId($this->user_id);
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
        $type = isset(Yii::$app->params['user']['type']) ? Yii::$app->params['user']['type'] : 0;
        if(!$this->user_id) {
            return BaseService::returnErrData([], 58500, "请求参数异常");
        }
        if(!$type) {
            return BaseService::returnErrData([], 58800, "系统配置异常");
        }
        $passportService = new PassportService();
        return $passportService->logout($this->user_id, $type);
    }
    /**
     * 找回密码
     * @return array|mixed
     */
    public function actionRetrievePwd() {
        $username = trim(Yii::$app->request->post('username', null));
        $mobileCode = trim(Yii::$app->request->post('mobileCode', null));
        //检查是否是手机号
        $checkMobile = Common::pregPhonNum($username);
        if(!$checkMobile) {
            return BaseService::returnErrData([], 500, '请输入正确的手机号');
        }
        if(empty($mobileCode)) {
            return BaseService::returnErrData([], 500, '验证码不能为空');
        }
        $smsService = new SmsService();
        $smsRet = $smsService->verifyCode($username, $mobileCode);
        if(BaseService::checkRetIsOk($smsRet)) {
            $passportService = new PassportService();
            $userInfoRet = $passportService->getUserDataInfoByUserName($username);
            $userInfo = BaseService::getRetData($userInfoRet);
            if(!empty($userInfo)) {
                $user_id = isset($userInfo['id']) ? $userInfo['id'] : 0;
                if($user_id) {
                    //保存登录状态
                    $token = Common::getRandChar(32);
                    return $passportService->saveLoginToken($user_id, $token);
                }
            }
            return BaseService::returnErrData([], 512000, "找回密码失败");
        }
        return $smsRet;
    }
    /**
     * 修改密码
     * @return array
     */
    public function actionRestPwd() {
        if(!isset($this->user_id) || !$this->user_id) {
            return BaseService::returnErrData([], 5001, "当前账号登陆异常");
        }
        $password = trim(Yii::$app->request->post('password', null));
        $verifypassword = trim(Yii::$app->request->post('verifypassword', null));
        if(empty($password)) {
            return BaseService::returnErrData([], 514000, "新密码不能为空");
        }
        if(empty($verifypassword)) {
            return BaseService::returnErrData([], 514000, "确认密码不能为空");
        }
        if($password != $verifypassword) {
            return BaseService::returnErrData([], 514300, "两个密码不相同，请重新输入");
        }
        if(!isset($this->user_id) || !$this->user_id) {
            return BaseService::returnErrData([], 5001, "当前账号登陆异常");
        }
        $passportService = new PassportService();
        return $passportService->resetPwd($this->user_id, $password);
    }
    /**
     * 编辑用户基本信息数据
     * @return array|mixed
     */
    public function actionEditInfo() {
        if(!isset($this->user_id) || !$this->user_id) {
            return BaseService::returnErrData([], 5001, "当前账号登陆异常");
        }
        $nickname = trim(Yii::$app->request->post('nickname', ""));
        $avatar_img = trim(Yii::$app->request->post('avatar_img', ""));
        $sex = intval(Yii::$app->request->post('sex', 0));
        $birthdate = trim(Yii::$app->request->post('birthdate', date('Y-m-d')));
//        $mail = trim(Yii::$app->request->post('mail', ""));
//        $qq = trim(Yii::$app->request->post('qq', ""));
//        $wchat = trim(Yii::$app->request->post('wchat', ""));
        $passportService = new PassportService();
        $updateUserData = [];
        if($nickname) {
            $updateUserData['nickname'] = $nickname;
        }
        if($avatar_img) {
            $updateUserData['avatar_img'] = $avatar_img;
        }
        if($sex) {
            $updateUserData['sex'] = $sex;
        }
        if($birthdate) {
            $dateArr1 = explode("\"", $birthdate);
            if(count($dateArr1)>=3) {
                $updateUserData['birthdate'] = date('Y-m-d', strtotime($dateArr1[1]));
            } else {
                $dateArr = explode('T',$birthdate);
                if(isset($dateArr[0])) {
                    $updateUserData['birthdate'] = $dateArr[0];
                } else {
                    $updateUserData['birthdate'] = date('Y-m-d', strtotime($birthdate));
                }
            }
        }
//        if($mail) {
//            $updateUserData['mail'] = $mail;
//        }
//        if($qq) {
//            $updateUserData['qq'] = $qq;
//        }
//        if($wchat) {
//            $updateUserData['wchat'] = $wchat;
//        }
        if(empty($updateUserData)) {
            return BaseService::returnErrData([], 520900, "提交信息不能为空");
        }
        return $passportService->editInfoDataByUserId($this->user_id, $updateUserData);
    }
    /**
     * 邮箱认证提交
     * @return array
     */
    public function actionSubmitAuthEmail() {
        if(!isset($this->user_id) || !$this->user_id) {
            return BaseService::returnErrData([], 5001, "当前账号登陆异常");
        }
        $email = trim(Yii::$app->request->post('email', ""));
        if(!Common::verifyEmail($email)) {
            return BaseService::returnErrData([], 523900, "提交的邮箱格式有误");
        }
        if($this->user_id) {
            $mailService = new MailService();
            $passportService = new PassportService();
            $userTokenParams[] = ['=', 'user_id', $this->user_id];
            $userTokenRet = $passportService->getUserTokenByparams($userTokenParams);
            if(BaseService::checkRetIsOk($userTokenRet)){
                $userTokenInfo = BaseService::getRetData($userTokenRet);
                $userInfoRet = $passportService->getUserInfoByUserId($this->user_id);
                $userInfo = BaseService::getRetData($userInfoRet);
                $token = isset($userTokenInfo['token']) ? $userTokenInfo['token'] : "";
                $nickname = isset($userInfo['nickname']) ? $userInfo['nickname'] : "";
                //是否过期时间
                $key = Yii::$app->params['rediskey']['userAuth']['email'].":".$token;
                $emailExpire = Yii::$app->params['rediskey']['userAuth']['emailExpire'];//过期时间
                Yii::$app->cache->set($key, $this->user_id, $emailExpire);
                $userInfoParams['user_id'] = $this->user_id;
                $updateUserInfo['email'] = $email;
                $updateUserInfo['is_auth_email'] = 0;
                $passportService->updateUserInfoModelByParams($userInfoParams, $updateUserInfo);
                return $mailService->send($email, "", "authEmail",[
                    'username'=>$nickname,
                    'token'=>$token
                ]);
            }
            return BaseService::returnOkData($email);
        }
        return BaseService::returnErrData([], 525500, "请求认证参数异常");
    }
    /**
     * 邮箱认证点击
     */
    public function actionAuthEmail() {
        $token = trim(Yii::$app->request->get('token', ""));
        $isAuth = 0;
        if($token) {
            $params[] = ['=', 'token', $token];
            $passportService = new PassportService();
            $userTokenRet = $passportService->getUserTokenByparams($params);
            if(BaseService::checkRetIsOk($userTokenRet)){
                $userTokenInfo = BaseService::getRetData($userTokenRet);
                $user_id = isset($userTokenInfo['user_id']) ? $userTokenInfo['user_id'] : 0;
                $userInfoParams[] = ['=', 'user_id', $user_id];
                $userInfoRet = $passportService->getUserInfoByParams($userInfoParams);
                $userInfo = BaseService::getRetData($userInfoRet);
                if(isset($userInfo['is_auth_email']) && $userInfo['is_auth_email']==1) {
                    die("已认证，不能重复认证");
                }
                //是否过期时间
                $key = Yii::$app->params['rediskey']['userAuth']['email'].":".$token;
                $ret = Yii::$app->cache->get($key);
                if($ret == $user_id) {
                    $userUserInfoParams['user_id'] = $user_id;
                    $updateUserInfo['is_auth_email'] = 1;
                    $updateUserInfoRet = $passportService->updateUserInfoModelByParams($userUserInfoParams, $updateUserInfo);
                    if(BaseService::checkRetIsOk($updateUserInfoRet)) {
                        $isAuth = 1;
                    }
                }
            }
            if($isAuth) {
                die("恭喜您！认证成功");
            }
        }
        die("抱歉！认证邮件已过期或认证失败，请您重新提交认证");
    }

    /**
     * 获取某个用户的登陆状态
     * @return array
     */
    public function actionGetUserToken() {
        if(!isset($this->user_id) || !$this->user_id) {
            return BaseService::returnOkData([], "当前账号登陆异常");
        }
        $user_id = intval(Yii::$app->request->post('user_id', 0));
        if($user_id<=0) {
//            return BaseService::returnErrData([], 5114, "请求参数异常");
            return BaseService::returnOkData([], "请求参数异常");
        }
        $passportService = new PassportService();
        return $passportService->GetUserToken($user_id);
    }
    /**
     * 用户扫码登陆接口
     * @return array|mixed
     */
    public function actionQrcodeLogin() {
        // 返回 Accept header 值
        $headers = Yii::$app->request->headers;
        $userid = $headers->get('userid', Yii::$app->request->post('userid', 0));
        $token = $headers->get('token', Yii::$app->request->post('token', null));
        $device_code = trim(Yii::$app->request->post('device_code', ""));//设备号
        $source = intval(Yii::$app->request->post('source', 4));
        $version = trim(Yii::$app->request->post('version', 1.0));
        if(!empty($device_code) && !empty($userid) && !empty($token) && !empty($version)) {
            $passportService = new PassportService();
            return $passportService->qrcodeLogin($userid, $token, $device_code, $source);
        }
        return BaseService::returnErrData([], 533300, "请求参数异常");
    }
    /**
     * 添加组织党员数据
     * @return array
     */
    public function actionEdit() {
        if (!isset($this->user_id) || !$this->user_id) {
            return BaseService::returnErrData([], 5001, "当前账号登陆异常");
        }
        $id = intval(Yii::$app->request->post('id', 0));
        $apply_organization_date = trim(Yii::$app->request->post('apply_organization_date', ""));//申请入党时间
        $avatar_img = trim(Yii::$app->request->post('avatar_img', ""));//头像
        $nickname = trim(Yii::$app->request->post('nickname', ""));//头像
        $password = trim(Yii::$app->request->post('password', ""));//密码
        $confirm_password = trim(Yii::$app->request->post('confirm_password', ""));//密码
        $education = intval(Yii::$app->request->post('education', 0));//学历
        $join_organization_date = trim(Yii::$app->request->post('join_organization_date', ""));//入党时间
        $nation = trim(Yii::$app->request->post('nation', ""));//民族
        $native_place = trim(Yii::$app->request->post('native_place', ""));//归属地
        $full_name = trim(Yii::$app->request->post('full_name', ""));//姓名
        $sex = intval(Yii::$app->request->post('sex', 0));
        $status = intval(Yii::$app->request->post('status', 0));
        $user_status = intval(Yii::$app->request->post('user_status', 0));
        $work_status = intval(Yii::$app->request->post('work_status', 0));
        $mobile = trim(Yii::$app->request->post('mobile', ""));
        $userInfoData = [];
        if($id) {
            $userInfoData['id'] = $id;
        }
        if($apply_organization_date) {
            $userInfoData['apply_organization_date'] = $apply_organization_date;
        }
        if($join_organization_date) {
            $userInfoData['join_organization_date'] = $join_organization_date;
        }
        if($avatar_img) {
            $userInfoData['avatar_img'] = $avatar_img;
        }
        if($nation) {
            $userInfoData['nation'] = $nation;
        }
        if($native_place) {
            $userInfoData['native_place'] = $native_place;
        }
        if($full_name) {
            $userInfoData['full_name'] = $full_name;
        }
        if($nickname) {
            $userInfoData['nickname'] = $nickname;
        }
        if(empty($userInfoData)) {
            return BaseService::returnErrData([], 58300, "提交数据有误！");
        }
        if($password != $confirm_password) {
            return BaseService::returnErrData([], 58600, "密码输入有误！");
        }
        $userInfoData['education'] = $education;
        $userInfoData['sex'] = $sex;
        $userInfoData['status'] = $status;
        $userInfoData['user_status'] = $user_status;
        $userInfoData['work_status'] = $work_status;
        $dangyuanService = new PassportService();
        return $dangyuanService->editUserData($mobile, $password, $userInfoData);
    }
}
