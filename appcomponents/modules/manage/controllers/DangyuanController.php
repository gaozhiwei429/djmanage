<?php
/**
 * 党员相关的操作
 * @文件名称: DangyuanController.php
 * @author: jawei
 * @Email: gaozhiwei429@sina.com
 * @Date: 2017-12-06
 * @Copyright: 2017 北京往全包科技有限公司. All rights reserved.
 * 注意：本内容仅限于北京往全包科技有限公司内部传阅，禁止外泄以及用于其他的商业目的
 */
namespace appcomponents\modules\manage\controllers;
use appcomponents\modules\common\BannerService;
use appcomponents\modules\common\DangyuanService;
use appcomponents\modules\common\LevelService;
use appcomponents\modules\common\OrganizationService;
use appcomponents\modules\passport\PassportService;
use source\controllers\ManageBaseController;
use source\libs\Common;
use source\manager\BaseService;
use \Yii;
class DangyuanController extends ManageBaseController
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
    public function actionManage() {
        $organization_id = intval(Yii::$app->request->get('organization_id', 0));
        return $this->renderPartial('manage',
            [
                'title' => "党员管理",
                'organization_id' => $organization_id,
                'hostInfo' => Yii::$app->request->hostInfo,
                'menuUrl' => $this->menuUrl,
            ]
        );
    }
    public function actionIndex() {
        $organization_id = intval(Yii::$app->request->get('organization_id', 0));
        $dep_name = trim(Yii::$app->request->get('dep_name', "全部"));
        return $this->renderPartial('index',
            [
                'title' => "党员管理",
                'hostInfo' => Yii::$app->request->hostInfo,
                'organization_id' => $organization_id,
                'dep_name' => $dep_name,
                'menuUrl' => $this->menuUrl,
            ]
        );
    }
    /**
     * 党员详情
     * @return string
     */
    public function actionInfo() {
        $id = intval(Yii::$app->request->get('id', 0));
        $bannerService = new DangyuanService();
        $params = [];
        $params[] = ['=', 'id', $id];
        $bannerInfoRet = $bannerService->getInfo($params);
        return $this->renderPartial('info', [
                'title' => '党员详情',
                'hostInfo' => Yii::$app->request->hostInfo,
                'menuUrl' => $this->menuUrl,
                'id' => $id,
                'info' => BaseService::getRetData($bannerInfoRet),
            ]
        );
    }

    public function actionEdit() {
        //组织树形结构数据
        $organizationService = new OrganizationService();
        $params = [];
        $params[] = ['!=', 'status', 0];
        $ret = $organizationService->getTree($params, ['id'=>SORT_ASC], 1, -1, $fied=['*'], true);
        $treeData = BaseService::getRetData($ret);
        $arr = [];
        $arr = Common::treeToArr($treeData, $arr);
        //职务数据获取
        $levelService = new LevelService();
        $levelDataRet = $levelService->getList([], ['id'=>SORT_ASC], 1, -1, $fied=['*']);
        $levelDataList = BaseService::getRetData($levelDataRet);

        $id = intval(Yii::$app->request->get('id', 0));
        $organization_id = intval(Yii::$app->request->get('organization_id', 0));
        $bannerService = new BannerService();
        $params = [];
        $params[] = ['=', 'id', $id];
        $bannerInfoRet = $bannerService->getInfo($params);
        return $this->renderPartial('edit',
            [
                'title' => "党员信息",
                'menuUrl' => $this->menuUrl,
                'hostInfo' => Yii::$app->request->hostInfo,
                'id' => $id,
                'organization_id' => $organization_id,
                'treeData' => $arr,
                'levelData' => isset($levelDataList['dataList']) ? $levelDataList['dataList'] : [],
                'info' => BaseService::getRetData($bannerInfoRet),
            ]
        );
    }
    /**
     * 党员列表数据获取
     * @return string
     */
    public function actionList() {
        $organization_id = intval(Yii::$app->request->get('organization_id', 0));
        $userIds = trim(Yii::$app->request->get('userIds', ""));
        $full_name_list = "";
        if($userIds) {
            $passportSrvice = new PassportService();
            $userInfoParams = [];
            $userInfoParams[] = ['in', 'user_id', explode(',',$userIds)];
            $passportListRet = $passportSrvice->getUserInfoList($userInfoParams, [], 1, -1, ['full_name','user_id']);
            $passportListData = BaseService::getRetData($passportListRet);
            if(isset($passportListData['dataList']) && !empty($passportListData['dataList'])) {
                foreach($passportListData['dataList'] as $info) {
                    $full_name_list.=$info['full_name'].",";
                }
            }
        }
        return $this->renderPartial('list',
            [
                'title' => "党员列表",
                'organization_id' => $organization_id,
                'userIds' => $userIds,
                'full_name_list' => $full_name_list,
                'menuUrl' => $this->menuUrl,
            ]
        );
    }
}
