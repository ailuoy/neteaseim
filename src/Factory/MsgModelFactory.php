<?php
/**
 * Created by PhpStorm.
 * User: ailuoy
 * Date: 2019/5/6
 * Time: 下午4:53
 */

namespace Ailuoy\NeteaseIm\Factory;


use Ailuoy\NeteaseIm\Models\Msg\Recall;
use Ailuoy\NeteaseIm\Models\Msg\SendAttachMsg;
use Ailuoy\NeteaseIm\Models\Msg\SendBatchAttachMsg;
use Ailuoy\NeteaseIm\Models\Msg\Upload;
use Ailuoy\NeteaseIm\ResultReturn;
use Ailuoy\NeteaseIm\Models\Msg\SendMsg;
use Ailuoy\NeteaseIm\Models\Msg\SendBatchMsg;
use Ailuoy\NeteaseIm\Exceptions\ResultReturnException;

/**
 * @property SendMsg            sendMsg
 * @property SendBatchMsg       sendBatchMsg
 * @property SendAttachMsg      sendAttachMsg
 * @property SendBatchAttachMsg sendBatchAttachMsg
 * @property Upload             upload
 * @property Recall             recall
 *
 *
 * Class ModuleFactory
 * @package Ailuoy\NeteaseIm\Factory
 */
class MsgModelFactory
{

    private function modelList()
    {
        $modelList = [
            'sendMsg'            => SendMsg::class,
            'sendBatchMsg'       => SendBatchMsg::class,
            'sendAttachMsg'      => SendAttachMsg::class,
            'sendBatchAttachMsg' => SendBatchAttachMsg::class,
            'upload'             => Upload::class,
            'recall'             => Recall::class
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