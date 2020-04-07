<?php
/**
 * Created by PhpStorm.
 * User: ailuoy
 * Date: 2019/5/19
 * Time: 上午10:33
 */

namespace Ailuoy\NeteaseIm\Models\History;


use Ailuoy\NeteaseIm\Models\Model;
use Ailuoy\NeteaseIm\Translate;
use Illuminate\Validation\Rule;

class QuerySessionMsg extends Model
{
    /**
     * 单聊云端历史消息查询
     *
     * @param string $from
     * @param string $to
     * @param string $beginTime
     * @param string $endTime
     * @param int    $limit
     *
     * @return mixed
     * @throws \Ailuoy\NeteaseIm\Exceptions\ParameterErrorException
     * @throws \Ailuoy\NeteaseIm\Exceptions\RequestErrorException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E5%8E%86%E5%8F%B2%E8%AE%B0%E5%BD%95?#%E5%8D%95%E8%81%8A%E4%BA%91%E7%AB%AF%E5%8E%86%E5%8F%B2%E6%B6%88%E6%81%AF%E6%9F%A5%E8%AF%A2
     */
    public function go(string $from, string $to, string $beginTime, string $endTime, int $limit)
    {
        $parameters = $this->mergeArgs([
            'from'      => $from,
            'to'        => $to,
            'begintime' => $beginTime,
            'endtime'   => $endTime,
            'limit'     => $limit,
        ]);
        $this->validation($this->rules(), $this->messages(), $parameters);

        return $this->sendRequest('POST', 'nimserver/history/querySessionMsg.action', $parameters);
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
     * 查询指定的多个消息类型，类型之间用","分割，不设置该参数则查询全部类型消息格式示例： 0,1,2,3
     * 类型支持： 1:图片，2:语音，3:视频，4:地理位置，5:通知，6:文件，10:提示，11:Robot，100:自定义
     *
     * @param string $type
     *
     * @return $this
     */
    public function setType(string $type)
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
            'from'      => 'required|string',
            'to'        => 'required|string',
            'begintime' => 'required|string',
            'endtime'   => 'required|string',
            'limit'     => 'required|integer|max:100',
            'reverse'   => [
                'sometimes',
                'integer',
                Rule::in([1, 2])
            ],
            'type'      => 'sometimes|string'
        ];
    }

    /**
     * @return array
     */
    private function messages()
    {
        return [
            'from.required'      => '发送者accid : ' . Translate::VALIDATE_REQUIRED,
            'from.string'        => '发送者accid : ' . Translate::VALIDATE_STRING,
            'to.required'        => '接收者accid : ' . Translate::VALIDATE_REQUIRED,
            'to.string'          => '接收者accid : ' . Translate::VALIDATE_STRING,
            'begintime.required' => '开始时间 : ' . Translate::VALIDATE_REQUIRED,
            'begintime.string'   => '开始时间 : ' . Translate::VALIDATE_STRING,
            'endtime.required'   => '截止时间 : ' . Translate::VALIDATE_REQUIRED,
            'endtime.string'     => '截止时间 : ' . Translate::VALIDATE_STRING,
            'limit.required'     => '本次查询的消息条数 : ' . Translate::VALIDATE_REQUIRED,
            'limit.integer'      => '本次查询的消息条数 : ' . Translate::VALIDATE_INT,
            'limit.max'          => '本次查询的消息条数 : 值最大是100',
            'reverse.integer'    => '按照时间排序 : ' . Translate::VALIDATE_INT,
            'reverse.in'         => '按照时间排序 : 值必须是 1 | 2',
            'type.string'        => '查询指定的多个消息类型 : ' . Translate::VALIDATE_STRING
        ];
    }
}