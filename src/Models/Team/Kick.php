<?php
/**
 * Created by PhpStorm.
 * User: ailuoy
 * Date: 2019/5/11
 * Time: 下午2:59
 */

namespace Ailuoy\NeteaseIm\Models\Team;


use Ailuoy\NeteaseIm\Models\Model;
use Ailuoy\NeteaseIm\Translate;
use Illuminate\Validation\Rule;

class Kick extends Model
{
    /**
     * 踢人出群
     *
     * @param string $tid
     * @param string $owner
     *
     * @return mixed
     */
    public function go(string $tid, string $owner)
    {
        $parameters = $this->mergeArgs([
            'tid'   => $tid,
            'owner' => $owner
        ]);
        $this->validation($this->rules(), $this->messages(), $parameters);

        return $this->sendRequest('POST', 'nimserver/team/kick.action', $parameters);
    }

    /**
     * 被移除人的accid，用户账号，最大长度32字符;注：member或members任意提供一个，优先使用member参数
     *
     * @param string $member
     *
     * @return $this
     */
    public function setMember(string $member)
    {
        $this->args['member'] = $member;

        return $this;
    }

    /**
     * ["aaa","bbb"]（JSONArray对应的accid，如果解析出错，会报414）一次最多操作200个accid; 注：member或members任意提供一个，优先使用member参数
     *
     * @param array $members
     *
     * @return $this
     */
    public function setMembers(array $members)
    {
        $this->args['members'] = json_encode($members);

        return $this;
    }

    /**
     * 自定义扩展字段，最大长度512
     *
     * @param string $attach
     *
     * @return $this
     */
    public function setAttach(string $attach)
    {
        $this->args['attach'] = $attach;

        return $this;
    }

    /**
     * @return array
     */
    private function rules()
    {
        return [
            'tid'     => 'required|string|max:128',
            'owner'   => 'required|string|max:32',
            'member'  => 'sometimes|string|max:32',
            'members' => 'sometimes|json',
            'attach'  => 'sometimes|string|max:512'
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
            'owner.required' => '群主用户帐号 : ' . Translate::VALIDATE_REQUIRED,
            'owner.string'   => '群主用户帐号 : ' . Translate::VALIDATE_STRING,
            'owner.max'      => '群主用户帐号 : ' . Translate::VALIDATE_MAX_32,
            'member.string'  => '被移除人的accid : ' . Translate::VALIDATE_STRING,
            'member.max'     => '被移除人的accid : ' . Translate::VALIDATE_MAX_32,
            'members.json'   => '群成员 : ' . Translate::VALIDATE_JSON,
            'attach.string'  => '自定义扩展字段 : ' . Translate::VALIDATE_STRING,
            'attach.max'     => '自定义扩展字段 : ' . Translate::VALIDATE_MAX_512,
        ];
    }
}