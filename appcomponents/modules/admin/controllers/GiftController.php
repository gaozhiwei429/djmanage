<?php
/**
 * 献花相关的分类操作
 * @文件名称: GiftController
 * @author: jawei
 * @Email: gaozhiwei429@sina.com
 * @Date: 2017-12-06
 * @Copyright: 2017 北京往全包科技有限公司. All rights reserved.
 * 注意：本内容仅限于北京往全包科技有限公司内部传阅，禁止外泄以及用于其他的商业目的
 */
namespace appcomponents\modules\admin\controllers;
use appcomponents\modules\common\GiftIconService;
use source\controllers\ManageBaseController;
use source\manager\BaseService;
use \Yii;
class GiftController extends ManageBaseController
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
    /**
     * 资讯分类
     * @return string
     */
    public function actionIndex() {
        return $this->renderPartial('index',
            [
                'title' => "献花管理",
                'menuUrl' => $this->menuUrl,
            ]
        );
    }
    /**
     * 新资讯分类详情
     * @return string
     */
    public function actionInfo() {
        $id = intval(Yii::$app->request->get('id', 0));
        $newsService = new GiftIconService();
        $params = [];
        $params[] = ['=', 'id', $id];
        $newsInfoRet = $newsService->getInfo($params);
        return $this->renderPartial('info', [
                'title' => '献花详情',
                'menuUrl' => $this->menuUrl,
                'info' => BaseService::getRetData($newsInfoRet),
            ]
        );
    }
    /**
     * 资讯分类编辑
     * @return string
     */
    public function actionEdit() {
        $id = intval(Yii::$app->request->get('id', 0));
        $newsService = new GiftIconService();
        $params = [];
        $params[] = ['=', 'id', $id];
        $newsInfoRet = $newsService->getInfo($params);
        return $this->renderPartial('edit',
            [
                'title' => "献花详情编辑",
                'menuUrl' => $this->menuUrl,
                'info' => BaseService::getRetData($newsInfoRet),
            ]
        );
    }
}
