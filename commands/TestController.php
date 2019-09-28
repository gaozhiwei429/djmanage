<?php
/**
 * crontab commands
 * @文件名称: TestController.php
 * @author: jawei
 * @Email: gaozhiwei@etcp.cn
 * @Date: 2017-06-06
 * @Copyright: 2017 悦畅科技有限公司. All rights reserved.
 * 注意：本内容仅限于悦畅科技有限公司内部传阅，禁止外泄以及用于其他的商业目的
 */
namespace commands;

use appcomponents\modules\common\VerificationService;
use appcomponents\modules\pay\OrderService;
use source\libs\DmpUtil;
use source\manager\BaseService;
use yii\console\Controller;

class TestController extends Controller{
    //更新核销码记录的user_have_card_id字段
    //1 0 * * * /bin/php /data/www/TXHFinancePlatform/yii test/test>> /data/logs/crontab/$(date +\%Y\%m\%d)-test-test.log
    /**
     *
     * 更新核销码记录的user_have_card_id字段
     * @return array
     */
	public function actionTest() {
        $dmpUtil = new DmpUtil();
        $startTime = time();
        $ret = "";
        $verificationService = new VerificationService();
        $params[] = ['>=', 'user_have_card_id', 0];
        $pageSize = 100;
        $verificationListRet = $verificationService->getList($params, [], 1, $pageSize);
        $verificationListData = BaseService::getRetData($verificationListRet);
        $verificationList = isset($verificationListData['dataList']) ? $verificationListData['dataList'] : [];
        $verificationCount = isset($verificationListData['count']) ? $verificationListData['count'] : 0;
        $totalPage = ceil($verificationCount/$pageSize);
        $orderService = new OrderService();
        for($i=1; $i<=$totalPage; $i++) {
            if($i>=1) {
                $verificationListRet = $verificationService->getList($params, [], $i, $pageSize);
                $verificationListData = BaseService::getRetData($verificationListRet);
                $verificationList = isset($verificationListData['dataList']) ? $verificationListData['dataList'] : [];
            }
//            var_dump($verificationList);
            foreach($verificationList as $verificationInfo) {
                $order_detaiMapParams = [];
                $updateBusinessVerficationInfoParams = [];
                $updateVerficationData = [];
                $order_detail_map_id = $verificationInfo['order_detail_map_id'];
                $order_detaiMapParams[] = ['=', 'id', $order_detail_map_id];
                $orderDetailMapInfoRet = $orderService->getOrderDetailMapInfoByParams($order_detaiMapParams);
                if(BaseService::checkRetIsOk($orderDetailMapInfoRet)) {
                    $orderDetailMapInfo = BaseService::getRetData($orderDetailMapInfoRet);
                    $updateVerficationData['user_have_card_id'] = $orderDetailMapInfo['user_have_card_id'];
                    $updateVerficationInfoRet = $verificationService->updateVerficationInfo($verificationInfo['id'], $updateVerficationData);
                    if(BaseService::checkRetIsOk($updateVerficationInfoRet)) {
                        $updateBusinessVerficationInfoParams = ['order_detail_id'=>$orderDetailMapInfo['id']];
                        $ret = $verificationService->updateBusinessVerficationInfo($updateBusinessVerficationInfoParams,$updateVerficationData);
//                        $ret = $updateVerficationInfoRet;
                    }
                }
            }
        }

        $endTime = time();
        $dmpUtil->dump($ret);
        $dmpUtil->dump('executtime:'.($endTime-$startTime)."s"."   startTime:".date('Y-m-d H:i:s', $startTime)."   endTime:".date('Y-m-d H:i:s', $endTime));
    }
}
