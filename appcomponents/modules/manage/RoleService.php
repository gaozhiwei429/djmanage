<?php
/**
 * 角色管理
 * @文件名称: RoleService.php
 * @author: jawei
 * @Email: gaozhiwei429@sina.com
 * @Mobile: 15910987706
 * @Date: 2018-12-01
 * @Copyright: 2017 北京往全保科技有限公司. All rights reserved.
 * 注意：本内容仅限于北京往全保科技有限公司内部传阅，禁止外泄以及用于其他的商业目的
 */
namespace appcomponents\modules\manage;
use appcomponents\modules\common\models\NodeModel;
use appcomponents\modules\common\models\RegionModel;
use appcomponents\modules\common\NodeService;
use appcomponents\modules\manage\ManageService;
use appcomponents\modules\manage\models\RoleModel;
use source\libs\Common;
use source\manager\BaseService;
use Yii;
use yii\helpers\Url;

class RoleService extends BaseService {
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
        $roleModel = new RoleModel();
        $dataArrs = $roleModel->getDatas($params, $orderBy, $offset, $limit, $field);
        if(!empty($dataArrs)) {
            return BaseService::returnOkData($dataArrs);
        }
        return BaseService::returnErrData($dataArrs, 52500, "请求数据不存在");
    }
    /**
     * 获取数据集合
     * @param $params
     * @param array $orderBy
     * @param int $offset
     * @param int $limit
     * @param array $field
     * @return array
     */
    public function getListData($params, $orderBy = [], $offset=0, $limit=10, $field=['*']) {
        $roleModel = new RoleModel();
        $roleDataList = $roleModel->getListData($params, $orderBy, $offset, $limit, $field);
        if(!empty($roleDataList)) {
            return BaseService::returnOkData($roleDataList);
        }
        return BaseService::returnErrData($roleDataList, 55000, "请求数据不存在");
    }
    /**
     * 根据管理用户id获取角色id集合
     * @param $user_id
     * @return array
     */
    public function getRoleIds($user_id) {
        $roleIds = [];
        if ($user_id) {
            $managerService = new ManageService();
            $managerInfoRet = $managerService->getUserInfoByUserId($user_id);
            $managerInfo = BaseService::getRetData($managerInfoRet);
            if(isset($managerInfo['status']) && $managerInfo['status']==0) {
                return [];
            }
            $adminUserRoleService = new UserRoleService();
            $adminUserRoleParams[] = ['=', 'user_id', $user_id];
            $adminUserRoleParams[] = ['=', 'status', 1];
            $adminUserRoleListRet = $adminUserRoleService->getDatas($adminUserRoleParams, [], 0, -1, ['role_id']);
            if(BaseService::checkRetIsOk($adminUserRoleListRet)) {
                $adminUserRoleList = BaseService::getRetData($adminUserRoleListRet);
                foreach($adminUserRoleList as $dataInfo) {
                    if(isset($dataInfo['role_id'])){
                        if($dataInfo['role_id']>0) {
                            $roleIds[] = $dataInfo['role_id'];
                        } else {
                            $roleIds = 0;
                        }
                    }
                }
            }
        }
        if($roleIds) {
            return BaseService::returnOkData($roleIds);
        }
        return BaseService::returnErrData([], 512000, "暂无分配权限");
    }
}
