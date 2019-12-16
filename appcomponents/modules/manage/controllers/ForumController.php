<?php
/**
 * 论坛相关的操作
 * @文件名称: ForumController.php
 * @author: jawei
 * @Email: gaozhiwei429@sina.com
 * @Date: 2017-12-06
 * @Copyright: 2017 北京往全包科技有限公司. All rights reserved.
 * 注意：本内容仅限于北京往全包科技有限公司内部传阅，禁止外泄以及用于其他的商业目的
 */
namespace appcomponents\modules\manage\controllers;
use appcomponents\modules\common\MettingService;
use appcomponents\modules\common\MettingTypeService;
use appcomponents\modules\common\NewsService;
use appcomponents\modules\common\OrganizationService;
use appcomponents\modules\common\TypeService;
use appcomponents\modules\common\VoteService;
use appcomponents\modules\passport\PassportService;
use source\controllers\ManageBaseController;
use source\libs\Common;
use source\manager\BaseService;
use \Yii;
class ForumController extends ManageBaseController
{
    /**
     * 用户登录态基础类验证
     * @return array
     */
    public function beforeAction($action){
        $userToken = parent::userToken();
        $getMenuUrl = parent::getMenuUrl();
        return parent::beforeAction($action);
    }
    /**
     * 论坛资讯管理
     * @return string
     */
    public function actionIndex() {
        return $this->renderPartial('index',
            [
                'title' => "论坛资讯管理",
                'menuUrl' => $this->menuUrl,
            ]
        );
    }
    /**
     * 论坛资讯详情
     * @return string
     */
    public function actionInfo() {
        $id = intval(Yii::$app->request->get('id', 0));
        $newsService = new NewsService();
        $params = [];
        $params[] = ['=', 'id', $id];
        $newsInfoRet = $newsService->getInfo($params);
        return $this->renderPartial('info', [
                'title' => '论坛资讯详情',
                'menuUrl' => $this->menuUrl,
                'id' => $id,
                'info' => BaseService::getRetData($newsInfoRet),
            ]
        );
    }
    /**
     * 论坛资讯编辑
     * @return string
     */
    public function actionEdit() {
        $id = intval(Yii::$app->request->get('id', 0));
        $parent_id = intval(Yii::$app->request->get('parent_id', 0));
        $newsService = new NewsService();
        $params = [];
        $params[] = ['=', 'id', $id];
        $newsInfoRet = $newsService->getInfo($params);
        $typeService = new TypeService();
        $typeParams[] = ['=', 'parent_id', $parent_id];
        $typeParams[] = ['=', 'status', 1];
        $typeServiceDataListRet = $typeService->getList($typeParams, [], 1, -1, ['*']);
        $typeServiceListData = BaseService::getRetData($typeServiceDataListRet);
        return $this->renderPartial('edit',
            [
                'title' => "论坛资讯编辑",
                'menuUrl' => $this->menuUrl,
                'info' => BaseService::getRetData($newsInfoRet),
                'typeList' => isset($typeServiceListData['dataList']) ? $typeServiceListData['dataList'] : [],
            ]
        );
    }
    /**
     * 三会一课
     * @return string
     */
    public function actionShyk() {
        return $this->renderPartial('metting',
            [
                'title' => "三会一课管理",
                'menuUrl' => $this->menuUrl,
            ]
        );
    }
    /**
     * 三会一课
     * @return string
     */
    public function actionMettingEdit() {
        $id = intval(Yii::$app->request->get('id', 0));

        //组织树形结构数据
        $organizationService = new OrganizationService();
        $params = [];
        $params[] = ['!=', 'status', 0];
        $ret = $organizationService->getTree($params, ['id'=>SORT_ASC], 1, -1, $fied=['*'], true);
        $treeData = BaseService::getRetData($ret);
        $arr = [];
        $arr = Common::treeToArr($treeData, $arr);

        $newsService = new MettingService();
        $params = [];
        $params[] = ['=', 'id', $id];
        $mettingTypeService = new MettingTypeService();
        $mettingTypeParams[] = ['=','status', 1];
        $mettingTypeListRet = $mettingTypeService->getList($mettingTypeParams, [], 1, -1,['id','title']);
        $mettingTypeDataList = [];
        if(BaseService::checkRetIsOk($mettingTypeListRet)) {
            $mettingTypeList = BaseService::getRetData($mettingTypeListRet);
            if(isset($mettingTypeList['dataList']) && !empty($mettingTypeList['dataList'])) {
                $mettingTypeDataList = $mettingTypeList['dataList'];
            }
        }
        $newsInfoRet = $newsService->getInfo($params);
        $newsInfo = BaseService::getRetData($newsInfoRet);
        if(BaseService::checkRetIsOk($newsInfoRet)) {
            $passportSrvice = new PassportService();
            if(isset($newsInfo['president_userid'])) {
                $president_userids = explode(',', $newsInfo['president_userid']);
            }
            if(isset($newsInfo['speaker_userid'])) {
                $speaker_userids = explode(',', $newsInfo['speaker_userid']);
            }
            if(isset($newsInfo['join_peoples'])) {
                $join_peoples = explode(',', $newsInfo['join_peoples']);
            }
            $passportParams = [];
            $passportParams[] = ['in', 'id', array_unique(array_merge($president_userids,$speaker_userids,$join_peoples))];
            $passportListRet = $passportSrvice->getList($passportParams, [], 1, -1, ['*'], true, true);
            $passportListData = BaseService::getRetData($passportListRet);
            $newsInfo['president_people'] = "";
            $newsInfo['speaker_people'] = "";
            $newsInfo['join_people_list'] = "";
            if(!empty($passportListData) && isset($passportListData['dataList'])) {
                if(!empty($president_userids)) {
                    foreach($president_userids as $president_userid) {
                        $newsInfo['president_people'].=
            (isset($passportListData['dataList'][$president_userid]['full_name']) ? $passportListData['dataList'][$president_userid]['full_name'] : "").", ";
                    }
                }
                if(!empty($speaker_userids)) {
                    foreach($speaker_userids as $president_userid) {
                        $newsInfo['speaker_people'] .=
                (isset($passportListData['dataList'][$president_userid]['full_name']) ? $passportListData['dataList'][$president_userid]['full_name'] : "").", ";
                    }
                }
                if(!empty($join_peoples)) {
                    foreach($join_peoples as $join_userid) {
                        $newsInfo['join_people_list'] .=
                (isset($passportListData['dataList'][$join_userid]['full_name']) ? $passportListData['dataList'][$join_userid]['full_name'] : "").", ";
                    }
                }
            }
            $newsInfo['president_people'] = trim($newsInfo['president_people'], ',');
            $newsInfo['speaker_people'] = trim($newsInfo['speaker_people'], ',');
            $newsInfo['join_people_list'] = trim($newsInfo['join_people_list'], ',');
        }
        return $this->renderPartial('metting-edit',
            [
                'title' => "三会一课编辑",
                'menuUrl' => $this->menuUrl,
                'dataInfo' => $newsInfo,
                'treeData' => $arr,
                'mettingTypeDataList' => $mettingTypeDataList,
            ]
        );
    }
    /**
     * 三会一课
     * @return string
     */
    public function actionMettingInfo() {
        $id = intval(Yii::$app->request->get('id', 0));
        $newsService = new MettingService();
        $params[] = ['=', 'id', $id];
        $infoRet = $newsService->getInfo($params);
        $newsInfo = BaseService::getRetData($infoRet);
        if(BaseService::checkRetIsOk($infoRet)) {
            $passportSrvice = new PassportService();
            $president_userids = [];
            $speaker_userids = [];
            if(isset($newsInfo['president_userid'])) {
                $president_userids = explode(',', $newsInfo['president_userid']);
            }
            if(isset($newsInfo['speaker_userid'])) {
                $speaker_userids = explode(',', $newsInfo['speaker_userid']);
            }
            if(!empty($speaker_userids) || !empty($president_userids)) {
                $passportParams = [];
                $passportParams[] = ['in', 'id', array_unique(array_merge($president_userids,$speaker_userids))];
                $passportListRet = $passportSrvice->getList($passportParams, [], 1, -1, ['id'], true, true);
                $passportListData = BaseService::getRetData($passportListRet);
                $newsInfo['president_people'] = [];
                $newsInfo['speaker_people'] = [];
                if(!empty($passportListData) && isset($passportListData['dataList'])) {
                    if(!empty($president_userids)) {
                        foreach($president_userids as $president_userid) {
                            $newsInfo['president_people'][] = isset($passportListData['dataList'][$president_userid]) ? $passportListData['dataList'][$president_userid] : [];
                        }
                    }
                    if(!empty($speaker_userids)) {
                        foreach($speaker_userids as $president_userid) {
                            $newsInfo['speaker_people'][] = isset($passportListData['dataList'][$president_userid]) ? $passportListData['dataList'][$president_userid] : [];
                        }
                    }
                }
            }
        }
        return $this->renderPartial('metting-info',
            [
                'title' => "三会一课编辑",
                'menuUrl' => $this->menuUrl,
                'id' => $id,
                'dataInfo' => $newsInfo,
            ]
        );
    }
    /**
     * 民主投票
     * @return string
     */
    public function actionMztp() {
        return $this->renderPartial('vote',
            [
                'title' => "民主投票管理",
                'menuUrl' => $this->menuUrl,
            ]
        );
    }
    /**
     * 民主投票编辑
     * @return string
     */
    public function actionVoteEdit() {
        $id = intval(Yii::$app->request->get('id', 0));
        //组织树形结构数据
        $organizationService = new OrganizationService();
        $params = [];
        $params[] = ['!=', 'status', 0];
        $ret = $organizationService->getTree($params, ['id'=>SORT_ASC], 1, -1, $fied=['*'], true);
        $treeData = BaseService::getRetData($ret);
        $arr = [];
        $arr = Common::treeToArr($treeData, $arr);
        $dataInfo = [];
        if($id) {
            $voteParams[] = ['=', 'id', $id];
            $newsService = new VoteService();
            $newsInfoRet = $newsService->getInfo($voteParams);
            $dataInfo = BaseService::getRetData($newsInfoRet);
        }
        return $this->renderPartial('vote-edit',
            [
                'title' => "民主投票管理",
                'menuUrl' => $this->menuUrl,
                'treeData' => $arr,
                'dataInfo' => $dataInfo,
            ]
        );
    }
}
