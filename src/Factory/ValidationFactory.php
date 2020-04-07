<?php
/**
 * Created by PhpStorm.
 * User: ailuoy
 * Date: 2019/5/5
 * Time: 下午6:13
 */

namespace Ailuoy\NeteaseIm\Factory;


use Illuminate\Support\Facades\Validator;
use Ailuoy\NeteaseIm\Exceptions\ParameterErrorException;
class ValidationFactory
{
    public static function check(array $rules, array $messages, $parameters)
    {
        $validate = Validator::make($parameters, $rules, $messages);
        if ($validate->fails()) {
            throw new ParameterErrorException($validate->errors()->first());
        }
    }
}