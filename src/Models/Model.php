<?php
/**
 * Created by PhpStorm.
 * User: ailuoy
 * Date: 2019/5/7
 * Time: 下午9:51
 */

namespace Ailuoy\NeteaseIm\Models;


use Ailuoy\NeteaseIm\Contracts\ModelInterface;
use Ailuoy\NeteaseIm\Factory\HttpClient;
use Ailuoy\NeteaseIm\Factory\ValidationFactory;

abstract class Model implements ModelInterface
{
    protected $args = [];

    /**
     * 合并参数
     *
     * @param  array  $arr
     *
     * @return array
     */
    protected function mergeArgs(array $arr)
    {
        return array_merge($arr, $this->args);
    }

    /**
     * 参数校验
     *
     * @param  array  $rules
     * @param  array  $messages
     * @param  array  $parameters
     *
     * @throws \Ailuoy\NeteaseIm\Exceptions\ParameterErrorException
     */
    protected function validation(array $rules, array $messages, array $parameters)
    {
        ValidationFactory::check($rules, $messages, $parameters);
    }

    /**
     * 发送http请求
     *
     * @param $method
     * @param $api
     * @param $parameters
     *
     * @return mixed
     * @throws \Ailuoy\NeteaseIm\Exceptions\ParameterErrorException
     * @throws \Ailuoy\NeteaseIm\Exceptions\RequestErrorException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function sendRequest($method, $api, $parameters)
    {
        return HttpClient::send($method, $api, $parameters)->data;
    }
}