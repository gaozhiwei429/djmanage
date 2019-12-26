<?php
/**
 * 投票参加记录
 * @文件名称: UserVoteController
 * @author: jawei
 * @Email: gaozhiwei@etcp.cn
 * @Date: 2017-06-06
 * @Copyright: 2017 悦畅科技有限公司. All rights reserved.
 * 注意：本内容仅限于悦畅科技有限公司内部传阅，禁止外泄以及用于其他的商业目的
 */
namespace commands;

use appcomponents\modules\common\DangyuanService;
use appcomponents\modules\common\VoteService;
use appcomponents\modules\common\UserVoteService;
use appcomponents\modules\common\UserOrganizationService;
use appcomponents\modules\passport\PassportService;
use source\libs\DmpUtil;
use source\manager\BaseService;
use yii\console\Controller;

class UserVoteController extends Controller{
    //0 * * * * /usr/bin/php /data/www/dangjian-manage/yii user-vote/add>> /data/logs/crontab/$(date +\%Y\%m\%d)-dangjian-manage-user-vote-add.log
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
//        $startMettingTime = date("Y-m-d H:i:s",strtotime('-5 day'));
//        $endMettingTime = date("Y-m-d H:i:s",strtotime('+1 day'));
        $this->getVote($startMettingTime, $endMettingTime, $dataArr);
//        var_dump($dataArr);die;
        $userMettingRet = "";
        if(!empty($dataArr)) {
            if(!empty($dataArr)) {
                $mettingService = new VoteService();
                $dangyuanService = new DangyuanService();
                foreach($dataArr as $data) {
                    if(!isset($data['id']) || empty($data['id'])) {
                        continue;
                    }
                    $join_peoples = [];
                    $userIds = [];
                    if(isset($data['join_peoples']) && !empty($data['join_peoples'])) {
                        $join_peoples = explode(',', $data['join_peoples']);
                    } else {
                        if(isset($data['organization_id']) && !empty($data['organization_id'])) {
                            $dangyuanParams = [];
                            $dangyuanParams[] = ['=', 'organization_id', $data['organization_id']];
                            $dangyuanParams[] = ['=', 'status', 1];
                            $dangyuanRet = $dangyuanService->getList($dangyuanParams, [], 1, -1, ['user_id'], ['user_id']);
                            if(BaseService::checkRetIsOk($dangyuanRet)) {
                                $dangyuanDataList = BaseService::getRetData($dangyuanRet);
                                if(isset($dangyuanDataList['dataList']) && !empty($dangyuanDataList['dataList'])) {
                                    $userIds = array_column($dangyuanDataList['dataList'], 'user_id');
                                }
                            }
                        }
                    }
                    $editInfo['id'] = $data['id'];
                    $editInfo['pending_people_num'] = count($userIds);
                    $mettingService->editInfo($editInfo);
                    $metting_id = isset($data['id']) ? $data['id'] : 0;
                    $addData = [];
                    $userOrganizationService = new UserOrganizationService();
                    $passportService = new PassportService();
                    $userMettingService = new UserVoteService();
                    foreach($userIds as $userId) {
                        //查看会议记录是否存在，如果不存在那么
                        $userMettingParams = [];
                        $userMettingParams[] = ['=', 'user_id', $userId];
                        $userMettingParams[] = ['=', 'vote_id', $metting_id];
                        $userMettingInfoRet = $userMettingService->getInfo($userMettingParams);
                        if(BaseService::checkRetIsOk($userMettingInfoRet)) {
                           continue;
                        }
                        //获取当前用户所属的党组织id
                        $userOrganizationParams = [];
                        $userOrganizationParams[] = ['=', 'user_id', $userId];
                        $userOrganizationParams[] = ['=', 'status', 1];
                        $userOrganizationInfoRet = $userOrganizationService->getInfo($userOrganizationParams);
                        $userOrganizationInfo = BaseService::getRetData($userOrganizationInfoRet);
                        $userInfoParams = [];
                        $userInfoParams[] = ['=', 'user_id', $userId];
                        $passportInfoRet = $passportService->getUserInfoByParams($userInfoParams);
                        $passportInfo = BaseService::getRetData($passportInfoRet);
                        $addData[] = [
                            'user_id' => $userId,
                            'full_name' => isset($passportInfo['full_name']) ? $passportInfo['full_name'] : "",
                            'avatar_img' => isset($passportInfo['avatar_img']) ? $passportInfo['avatar_img'] : "",
                            'start_time' => isset($data['start_time']) ? $data['start_time'] : "",
                            'end_time' => isset($data['end_time']) ? $data['end_time'] : "",
                            'anwser' => json_encode([]),
                            'organization_id' => isset($data['organization_id']) ? $data['organization_id'] : 0,
                            'vote_id' => $metting_id,
                            'user_organization_id' => isset($userOrganizationInfo['organization_id']) ? $userOrganizationInfo['organization_id'] : 0,
                            'user_level_id' => isset($userOrganizationInfo['level_id']) ? $userOrganizationInfo['level_id'] : 0,
                        ];
                    }
                    if(!empty($addData)) {
                        $userMettingRet = $userMettingService->addAll($addData);
                    }
                }
            }
        }

        $endTime = time();
        $dmpUtil->dump($userMettingRet);
        $dmpUtil->dump('executtime:'.($endTime-$startTime)."s"."   startTime:".date('Y-m-d H:i:s', $startTime)."   endTime:".date('Y-m-d H:i:s', $endTime));
    }
    /**
     * 获取当前时间段内的会议
     * @param $start
     * @param $end
     * @param array $dataList
     * @return array
     */
    public function getVote($start,$end,&$dataList=[]){
        $voteService = new VoteService();
        $params = [];
        $params[] = ['>=', 'update_time', $start];
        $params[] = ['<=', 'create_time', $end];
        $params[] = ['=', 'join_people_num', 0];
        $mettingListRet = $voteService->getList($params, [], 1, -1, ['*']);
        if(BaseService::checkRetIsOk($mettingListRet)) {
            $mettingList = BaseService::getRetData($mettingListRet);
            $dataList = isset($mettingList['dataList']) ? $mettingList['dataList'] : [];
        }
        return $dataList;
    }
}
