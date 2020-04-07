<?php
/**
 * Created by PhpStorm.
 * User: ailuoy
 * Date: 2019/5/8
 * Time: 上午8:08
 */

namespace Ailuoy\NeteaseIm\Models\User;


use Ailuoy\NeteaseIm\Models\Model;
use Ailuoy\NeteaseIm\Translate;

class UnBlock extends Model
{
    /**
     * 解禁网易云通信ID
     *
     * @param string $accId
     *
     * @return mixed
     * @throws \Ailuoy\NeteaseIm\Exceptions\ParameterErrorException
     * @throws \Ailuoy\NeteaseIm\Exceptions\RequestErrorException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E7%BD%91%E6%98%93%E4%BA%91%E9%80%9A%E4%BF%A1ID?#%E8%A7%A3%E7%A6%81%E7%BD%91%E6%98%93%E4%BA%91%E9%80%9A%E4%BF%A1ID
     */
    public function go(string $accId)
    {
        $parameters = ['accid' => $accId];
        $this->validation($this->rules(), $this->messages(), $parameters);

        return $this->sendRequest('POST', 'nimserver/user/unblock.action', $parameters);
    }

    /**
     * @return array
     */
    private function rules(): array
    {
        return [
            'accid' => 'required',
        ];
    }

    /**
     * @return array
     */
    private function messages(): array
    {
        return [
            'accid.required' => Translate::FIELD_USER_ACCID . Translate::VALIDATE_REQUIRED
        ];
    }
}