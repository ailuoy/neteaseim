<?php
/**
 * Created by PhpStorm.
 * User: ailuoy
 * Date: 2019/5/5
 * Time: 下午2:58
 */

namespace Ailuoy\NeteaseIm;

use Ailuoy\NeteaseIm\Exceptions\ResultReturnException;
use Ailuoy\NeteaseIm\Factory\ChatRoomModelFactory;
use Ailuoy\NeteaseIm\Factory\FriendModelFactory;
use Ailuoy\NeteaseIm\Factory\HistoryModelFactory;
use Ailuoy\NeteaseIm\Factory\MsgModelFactory;
use Ailuoy\NeteaseIm\Factory\SubscribeModelFactory;
use Ailuoy\NeteaseIm\Factory\TeamModelFactory;
use Ailuoy\NeteaseIm\Factory\UserModelFactory;

/**
 * @property UserModelFactory      user
 * @property FriendModelFactory    friend
 * @property MsgModelFactory       msg
 * @property TeamModelFactory      team
 * @property ChatRoomModelFactory  chatroom
 * @property HistoryModelFactory   history
 * @property SubscribeModelFactory subscribe
 *
 * Class NeteaseIm
 * @package Ailuoy\NeteaseIm
 */
class Client
{
    static public $appKey;
    static public $appSecret;

    public function __construct($appKey, $appSecret)
    {
        self::$appKey = $appKey;
        self::$appSecret = $appSecret;
    }

    /**
     * @return ResultReturnStructure
     */
    private function modelList()
    {
        $modelList = [
            'user'      => UserModelFactory::class,
            'friend'    => FriendModelFactory::class,
            'msg'       => MsgModelFactory::class,
            'team'      => TeamModelFactory::class,
            'chatroom'  => ChatRoomModelFactory::class,
            'history'   => HistoryModelFactory::class,
            'subscribe' => SubscribeModelFactory::class,
        ];

        return ResultReturn::success($modelList);
    }

    private function __clone()
    {
    }

    /**
     * @param $name
     *
     * @return mixed
     * @throws ResultReturnException
     */
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