<?php
/**
 * 党组织相关的操作
 * @文件名称: OrganizationController.php
 * @author: jawei
 * @Email: gaozhiwei429@sina.com
 * @Date: 2017-12-06
 * @Copyright: 2017 北京往全包科技有限公司. All rights reserved.
 * 注意：本内容仅限于北京往全包科技有限公司内部传阅，禁止外泄以及用于其他的商业目的
 */
namespace appcomponents\modules\manage\controllers;
use appcomponents\modules\common\OrganizationService;
use source\controllers\ManageBaseController;
use source\libs\Common;
use source\manager\BaseService;
use \Yii;
class OrganizationController extends ManageBaseController
{
    /**
     * 用户登录态基础类验证
     * @return array
     */
    public function beforeAction($action)
    {
        $userToken = parent::userToken();
        $getMenuUrl = parent::getMenuUrl();
        return parent::beforeAction($action);
    }

    /**
     * 党组织管理
     * @return string
     */
    public function actionManage()
    {

        $page = intval(Yii::$app->request->post('p', 1));
        $size = intval(Yii::$app->request->post('size', -1));
        /*$organizationService = new OrganizationService();
        $params = [];
        $params[] = ['!=', 'status', 0];
        $ret = $organizationService->getTree($params, ['id'=>SORT_ASC], $page, $size, $fied=['*'], true);
        $treeData = BaseService::getRetData($ret);
        $arr = [];
        $arr = Common::treeToArr($treeData, $arr);*/
        return $this->renderPartial('manage',
            [
                'title' => "党组织管理",
//                'treeData' => $arr,
                'menuUrl' => $this->menuUrl,
            ]
        );
    }

    /**
     * 党组织管理
     * @return string
     */
    public function actionIndex()
    {
//        $this->layout=false;
        $uuid = trim(Yii::$app->request->get('uuid', null));
        $page = intval(Yii::$app->request->post('p', 1));
        $size = intval(Yii::$app->request->post('size', 20));
        $organizationService = new OrganizationService();
        $params[] = ['=', 'parent_uuid', $uuid];
        $organizationListRet = $organizationService->getList($params, ['id' => SORT_DESC, 'sort' => SORT_DESC], $page, $size);
        $organizationList = BaseService::getRetData($organizationListRet);
        $branchTypeArr = Yii::$app->params['branch_type'];
        $organizationTypeArr = Yii::$app->params['organization_type'];
        return $this->renderPartial('index',
            [
                'title' => "党组织管理",
                'uuid' => $uuid,
                'menuUrl' => $this->menuUrl,
                'organizationList' => $organizationList,
                'branchTypeArr' => $branchTypeArr,
                'organizationTypeArr' => $organizationTypeArr,
            ]
        );
    }
    /**
     * 党组织编辑
     * @return string
     */
    public function actionEdit() {
        $uuid = trim(Yii::$app->request->get('uuid', null));
        $parent_uuid = trim(Yii::$app->request->get('parent_uuid', null));
        $organizationService = new OrganizationService();
        $params = [];
        $params[] = ['!=', 'status', 0];
        $ret = $organizationService->getTree($params, ['id'=>SORT_ASC], 1, -1, $fied=['*'], true);
        $treeData = BaseService::getRetData($ret);
        $arr = [];
        $arr = Common::treeToArr($treeData, $arr);
        $infoParams[] = ['=', 'uuid', $uuid];
        $dataInfoRet = $organizationService->getInfo($infoParams);
        $dataInfo = BaseService::getRetData($dataInfoRet);

        $branchTypeArr = Yii::$app->params['branch_type'];
        $organizationTypeArr = Yii::$app->params['organization_type'];
        return $this->renderPartial('edit',
            [
                'title' => "党组织编辑",
                'treeData' => $arr,
                'uuid' => $uuid,
                'dataInfo' => $dataInfo,
                'parent_uuid' => isset($dataInfo['parent_uuid']) ? $dataInfo['parent_uuid'] : $parent_uuid,
                'branchTypeArr' => $branchTypeArr,
                'organizationTypeArr' => $organizationTypeArr,
            ]
        );
    }
}
