<?php
/**
 * Created by PhpStorm.
 * User: ailuoy
 * Date: 2019/5/12
 * Time: 下午9:50
 */

namespace Ailuoy\NeteaseIm\Models\ChatRoom;


use Ailuoy\NeteaseIm\Models\Model;
use Ailuoy\NeteaseIm\Translate;
use Illuminate\Validation\Rule;

class GetBatch extends Model
{
    /**
     * 批量查询聊天室信息
     *
     * @param array $roomIds
     *
     * @return mixed
     * https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E8%81%8A%E5%A4%A9%E5%AE%A4?#%E6%89%B9%E9%87%8F%E6%9F%A5%E8%AF%A2%E8%81%8A%E5%A4%A9%E5%AE%A4%E4%BF%A1%E6%81%AF
     */
    public function go(array $roomIds)
    {
        $parameters = $this->mergeArgs(['roomids' => json_encode($roomIds)]);
        $this->validation($this->rules(), $this->messages(), $parameters);

        return $this->sendRequest('POST', 'nimserver/chatroom/getBatch.action', $parameters);
    }

    /**
     * 是否需要返回在线人数，true或false，默认false
     *
     * @param bool $needOnlineUserCount
     *
     * @return $this
     */
    public function setNeedOnlineUserCount(bool $needOnlineUserCount)
    {
        $this->args['needOnlineUserCount'] = $needOnlineUserCount ? 'true' : 'false';

        return $this;
    }

    /**
     * @return array
     */
    private function rules()
    {
        return [
            'roomids'             => 'required|json|max:200',
            'needOnlineUserCount' => [
                'sometimes',
                'string',
                Rule::in(['true', 'false'])
            ],
        ];
    }

    /**
     * @return array
     */
    private function messages()
    {
        return [
            'roomids.required'           => Translate::FIELD_CHATROOM_ROOM_ID . Translate::VALIDATE_REQUIRED,
            'roomids.json'               => Translate::FIELD_CHATROOM_ROOM_ID . Translate::VALIDATE_JSON,
            'roomids.max'                => Translate::FIELD_CHATROOM_ROOM_ID . '一次最多查询20个',
            'needOnlineUserCount.string' => '是否需要返回在线人数 : ' . Translate::VALIDATE_STRING,
            'needOnlineUserCount.in'     => '是否需要返回在线人数 : 值必须是字符串 true | false'
        ];
    }
}