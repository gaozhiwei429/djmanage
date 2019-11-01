<?php
/**
 * 新闻资讯相关的操作
 * @文件名称: NewsController.php
 * @author: jawei
 * @Email: gaozhiwei429@sina.com
 * @Date: 2017-12-06
 * @Copyright: 2017 北京往全包科技有限公司. All rights reserved.
 * 注意：本内容仅限于北京往全包科技有限公司内部传阅，禁止外泄以及用于其他的商业目的
 */
namespace appcomponents\modules\manage\controllers;
use appcomponents\modules\common\NewsService;
use source\controllers\ManageBaseController;
use source\manager\BaseService;
use \Yii;
class NewsController extends ManageBaseController
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
    /**
     * 新闻资讯列表
     * @return string
     */
    public function actionIndex() {
        return $this->renderPartial('index',
            [
                'title' => "新闻资讯管理",
                'menuUrl' => $this->menuUrl,
            ]
        );
    }
    /**
     * 新闻资讯详情
     * @return string
     */
    public function actionInfo() {
        $id = intval(Yii::$app->request->get('id', 0));
        $newsService = new NewsService();
        $params = [];
        $params[] = ['=', 'id', $id];
        $newsInfoRet = $newsService->getInfo($params);
        return $this->renderPartial('info', [
                'title' => '新闻资讯详情',
                'menuUrl' => $this->menuUrl,
                'id' => $id,
                'info' => BaseService::getRetData($newsInfoRet),
            ]
        );
    }
    /**
     * 新闻资讯编辑
     * @return string
     */
    public function actionEdit() {
        $id = intval(Yii::$app->request->get('id', 0));
        $newsService = new NewsService();
        $params = [];
        $params[] = ['=', 'id', $id];
        $newsInfoRet = $newsService->getInfo($params);
        return $this->renderPartial('edit',
            [
                'title' => "新闻资讯编辑",
                'menuUrl' => $this->menuUrl,
                'info' => BaseService::getRetData($newsInfoRet),
            ]
        );
    }
}
