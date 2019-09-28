<?php
/**
 * 用户权限管理
 * @文件名称: AdminUserRegionService.php
 * @author: jawei
 * @Email: gaozhiwei429@sina.com
 * @Mobile: 15910987706
 * @Date: 2018-12-01
 * @Copyright: 2017 北京往全保科技有限公司. All rights reserved.
 * 注意：本内容仅限于北京往全保科技有限公司内部传阅，禁止外泄以及用于其他的商业目的
 */
namespace appcomponents\modules\manage;
use appcomponents\modules\manage\models\AdminUserRoleModel;
use source\manager\BaseService;
use Yii;
class AdminUserRoleService extends BaseService {
    /**
     * 获取操作数据集合
     * @param $params
     * @param array $orderBy
     * @param int $offset
     * @param int $limit
     * @param array $field
     * @return array
     */
    public function getDatas($params, $orderBy = [], $offset=0, $limit=10, $field=['*']) {
        $adminUserRegionModel = new AdminUserRoleModel();
        $dataArrs = $adminUserRegionModel->getDatas($params, $orderBy, $offset, $limit, $field);
        if(!empty($dataArrs)) {
            return BaseService::returnOkData($dataArrs);
        }
        return BaseService::returnErrData($dataArrs, 52500, "请求数据不存在");
    }
    /**
     * 获取指定用户的角色id集合
     * @param $admin_user_id
     * @return array
     */
    public function getUserRoleIds($admin_user_id) {
        $roleIds = [];
        $params[] = ['=', 'admin_user_id', $admin_user_id];
        $params[] = ['=', 'status', 1];
        $adminUserRegionModel = new AdminUserRoleModel();
        $dataArrs = $adminUserRegionModel->getDatas($params, [], 0, -1, ['role_id']);
        if(!empty($dataArrs)) {
            foreach($dataArrs as $dataInfo) {
                if(isset($dataInfo['role_id'])){
                    if($dataInfo['role_id']>0) {
                        $roleIds[] = $dataInfo['role_id'];
                    }
                }
            }
            if(!empty($roleIds)) {
                $roleIds = array_unique($roleIds);
                return BaseService::returnOkData($roleIds);
            }
        }
        return BaseService::returnErrData($roleIds, 52500, "当前用户没有分配角色");
    }
    /**
     * 创建或者编辑角色信息
     * @param $admin_user_id
     * @param $roleIds
     * @return array
     */
    public function editUserRole($admin_user_id, $roleIds) {
        $userRoleListRet = $this->getUserRoleIds($admin_user_id);
        $roleIdArr = [];
        if(BaseService::checkRetIsOk($userRoleListRet)) {
            $roleIdArr = BaseService::getRetData($userRoleListRet);
        }
        $addData = [];
        $updateData = [];
        $update = true;
        $add = true;
        if(!empty($roleIdArr)) {
            $updateAllParams['admin_user_id'] =  $admin_user_id;
            $updateData['status'] = 0;
            $updateRet = $this->updateAllDataListByParams($updateAllParams, $updateData);
            if(!BaseService::checkRetIsOk($updateRet)) {
                $update = false;
            }
        }
        if(!empty($roleIds) && is_array($roleIds)) {
            foreach($roleIds as $roleId) {
                $addData[] = [
                    'role_id'=>$roleId,
                    'admin_user_id'=>$admin_user_id,
                    'status'=>1,
                ];
            }
            if(!empty($addData)) {
                $addDataRet = $this->addDataAllInfo($addData);
                if(!BaseService::checkRetIsOk($addDataRet)) {
                    $add = false;
                }
            }
        }
        if($add || $update) {
            return BaseService::returnOkData($roleIds);
        }
        return BaseService::returnErrData($roleIds, 510000, "角色数据更新异常");
    }

    /**
     * 批量更新详情数据
     * @param $params
     * @return array
     */
    public function updateAllDataListByParams($params, $updateData) {
        if(!empty($params) && is_array($params) && !empty($updateData) && is_array($updateData)) {
            $adminUserRegionModel = new AdminUserRoleModel();
            $updateDetailInfo = $adminUserRegionModel->updateAllDataListByParams($params, $updateData);
            if($updateDetailInfo) {
                return BaseService::returnOkData($updateDetailInfo);
            }
        }
        return BaseService::returnErrData([], 551800, "更新支付数据详情失败");
    }
    /**
     * 添加批量支付的订单数据处理
     * @param $payData
     * @return array
     * @throws \yii\db\Exception
     */
    public function addDataAllInfo($dataAll) {
        if(!empty($dataAll)) {
            $adminUserRegionModel = new AdminUserRoleModel();
            $addAll = $adminUserRegionModel->addAll($dataAll);
            if($addAll){
                return BaseService::returnOkData($addAll);
            }else{
                return BaseService::returnErrData([], 59200, "提交数据异常");
            }
        }
        return BaseService::returnErrData([], 519200, "提交数据不存在");
    }
}
