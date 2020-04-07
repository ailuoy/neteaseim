<?php
/**
 * Created by PhpStorm.
 * User: ailuoy
 * Date: 2019/5/18
 * Time: 下午10:48
 */

namespace Ailuoy\NeteaseIm\Models\ChatRoom;


use Ailuoy\NeteaseIm\Models\Model;
use Ailuoy\NeteaseIm\Translate;
use Illuminate\Validation\Rule;

class UpdateMyRoomRole extends Model
{
    /**
     * 变更聊天室内的角色信息
     *
     * @param int    $roomId
     * @param string $accId
     *
     * @return mixed
     * @throws \Ailuoy\NeteaseIm\Exceptions\ParameterErrorException
     * @throws \Ailuoy\NeteaseIm\Exceptions\RequestErrorException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E8%81%8A%E5%A4%A9%E5%AE%A4?#%E5%8F%98%E6%9B%B4%E8%81%8A%E5%A4%A9%E5%AE%A4%E5%86%85%E7%9A%84%E8%A7%92%E8%89%B2%E4%BF%A1%E6%81%AF
     */
    public function go(int $roomId, string $accId)
    {
        $parameters = $this->mergeArgs([
            'roomid' => $roomId,
            'accid'  => $accId
        ]);

        $this->validation($this->rules(), $this->messages(), $parameters);

        return $this->sendRequest('POST', 'nimserver/chatroom/updateMyRoomRole.action', $parameters);
    }

    /**
     * 变更的信息是否需要持久化，默认false，仅对聊天室固定成员生效
     *
     * @param bool $save
     *
     * @return $this
     */
    public function setSave(bool $save)
    {
        $this->args['save'] = $save;

        return $this;
    }

    /**
     * 是否需要做通知
     *
     * @param bool $needNotify
     *
     * @return $this
     */
    public function setNeedNotify(bool $needNotify)
    {
        $this->args['needNotify'] = $needNotify;

        return $this;
    }

    /**
     * 通知事件扩展字段，长度限制2048
     *
     * @param string $notifyExt
     *
     * @return $this
     */
    public function setNotifyExt(string $notifyExt)
    {
        $this->args['notifyExt'] = $notifyExt;

        return $this;
    }

    /**
     * 聊天室室内的角色信息：昵称，不超过64个字符
     *
     * @param string $nick
     *
     * @return $this
     */
    public function setNick(string $nick)
    {
        $this->args['nick'] = $nick;

        return $this;
    }

    /**
     * 聊天室室内的角色信息：头像
     *
     * @param string $avator
     *
     * @return $this
     */
    public function setAvator(string $avator)
    {
        $this->args['avator'] = $avator;

        return $this;
    }

    /**
     * 聊天室室内的角色信息：开发者扩展字段
     *
     * @param string $ex
     *
     * @return $this
     */
    public function setEx(string $ex)
    {
        $this->args['ex'] = $ex;

        return $this;
    }

    /**
     * @return array
     */
    private function rules()
    {
        return [
            'roomid'     => 'required|integer',
            'accid'      => 'required|string',
            'save'       => [
                'sometimes',
                'boolean',
                Rule::in([true, false])
            ],
            'needNotify' => [
                'sometimes',
                'boolean',
                Rule::in([true, false])
            ],
            'notifyExt'  => 'sometimes|string|max:2048',
            'nick'       => 'sometimes|string|max:64',
            'avator'     => 'sometimes|string',
            'ext'        => 'sometimes|string'
        ];
    }

    /**
     * @return array
     */
    private function messages()
    {
        return [
            'roomid.required'    => Translate::FIELD_CHATROOM_ROOM_ID . Translate::VALIDATE_REQUIRED,
            'roomid.integer'     => Translate::FIELD_CHATROOM_ROOM_ID . Translate::VALIDATE_INT,
            'accid.required'     => '需要变更角色信息的accid : ' . Translate::VALIDATE_REQUIRED,
            'accid.string'       => '需要变更角色信息的accid : ' . Translate::VALIDATE_STRING,
            'save.boolean'       => '变更的信息是否需要持久化 : ' . Translate::VALIDATE_BOOLEAN,
            'save.in'            => '变更的信息是否需要持久化 : 值只能是布尔型的 true | false',
            'needNotify.boolean' => '是否需要做通知 : ' . Translate::VALIDATE_BOOLEAN,
            'needNotify.in'      => '是否需要做通知 : 值只能是布尔型的 true | false',
            'notifyExt.string'   => '通知事件扩展字段 : ' . Translate::VALIDATE_STRING,
            'notifyExt.max'      => '通知事件扩展字段 : ' . Translate::VALIDATE_MAX_2048,
            'nick.string'        => '角色昵称 : ' . Translate::VALIDATE_STRING,
            'nick.max'           => '角色昵称 : 值最大64个字符',
            'avator.string'      => '角色头像 : ' . Translate::VALIDATE_STRING,
            'ext.string'         => '开发者扩展字段 : ' . Translate::VALIDATE_STRING
        ];
    }
}