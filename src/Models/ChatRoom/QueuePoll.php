<?php
/**
 * Created by PhpStorm.
 * User: ailuoy
 * Date: 2019/5/18
 * Time: 下午6:52
 */

namespace Ailuoy\NeteaseIm\Models\ChatRoom;


use Ailuoy\NeteaseIm\Models\Model;
use Ailuoy\NeteaseIm\Translate;

class QueuePoll extends Model
{

    /**
     * 从队列中取出元素
     *
     * @param int $roomId
     *
     * @return mixed
     * @throws \Ailuoy\NeteaseIm\Exceptions\ParameterErrorException
     * @throws \Ailuoy\NeteaseIm\Exceptions\RequestErrorException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E8%81%8A%E5%A4%A9%E5%AE%A4?#%E4%BB%8E%E9%98%9F%E5%88%97%E4%B8%AD%E5%8F%96%E5%87%BA%E5%85%83%E7%B4%A0
     */
    public function go(int $roomId)
    {
        $parameters = $this->mergeArgs([
            'roomid' => $roomId
        ]);
        $this->validation($this->rules(), $this->messages(), $parameters);

        return $this->sendRequest('POST', 'nimserver/chatroom/queuePoll.action', $parameters);
    }

    /**
     * 目前元素的elementKey,长度限制128字符，不填表示取出头上的第一个
     *
     * @param string $key
     *
     * @return $this
     */
    public function setKey(string $key)
    {
        $this->args['key'] = $key;

        return $this;
    }

    /**
     * @return array
     */
    private function rules()
    {
        return [
            'roomid' => 'required|integer',
            'key'    => 'sometimes|string|max:128'
        ];
    }

    /**
     * @return array
     */
    private function messages()
    {
        return [
            'roomid.required' => Translate::FIELD_CHATROOM_ROOM_ID . Translate::VALIDATE_REQUIRED,
            'roomid.integer'  => Translate::FIELD_CHATROOM_ROOM_ID . Translate::VALIDATE_INT,
            'key.string'      => '新元素的UniqKe : ' . Translate::VALIDATE_STRING,
            'key.max'         => '新元素的UniqKe : ' . Translate::VALIDATE_MAX_128
        ];
    }
}