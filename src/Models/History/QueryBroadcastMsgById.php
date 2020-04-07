<?php
/**
 * Created by PhpStorm.
 * User: ailuoy
 * Date: 2019/5/19
 * Time: 下午1:25
 */

namespace Ailuoy\NeteaseIm\Models\History;


use Ailuoy\NeteaseIm\Models\Model;
use Ailuoy\NeteaseIm\Translate;

class QueryBroadcastMsgById extends Model
{
    /**
     * 查询单条广播消息
     *
     * @param int $broadcastId
     *
     * @return mixed
     * @throws \Ailuoy\NeteaseIm\Exceptions\ParameterErrorException
     * @throws \Ailuoy\NeteaseIm\Exceptions\RequestErrorException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E5%8E%86%E5%8F%B2%E8%AE%B0%E5%BD%95?#%E6%9F%A5%E8%AF%A2%E5%8D%95%E6%9D%A1%E5%B9%BF%E6%92%AD%E6%B6%88%E6%81%AF
     */
    public function go(int $broadcastId)
    {
        $parameters = ['broadcastId' => $broadcastId];
        $this->validation($this->rules(), $this->messages(), $parameters);

        return $this->sendRequest('POST', 'nimserver/history/queryBroadcastMsgById.action', $parameters);
    }

    /**
     * @return array
     */
    private function rules()
    {
        return [
            'broadcastId' => 'required|integer'
        ];
    }

    /**
     * @return array
     */
    private function messages()
    {
        return [
            'broadcastId.required' => '广播消息ID : ' . Translate::VALIDATE_REQUIRED,
            'broadcastId.integer'  => '广播消息ID : ' . Translate::VALIDATE_INT,
        ];
    }
}