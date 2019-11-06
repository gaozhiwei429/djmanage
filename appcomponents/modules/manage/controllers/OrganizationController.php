<?php
/**
 * 党组织相关的操作
 * @文件名称: OrganizationController.php
 * @author: jawei
 * @Email: gaozhiwei429@sina.com
 * @Date: 2017-12-06
 * @Copyright: 2017 北京往全包科技有限公司. All rights reserved.
 * 注意：本内容仅限于北京往全包科技有限公司内部传阅，禁止外泄以及用于其他的商业目的
 */
namespace appcomponents\modules\manage\controllers;
use appcomponents\modules\common\OrganizationService;
use source\controllers\ManageBaseController;
use source\manager\BaseService;
use \Yii;
class OrganizationController extends ManageBaseController
{
    /**
     * 用户登录态基础类验证
     * @return array
     */
    public function beforeAction($action){
        $userToken = parent::userToken();
        $getMenuUrl = parent::getMenuUrl();
        return parent::beforeAction($action);
    }
    /**
     * 党组织管理
     * @return string
     */
    public function actionManage() {

        $page = intval(Yii::$app->request->post('p', 1));
        $size = intval(Yii::$app->request->post('size', -1));
        $organizationService = new OrganizationService();
        $params = [];
        $params[] = ['!=', 'status', 0];
        $ret = $organizationService->getTree($params, ['sort'=>SORT_DESC], $page, $size, $fied=['*'], true);
        $treeData = BaseService::getRetData($ret);
//        print_r($treeData);die;
        return $this->renderPartial('manage',
            [
                'title' => "党组织管理",
                'treeData' => $treeData,
                'menuUrl' => $this->menuUrl,
            ]
        );
    }
    /**
     * 党组织管理
     * @return string
     */
    public function actionIndex() {
        $this->layout=false;
        $uuid = trim(Yii::$app->request->get('uuid', null));
        return $this->renderPartial('index',
            [
                'title' => "党组织管理",
                'uuid' => $uuid,
                'menuUrl' => $this->menuUrl,
            ]
        );
    }
}
