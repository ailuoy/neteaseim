<?php
/**
 * Created by PhpStorm.
 * User: ailuoy
 * Date: 2019/5/6
 * Time: 下午4:53
 */

namespace Ailuoy\NeteaseIm\Factory;

use Ailuoy\NeteaseIm\Models\ChatRoom\AddRobot;
use Ailuoy\NeteaseIm\Models\ChatRoom\Create;
use Ailuoy\NeteaseIm\Models\ChatRoom\Get;
use Ailuoy\NeteaseIm\Models\ChatRoom\GetBatch;
use Ailuoy\NeteaseIm\Models\ChatRoom\MembersByPage;
use Ailuoy\NeteaseIm\Models\ChatRoom\MuteRoom;
use Ailuoy\NeteaseIm\Models\ChatRoom\QueryMembers;
use Ailuoy\NeteaseIm\Models\ChatRoom\QueryUserRoomIds;
use Ailuoy\NeteaseIm\Models\ChatRoom\QueueBatchUpdateElements;
use Ailuoy\NeteaseIm\Models\ChatRoom\QueueDrop;
use Ailuoy\NeteaseIm\Models\ChatRoom\QueueInit;
use Ailuoy\NeteaseIm\Models\ChatRoom\QueueList;
use Ailuoy\NeteaseIm\Models\ChatRoom\QueueOffer;
use Ailuoy\NeteaseIm\Models\ChatRoom\QueuePoll;
use Ailuoy\NeteaseIm\Models\ChatRoom\RemoveRobot;
use Ailuoy\NeteaseIm\Models\ChatRoom\RequestAddr;
use Ailuoy\NeteaseIm\Models\ChatRoom\SendMsg;
use Ailuoy\NeteaseIm\Models\ChatRoom\SetMemberRole;
use Ailuoy\NeteaseIm\Models\ChatRoom\TemporaryMute;
use Ailuoy\NeteaseIm\Models\ChatRoom\ToggleCloseStat;
use Ailuoy\NeteaseIm\Models\ChatRoom\TopN;
use Ailuoy\NeteaseIm\Models\ChatRoom\Update;
use Ailuoy\NeteaseIm\Models\ChatRoom\UpdateMyRoomRole;
use Ailuoy\NeteaseIm\ResultReturn;
use Ailuoy\NeteaseIm\Exceptions\ResultReturnException;

/**
 * @property Create                   create
 * @property Get                      get
 * @property GetBatch                 getBatch
 * @property Update                   update
 * @property ToggleCloseStat          toggleCloseStat
 * @property SetMemberRole            setMemberRole
 * @property RequestAddr              requestAddr
 * @property SendMsg                  sendMsg
 * @property AddRobot                 addRobot
 * @property RemoveRobot              removeRobot
 * @property TemporaryMute            temporaryMute
 * @property QueueOffer               queueOffer
 * @property QueuePoll                queuePoll
 * @property QueueList                queueList
 * @property QueueDrop                queueDrop
 * @property QueueInit                queueInit
 * @property MuteRoom                 muteRoom
 * @property TopN                     topN
 * @property MembersByPage            membersByPage
 * @property QueryMembers             queryMembers
 * @property UpdateMyRoomRole         updateMyRoomRole
 * @property QueueBatchUpdateElements queueBatchUpdateElements
 * @property QueryUserRoomIds         queryUserRoomIds
 *
 *
 * Class ModuleFactory
 * @package Ailuoy\NeteaseIm\Factory
 */
class ChatRoomModelFactory
{
    /**
     * 模型列表
     *
     * @return \Ailuoy\NeteaseIm\ResultReturnStructure
     */
    private function modelList()
    {
        $modelList = [
            'create'                   => Create::class,
            'get'                      => Get::class,
            'getBatch'                 => GetBatch::class,
            'update'                   => Update::class,
            'toggleCloseStat'          => ToggleCloseStat::class,
            'setMemberRole'            => SetMemberRole::class,
            'requestAddr'              => RequestAddr::class,
            'sendMsg'                  => SendMsg::class,
            'addRobot'                 => AddRobot::class,
            'removeRobot'              => RemoveRobot::class,
            'temporaryMute'            => TemporaryMute::class,
            'queueOffer'               => QueueOffer::class,
            'queuePoll'                => QueuePoll::class,
            'queueList'                => QueueList::class,
            'queueDrop'                => QueueDrop::class,
            'queueInit'                => QueueInit::class,
            'muteRoom'                 => MuteRoom::class,
            'topN'                     => TopN::class,
            'membersByPage'            => MembersByPage::class,
            'queryMembers'             => QueryMembers::class,
            'updateMyRoomRole'         => UpdateMyRoomRole::class,
            'queueBatchUpdateElements' => QueueBatchUpdateElements::class,
            'queryUserRoomIds'         => QueryUserRoomIds::class,
        ];

        return ResultReturn::success($modelList);
    }


    private function __clone()
    {
    }

    private function __wakeup()
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