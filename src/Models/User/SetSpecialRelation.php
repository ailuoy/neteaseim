<?php
/**
 * Created by PhpStorm.
 * User: ailuoy
 * Date: 2019/5/8
 * Time: 上午7:49
 */

namespace Ailuoy\NeteaseIm\Models\User;


use Ailuoy\NeteaseIm\Models\Model;
use Ailuoy\NeteaseIm\Translate;
use Illuminate\Validation\Rule;

class SetSpecialRelation extends Model
{
    /**
     * 设置黑名单/静音
     *
     * @param string $accId
     * @param string $targetAcc
     * @param int    $relationType
     * @param int    $value
     *
     * @return mixed
     * @throws \Ailuoy\NeteaseIm\Exceptions\ParameterErrorException
     * @throws \Ailuoy\NeteaseIm\Exceptions\RequestErrorException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E7%94%A8%E6%88%B7%E5%85%B3%E7%B3%BB%E6%89%98%E7%AE%A1?#%E8%AE%BE%E7%BD%AE%E9%BB%91%E5%90%8D%E5%8D%95/%E9%9D%99%E9%9F%B3
     */
    public function go(string $accId, string $targetAcc, int $relationType, int $value)
    {
        $parameters = [
            'accid'        => $accId,
            'targetAcc'    => $targetAcc,
            'relationType' => $relationType,
            'value'        => $value
        ];
        $this->validation($this->rules(), $this->messages(), $parameters);

        return $this->sendRequest('POST', 'nimserver/user/setSpecialRelation.action', $parameters);
    }

    /**
     * @return array
     */
    private function rules(): array
    {
        return [
            'accid'        => 'required|string|max:32',
            'targetAcc'    => 'required|string|max:32',
            'relationType' => [
                'required',
                'integer',
                Rule::in([1, 2])
            ],
            'value'        => [
                'required',
                'integer',
                Rule::in([0, 1])
            ]
        ];
    }

    /**
     * @return array
     */
    private function messages(): array
    {
        return [
            'accid.required'        => '加好友发起者accid : ' . Translate::VALIDATE_REQUIRED,
            'accid.string'          => '加好友发起者accid : ' . Translate::VALIDATE_STRING,
            'accid.max'             => '加好友发起者accid : ' . Translate::VALIDATE_MAX_32,
            'targetAcc.required'    => '被加黑或加静音的帐号 : ' . Translate::VALIDATE_REQUIRED,
            'targetAcc.string'      => '被加黑或加静音的帐号 : ' . Translate::VALIDATE_STRING,
            'targetAcc.max'         => '被加黑或加静音的帐号 : ' . Translate::VALIDATE_MAX_32,
            'relationType.required' => '本次操作的关系类型 : ' . Translate::VALIDATE_REQUIRED,
            'relationType.integer'  => '本次操作的关系类型 : ' . Translate::VALIDATE_INT,
            'relationType.integer'  => '本次操作的关系类型 : ' . '值必须是 1|2',
            'value.required'        => '操作值 : ' . Translate::VALIDATE_REQUIRED,
            'value.integer'         => '操作值 : ' . Translate::VALIDATE_INT,
            'value.integer'         => '操作值 : ' . '值必须是 0|1',
        ];
    }
}