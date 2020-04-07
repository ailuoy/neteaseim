<?php
/**
 * Created by PhpStorm.
 * User: ailuoy
 * Date: 2019/5/6
 * Time: 下午4:53
 */

namespace Ailuoy\NeteaseIm\Factory;

use Ailuoy\NeteaseIm\Models\Team\Add;
use Ailuoy\NeteaseIm\Models\Team\AddManager;
use Ailuoy\NeteaseIm\Models\Team\ChangeOwner;
use Ailuoy\NeteaseIm\Models\Team\GetMarkReadInfo;
use Ailuoy\NeteaseIm\Models\Team\JoinTeams;
use Ailuoy\NeteaseIm\Models\Team\Kick;
use Ailuoy\NeteaseIm\Models\Team\Leave;
use Ailuoy\NeteaseIm\Models\Team\ListTeamMute;
use Ailuoy\NeteaseIm\Models\Team\MuteTeam;
use Ailuoy\NeteaseIm\Models\Team\MuteTList;
use Ailuoy\NeteaseIm\Models\Team\MuteTListAll;
use Ailuoy\NeteaseIm\Models\Team\Query;
use Ailuoy\NeteaseIm\Models\Team\QueryDetail;
use Ailuoy\NeteaseIm\Models\Team\Remove;
use Ailuoy\NeteaseIm\Models\Team\RemoveManager;
use Ailuoy\NeteaseIm\Models\Team\Update;
use Ailuoy\NeteaseIm\Models\Team\UpdateTeamNick;
use Ailuoy\NeteaseIm\ResultReturn;
use Ailuoy\NeteaseIm\Models\Team\Create;
use Ailuoy\NeteaseIm\Exceptions\ResultReturnException;

/**
 * @property Create          create
 * @property Add             add
 * @property Kick            kick
 * @property Remove          remove
 * @property Update          update
 * @property Query           query
 * @property QueryDetail     queryDetail
 * @property GetMarkReadInfo getMarkReadInfo
 * @property ChangeOwner     changeOwner
 * @property AddManager      addManager
 * @property RemoveManager   removeManager
 * @property JoinTeams       joinTeams
 * @property UpdateTeamNick  updateTeamNick
 * @property MuteTeam        muteTeam
 * @property MuteTList       muteTlist
 * @property Leave           leave
 * @property MuteTListAll    muteTlistAll
 * @property ListTeamMute    listTeamMute
 *
 *
 * Class ModuleFactory
 * @package Ailuoy\NeteaseIm\Factory
 */
class TeamModelFactory
{

    private function modelList()
    {
        $modelList = [
            'create'          => Create::class,
            'add'             => Add::class,
            'kick'            => Kick::class,
            'remove'          => Remove::class,
            'update'          => Update::class,
            'query'           => Query::class,
            'queryDetail'     => QueryDetail::class,
            'getMarkReadInfo' => GetMarkReadInfo::class,
            'changeOwner'     => ChangeOwner::class,
            'addManager'      => AddManager::class,
            'removeManager'   => RemoveManager::class,
            'joinTeams'       => JoinTeams::class,
            'updateTeamNick'  => UpdateTeamNick::class,
            'muteTeam'        => MuteTeam::class,
            'muteTlist'       => MuteTList::class,
            'leave'           => Leave::class,
            'muteTlistAll'    => MuteTListAll::class,
            'listTeamMute'    => ListTeamMute::class,
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