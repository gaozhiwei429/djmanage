<?php
/**
 * menu相关的数据获取service
 * @文件名称: MenuService.php
 * @author: jawei
 * @Email: gaozhiwei429@sina.com
 * @Mobile: 15910987706
 * @Date: 2018-12-01
 * @Copyright: 2017 北京往全保科技有限公司. All rights reserved.
 * 注意：本内容仅限于北京往全保科技有限公司内部传阅，禁止外泄以及用于其他的商业目的
 */
namespace appcomponents\modules\common;
use appcomponents\modules\common\models\BannerModel;
use appcomponents\modules\common\models\MenuModel;
use source\libs\Common;
use source\manager\BaseException;
use source\manager\BaseService;
use Yii;
class MenuService extends BaseService
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'appcomponents\modules\common\controllers';
    /**
     * @inheritdoc
     */
    public function init() {
        parent::init();
    }
    /**
     * 获取操作菜单数据集合
     * @param $params
     * @param array $orderBy
     * @param int $offset
     * @param int $limit
     * @param array $field
     * @return array
     */
    public function getDatas($params, $orderBy = [], $offset=0, $limit=10, $field=['*']) {
        $menuModel = new MenuModel();
        $dataArrs = $menuModel->getDatas($params, $orderBy, $offset, $limit, $field);
        if(!empty($dataArrs)) {
            return BaseService::returnOkData($dataArrs);
        }
        return BaseService::returnErrData($dataArrs, 52500, "请求数据不存在");
    }

}
