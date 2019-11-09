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
        $bannerService = new BannerService();
        if(empty($uuid)) {
            return BaseService::returnErrData([], 58000, "请求参数异常，请填写完整");
        }
        $dataInfo['uuid'] = $uuid;
        $dataInfo['status'] = $status;
        return $bannerService->editInfo($dataInfo);
    }
}
