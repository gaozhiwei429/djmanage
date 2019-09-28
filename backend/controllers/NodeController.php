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
use source\manager\BaseService;
use Yii;

class NodeController extends BaseController {
    public $title = '系统角色管理';
    public $layout = 'content';
    public function beforeAction($action) {
        return parent::beforeAction($action);
    }
    /**
     * 显示节点列表
     * @return string
     */
    public function  actionIndex() {
        $role_id = 0;
        $nodeService = new NodeService();
        $nodesRet = $nodeService->getNodesCheck($role_id);
        $nodes = BaseService::getRetData($nodesRet);
        $nodes = ToolsService::arr2table($nodes, 'node', 'pnode');
        $groups = [];
        foreach ($nodes as $node) {
            $pnode = explode('/', $node['node'])[0];
            if ($node['node'] === $pnode) {
                $groups[$pnode]['node'] = $node;
            }
            $groups[$pnode]['list'][] = $node;
        }
        return $this->renderPartial('index',
            [
                'title' => '系统节点管理',
                'nodes' => $nodes,
                'groups' => $groups,
                'menuUrl' => $this->menuUrl
            ]
        );
//        return $this->fetch('', ['title' => '系统节点管理', 'nodes' => $nodes, 'groups' => $groups]);
    }

    /**
     * 清理无效的节点记录
     */
    public function clear()
    {
        $nodes = array_keys(NodeService::getNv());
//        if (false !== Db::name($this->table)->whereNotIn('node', $nodes)->delete()) {
//            $this->success('清理无效节点记录成功！', '');
//        }
//        $this->error('清理无效记录失败，请稍候再试！');
    }

    /**
     * 保存节点变更
     */
    public function save()
    {
//        if ($this->request->isPost()) {
//            list($post, $data) = [$this->request->post(), []];
//            foreach ($post['list'] as $vo) {
//                if (!empty($vo['node'])) {
//                    $data['node'] = $vo['node'];
//                    $data[$vo['name']] = $vo['value'];
//                }
//            }
//            !empty($data) && DataService::save($this->table, $data, 'node');
//            $this->success('参数保存成功！', '');
//        }
//        $this->error('访问异常，请重新进入...');
    }
}