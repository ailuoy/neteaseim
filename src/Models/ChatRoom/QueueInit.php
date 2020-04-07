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

class QueueInit extends Model
{
    /**
     * 初始化队列
     *
     * @param int $roomId
     * @param int $sizeLimit
     *
     * @return mixed
     * @throws \Ailuoy\NeteaseIm\Exceptions\ParameterErrorException
     * @throws \Ailuoy\NeteaseIm\Exceptions\RequestErrorException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E8%81%8A%E5%A4%A9%E5%AE%A4?#%E5%88%9D%E5%A7%8B%E5%8C%96%E9%98%9F%E5%88%97
     */
    public function go(int $roomId, int $sizeLimit)
    {
        $parameters = ['roomid' => $roomId, 'sizeLimit' => $sizeLimit];
        $this->validation($this->rules(), $this->messages(), $parameters);

        return $this->sendRequest('POST', 'nimserver/chatroom/queueInit.action', $parameters);
    }


    /**
     * @return array
     */
    private function rules()
    {
        return [
            'roomid'    => 'required|integer',
            'sizeLimit' => 'required|integer|max:1000',
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
            'sizeLimit.required' => '队列长度限制 : ' . Translate::VALIDATE_REQUIRED,
            'sizeLimit.integer'  => '队列长度限制 : ' . Translate::VALIDATE_INT,
            'sizeLimit.max'      => '队列长度限制 : 队列最大长度是1000',
        ];
    }
}