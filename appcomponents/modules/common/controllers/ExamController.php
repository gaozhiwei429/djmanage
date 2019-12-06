<?php
/**
 * 考试相关的接口
 * @文件名称: ExamController.php
 * @author: jawei
 * @Email: gaozhiwei429@sina.com
 * @Mobile: 15910987706
 * @Date: 2018-12-01
 * @Copyright: 2017 北京往全保科技有限公司. All rights reserved.
 * 注意：本内容仅限于北京往全保科技有限公司内部传阅，禁止外泄以及用于其他的商业目的
 */
namespace appcomponents\modules\common\controllers;
use appcomponents\modules\common\ExamService;
use source\controllers\ManageBaseController;
use source\manager\BaseService;
use Yii;
class ExamController extends ManageBaseController
{
    public function beforeAction($action){
        $userToken = parent::userToken();
        if (!BaseService::checkRetIsOk($userToken)) {
            return $userToken;
        }
        return parent::beforeAction($action);
    }
    /**
     * 分页数据获取
     * @return array
     */
    public function actionGetList() {
        if (!isset($this->user_id) || !$this->user_id) {
            return BaseService::returnErrData([], 5001, "当前账号登陆异常");
        }
        $page = intval(Yii::$app->request->post('p', 1));
        $size = intval(Yii::$app->request->post('size', 10));
        $bannerService = new ExamService();
        $params = [];
        return $bannerService->getList($params, ['id'=>SORT_DESC], $page, $size);
    }

    /**
     * 详情数据获取
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
        $bannerService = new ExamService();
        $params = [];
        $params[] = ['=', 'id', $id];
        return $bannerService->getInfo($params);
    }
    /**
     * 详情数据编辑
     * @return array
     */
    public function actionEdit() {
        if (!isset($this->user_id) || !$this->user_id) {
            return BaseService::returnErrData([], 5001, "当前账号登陆异常");
        }
        $id = intval(Yii::$app->request->post('id', 0));
        $title = trim(Yii::$app->request->post('title', ""));
        $organization_uuid = trim(Yii::$app->request->post('organization_uuid', ""));
        $status = intval(Yii::$app->request->post('status', 0));
        $startandoverduedate = trim(Yii::$app->request->post('startandoverduedate', null));
        $passscore = intval(Yii::$app->request->post('passscore', 0));//及格分数
        $decide = intval(Yii::$app->request->post('decide', 0));//评分方式
        $score = intval(Yii::$app->request->post('score', 0));//总分
        $examtime = intval(Yii::$app->request->post('examtime', 0));//考试时间
        $types = [];//考试时间
        for($i=1; $i<=5; $i++) {
            $typeScore = floatval(Yii::$app->request->post("types[$i][score]", ""));
            $describe = trim(Yii::$app->request->post("types[$i][describe]", ""));
            $number = intval(Yii::$app->request->post("types[$i][number]", ""));
            $questions = trim(Yii::$app->request->post("types[$i][questions]", ""));
            if($number && $typeScore) {
                $types[$i] = [
                    'score' => $typeScore,
                    'describe' => $describe,
                    'number' => $number,
                    'questions' => $questions,
                ];
            }
        }
        $bannerService = new ExamService();
        if(empty($title)) {
            return BaseService::returnErrData([], 55900, "考题名称不能为空");
        }
        if(empty($types)) {
            return BaseService::returnErrData([], 55900, "考题不能为空，请选择考题");
        }
        $dataInfo = [];
        $questionsArr = [];
        for($i=1; $i<=5; $i++) {
            $questionsArr[$i]['describe'] = trim(Yii::$app->request->post("types[$i][describe]", ""));
            $questionsArr[$i]['number'] = intval(Yii::$app->request->post("types[$i][number]", 0));
            $questionsArr[$i]['questions'] = trim(Yii::$app->request->post("types[$i][questions]", ""));
            $questionsArr[$i]['score'] = floatval(Yii::$app->request->post("types[$i][score]", 0));
        }
        if(!empty($organization_uuid)) {
            $dataInfo['organization_uuid'] = $organization_uuid;
        } else {
            $dataInfo['organization_uuid'] = "";
        }
        if(!empty($title)) {
            $dataInfo['title'] = $title;
        } else {
            $dataInfo['title'] = "";
        }
        if(!empty($decide)) {
            $dataInfo['decide'] = 1;
        } else {
            $dataInfo['decide'] = 0;
        }
        if(!empty($examtime)) {
            $dataInfo['examtime'] = $examtime;
        } else {
            $dataInfo['examtime'] = 0;
        }
        if(!empty($score)) {
            $dataInfo['score'] = $score;
        } else {
            $dataInfo['score'] = 0;
        }
        if(!empty($passscore)) {
            $dataInfo['passscore'] = $passscore;
        } else {
            $dataInfo['passscore'] = 0;
        }
        if(!empty($startandoverduedate)) {
            $startandoverduedateArr = explode(" - ", $startandoverduedate);
            if(!empty($startandoverduedateArr[0]) && isset($startandoverduedateArr[0])) {
                $dataInfo['start_time'] = $startandoverduedateArr[0];
            }
            if(!empty($startandoverduedateArr[1]) && isset($startandoverduedateArr[1])) {
                $dataInfo['overdue_time'] = $startandoverduedateArr[1];
            }
        }
        if(!empty($id)) {
            $dataInfo['id'] = $id;
        } else {
            $dataInfo['id'] = 0;
        }
        if(!empty($types) && is_array($types)) {
            $dataInfo['types'] = json_encode($types);
        } else {
            $dataInfo['types'] = json_encode([]);
        }
        if(empty($dataInfo)) {
            return BaseService::returnErrData([], 58000, "提交数据有误");
        }
        $dataInfo['status'] = $status;
        $dataInfo['score'] = $score;
        $dataInfo['passscore'] = $passscore;
        $dataInfo['types'] = json_encode($questionsArr);
        return $bannerService->editInfo($dataInfo);
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
        $bannerService = new ExamService();
        if(empty($id)) {
            return BaseService::returnErrData([], 58000, "请求参数异常，请填写完整");
        }
        $dataInfo['id'] = $id;
        $dataInfo['status'] = $status;
        return $bannerService->editInfo($dataInfo);
    }
}
