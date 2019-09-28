<?php
/**
 * 入口
 * @文件名称: web.php
 * @author: jawei
 * @Email: gaozhiwei429@sina.com
 * @Mobile: 15910987706
 * @Date: 2018-12-01
 * @Copyright: 2018 北京往全保科技有限公司. All rights reserved.
 * 注意：本内容仅限于北京往全保科技有限公司内部传阅，禁止外泄以及用于其他的商业目的
 */
namespace backend\controllers;
use appcomponents\modules\common\NodeService;
use appcomponents\modules\common\ToolsService;
use appcomponents\modules\manage\RoleNodeService;
use source\manager\BaseService;
use Yii;
use yii\helpers\Url;
class RoleController extends BaseController {
    public $title = '系统角色管理';
    public $layout = 'content';
    public function beforeAction($action) {
        parent::getMenuUrl();
        //获取增删改查的权限
        return parent::beforeAction($action);
//        $this->layout = 'content';//设置使用的布局文件
//        return $ret;
    }
    /**
     * 前端(单页面应用)入口
     */
    public function actionIndex() {
        return $this->renderPartial('index',
            [
                'title' => $this->title,
                'menuUrl' => $this->menuUrl,
            ]
        );
    }
    /**
     * 角色编辑
     */
    public function actionEdit() {
        return $this->renderPartial('edit',
            [
                'title' => "角色编辑",
                'menuUrl' => $this->menuUrl,
            ]
        );
    }
    /**
     * 授权
     */
    public function actionApply() {
        $role_id = intval(Yii::$app->request->get('id', 0));
        $action = strtolower(Yii::$app->request->get('action', null));
        if($action) {
            $method = 'actionApply' . ucfirst($action);
            if (method_exists($this, $method)) {
                return $this->$method($role_id);
            }
        }
        return $this->renderPartial('apply',
            [
                'title' => "角色编辑",
                'role_id' => $role_id,
                'menuUrl' => $this->menuUrl,
            ]
        );
    }

    /**
     * 读取授权节点
     * @param string $role_id
     */
    protected function actionApplyGetnode($role_id) {
        $nodeService = new NodeService();
        $nodesRet = $nodeService->getNodesCheck($role_id);
        $nodes = BaseService::getRetData($nodesRet);
        $all = $nodeService->applyFilter(ToolsService::arr2tree($nodes, 'node', 'pnode', '_sub_'));
        return BaseService::returnOkData($all);
    }

    /**
     * 保存授权节点
     * @param string $role
     */
    protected function _apply_save($role_id)
    {
        list($data, $post) = [[], $this->request->post()];
        foreach (isset($post['nodes']) ? $post['nodes'] : [] as $node) {
            $data[] = ['role_id' => $role_id, 'node' => $node];
        }
        Db::name('RoleNode')->where(['role_id' => $role_id])->delete();
        Db::name('RoleNode')->insertAll($data);
        $this->success('节点授权更新成功！', '');
    }
}