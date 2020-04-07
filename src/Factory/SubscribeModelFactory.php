<?php
/**
 * Created by PhpStorm.
 * User: ailuoy
 * Date: 2019/5/6
 * Time: 下午4:53
 */

namespace Ailuoy\NeteaseIm\Factory;

use Ailuoy\NeteaseIm\Models\Subscribe\BatchDel;
use Ailuoy\NeteaseIm\Models\Subscribe\Delete;
use Ailuoy\NeteaseIm\Models\Subscribe\Query;
use Ailuoy\NeteaseIm\ResultReturn;
use Ailuoy\NeteaseIm\Models\Subscribe\Add;
use Ailuoy\NeteaseIm\Exceptions\ResultReturnException;

/**
 * @property Add      add
 * @property Delete   delete
 * @property BatchDel batchDel
 * @property Query    query
 *
 *
 * Class ModuleFactory
 * @package Ailuoy\NeteaseIm\Factory
 */
class SubscribeModelFactory
{

    private function modelList()
    {
        $modelList = [
            'add'      => Add::class,
            'delete'   => Delete::class,
            'batchDel' => BatchDel::class,
            'query'    => Query::class,
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