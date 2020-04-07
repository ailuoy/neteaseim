<?php
/**
 * Created by PhpStorm.
 * User: ailuoy
 * Date: 2019/5/11
 * Time: 下午6:47
 */

namespace Ailuoy\NeteaseIm\Models\Team;


use Ailuoy\NeteaseIm\Models\Model;
use Ailuoy\NeteaseIm\Translate;
use Illuminate\Validation\Rule;

class ChangeOwner extends Model
{
    /**
     * 移交群主
     *
     * @param string $tid
     * @param string $owner
     * @param string $newOwner
     * @param int    $leave
     *
     * @return mixed
     * https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E7%BE%A4%E7%BB%84%E5%8A%9F%E8%83%BD%EF%BC%88%E9%AB%98%E7%BA%A7%E7%BE%A4%EF%BC%89?#%E7%A7%BB%E4%BA%A4%E7%BE%A4%E4%B8%BB
     */
    public function go(string $tid, string $owner, string $newOwner, int $leave)
    {
        $parameters = [
            'tid'      => $tid,
            'owner'    => $owner,
            'newowner' => $newOwner,
            'leave'    => $leave
        ];
        $this->validation($this->rules(), $this->messages(), $parameters);

        return $this->sendRequest('POST', 'nimserver/team/changeOwner.action', $parameters);
    }

    /**
     * @return array
     */
    private function rules()
    {
        return [
            'tid'      => 'required|string',
            'owner'    => 'required|string|max:32',
            'newowner' => 'required|string|max:32',
            'leave'    => [
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
            'tid.required'      => '群id : ' . Translate::VALIDATE_REQUIRED,
            'tid.string'        => '群id : ' . Translate::VALIDATE_STRING,
            'owner.required'    => '群主用户帐号 : ' . Translate::VALIDATE_REQUIRED,
            'owner.string'      => '群主用户帐号 : ' . Translate::VALIDATE_STRING,
            'owner.max'         => '群主用户帐号 : ' . Translate::VALIDATE_MAX_32,
            'newowner.required' => '新群主帐号 : ' . Translate::VALIDATE_REQUIRED,
            'newowner.string'   => '新群主帐号 : ' . Translate::VALIDATE_STRING,
            'newowner.max'      => '新群主帐号 : ' . Translate::VALIDATE_MAX_32,
            'leave.required'    => '接触群之后群主是否离开群 : ' . Translate::VALIDATE_REQUIRED,
            'leave.integer'     => '接触群之后群主是否离开群 : ' . Translate::VALIDATE_INT,
            'leave.in'          => '接触群之后群主是否离开群 : 值只能是 1 | 2',
        ];
    }
}