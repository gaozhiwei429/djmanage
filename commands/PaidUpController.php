<?php
/**
 * 党费缴纳记录
 * @文件名称: PaidUpController
 * @author: jawei
 * @Email: gaozhiwei@etcp.cn
 * @Date: 2017-06-06
 * @Copyright: 2017 悦畅科技有限公司. All rights reserved.
 * 注意：本内容仅限于悦畅科技有限公司内部传阅，禁止外泄以及用于其他的商业目的
 */
namespace commands;
use appcomponents\modules\common\PaidUpService;
use appcomponents\modules\common\UserOrganizationService;
use source\libs\DmpUtil;
use source\manager\BaseService;
use yii\console\Controller;

class PaidUpController extends Controller{
    //0 * * * * /usr/bin/php /data/www/dangjian-manage/yii paid-up/add>> /data/logs/crontab/$(date +\%Y\%m\%d)-dangjian-manage-paid-up-add.log
    /**
     * 每小时执行一次
     * @return array
     */
	public function actionAdd() {
        $dmpUtil = new DmpUtil();
        $ret = "";
        $dataArr = [];
        $startTime = time();
        $startMettingTime = date('Y-m-01', strtotime(date("Y-m-d")));
        $endMettingTime = date('Y-m-d', strtotime("$startMettingTime +1 month -1 day"));
        //先获取党员信息数据列表,再去添加党费缴纳记录数据
        $userOrganizationService = new UserOrganizationService();
        $paidUpService = new PaidUpService();
        $userOrganizationParams[] = ['!=', 'status', 0];
        $p=1;
        $size=3;
        $totalPage = 0;
        $userOrganizationListRet = $userOrganizationService->getList($userOrganizationParams,[], $p, $size,['user_id','organization_id','paid_up','level_id','status']);
        if(BaseService::checkRetIsOk($userOrganizationListRet)) {
            for($i=1; $i<=$totalPage; $i++) {
                if($i>1) {
                    $userOrganizationListRet = $userOrganizationService->getList($userOrganizationParams,[], $totalPage, $size,['user_id','organization_id','paid_up','level_id','status']);
                }
                $userOrganizationList = BaseService::getRetData($userOrganizationListRet);
                $totalPage = isset($userOrganizationList['count']) ? intval(ceil($userOrganizationList['count']/$size)) : 0;
                $dataList = isset($userOrganizationList['dataList']) ? intval(ceil($userOrganizationList['dataList']/$size)) : 0;
                foreach($dataList as $dataInfo) {
                    $paidUpParams = [];
                    $year = date('Y');
                    $paidUpParams
                }
            }
        }

        $endTime = time();
//        $dmpUtil->dump($userMettingRet);
        $dmpUtil->dump('executtime:'.($endTime-$startTime)."s"."   startTime:".date('Y-m-d H:i:s', $startTime)."   endTime:".date('Y-m-d H:i:s', $endTime));
    }
}
