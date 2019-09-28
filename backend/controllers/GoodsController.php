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
use appcomponents\modules\common\TypeService;
use appcomponents\modules\project\MaterialService;
use appcomponents\modules\project\ProjectService;
use source\manager\BaseService;
use Yii;

class GoodsController extends BaseController {
    public $title = '产品管理';
    public $layout = 'content';
    public function beforeAction($action) {
        return parent::beforeAction($action);
    }
    public function actionIndex() {
        $name = trim(Yii::$app->request->get("name", ""));
        return $this->renderPartial('index',
            [
                'name'=> $name,
                'title' => "产品管理",
                'menuUrl' => $this->menuUrl,
            ]
        );
    }
    public function actionEdit() {
        $id = intval(Yii::$app->request->get("id", 0));
        $typeId = 0;
        $info = [];
        if($id){
            $params[] = ['=', 'id', $id];
            $projectService = new ProjectService();
            $projectInfoRet = $projectService->getInfo($params);
            if(BaseService::checkRetIsOk($projectInfoRet)) {
                $info = BaseService::getRetData($projectInfoRet);
                $typeId = isset($info['type_id']) ? $info['type_id'] : 0;
            }
        }
        $typeService = new TypeService();
        $treeParams[] = ['=','status',1];
        $typeTreeRet = $typeService->getTree($treeParams, [], 1, -1,['*'],true);
        //主体材质
        $materialService = new MaterialService();
        $materialListRet = $materialService->getList([], [], 1, -1, ['*']);
        $materialListData = BaseService::getRetData($materialListRet);
        return $this->renderPartial('edit',
            [
                'id'=> $id,
                'title' => "产品编辑",
                'menuUrl' => $this->menuUrl,
                'info'=>$info,
                'type_id'=>$typeId,
                'typeTree'=>json_encode(BaseService::getRetData($typeTreeRet)),
                'materialList'=>isset($materialListData['dataList']) ? $materialListData['dataList'] : [],
            ]
        );
    }
    public function actionInfo() {
        $id = intval(Yii::$app->request->post('id', 0));
        return $this->render('info', [
                'title' => '产品详情',
                'id' => $id,
            ]
        );
    }
    public function actionRu() {
        $id = intval(Yii::$app->request->post('id', 0));
        return $this->render('ru', [
                'title' => '入库操作',
                'id' => $id,
            ]
        );
    }
}