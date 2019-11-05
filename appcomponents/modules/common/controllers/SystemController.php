<?php
/**
 * 运营平台服务类型相关接口
 * @文件名称: TypeController.php
 * @author: jawei
 * @Email: gaozhiwei429@sina.com
 * @Mobile: 15910987706
 * @Date: 2018-12-01
 * @Copyright: 2017 北京往全保科技有限公司. All rights reserved.
 * 注意：本内容仅限于北京往全保科技有限公司内部传阅，禁止外泄以及用于其他的商业目的
 */
namespace appcomponents\modules\common\controllers;
use source\controllers\ManageBaseController;
use source\manager\BaseService;
use Yii;
class SystemController extends ManageBaseController
{
    public function beforeAction($action){
        $this->noLogin = true;
        return parent::beforeAction($action);
    }
    /**
     *
     * @return array
     */
    public function actionIndex() {

    }
}
