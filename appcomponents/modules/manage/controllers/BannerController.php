<?php
/**
 * 订单相关的操作
 * @文件名称: OrderController.php
 * @author: jawei
 * @Email: gaozhiwei429@sina.com
 * @Date: 2017-12-06
 * @Copyright: 2017 北京往全包科技有限公司. All rights reserved.
 * 注意：本内容仅限于北京往全包科技有限公司内部传阅，禁止外泄以及用于其他的商业目的
 */
namespace appcomponents\modules\manage\controllers;
use appcomponents\modules\common\BannerService;
use source\controllers\ManageBaseController;
use source\manager\BaseService;
use \Yii;
class BannerController extends ManageBaseController
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
    public function actionIndex() {
        return $this->renderPartial('index',
            [
                'title' => "Banner管理",
                'menuUrl' => $this->menuUrl,
            ]
        );
    }

    public function actionInfo() {
        $id = intval(Yii::$app->request->get('id', 0));
        $bannerService = new BannerService();
        $params = [];
        $params[] = ['=', 'id', $id];
        $bannerInfoRet = $bannerService->getInfo($params);
        return $this->renderPartial('info', [
                'title' => 'Banner详情',
                'menuUrl' => $this->menuUrl,
                'id' => $id,
                'info' => BaseService::getRetData($bannerInfoRet),
            ]
        );
    }

    public function actionEdit() {
        $id = intval(Yii::$app->request->get('id', 0));
        $bannerService = new BannerService();
        $params = [];
        $params[] = ['=', 'id', $id];
        $bannerInfoRet = $bannerService->getInfo($params);
        return $this->renderPartial('edit',
            [
                'title' => "Banner编辑",
                'menuUrl' => $this->menuUrl,
                'id' => $id,
                'info' => BaseService::getRetData($bannerInfoRet),
            ]
        );
    }
}
