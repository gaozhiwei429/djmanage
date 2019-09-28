<?php
/**
 * CURL请求
 * @文件名称: DmpCurl.php
 * @author jawei
 * @email gaozhiwei429@sina.com
 * @Mobile: 15910987706
 * @Date: 2017-06-06
 * @Copyright: 2018 北京往全保科技有限公司. All rights reserved.
 * 注意：本内容仅限于北京往全保科技有限公司内部传阅，禁止外泄以及用于其他的商业目的
 */

namespace source\libs;
use source\manager\BaseException;
use Yii;

class DmpCurl
{
    /**
     * http get
     * @param $url
     * @return mixed
     */
    public static function get($url) {
        //初始化
        $curl = curl_init();
        //设置抓取的url
        curl_setopt($curl, CURLOPT_URL, $url);
        //设置头文件的信息作为数据流输出
        curl_setopt($curl, CURLOPT_HEADER, 0);
        //设置获取的信息以文件流的形式返回，而不是直接输出。
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER,array('Content-Type: application/json'));
        //执行命令
        $data = curl_exec($curl);
        //关闭URL请求
        curl_close($curl);
        //显示获得的数据
        $result = json_decode($data,true);
        return $result;
    }
    public static function httpQuery($url, $param, $level='info') {
        if(!empty($param)) {
            $params_string = http_build_query($param);
            $ch = curl_init($url.'?'.$params_string);
        } else {
            $ch = curl_init($url);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ; // 获取数据返回
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true) ; // 在启用 CURLOPT_RETURNTRANSFER 时候将获取数据返回
        curl_setopt($ch, CURLOPT_HTTPHEADER,array('Content-Type: application/json'));
        $contents = curl_exec($ch);
        $result = json_decode($contents,true);
        $logInfo = [
            'url' => $url,
            'params' => $param,
            'result' => $result,
        ];
        DmpLog::info("http_query_info", $logInfo);
        return $result;
    }

    /**
     * x-www-form-urlencode 请求
     * @param $url
     * @param $param
     * @return mixed
     */
    public static function httpFormUrlEncodeQuery($url, $param) {
        if(!empty($param)) {
            $params_string = http_build_query($param);
            $ch = curl_init($url.'?'.$params_string);
        } else {
            $ch = curl_init($url);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ; // 获取数据返回
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true) ; // 在启用 CURLOPT_RETURNTRANSFER 时候将获取数据返回
//        curl_setopt($ch, CURLOPT_HTTPHEADER,array('Content-Type: application/x-www-form-urlencode'));
        curl_setopt($ch, CURLOPT_HTTPHEADER,array('Content-Type: application/x-www-form-urlencode'));
        $contents = curl_exec($ch);
        $result = json_decode($contents,true);
        $logInfo = [
            'url' => $url,
            'params' => $param,
            'result' => $result,
        ];
        DmpLog::info("httpFormUrlEncodeQuery", $logInfo);
        return $result;
    }
    public static function post($url, $content)
    {
        return self::basePost($url, $content, true);
    }

    public static function fastPost($url, $content)
    {
        return self::basePost($url, $content, false);
    }
    //通过curl模拟post的请求；
    public static function SendDataByCurl($url,$data=array()){
        //对空格进行转义
        $url = str_replace(' ','+',$url);
        $ch = curl_init();
        //设置选项，包括URL
        curl_setopt($ch, CURLOPT_URL, "$url");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch,CURLOPT_TIMEOUT,100); //定义超时3秒钟
        // POST数据
        curl_setopt($ch, CURLOPT_POST, 1);
        // 把post的变量加上
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));  //所需传的数组用http_bulid_query()函数处理一下，就ok了
        //执行并获取url地址的内容
        $output = curl_exec($ch);
        $errorCode = curl_errno($ch);
        //释放curl句柄
        curl_close($ch);
        if(0 !== $errorCode) {
            return false;
        }
        return $output;
    }
    protected static function basePost($url, $content, $needLog)
    {
        $options = [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER  => false,
            CURLOPT_CONNECTTIMEOUT => 50, // timeout on connect
            CURLOPT_TIMEOUT => 100, // timeout on response
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $content,
            CURLOPT_CUSTOMREQUEST => 'POST',
        ];

        $ch = curl_init($url);
        if ($ch) {
            curl_setopt_array($ch, $options);
            $data = curl_exec($ch);
            curl_close($ch);
            if($needLog){
                $logInfo = [
                    'url' => $url,
                    'params' => $content,
                    'result' => $data
                ];
                DmpLog::info('curl_post_result',$logInfo);
            }
        } else {
            throw new BaseException('curl post fail: ' . curl_error($ch), 50031);
        }
        return $data;
    }
}
