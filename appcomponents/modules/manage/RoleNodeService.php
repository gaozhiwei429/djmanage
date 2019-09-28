<?php
/**
 * 角色节点绑定关系管理
 * @文件名称: RoleNodeService.php
 * @author: jawei
 * @Email: gaozhiwei429@sina.com
 * @Mobile: 15910987706
 * @Date: 2018-12-01
 * @Copyright: 2017 北京往全保科技有限公司. All rights reserved.
 * 注意：本内容仅限于北京往全保科技有限公司内部传阅，禁止外泄以及用于其他的商业目的
 */
namespace appcomponents\modules\manage;
use appcomponents\modules\manage\models\RoleNodeModel;
use source\manager\BaseService;
use Yii;
class RoleNodeService extends BaseService {
    /**
     * 获取操作区域数据集合
     * @param $params
     * @param array $orderBy
     * @param int $offset
     * @param int $limit
     * @param array $field
     * @return array
     */
    public function getDatas($params, $orderBy = [], $offset=0, $limit=10, $field=['*']) {
        $roleModel = new RoleNodeModel();
        $dataArrs = $roleModel->getDatas($params, $orderBy, $offset, $limit, $field);
        if(!empty($dataArrs)) {
            return BaseService::returnOkData($dataArrs);
        }
        return BaseService::returnErrData($dataArrs, 53200, "请求数据不存在");
    }
    /**
     * 获取角色对应的数据权限详情数据
     * @param $params
     * @return array
     */
    public function getInfo($params) {
        if(!empty($params)) {
            $roleNodeModel = new RoleNodeModel();
            $dataInfo = $roleNodeModel->getInfoByValue($params);
            if(!empty($dataInfo)) {
                return BaseService::returnOkData($dataInfo);
            }
        }
        return BaseService::returnErrData([], 54700, "请求数据不存在");
    }
    /**
     * 批量更新支付详情数据
     * @param $params
     * @return array
     */
    public function updateAllDataListByParams($params, $updateData) {
        if(!empty($params) && is_array($params) && !empty($updateData) && is_array($updateData)) {
            $roleNodeModel = new RoleNodeModel();
            $updateRoleNode = $roleNodeModel->updateAllDataListByParams($params, $updateData);
            if($updateRoleNode) {
                return BaseService::returnOkData($updateRoleNode);
            }
        }
        return BaseService::returnErrData([], 56200, "更新数据失败");
    }
    /**
     * 批量添加数据
     * @param $roleNodeDatas
     * @return array
     */
    public function addDatas($roleNodeDatas) {
        if(!is_array($roleNodeDatas) || empty($roleNodeDatas)) {
            return BaseService::returnErrData([], 57300, "请求参数异常");
        }
        $roleNodeModel = new RoleNodeModel();
        $addRoleNode = $roleNodeModel->addAll($roleNodeDatas);
        if($addRoleNode) {
            return BaseService::returnOkData($addRoleNode);
        }
        return BaseService::returnErrData([], 57800, "添加数据异常");
    }
    /**
     * 角色授权接口
     * @param $role_id
     * @param $roleNodeData
     * @return array
     */
    public function saveData($role_id, $roleNodeData) {
        if($role_id<=0 || !is_array($roleNodeData) || empty($roleNodeData)) {
            return BaseService::returnErrData([], 57300, "请求参数异常");
        }
        //如果当前角色有对应的权限节点分配那么就更新对应权限的状态为无效，然后再讲对应的角色节点添加入库
        $infoParams[] = ['=', 'role_id', $role_id];
        $infoParams[] = ['=', 'status', 1];
        $roleNodeInfoRet = $this->getInfo($infoParams);
        $tr = Yii::$app->db->beginTransaction();
        $updateRoleNodeData = true;
        if(BaseService::checkRetIsOk($roleNodeInfoRet)) {
            $updateParams['role_id'] =  $role_id;
            $updateData['status'] =  0;
            $updateAllDataRet = $this->updateAllDataListByParams($updateParams, $updateData);
            if(!BaseService::checkRetIsOk($updateAllDataRet)) {
                $updateRoleNodeData = false;
            }
        }
        $rodeNodeDatas = [];
        foreach($roleNodeData as $k=>$roleNode) {
            $rodeNodeDatas[] = [
                'role_id' => $role_id,
                'status'=>1,
                'node'=>$roleNode,
            ];
        }
        $addRodeNodeDatasRet = $this->addDatas($rodeNodeDatas);
        if($updateRoleNodeData && BaseService::checkRetIsOk($addRodeNodeDatasRet)){
            $tr->commit();
            return BaseService::returnOkData($updateRoleNodeData);
        }
        $tr->rollBack();
        return BaseService::returnErrData([], 511800, "角色授权数据异常");
    }

}
