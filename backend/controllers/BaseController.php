<?php
/**
 * 基础controller
 * @文件名称: BaseController.php
 * @author: jawei
 * @Email: gaozhiwei429@sina.com
 * @Mobile: 15910987706
 * @Date: 2018-12-05
 * @Copyright: 2018 北京往全保科技有限公司. All rights reserved.
 * 注意：本内容仅限于北京往全保科技有限公司内部传阅，禁止外泄以及用于其他的商业目的
 */
namespace backend\controllers;
use appcomponents\modules\common\CommonService;
use appcomponents\modules\common\MenuService;
use appcomponents\modules\common\NodeService;
use appcomponents\modules\common\ToolsService;
use appcomponents\modules\manage\ManageService;
use source\controllers\ManageBaseController;
use source\manager\BaseException;
use source\manager\BaseService;
use Yii;

class BaseController extends ManageBaseController
{
    public $layout = "public";//设置使用的布局文件
    public $menus = [];
    public $menuUrl = [];
    public $requestUrl = [];
    public function beforeAction($action) {
        $session = \Yii::$app->session;
        $loginData = $session->get('loginData');
        $controller =  Yii::$app->controller->id;
        $action = Yii::$app->controller->action->id;
        if(empty($loginData)) {
            if($controller!= 'user' && $action!='login') {
                exit('<script language="javascript">top.location.href="../user/login"</script>');
//                header("Location: ../user/login");
            } else {
                //防止重复的跳转管理后台的登录页面
                return parent::beforeAction($action);
            }
        }
        $nodeService = new NodeService();
        $menuService = new MenuService();
        if(!isset($this->user_id) || (empty($this->user_id) || $this->user_id<=0)) {
            $this->user_id = isset($loginData['userid']) ? intval($loginData['userid']) : 0;
        }
        if($this->user_id) {
            $manageService = new ManageService();
            $userInfoRet = $manageService->getAdminUserInfoByUserId($this->user_id);
            $this->userInfo = BaseService::getRetData($userInfoRet);
        }
        $roleNodeList = $nodeService->applyAuthNode($this->user_id);
        if(empty($roleNodeList)) {
            exit('<script language="javascript">top.location.href="../user/login"</script>');
//            header("Location: ../user/login");
        }
        if(is_array($roleNodeList) && !empty($roleNodeList)) {
            try{
                $this->menuUrl = @array_column($roleNodeList, 'node');
            } catch (BaseException $e) {
                exit('<script language="javascript">top.location.href="../user/login"</script>');
//                header("Location: ../user/login");
            }
        }

        $menuListRet = $menuService->getDatas([['=', 'status', 1]], ['sort'=>SORT_DESC], 0, -1, ['id','pid','title','node','icon','icon','url','target','status']);
        $menuList = BaseService::getRetData($menuListRet);
        $list = ToolsService::arr2tree($menuList);//$commonService->buildMenuData($userId, ToolsService::arr2tree($menuList), $nodeList, !!$userId);

        $commonService = new CommonService();
        $menus = $commonService->buildMenuData($list, $roleNodeList, $this->user_id);
        $this->menus = $menus;
        return parent::beforeAction($action);
    }
}
