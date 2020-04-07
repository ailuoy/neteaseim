<?php
/**
 * Created by PhpStorm.
 * User: ailuoy
 * Date: 2019/5/12
 * Time: 下午8:17
 */

namespace Ailuoy\NeteaseIm\Models\Team;


use Ailuoy\NeteaseIm\Models\Model;
use Ailuoy\NeteaseIm\Translate;

class Leave extends Model
{
    /**
     * 主动退群
     *
     * @param string $tid
     * @param string $accId
     *
     * @return mixed
     * https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E7%BE%A4%E7%BB%84%E5%8A%9F%E8%83%BD%EF%BC%88%E9%AB%98%E7%BA%A7%E7%BE%A4%EF%BC%89?#%E4%B8%BB%E5%8A%A8%E9%80%80%E7%BE%A4
     */
    public function go(string $tid, string $accId)
    {
        $parameters = [
            'tid'   => $tid,
            'accid' => $accId
        ];
        $this->validation($this->rules(), $this->messages(), $parameters);

        return $this->sendRequest('POST', 'nimserver/team/leave.action', $parameters);
    }

    /**
     * @return array
     */
    private function rules()
    {
        return [
            'tid'   => 'required|string|max:128',
            'accid' => 'required|string|max:32'
        ];
    }

    /**
     * @return array
     */
    private function messages()
    {
        return [
            'tid.required'   => '网易云通信team_id : ' . Translate::VALIDATE_REQUIRED,
            'tid.string'     => '网易云通信team_id : ' . Translate::VALIDATE_STRING,
            'tid.max'        => '网易云通信team_id : ' . Translate::VALIDATE_MAX_128,
            'accid.required' => '禁言对象的accid : ' . Translate::VALIDATE_REQUIRED,
            'accid.string'   => '禁言对象的accid : ' . Translate::VALIDATE_STRING,
            'accid.max'      => '禁言对象的accid : ' . Translate::VALIDATE_MAX_32
        ];
    }
}