<?php
/**
 * Created by PhpStorm.
 * User: ailuoy
 * Date: 2019/5/18
 * Time: 下午7:28
 */

namespace Ailuoy\NeteaseIm\Models\ChatRoom;


use Ailuoy\NeteaseIm\Models\Model;
use Ailuoy\NeteaseIm\Translate;
use Illuminate\Validation\Rule;

class TopN extends Model
{
    /**
     * 查询聊天室统计指标TopN
     *
     * @return mixed
     * @throws \Ailuoy\NeteaseIm\Exceptions\ParameterErrorException
     * @throws \Ailuoy\NeteaseIm\Exceptions\RequestErrorException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E8%81%8A%E5%A4%A9%E5%AE%A4?#%E6%9F%A5%E8%AF%A2%E8%81%8A%E5%A4%A9%E5%AE%A4%E7%BB%9F%E8%AE%A1%E6%8C%87%E6%A0%87TopN
     */
    public function go()
    {
        $parameters = [];

        $this->validation($this->rules(), $this->messages(), $parameters);

        return $this->sendRequest('POST', 'nimserver/stats/chatroom/topn.action', $parameters);
    }

    /**
     * topn值，可选值 1~500，默认值100
     *
     * @param int $topN
     *
     * @return $this
     */
    public function setTopN(int $topN)
    {
        $this->args['topn'] = $topN;

        return $this;
    }

    /**
     * 需要查询的指标所在的时间坐标点，不提供则默认当前时间，单位秒/毫秒皆可
     *
     * @param int $timestamp
     *
     * @return $this
     */
    public function setTimestamp(int $timestamp)
    {
        $this->args['timestamp'] = $timestamp;

        return $this;
    }

    /**
     * 统计周期，可选值包括 hour/day, 默认hour
     *
     * @param string $period
     *
     * @return $this
     */
    public function setPeriod(string $period)
    {
        $this->args['period'] = $period;

        return $this;
    }

    /**
     * 取排序值,可选值 active/enter/message,分别表示按日活排序，进入人次排序和消息数排序， 默认active
     *
     * @param string $orderBy
     *
     * @return $this
     */
    public function setOrderBy(string $orderBy)
    {
        $this->args['orderby'] = $orderBy;

        return $this;
    }

    /**
     * @return array
     */
    private function rules()
    {
        return [
            'topn'      => 'sometimes|integer|min:1|max:500',
            'timestamp' => 'sometimes|integer',
            'period'    => [
                'sometimes',
                'string',
                Rule::in(['hour', 'day'])
            ],
            'orderby'   => [
                'sometimes',
                'string',
                Rule::in(['active', 'enter', 'message'])
            ],
        ];
    }

    /**
     * @return array
     */
    private function messages()
    {
        return [
            'topn.integer'      => 'topn值 : ' . Translate::VALIDATE_INT,
            'topn.min'          => 'topn值 : 最小是1',
            'topn.max'          => 'topn值 : 最大值是500',
            'timestamp.integer' => '需要查询的指标所在的时间坐标点，不提供则默认当前时间，单位秒/毫秒皆可 : ' . Translate::VALIDATE_INT,
            'period.string'     => '统计周期 : ' . Translate::VALIDATE_STRING,
            'period.in'         => '统计周期 : 值必须是 hour|day 默认hour',
            'orderby.string'    => '取排序值 : ' . Translate::VALIDATE_STRING,
            'orderby.in'        => '取排序值 : 值必须是 active/enter/message 默认active'
        ];
    }
}