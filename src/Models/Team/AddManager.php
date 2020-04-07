<?php
/**
 * Created by PhpStorm.
 * User: ailuoy
 * Date: 2019/5/11
 * Time: 下午6:57
 */

namespace Ailuoy\NeteaseIm\Models\Team;


use Ailuoy\NeteaseIm\Models\Model;
use Ailuoy\NeteaseIm\Translate;

class AddManager extends Model
{
    /**
     * 任命管理员
     *
     * @param string $tid
     * @param string $owner
     * @param array  $members
     *
     * @return mixed
     * https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E7%BE%A4%E7%BB%84%E5%8A%9F%E8%83%BD%EF%BC%88%E9%AB%98%E7%BA%A7%E7%BE%A4%EF%BC%89?#%E4%BB%BB%E5%91%BD%E7%AE%A1%E7%90%86%E5%91%98
     */
    public function go(string $tid, string $owner, array $members)
    {
        $parameters = [
            'tid'     => $tid,
            'owner'   => $owner,
            'members' => json_encode($members)
        ];
        $this->validation($this->rules(), $this->messages(), $parameters);

        return $this->sendRequest('POST', 'nimserver/team/addManager.action', $parameters);
    }

    private function rules()
    {
        return [
            'tid'     => 'required|string',
            'owner'   => 'required|string|max:32',
            'members' => 'required|json|max:10'
        ];
    }

    private function messages()
    {
        return [
            'tid.required'     => '群id : ' . Translate::VALIDATE_REQUIRED,
            'tid.string'       => '群id : ' . Translate::VALIDATE_STRING,
            'owner.required'   => '群主用户帐号 : ' . Translate::VALIDATE_REQUIRED,
            'owner.string'     => '群主用户帐号 : ' . Translate::VALIDATE_STRING,
            'owner.max'        => '群主用户帐号 : ' . Translate::VALIDATE_MAX_32,
            'members.required' => '新群主帐号 : ' . Translate::VALIDATE_REQUIRED,
            'members.json'     => '新群主帐号 : ' . Translate::VALIDATE_JSON,
            'members.max'      => '新群主帐号 : 一次添加最多10个管理员',
        ];
    }
}