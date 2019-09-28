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
use Yii;
use yii\helpers\Url;

class SiteController extends BaseController {
    public function beforeAction($action) {
//        if(!isset($this->userInfo) || empty($this->userInfo)) {
//            $url = Url::to(['user/login']);
//            //跳转到登录页面
//            header("Location: $url");
//        }
        return parent::beforeAction($action);
    }
    /**
     * 前端(单页面应用)入口
     */
    public function actionIndex() {
        return $this->render('index',
            [
                'title' => '系统管理',
                'menus' => $this->menus,
                'menuUrl' => $this->menuUrl,
                'userInfo' => $this->userInfo
            ]
        );
    }
}