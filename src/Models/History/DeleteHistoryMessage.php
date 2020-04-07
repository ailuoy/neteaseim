<?php
/**
 * Created by PhpStorm.
 * User: ailuoy
 * Date: 2019/5/19
 * Time: 上午11:21
 */

namespace Ailuoy\NeteaseIm\Models\History;


use Ailuoy\NeteaseIm\Models\Model;
use Ailuoy\NeteaseIm\Translate;

class DeleteHistoryMessage extends Model
{
    /**
     * 删除聊天室云端历史消息
     *
     * @param int    $roomId
     * @param string $fromAcc
     * @param int    $msgTimeTag
     *
     * @return mixed
     * @throws \Ailuoy\NeteaseIm\Exceptions\ParameterErrorException
     * @throws \Ailuoy\NeteaseIm\Exceptions\RequestErrorException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E5%8E%86%E5%8F%B2%E8%AE%B0%E5%BD%95?#%E5%88%A0%E9%99%A4%E8%81%8A%E5%A4%A9%E5%AE%A4%E4%BA%91%E7%AB%AF%E5%8E%86%E5%8F%B2%E6%B6%88%E6%81%AF
     */
    public function go(int $roomId, string $fromAcc, int $msgTimeTag)
    {
        $parameters = $this->mergeArgs([
            'roomid'     => $roomId,
            'fromAcc'    => $fromAcc,
            'msgTimetag' => $msgTimeTag
        ]);
        $this->validation($this->rules(), $this->messages(), $parameters);

        return $this->sendRequest('POST', 'nimserver/chatroom/deleteHistoryMessage.action', $parameters);
    }

    /**
     * @return array
     */
    private function rules()
    {
        return [
            'roomid'     => 'required|integer',
            'fromAcc'    => 'required|string',
            'msgTimetag' => 'required|integer',
        ];
    }

    /**
     * @return array
     */
    private function messages()
    {
        return [
            'roomid.required'     => '聊天室id : ' . Translate::VALIDATE_REQUIRED,
            'roomid.integer'      => '聊天室id : ' . Translate::VALIDATE_INT,
            'fromAcc.required'    => '消息发送者的accid : ' . Translate::VALIDATE_REQUIRED,
            'fromAcc.string'      => '消息发送者的accid : ' . Translate::VALIDATE_STRING,
            'msgTimetag.required' => '消息的时间戳 : ' . Translate::VALIDATE_REQUIRED,
            'msgTimetag.integer'  => '消息的时间戳 : ' . Translate::VALIDATE_INT,
        ];
    }
}