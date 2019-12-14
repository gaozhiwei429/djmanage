<?php
/**
 * 运营平台用户与党组织关系管理表获取service
 * @文件名称: UserOrganizationService.php
 * @author: jawei
 * @Email: gaozhiwei429@sina.com
 * @Mobile: 15910987706
 * @Date: 2018-12-01
 * @Copyright: 2017 北京往全保科技有限公司. All rights reserved.
 * 注意：本内容仅限于北京往全保科技有限公司内部传阅，禁止外泄以及用于其他的商业目的
 */
namespace appcomponents\modules\common;
use appcomponents\modules\common\models\UserOrganizationModel;
use source\libs\Common;
use source\manager\BaseException;
use source\manager\BaseService;
use Yii;
class UserOrganizationService extends BaseService
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'appcomponents\modules\common\controllers';
    /**
     * @inheritdoc
     */
    public function init() {
        parent::init();
    }

    /**
     * 数据获取
     * @param $addData
     * @return array
     */
    public function getList($params = [], $orderBy = [], $p = 1, $limit = 10, $fied=['*']) {
        $Common = new Common();
        $offset = $Common->getOffset($limit, $p);
        $carModel = new UserOrganizationModel();
        $cityList = $carModel->getListData($params, $orderBy, $offset, $limit, $fied);
        if(!empty($cityList)) {
            return BaseService::returnOkData($cityList);
        }
        return BaseService::returnErrData([], 500, "暂无数据");
    }
    /**
     * 获取详情数据
     * @param $params
     * @return array
     */
    public function getInfo($params) {
        if(empty($params)) {
            return BaseService::returnErrData([], 55000, "请求参数异常");
        }
        $bannerModel = new UserOrganizationModel();
        $bannerInfo = $bannerModel->getInfoByValue($params);
        if(!empty($bannerInfo)) {
            return BaseService::returnOkData($bannerInfo);
        }
        return BaseService::returnErrData([], 500, "暂无数据");
    }
    /**
     * 编辑详情数据
     * @param $params
     * @return array
     */
    public function editInfo($dataInfo) {
        if(empty($dataInfo)) {
            return BaseService::returnErrData([], 56900, "请求参数异常");
        }
        $bannerModel = new UserOrganizationModel();
        $id = isset($dataInfo['id']) ? $dataInfo['id'] : 0;
        $editRest = 0;
        if($id) {
            if(isset($dataInfo['id'])) {
                unset($dataInfo['id']);
            }
            $editRest = $bannerModel->updateInfo($id, $dataInfo);
        } else {
            $editRest = $bannerModel->addInfo($dataInfo);
        }
        if(!empty($editRest)) {
            return BaseService::returnOkData($editRest);
        }
        return BaseService::returnErrData([], 500, "操作异常");
    }
    /**
     * 创建当前用户的所属党组织和职务
     * @param $user_id
     * @param $organizationIds
     * @param $levelIds
     * @return array
     */
    public function editOrganizations($user_id, $organizationIds, $levelIds) {
        if((!empty($organizationIds) && is_array($organizationIds)) && (!empty($levelIds) && is_array($levelIds))) {
            if(count($levelIds) != count($organizationIds)) {
                return BaseService::returnErrData([], 510300, "请核实党组织职务是否选择");
            }
        }
        $userOrganizationModel = new UserOrganizationModel();
        $params['user_id'] = $user_id;
        $updateData['status'] = $userOrganizationModel::DELECT_STATUS;
        $userOrganizationModel->batchUpdate($params, $updateData);
        $dataArrays = [];
        foreach($organizationIds as $k=>$organizationId) {
            if(intval($organizationId) && isset($levelIds[$k]) && intval($levelIds[$k])) {
                $dataArrays[] = [
                    'user_id' => $user_id,
                    'organization_id' => $organizationId,
                    'level_id' => $levelIds[$k],
                    'status' => $userOrganizationModel::ON_LINE_STATUS,
                ];
            }
        }
        if(!empty($dataArrays) && is_array($dataArrays)) {
            $addOrganizationRet = $userOrganizationModel->addAll($dataArrays);
            if($addOrganizationRet) {
                return BaseService::returnOkData($addOrganizationRet);
            }
        }
        return BaseService::returnErrData([], 511500, "添加职务失败");
    }
    /**
     * 批量创建党组织关系数据
     * @param $datas
     * @return array
     */
    public function addDatas($datas) {
        if(!empty($datas) && is_array($datas)) {
            $userOrganizationModel = new UserOrganizationModel();
            $addUserOrganization = $userOrganizationModel->addAll($datas);
            if($addUserOrganization) {
                return BaseService::returnOkData($addUserOrganization);
            }
            return BaseService::returnErrData([], 513000, "添加失败");
        }
        return BaseService::returnErrData([], 513500, "请求参数异常");
    }
}
