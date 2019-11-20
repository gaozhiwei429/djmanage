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
use appcomponents\modules\common\OrganizationService;
use appcomponents\modules\common\TypeService;
use source\controllers\BaseController;
use source\manager\BaseService;
use Yii;
class TestController extends BaseController
{
    public function beforeAction($action){
        return parent::beforeAction($action);
    }
    /**
     * 获取树状管理结构数据
     * @return array
     */
    public function actionIndex() {
        $organizationService = new OrganizationService();
        $params[] = ['!=', 'status', 0];
        return $organizationService->getDTree($params, ['id'=>SORT_ASC], 1, -1, $fied=['*'], true);
		$data = '{"status":{"code":0,"msg":"操作成功"},"data":[{"id":2,"title":"集团党委","parent_id":0,"checkArr":{"type":0,"isChecked":0},"isLast":false,"children":[{"id":3,"title":"机关党总支部","parent_id":2,"checkArr":{"type":0,"isChecked":0},"isLast":false,"children":[{"id":10,"title":"机关第一党支部 【党委（学院）办公室】","parent_id":3,"checkArr":{"type":0,"isChecked":0},"isLast":true},{"id":11,"title":"机关第二党支部 （组织人事处）","parent_id":3,"checkArr":{"type":0,"isChecked":0},"isLast":true},{"id":12,"title":"机关第三党支部 （纪检监察室、审计室、教学质量管理办公室）","parent_id":3,"checkArr":{"type":0,"isChecked":0},"isLast":true},{"id":13,"title":"机关第四党支部（教务处、国际交流处）","parent_id":3,"checkArr":{"type":0,"isChecked":0},"isLast":true},{"id":17,"title":"机关第五党支部（学生工作处、团委）","parent_id":3,"checkArr":{"type":0,"isChecked":0},"isLast":true},{"id":18,"title":"机关第六党支部 （招生就业处）","parent_id":3,"checkArr":{"type":0,"isChecked":0},"isLast":true},{"id":19,"title":"机关第七党支部 （后勤管理处、资产管理处）","parent_id":3,"checkArr":{"type":0,"isChecked":0},"isLast":true},{"id":20,"title":"机关第八党支部 （财务处）","parent_id":3,"checkArr":{"type":0,"isChecked":0},"isLast":true},{"id":21,"title":"机关第九党支部（科研处）","parent_id":3,"checkArr":{"type":0,"isChecked":0},"isLast":true},{"id":22,"title":"机关第十党支部  （工会，明秀开发办、退休老干部）","parent_id":3,"checkArr":{"type":0,"isChecked":0},"isLast":true},{"id":23,"title":"机关第十一党支部（继续教育中心）","parent_id":3,"checkArr":{"type":0,"isChecked":0},"isLast":true},{"id":24,"title":"机关第十二党支部（图书馆）","parent_id":3,"checkArr":{"type":0,"isChecked":0},"isLast":true},{"id":25,"title":"机关第十三党支部（信息网络管理中心）","parent_id":3,"checkArr":{"type":0,"isChecked":0},"isLast":true},{"id":26,"title":"公共基础教学部党支部","parent_id":3,"checkArr":{"type":0,"isChecked":0},"isLast":true},{"id":27,"title":"社会科学教学部党支部","parent_id":3,"checkArr":{"type":0,"isChecked":0},"isLast":true}]},{"id":1,"title":"国际贸易系党总支部","parent_id":2,"checkArr":{"type":0,"isChecked":0},"isLast":false,"children":[{"id":14,"title":"教工党支部","parent_id":1,"checkArr":{"type":0,"isChecked":0},"isLast":true},{"id":15,"title":"学生党支部","parent_id":1,"checkArr":{"type":0,"isChecked":0},"isLast":true}]},{"id":9,"title":"金融系党总支部","parent_id":2,"checkArr":{"type":0,"isChecked":0},"isLast":false,"children":[{"id":38,"title":"党支部","parent_id":9,"checkArr":{"type":0,"isChecked":0},"isLast":true}]},{"id":4,"title":"应用外语系党总支部","parent_id":2,"checkArr":{"type":0,"isChecked":0},"isLast":false,"children":[{"id":28,"title":"教工党支部","parent_id":4,"checkArr":{"type":0,"isChecked":0},"isLast":true},{"id":29,"title":"学生党支部","parent_id":4,"checkArr":{"type":0,"isChecked":0},"isLast":true}]},{"id":5,"title":"会计系党总支部","parent_id":2,"checkArr":{"type":0,"isChecked":0},"isLast":false,"children":[{"id":30,"title":"教工党支部","parent_id":5,"checkArr":{"type":0,"isChecked":0},"isLast":true},{"id":31,"title":"学生党支部","parent_id":5,"checkArr":{"type":0,"isChecked":0},"isLast":true}]},{"id":6,"title":"市场流通系党总支部","parent_id":2,"checkArr":{"type":0,"isChecked":0},"isLast":false,"children":[{"id":32,"title":"教工党支部","parent_id":6,"checkArr":{"type":0,"isChecked":0},"isLast":true},{"id":33,"title":"学生党支部","parent_id":6,"checkArr":{"type":0,"isChecked":0},"isLast":true}]},{"id":7,"title":"旅游管理系党总支部","parent_id":2,"checkArr":{"type":0,"isChecked":0},"isLast":false,"children":[{"id":34,"title":"教工党支部","parent_id":7,"checkArr":{"type":0,"isChecked":0},"isLast":true},{"id":35,"title":"学生党支部","parent_id":7,"checkArr":{"type":0,"isChecked":0},"isLast":true}]},{"id":8,"title":"信息工程系党总支部","parent_id":2,"checkArr":{"type":0,"isChecked":0},"isLast":false,"children":[{"id":36,"title":"教工党支部","parent_id":8,"checkArr":{"type":0,"isChecked":0},"isLast":true},{"id":37,"title":"学生党支部","parent_id":8,"checkArr":{"type":0,"isChecked":0},"isLast":true}]}]}]}';
        $dataRet = json_decode($data, true);
        $data = isset($dataRet['data']) ? $dataRet['data'] : 0;
        return BaseService::returnOkData($data);
        return $data;//BaseService::returnOkData(json_decode($data, true));
	}
}
