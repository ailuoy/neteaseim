<?php
/**
 * Created by PhpStorm.
 * User: ailuoy
 * Date: 2019/5/8
 * Time: 上午7:49
 */

namespace Ailuoy\NeteaseIm\Models\Friend;

use Ailuoy\NeteaseIm\Translate;
use Ailuoy\NeteaseIm\Models\Model;

class Get extends Model
{
    /**
     * 获取好友关系
     *
     * @param string $accId
     * @param int    $updateTime
     *
     * @return mixed
     * @throws \Ailuoy\NeteaseIm\Exceptions\ParameterErrorException
     * @throws \Ailuoy\NeteaseIm\Exceptions\RequestErrorException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E7%94%A8%E6%88%B7%E5%85%B3%E7%B3%BB%E6%89%98%E7%AE%A1?#%E8%8E%B7%E5%8F%96%E5%A5%BD%E5%8F%8B%E5%85%B3%E7%B3%BB
     */
    public function go(string $accId, int $updateTime)
    {
        $parameters = $this->mergeArgs(['accid' => $accId, 'updatetime' => $updateTime]);
        $this->validation($this->rules(), $this->messages(), $parameters);

        return $this->sendRequest('POST', 'nimserver/friend/get.action', $parameters);
    }

    /**
     *【Deprecated】定义同updatetime
     *
     * @param int $createTime
     *
     * @return $this
     */
    public function setCreateTime(int $createTime)
    {
        $this->args['createtime'] = $createTime;

        return $this;
    }

    /**
     * @return array
     */
    private function rules(): array
    {
        return [
            'accid'      => 'required|string|max:32',
            'updatetime' => 'required|integer',
            'createtime' => 'sometimes|integer'
        ];
    }

    /**
     * @return array
     */
    private function messages(): array
    {
        return [
            'accid.required'      => '发起者accid : ' . Translate::VALIDATE_REQUIRED,
            'accid.string'        => '发起者accid : ' . Translate::VALIDATE_STRING,
            'accid.max'           => '发起者accid : ' . Translate::VALIDATE_MAX_32,
            'updatetime.required' => '更新时间戳 : ' . Translate::VALIDATE_REQUIRED,
            'updatetime.integer'  => '更新时间戳 : ' . Translate::VALIDATE_INT,
            'createtime.integer'  => 'createtime : ' . Translate::VALIDATE_INT
        ];
    }
}