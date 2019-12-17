<?php
/**
 * 试题批改相关的操作
 * @文件名称: UserExamController.php
 * @author: jawei
 * @Email: gaozhiwei429@sina.com
 * @Date: 2017-12-06
 * @Copyright: 2017 北京往全包科技有限公司. All rights reserved.
 * 注意：本内容仅限于北京往全包科技有限公司内部传阅，禁止外泄以及用于其他的商业目的
 */
namespace appcomponents\modules\manage\controllers;
use appcomponents\modules\common\ExamService;
use appcomponents\modules\common\UserExamService;
use source\controllers\ManageBaseController;
use source\manager\BaseService;
use \Yii;
class UserExamController extends ManageBaseController
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
                'title' => "用户答题记录管理",
                'menuUrl' => $this->menuUrl,
            ]
        );
    }
    /**
     * 答题记录详情
     * @return string
     */
    public function actionInfo() {
        $id = intval(Yii::$app->request->get('id', 0));
        $bannerService = new UserExamService();
        $params = [];
        $params[] = ['=', 'id', $id];
        $bannerInfoRet = $bannerService->getInfo($params);
        return $this->renderPartial('info', [
                'title' => '答题记录详情',
                'menuUrl' => $this->menuUrl,
                'id' => $id,
                'info' => BaseService::getRetData($bannerInfoRet),
            ]
        );
    }
    /**
     * 答题记录编辑
     * @return string
     */
    public function actionEdit() {
        $id = intval(Yii::$app->request->get('id', 0));
        $bannerService = new UserExamService();
        $params = [];
        $params[] = ['=', 'id', $id];
        $bannerInfoRet = $bannerService->getInfo($params);
        return $this->renderPartial('edit',
            [
                'title' => "答题记录编辑",
                'menuUrl' => $this->menuUrl,
                'dataInfo' => BaseService::getRetData($bannerInfoRet),
            ]
        );
    }
    /**
     * 答题记录批改
     * @return string
     */
    public function actionCorrection() {
        $id = intval(Yii::$app->request->get('id', 0));
        $bannerService = new UserExamService();
        $params = [];
        $params[] = ['=', 'id', $id];
        $bannerInfoRet = $bannerService->getInfo($params);
        return $this->renderPartial('correction',
            [
                'title' => "答题记录批改",
                'menuUrl' => $this->menuUrl,
                'dataInfo' => BaseService::getRetData($bannerInfoRet),
            ]
        );
    }
}
