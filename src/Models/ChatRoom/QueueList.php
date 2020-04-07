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

class QueueList extends Model
{

    /**
     * 排序列出队列中所有元素
     *
     * @param int $roomId
     *
     * @return mixed
     * @throws \Ailuoy\NeteaseIm\Exceptions\ParameterErrorException
     * @throws \Ailuoy\NeteaseIm\Exceptions\RequestErrorException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E8%81%8A%E5%A4%A9%E5%AE%A4?#%E6%8E%92%E5%BA%8F%E5%88%97%E5%87%BA%E9%98%9F%E5%88%97%E4%B8%AD%E6%89%80%E6%9C%89%E5%85%83%E7%B4%A0
     */
    public function go(int $roomId)
    {
        $parameters = ['roomid' => $roomId];
        $this->validation($this->rules(), $this->messages(), $parameters);

        return $this->sendRequest('POST', 'nimserver/chatroom/queueList.action', $parameters);
    }


    /**
     * @return array
     */
    private function rules()
    {
        return [
            'roomid' => 'required|integer'
        ];
    }

    /**
     * @return array
     */
    private function messages()
    {
        return [
            'roomid.required' => Translate::FIELD_CHATROOM_ROOM_ID . Translate::VALIDATE_REQUIRED,
            'roomid.integer'  => Translate::FIELD_CHATROOM_ROOM_ID . Translate::VALIDATE_INT
        ];
    }
}