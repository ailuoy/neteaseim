<?php
/**
 * Created by PhpStorm.
 * User: ailuoy
 * Date: 2019/5/6
 * Time: 上午6:55
 */

namespace Ailuoy\NeteaseIm\Exceptions;

/**
 * http 请求异常
 *
 * Class RequestErrorException
 * @package Ailuoy\NeteaseIm\Exceptions
 */
class RequestErrorException extends NeteaseImException
{
    public function __construct($message = '参数错误', $code = 0)
    {
        parent::__construct($message, $code);
    }
}