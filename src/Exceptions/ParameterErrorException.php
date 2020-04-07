<?php
/**
 * Created by PhpStorm.
 * User: ailuoy
 * Date: 2019/5/5
 * Time: 下午6:14
 */

namespace Ailuoy\NeteaseIm\Exceptions;

/**
 * 参数错误异常
 *
 * Class ParameterErrorException
 * @package Ailuoy\NeteaseIm\Exceptions
 */
class ParameterErrorException extends NeteaseImException
{
    public function __construct($message = '参数错误')
    {
        parent::__construct($message);
    }
}