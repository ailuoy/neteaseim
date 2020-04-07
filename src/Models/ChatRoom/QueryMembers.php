<?php
/**
 * Created by PhpStorm.
 * User: ailuoy
 * Date: 2019/5/18
 * Time: 下午10:44
 */

namespace Ailuoy\NeteaseIm\Models\ChatRoom;


use Ailuoy\NeteaseIm\Models\Model;
use Ailuoy\NeteaseIm\Translate;

class QueryMembers extends Model
{
    /**
     * 批量获取在线成员信息
     *
     * @param int   $roomId
     * @param array $accIds
     *
     * @return mixed
     * @throws \Ailuoy\NeteaseIm\Exceptions\ParameterErrorException
     * @throws \Ailuoy\NeteaseIm\Exceptions\RequestErrorException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E8%81%8A%E5%A4%A9%E5%AE%A4?#%E6%89%B9%E9%87%8F%E8%8E%B7%E5%8F%96%E5%9C%A8%E7%BA%BF%E6%88%90%E5%91%98%E4%BF%A1%E6%81%AF
     */
    public function go(int $roomId, array $accIds)
    {
        $parameters = [
            'roomid' => $roomId,
            'accids' => json_encode($accIds)
        ];

        $this->validation($this->rules(), $this->messages(), $parameters);

        return $this->sendRequest('POST', 'nimserver/chatroom/queryMembers.action', $parameters);
    }

    /**
     * @return array
     */
    private function rules()
    {
        return [
            'roomid' => 'required|integer',
            'accids' => 'required|json',
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
            'accids.required' => '账号列表 : ' . Translate::VALIDATE_REQUIRED,
            'accids.json'     => '账号列表 : ' . Translate::VALIDATE_JSON,
        ];
    }
}