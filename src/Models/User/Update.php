<?php
/**
 * Created by PhpStorm.
 * User: ailuoy
 * Date: 2019/5/8
 * Time: 上午7:35
 */

namespace Ailuoy\NeteaseIm\Models\User;


use Ailuoy\NeteaseIm\Models\Model;
use Ailuoy\NeteaseIm\Translate;

class Update extends Model
{
    /**
     * 网易云通信ID更新
     *
     * @param string $accid
     *
     * @return mixed
     * @throws \Ailuoy\NeteaseIm\Exceptions\ParameterErrorException
     * @throws \Ailuoy\NeteaseIm\Exceptions\RequestErrorException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E7%BD%91%E6%98%93%E4%BA%91%E9%80%9A%E4%BF%A1ID?#%E7%BD%91%E6%98%93%E4%BA%91%E9%80%9A%E4%BF%A1ID%E6%9B%B4%E6%96%B0
     */
    public function go(string $accid)
    {
        $parameters = $this->mergeArgs(['accid' => $accid]);
        $this->validation($this->rules(), $this->messages(), $parameters);

        return $this->sendRequest('POST', 'nimserver/user/update.action', $parameters);
    }

    /**
     * json属性，第三方可选填，最大长度1024字符
     *
     * @param array $props
     *
     * @return $this
     */
    public function setProps(array $props)
    {
        $this->args['props'] = json_encode($props);

        return $this;
    }

    /**
     * 网易云通信ID可以指定登录token值，最大长度128字符，
     * 并更新，如果未指定，会自动生成token，并在
     * 创建成功后返回
     *
     * @param string $token
     *
     * @return $this
     */
    public function setToken(string $token)
    {
        $this->args['token'] = $token;

        return $this;
    }

    private function rules()
    {
        return [
            'accid' => 'required|string|max:32',
            'props' => 'sometimes|string|max:1024',
            'token' => 'sometimes|string|max:128'
        ];
    }

    private function messages()
    {
        return [
            'accid.required' => Translate::FIELD_USER_ACCID . Translate::VALIDATE_REQUIRED,
            'accid.string'   => Translate::FIELD_USER_ACCID . Translate::VALIDATE_STRING,
            'accid.max'      => Translate::FIELD_USER_ACCID . Translate::VALIDATE_MAX_32,
            'props.string'   => Translate::FIELD_USER_PROPS . Translate::VALIDATE_STRING,
            'props.max'      => Translate::FIELD_USER_PROPS . Translate::VALIDATE_MAX_1024,
            'token.string'   => Translate::FIELD_USER_TOKEN . Translate::VALIDATE_STRING,
            'token.max'      => Translate::FIELD_USER_TOKEN . Translate::VALIDATE_MAX_128,
        ];
    }
}