<?php
/**
 * 党员相关接口请求入口操作
 * @文件名称: DangyuanController.php
 * @author: jawei
 * @Email: gaozhiwei429@sina.com
 * @Date: 2017-12-06
 * @Copyright: 2017 北京往全包科技有限公司. All rights reserved.
 * 注意：本内容仅限于北京往全包科技有限公司内部传阅，禁止外泄以及用于其他的商业目的
 */
namespace appcomponents\modules\common\controllers;
use appcomponents\modules\common\DangyuanService;
use appcomponents\modules\common\UserOrganizationService;
use appcomponents\modules\passport\PassportService;
use source\controllers\ManageBaseController;
use source\manager\BaseService;
use Yii;
class DangyuanController extends ManageBaseController
{
    public function beforeAction($action){
        return parent::beforeAction($action);
    }
    /**
     * 数据列表获取
     * @return array
     */
    public function actionGetList() {
        $dangyuanService = new DangyuanService();
        $params = [];
        $p = intval(Yii::$app->request->post('p', 1));
        $size = intval(Yii::$app->request->post('size', 10));
        $organization_id = intval(Yii::$app->request->get('organization_id', 0));
        if($organization_id) {
            $params[] = ['=', 'organization_id', $organization_id];
        }
        $params[] = ['=','status',1];
        return $dangyuanService->getList($params, ['id'=>SORT_DESC], $p, $size,
            ['id','user_id','organization_id','level_id'],
            ['user_id']);
    }
    /**
     * 添加组织党员数据
     * @return array
     */
    public function actionEdit20191213() {
        if (!isset($this->user_id) || !$this->user_id) {
            return BaseService::returnErrData([], 5001, "当前账号登陆异常");
        }
        $id = intval(Yii::$app->request->post('id', 0));
        $apply_organization_date = trim(Yii::$app->request->post('apply_organization_date', ""));//申请入党时间
        $avatar_img = trim(Yii::$app->request->post('avatar_img', ""));//头像
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
        $post = Yii::$app->request->post();
        $departmentPattern = '/department/i';     //errorType Array为开头 结尾字符串
        $levelPattern = '/level/i';     //errorType Array为开头 结尾字符串
        $organizationIds = [];
        $levelIds = [];
        foreach($post as $postKey=>$postData) {
            if(preg_match($departmentPattern, $postKey)) {
                $organizationIds[] = $postData;
            }
            if(preg_match($levelPattern, $postKey)) {
                $levelIds[] = $postData;
            }
        }
        if(empty($organizationIds)) {
            return BaseService::returnErrData([], 510600, "请给该账户至少分配一个党组织");
        }
        if(empty($levelIds)) {
            return BaseService::returnErrData([], 510900, "请给该账户所属党组织分配职务");
        }
        if(count($organizationIds) != count($levelIds)) {
            return BaseService::returnErrData([], 511200, "请核实党组织职务是否选择");
        }
        $dangyuanService = new DangyuanService();
        return $dangyuanService->editOrganizationDangyuan($mobile, $password, $userInfoData, $organizationIds, $levelIds);
    }
    /**
     * 添加组织党员数据
     * @return array
     */
    public function actionEdit() {
        if (!isset($this->user_id) || !$this->user_id) {
            return BaseService::returnErrData([], 5001, "当前账号登陆异常");
        }
        $organization_id = intval(Yii::$app->request->post('organization_id', 0));
        $userInfoData = [];
        $post = Yii::$app->request->post();
        $departmentPattern = '/department/i';     //errorType Array为开头 结尾字符串
        $levelPattern = '/level/i';     //errorType Array为开头 结尾字符串
        $mobilePattern = '/mobile/i';     //errorType Array为开头 结尾字符串
        $organizationIds = [];
        $levelIds = [];
        $mobiles = [];
        foreach($post as $postKey=>$postData) {
            if(preg_match($departmentPattern, $postKey)) {
                if($postData!=$organization_id) {
                    return BaseService::returnErrData([], 514000, "党组织必须选择，或选择信息有误请检查");
                }
                $organizationIds[] = $postData;
            }
            if(preg_match($levelPattern, $postKey)) {
                $levelIds[] = $postData;
            }
            if(preg_match($mobilePattern, $postKey)) {
                $mobiles[] = $postData;
            }
        }
        if(empty($mobiles) || empty($levelIds) || empty($organizationIds)) {
            return BaseService::returnErrData([], 515600, "提交信息不能为空");
        }
        $mobiles = array_unique($mobiles);
        $levelIds = array_unique($levelIds);
        if(empty($organizationIds)) {
            return BaseService::returnErrData([], 510600, "请给该账户至少分配一个党组织");
        }
        if(empty($levelIds)) {
            return BaseService::returnErrData([], 510900, "请给该账户所属党组织分配职务");
        }
        if(count($organizationIds) != count($levelIds)) {
            return BaseService::returnErrData([], 511200, "请核实党组织职务是否选择");
        }
        if(count($mobiles) != count($levelIds) || count($mobiles) != count($organizationIds) ) {
            return BaseService::returnErrData([], 511200, "请为每一个输入的账号选择党组织并分配职务,账号不能重复");
        }
        $passportService = new PassportService();
        $getUserIdsRet = $passportService->getUserIdsByUserName($mobiles, true);
        if(!BaseService::checkRetIsOk($getUserIdsRet)) {
            return $getUserIdsRet;
        }
        $getUserIds = BaseService::getRetData($getUserIdsRet);
        $dangyuanData = [];
        if(!empty($getUserIds) && is_array($getUserIds)) {
            foreach($mobiles as $k=>$mobile) {
                if(isset($getUserIds[$mobile]) && !empty($getUserIds[$mobile])) {
                    $dangyuanData[] = [
                        'user_id'=> intval($getUserIds[$mobile]) ? $getUserIds[$mobile] : 0,
                        'organization_id'=> intval($organizationIds[$k]) ? $organizationIds[$k] : 0,
                        'level_id'=> intval($levelIds[$k]) ? $levelIds[$k] : 0,
                        'status'=> 1,
                    ];
                }
            }
        }
        if(!empty($dangyuanData)) {
            $userOrganizationService = new UserOrganizationService();
            return $userOrganizationService->addDatas($dangyuanData);
        }
        return BaseService::returnErrData([], 519300, "添加党组织失败");
    }
    /**
     * 检测一个账号是否可以添加党组织关系
     * @return array|mixed
     */
    public function actionCheckIsAdd() {
        $username = trim(Yii::$app->request->post('username', ""));
        $organization_id = intval(Yii::$app->request->post('organization_id', ""));//申请入党时间
        if(empty($username) || empty($organization_id)) {
            return BaseService::returnErrData([], 513000, "请求参数异常");
        }
        $passportService = new PassportService();
        $passportDataInfoRet = $passportService->getUserDataInfoByUserName($username);
        if(BaseService::checkRetIsOk($passportDataInfoRet)) {
            $passportDataInfo = BaseService::getRetData($passportDataInfoRet);
            $userId = isset($passportDataInfo['id']) ? $passportDataInfo['id'] : 0;
            if($userId) {
                $userOrgationService = new UserOrganizationService();
                $userOrgationParams[] = ['=', 'user_id', $userId];
                $userOrgationParams[] = ['=', 'organization_id', $organization_id];
                $userOrgationParams[] = ['!=', 'status', 0];
                $userOrgationInfoRet = $userOrgationService->getInfo($userOrgationParams);
                if(!BaseService::checkRetIsOk($userOrgationInfoRet)) {
                    return BaseService::returnOkData([]);
                }
                return BaseService::returnErrData([], 514200, "当前账号已添加党组织关系");
            }
            return BaseService::returnErrData([], 514600, "当前数据不存在");
        }
        return $passportDataInfoRet;
    }
}
