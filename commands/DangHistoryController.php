<?php
/**
 * 党史上的今天
 * @文件名称: DangHistoryController.php
 * @author: jawei
 * @Email: gaozhiwei@etcp.cn
 * @Date: 2017-06-06
 * @Copyright: 2017 悦畅科技有限公司. All rights reserved.
 * 注意：本内容仅限于悦畅科技有限公司内部传阅，禁止外泄以及用于其他的商业目的
 */
namespace commands;

use appcomponents\modules\common\DangHistoryService;
use appcomponents\modules\common\DangTodayService;
use source\libs\DmpUtil;
use source\manager\BaseService;
use yii\console\Controller;

class DangHistoryController extends Controller{
    //0 * * * * /usr/bin/php /data/www/dangjian-manage/yii dang-history/search>> /data/logs/crontab/$(date +\%Y\%m\%d)-dangjian-manage-danghistory-search.log
    /**
     * 每小时执行一次抓取党史上的今天数据
     * @return array
     */
	public function actionSearch() {
        $dmpUtil = new DmpUtil();
        $startTime = time();
        $ret = "";
        $dangHistoryService = new DangHistoryService();
        $month = intval(date("m"));
        $day = intval(date("d"));
        $params[] = ['!=', 'status', 0];
        $params[] = ['=', 'month', $month];
        $params[] = ['=', 'day', $day];
        $dangHistoryListRet = $dangHistoryService->getList($params, [], 1, -1);
        $dangHistoryListData = BaseService::getRetData($dangHistoryListRet);
        $dangHistoryCount = isset($dangHistoryListData['count']) ? $dangHistoryListData['count'] : 0;
        $url = "http://cpc.people.com.cn/GB/64162/64165/72301/72331/index.html";
        $ret = "";
        $dangTodyService = new DangTodayService();
        $dangTodyParams[] = ['!=', 'status', 0];
        $dangTodyParams[] = ['=', 'month_and_day', $month.".".$day];
        $dangTodyInfoRet = $dangTodyService->getInfo($dangTodyParams);
        $dang_today_id = 0;
        if(!BaseService::checkRetIsOk($dangTodyInfoRet)) {
            $dangTodyData = [
                'title' =>"党史上的今天(".$month."月".$day."日".")",
                'month_and_day'=>$month.".".$day,
                'pic_url'=>"http://wbaole.oss-cn-beijing.aliyuncs.com/wbaole/1574703285505535598EB1M3a8ec7.png"
            ];
            $dangTodyAddRet = $dangTodyService->editInfo($dangTodyData);
            $dang_today_id = BaseService::getRetData($dangTodyAddRet);
        } else {
            $dangTodyInfo = BaseService::getRetData($dangTodyInfoRet);
            $dang_today_id = isset($dangTodyInfo['id']) ? $dangTodyInfo['id'] : 0;
        }
        if(!$dangHistoryCount) {
            $content = file_get_contents($url);
            $content = iconv('GB2312', 'UTF-8', $content);
            $coutentData = $this->get_tag_data($content, "div", "class", "p1_02");
            $dataArr = [];
            foreach($coutentData as $k=>$val) {
                $val = preg_replace("/&nbsp;/"," ",$val);
                $dataArr = [
                    "title" => $this->get_tag_data($val, "h2","",""),
                    "content" => $this->get_tag_data($val, "p","",""),
                ];
            }
            if(!empty($dataArr)) {
                for($i=0; $i<count($dataArr['title']); $i++) {
                    $dangHistoryParams = [];
                    $dangHistoryParams[] = ['=', "title", $dataArr['title'][$i]];
                    $dangHistoryInfoRet = $dangHistoryService->getInfo($dangHistoryParams);
                    if(!BaseService::checkRetIsOk($dangHistoryInfoRet)) {
                        $insertData = [
                            'title' => $dataArr['title'][$i],
                            'month' => $month,
                            'day' => $day,
                            'content' => $dataArr['content'][$i],
                            'dang_today_id' => $dang_today_id,
                        ];
                        $ret = $dangHistoryService->editInfo($insertData);
                    }
                }
            }
        }
        $endTime = time();
        $dmpUtil->dump($ret);
        $dmpUtil->dump('executtime:'.($endTime-$startTime)."s"."   startTime:".date('Y-m-d H:i:s', $startTime)."   endTime:".date('Y-m-d H:i:s', $endTime));
    }

    public function get_tag_data($str,$tag,$attrname,$value){ //返回值为数组 ,查找到的标签内的内容
        $regex = "/<$tag>(.*?)<\/$tag>/is";
        if($attrname!="") {
            $regex = "/<$tag.*?$attrname=\".*?$value.*?\".*?>(.*?)<\/$tag>/is";
        }
        preg_match_all($regex,$str,$matches,PREG_PATTERN_ORDER); return $matches[1];
    }
}
