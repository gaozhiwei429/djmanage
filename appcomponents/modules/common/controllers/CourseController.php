<?php
/**
 * 课程相关相关的接口
 * @文件名称: CourseController.php
 * @author: jawei
 * @Email: gaozhiwei429@sina.com
 * @Mobile: 15910987706
 * @Date: 2018-12-01
 * @Copyright: 2017 北京往全保科技有限公司. All rights reserved.
 * 注意：本内容仅限于北京往全保科技有限公司内部传阅，禁止外泄以及用于其他的商业目的
 */
namespace appcomponents\modules\common\controllers;
use appcomponents\modules\common\CourseService;
use appcomponents\modules\common\CourseTypeService;
use appcomponents\modules\common\LessionService;
use appcomponents\modules\common\SectionsService;
use source\controllers\ManageBaseController;
use source\manager\BaseService;
use Yii;
class CourseController extends ManageBaseController
{
    public function beforeAction($action){
        $userToken = parent::userToken();
        if (!BaseService::checkRetIsOk($userToken)) {
            return $userToken;
        }
        return parent::beforeAction($action);
    }
    /**
     * 首页资讯获取
     * @return array
     */
    public function actionGetList() {
        if (!isset($this->user_id) || !$this->user_id) {
            return BaseService::returnErrData([], 5001, "当前账号登陆异常");
        }
        $page = intval(Yii::$app->request->post('p', 1));
        $size = intval(Yii::$app->request->post('size', 10));
        $newsService = new CourseService();
        $params = [];
        $courseListRet = $newsService->getList($params, ['sort'=>SORT_DESC], $page, $size);
        if(BaseService::checkRetIsOk($courseListRet)) {
            $courseList = BaseService::getRetData($courseListRet);
            if(!empty($courseList['dataList'])) {
                $courseTypeService = new CourseTypeService();
                $courseTypeDataRet = $courseTypeService->getList([], [], 1, -1, ['*'], true);
                if(BaseService::checkRetIsOk($courseTypeDataRet)) {
                    $courseTypeDataResult = BaseService::getRetData($courseTypeDataRet);
                    $courseTypeData = isset($courseTypeDataResult['dataList']) ? $courseTypeDataResult['dataList'] : [];
                }
                foreach($courseList['dataList'] as $k=>&$v) {
                    $v['course_type_title'] = "未知";
                    if(isset($v['course_type_id']) && isset($courseTypeData[$v['course_type_id']])) {
                        $v['course_type_title'] = isset($courseTypeData[$v['course_type_id']]['title']) ? $courseTypeData[$v['course_type_id']]['title'] : "";
                    }
                }
            }
            return BaseService::returnOkData($courseList);
        }
        return $courseListRet;
    }
    /**
     * 文章详情数据获取
     * @return array
     */
    public function actionGetInfo() {
        if (!isset($this->user_id) || !$this->user_id) {
            return BaseService::returnErrData([], 5001, "当前账号登陆异常");
        }
        $uuid = trim(Yii::$app->request->post('uuid', null));
        if(empty($uuid)) {
            return BaseService::returnErrData([], 54000, "请求参数异常");
        }
        $newsService = new CourseService();
        $params = [];
        $params[] = ['=', 'uuid', $uuid];
        $courseInfoRet = $newsService->getInfo($params);
        if(BaseService::checkRetIsOk($courseInfoRet)) {
            $courseInfo = BaseService::getRetData($courseInfoRet);
            if(isset($courseInfo['sections_ids']) && !empty($courseInfo['sections_ids'])) {
                $sections_ids = explode(',',$courseInfo['sections_ids']);
                $sectionService = new SectionsService();
                $sectionParams[] = ['in', 'id', $sections_ids];
                $sectionParams[] = ['!=', 'status', 0];
                $sectionListRet = $sectionService->getList($sectionParams, ['sort'=>SORT_DESC, 'id'=>SORT_ASC], 1, -1, ['id', 'title', 'lession_ids'], true);
                $sectionDataList = BaseService::getRetData($sectionListRet);
                if(isset($sectionDataList['dataList']) && !empty($sectionDataList['dataList'])) {
                    foreach($sectionDataList['dataList'] as &$sectionData) {
                        $courseInfo['sectionData'][$sectionData['id']]['sectionInfo'] = $sectionData;
                        if(isset($sectionData['lession_ids']) && !empty($sectionData['lession_ids'])) {
                            $lessionParams = [];
                            $lessionParams[] = ['in', 'id', explode(',',$sectionData['lession_ids'])];
                            $lessionParams[] = ['!=', 'status', 0];
                            $lessionService = new LessionService();
                            $lessionListRet = $lessionService->getList($lessionParams, ['sort'=>SORT_ASC, 'id'=>SORT_ASC], 1, -1, ['id', 'title', 'uuid', 'file', 'format']);
                            $lessionDataList = BaseService::getRetData($lessionListRet);
                            if(isset($lessionDataList['dataList']) && !empty($lessionDataList['dataList'])) {
                                $courseInfo['sectionData'][$sectionData['id']]['lessionList'] = $lessionDataList['dataList'];
                            }
                        }

                    }
                }
            }
            return BaseService::returnOkData($courseInfo);
        }
        return $courseInfoRet;
    }
    /**
     * 资讯详情数据编辑
     * @return array
     */
    public function actionEdit() {
        if (!isset($this->user_id) || !$this->user_id) {
            return BaseService::returnErrData([], 5001, "当前账号登陆异常");
        }
        $id = intval(Yii::$app->request->post('id', 0));
        $title = trim(Yii::$app->request->post('title', ""));
        $content = trim(Yii::$app->request->post('content', ""));
        $sort = intval(Yii::$app->request->post('sort', 0));
        $status = intval(Yii::$app->request->post('status',  0));
        $elective_type = intval(Yii::$app->request->post('elective_type',  1));
        $course_type_id = intval(Yii::$app->request->post('course_type_id',  0));
        $pic_url = trim(Yii::$app->request->post('pic_url', ""));
        $sections_ids = Yii::$app->request->post('sections_ids', "");
        $newsService = new CourseService();
        $sections_ids = explode(',', $sections_ids);
        if(empty($title)) {
            return BaseService::returnErrData([], 55900, "请求参数异常，请填写完整");
        }
        if(!is_array($sections_ids) || empty($sections_ids)) {
            return BaseService::returnErrData([], 510000, "请选择章节");
        }
        $lession_count = 0;
        $sectionsService = new SectionsService();
        $sectionsParams[] = ['in', 'id', $sections_ids];
        $sectionsListRet = $sectionsService->getList($sectionsParams,[],1,-1,['lession_ids']);
        if(BaseService::checkRetIsOk($sectionsListRet)) {
            $sectionsList = BaseService::getRetData($sectionsListRet);
            if(isset($sectionsList['dataList'])) {
                foreach($sectionsList['dataList'] as $dataInfo) {
                    if(isset($dataInfo['lession_ids'])) {
                        $lession_count += count(explode(',', $dataInfo['lession_ids']));
                    }
                }
            }
        }
        if($lession_count==0) {
            return BaseService::returnErrData([], 510000, "您选择的章节没有选择课件请为选择的章节选择课件");
        }
        $dataInfo['sections_count'] = count($sections_ids);
        $dataInfo['lession_count'] = $lession_count;
        $dataInfo = [];
        if(!empty($pic_url)) {
            $dataInfo['pic_url'] = $pic_url;
        }
        if(!empty($course_type_id)) {
            $dataInfo['course_type_id'] = $course_type_id;
        }
        if(!empty($title)) {
            $dataInfo['title'] = $title;
        } else {
            $dataInfo['title'] = "";
        }
        if(!empty($content)) {
            $dataInfo['content'] = $content;
        } else {
            $dataInfo['content'] = "";
        }
        if(!empty($sort)) {
            $dataInfo['sort'] = $sort;
        } else {
            $dataInfo['sort'] = 0;
        }
        if(!empty($sections_ids)) {
            $dataInfo['sections_ids'] = implode(',',$sections_ids);
        }
        if(!empty($id)) {
            $dataInfo['id'] = $id;
        } else {
            $dataInfo['id'] = 0;
        }
        if(empty($dataInfo)) {
            return BaseService::returnErrData([], 58000, "提交数据有误");
        }
        $dataInfo['status'] = $status;
        $dataInfo['elective_type'] = $elective_type;
        return $newsService->editInfo($dataInfo);
    }
    /**
     * 详情数据状态编辑
     * @return array
     */
    public function actionSetStatus() {
        if (!isset($this->user_id) || !$this->user_id) {
            return BaseService::returnErrData([], 5001, "当前账号登陆异常");
        }
        $id = intval(Yii::$app->request->post('id', 0));
        $status = intval(Yii::$app->request->post('status',  0));
        $newsService = new CourseService();
        if(empty($id)) {
            return BaseService::returnErrData([], 58000, "请求参数异常，请填写完整");
        }
        $dataInfo['id'] = $id;
        $dataInfo['status'] = $status;
        return $newsService->editInfo($dataInfo);
    }
    /**
     * 详情数据状态编辑
     * @return array
     */
    public function actionSetSort() {
        if (!isset($this->user_id) || !$this->user_id) {
            return BaseService::returnErrData([], 5001, "当前账号登陆异常");
        }
        $id = trim(Yii::$app->request->post('id', 0));
        $sort = intval(Yii::$app->request->post('sort',  0));
        $newsService = new CourseService();
        if(empty($id)) {
            return BaseService::returnErrData([], 58000, "请求参数异常，请填写完整");
        }
        $dataInfo['id'] = $id;
        $dataInfo['sort'] = $sort;
        return $newsService->editInfo($dataInfo);
    }
    /**
     * 详情数据状态编辑
     * @return array
     */
    public function actionSetElectiveType() {
        if (!isset($this->user_id) || !$this->user_id) {
            return BaseService::returnErrData([], 5001, "当前账号登陆异常");
        }
        $id = intval(Yii::$app->request->post('id', 0));
        $elective_type = intval(Yii::$app->request->post('elective_type',  1));
        $newsService = new CourseService();
        if(empty($id)) {
            return BaseService::returnErrData([], 58000, "请求参数异常，请填写完整");
        }
        $dataInfo['id'] = $id;
        $dataInfo['elective_type'] = $elective_type;
        return $newsService->editInfo($dataInfo);
    }
}
