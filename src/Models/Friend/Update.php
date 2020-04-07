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

class Update extends Model
{

    /**
     * 更新好友相关信息
     *
     * @param string $accId
     * @param string $faccId
     *
     * @return mixed
     * @throws \Ailuoy\NeteaseIm\Exceptions\ParameterErrorException
     * @throws \Ailuoy\NeteaseIm\Exceptions\RequestErrorException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E7%94%A8%E6%88%B7%E5%85%B3%E7%B3%BB%E6%89%98%E7%AE%A1?#%E6%9B%B4%E6%96%B0%E5%A5%BD%E5%8F%8B%E7%9B%B8%E5%85%B3%E4%BF%A1%E6%81%AF
     */
    public function go(string $accId, string $faccId)
    {
        $parameters = $this->mergeArgs(['accid' => $accId, 'faccid' => $faccId]);
        $this->validation($this->rules(), $this->messages(), $parameters);

        return $this->sendRequest('POST', 'nimserver/friend/update.action', $parameters);
    }

    /**
     * 给好友增加备注名，限制长度128，可设置为空字符串
     *
     * @param string $alias
     *
     * @return $this
     */
    public function setAlias(string $alias)
    {
        $this->args['alias'] = $alias;

        return $this;
    }

    /**
     * 修改ex字段，限制长度256，可设置为空字符串
     *
     * @param string $ex
     *
     * @return $this
     */
    public function setEx(string $ex)
    {
        $this->args['ex'] = $ex;

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
            'alias'    => 'sometimes|string|max:128',
            'ex'       => 'sometimes|string|max:256',
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
            'alias.string'    => '给好友增加备注名 : ' . Translate::VALIDATE_STRING,
            'alias.max'       => '给好友增加备注名 : ' . Translate::VALIDATE_MAX_128,
            'serverex.string' => '修改ex字段 : ' . Translate::VALIDATE_STRING,
            'serverex.max'    => '修改ex字段 : ' . Translate::VALIDATE_MAX_256,
            'serverex.string' => '服务器端扩展字段 : ' . Translate::VALIDATE_STRING,
            'serverex.max'    => '服务器端扩展字段 : ' . Translate::VALIDATE_MAX_256,
        ];
    }
}