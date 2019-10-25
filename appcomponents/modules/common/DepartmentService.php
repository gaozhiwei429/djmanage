<?php
/**
 * 部门相关的数据获取service
 * @文件名称: DepartmentService.php
 * @author: jawei
 * @Email: gaozhiwei429@sina.com
 * @Mobile: 15910987706
 * @Date: 2018-12-01
 * @Copyright: 2017 北京往全保科技有限公司. All rights reserved.
 * 注意：本内容仅限于北京往全保科技有限公司内部传阅，禁止外泄以及用于其他的商业目的
 */
namespace appcomponents\modules\common;
use appcomponents\modules\common\models\DepartmentModel;
use source\libs\Common;
use source\manager\BaseException;
use source\manager\BaseService;
use Yii;
class DepartmentService extends BaseService {
    public $controllerNamespace = 'appcomponents\modules\common\controllers';
    public function init() {
        parent::init();
    }
    /**
     * 管理后台数据获取
     * @param $addData
     * @return array
     */
    public function getList($params = [], $orderBy = [], $p = 1, $limit = 10, $fied=['*']) {
        $Common = new Common();
        $offset = $Common->getOffset($limit, $p);
        $departmentModel = new DepartmentModel();
        $departmentList = $departmentModel->getListData($params, $orderBy, $offset, $limit, $fied);
        if(!empty($departmentList)) {
            return BaseService::returnOkData($departmentList);
        }
        return BaseService::returnErrData([], 53700, "暂无数据");
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
        $departmentModel = new DepartmentModel();
        $id = isset($dataInfo['id']) ? $dataInfo['id'] : 0;
        $editRest = 0;
        if($id) {
            if(isset($dataInfo['id'])) {
                unset($dataInfo['id']);
            }
            $editRest = $departmentModel->updateInfo($id, $dataInfo);
        } else {
            $editRest = $departmentModel->addInfo($dataInfo);
        }
        if(!empty($editRest)) {
            return BaseService::returnOkData($editRest);
        }
        return BaseService::returnErrData([], 56100, "编辑数据异常");
    }
    /**
     * 获取详情数据
     * @param $params
     * @return array
     */
    public function getInfo($params) {
        if(empty($params)) {
            return BaseService::returnErrData([], 57000, "请求参数异常");
        }
        $departmentModel = new DepartmentModel();
        $departmentInfo = $departmentModel->getInfoByValue($params);
        if(!empty($departmentInfo)) {
            return BaseService::returnOkData($departmentInfo);
        }
        return BaseService::returnErrData([], 57700, "暂无数据");
    }
}
