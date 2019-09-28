<?php
/**
 * 用户登录user_token值存储表
 * @文件名称: AdminUserModel.php
 * @author: jawei
 * @Email: gaozhiwei429@sina.com
 * @Mobile: 15910987706
 * @Date: 2018-12-01
 * @Copyright: 2017 北京往全保科技有限公司. All rights reserved.
 * 注意：本内容仅限于北京往全保科技有限公司内部传阅，禁止外泄以及用于其他的商业目的
 */
namespace appcomponents\modules\manage\models;
use source\libs\DmpLog;
use source\models\BaseModel;
use Yii;
class UserLoginTokenModel extends BaseModel {
    public static function tableName() {
        return '{{%user_login_token}}';
    }
    /**
     * 根据条件获取最后一条信息
     * @param $verify_value
     * @param int $type
     * @return mixed
     */
    public function getInfoByParams($params){
        return $this->getOne($params);
    }
    /**
     * 添加一条记录到记录表
     * @param $addData
     * @return bool|string
     */
    public function addInfo($addData) {
        try {
            $thisModel = new self();
            $thisModel->user_id = isset($addData['user_id']) ? trim($addData['user_id']) : null;
            $thisModel->token = isset($addData['token']) ? trim($addData['token']) : null;
            $thisModel->overdue_time = isset($addData['overdue_time']) ? trim($addData['overdue_time']) : null;//过期时间
            $thisModel->source = isset($addData['source']) ? intval($addData['source']) : 0;//登陆来源【0网站，1Android，2iOS，3H5】
            $thisModel->type = isset($addData['type']) ? intval($addData['type']) : 0;//用户类型【1C端用户，2B端用户，3财务系统，4运营系统】
            $thisModel->save();
            return Yii::$app->db->getLastInsertID();
//            return $isSave;
        } catch (\Exception $e) {
            DmpLog::error('insert_user_token_error', $e);
            return false;
        }
    }
    /**
     * 更新信息数据
     * @param int $id ID
     * @param array $updateInfo 需要更新的数据集合
     * @return bool
     */
    public static function updateInfo($id, $updateInfo) {
        try {
            $datainfo = self::findOne(['id' => $id]);
            if(!empty($updateInfo) && !empty($datainfo)) {
                foreach($updateInfo as $k=>$v) {
                    $datainfo->$k = trim($v);
                }
                return $datainfo->save();
            }
            return false;
        } catch (\Exception $e) {
            $log = [
                'msg'    => $e->getMessage(),
                'data' => $updateInfo,
            ];
            DmpLog::error('update_user_token_error', $log);
            return false;
        }
    }
    /**
     * 获取总数量
     * @param $params
     * @return int
     */
    public static function getCount($params, $fied=['*']) {
        try {
            $query = self::find()->select($fied);
            if(!empty($params)) {
                foreach($params as $k=>$v) {
                    if(is_array($v)) {
                        $query -> andWhere($v);
                    } else {
                        $query -> andWhere([$k=>$v]);
                    }
                }
            }
//                return $query->createCommand()->getRawSql();
            return  $query->count();
        } catch (\Exception $e) {
            $log = [
                'msg'    => $e->getMessage(),
                'params' => $params,
            ];
            DmpLog::warning('getCount_user_token_error', $log);
            return 0;
        }
    }
}
