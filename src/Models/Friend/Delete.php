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

class Delete extends Model
{
    /**
     * 删除好友
     *
     * @param string $accId
     * @param string $faccId
     *
     * @return mixed
     * @throws \Ailuoy\NeteaseIm\Exceptions\ParameterErrorException
     * @throws \Ailuoy\NeteaseIm\Exceptions\RequestErrorException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E7%94%A8%E6%88%B7%E5%85%B3%E7%B3%BB%E6%89%98%E7%AE%A1?#%E5%88%A0%E9%99%A4%E5%A5%BD%E5%8F%8B
     */
    public function go(string $accId, string $faccId)
    {
        $parameters = $this->mergeArgs(['accid' => $accId, 'faccid' => $faccId]);
        var_dump($parameters);
        $this->validation($this->rules(), $this->messages(), $parameters);

        return $this->sendRequest('POST', 'nimserver/friend/delete.action', $parameters);
    }

    /**
     * 是否需要删除备注信息默认false:不需要，true:需要
     *
     * @param bool $isDeleteAlias
     *
     * @return $this
     */
    public function setIsDeleteAlias(bool $isDeleteAlias)
    {
        $this->args['isDeleteAlias'] = $isDeleteAlias;

        return $this;
    }

    /**
     * @return array
     */
    private function rules(): array
    {
        return [
            'accid'         => 'required|string|max:32',
            'faccid'        => 'required|string|max:32',
            'isDeleteAlias' => [
                'sometimes',
                'boolean'
            ]
        ];
    }

    /**
     * @return array
     */
    private function messages(): array
    {
        return [
            'accid.required'        => '发起者accid : ' . Translate::VALIDATE_REQUIRED,
            'accid.string'          => '发起者accid : ' . Translate::VALIDATE_STRING,
            'accid.max'             => '发起者accid : ' . Translate::VALIDATE_MAX_32,
            'faccid.required'       => '要删除朋友的accid : ' . Translate::VALIDATE_REQUIRED,
            'faccid.string'         => '要删除朋友的accid : ' . Translate::VALIDATE_STRING,
            'faccid.max'            => '要删除朋友的accid : ' . Translate::VALIDATE_MAX_32,
            'isDeleteAlias.boolean' => '是否需要删除备注信息 : ' . Translate::VALIDATE_BOOLEAN
        ];
    }
}