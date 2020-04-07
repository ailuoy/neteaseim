<?php
/**
 * Created by PhpStorm.
 * User: ailuoy
 * Date: 2019/5/12
 * Time: 下午10:27
 */

namespace Ailuoy\NeteaseIm\Models\ChatRoom;


use Ailuoy\NeteaseIm\Models\Model;
use Ailuoy\NeteaseIm\Translate;
use Illuminate\Validation\Rule;

class Update extends Model
{
    /**
     * 更新聊天室信息
     *
     * @param string $roomId
     *
     * @return mixed
     * @throws \Ailuoy\NeteaseIm\Exceptions\ParameterErrorException
     * @throws \Ailuoy\NeteaseIm\Exceptions\RequestErrorException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E8%81%8A%E5%A4%A9%E5%AE%A4?#%E6%9B%B4%E6%96%B0%E8%81%8A%E5%A4%A9%E5%AE%A4%E4%BF%A1%E6%81%AF
     */
    public function go(string $roomId)
    {
        $parameters = $this->mergeArgs(['roomid' => $roomId]);
        $this->validation($this->rules(), $this->messages(), $parameters);

        return $this->sendRequest('POST', 'nimserver/chatroom/update.action', $parameters);
    }

    /**
     * 聊天室名称，长度限制128个字符
     *
     * @param string $name
     *
     * @return $this
     */
    public function setName(string $name)
    {
        $this->args['name'] = $name;

        return $this;
    }

    /**
     * 公告，长度限制4096个字符
     *
     * @param string $announcement
     *
     * @return $this
     */
    public function setAnnouncement(string $announcement)
    {
        $this->args['announcement'] = $announcement;

        return $this;
    }

    /**
     * 直播地址，长度限制1024个字符
     *
     * @param string $broadcastUrl
     *
     * @return $this
     */
    public function setBroadcastUrl(string $broadcastUrl)
    {
        $this->args['broadcasturl'] = $broadcastUrl;

        return $this;
    }

    /**
     * 扩展字段，最长4096字符
     *
     * @param string $ext
     *
     * @return $this
     */
    public function setExt(string $ext)
    {
        $this->args['ext'] = $ext;

        return $this;
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
     * 队列管理权限：0:所有人都有权限变更队列，1:只有主播管理员才能操作变更。默认0
     *
     * @param int $queueLevel
     *
     * @return $this
     */
    public function setQueueLevel(int $queueLevel)
    {
        $this->args['queuelevel'] = $queueLevel;

        return $this;
    }

    /**
     * @return array
     */
    private function rules()
    {
        return [
            'roomid'       => 'required|integer',
            'name'         => 'sometimes|string|max:128',
            'announcement' => 'sometimes|string|max:4096',
            'broadcasturl' => 'sometimes|string|max:1024',
            'ext'          => 'sometimes|string|max:4096',
            'needNotify'   => [
                'sometimes',
                'string',
                Rule::in(['true', 'false'])
            ],
            'notifyExt'    => 'sometimes|string|max:2048',
            'queuelevel'   => [
                'sometimes',
                'integer',
                Rule::in([0, 1])
            ],
        ];
    }

    /**
     * @return array
     */
    private function messages()
    {
        return [
            'roomid.required'     => Translate::FIELD_CHATROOM_ROOM_ID . Translate::VALIDATE_REQUIRED,
            'roomid.string'       => Translate::FIELD_CHATROOM_ROOM_ID . Translate::VALIDATE_STRING,
            'name.required'       => '聊天室名称 : ' . Translate::VALIDATE_REQUIRED,
            'name.string'         => '聊天室名称 : ' . Translate::VALIDATE_STRING,
            'name.max'            => '聊天室名称 : ' . Translate::VALIDATE_MAX_128,
            'announcement.string' => '公告 : ' . Translate::VALIDATE_STRING,
            'announcement.max'    => '公告 : ' . Translate::VALIDATE_MAX_4096,
            'broadcasturl.string' => '直播地址 : ' . Translate::VALIDATE_STRING,
            'broadcasturl.max'    => '直播地址 : ' . Translate::VALIDATE_MAX_1024,
            'ext.string'          => '扩展字段 : ' . Translate::VALIDATE_STRING,
            'ext.max'             => '扩展字段 : ' . Translate::VALIDATE_MAX_4096,
            'needNotify.string'   => '是否需要发送更新通知事件 : ' . Translate::VALIDATE_STRING,
            'needNotify.in'       => '是否需要发送更新通知事件 : 值只能是字符串的 true | false',
            'notifyExt.string'    => '通知事件扩展字段 : ' . Translate::VALIDATE_STRING,
            'notifyExt.max'       => '通知事件扩展字段 : ' . Translate::VALIDATE_MAX_2048,
            'queuelevel.integer'  => '队列管理权限 : ' . Translate::VALIDATE_INT,
            'queuelevel.in'       => '队列管理权限 : 值只能是 0 | 1'
        ];
    }
}