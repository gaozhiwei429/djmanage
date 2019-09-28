<?php
/**
 * 入口
 * @文件名称: web.php
 * @author: jawei
 * @Email: gaozhiwei429@sina.com
 * @Mobile: 15910987706
 * @Date: 2018-12-01
 * @Copyright: 2018 北京往全保科技有限公司. All rights reserved.
 * 注意：本内容仅限于北京往全保科技有限公司内部传阅，禁止外泄以及用于其他的商业目的
 */
namespace backend\controllers;
use appcomponents\modules\common\DepartmentService;
use appcomponents\modules\manage\ManageService;
use appcomponents\modules\manage\RoleService;
use source\manager\BaseService;
use Yii;

class ManageUserController extends BaseController {
    public function beforeAction($action) {
        return parent::beforeAction($action);
    }
    public function actionIndex() {
        $username = trim(Yii::$app->request->get("username", ""));
        return $this->renderPartial('index',
            [
                'username'=> $username,
                'title' => "管理员账号管理",
                'menuUrl' => $this->menuUrl,
            ]
        );
    }
    /**
     * 登录状态的数据保存
     * @return array|mixed
     */
    public function actionLoginIn() {
        $username = trim(Yii::$app->request->post('username', null));
        $password = trim(Yii::$app->request->post('password', null));
        $source = intval(Yii::$app->request->post('source', 1));
        if(!empty($username) && !empty($password)) {
            $manageService = new ManageService();
            $ret = $manageService->login($username, $password, $source);
            if(BaseService::checkRetIsOk($ret)) {
                $loginData = BaseService::getRetData($ret);
                $session = \Yii::$app->session;
                $session->set('loginData', $loginData);
                return BaseService::returnOkData($loginData);
            }
            return $ret;
        }
    }
    /**
     * 前端(单页面应用)入口
     */
    public function actionLogin() {
        return $this->render('login', [
                'title' => '登录',
            ]
        );
    }
    /**
     * 修改密码
     * @return string
     */
    public function actionPass() {
        $id = intval(Yii::$app->request->get("id", 0));
        return $this->renderPartial('pass', [
                'title' => '修改密码',
                'id' => $id,
            ]
        );
    }
    /**
     * 个人信息
     * @return string
     */
    public function actionInfo() {
        $id = intval(Yii::$app->request->get("id", 0));
        $roleService = new RoleService();
        $roleIdsRet = $roleService->getRoleIds($id);
        $roleIds = BaseService::getRetData($roleIdsRet);
        $roleParams[] = [];
        $roleDataListRet = $roleService->getDatas($roleParams, [], 0, -1,['*']);
        $passportService = new ManageService();
        $userInfoRet = $passportService->getAdminUserInfoByUserId($id);

        $departmentService = new DepartmentService();
        $departmentParams[] = ['=', 'status', 1];
        $departmentDataListRet = $departmentService->getList($departmentParams, [], 1, -1, ['id', 'name']);
        $departmentList = [];
        if(BaseService::checkRetIsOk($departmentDataListRet)) {
            $departmentDataList = BaseService::getRetData($departmentDataListRet);
            if(isset($departmentDataList['dataList']) && !empty($departmentDataList['dataList'])) {
                $departmentList = $departmentDataList['dataList'];
            }
        }
        return $this->renderPartial('info', [
                'title' => '个人信息',
                'id' => $id,
                'roleIds' => $roleIds,
                'roleDataList' => BaseService::getRetData($roleDataListRet),
                'userInfo' => BaseService::getRetData($userInfoRet),
                'departmentDataList' => $departmentList,
            ]
        );
    }
    /**
     * 个人信息编辑
     * @return string
     */
    public function actionEditInfo() {
        $id = intval(Yii::$app->request->get("id", 0));
        $departmentService = new DepartmentService();
        $departmentParams[] = ['=', 'status', 1];
        $departmentDataListRet = $departmentService->getList($departmentParams, [], 1, -1, ['id', 'name']);
        $departmentList = [];
        if(BaseService::checkRetIsOk($departmentDataListRet)) {
            $departmentDataList = BaseService::getRetData($departmentDataListRet);
            if(isset($departmentDataList['dataList']) && !empty($departmentDataList['dataList'])) {
                $departmentList = $departmentDataList['dataList'];
            }
        }
        return $this->renderPartial('edit-info', [
                'title' => '个人信息编辑',
                'id' => $id,
                'departmentDataList' => $departmentList,
            ]
        );
    }
    public function actionEdit() {
        //获取当前用户的角色
        $id = intval(Yii::$app->request->get("id", 0));
        $roleService = new RoleService();
        $roleIdsRet = $roleService->getRoleIds($id);
        $roleIds = BaseService::getRetData($roleIdsRet);
        $roleParams[] = [];
        $roleDataListRet = $roleService->getDatas($roleParams, [], 0, -1,['*']);
        $passportService = new ManageService();
        $userInfoRet = $passportService->getAdminUserInfoByUserId($id);
        return $this->renderPartial('edit', [
                'title' => $id ? '编辑管理员账户' : "添加管理员账户",
                'id' => $id,
                'roleIds' => $roleIds,
                'roleDataList' => BaseService::getRetData($roleDataListRet),
                'userInfo' => BaseService::getRetData($userInfoRet),
            ]
        );
    }
}