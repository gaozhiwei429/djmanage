<?php
/**
 * 用户关注分组
 * @文件名称: ConcernGroupController.php
 * @author: jawei
 * @Email: gaozhiwei429@sina.com
 * @Date: 2017-12-06
 * @Copyright: 2017 北京往全包科技有限公司. All rights reserved.
 * 注意：本内容仅限于北京往全包科技有限公司内部传阅，禁止外泄以及用于其他的商业目的
 */
namespace appcomponents\modules\manage\controllers;
use appcomponents\modules\common\AdminConcernGroupService;
use source\controllers\ManageBaseController;
use source\manager\BaseService;
use \Yii;
class ConcernGroupController extends ManageBaseController
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
        $user_id = intval(Yii::$app->request->get('user_id', 0));
        return $this->renderPartial('index',
            [
                'title' => "关注分组列表管理",
                'menuUrl' => $this->menuUrl,
                'user_id' => $user_id,
            ]
        );
    }
    public function actionEdit() {
        $id = intval(Yii::$app->request->get('id', 0));
        $info = [];
        if($id) {
            $adminConcernGroupService = new AdminConcernGroupService();
            $params[] = ['=', 'id', $id];
            $adminConcernGroupRet = $adminConcernGroupService->getInfo($params);
            $info = BaseService::getRetData($adminConcernGroupRet);
        }
        return $this->renderPartial('edit',
            [
                'title' => "关注分组编辑",
                'menuUrl' => $this->menuUrl,
                'id' => $id,
                'info'=> $info,
            ]
        );
    }
}
