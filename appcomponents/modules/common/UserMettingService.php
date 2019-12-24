<?php
/**
 * 用户参加三会一课相关的数据获取service
 * @文件名称: UserMettingService.php
 * @author: jawei
 * @Email: gaozhiwei429@sina.com
 * @Mobile: 15910987706
 * @Date: 2018-12-01
 * @Copyright: 2017 北京往全保科技有限公司. All rights reserved.
 * 注意：本内容仅限于北京往全保科技有限公司内部传阅，禁止外泄以及用于其他的商业目的
 */
namespace appcomponents\modules\common;
use appcomponents\modules\common\models\UserMettingModel;
use source\libs\Common;
use source\manager\BaseException;
use source\manager\BaseService;
use Yii;
class UserMettingService extends BaseService
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
        $newsModel = new UserMettingModel();
        $cityList = $newsModel->getListData($params, $orderBy, $offset, $limit, $fied);
        if(!empty($cityList)) {
            return BaseService::returnOkData($cityList);
        }
        return BaseService::returnErrData([], 500, "暂无数据");
    }
    /**
     * 详情数据
     * @param $params
     * @return array
     */
    public function getInfo($params,$field=['*']) {
        if(empty($params)) {
            return BaseService::returnErrData([], 55000, "请求参数异常");
        }
        $newsModel = new UserMettingModel();
        $newsInfo = $newsModel->getInfoByValue($params,$field);
        if(!empty($newsInfo)) {
            return BaseService::returnOkData($newsInfo);
        }
        return BaseService::returnErrData([], 500, "暂无数据");
    }
    /**
     * 论坛资讯详情数据
     * @param $params
     * @return array
     */
    public function editInfo($dataInfo) {
        if(empty($dataInfo)) {
            return BaseService::returnErrData([], 56900, "请求参数异常");
        }
        $newsModel = new UserMettingModel();
        $id = isset($dataInfo['id']) ? $dataInfo['id'] : 0;
        $editRest = 0;
        if($id) {
            if(isset($dataInfo['id'])) {
                unset($dataInfo['id']);
            }
            $editRest = $newsModel->updateInfo($id, $dataInfo);
        } else {
            $editRest = $newsModel->addInfo($dataInfo);
        }
        if(!empty($editRest)) {
            return BaseService::returnOkData($editRest);
        }
        return BaseService::returnErrData([], 500, "操作异常");
    }
    /**
     * 会议参会人员入库
     * @param $dataAll
     * @return array
     */
    public function addAll($dataAll) {
        if(empty($dataAll) || !isset($dataAll[0])) {
            return BaseService::returnErrData([], 56900, "会议参会人员数据异常");
        }
        $newsModel = new UserMettingModel();
        $addAll = $newsModel->addAll($dataAll);
        if($addAll) {
            return BaseService::returnOkData([]);
        }
        return BaseService::returnErrData([], 510000, "会议参会人员数据入库异常");
    }
}
