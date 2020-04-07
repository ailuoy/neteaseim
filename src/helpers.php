<?php
/**
 * Created by PhpStorm.
 * User: ailuoy
 * Date: 2019/5/5
 * Time: 下午4:43
 */

if (!function_exists('get_url_query')) {
    /**
     * 将参数变为字符串
     *
     * @param $array_query
     *
     * @return string string 'm=content&c=index&a=lists&catid=6&area=0&author=0&h=0®ion=0&s=1&page=1' (length=73)
     */
    function get_url_query($array_query)
    {
        $tmp = array();
        foreach ($array_query as $k => $param) {
            $tmp[] = $k . '=' . $param;
        }
        $params = implode('&', $tmp);

        return $params;
    }
}

if (!function_exists('url_query_to_array')) {
    /**
     * 将字符串参数变为数组
     *
     * @param $query
     *
     * @return array
     */
    function url_query_to_array($query)
    {
        $query_parts = explode('&', $query);
        $params = array();
        foreach ($query_parts as $param) {
            $item = explode('=', $param);
            $params[$item[0]] = $item[1];
        }

        return $params;
    }
}