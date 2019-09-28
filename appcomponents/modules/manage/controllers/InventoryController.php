<?php
/**
 * 清单
 * @文件名称: InventoryController.php
 * @author: jawei
 * @Email: gaozhiwei429@sina.com
 * @Date: 2017-12-06
 * @Copyright: 2017 北京往全包科技有限公司. All rights reserved.
 * 注意：本内容仅限于北京往全包科技有限公司内部传阅，禁止外泄以及用于其他的商业目的
 */
namespace appcomponents\modules\manage\controllers;
use appcomponents\modules\common\AdminConcernGroupService;
use appcomponents\modules\common\BindPrinterService;
use source\controllers\ManageBaseController;
use source\manager\BaseService;
use \Yii;
class InventoryController extends ManageBaseController
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
    public function actionIndex() {
        //获取打印机的分组
        $params[] = ['in', 'user_id', [$this->user_id,0,]];
        $params[] = ['=', 'status', 1];
        $AdminConcernGroupService = new AdminConcernGroupService();
        $groupListRet = $AdminConcernGroupService->getList($params, [], 1, -1, ['*']);
        $groupList = BaseService::getRetData($groupListRet);
        return $this->renderPartial('index',
            [
                'title' => "绑定记录",
                'menuUrl' => $this->menuUrl,
                'group'=>isset($groupList['dataList']) ? $groupList['dataList'] : [],
            ]
        );
    }
}
