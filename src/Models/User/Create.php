<?php
/**
 * Created by PhpStorm.
 * User: ailuoy
 * Date: 2019/5/7
 * Time: 下午10:07
 */

namespace Ailuoy\NeteaseIm\Models\User;


use Ailuoy\NeteaseIm\Models\Model;
use Ailuoy\NeteaseIm\Translate;
use Illuminate\Validation\Rule;

class Create extends Model
{
    /**
     * 创建网易云通信ID
     *
     * @param string $accid
     *
     * @return mixed
     * @throws \Ailuoy\NeteaseIm\Exceptions\ParameterErrorException
     * @throws \Ailuoy\NeteaseIm\Exceptions\RequestErrorException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E7%BD%91%E6%98%93%E4%BA%91%E9%80%9A%E4%BF%A1ID?#%E5%88%9B%E5%BB%BA%E7%BD%91%E6%98%93%E4%BA%91%E9%80%9A%E4%BF%A1ID
     */
    public function go(string $accid)
    {
        $parameters = $this->mergeArgs(['accid' => $accid]);
        $this->validation($this->rules(), $this->messages(), $parameters);

        return $this->sendRequest('POST', 'nimserver/user/create.action', $parameters);
    }

    /**
     * 网易云通信ID昵称，最大长度64字符，用来PUSH推送时显示的昵称
     *
     * @param string $name
     *
     * @return $this
     */
    public function setName(string $name)
    {
        $this->args['name'] = $name;

        return $this;
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
     * 网易云通信ID头像URL，第三方可选填，最大长度1024
     *
     * @param string $icon
     *
     * @return $this
     */
    public function setIcon(string $icon)
    {
        $this->args['icon'] = $icon;

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

    /**
     * 用户签名，最大长度256字符
     *
     * @param string $sign
     *
     * @return $this
     */
    public function setSign(string $sign)
    {
        $this->args['sign'] = $sign;

        return $this;
    }

    /**
     * 用户email，最大长度64字符
     *
     * @param string $email
     *
     * @return $this
     */
    public function setEmail(string $email)
    {
        $this->args['email'] = $email;

        return $this;
    }

    /**
     * 用户生日，最大长度16字符
     *
     * @param string $birth
     *
     * @return $this
     */
    public function setBirth(string $birth)
    {
        $this->args['birth'] = $birth;

        return $this;
    }

    /**
     * 用户mobile，最大长度32字符，非中国大陆手机号码需要填写国家代码(如美国：+1-xxxxxxxxxx)或地区代码(如香港：+852-xxxxxxxx)
     *
     * @param string $mobile
     *
     * @return $this
     */
    public function setMobile(string $mobile)
    {
        $this->args['mobile'] = $mobile;

        return $this;
    }

    /**
     * 用户性别，0表示未知，1表示男，2女表示女，其它会报参数错误
     *
     * @param int $gender
     *
     * @return $this
     */
    public function setGender(int $gender)
    {
        $this->args['gender'] = $gender;

        return $this;
    }

    /**
     * 用户名片扩展字段，最大长度1024字符，用户可自行扩展，建议封装成JSON字符串
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
     * @return array
     */
    private function rules()
    {
        return [
            'accid'  => 'required|string|max:32',
            'name'   => 'sometimes|string|max:64',
            'props'  => 'sometimes|string|max:1024',
            'icon'   => 'sometimes|string|max:1024',
            'token'  => 'sometimes|string|max:128',
            'sign'   => 'sometimes|string|max:256',
            'email'  => 'sometimes|string|max:64',
            'birth'  => 'sometimes|string|max:16',
            'mobile' => 'sometimes|string|max:32',
            'gender' => [
                'sometimes',
                'integer',
                Rule::in([0, 1, 2])
            ],
            'ex'     => 'sometimes|string|max:1024',
        ];
    }

    /**
     * @return array
     */
    private function messages()
    {
        return [
            'accid.required' => Translate::FIELD_USER_ACCID . Translate::VALIDATE_REQUIRED,
            'accid.string'   => Translate::FIELD_USER_ACCID . Translate::VALIDATE_STRING,
            'accid.max'      => Translate::FIELD_USER_ACCID . Translate::VALIDATE_MAX_32,
            'name.string'    => Translate::FIELD_USER_NAME . Translate::VALIDATE_STRING,
            'name.max'       => Translate::FIELD_USER_NAME . Translate::VALIDATE_MAX_64,
            'props.string'   => Translate::FIELD_USER_PROPS . Translate::VALIDATE_STRING,
            'props.max'      => Translate::FIELD_USER_PROPS . Translate::VALIDATE_MAX_1024,
            'icon.string'    => Translate::FIELD_USER_ICON . Translate::VALIDATE_STRING,
            'icon.max'       => Translate::FIELD_USER_ICON . Translate::VALIDATE_MAX_1024,
            'token.string'   => Translate::FIELD_USER_TOKEN . Translate::VALIDATE_STRING,
            'token.max'      => Translate::FIELD_USER_TOKEN . Translate::VALIDATE_MAX_128,
            'sign.string'    => Translate::FIELD_USER_SIGN . Translate::VALIDATE_STRING,
            'sign.max'       => Translate::FIELD_USER_SIGN . Translate::VALIDATE_MAX_256,
            'email.string'   => Translate::FIELD_USER_EMAIL . Translate::VALIDATE_STRING,
            'email.max'      => Translate::FIELD_USER_EMAIL . Translate::VALIDATE_MAX_256,
            'birth.string'   => '用户生日 : ' . Translate::VALIDATE_STRING,
            'birth.max'      => '用户生日 : ' . Translate::VALIDATE_MAX_16,
            'mobile.string'  => '用户手机 : ' . Translate::VALIDATE_STRING,
            'mobile.max'     => '用户手机 : ' . Translate::VALIDATE_MAX_32,
            'gender.string'  => '用户性别 : ' . Translate::VALIDATE_INT,
            'gender.in'      => '用户性别 : ' . '值必须是 0|1|2 ',
            'ex.string'      => '用户拓展字段 : ' . Translate::VALIDATE_STRING,
            'ex.max'         => '用户拓展字段 : ' . Translate::VALIDATE_MAX_1024,
        ];
    }
}