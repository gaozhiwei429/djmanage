<?php
/**
 * 问题相关的操作
 * @文件名称: QuestionController.php
 * @author: jawei
 * @Email: gaozhiwei429@sina.com
 * @Date: 2017-12-06
 * @Copyright: 2017 北京往全包科技有限公司. All rights reserved.
 * 注意：本内容仅限于北京往全包科技有限公司内部传阅，禁止外泄以及用于其他的商业目的
 */
namespace appcomponents\modules\manage\controllers;
use appcomponents\modules\common\QuestionService;
use source\controllers\ManageBaseController;
use source\manager\BaseService;
use \Yii;
class QuestionController extends ManageBaseController
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
                'title' => "考题管理",
                'menuUrl' => $this->menuUrl,
            ]
        );
    }
    public function actionList() {
        $questionIds = trim(Yii::$app->request->get('questionIds', null));
        $type = intval(Yii::$app->request->get('type', null));
        if(!empty($questionIds)) {
            $questionIds = implode(',', array_unique(array_filter(explode(',', $questionIds))));
        } else {
            $cookies = Yii::$app->request->cookies;//注意此处是request
            $questionIds = $cookies->get('checkbox');//设置默认值
        }
        return $this->renderPartial('list',
            [
                'title' => "考题管理",
                'questionIds' => $questionIds,
                'type' => $type,
                'menuUrl' => $this->menuUrl,
            ]
        );
    }

    public function actionInfo() {
        $id = intval(Yii::$app->request->get('id', 0));
        $bannerService = new QuestionService();
        $params = [];
        $params[] = ['=', 'id', $id];
        $bannerInfoRet = $bannerService->getInfo($params);
        return $this->renderPartial('info', [
                'title' => '考题详情',
                'menuUrl' => $this->menuUrl,
                'id' => $id,
                'info' => BaseService::getRetData($bannerInfoRet),
            ]
        );
    }

    public function actionEdit() {
        $id = intval(Yii::$app->request->get('id', 0));
        $bannerService = new QuestionService();
        $params = [];
        $params[] = ['=', 'id', $id];
        $bannerInfoRet = $bannerService->getInfo($params);
        $dataInfo = BaseService::getRetData($bannerInfoRet);
        $answer = isset($dataInfo['answer']) ? $dataInfo['answer'] : "";
        if(isset($dataInfo['type']) && $dataInfo['type']==2) {
            $answer = json_decode($dataInfo['answer'], true);
        }
        if(isset($dataInfo['problem']) && !empty($dataInfo['problem'])) {
            $problem =json_decode($dataInfo['problem'], true);
            $dataInfo['problem'] = "";
            if(is_array($problem)) {
                foreach($problem as $k=>&$v) {
                    $dataInfo['problem'] .= $v;
                }
            }
        } else {
            $dataInfo['problem'] = "";
        }
        return $this->renderPartial('edit',
            [
                'title' => "考题编辑",
                'menuUrl' => $this->menuUrl,
                'dataInfo' => $dataInfo,
                'answer' => $answer,
            ]
        );
    }
}
