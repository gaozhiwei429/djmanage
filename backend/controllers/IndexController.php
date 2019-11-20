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
use appcomponents\modules\common\NodeService;
use appcomponents\modules\common\ToolsService;
use source\manager\BaseException;
use source\manager\BaseService;
use Yii;

class IndexController extends BaseController {
    public function beforeAction($action) {
        return parent::beforeAction($action);
    }
    public function actionIndex() {
//        $this->layout=false;
        return $this->renderPartial('main',
            [
                'title' => "用户管理",
                'menuUrl' => $this->menuUrl,
            ]
        );
    }
    public function actionMain() {
        return $this->renderPartial('main',
            [
                'title' => "用户管理",
                'menuUrl' => $this->menuUrl,
            ]
        );
    }

    public function afterAction($action, $result) {
        return parent::afterAction($action, $result);
    }
}