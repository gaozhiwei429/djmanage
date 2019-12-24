<?php
/**
 * 用户参加会议相关相关的接口
 * @文件名称: UserMettingController.php
 * @author: jawei
 * @Email: gaozhiwei429@sina.com
 * @Mobile: 15910987706
 * @Date: 2018-12-01
 * @Copyright: 2017 北京往全保科技有限公司. All rights reserved.
 * 注意：本内容仅限于北京往全保科技有限公司内部传阅，禁止外泄以及用于其他的商业目的
 */
namespace appcomponents\modules\common\controllers;
use appcomponents\modules\common\UserMettingService;
use appcomponents\modules\passport\PassportService;
use source\controllers\ManageBaseController;
use source\libs\Common;
use source\manager\BaseService;
use Yii;
class UserMettingController extends ManageBaseController
{
    public function beforeAction($action){
        return parent::beforeAction($action);
    }
    /**
     * 列表数据获取
     * @return array
     */
    public function actionGetList() {
        if (!isset($this->user_id) || !$this->user_id) {
            return BaseService::returnErrData([], 5001, "当前账号登陆异常");
        }
        $page = intval(Yii::$app->request->post('p', 1));
        $size = intval(Yii::$app->request->post('size', 10));
        $metting_id = intval(Yii::$app->request->post('metting_id', 0));
        $newsService = new UserMettingService();
        $params = [];
        if(empty($metting_id)) {
            return BaseService::returnErrData([], 53900, "请求参数异常");
        }
		if(!empty($metting_id)) {
			$params[] = ['=', 'metting_id', $metting_id];
		}
        return $newsService->getList($params, ['id'=>SORT_DESC], $page, $size,['*']);
    }
}
