<?php
/**
 * 地理属性数据相关接口
 * @文件名称: AddrController.php
 * @author: jawei
 * @Email: gaozhiwei429@sina.com
 * @Mobile: 15910987706
 * @Date: 2018-12-01
 * @Copyright: 2017 北京往全保科技有限公司. All rights reserved.
 * 注意：本内容仅限于北京往全保科技有限公司内部传阅，禁止外泄以及用于其他的商业目的
 */
namespace appcomponents\modules\common\controllers;

use appcomponents\modules\common\CommonService;
use appcomponents\modules\common\models\AddrAreaModel;
use appcomponents\modules\common\models\AddrCityModel;
use appcomponents\modules\common\models\AddrProvinceModel;
use source\controllers\BaseController;
use Yii;

class AddrController extends BaseController
{
    /**
     * 获取省份数据接口
     * @return array
     */
    public function actionGetProvinceList() {
        $p = intval(Yii::$app->request->post('p'));//当前第几页
        $size = intval(Yii::$app->request->post('size', 100));//每页显示多少条
        $name = trim(Yii::$app->request->post('name', null));//模糊查询名称
        $status = intval(Yii::$app->request->post('status', 0));//状态【1已开启，0未开启】
        $params[] = ['status'=>$status];
//        $params[] = ['status'=>AddrProvinceModel::IS_STATUS];
        if(!empty($name)) {
            $params[] = ['like', 'name', $name];
        }
        $commonService = new CommonService();
        return $commonService->getProvinceList($params, [], $p, $size);
    }

}
