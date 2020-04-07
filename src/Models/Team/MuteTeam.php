<?php
/**
 * Created by PhpStorm.
 * User: ailuoy
 * Date: 2019/5/11
 * Time: 下午7:24
 */

namespace Ailuoy\NeteaseIm\Models\Team;


use Ailuoy\NeteaseIm\Models\Model;
use Ailuoy\NeteaseIm\Translate;
use Illuminate\Validation\Rule;

class MuteTeam extends Model
{
    /**
     * 修改消息提醒开关
     *
     * @param string $tid
     * @param string $accId
     * @param int    $ope
     *
     * @return mixed
     * https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E7%BE%A4%E7%BB%84%E5%8A%9F%E8%83%BD%EF%BC%88%E9%AB%98%E7%BA%A7%E7%BE%A4%EF%BC%89?#%E4%BF%AE%E6%94%B9%E6%B6%88%E6%81%AF%E6%8F%90%E9%86%92%E5%BC%80%E5%85%B3
     */
    public function go(string $tid, string $accId, int $ope)
    {
        $parameters = [
            'tid'   => $tid,
            'accid' => $accId,
            'ope'   => $ope
        ];
        $this->validation($this->rules(), $this->messages(), $parameters);

        return $this->sendRequest('POST', 'nimserver/team/muteTeam.action', $parameters);
    }

    /**
     * @return array
     */
    private function rules()
    {
        return [
            'tid'   => 'required|string',
            'accid' => 'required|string|max:32',
            'ope'   => [
                'required',
                'integer',
                Rule::in([1, 2])
            ],
        ];
    }

    /**
     * @return array
     */
    private function messages()
    {
        return [
            'tid.required'   => '群id : ' . Translate::VALIDATE_REQUIRED,
            'tid.string'     => '群id : ' . Translate::VALIDATE_STRING,
            'accid.required' => '要操作的群成员accid : ' . Translate::VALIDATE_REQUIRED,
            'accid.string'   => '要操作的群成员accid : ' . Translate::VALIDATE_STRING,
            'accid.max'      => '要操作的群成员accid : ' . Translate::VALIDATE_MAX_32,
            'ope.integer'    => '消息提醒 : ' . Translate::VALIDATE_REQUIRED,
            'ope.in'         => '消息提醒 : 值只能是 1 | 2' . Translate::VALIDATE_JSON,
        ];
    }
}