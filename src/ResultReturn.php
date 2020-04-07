<?php
/**
 * Created by PhpStorm.
 * User: ailuoy
 * Date: 2019/5/5
 * Time: 下午10:08
 */

namespace Ailuoy\NeteaseIm;

use Throwable;
class ResultReturn
{
    const RESULT_RETURN_STATUS_SUCCESS = true;
    const RESULT_RETURN_STATUS_FAILED = false;

    public static function success($data)
    {
        return new ResultReturnStructure(self::RESULT_RETURN_STATUS_SUCCESS, '', $data);
    }

    public static function failed($msg, $data = null)
    {
        return new ResultReturnStructure(self::RESULT_RETURN_STATUS_FAILED, $msg, $data);
    }

    public static function exception(string $message = "", int $code = 500, Throwable $previous = null)
    {
        throw new ResultReturnException($message, $code, $previous);
    }
}