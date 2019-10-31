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
use appcomponents\modules\common\BannerService;
use appcomponents\modules\common\NewsService;
use source\controllers\ManageBaseController;
use source\manager\BaseService;
use Yii;
class BannerController extends ManageBaseController
{
    public function beforeAction($action){
        $userToken = parent::userToken();
        if (!BaseService::checkRetIsOk($userToken)) {
            return $userToken;
        }
        return parent::beforeAction($action);
    }
    /**
     * 首页banner获取
     * @return array
     */
    public function actionGetBanners() {
        if (!isset($this->user_id) || !$this->user_id) {
            return BaseService::returnErrData([], 5001, "当前账号登陆异常");
        }
        $page = intval(Yii::$app->request->post('p', 1));
        $size = intval(Yii::$app->request->post('size', 10));
        $bannerService = new BannerService();
        $params = [];
//        $params[] = ['>=', 'create_time', date('Y-m-d H:i:s')];
//        $params[] = ['>=', 'overdue_time', date('Y-m-d H:i:s')];
        return $bannerService->getBannerList($params, ['sort'=>SORT_DESC], $page, $size);
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
        $bannerService = new BannerService();
        $params = [];
        $params[] = ['=', 'id', $id];
        return $bannerService->getInfo($params);
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
        $sort = intval(Yii::$app->request->post('sort', 0));
        $pic_url = trim(Yii::$app->request->post('pic_url', ""));
        $news_id = intval(Yii::$app->request->post('news_id', 0));
        $url = trim(Yii::$app->request->post('url',  ""));
        $overdue_time = trim(Yii::$app->request->post('overdue_time',  date("Y-m-d H:i:s",strtotime("+1years",time()))));
        $status = intval(Yii::$app->request->post('status',  0));
        $type = intval(Yii::$app->request->post('type',  1));
        $bannerService = new BannerService();
        if(empty($title) || empty($pic_url) || ( empty($news_id) && empty($url)) ) {
            return BaseService::returnErrData([], 55900, "请求参数异常，请填写完整");
        }
        if($news_id) {
            $newsService = new NewsService();
            $params[] = ['=', 'id', $news_id];
            $newsInfoRet = $newsService->getInfo($params);
            if(!BaseService::checkRetIsOk($newsInfoRet)) {
                return BaseService::returnErrData([], 58100, "提交的产品id数据不存在");
            }
        }
        $dataInfo = [];
        if(!empty($title)) {
            $dataInfo['title'] = $title;
        } else {
            $dataInfo['title'] = "";
        }
        if(!empty($sort)) {
            $dataInfo['sort'] = $sort;
        } else {
            $dataInfo['sort'] = 0;
        }
        if(!empty($pic_url)) {
            $dataInfo['pic_url'] = $pic_url;
        } else {
            $dataInfo['pic_url'] = "";
        }
        if(!empty($news_id)) {
            $dataInfo['news_id'] = $news_id;
        } else {
            $dataInfo['news_id'] = 0;
        }
        if(!empty($type)) {
            $dataInfo['type'] = $type;
        }
        if(!empty($url)) {
            $dataInfo['url'] = $url;
        } else {
            $dataInfo['url'] = "";
        }
        if(!empty($overdue_time)) {
            $dataInfo['overdue_time'] = $overdue_time;
        } else {
            $dataInfo['overdue_time'] = "";
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
        return $bannerService->editInfo($dataInfo);
    }
    /**
     * banner详情数据状态编辑
     * @return array
     */
    public function actionSetStatus() {
        if (!isset($this->user_id) || !$this->user_id) {
            return BaseService::returnErrData([], 5001, "当前账号登陆异常");
        }
        $id = intval(Yii::$app->request->post('id', 0));
        $status = intval(Yii::$app->request->post('status',  0));
        $bannerService = new BannerService();
        if(empty($id)) {
            return BaseService::returnErrData([], 58000, "请求参数异常，请填写完整");
        }
        $dataInfo['id'] = $id;
        $dataInfo['status'] = $status;
        return $bannerService->editInfo($dataInfo);
    }
}
