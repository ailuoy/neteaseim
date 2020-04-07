<?php
/**
 * Created by PhpStorm.
 * User: ailuoy
 * Date: 2019/5/19
 * Time: 下午1:30
 */

namespace Ailuoy\NeteaseIm\Models\Subscribe;


use Ailuoy\NeteaseIm\Models\Model;
use Ailuoy\NeteaseIm\Translate;
use Illuminate\Validation\Rule;

class Add extends Model
{
    /**
     * 订阅在线状态事件
     *
     * @param string $accId
     * @param int    $eventType
     * @param array  $publisherAccIds
     * @param int    $ttl
     *
     * @return mixed
     * @throws \Ailuoy\NeteaseIm\Exceptions\ParameterErrorException
     * @throws \Ailuoy\NeteaseIm\Exceptions\RequestErrorException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E5%9C%A8%E7%BA%BF%E7%8A%B6%E6%80%81?#%E8%AE%A2%E9%98%85%E5%9C%A8%E7%BA%BF%E7%8A%B6%E6%80%81%E4%BA%8B%E4%BB%B6
     */
    public function go(string $accId, int $eventType, array $publisherAccIds, int $ttl)
    {
        $parameters = [
            'accid'           => $accId,
            'eventType'       => $eventType,
            'publisherAccids' => json_encode($publisherAccIds),
            'ttl'             => $ttl
        ];
        $this->validation($this->rules(), $this->messages(), $parameters);

        return $this->sendRequest('POST', 'nimserver/event/subscribe/add.action', $parameters);
    }

    /**
     * @return array
     */
    private function rules()
    {
        return [
            'accid'           => 'required|string',
            'eventType'       => [
                'required',
                'integer',
                Rule::in([1])
            ],
            'publisherAccids' => 'required|json',
            'ttl'             => 'required|integer|min:60|max:2592000'
        ];
    }

    /**
     * @return array
     */
    private function messages()
    {
        return [
            'accid.required'           => '事件订阅人账号 : ' . Translate::VALIDATE_REQUIRED,
            'accid.string'             => '事件订阅人账号 : ' . Translate::VALIDATE_STRING,
            'eventType.required'       => '事件类型 : ' . Translate::VALIDATE_REQUIRED,
            'eventType.integer'        => '事件类型 : ' . Translate::VALIDATE_INT,
            'eventType.in'             => '事件类型 : 值只能 1',
            'publisherAccids.required' => '被订阅人的账号列表 : ' . Translate::VALIDATE_REQUIRED,
            'publisherAccids.json'     => '被订阅人的账号列表 : ' . Translate::VALIDATE_JSON,
            'ttl.required'             => '有效期 : ' . Translate::VALIDATE_REQUIRED,
            'ttl.integer'              => '有效期 : ' . Translate::VALIDATE_INT,
            'ttl.min'                  => '有效期 : 值最小是60',
            'ttl.max'                  => '有效期 : 值最大是2592000',
        ];
    }
}