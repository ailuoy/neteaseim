<?php
/**
 * Created by PhpStorm.
 * User: ailuoy
 * Date: 2019/5/8
 * Time: 上午7:44
 */

namespace Ailuoy\NeteaseIm\Models\User;


use Ailuoy\NeteaseIm\Models\Model;
use Ailuoy\NeteaseIm\Translate;

class RefreshToken extends Model
{
    /**
     * 更新并获取新token
     *
     * @param string $accId
     *
     * @return mixed
     * @throws \Ailuoy\NeteaseIm\Exceptions\ParameterErrorException
     * @throws \Ailuoy\NeteaseIm\Exceptions\RequestErrorException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E7%BD%91%E6%98%93%E4%BA%91%E9%80%9A%E4%BF%A1ID?#%E6%9B%B4%E6%96%B0%E5%B9%B6%E8%8E%B7%E5%8F%96%E6%96%B0token
     */
    public function go(string $accId)
    {
        $parameters = ['accid' => $accId];
        $this->validation($this->rules(), $this->messages(), $parameters);

        return $this->sendRequest('POST', 'nimserver/user/refreshToken.action', $parameters);
    }

    private function rules()
    {
        return [
            'accid' => 'required',
        ];
    }

    private function messages()
    {
        return [
            'accid.required' => Translate::FIELD_USER_ACCID . Translate::VALIDATE_REQUIRED
        ];
    }
}