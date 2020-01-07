<?php
/**
 * 用户考试问题相关的接口
 * @文件名称: UserExamController.php
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
class UserExamController extends ManageBaseController
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
        $exam_id = intval(Yii::$app->request->post('exam_id', 0));
        $userExamService = new UserExamService();
        $params = [];
        $params[] = ['=', 'exam_id', $exam_id];
        return $userExamService->getList($params, ['status'=>SORT_ASC,'id'=>SORT_ASC], $page, $size,
            [
                'id','status','score','passscore','result_score','decide','exam_id','user_id','type','subjective_score','objective_score'
            ]
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
        $bannerService = new UserExamService();
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
        $exam_id = intval(Yii::$app->request->post('exam_id', 0));
        $types = trim(Yii::$app->request->post('types', ""));
        $score = floatval(Yii::$app->request->post('score', 0));
        $passscore = floatval(Yii::$app->request->post('passscore', 0));
        $bannerService = new UserExamService();
        $answer = "";
        if(!empty($id)) {
            $dataInfo['id'] = $id;
        } else {
            $dataInfo['id'] = 0;
        }
        if(!empty($exam_id)) {
            $dataInfo['exam_id'] = $exam_id;
        } else {
            $dataInfo['exam_id'] = 0;
        }
        if(empty($dataInfo)) {
            return BaseService::returnErrData([], 58000, "提交数据有误");
        }
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
        $bannerService = new UserExamService();
        if(empty($id)) {
            return BaseService::returnErrData([], 58000, "请求参数异常，请填写完整");
        }
        $dataInfo['id'] = $id;
        $dataInfo['status'] = $status;
        return $bannerService->editInfo($dataInfo);
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
        $bannerService = new UserExamService();
        if(empty($id)) {
            return BaseService::returnErrData([], 58000, "请求参数异常，请填写完整");
        }
        $dataInfo['id'] = $id;
        $dataInfo['sort'] = $sort;
        return $bannerService->editInfo($dataInfo);
    }

    /**
     * 用户批改作业
     * @return array
     */
    public function actionCorrection() {
        if (!isset($this->user_id) || !$this->user_id) {
            return BaseService::returnErrData([], 5001, "当前账号登陆异常");
        }
        $id = intval(Yii::$app->request->post('id', 0));
        if(empty($id)) {
            return BaseService::returnErrData([], 514400, "当前试题记录不存在");
        }
        $exam_id = 0;
        $userExamInfo = [];
        $examInfo = [];
        $userExamService = new UserExamService();
        $params = [];
        $params[] = ['=', 'id', $id];
        $userExamInfoRet = $userExamService->getInfo($params);
        if(BaseService::checkRetIsOk($userExamInfoRet)) {
            $userExamInfo = BaseService::getRetData($userExamInfoRet);
            if(isset($userExamInfo['types'])) {
                $userExamInfo['types'] = json_decode($userExamInfo['types'], true);
            }
            if(isset($userExamInfo['exam_id'])) {
                $exam_id = $userExamInfo['exam_id'];
            }
        }
        /*if($exam_id) {
            $examService = new ExamService();
            $examParams[] = ['=', 'id', $exam_id];
            $examInfoRet = $examService->getInfo($examParams);
            if(BaseService::checkRetIsOk($examInfoRet)) {
                $examInfo = BaseService::getRetData($examInfoRet);
                if(isset($examInfo['types'])) {
                    $examInfo['types'] = json_decode($examInfo['types'], true);
                }
            }
        }*/
        //1单项选择、2多项选择、3判断、4解答、5填空
        //result_score 最终得分
        //subjective_score 主观题得分
        //objective_score 客观题得分
        $result_score = 0;
        $subjective_score = 0;
        $objective_score = 0;
        if(isset($userExamInfo['types']) && !empty($userExamInfo['types']) && is_array($userExamInfo['types'])) {
            foreach($userExamInfo['types'] as $k=>&$userExamData) {
                $type = isset($userExamData['type']) ? $userExamData['type'] : 0;
//                $countScore = (isset($examInfo['types']) && isset($examInfo['types']['score'])) ? $examInfo['types']['score'] : 0;
                $score = Yii::$app->request->post("score[$k]",0);
                if($type==1 || $type==2 || $type==3) {
                    $subjective_score+=$score;
                } else if($type==4 || $type==5){
                    $objective_score+=$score;
                }
                $result_score+=$score;
                $userExamData['score'] = $score;
            }
        }
        $userExamInfo['status'] = 1;
        $userExamInfo['types'] = json_encode($userExamInfo['types']);
        $userExamInfo['result_score'] = $result_score;
        $userExamInfo['subjective_score'] = $subjective_score;
        $userExamInfo['objective_score'] = $objective_score;
        return $userExamService->editInfo($userExamInfo);
    }
}
