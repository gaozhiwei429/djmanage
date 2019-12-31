<?php
/**
 * 党史上的今天相关的接口
 * @文件名称: DangHistoryController.php
 * @author: jawei
 * @Email: gaozhiwei429@sina.com
 * @Mobile: 15910987706
 * @Date: 2018-12-01
 * @Copyright: 2017 北京往全保科技有限公司. All rights reserved.
 * 注意：本内容仅限于北京往全保科技有限公司内部传阅，禁止外泄以及用于其他的商业目的
 */
namespace appcomponents\modules\manage\controllers;
use appcomponents\modules\common\DangHistoryService;
use appcomponents\modules\common\DangTodayService;
use source\controllers\ManageBaseController;
use source\manager\BaseService;
use Yii;
class DangHistoryController extends ManageBaseController
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
                'title' => "党史上的今天",
                'menuUrl' => $this->menuUrl,
            ]
        );
    }

    /**
     * 详情数据获取
     * @return array
     */
    public function actionInfo() {
        $dang_today_id = intval(Yii::$app->request->get('id', 0));
        $dangTodayList = [];
        if($dang_today_id) {
            $dangTodayService = new DangHistoryService();
            $params = [];
            $params[] = ['=', 'dang_today_id', $dang_today_id];
            $dangTodayDataListRet = $dangTodayService->getList($params, [], 1, -1,['*']);
            if(BaseService::checkRetIsOk($dangTodayDataListRet)) {
                $dangTodayDataList = BaseService::getRetData($dangTodayDataListRet);
                if(isset($dangTodayDataList['dataList'])) {
                    $dangTodayList = $dangTodayDataList['dataList'];
                }
            }
        }
        return $this->renderPartial('info',
            [
                'title' => "党史上的今天",
                'menuUrl' => $this->menuUrl,
                'dang_today_id' => $dang_today_id,
                'dangTodayList' => $dangTodayList,
            ]
        );
    }
}
