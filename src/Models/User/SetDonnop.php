<?php
/**
 * Created by PhpStorm.
 * User: ailuoy
 * Date: 2019/5/8
 * Time: 上午8:17
 */

namespace Ailuoy\NeteaseIm\Models\User;


use Ailuoy\NeteaseIm\Models\Model;
use Ailuoy\NeteaseIm\Translate;
use Illuminate\Validation\Rule;

class SetDonnop extends Model
{
    /**
     * 设置桌面端在线时，移动端是否需要推送
     *
     * @param string $accId
     * @param string $donnopOpen
     *
     * @return mixed
     * @throws \Ailuoy\NeteaseIm\Exceptions\ParameterErrorException
     * @throws \Ailuoy\NeteaseIm\Exceptions\RequestErrorException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E7%94%A8%E6%88%B7%E8%AE%BE%E7%BD%AE?#%E8%AE%BE%E7%BD%AE%E6%A1%8C%E9%9D%A2%E7%AB%AF%E5%9C%A8%E7%BA%BF%E6%97%B6%EF%BC%8C%E7%A7%BB%E5%8A%A8%E7%AB%AF%E6%98%AF%E5%90%A6%E4%B8%8D%E6%8E%A8%E9%80%81
     */
    public function go(string $accId, string $donnopOpen)
    {
        $parameters = ['accid' => $accId, 'donnopOpen' => $donnopOpen];
        $this->validation($this->rules(), $this->messages(), $parameters);

        return $this->sendRequest('POST', 'nimserver/user/setDonnop.action', $parameters);
    }

    /**
     * @return array
     */
    private function rules() : array
    {
        return [
            'accid'      => 'required|string|max:32',
            'donnopOpen' => [
                'required',
                'string',
                Rule::in(['true', 'false'])
            ],
        ];
    }

    /**
     * @return array
     */
    private function messages() : array
    {
        return [
            'accid.required'      => Translate::FIELD_USER_ACCID . Translate::VALIDATE_REQUIRED,
            'accid.string'        => Translate::FIELD_USER_ACCID . Translate::VALIDATE_STRING,
            'accid.max'           => Translate::FIELD_USER_ACCID . Translate::VALIDATE_MAX_32,
            'donnopOpen.required' => '桌面端在线时，移动端是否不推送 : ' . Translate::VALIDATE_REQUIRED,
            'donnopOpen.string'   => '桌面端在线时，移动端是否不推送 : ' . Translate::VALIDATE_STRING,
            'donnopOpen.in'       => '桌面端在线时，移动端是否不推送 : ' . Translate::VALIDATE_IN_STRING_TRUE_FALSE
        ];
    }
}