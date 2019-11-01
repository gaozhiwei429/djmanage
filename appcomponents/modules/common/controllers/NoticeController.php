<?php
/**
 * banner相关的接口
 * @文件名称: BannerController.php
 * @author: jawei
 * @Email: gaozhiwei429@sina.com
 * @Mobile: 15910987706
 * @Date: 2018-12-01
 * @Copyright: 2017 北京往全保科技有限公司. All rights reserved.
 * 注意：本内容仅限于北京往全保科技有限公司内部传阅，禁止外泄以及用于其他的商业目的
 */
namespace appcomponents\modules\common\controllers;
use appcomponents\modules\common\NoticeService;
use source\controllers\ManageBaseController;
use source\manager\BaseService;
use Yii;
class NoticeController extends ManageBaseController
{
    public function beforeAction($action){
        $userToken = parent::userToken();
        if (!BaseService::checkRetIsOk($userToken)) {
            return $userToken;
        }
        return parent::beforeAction($action);
    }
    /**
     * 首页公告获取
     * @return array
     */
    public function actionGetList() {
        if (!isset($this->user_id) || !$this->user_id) {
            return BaseService::returnErrData([], 5001, "当前账号登陆异常");
        }
        $page = intval(Yii::$app->request->post('p', 1));
        $size = intval(Yii::$app->request->post('size', 10));
        $noticeService = new NoticeService();
        $params = [];
//        $params[] = ['>=', 'create_time', date('Y-m-d H:i:s')];
//        $params[] = ['>=', 'overdue_time', date('Y-m-d H:i:s')];
        return $noticeService->getList($params, ['sort'=>SORT_DESC], $page, $size);
    }

    /**
     * banner详情数据获取
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
        $noticeService = new NoticeService();
        $params = [];
        $params[] = ['=', 'id', $id];
        return $noticeService->getInfo($params);
    }
    /**
     * banner详情数据编辑
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
        $type_id = intval(Yii::$app->request->post('type_id',  0));
        $noticeService = new NoticeService();
        $postData = Yii::$app->request->post();
        $pic_urlArr = [];
        foreach($postData as $k=>$pic_url) {
            if(strstr($k,"pic_url")) {
                $pic_urlArr[] = $pic_url;
            }
        }
        if(empty($title) || empty($pic_urlArr)) {
            return BaseService::returnErrData([], 55900, "请求参数异常，请填写完整");
        }
        $dataInfo = [];
        if(!empty($pic_urlArr)) {
            $dataInfo['pic_url'] = $pic_urlArr ? json_encode($pic_urlArr) : "[]";
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
        if(!empty($type_id)) {
            $dataInfo['type_id'] = $type_id;
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
        return $noticeService->editInfo($dataInfo);
    }
}
