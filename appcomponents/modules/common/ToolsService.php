<?php

/**
 * 系统工具服务
 * Class ToolsService
 * @author: jawei
 * @Email: gaozhiwei429@sina.com
 * @Mobile: 15910987706
 * @Date: 2018-12-01
 * @Copyright: 2017 北京往全保科技有限公司. All rights reserved.
 * 注意：本内容仅限于北京往全保科技有限公司内部传阅，禁止外泄以及用于其他的商业目的
 */
namespace appcomponents\modules\common;

class ToolsService
{

    /**
     * Emoji原形转换为String
     * @param string $content
     * @return string
     */
    public static function emojiEncode($content)
    {
        return json_decode(preg_replace_callback("/(\\\u[ed][0-9a-f]{3})/i", function ($str) {
            return addslashes($str[0]);
        }, json_encode($content)));
    }

    /**
     * Emoji字符串转换为原形
     * @param string $content
     * @return string
     */
    public static function emojiDecode($content)
    {
        return json_decode(preg_replace_callback('/\\\\\\\\/i', function () {
            return '\\';
        }, json_encode($content)));
    }

    /**
     * 一维数据数组生成数据树
     * @param array $list 数据列表
     * @param string $id 父ID Key
     * @param string $pid ID Key
     * @param string $son 定义子数据Key
     * @return array
     */
    public static function arr2tree($list, $id = 'id', $pid = 'pid', $son = 'sub')
    {
        list($tree, $map) = [[], []];
        foreach ($list as $item) {
            $map[$item[$id]] = $item;
        }
        foreach ($list as $item) {
            if (isset($item[$pid]) && isset($map[$item[$pid]])) {
                $map[$item[$pid]][$son][] = &$map[$item[$id]];
            } else {
                $tree[] = &$map[$item[$id]];
            }
        }
        unset($map);
        return $tree;
    }

    /**
     * 一维数据数组生成数据树
     * @param array $list 数据列表
     * @param string $id ID Key
     * @param string $pid 父ID Key
     * @param string $path
     * @param string $ppath
     * @return array
     */
    public static function arr2table(array $list, $id = 'id', $pid = 'pid', $path = 'path', $ppath = '')
    {
        $tree = [];
        foreach (self::arr2tree($list, $id, $pid) as $attr) {
            $attr[$path] = "{$ppath}-{$attr[$id]}";
            $attr['sub'] = isset($attr['sub']) ? $attr['sub'] : [];
            $attr['spt'] = substr_count($ppath, '-');
            $attr['spl'] = str_repeat("&nbsp;&nbsp;&nbsp;├&nbsp;&nbsp;", $attr['spt']);
            $sub = $attr['sub'];
            unset($attr['sub']);
            $tree[] = $attr;
            if (!empty($sub)) {
                $tree = array_merge($tree, self::arr2table($sub, $id, $pid, $path, $attr[$path]));
            }
        }
        return $tree;
    }

    /**
     * 获取数据树子ID
     * @param array $list 数据列表
     * @param int $id 起始ID
     * @param string $key 子Key
     * @param string $pkey 父Key
     * @return array
     */
    public static function getArrSubIds($list, $id = 0, $key = 'id', $pkey = 'pid')
    {
        $ids = [intval($id)];
        foreach ($list as $vo) {
            if (intval($vo[$pkey]) > 0 && intval($vo[$pkey]) === intval($id)) {
                $ids = array_merge($ids, self::getArrSubIds($list, intval($vo[$key]), $key, $pkey));
            }
        }
        return $ids;
    }

    /**
     * 写入CSV文件头部
     * @param string $filename 导出文件
     * @param array $headers CSV 头部(一级数组)
     */
    public static function setCsvHeader($filename, array $headers)
    {
        header('Content-Type: application/octet-stream');
        header("Content-Disposition: attachment; filename=" . iconv('utf-8', 'gbk//TRANSLIT', $filename));
        echo @iconv('utf-8', 'gbk//TRANSLIT', "\"" . implode('","', $headers) . "\"\n");
    }

    /**
     * 写入CSV文件内容
     * @param array $list 数据列表(二维数组或多维数组)
     * @param array $rules 数据规则(一维数组)
     */
    public static function setCsvBody(array $list, array $rules)
    {
        foreach ($list as $data) {
            $rows = [];
            foreach ($rules as $rule) {
                $item = self::parseKeyDot($data, $rule);
                $rows[] = $item === $data ? '' : $item;
            }
            echo @iconv('utf-8', 'gbk//TRANSLIT', "\"" . implode('","', $rows) . "\"\n");
            flush();
        }
    }

    /**
     * 根据数组key查询(可带点规则)
     * @param array $data 数据
     * @param string $rule 规则，如: order.order_no
     * @return mixed
     */
    private static function parseKeyDot(array $data, $rule)
    {
        list($temp, $attr) = [$data, explode('.', trim($rule, '.'))];
        while ($key = array_shift($attr)) {
            $temp = isset($temp[$key]) ? $temp[$key] : $temp;
        }
        return (is_string($temp) || is_numeric($temp)) ? str_replace('"', '""', "\t{$temp}") : '';
    }

}
