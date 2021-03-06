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
use appcomponents\modules\common\UserExamService;
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
        return $bannerService->getList($params, ['id'=>SORT_DESC], $page, $size,
            ['id','uuid','title','organization_uuid','create_time','start_time','overdue_time','examtime','score','passscore','types','decide','type','status','anwser_num']
        );
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

    /**
     * 试卷数据获取
     * @return array
     */
    public function actionGetQuestion() {
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
        $ret = $bannerService->getInfo($params);
        if(BaseService::checkRetIsOk($ret)) {
            $dataInfo = BaseService::getRetData($ret);
            $dataInfo['questionList'] = [];
            $questionIds = [];
            if(isset($dataInfo['types']) && !empty($dataInfo['types'])) {
                $dataInfo['types'] = json_decode($dataInfo['types'], true);
                foreach($dataInfo['types'] as $type=>$typeData) {
                    if(isset($typeData['questions']) && !empty($typeData['questions'])) {
                        $questionsIdArr = explode(',', $typeData['questions']);
                        foreach($questionsIdArr as $questionsId) {
                            $questionIds[] = $questionsId;
                        }
                    }
                }
            }
            if(!empty($questionIds)) {
                $questionService = new QuestionService();
                $questionParams[] = ['in', 'id', $questionIds];
                $questionListRet = $questionService->getList($questionParams,[], 1, count($questionIds),
                    ['id', 'title', 'answer','type','level','problem','analysis'], true
                );
                if(BaseService::checkRetIsOk($questionListRet)) {
                    $questionData = BaseService::getRetData($questionListRet);
                    if(isset($questionData['dataList']) && !empty($questionData['dataList'])) {
                        foreach($questionIds as $k=>$v) {
                            if(isset($questionData['dataList'][$v])) {
                                $dataInfo['questionList'][] = $questionData['dataList'][$v];
                            }
                        }
                    }
                }
            }
            return BaseService::returnOkData($dataInfo);
        }
        return $ret;
    }
    /**
     * 作答和考试
     * @return array
     */
    public function actionAnwser() {
        if (!isset($this->user_id) || !$this->user_id) {
            return BaseService::returnErrData([], 5001, "当前账号登陆异常");
        }
        $exam_id = intval(Yii::$app->request->post('exam_id', 0));
        $types = Yii::$app->request->post('types', []);
        if(empty($exam_id)) {
            return BaseService::returnErrData([], 54000, "请求参数异常");
        }
        if(empty($types) || !is_array($types)) {
            return BaseService::returnErrData([], 517100, "请求参数异常");
        }
        $examService = new ExamService();
        $params = [];
        $params[] = ['=', 'id', $exam_id];
        $ret = $examService->getInfo($params);
        if(BaseService::checkRetIsOk($ret)) {
            $dataInfo = BaseService::getRetData($ret);
            $dataInfo['questionList'] = [];
            $questionIds = [];
            if(isset($dataInfo['types']) && !empty($dataInfo['types'])) {
                $dataInfo['types'] = json_decode($dataInfo['types'], true);
                foreach($dataInfo['types'] as $type=>$typeData) {
                    if(isset($typeData['questions']) && !empty($typeData['questions'])) {
                        $questionsIdArr = explode(',', $typeData['questions']);
                        foreach($questionsIdArr as $questionsId) {
                            $questionIds[] = $questionsId;
                        }
                    }
                }
            }
            $dataInfo['questionList'] = [];
            $subjective_score = 0;
            if(!empty($questionIds)) {
                $questionService = new QuestionService();
                $questionParams[] = ['in', 'id', $questionIds];
                $questionListRet = $questionService->getList($questionParams,[], 1, count($questionIds),
                    ['id', 'title', 'answer','type','level','problem','analysis'], true
                );
                if(BaseService::checkRetIsOk($questionListRet)) {
                    $questionData = BaseService::getRetData($questionListRet);
                    if(isset($questionData['dataList']) && !empty($questionData['dataList'])) {
                        $dataInfo['questionList'] = $questionData['dataList'];
                        foreach($dataInfo['questionList'] as $k=>&$v) {
                            $v['exam_answer'] = "";
                            $v['exam_correct'] = 0;
                            if($v['type']==2) {
                                $v['exam_answer'] = [];
                            }
                            if(isset($types[$k])) {
                                $v['exam_answer'] = $types[$k];
                                if($v['type']==2) {
                                    $v['exam_answer'] = is_array($types[$k]) ? $types[$k] : json_decode($types[$k], true);
                                }
                            }
                            if($v['answer'] == $v['exam_answer']) {
                                $v['exam_correct'] = 1;
                                $subjective_score +=$dataInfo['types'][$v['type']]['score'];
                            }
                        }
                    }
                }
            }
            $userExam = new UserExamService();
            $userExamData = [];
            $userExamData['exam_id'] = $exam_id;
            $userExamData['user_id'] = $this->user_id;
            $userExamData['status'] = 0;
            $userExamData['score'] = isset($dataInfo['score']) ? $dataInfo['score'] : 0;
            $userExamData['passscore'] = isset($dataInfo['passscore']) ? $dataInfo['passscore'] : 0;
            $userExamData['decide'] = isset($dataInfo['decide']) ? $dataInfo['decide'] : 0;
            $userExamData['types'] = isset($dataInfo['questionList']) ? json_encode($dataInfo['questionList']) : json_encode([]);
            $userExamData['type'] = isset($dataInfo['type']) ? $dataInfo['type'] : 0;
            $userExamData['subjective_score'] = $subjective_score;
            $userExamData['objective_score'] = 0;
            $resultExam = $userExam->editInfo($userExamData);
            if(BaseService::checkRetIsOk($resultExam)) {
                $examUpdate['id'] = $exam_id;
                $examUpdate['anwser_num'] = $dataInfo['anwser_num'] ? $dataInfo['anwser_num'] : 0;
                $examService->editInfo($examUpdate);
                return $resultExam;
            }
        }
        return $ret;
    }
    /**
     * 获取我的考试记录
     * @return array
     */
    public function actionGetMyExam() {
        if (!isset($this->user_id) || !$this->user_id) {
            return BaseService::returnErrData([], 5001, "当前账号登陆异常");
        }
        $page = intval(Yii::$app->request->post('p', 1));
        $size = intval(Yii::$app->request->post('size', 10));
        $type = intval(Yii::$app->request->post('type', 1));
        $userExamService = new UserExamService();
        $params = [];
        $params[] = ['=', 'user_id', $this->user_id];
        if($type) {
            $params[] = ['=', 'type', $type];
        }
        $resultRet = $userExamService->getList($params, [], $page, $size,
            [
                'id','status','score','passscore','result_score','decide','exam_id','user_id','type','subjective_score','objective_score'
            ]
        );
        if(BaseService::checkRetIsOk($resultRet)) {
            $resultDataList = BaseService::getRetData($resultRet);
            if(isset($resultDataList['dataList']) && !empty($resultDataList['dataList'])) {
                $examIds = [];
                foreach($resultDataList['dataList'] as $resultData) {
                    if(isset($resultData['exam_id'])) {
                        $examIds[] = $resultData['exam_id'];
                    }
                }
                $examList = [];
                if(!empty($examIds)) {
                    $examParams = [];
                    $examParams[] = ['in', 'id', $examIds];
                    $examService = new ExamService();
                    $examListDataRet = $examService->getList($examParams, [], 1, count($examIds),['id','title'],true);
                    $examListData = BaseService::getRetData($examListDataRet);
                    $examList = isset($examListData['dataList']) ? $examListData['dataList'] : [];
                }
                foreach($resultDataList['dataList'] as &$resultData) {
                    if(isset($examList[$resultData['exam_id']])) {
                        $resultData['exam_title'] = isset($examList[$resultData['exam_id']]['title']) ? $examList[$resultData['exam_id']]['title'] : "";
                    }
                }
                return BaseService::returnOkData($resultDataList);
            }
        }
        return $resultRet;
    }
}
