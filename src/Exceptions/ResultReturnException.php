<?php
/**
 * Created by PhpStorm.
 * User: ailuoy
 * Date: 2019/5/5
 * Time: 下午10:12
 */

namespace Ailuoy\NeteaseIm\Exceptions;

/**
 * 信息返回异常
 *
 * Class ResultReturnException
 * @package Ailuoy\NeteaseIm\Exceptions
 */
class ResultReturnException extends NeteaseImException
{
    public function __construct($message = '参数错误')
    {
        parent::__construct($message);
    }
}