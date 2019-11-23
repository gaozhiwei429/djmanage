<?php
/**
 * 组织相关的接口
 * @文件名称: OrganizationController.php
 * @author: jawei
 * @Email: gaozhiwei429@sina.com
 * @Mobile: 15910987706
 * @Date: 2018-12-01
 * @Copyright: 2017 北京往全保科技有限公司. All rights reserved.
 * 注意：本内容仅限于北京往全保科技有限公司内部传阅，禁止外泄以及用于其他的商业目的
 */
namespace appcomponents\modules\common\controllers;
use appcomponents\modules\common\OrganizationService;
use source\controllers\ManageBaseController;
use source\libs\Common;
use source\manager\BaseService;
use Yii;
class OrganizationController extends ManageBaseController
{
    public function beforeAction($action){
        $userToken = parent::userToken();
        if (!BaseService::checkRetIsOk($userToken)) {
            return $userToken;
        }
        return parent::beforeAction($action);
    }
    /**
     * 首页获取
     * @return array
     */
    public function actionGetList() {
        if (!isset($this->user_id) || !$this->user_id) {
            return BaseService::returnErrData([], 5001, "当前账号登陆异常");
        }
        $page = intval(Yii::$app->request->post('p', 1));
        $size = intval(Yii::$app->request->post('size', 10));
        $organizationService = new OrganizationService();
        $params = [];
//        $params[] = ['>=', 'create_time', date('Y-m-d H:i:s')];
//        $params[] = ['>=', 'overdue_time', date('Y-m-d H:i:s')];
        return $organizationService->getList($params, ['id'=>SORT_DESC,'sort'=>SORT_DESC], $page, $size);
    }

    /**
     * 详情数据获取
     * @return array
     */
    public function actionGetInfo() {
        if (!isset($this->user_id) || !$this->user_id) {
            return BaseService::returnErrData([], 5001, "当前账号登陆异常");
        }
        $id = intval(Yii::$app->request->post('id', 0));
        if(empty($id)) {
            return BaseService::returnErrData([], 54000, "请求参数异常");
        }
        $organizationService = new OrganizationService();
        $params = [];
        $params[] = ['=', 'id', $id];
        return $organizationService->getInfo($params);
    }
    /**
     * 详情数据状态编辑
     * @return array
     */
    public function actionSetStatus() {
        if (!isset($this->user_id) || !$this->user_id) {
            return BaseService::returnErrData([], 5001, "当前账号登陆异常");
        }
        $uuid = trim(Yii::$app->request->post('uuid', 0));
        $status = intval(Yii::$app->request->post('status',  0));
        $organizationService = new OrganizationService();
        if(empty($uuid)) {
            return BaseService::returnErrData([], 58000, "请求参数异常，请填写完整");
        }
        $dataInfo['uuid'] = $uuid;
        $dataInfo['status'] = $status;
        return $organizationService->editInfo($dataInfo);
    }
    /**
     * 详情数据状态编辑
     * @return array
     */
    public function actionSetSort() {
        if (!isset($this->user_id) || !$this->user_id) {
            return BaseService::returnErrData([], 5001, "当前账号登陆异常");
        }
        $uuid = trim(Yii::$app->request->post('uuid', 0));
        $sort = intval(Yii::$app->request->post('sort',  0));
        $organizationService = new OrganizationService();
        if(empty($uuid)) {
            return BaseService::returnErrData([], 58000, "请求参数异常，请填写完整");
        }
        $dataInfo['uuid'] = $uuid;
        $dataInfo['sort'] = $sort;
        return $organizationService->editInfo($dataInfo);
    }
    /**
     * 获取组织架构树
     * @return array
     */
    public function actionGetTree() {
        $organizationService = new OrganizationService();
        $params[] = ['!=', 'status', 0];
        return $organizationService->getDTree($params, ['id'=>SORT_ASC], 1, -1, $fied=['*'], true);
    }
    /**
     * 获取组织架构树
     * @return array
     */
    public function actionGetTreeData() {
        $organizationService = new OrganizationService();
        $params = [];
        $params[] = ['!=', 'status', -1];
        $ret = $organizationService->getTree($params, ['id'=>SORT_ASC], 1, -1, $fied=['*'], true);
        $treeData = BaseService::getRetData($ret);
        $arr = [];
        $arr = Common::treeToArr($treeData, $arr);
        return BaseService::returnOkData($arr);
//        return $organizationService->getDTree($params, ['id'=>SORT_ASC], 1, -1, $fied=['*'], true);
    }
    /**
     * 详情数据状态编辑
     * @return array
     */
    public function actionEdit() {
        if (!isset($this->user_id) || !$this->user_id) {
            return BaseService::returnErrData([], 5001, "当前账号登陆异常");
        }
        $uuid = trim(Yii::$app->request->post('uuid', 0));
        $status = intval(Yii::$app->request->post('status',  0));
        $sort = intval(Yii::$app->request->post('sort',  0));
        $title = trim(Yii::$app->request->post('title', ""));
        $content = trim(Yii::$app->request->post('content', ""));
        $parent_uuid = trim(Yii::$app->request->post('parent_uuid', 0));
        $organization_type = trim(Yii::$app->request->post('organization_type', ""));
        $branch_type = trim(Yii::$app->request->post('branch_type', ""));
        $organizationService = new OrganizationService();
        if(empty($title)) {
            return BaseService::returnErrData([], 513700, "标题不能为空");
        }
        if(empty($content)) {
            return BaseService::returnErrData([], 514000, "描述内容不能为空");
        }
        if(empty($organization_type)) {
            return BaseService::returnErrData([], 513700, "组织类型必选");
        }
        if(empty($branch_type)) {
            return BaseService::returnErrData([], 514000, "支部类型必选");
        }
        if($uuid) {
            $dataInfo['uuid'] = $uuid;
        }
        if($title) {
            $dataInfo['title'] = $title;
        }
        if($content) {
            $dataInfo['content'] = $content;
        }
        $dataInfo['status'] = $status;
        $dataInfo['sort'] = $sort;
        $dataInfo['parent_uuid'] = $parent_uuid;
        return $organizationService->editInfo($dataInfo);
    }
}
