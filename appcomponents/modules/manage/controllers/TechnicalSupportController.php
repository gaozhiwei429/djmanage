<?php
/**
 * 技术支持相关
 * @文件名称: TechnicalSupportController.php
 * @author: jawei
 * @Email: gaozhiwei429@sina.com
 * @Date: 2017-12-06
 * @Copyright: 2017 北京往全包科技有限公司. All rights reserved.
 * 注意：本内容仅限于北京往全包科技有限公司内部传阅，禁止外泄以及用于其他的商业目的
 */
namespace appcomponents\modules\manage\controllers;
use appcomponents\modules\common\TechnicalSupportService;
use appcomponents\modules\common\TechnicalSupportTypeService;
use source\controllers\ManageBaseController;
use source\manager\BaseService;
use \Yii;
class TechnicalSupportController extends ManageBaseController
{
    /**
     * 用户登录态基础类验证
     * @return array
     */
    public function beforeAction($action){
        $userToken = parent::userToken();
        $getMenuUrl = parent::getMenuUrl();
        return parent::beforeAction($action);
    }
    public function actionIndex() {
        return $this->renderPartial('index',
            [
                'title' => "技术支持内容管理",
                'menuUrl' => $this->menuUrl,
            ]
        );
    }
    public function actionTypeIndex() {
        return $this->renderPartial('type-index',
            [
                'title' => "技术支持分类管理",
                'menuUrl' => $this->menuUrl,
            ]
        );
    }

    public function actionInfo() {
        $technicalSupportTypeService = new TechnicalSupportTypeService();
        $technicalSupportTypeListDataRet =$technicalSupportTypeService->getList([], [], 1, 100);
        $technicalSupportTypeListData = BaseService::getRetData($technicalSupportTypeListDataRet);
        $technicalSupportTypeList = isset($technicalSupportTypeListData['dataList']) ? $technicalSupportTypeListData['dataList'] : [];
        $id = intval(Yii::$app->request->get('id', 0));
        $technical_support_type_id = intval(Yii::$app->request->get('technical_support_type_id', 0));
        $technicalSupportInfo = [];
        if($id>0) {
            $bindService = new TechnicalSupportService();
            $params[] = ['=', 'id', $id];
            $technicalSupportInfoRet = $bindService->getInfo($params);
            $technicalSupportInfo = BaseService::getRetData($technicalSupportInfoRet);
        }
        return $this->renderPartial('info', [
                'title' => '技术支持内容详情',
                'id' => $id,
                'info' => $technicalSupportInfo,
                'technical_support_type_id' => $technical_support_type_id,
                'technicalSupportTypeList' => $technicalSupportTypeList
            ]
        );
    }

    public function actionEdit() {
        $technicalSupportTypeService = new TechnicalSupportTypeService();
        $technicalSupportTypeListDataRet =$technicalSupportTypeService->getList([], [], 1, 100);
        $technicalSupportTypeListData = BaseService::getRetData($technicalSupportTypeListDataRet);
        $technicalSupportTypeList = isset($technicalSupportTypeListData['dataList']) ? $technicalSupportTypeListData['dataList'] : [];
        $id = intval(Yii::$app->request->get('id', 0));
        $technical_support_type_id = intval(Yii::$app->request->get('technical_support_type_id', 0));
        $technicalSupportInfo = [];
        if($id>0) {
            $bindService = new TechnicalSupportService();
            $params[] = ['=', 'id', $id];
            $technicalSupportInfoRet = $bindService->getInfo($params);
            $technicalSupportInfo = BaseService::getRetData($technicalSupportInfoRet);
        }
        return $this->renderPartial('edit',
            [
                'title' => "绑定编辑",
                'menuUrl' => $this->menuUrl,
                'info' => $technicalSupportInfo,
                'technical_support_type_id' => $technical_support_type_id,
                'technicalSupportTypeList' => $technicalSupportTypeList
            ]
        );
    }
}
