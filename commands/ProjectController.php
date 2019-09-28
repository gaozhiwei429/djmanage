<?php
/**
 * 主订单相关的接口定时任务
 * crontab commands
 * @文件名称: OrderController.php
 * @author: jawei
 * @Email: gaozhiwei@etcp.cn
 * @Date: 2017-06-06
 * @Copyright: 2017 悦畅科技有限公司. All rights reserved.
 * 注意：本内容仅限于悦畅科技有限公司内部传阅，禁止外泄以及用于其他的商业目的
 */
namespace commands;
use appcomponents\modules\project\ProjectModelService;
use appcomponents\modules\project\ProjectService;
use source\libs\DmpUtil;
use source\manager\BaseService;
use yii\console\Controller;
use Yii;

class ProjectController extends Controller{
    //*/5 * * * * /usr/bin/php /data/www/wbaole/yii project/save-dic>> /data/logs/crontab/$(date +\%Y\%m\%d)-project-save-dic.log
    /**
     * 获取第三方参数字典并且缓存数据
     */
	public function actionSaveDic() {
        $dmpUtil = new DmpUtil();
        $startTime = time();
        $redisKey = isset(Yii::$app->params['rediskey']['projectData']['getDic']) ? Yii::$app->params['rediskey']['projectData']['getDic'] : "";
        $ret = "";
        if(empty($redisKey)) {
            $ret = BaseService::returnErrData(0, 53300, "参数字典redis配置key不存在");
        } else {
            $projectService = new ProjectService();
            $dicDataRet = $projectService->getCasccloudDic();
            if(BaseService::checkRetIsOk($dicDataRet)) {
                $dicData = BaseService::getRetData($dicDataRet);
                if(!empty($dicData)) {
                    $ret = $projectService->saveCacheDate($redisKey, $dicData);
                }
            } else {
                $ret = BaseService::returnErrData([], 543000, "第三方字典数据获取失败");
            }
        }
        $endTime = time();
        $dmpUtil->dump($ret);
        $dmpUtil->dump('executtime:'.($endTime-$startTime)."s"."   startTime:".date('Y-m-d H:i:s', $startTime)."   endTime:".date('Y-m-d H:i:s', $endTime));
	}

    //*/5 * * * * /usr/bin/php /data/www/wbaole/yii project/syn-model-data>> /data/logs/crontab/$(date +\%Y\%m\%d)-project-syn-model-data.log
    /**
     * 定时任务将redis的数据字典定时的同步到数据表中
     */
    public function actionSynModelData() {
        $dmpUtil = new DmpUtil();
        $startTime = time();
        $projectService = new ProjectService();
        $redisKey = isset(Yii::$app->params['rediskey']['projectData']['getDic']) ? Yii::$app->params['rediskey']['projectData']['getDic'] : "";
        $ret = "";
        if(empty($redisKey)) {
            $ret = BaseService::returnErrData(0, 53300, "参数字典redis配置key不存在");
        } else {
            $dicDataRet = $projectService->getCacheData($redisKey);
            if(BaseService::checkRetIsOk($dicDataRet)) {
                $dicData = BaseService::getRetData($dicDataRet);
                if(!empty($dicData)) {
                    $dicData = json_decode($dicData, true);
                    $projectModelService = new ProjectModelService();
                    foreach($dicData as $dicInfo) {
                        $params = [];
                        if(isset($dicInfo['DIC_CODE']) && isset($dicInfo['DIC_NAME']) && isset($dicInfo['DIC_TYPE']) && isset($dicInfo['DIC_TYPE'])) {
                            $params[] = ['=', 'code', trim($dicInfo['DIC_CODE'])];
                            $params[] = ['=', 'name', trim($dicInfo['DIC_NAME'])];
                            $projectModelInfoRet = $projectModelService->getInfo($params);
                            if(!BaseService::checkRetIsOk($projectModelInfoRet)) {
                                $projectModelData = [
                                    'name'=>trim($dicInfo['DIC_NAME']),
                                    'code'=>trim($dicInfo['DIC_CODE']),
                                    'type'=>trim($dicInfo['DIC_TYPE']),
                                ];
                                $projectModelService->editInfo($projectModelData);
                            }
//                            $params[] = ['=', 'code', trim($dicInfo['DIC_TYPE'])];
                        }
                    }
                }
            } else {
                $ret = BaseService::returnErrData([], 543000, "第三方字典数据获取失败");
            }
        }
        $endTime = time();
        $dmpUtil->dump($ret);
        $dmpUtil->dump('executtime:'.($endTime-$startTime)."s"."   startTime:".date('Y-m-d H:i:s', $startTime)."   endTime:".date('Y-m-d H:i:s', $endTime));
    }
    //*/5 * * * * /usr/bin/php /data/www/wbaole/yii project/set-all-code-imgs>> /data/logs/crontab/$(date +\%Y\%m\%d)-project-set-all-code-imgs.log
    /**
     * 定时任务将redis的数据字典定时的同步到数据表中
     */
    public function actionSetAllCodeImgs() {
        $dmpUtil = new DmpUtil();
        $startTime = time();
        $ret = "";
        $projectModelService = new ProjectModelService();
        $projectService = new ProjectService();
        $projectModelListRet = $projectModelService->getList([], [], 1, -1);
        if(BaseService::checkRetIsOk($projectModelListRet)) {
            $projectModelListData = BaseService::getRetData($projectModelListRet);
            $projectModelList = isset($projectModelListData['dataList']) ? $projectModelListData['dataList'] : [];
            //设置redis缓存图片数据
            foreach($projectModelList as $projectModelInfo) {
                if(isset($projectModelInfo['name']) && !empty($projectModelInfo['name'])) {
                    $ret = $projectService->GetPrintTypeInfo($projectModelInfo['name']);
                    $imgRedisKey = isset(Yii::$app->params['rediskey']['projectType']['Imgs']) ? Yii::$app->params['rediskey']['projectType']['Imgs'] : "";

                    $imgRedisKey .= ":".$projectModelInfo['name'];
                    $imgDataRet = $projectService->getCacheData($imgRedisKey);
                    $imgData = BaseService::getRetData($imgDataRet);
                    if(!empty($imgData) && isset($projectModelInfo['id'])) {
                        $updateData['id'] = $projectModelInfo['id'];
                        $updateData['image'] = $imgData;
                        $ret = $projectModelService->editInfo($updateData);
                    }
                }
            }
        }
        $endTime = time();
        $dmpUtil->dump($ret);
        $dmpUtil->dump('executtime:'.($endTime-$startTime)."s"."   startTime:".date('Y-m-d H:i:s', $startTime)."   endTime:".date('Y-m-d H:i:s', $endTime));
    }
}
