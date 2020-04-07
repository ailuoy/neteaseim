<?php
/**
 * Created by PhpStorm.
 * User: ailuoy
 * Date: 2019/5/8
 * Time: 上午7:49
 */

namespace Ailuoy\NeteaseIm\Models\Friend;


use Ailuoy\NeteaseIm\Models\Model;
use Ailuoy\NeteaseIm\Translate;
use Illuminate\Validation\Rule;

class Add extends Model
{
    /**
     * 加好友
     *
     * @param string $accId
     * @param string $faccId
     * @param int    $type
     *
     * @return mixed
     * @throws \Ailuoy\NeteaseIm\Exceptions\ParameterErrorException
     * @throws \Ailuoy\NeteaseIm\Exceptions\RequestErrorException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E7%94%A8%E6%88%B7%E5%85%B3%E7%B3%BB%E6%89%98%E7%AE%A1?#%E5%8A%A0%E5%A5%BD%E5%8F%8B
     */
    public function go(string $accId, string $faccId, int $type)
    {
        $parameters = $this->mergeArgs(['accid' => $accId, 'faccid' => $faccId, 'type' => $type]);
        $this->validation($this->rules(), $this->messages(), $parameters);

        return $this->sendRequest('POST', 'nimserver/friend/add.action', $parameters);
    }

    /**
     * 加好友对应的请求消息，第三方组装，最长256字符
     *
     * @param string $msg
     *
     * @return $this
     */
    public function setMsg(string $msg)
    {
        $this->args['msg'] = $msg;

        return $this;
    }

    /**
     * 服务器端扩展字段，限制长度256此字段client端只读，server端读写
     *
     * @param string $serverEx
     *
     * @return $this
     */
    public function setServerEx(string $serverEx)
    {
        $this->args['serverex'] = $serverEx;

        return $this;
    }

    /**
     * @return array
     */
    private function rules(): array
    {
        return [
            'accid'    => 'required|string|max:32',
            'faccid'   => 'required|string|max:32',
            'type'     => [
                'required',
                'integer',
                Rule::in([1, 2, 3, 4])
            ],
            'msg'      => 'sometimes|string|max:256',
            'serverex' => 'sometimes|string|max:256',
        ];
    }

    /**
     * @return array
     */
    private function messages(): array
    {
        return [
            'accid.required'  => '加好友发起者accid : ' . Translate::VALIDATE_REQUIRED,
            'accid.string'    => '加好友发起者accid : ' . Translate::VALIDATE_STRING,
            'accid.max'       => '加好友发起者accid : ' . Translate::VALIDATE_MAX_32,
            'faccid.required' => '加好友接收者accid : ' . Translate::VALIDATE_REQUIRED,
            'faccid.string'   => '加好友接收者accid : ' . Translate::VALIDATE_STRING,
            'faccid.max'      => '加好友接收者accid : ' . Translate::VALIDATE_MAX_32,
            'type.required'   => '加好友类型 : ' . Translate::VALIDATE_REQUIRED,
            'type.integer'    => '加好友类型 : ' . Translate::VALIDATE_INT,
            'type.integer'    => '加好友类型 : ' . '值必须是 1|2|3|4',
            'msg.string'      => '加好友对应的请求消息 : ' . Translate::VALIDATE_STRING,
            'msg.max'         => '加好友对应的请求消息 : ' . Translate::VALIDATE_MAX_256,
            'serverex.string' => '服务器端扩展字段 : ' . Translate::VALIDATE_STRING,
            'serverex.max'    => '服务器端扩展字段 : ' . Translate::VALIDATE_MAX_256,
        ];
    }
}