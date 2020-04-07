<?php
/**
 * Created by PhpStorm.
 * User: ailuoy
 * Date: 2019/5/6
 * Time: 下午4:53
 */

namespace Ailuoy\NeteaseIm\Factory;

use Ailuoy\NeteaseIm\Models\User\ListBlackAndMuteList;
use Ailuoy\NeteaseIm\Models\User\SetSpecialRelation;
use Ailuoy\NeteaseIm\ResultReturn;
use Ailuoy\NeteaseIm\Models\User\Mute;
use Ailuoy\NeteaseIm\Models\User\Block;
use Ailuoy\NeteaseIm\Models\User\MuteAv;
use Ailuoy\NeteaseIm\Models\User\Create;
use Ailuoy\NeteaseIm\Models\User\UnBlock;
use Ailuoy\NeteaseIm\Models\User\Update;
use Ailuoy\NeteaseIm\Models\User\GetUinfos;
use Ailuoy\NeteaseIm\Models\User\SetDonnop;
use Ailuoy\NeteaseIm\Models\User\UpdateUinfo;
use Ailuoy\NeteaseIm\Models\User\RefreshToken;
use Ailuoy\NeteaseIm\Exceptions\ResultReturnException;

/**
 * @property GetUinfos            getUinfos
 * @property Create               create
 * @property Update               update
 * @property RefreshToken         refreshToken
 * @property Block                block
 * @property UnBlock              unBlock
 * @property UpdateUinfo          updateUinfo
 * @property SetDonnop            setDonnop
 * @property Mute                 mute
 * @property MuteAv               muteAv
 * @property SetSpecialRelation   setSpecialRelation
 * @property ListBlackAndMuteList listBlackAndMuteList
 *
 *
 * Class ModuleFactory
 * @package Ailuoy\NeteaseIm\Factory
 */
class UserModelFactory
{

    private function modelList()
    {
        $modelList = [
            'getUinfos'            => GetUinfos::class,
            'create'               => Create::class,
            'update'               => Update::class,
            'refreshToken'         => RefreshToken::class,
            'block'                => Block::class,
            'unBlock'              => UnBlock::class,
            'updateUinfo'          => UpdateUinfo::class,
            'setDonnop'            => SetDonnop::class,
            'mute'                 => Mute::class,
            'muteAv'               => MuteAv::class,
            'setSpecialRelation'   => SetSpecialRelation::class,
            'listBlackAndMuteList' => ListBlackAndMuteList::class
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