<?php
/**
 * 运营平台党员相关的管理表获取service
 * @文件名称: DangyuanService.php
 * @author: jawei
 * @Email: gaozhiwei429@sina.com
 * @Mobile: 15910987706
 * @Date: 2018-12-01
 * @Copyright: 2017 北京往全保科技有限公司. All rights reserved.
 * 注意：本内容仅限于北京往全保科技有限公司内部传阅，禁止外泄以及用于其他的商业目的
 */
namespace appcomponents\modules\common;
use appcomponents\modules\common\models\UserOrganizationModel;
use appcomponents\modules\passport\PassportService;
use source\libs\Common;
use source\manager\BaseException;
use source\manager\BaseService;
use Yii;
class DangyuanService extends BaseService
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
        $organizationIds = [];
        $userIds = [];
        $levelIds = [];
        $organizationData = [];
        $passportData = [];
        if(!empty($cityList)) {
            if(isset($cityList['dataList']) && !empty($cityList['dataList'])) {
                $dataList = $cityList['dataList'];
                foreach($dataList as $k=>$dataInfo) {
                    if(isset($dataInfo['organization_id'])) {
                        $organizationIds[] = $dataInfo['organization_id'];
                    }
                    if(isset($dataInfo['user_id'])) {
                        $userIds[] = $dataInfo['user_id'];
                    }
                    if(isset($dataInfo['level_id'])) {
                        $levelIds[] = $dataInfo['level_id'];
                    }
                }
                if(!empty($organizationIds)) {
                    $organizationParams[] = ['in', 'id', $organizationIds];
                    $organizationService = new OrganizationService();
                    $organizationRest = $organizationService->getList($organizationParams, [], 1, -1, ['*'], true);
                    if(BaseService::checkRetIsOk($organizationRest)) {
                        $organizationDataList = BaseService::getRetData($organizationRest);
                        $organizationData = isset($organizationDataList['dataList']) ? $organizationDataList['dataList'] : [];
                    }
                }
                if(!empty($userIds)) {
                    $passportParams[] = ['in', 'id', $userIds];
                    $passportService = new PassportService();
                    $passportRest = $passportService->getList($passportParams, [], 1, -1, ['*'], true, true);
                    if(BaseService::checkRetIsOk($passportRest)) {
                        $passportDataList = BaseService::getRetData($passportRest);
                        $passportData = isset($passportDataList['dataList']) ? $passportDataList['dataList'] : [];
                    }
                }
                if(!empty($levelIds)) {
                    $passportParams[] = ['in', 'id', $levelIds];
                    $levelService = new LevelService();
                    $levelRest = $levelService->getList($passportParams, [], 1, -1, ['*'], true);
                    if(BaseService::checkRetIsOk($levelRest)) {
                        $levelDataList = BaseService::getRetData($levelRest);
                        $levelData = isset($levelDataList['dataList']) ? $levelDataList['dataList'] : [];
                    }
                }
                foreach($dataList as $k=>&$dataInfo) {
                    $dataInfo['username'] = "";
                    $dataInfo['nickname'] = "";
                    $dataInfo['organization_title'] = "";
                    $dataInfo['level_title'] = "";
                    if(isset($dataInfo['user_id']) && isset($passportData[$dataInfo['user_id']])) {
                        $dataInfo['username'] = isset($passportData[$dataInfo['user_id']]['username']) ? $passportData[$dataInfo['user_id']]['username'] : "";
                        $dataInfo['nickname'] = isset($passportData[$dataInfo['user_id']]['nickname']) ? $passportData[$dataInfo['user_id']]['nickname'] : "";
                    }
                    if(isset($dataInfo['organization_id']) && isset($organizationData[$dataInfo['organization_id']])) {
                        $dataInfo['organization_title'] = isset($organizationData[$dataInfo['organization_id']]['title']) ? $organizationData[$dataInfo['organization_id']]['title'] : "";
                    }
                    if(isset($dataInfo['level_id']) && isset($levelData[$dataInfo['level_id']])) {
                        $dataInfo['level_title'] = isset($levelData[$dataInfo['level_id']]['title']) ? $levelData[$dataInfo['level_id']]['title'] : "";
                    }
                }
                return BaseService::returnOkData($dataList);
            }
            return BaseService::returnOkData($cityList);
        }
        return BaseService::returnErrData([], 500, "暂无数据");
    }
    /**
     * 给当前账号添加组织关系
     * @param $mobile
     * @param string $password
     * @param array $userInfoData
     * @param array $organizationIds
     * @param array $level
     */
    public function editOrganizationDangyuan($mobile, $password="", $userInfoData=[], $organizationIds=[], $levelIds=[]) {
        if(!empty($mobile)) {
            $transaction = Yii::$app->getDb()->beginTransaction();
            try {
                if((!empty($organizationIds) && is_array($organizationIds)) && (!empty($levelIds) && is_array($levelIds))) {
                    if(count($levelIds) != count($organizationIds)) {
                        return BaseService::returnErrData([], 510300, "请核实党组织职务是否选择");
                    }
                }
                $passportService = new PassportService();
                $passportInfoRet = $passportService->getUserDataInfoByUserName($mobile);
                $passportInfo = [];
                $userid = 0;
                if(BaseService::checkRetIsOk($passportInfoRet)) {
                    $passportInfo = BaseService::getRetData($passportInfoRet);
                }
                if(!empty($passportInfo)) {
                    $userid = isset($passportInfo['id']) ? $passportInfo['id'] : 0;
                }
                if(!$userid) {
                    if(empty($password)) {
                        return BaseService::returnErrData([], 511700, "密码不能为空!");
                    }
                    $registerPassportRet = $passportService->register($mobile, $password);
                    if(BaseService::checkRetIsOk($registerPassportRet)) {
                        $registerPassportInfo = BaseService::getRetData($registerPassportRet);
                        $userid = isset($registerPassportInfo['id']) ? $registerPassportInfo['id'] : 0;
                    }
                }
                if(!$userid) {
                    $transaction->rollBack();
                    return BaseService::returnErrData([], 512700, "当前用户信息提交有误");
                }
                if(!empty($password)) {
                    $updatePasswordRet = $passportService->resetPwd($userid, $password);
                    if(!BaseService::checkRetIsOk($updatePasswordRet)) {
                        $transaction->rollBack();
                        return BaseService::returnErrData([], 513300, "当前用户密码更新有误");
                    }
                }
                if(!empty($userInfoData)) {
                    $updateUserInfoRet = $passportService->editInfoDataByUserId($userid, $userInfoData);
                    if(!BaseService::checkRetIsOk($updateUserInfoRet)) {
                        $transaction->rollBack();
                        return BaseService::returnErrData([], 514000, "当前用户信息更新有误");
                    }
                }
                $userOrganizationService = new UserOrganizationService();
                $editOrganizationRet = $userOrganizationService->editOrganizations($userid, $organizationIds, $levelIds);
                if(!BaseService::checkRetIsOk($editOrganizationRet)) {
                    $transaction->rollBack();
                    return $editOrganizationRet;
                }
                $transaction->commit();
                return $editOrganizationRet;
            } catch(\Exception $e) {
//                throw $e;
                $transaction->rollBack();
                return BaseService::returnErrData([], 515200, "系统提交异常，请检查网络！");
            }
        }
        return BaseService::returnErrData([], 515000, "请求参数有误");
    }
}
