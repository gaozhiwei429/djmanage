<?php
/**
* 设备或配置系统参数相关的接口
* @文件名称: ConfigController.php
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
class ConfigController extends ManageBaseController
{
    public function beforeAction($action){
        $userToken = parent::userToken();
        if (!BaseService::checkRetIsOk($userToken)) {
            return $userToken;
        }
        return parent::beforeAction($action);
    }
    public function actionSysconf($name, $value = null)
    {
    static $config = [];
    if ($value !== null) {
    list($config, $data) = [[], ['name' => $name, 'value' => $value]];
    return DataService::save('Config', $data, 'name');
    }
    if (empty($config)) {
    $config = Db::name('Config')->column('name,value');
    }
    return isset($config[$name]) ? $config[$name] : '';
    }
}
?>