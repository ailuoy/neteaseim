<?php
/**
 * Created by PhpStorm.
 * User: ailuoy
 * Date: 2019/5/6
 * Time: 下午4:53
 */

namespace Ailuoy\NeteaseIm\Factory;

use Ailuoy\NeteaseIm\Models\Friend\Delete;
use Ailuoy\NeteaseIm\Models\Friend\Get;
use Ailuoy\NeteaseIm\Models\Friend\Update;
use Ailuoy\NeteaseIm\ResultReturn;
use Ailuoy\NeteaseIm\Models\Friend\Add;
use Ailuoy\NeteaseIm\Exceptions\ResultReturnException;

/**
 * @property Add    add
 * @property Update update
 * @property Delete delete
 * @property Get    get
 *
 *
 * Class ModuleFactory
 * @package Ailuoy\NeteaseIm\Factory
 */
class FriendModelFactory
{

    private function modelList()
    {
        $modelList = [
            'add'    => Add::class,
            'update' => Update::class,
            'delete' => Delete::class,
            'get'    => Get::class
        ];

        return ResultReturn::success($modelList);
    }


    private function __clone()
    {
    }

    private function __wakeup()
    {
    }

    public function __get($name)
    {
        $modelList = $this->modelList()->data;
        if (!isset($modelList[$name])) {
            throw new ResultReturnException($name . ' model 不存在');
        }
        $model = new $modelList[$name];

        return $model;
    }
}