<?php
/**
 * Redis操作
 * @文件名称: DmpRedis.php
 * @author jawei
 * @email gaozhiwei429@sina.com
 * @Mobile: 15910987706
 * @Date: 2017-06-06
 * @Copyright: 2018 北京往全保科技有限公司. All rights reserved.
 * 注意：本内容仅限于北京往全保科技有限公司内部传阅，禁止外泄以及用于其他的商业目的
 */
namespace source\libs;
use Yii;

class DmpRedis {
    public  $redis;
    public function __construct() {
//        $redisParams = isset(Yii::$app->params['redis']) ? Yii::$app->params['redis'] : [];
//        $host = isset($redisParams['hostname']) ? $redisParams['hostname'] : '127.0.0.1';
//        $port = isset($redisParams['port']) ? $redisParams['port'] : '6379';
//        $password = isset($redisParams['password']) ? $redisParams['password'] : '';
        //实例化
        $this->redis = Yii::$app->redis;
        //连接服务器
//        $this->redis->connect($host, $port);
        //授权
        if(!empty($password)) {
            $this->redis->auth($password);
        }
    }
    /**
     * redis的队列存储lpush
     * @param $key
     * @param $val
     */
    public function LpushRedis($key, $val) {
        $flag = false;
        if(!empty($val)) {
            if(is_array($val)) {
                foreach($val as $k=>$v) {
                    $flag = $this->redis->lpush($key, $v);
                }
            } else {
                $flag = $this->redis->lpush($key, $val);
            }

        }
        return $flag;
    }
    /**
     * redis的队列存储rpush
     * @param $key
     * @param $val
     */
    public function RpushRedis($key, $val) {
        $flag = false;
        if(!empty($val)) {
            if(is_array($val)) {
                foreach($val as $k=>$v) {
                    $flag = $this->redis->rpush($key, $v);
                }
            } else {
                $flag = $this->redis->rpush($key, $val);
            }
        }
        return $flag;
    }
    /**
     * redis的队列存储删除头部
     * @param $key
     * @param $val
     */
    public function RpopRedis($key) {
        return $this->redis->rpop($key);
    }
    /**
     * redis的队列存储删除尾部
     * @param $key
     * @param $val
     */
    public function LpopRedis($key) {
        return $this->redis->lpop($key);
    }
    /**
     * 删除队列key
     * @param $key
     * @return mixed
     */
    public function LdelRedis($key) {
        return $this->redis->del($key);
    }
    /**
     * 获取某个队列数据的长度
     * @param $key
     * @return mixed
     */
    public function llen($key) {
        return $this->redis->llen($key);
    }
}
