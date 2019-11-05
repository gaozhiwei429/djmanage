<?php
namespace appcomponents\modules\admin\controllers;
use source\controllers\ManageBaseController;
use source\manager\BaseException;
use source\manager\BaseService;
use Yii;

class ManageUserController extends ManageBaseController {
    /**
     * 用户登录态基础类验证
     * @return array
     */
    public function beforeAction($action){
        $controller =  Yii::$app->controller->id;
        $action = Yii::$app->controller->action->id;
        $url = "../../$controller/$action";
        $request = Yii::$app->request->get();
        if(!empty($request)) {
            $requestData = [];
            foreach($request as $requestk=>$requestv) {
                $requestData[] = $requestk."=".$requestv;
            }
            $url.="?".implode("&",$requestData);
        }
        header("Location: $url");
    }
    public function actionIndex() {
    }
    public function actionPass() {
    }
    public function actionEdit() {
    }
    public function afterAction($action, $result) {
        try{
            $controller =  Yii::$app->controller->id;
            $action = Yii::$app->controller->action->id;
            $url = "../../$controller/$action";
            $request = Yii::$app->request->get();
            if(!empty($request)) {
                $requestData = [];
                foreach($request as $requestk=>$requestv) {
                    $requestData[] = $requestk."=".$requestv;
                }
                $url.="?".implode("&",$requestData);
            }
            header("Location: $url");
        }catch (BaseException $e) {
            return BaseService::returnErrData([], 500, "请求数据异常");
        }
    }
}
