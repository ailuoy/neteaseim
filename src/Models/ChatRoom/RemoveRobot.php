<?php
/**
 * Created by PhpStorm.
 * User: ailuoy
 * Date: 2019/5/16
 * Time: 上午10:05
 */

namespace Ailuoy\NeteaseIm\Models\ChatRoom;


use Ailuoy\NeteaseIm\Models\Model;
use Ailuoy\NeteaseIm\Translate;

class RemoveRobot extends Model
{
    /**
     * 从聊天室内删除机器人
     *
     * @param int   $roomId
     * @param array $accIds
     *
     * @return mixed
     * @throws \Ailuoy\NeteaseIm\Exceptions\ParameterErrorException
     * @throws \Ailuoy\NeteaseIm\Exceptions\RequestErrorException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E8%81%8A%E5%A4%A9%E5%AE%A4?#%E4%BB%8E%E8%81%8A%E5%A4%A9%E5%AE%A4%E5%86%85%E5%88%A0%E9%99%A4%E6%9C%BA%E5%99%A8%E4%BA%BA
     */
    public function go(int $roomId, array $accIds)
    {
        $parameters = $this->mergeArgs([
            'roomid' => $roomId,
            'accids' => json_encode($accIds)
        ]);

        $this->validation($this->rules(), $this->messages(), $parameters);

        return $this->sendRequest('POST', 'nimserver/chatroom/removeRobot.action', $parameters);
    }

    /**
     * @return array
     */
    private function rules()
    {
        return [
            'roomid' => 'required|integer',
            'accids' => 'required|json'
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
            'accids.required' => '机器人账号accid列表 : ' . Translate::VALIDATE_REQUIRED,
            'accids.json'     => '机器人账号accid列表 : ' . Translate::VALIDATE_JSON
        ];
    }
}