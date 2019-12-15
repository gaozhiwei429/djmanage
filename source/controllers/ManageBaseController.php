<?php
/**
 * base controller
 * @文件名称: UserBaseController.php
 * @author: jawei
 * @Email: gaozhiwei429@sina.com
 * @Mobile: 15910987706
 * @Date: 2017-06-06
 * @Copyright: 2018 北京往全保科技有限公司. All rights reserved.
 * 注意：本内容仅限于北京往全保科技有限公司内部传阅，禁止外泄以及用于其他的商业目的
 */
namespace source\controllers;
use appcomponents\modules\common\CommonService;
use appcomponents\modules\common\MenuService;
use appcomponents\modules\common\NodeService;
use appcomponents\modules\common\ToolsService;
use appcomponents\modules\manage\ManageService;
use source\manager\BaseException;
use source\manager\BaseService;
use Yii;

class ManageBaseController extends BaseController
{
    public $user_id;
    public $roleIdArr = [];
    public $userInfo;
    public $noLogin = true;
    public $menus = [];
    public $hand = [
        'add' => false,
        'del' => false,
        'edit' => false,
        'search' => false,
    ];
    public $menuUrl = [];
    public function beforeAction($action) {
        try{
            if($this->noLogin) {
                $userToken = $this->userToken();
                if(!BaseService::checkRetIsOk($userToken)) {
                    return $userToken;
                }
                if(empty($this->user_id)) {
                    return BaseService::returnErrData('', 5001, "当前授权失效");
                }
            }
            return parent::beforeAction($action);
        }catch (BaseException $e) {
            return BaseService::returnErrData([], 5001, "请求数据异常");
        }
    }
    /**
     * 基类用户header验证
     * @return array
     */
    public function userToken() {
        // $headers 是一个 yii\web\HeaderCollection 对象
        $headers = Yii::$app->request->headers;
        // 返回 Accept header 值
        $user_id = $headers->get('userid', Yii::$app->request->post('userid', 0));
        $token = $headers->get('token', Yii::$app->request->post('token', null));
        $sign = $headers->get('sign', Yii::$app->request->post('sign', null));
        $source = $headers->get('source', Yii::$app->request->post('source', 5));
        $type = $headers->get('type', Yii::$app->params['user']['type']);
        if(empty($user_id) || empty($token) || empty($sign) || empty($type)) {
            return BaseService::returnErrData([], 5001, "请求参数异常");
        }
        $manageService = new ManageService();
        $verifyToken = $manageService->verifyToken($user_id, $token, $sign, $type, $source);
        if(!BaseService::checkRetIsOk($verifyToken)) {
            return $verifyToken;
        }
        $this->user_id = $user_id;
        return BaseService::returnOkData([]);
    }

    public function getMenuUrl() {
        $session = \Yii::$app->session;
        $loginData = $session->get('loginData');
        $nodeService = new NodeService();
        $menuService = new MenuService();
        if(!isset($this->user_id) || (empty($this->user_id) || $this->user_id<=0)) {
            $this->user_id = isset($loginData['userid']) ? intval($loginData['userid']) : 0;
        }
        if($this->user_id) {
            $manageService = new ManageService();
            $userInfoRet = $manageService->getUserInfoByUserId($this->user_id);
            $this->userInfo = BaseService::getRetData($userInfoRet);
        }
        $roleNodeList = $nodeService->applyAuthNode($this->user_id);
        if(empty($roleNodeList)) {
            return $roleNodeList;
        }
        if(is_array($roleNodeList) && !empty($roleNodeList)) {
            try{
                $this->menuUrl = @array_column($roleNodeList, 'node');
            } catch (BaseException $e) {
                return [];
            }
        }

        $menuListRet = $menuService->getDatas([['=', 'status', 1]], ['sort'=>SORT_DESC], 0, -1, ['id','pid','title','node','icon','icon','url','target','status']);
        $menuList = BaseService::getRetData($menuListRet);
        $list = ToolsService::arr2tree($menuList);//$commonService->buildMenuData($userId, ToolsService::arr2tree($menuList), $nodeList, !!$userId);

        $commonService = new CommonService();
        $menus = $commonService->buildMenuData($list, $roleNodeList, $this->user_id);
        $this->menus = $menus;
        return $menus;
    }
}
