<?php
/**
 * 评论相关的操作
 * @文件名称: FeebackController
 * @author: jawei
 * @Email: gaozhiwei429@sina.com
 * @Date: 2017-12-06
 * @Copyright: 2017 北京往全包科技有限公司. All rights reserved.
 * 注意：本内容仅限于北京往全包科技有限公司内部传阅，禁止外泄以及用于其他的商业目的
 */
namespace appcomponents\modules\manage\controllers;
use appcomponents\modules\common\CourseService;
use appcomponents\modules\common\CourseTypeService;
use appcomponents\modules\common\LessionService;
use appcomponents\modules\common\SectionsService;
use source\controllers\ManageBaseController;
use source\manager\BaseService;
use \Yii;
class FeedbackController extends ManageBaseController
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
                'title' => "评论管理",
                'menuUrl' => $this->menuUrl,
            ]
        );
    }
}
