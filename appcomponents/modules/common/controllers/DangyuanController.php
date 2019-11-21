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
        return $dangyuanService->getList($params, ['id'=>SORT_DESC], $p, $size,['*']);
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
}
