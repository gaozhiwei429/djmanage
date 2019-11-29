<?php
/**
 * 统计相关的接口
 * @文件名称: StatisticsController.php
 * @author: jawei
 * @Email: gaozhiwei429@sina.com
 * @Mobile: 15910987706
 * @Date: 2018-12-01
 * @Copyright: 2017 北京往全保科技有限公司. All rights reserved.
 * 注意：本内容仅限于北京往全保科技有限公司内部传阅，禁止外泄以及用于其他的商业目的
 */
namespace appcomponents\modules\common\controllers;
use appcomponents\modules\common\LevelService;
use source\controllers\ManageBaseController;
use source\manager\BaseService;
use Yii;
class StatisticsController extends ManageBaseController
{
    public function beforeAction($action){
        $userToken = parent::userToken();
        if (!BaseService::checkRetIsOk($userToken)) {
            return $userToken;
        }
        return parent::beforeAction($action);
    }
    /**
     * 民族
     * @return array
     */
    public function actionGetReportData() {
        $datastr = '{"minzu":[{"name":"其他","value":1},{"name":"回族","value":1},{"name":"壮族","value":4},{"name":"布依族","value":1},{"name":"汉族","value":36},{"name":"独龙族","value":1},{"name":"瑶族","value":4},{"name":"苗族","value":1},{"name":"蒙古族","value":1},{"name":"藏族","value":1}],"sex":{"male":32,"female":10},"age":[19,5,20,6,1,0,0],"join":[4,0,4,42,1],"xueli":[{"name":"其他","value":17},{"name":"初中","value":1},{"name":"博士","value":1},{"name":"博士以上","value":1},{"name":"大专","value":7},{"name":"大学","value":16},{"name":"小学","value":3},{"name":"硕士","value":3},{"name":"高中（中专）","value":2}],"jiguan":[{"name":"上海","value":2},{"name":"云南","value":1},{"name":"其他","value":15},{"name":"北京","value":6},{"name":"南海诸岛","value":1},{"name":"天津","value":1},{"name":"安徽","value":2},{"name":"山东","value":2},{"name":"广东","value":1},{"name":"广西","value":9},{"name":"河北","value":5},{"name":"河南","value":2},{"name":"湖北","value":1},{"name":"甘肃","value":1},{"name":"重庆","value":1},{"name":"黑龙江","value":1}]}';
        return $datastr;
        $data = json_decode($datastr, true);
        return $data;//BaseService::returnOkData($data);
    }
    /**
     * 会议人数
     * @return array
     */
    public function actionMeetingList() {
        $datastr = '[{"meeting":0,"reach":0,"absent":0,"leave":0,"year":2019,"month":1,"time":"2019-01"},{"meeting":0,"reach":0,"absent":0,"leave":0,"year":2019,"month":2,"time":"2019-02"},{"meeting":0,"reach":0,"absent":0,"leave":0,"year":2019,"month":3,"time":"2019-03"},{"meeting":0,"reach":0,"absent":0,"leave":0,"year":2019,"month":4,"time":"2019-04"},{"meeting":0,"reach":0,"absent":0,"leave":0,"year":2019,"month":5,"time":"2019-05"},{"meeting":15,"reach":0,"absent":807,"leave":3,"year":2019,"month":6,"time":"2019-06"},{"meeting":0,"reach":0,"absent":0,"leave":0,"year":2019,"month":7,"time":"2019-07"},{"meeting":8,"reach":1,"absent":23,"leave":1,"year":2019,"month":8,"time":"2019-08"},{"meeting":6,"reach":1,"absent":44,"leave":0,"year":2019,"month":9,"time":"2019-09"},{"meeting":7,"reach":4,"absent":70,"leave":0,"year":2019,"month":10,"time":"2019-10"},{"meeting":5,"reach":1,"absent":29,"leave":0,"year":2019,"month":11,"time":"2019-11"}]';
        return $datastr;
        $data = json_decode($datastr, true);
        return $data;//BaseService::returnOkData($data);
    }
    /**
     * 微党课
     * @return array
     */
    public function actionWeiDangKe() {
        $datastr = '{"weidangke":{"times":41,"total_time":"121655.09","moth_times":[0,0,0,15,10,3,2,0,2,4,5],"moth_time":["0.00","0.00","0.00","7054.86","13573.21","19412.40","22276.10","22320.00","22430.82","24588.15","-10000.45"]}}';
        return $datastr;
        $data = json_decode($datastr, true);
        return $data;//BaseService::returnOkData($data);
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
        $bannerService = new LevelService();
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
        $status = intval(Yii::$app->request->post('status', 0));
        $sort = intval(Yii::$app->request->post('sort', 0));
        $bannerService = new LevelService();
        if(empty($title)) {
            return BaseService::returnErrData([], 55900, "职务名称不能为空");
        }
        $dataInfo = [];
        if(!empty($title)) {
            $dataInfo['title'] = $title;
        } else {
            $dataInfo['title'] = "";
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
        $dataInfo['sort'] = $sort;
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
        $bannerService = new LevelService();
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
        $bannerService = new LevelService();
        if(empty($id)) {
            return BaseService::returnErrData([], 58000, "请求参数异常，请填写完整");
        }
        $dataInfo['id'] = $id;
        $dataInfo['sort'] = $sort;
        return $bannerService->editInfo($dataInfo);
    }
}
