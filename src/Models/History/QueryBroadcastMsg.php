<?php
/**
 * Created by PhpStorm.
 * User: ailuoy
 * Date: 2019/5/19
 * Time: 上午11:46
 */

namespace Ailuoy\NeteaseIm\Models\History;


use Ailuoy\NeteaseIm\Models\Model;
use Ailuoy\NeteaseIm\Translate;
use Illuminate\Validation\Rule;

class QueryBroadcastMsg extends Model
{
    /**
     * 批量查询广播消息
     *
     * @return mixed
     * @throws \Ailuoy\NeteaseIm\Exceptions\ParameterErrorException
     * @throws \Ailuoy\NeteaseIm\Exceptions\RequestErrorException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E5%8E%86%E5%8F%B2%E8%AE%B0%E5%BD%95?#%E6%89%B9%E9%87%8F%E6%9F%A5%E8%AF%A2%E5%B9%BF%E6%92%AD%E6%B6%88%E6%81%AF
     */
    public function go()
    {
        $parameters = $this->mergeArgs([]);
        $this->validation($this->rules(), $this->messages(), $parameters);

        return $this->sendRequest('POST', 'nimserver/history/queryBroadcastMsg.action', $parameters);
    }

    /**
     * 查询的起始ID，0表示查询最近的limit条。默认0。
     *
     * @param int $broadcastId
     *
     * @return $this
     */
    public function setBroadcastId(int $broadcastId)
    {
        $this->args['broadcastId'] = $broadcastId;

        return $this;
    }

    /**
     * 查询的条数，最大100。默认100。
     *
     * @param int $limit
     *
     * @return $this
     */
    public function setLimit(int $limit)
    {
        $this->args['limit'] = $limit;

        return $this;
    }

    /**
     * 查询的类型，1表示所有，2表示查询存离线的，3表示查询不存离线的。默认1。
     *
     * @param int $type
     *
     * @return $this
     */
    public function setType(int $type)
    {
        $this->args['type'] = $type;

        return $this;
    }

    /**
     * @return array
     */
    private function rules()
    {
        return [
            'broadcastId' => 'sometimes|integer',
            'limit'       => 'sometimes|integer|max:100',
            'type'        => [
                'sometimes',
                'integer',
                Rule::in([1, 2, 3])
            ],
        ];
    }

    /**
     * @return array
     */
    private function messages()
    {
        return [
            'broadcastId.integer' => '查询的起始ID : ' . Translate::VALIDATE_INT,
            'limit.integer'       => '查询的条数 : ' . Translate::VALIDATE_INT,
            'limit.max'           => '查询的条数 : 值最大 100',
            'type.integer'        => '查询的类型 : ' . Translate::VALIDATE_INT,
            'type.in'             => '查询的类型 : 值必须是 1 | 2 | 3'
        ];
    }
}