<?php
/**
 * Created by PhpStorm.
 * User: ailuoy
 * Date: 2019/5/18
 * Time: 下午7:21
 */

namespace Ailuoy\NeteaseIm\Models\ChatRoom;


use Ailuoy\NeteaseIm\Models\Model;
use Ailuoy\NeteaseIm\Translate;
use Illuminate\Validation\Rule;

class MuteRoom extends Model
{
    /**
     * 将聊天室整体禁言
     *
     * @param int    $roomId
     * @param string $operator
     * @param bool   $mute
     *
     * @return mixed
     * @throws \Ailuoy\NeteaseIm\Exceptions\ParameterErrorException
     * @throws \Ailuoy\NeteaseIm\Exceptions\RequestErrorException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E8%81%8A%E5%A4%A9%E5%AE%A4?#%E5%B0%86%E8%81%8A%E5%A4%A9%E5%AE%A4%E6%95%B4%E4%BD%93%E7%A6%81%E8%A8%80
     */
    public function go(int $roomId, string $operator, bool $mute)
    {
        $parameters = $this->mergeArgs([
            'roomid'   => $roomId,
            'operator' => $operator,
            'mute'     => $mute ? 'true' : 'false'
        ]);
        $this->validation($this->rules(), $this->messages(), $parameters);

        return $this->sendRequest('POST', 'nimserver/chatroom/muteRoom.action', $parameters);
    }

    /**
     * true或false,是否需要发送更新通知事件，默认true
     *
     * @param bool $needNotify
     *
     * @return $this
     */
    public function setNeedNotify(bool $needNotify)
    {
        $this->args['needNotify'] = $needNotify ? 'true' : 'false';

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
     * @return array
     */
    private function rules()
    {
        return [
            'roomid'     => 'required|integer',
            'operator'   => 'required|string',
            'mute'       => [
                'required',
                'string',
                Rule::in(['true', 'false'])
            ],
            'needNotify' => [
                'sometimes',
                'string',
                Rule::in(['true', 'false'])
            ],
            'notifyExt'  => 'sometimes|string',
        ];
    }

    /**
     * @return array
     */
    private function messages()
    {
        return [
            'roomid.required'   => Translate::FIELD_CHATROOM_ROOM_ID . Translate::VALIDATE_REQUIRED,
            'roomid.integer'    => Translate::FIELD_CHATROOM_ROOM_ID . Translate::VALIDATE_INT,
            'operator.required' => '操作者accid,必须是管理员或创建者 : ' . Translate::VALIDATE_REQUIRED,
            'operator.string'   => '操作者accid,必须是管理员或创建者 : ' . Translate::VALIDATE_STRING,
            'mute.string'       => '是否禁言 : ' . Translate::VALIDATE_STRING,
            'mute.in'           => '是否禁言 : 值只能是字符串的 true | false',
            'needNotify.string' => '是否需要发送更新通知事件 : ' . Translate::VALIDATE_STRING,
            'needNotify.in'     => '是否需要发送更新通知事件 : 值只能是字符串的 true | false',
            'notifyExt.string'  => '通知事件扩展字段 : ' . Translate::VALIDATE_STRING
        ];
    }
}