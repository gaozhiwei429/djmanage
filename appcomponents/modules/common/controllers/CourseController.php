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
        $id = intval(Yii::$app->request->post('id', 0));
        if(empty($id)) {
            return BaseService::returnErrData([], 54000, "请求参数异常");
        }
        $newsService = new CourseService();
        $params = [];
        $params[] = ['=', 'id', $id];
        return $newsService->getInfo($params);
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
        $course_type_id = intval(Yii::$app->request->post('course_type_id',  0));
        $pic_url = trim(Yii::$app->request->post('pic_url', ""));
        $newsService = new CourseService();
        $postData = Yii::$app->request->post();
        $sections_uuidsArr = [];
        foreach($postData as $k=>$v) {
            if(strstr($k,"sections_uuids")) {
                $sections_uuidsArr[] = $v;
            }
        }
        if(empty($title)) {
            return BaseService::returnErrData([], 55900, "请求参数异常，请填写完整");
        }
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
        if(!empty($sections_uuidsArr)) {
            $dataInfo['sections_uuids'] = implode(',', $sections_uuidsArr);
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
        return $newsService->editInfo($dataInfo);
    }
}
