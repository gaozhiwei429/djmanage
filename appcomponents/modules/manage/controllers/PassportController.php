<?php
namespace appcomponents\modules\manage\controllers;
use appcomponents\modules\passport\PassportService;
use source\controllers\ManageBaseController;
use source\manager\BaseService;
use Yii;

class PassportController  extends ManageBaseController
{
    /**
     * 用户登录态基础类验证
     * @return array
     */
    public function beforeAction($action){
        $this->noLogin=false;
        $userToken = parent::userToken();
        $getMenuUrl = parent::getMenuUrl();
        return parent::beforeAction($action);
    }

    public function actionIndex() {
        return $this->renderPartial('index',
            [
                'title' => "账号管理",
                'menuUrl' => $this->menuUrl,
            ]
        );
    }
    /**
     * 编辑账户信息
     * @return string
     */
    public function actionEdit() {
        $id = intval(Yii::$app->request->get("id", 0));
        $passportService = new PassportService();
        $passportRet = $passportService->getUserInfoByUserId($id);
        return $this->renderPartial('edit', [
                'title' => $id ? '创建账户' : "添加账户",
                'passportInfo' => BaseService::getRetData($passportRet),
            ]
        );
    }
}
