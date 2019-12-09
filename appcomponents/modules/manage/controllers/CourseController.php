<?php
/**
 * 课程相关的操作
 * @文件名称: CourseController.php
 * @author: jawei
 * @Email: gaozhiwei429@sina.com
 * @Date: 2017-12-06
 * @Copyright: 2017 北京往全包科技有限公司. All rights reserved.
 * 注意：本内容仅限于北京往全包科技有限公司内部传阅，禁止外泄以及用于其他的商业目的
 */
namespace appcomponents\modules\manage\controllers;
use appcomponents\modules\common\CourseService;
use appcomponents\modules\common\CourseTypeService;
use appcomponents\modules\common\LessionService;
use appcomponents\modules\common\SectionsService;
use source\controllers\ManageBaseController;
use source\manager\BaseService;
use \Yii;
class CourseController extends ManageBaseController
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
                'title' => "课程管理",
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
                'title' => '课程详情',
                'menuUrl' => $this->menuUrl,
                'id' => $id,
                'info' => BaseService::getRetData($courseInfoRet),
            ]
        );
    }

    /**
     * 新增课程
     * @return string
     */
    public function actionAdd() {
        $id = intval(Yii::$app->request->get('id', 0));
        $info = [];
        if($id) {
            $courseService = new CourseService();
            $params = [];
            $params[] = ['=', 'id', $id];
            $courseInfoRet = $courseService->getInfo($params);
            $info = BaseService::getRetData($courseInfoRet);
        }
        return $this->renderPartial('add',
            [
                'title' => "课程编辑与新增",
                'info' => $info,
                'menuUrl' => $this->menuUrl,
            ]
        );
    }
    /**
     * 课程编辑
     * @return string
     */
    public function actionEdit() {
        $id = intval(Yii::$app->request->get('id', 0));
        $courseService = new CourseService();
        $params = [];
        $params[] = ['=', 'id', $id];
        $courseInfoRet = $courseService->getInfo($params);
        $info = BaseService::getRetData($courseInfoRet);
        $sections_ids = isset($info['sections_ids']) ? explode(",",$info['sections_ids']) : [];
        $sectionsList = [];
        if(!empty($sections_ids)) {
            $sectionsParams[] = ['in', 'id', $sections_ids];
            $sectionsService = new SectionsService();
            $sectionsListRet = $sectionsService->getList($sectionsParams,['sort'=>SORT_DESC,'id'=>SORT_ASC], 1, -1, ['*']);
            $sectionsListData = BaseService::getRetData($sectionsListRet);
            $sectionsList = isset($sectionsListData['dataList']) ? $sectionsListData['dataList'] : [];
        }
        $courseTypeService = new CourseTypeService();
        $getTreeParams[] = ['=', 'status', 1];
        $courseTypeTreeRet = $courseTypeService->getTree($getTreeParams,['sort'=>SORT_DESC,'id'=>SORT_ASC],1,-1,['id','title','parent_id'], true);
        $courseTypeTree = BaseService::getRetData($courseTypeTreeRet);
        return $this->renderPartial('edit',
            [
                'title' => "课程编辑",
                'menuUrl' => $this->menuUrl,
                'id' => $id,
                'dataInfo' => BaseService::getRetData($courseInfoRet),
                'sectionsList' => $sectionsList,
                'courseTypeTree' => $courseTypeTree,
            ]
        );
    }
    /**
     * 章节管理
     * @return string
     */
    public function actionSectionIndex() {
        return $this->renderPartial('section-index',
            [
                'title' => "课件章节管理",
                'menuUrl' => $this->menuUrl,
            ]
        );
    }
    /**
     * 章节编辑管理
     * @return string
     */
    public function actionSectionEdit() {
        $id = intval(Yii::$app->request->get('id', 0));
        $sectionService = new SectionsService();
        $params = [];
        $params[] = ['=', 'id', $id];
        $courseInfoRet = $sectionService->getInfo($params);
        $info = BaseService::getRetData($courseInfoRet);
        $lession_ids = isset($info['lession_ids']) ? explode(",",$info['lession_ids']) : [];
        $lessionList = [];
        if(!empty($lession_ids)) {
            $lessionParams[] = ['in', 'id', $lession_ids];
            $lessionService = new LessionService();
            $lessionListRet = $lessionService->getList($lessionParams,['sort'=>SORT_DESC,'id'=>SORT_ASC], 1, -1, ['*']);
            $lessionListData = BaseService::getRetData($lessionListRet);
            $lessionList = isset($lessionListData['dataList']) ? $lessionListData['dataList'] : [];
        }

        return $this->renderPartial('section-edit',
            [
                'title' => "课程章节编辑",
                'dataInfo' => $info,
                'menuUrl' => $this->menuUrl,
                'lessionList' => $lessionList,
            ]
        );
    }
    /**
     * 课件管理
     * @return string
     */
    public function actionSectionList() {
        $sectionIds = trim(Yii::$app->request->get('sectionIds', null));
        $type = intval(Yii::$app->request->get('type', null));
        if(!empty($sectionIds)) {
            $sectionIds = implode(',', array_unique(array_filter(explode(',', $sectionIds))));
        } else {
            $cookies = Yii::$app->request->cookies;//注意此处是request
            $sectionIds = $cookies->get('sectionIds');//设置默认值
        }
        return $this->renderPartial('section-list',
            [
                'title' => "课程章节管理",
                'menuUrl' => $this->menuUrl,
                'sectionIds' => $sectionIds,
                'type' => $type,
            ]
        );
    }

    /**
     * 章节管理
     * @return string
     */
    public function actionLessionIndex() {
        return $this->renderPartial('lession-index',
            [
                'title' => "章节课件管理",
                'menuUrl' => $this->menuUrl,
            ]
        );
    }
    /**
     * 章节编辑管理
     * @return string
     */
    public function actionLessionEdit() {
        $id = intval(Yii::$app->request->get('id', 0));
        $sectionService = new LessionService();
        $params = [];
        $params[] = ['=', 'id', $id];
        $courseInfoRet = $sectionService->getInfo($params);
        $info = BaseService::getRetData($courseInfoRet);
        return $this->renderPartial('lession-edit',
            [
                'title' => "章节课件编辑",
                'dataInfo' => $info,
                'menuUrl' => $this->menuUrl,
            ]
        );
    }
}
