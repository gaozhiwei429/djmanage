<?php
/**
 * 党课分类相关的分类操作
 * @文件名称: CourseTypeController.php
 * @author: jawei
 * @Email: gaozhiwei429@sina.com
 * @Date: 2017-12-06
 * @Copyright: 2017 北京往全包科技有限公司. All rights reserved.
 * 注意：本内容仅限于北京往全包科技有限公司内部传阅，禁止外泄以及用于其他的商业目的
 */
namespace appcomponents\modules\manage\controllers;
use appcomponents\modules\common\CourseTypeService;
use source\controllers\ManageBaseController;
use source\manager\BaseService;
use \Yii;
class CourseTypeController extends ManageBaseController
{
    /**
     * 用户登录态基础类验证
     * @return array
     */
    public function beforeAction($action){
        return parent::beforeAction($action);
    }
    /**
     * 资讯分类
     * @return string
     */
    public function actionIndex() {
        $typeService = new CourseTypeService();
        $params[] = ['=', 'status', 1];
        $treeDataRet = $typeService->getTree($params, [], 1, -1, ['*'], true);
        $treeData = BaseService::getRetData($treeDataRet);
        return $this->renderPartial('index',
            [
                'title' => "微党课分类管理",
                'menuUrl' => $this->menuUrl,
                'treeData' => $treeData,
            ]
        );
    }
    /**
     * 新资讯分类详情
     * @return string
     */
    public function actionInfo() {
        $id = intval(Yii::$app->request->get('id', 0));
        $newsService = new CourseTypeService();
        $params = [];
        $params[] = ['=', 'id', $id];
        $newsInfoRet = $newsService->getInfo($params);
        return $this->renderPartial('info', [
                'title' => '微党课分类详情',
                'menuUrl' => $this->menuUrl,
                'info' => BaseService::getRetData($newsInfoRet),
            ]
        );
    }
    /**
     * 资讯分类编辑
     * @return string
     */
    public function actionEdit() {
        $id = intval(Yii::$app->request->get('id', 0));
        $newsService = new CourseTypeService();
        $params = [];
        $params[] = ['=', 'id', $id];
        $newsInfoRet = $newsService->getInfo($params);
        return $this->renderPartial('edit',
            [
                'title' => "微党课分类编辑",
                'menuUrl' => $this->menuUrl,
                'info' => BaseService::getRetData($newsInfoRet),
            ]
        );
    }
}
