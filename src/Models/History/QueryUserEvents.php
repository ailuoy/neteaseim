<?php
/**
 * Created by PhpStorm.
 * User: ailuoy
 * Date: 2019/5/19
 * Time: 上午11:30
 */

namespace Ailuoy\NeteaseIm\Models\History;


use Ailuoy\NeteaseIm\Models\Model;
use Ailuoy\NeteaseIm\Translate;
use Illuminate\Validation\Rule;

class QueryUserEvents extends Model
{
    /**
     * 用户登录登出事件记录查询
     *
     * @param string $accId
     * @param string $beginTime
     * @param string $endTime
     * @param int    $limit
     *
     * @return mixed
     * @throws \Ailuoy\NeteaseIm\Exceptions\ParameterErrorException
     * @throws \Ailuoy\NeteaseIm\Exceptions\RequestErrorException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E5%8E%86%E5%8F%B2%E8%AE%B0%E5%BD%95?#%E7%94%A8%E6%88%B7%E7%99%BB%E5%BD%95%E7%99%BB%E5%87%BA%E4%BA%8B%E4%BB%B6%E8%AE%B0%E5%BD%95%E6%9F%A5%E8%AF%A2
     */
    public function go(string $accId, string $beginTime, string $endTime, int $limit)
    {
        $parameters = $this->mergeArgs([
            'accid'     => $accId,
            'begintime' => $beginTime,
            'endtime'   => $endTime,
            'limit'     => $limit,
        ]);
        $this->validation($this->rules(), $this->messages(), $parameters);

        return $this->sendRequest('POST', 'nimserver/history/queryUserEvents.action', $parameters);
    }

    /**
     * 1按时间正序排列，2按时间降序排列。其它返回参数414错误.默认是按降序排列
     *
     * @param int $reverse
     *
     * @return $this
     */
    public function setReverse(int $reverse)
    {
        $this->args['reverse'] = $reverse;

        return $this;
    }

    /**
     * @return array
     */
    private function rules()
    {
        return [
            'accid'     => 'required|string',
            'begintime' => 'required|string',
            'endtime'   => 'required|string',
            'limit'     => 'required|integer|max:100',
            'reverse'   => [
                'sometimes',
                'integer',
                Rule::in([1, 2])
            ]
        ];
    }

    /**
     * @return array
     */
    private function messages()
    {
        return [
            'accid.required'     => '要查询用户的accid : ' . Translate::VALIDATE_REQUIRED,
            'accid.string'       => '要查询用户的accid : ' . Translate::VALIDATE_STRING,
            'begintime.required' => '开始时间 : ' . Translate::VALIDATE_REQUIRED,
            'begintime.string'   => '开始时间 : ' . Translate::VALIDATE_STRING,
            'endtime.required'   => '截止时间 : ' . Translate::VALIDATE_REQUIRED,
            'endtime.string'     => '截止时间 : ' . Translate::VALIDATE_STRING,
            'limit.required'     => '本次查询的消息条数 : ' . Translate::VALIDATE_REQUIRED,
            'limit.integer'      => '本次查询的消息条数 : ' . Translate::VALIDATE_INT,
            'limit.max'          => '本次查询的消息条数 : 值最大是100',
            'reverse.integer'    => '按照时间排序 : ' . Translate::VALIDATE_INT,
            'reverse.in'         => '按照时间排序 : 值必须是 1 | 2'
        ];
    }
}