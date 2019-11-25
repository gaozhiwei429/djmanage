<?php
/**
 * 职务相关的操作
 * @文件名称: CmsController.php
 * @author: jawei
 * @Email: gaozhiwei429@sina.com
 * @Date: 2017-12-06
 * @Copyright: 2017 北京往全包科技有限公司. All rights reserved.
 * 注意：本内容仅限于北京往全包科技有限公司内部传阅，禁止外泄以及用于其他的商业目的
 */
namespace appcomponents\modules\manage\controllers;
use appcomponents\modules\common\LeadersService;
use appcomponents\modules\common\LevelService;
use source\controllers\ManageBaseController;
use source\manager\BaseService;
use \Yii;
class CmsController extends ManageBaseController
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
    public function actionLeaders() {
        return $this->renderPartial('leaders',
            [
                'title' => "党史人物管理",
                'menuUrl' => $this->menuUrl,
            ]
        );
    }
    public function actionLeadersEdit() {
        $id = intval(Yii::$app->request->get('id', 0));
        $bannerService = new LeadersService();
        $params = [];
        $params[] = ['=', 'id', $id];
        $dataInfoRet = $bannerService->getInfo($params);
//        var_dump(BaseService::getRetData($dataInfoRet));die;
        return $this->renderPartial('leaders-edit',
            [
                'title' => "党史人物编辑",
                'menuUrl' => $this->menuUrl,
                'dataInfo' => BaseService::getRetData($dataInfoRet),
            ]
        );
    }

    public function actionInfo() {
        $id = intval(Yii::$app->request->get('id', 0));
        $bannerService = new LevelService();
        $params = [];
        $params[] = ['=', 'id', $id];
        $bannerInfoRet = $bannerService->getInfo($params);
        return $this->renderPartial('info', [
                'title' => '职务详情',
                'menuUrl' => $this->menuUrl,
                'id' => $id,
                'info' => BaseService::getRetData($bannerInfoRet),
            ]
        );
    }

    public function actionEdit() {
        $id = intval(Yii::$app->request->get('id', 0));
        $bannerService = new LevelService();
        $params = [];
        $params[] = ['=', 'id', $id];
        $bannerInfoRet = $bannerService->getInfo($params);
        return $this->renderPartial('edit',
            [
                'title' => "职务编辑",
                'menuUrl' => $this->menuUrl,
                'dataInfo' => BaseService::getRetData($bannerInfoRet),
            ]
        );
    }
}
