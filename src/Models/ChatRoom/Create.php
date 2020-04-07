<?php
/**
 * Created by PhpStorm.
 * User: ailuoy
 * Date: 2019/5/12
 * Time: 下午9:32
 */

namespace Ailuoy\NeteaseIm\Models\ChatRoom;


use Ailuoy\NeteaseIm\Models\Model;
use Ailuoy\NeteaseIm\Translate;
use Illuminate\Validation\Rule;

class Create extends Model
{
    /**
     * 创建聊天室
     *
     * @param string $creator
     * @param string $name
     *
     * @return mixed
     * https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E8%81%8A%E5%A4%A9%E5%AE%A4?#%E5%88%9B%E5%BB%BA%E8%81%8A%E5%A4%A9%E5%AE%A4
     */
    public function go(string $creator, string $name)
    {
        $parameters = $this->mergeArgs(['creator' => $creator, 'name' => $name]);
        $this->validation($this->rules(), $this->messages(), $parameters);

        return $this->sendRequest('POST', 'nimserver/chatroom/create.action', $parameters);
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
            'creator'      => 'required|string|max:32',
            'name'         => 'required|string|max:128',
            'announcement' => 'sometimes|string|max:4096',
            'broadcasturl' => 'sometimes|string|max:1024',
            'ext'          => 'sometimes|string|max:4096',
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
            'creator.required'    => '聊天室属主的账号accid : ' . Translate::VALIDATE_REQUIRED,
            'creator.string'      => '聊天室属主的账号accid : ' . Translate::VALIDATE_STRING,
            'creator.max'         => '聊天室属主的账号accid : ' . Translate::VALIDATE_MAX_32,
            'name.required'       => '聊天室名称 : ' . Translate::VALIDATE_REQUIRED,
            'name.string'         => '聊天室名称 : ' . Translate::VALIDATE_STRING,
            'name.max'            => '聊天室名称 : ' . Translate::VALIDATE_MAX_128,
            'announcement.string' => '公告 : ' . Translate::VALIDATE_STRING,
            'announcement.max'    => '公告 : ' . Translate::VALIDATE_MAX_4096,
            'broadcasturl.string' => '直播地址 : ' . Translate::VALIDATE_STRING,
            'broadcasturl.max'    => '直播地址 : ' . Translate::VALIDATE_MAX_1024,
            'ext.string'          => '扩展字段 : ' . Translate::VALIDATE_STRING,
            'ext.max'             => '扩展字段 : ' . Translate::VALIDATE_MAX_4096,
            'queuelevel.integer'  => '队列管理权限 : ' . Translate::VALIDATE_INT,
            'queuelevel.in'       => '队列管理权限 : 值只能是 0 | 1'
        ];
    }
}