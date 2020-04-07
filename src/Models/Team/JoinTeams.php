<?php
/**
 * Created by PhpStorm.
 * User: ailuoy
 * Date: 2019/5/11
 * Time: 下午7:09
 */

namespace Ailuoy\NeteaseIm\Models\Team;


use Ailuoy\NeteaseIm\Models\Model;
use Ailuoy\NeteaseIm\Translate;

class JoinTeams extends Model
{
    /**
     * 获取某用户所加入的群信息
     *
     * @param string $accId
     *
     * @return mixed
     * https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E7%BE%A4%E7%BB%84%E5%8A%9F%E8%83%BD%EF%BC%88%E9%AB%98%E7%BA%A7%E7%BE%A4%EF%BC%89?#%E8%8E%B7%E5%8F%96%E6%9F%90%E7%94%A8%E6%88%B7%E6%89%80%E5%8A%A0%E5%85%A5%E7%9A%84%E7%BE%A4%E4%BF%A1%E6%81%AF
     */
    public function go(string $accId)
    {
        $parameters = ['accid' => $accId];
        $this->validation($this->rules(), $this->messages(), $parameters);

        return $this->sendRequest('POST', 'nimserver/team/joinTeams.action', $parameters);
    }

    private function rules()
    {
        return [
            'accid' => 'required|string|max:32'
        ];
    }

    private function messages()
    {
        return [
            'accid.required' => Translate::FIELD_USER_ACCID . Translate::VALIDATE_REQUIRED,
            'accid.string'   => Translate::FIELD_USER_ACCID . Translate::VALIDATE_STRING,
            'accid.max'      => Translate::FIELD_USER_ACCID . Translate::VALIDATE_MAX_128,
        ];
    }
}