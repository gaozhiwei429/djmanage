<?php
/**
 * 系统权限节点读取器
 * @文件名称: NodeService.php
 * @author: jawei
 * @Email: gaozhiwei429@sina.com
 * @Mobile: 15910987706
 * @Date: 2018-12-01
 * @Copyright: 2017 北京往全保科技有限公司. All rights reserved.
 * 注意：本内容仅限于北京往全保科技有限公司内部传阅，禁止外泄以及用于其他的商业目的
 */
namespace appcomponents\modules\common;
use appcomponents\modules\common\models\NodeModel;
use appcomponents\modules\manage\AdminUserRoleService;
use appcomponents\modules\manage\ManageService;
use appcomponents\modules\manage\RegionService;
use appcomponents\modules\manage\RoleNodeService;
use appcomponents\modules\manage\RoleService;
use source\libs\Common;
use source\manager\BaseService;
use Yii;
class NodeService extends BaseService {
    /**
     * 获取操作菜单数据集合
     * @param $params
     * @param array $orderBy
     * @param int $offset
     * @param int $limit
     * @param array $field
     * @return array
     */
    public function getDatas($params, $orderBy = [], $offset=0, $limit=10, $field=['*']) {
        $nodeModel = new NodeModel();
        $dataArrs = $nodeModel->getDatas($params, $orderBy, $offset, $limit, $field);
        if(!empty($dataArrs)) {
            return BaseService::returnOkData($dataArrs);
        }
        return BaseService::returnErrData($dataArrs, 52500, "请求数据不存在");
    }
    /**
     * 获取授权节点
     * @return array
     */
    public function getAuthNode($manager_user_id) {
        return $this->applyAuthNode($manager_user_id);
    }

    /**
     * 检查用户节点权限
     * @param string $node 节点
     * @return bool
     */
    public function checkAuthNode($manager_user_id, $node) {
        if(!$manager_user_id) {
            $manageService = new ManageService();
            $manager_user_id = $manageService->getUserId();
        }
        if(!$manager_user_id) {
            return false;
        }
        list($module, $controller, $action) = explode('/', str_replace(['?', '=', '&'], '/', $node . '///'));
        $currentNode = Common::parseNodeStr("{$module}/{$controller}") . strtolower("/{$action}");
        if (stripos($node, 'admin/index') === 0) {
            return true;
        }
        if (!in_array($currentNode, self::getAuthNode($manager_user_id))) {
            return true;
        }
        return in_array($currentNode, self::getAuthNode($manager_user_id));
    }
    /**
     * 获取节点数据
     * @param $params
     * @param array $orderBy
     * @param int $offset
     * @param int $limit
     * @param array $field
     * @param string $indexKey
     * @return array
     */
    public function getNodesIndex($params, $orderBy = [], $offset=0, $limit=10, $field=['*'], $indexKey="node") {
        $nodeListRet = $this->getDatas($params, $orderBy, $offset, $limit, $field);
        $nodeDataList = [];
        $nodeList = BaseService::getRetData($nodeListRet);
        if(!empty($nodeList)) {
            if($indexKey) {
                foreach($nodeList as $nodeKey=>$nodeInfo) {
                    if(isset($nodeInfo[$indexKey])) {
                        $nodeDataList[$nodeInfo[$indexKey]] = $nodeInfo;
                    }
                }
                return BaseService::returnOkData($nodeDataList);
            }
            return BaseService::returnOkData($nodeList);
        }
        return BaseService::returnErrData($nodeList, 59800, "暂无节点数据");
    }
    /**
     * 节点数据拼装
     * @param array $nodes
     * @param int $level
     * @return array
     */
    public function applyFilter($nodes, $level = 1) {
        foreach ($nodes as $key => $node) {
            if (!empty($node['_sub_']) && is_array($node['_sub_'])) {
                $node[$key]['_sub_'] = $this->applyFilter($node['_sub_'], $level + 1);
            }
        }
        return $nodes;
    }
    /**
     * 获取当前角色下面的节点以及是否选中状态
     * @param $role_id
     * @return array
     */
    public function getNodesCheck($role_id) {
        $roleNodeService = new RoleNodeService();
        $params = [];
        $role_id = $role_id ? $role_id : 5;
        if($role_id) {
            $params[] = ['=', 'role_id', $role_id];
        }
        $roleNodeListRet = $roleNodeService->getDatas($params, [], 0, -1, ['node']);
        $roleNodeDataList = BaseService::getRetData($roleNodeListRet);
        $roleNodeList = (!empty($roleNodeDataList) && isset($roleNodeDataList[0]['node'])) ? array_column($roleNodeDataList, 'node') : [];
        $nodesDataListRet = $this->getNodes();
        $nodesDataList = BaseService::getRetData($nodesDataListRet);
        if(!empty($nodesDataList)) {
            foreach ($nodesDataList as &$node) {
                $node['checked'] = in_array($node['node'], $roleNodeList);
            }
            return BaseService::returnOkData($nodesDataList);
        }
        return $nodesDataListRet;
    }
    /**
     * 获取所有的权限节点数据集合
     */
    public function getNodes() {
        $nodesIndexListRet = $this->getNodesIndex([], [], 0, -1, ['*'], "node");
        $nodesIndexList = BaseService::getRetData($nodesIndexListRet);
        $nodes = [];
        foreach($nodesIndexList as $k=>$aliasInfo) {
            $aliasInfo['node'] = trim($aliasInfo['node'],'/');
            $tmp = explode('/', $aliasInfo['node']);
            if(is_array($tmp) && !empty($tmp)) {
                array_unique($tmp);
            }
            $tmp0 = isset($tmp[0]) ? $tmp[0] : "";
            $tmp1 = isset($tmp[1]) ? $tmp[1] : "";
            if(count($tmp)==1) {
                $pnode = "";
            } else if(count($tmp)==2) {
                $pnode = "$tmp0";
            } else if(count($tmp)==3) {
                $pnode = "$tmp0/$tmp1";
            }
            $nodes[$aliasInfo['node']] = array_merge($aliasInfo, ['pnode' => $pnode]);
        }
        return BaseService::returnOkData($nodes);
    }
    /**
     * 应用用户权限节点
     */
    public static function applyAuthNode($manager_user_id) {
        $roleIds = [];
        if ($manager_user_id) {
            $roleService = new RoleService();
            $roleIdsRet = $roleService->getRoleIds($manager_user_id);
            if(BaseService::checkRetIsOk($roleIdsRet)) {
                $roleIds = BaseService::getRetData($roleIdsRet);
            }
        }
        $nodeDatas = [];
        if (!empty($roleIds) && is_array($roleIds)) {
            $roleNodeParams[] = ['in', 'role_id', $roleIds];
            $roleNodeParams[] = ['=', 'status', 1];
            $roleNodeService = new RoleNodeService();
            $roleNodeServiceListRet = $roleNodeService->getDatas($roleNodeParams, [], 0, -1, ['node']);
        } else if($roleIds == 0){
            $roleNodeService = new RoleNodeService();
            $roleNodeParams[] = ['=', 'status', 1];
            $roleNodeServiceListRet = $roleNodeService->getDatas($roleNodeParams, [], 0, -1, ['node']);
        } else {
            return [];
        }
        if(BaseService::checkRetIsOk($roleNodeServiceListRet)) {
            $roleNodeServiceList = BaseService::getRetData($roleNodeServiceListRet);
            foreach($roleNodeServiceList as $roleNodeServiceInfo) {
                $nodeDatas[] = $roleNodeServiceInfo;
            }
        }
        return $nodeDatas;
    }
}
