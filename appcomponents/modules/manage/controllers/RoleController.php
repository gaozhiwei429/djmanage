<?php
/**
 * 角色相关的操作
 * @文件名称: RoleController.php
 * @author: jawei
 * @Email: gaozhiwei429@sina.com
 * @Date: 2017-12-06
 * @Copyright: 2017 北京往全包科技有限公司. All rights reserved.
 * 注意：本内容仅限于北京往全包科技有限公司内部传阅，禁止外泄以及用于其他的商业目的
 */
namespace appcomponents\modules\manage\controllers;
use appcomponents\modules\common\CommonService;
use appcomponents\modules\common\MenuService;
use appcomponents\modules\common\NodeService;
use appcomponents\modules\common\ToolsService;
use appcomponents\modules\manage\ManageService;
use appcomponents\modules\manage\RoleNodeService;
use appcomponents\modules\manage\RoleService;
use source\controllers\ManageBaseController;
use source\manager\BaseService;
use \Yii;

class RoleController extends ManageBaseController
{
    /**
     * 用户登录态基础类验证
     * @return array
     */
    public function beforeAction($action){
        $this->noLogin=true;
        $userToken = parent::userToken();
        return parent::beforeAction($action);
    }
    /**
     * 获取用户权限列表数据
     * @return array
     */
    public function actionGetList() {
        if(!isset($this->user_id) || !$this->user_id) {
            return BaseService::returnErrData([], 5001, "当前授权异常");
        }
        $page = intval(Yii::$app->request->post('page', 1));
        $size = intval(Yii::$app->request->post('limit', 10));
        $roleService = new RoleService();
        $params[] = ['=', 'status', 1];
        return $roleService->getListData($params, [], $page, $size);
    }
    /**
     * 根据管理用户id获取角色id集合
     * @param $manager_user_id
     * @return array
     */
    public function actionGetRoles() {
        if(!isset($this->user_id) || !$this->user_id) {
            return BaseService::returnErrData([], 5001, "当前授权异常");
        }
        $roleNodeService = new RoleService();
        return $roleNodeService->getRoleIds($this->user_id);
    }
    /**
     * 应用用户权限节点
     */
    public function actionApplyAuthNode() {
        if(!isset($this->user_id) || !$this->user_id) {
            return BaseService::returnErrData([], 5001, "当前授权异常");
        }
        $roleNodeService = new NodeService();
        return $roleNodeService->applyAuthNode($this->user_id);
    }
    /**
     * 保存授权节点
     * @param string $role
     */
    public function actionSave() {
        $role_id = intval(Yii::$app->request->post('id', 0));
        $nodes = Yii::$app->request->post('nodes', []);
        $roleNodeService = new RoleNodeService();
        if($role_id<=0 || !is_array($nodes) || empty($nodes)) {
            return BaseService::returnErrData([], 59300, "请求参数异常");
        }
        return $roleNodeService->saveData($role_id, $nodes);
    }
}
