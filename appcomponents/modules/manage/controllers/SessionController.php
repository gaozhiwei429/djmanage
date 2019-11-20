<?php
/**
 * 章节课件相关的操作
 * @文件名称: SessionController.php
 * @author: jawei
 * @Email: gaozhiwei429@sina.com
 * @Date: 2017-12-06
 * @Copyright: 2017 北京往全包科技有限公司. All rights reserved.
 * 注意：本内容仅限于北京往全包科技有限公司内部传阅，禁止外泄以及用于其他的商业目的
 */
namespace appcomponents\modules\manage\controllers;
use appcomponents\modules\common\CourseService;
use appcomponents\modules\common\SectionsService;
use appcomponents\modules\common\SessionService;
use source\controllers\ManageBaseController;
use source\manager\BaseService;
use \Yii;
class SessionController extends ManageBaseController
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
        $sections_uuid = trim(Yii::$app->request->get('sections_uuid', null));
        $page = intval(Yii::$app->request->post('p', 1));
        $size = intval(Yii::$app->request->post('size', 20));
        $sessionListData = [];
        if(!empty($sections_uuid)) {
            $sectionsService = new SectionsService();
            $params[] = ['=', 'uuid', $sections_uuid];
            $sectionsInfoRet = $sectionsService->getInfo($params);
            $sectionsInfo = BaseService::getRetData($sectionsInfoRet);
            $session_uuids = isset($sectionsInfo['session_uuids']) ? $sectionsInfo['session_uuids'] : "";
            if(!empty($session_uuids)) {
                $sessionService = new SessionService();
                $sessionParams[] = ['in', 'uuid', explode(',',$session_uuids)];
                $sessionListDataRet = $sessionService->getList($sessionParams, ['sort'=>SORT_DESC,'id'=>SORT_ASC],1,-1,['*']);
                $sessionListData = BaseService::getRetData($sessionListDataRet);
            }
        }
        return $this->renderPartial('index',
            [
                'sessionListData' => $sessionListData,
                'sections_uuid' => $sections_uuid,
                'title' => "课件管理",
                'menuUrl' => $this->menuUrl,
            ]
        );
    }

    public function actionInfo() {
        $id = intval(Yii::$app->request->get('id', 0));
        $courseService = new CourseService();
        $params = [];
        $params[] = ['=', 'id', $id];
        $courseInfoRet = $courseService->getInfo($params);
        return $this->renderPartial('info', [
                'title' => '课件详情',
                'menuUrl' => $this->menuUrl,
                'id' => $id,
                'info' => BaseService::getRetData($courseInfoRet),
            ]
        );
    }
    /**
     * 课件编辑
     * @return string
     */
    public function actionEdit() {
        $id = intval(Yii::$app->request->get('id', 0));
        $courseService = new CourseService();
        $params = [];
        $params[] = ['=', 'id', $id];
        $courseInfoRet = $courseService->getInfo($params);
        $info = BaseService::getRetData($courseInfoRet);
        $sections_uuids = isset($info['sections_uuids']) ? explode(",",$info['sections_uuids']) : [];
        $sectionsList = [];
        if(!empty($sections_uuids)) {
            $sectionsParams[] = ['in', 'uuid', $sections_uuids];
            $sectionsService = new SectionsService();
            $sectionsListRet = $sectionsService->getList($sectionsParams,['sort'=>SORT_DESC,'id'=>SORT_ASC], 1, -1, ['*']);
            $sectionsListData = BaseService::getRetData($sectionsListRet);
            $sectionsList = isset($sectionsListData['dataList']) ? $sectionsListData['dataList'] : [];
        }

        return $this->renderPartial('edit',
            [
                'title' => "课件编辑",
                'menuUrl' => $this->menuUrl,
                'id' => $id,
                'info' => BaseService::getRetData($courseInfoRet),
                'sectionsList' => $sectionsList,
            ]
        );
    }
}
