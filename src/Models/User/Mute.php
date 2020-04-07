<?php
/**
 * Created by PhpStorm.
 * User: ailuoy
 * Date: 2019/5/8
 * Time: 上午8:23
 */

namespace Ailuoy\NeteaseIm\Models\User;


use Ailuoy\NeteaseIm\Models\Model;
use Ailuoy\NeteaseIm\Translate;

class Mute extends Model
{
    /**
     * 账号全局禁言
     *
     * @param string $accId
     * @param bool   $mute
     *
     * @return mixed
     * @throws \Ailuoy\NeteaseIm\Exceptions\ParameterErrorException
     * @throws \Ailuoy\NeteaseIm\Exceptions\RequestErrorException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E7%94%A8%E6%88%B7%E8%AE%BE%E7%BD%AE?#%E8%B4%A6%E5%8F%B7%E5%85%A8%E5%B1%80%E7%A6%81%E8%A8%80
     */
    public function go(string $accId, bool $mute)
    {
        $parameters = ['accid' => $accId, 'mute' => $mute];
        $this->validation($this->rules(), $this->messages(), $parameters);

        return $this->sendRequest('POST', 'nimserver/user/mute.action', $parameters);
    }

    /**
     * @return array
     */
    private function rules(): array
    {
        return [
            'accid' => 'required|string|max:32',
            'mute'  => 'required|boolean'
        ];
    }

    /**
     * @return array
     */
    private function messages(): array
    {
        return [
            'accid.required' => Translate::FIELD_USER_ACCID . Translate::VALIDATE_REQUIRED,
            'accid.string'   => Translate::FIELD_USER_ACCID . Translate::VALIDATE_STRING,
            'accid.max'      => Translate::FIELD_USER_ACCID . Translate::VALIDATE_MAX_32,
            'mute.required'  => '是否全局禁言 : ' . Translate::VALIDATE_REQUIRED,
            'mute.boolean'   => '是否全局禁言 : ' . Translate::VALIDATE_BOOLEAN,
        ];
    }
}