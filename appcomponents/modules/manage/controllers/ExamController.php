<?php
/**
 * 职务相关的操作
 * @文件名称: ExamController.php
 * @author: jawei
 * @Email: gaozhiwei429@sina.com
 * @Date: 2017-12-06
 * @Copyright: 2017 北京往全包科技有限公司. All rights reserved.
 * 注意：本内容仅限于北京往全包科技有限公司内部传阅，禁止外泄以及用于其他的商业目的
 */
namespace appcomponents\modules\manage\controllers;
use appcomponents\modules\common\ExamService;
use source\controllers\ManageBaseController;
use source\manager\BaseService;
use \Yii;
class ExamController extends ManageBaseController
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
                'title' => "题库管理",
                'menuUrl' => $this->menuUrl,
            ]
        );
    }
    public function actionManage() {
        return $this->renderPartial('manage',
            [
                'title' => "试题管理",
                'menuUrl' => $this->menuUrl,
            ]
        );
    }
    /**
     * 题库详情
     * @return string
     */
    public function actionInfo() {
        $id = intval(Yii::$app->request->get('id', 0));
        $bannerService = new ExamService();
        $params = [];
        $params[] = ['=', 'id', $id];
        $bannerInfoRet = $bannerService->getInfo($params);
        return $this->renderPartial('info', [
                'title' => '题库详情',
                'menuUrl' => $this->menuUrl,
                'id' => $id,
                'info' => BaseService::getRetData($bannerInfoRet),
            ]
        );
    }

    public function actionEdit() {
        $id = intval(Yii::$app->request->get('id', 0));
        $bannerService = new ExamService();
        $params = [];
        $params[] = ['=', 'id', $id];
        $bannerInfoRet = $bannerService->getInfo($params);
        $dataInfo = BaseService::getRetData($bannerInfoRet);
        if(isset($dataInfo['types']) && !empty($dataInfo['types'])) {
            $dataInfo['types'] = json_decode($dataInfo['types'], true);
        }
        return $this->renderPartial('edit',
            [
                'title' => "题库编辑",
                'menuUrl' => $this->menuUrl,
                'dataInfo' => $dataInfo,
            ]
        );
    }
}
