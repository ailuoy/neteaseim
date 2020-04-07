<?php
/**
 * Created by PhpStorm.
 * User: ailuoy
 * Date: 2019/5/6
 * Time: 下午4:53
 */

namespace Ailuoy\NeteaseIm\Factory;

use Ailuoy\NeteaseIm\Models\History\DeleteHistoryMessage;
use Ailuoy\NeteaseIm\Models\History\QueryBroadcastMsg;
use Ailuoy\NeteaseIm\Models\History\QueryBroadcastMsgById;
use Ailuoy\NeteaseIm\Models\History\QueryChatRoomMsg;
use Ailuoy\NeteaseIm\Models\History\QueryTeamMsg;
use Ailuoy\NeteaseIm\Models\History\QueryUserEvents;
use Ailuoy\NeteaseIm\ResultReturn;
use Ailuoy\NeteaseIm\Models\History\QuerySessionMsg;
use Ailuoy\NeteaseIm\Exceptions\ResultReturnException;

/**
 * @property QuerySessionMsg       querySessionMsg
 * @property QueryTeamMsg          queryTeamMsg
 * @property QueryChatRoomMsg      queryChatRoomMsg
 * @property DeleteHistoryMessage  deleteHistoryMessage
 * @property QueryUserEvents       queryUserEvents
 * @property QueryBroadcastMsg     queryBroadcastMsg
 * @property QueryBroadcastMsgById queryBroadcastMsgById
 *
 *
 * Class ModuleFactory
 * @package Ailuoy\NeteaseIm\Factory
 */
class HistoryModelFactory
{

    private function modelList()
    {
        $modelList = [
            'querySessionMsg'       => QuerySessionMsg::class,
            'queryTeamMsg'          => QueryTeamMsg::class,
            'queryChatRoomMsg'      => QueryChatRoomMsg::class,
            'deleteHistoryMessage'  => DeleteHistoryMessage::class,
            'queryUserEvents'       => QueryUserEvents::class,
            'queryBroadcastMsg'     => QueryBroadcastMsg::class,
            'queryBroadcastMsgById' => QueryBroadcastMsgById::class,
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