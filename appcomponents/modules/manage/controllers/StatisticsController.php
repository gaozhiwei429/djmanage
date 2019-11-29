<?php
/**
 * 统计相关的操作
 * @文件名称: StatisticsController.php
 * @author: jawei
 * @Email: gaozhiwei429@sina.com
 * @Date: 2017-12-06
 * @Copyright: 2017 北京往全包科技有限公司. All rights reserved.
 * 注意：本内容仅限于北京往全包科技有限公司内部传阅，禁止外泄以及用于其他的商业目的
 */
namespace appcomponents\modules\manage\controllers;
use appcomponents\modules\common\LevelService;
use source\controllers\ManageBaseController;
use source\manager\BaseService;
use \Yii;
class StatisticsController extends ManageBaseController
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
    public function actionUserProfile() {
        return $this->renderPartial('user-profile',
            [
                'title' => "人员统计",
                'menuUrl' => $this->menuUrl,
            ]
        );
    }
    public function actionDangyuanProfile() {
        return $this->renderPartial('dangyuan-profile',
            [
                'title' => "党员统计",
                'menuUrl' => $this->menuUrl,
            ]
        );
    }
    public function actionMeetingProfile() {
        return $this->renderPartial('meeting-profile',
            [
                'title' => "会议统计",
                'menuUrl' => $this->menuUrl,
            ]
        );
    }
}
