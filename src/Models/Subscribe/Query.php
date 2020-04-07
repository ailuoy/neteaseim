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

class Query extends Model
{
    /**
     * 查询在线状态事件订阅关系
     *
     * @param string $accId
     * @param int    $eventType
     * @param array  $publisherAccIds
     *
     * @return mixed
     * @throws \Ailuoy\NeteaseIm\Exceptions\ParameterErrorException
     * @throws \Ailuoy\NeteaseIm\Exceptions\RequestErrorException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E5%9C%A8%E7%BA%BF%E7%8A%B6%E6%80%81?#%E6%9F%A5%E8%AF%A2%E5%9C%A8%E7%BA%BF%E7%8A%B6%E6%80%81%E4%BA%8B%E4%BB%B6%E8%AE%A2%E9%98%85%E5%85%B3%E7%B3%BB
     */
    public function go(string $accId, int $eventType, array $publisherAccIds)
    {
        $parameters = [
            'accid'           => $accId,
            'eventType'       => $eventType,
            'publisherAccids' => json_encode($publisherAccIds)
        ];
        $this->validation($this->rules(), $this->messages(), $parameters);

        return $this->sendRequest('POST', 'nimserver/event/subscribe/query.action', $parameters);
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
        ];
    }
}