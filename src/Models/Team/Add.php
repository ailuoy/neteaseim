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

class Add extends Model
{
    /**
     * 拉人入群
     *
     * @param string $tid
     * @param string $owner
     * @param array  $members
     * @param int    $mAgree
     * @param string $msg
     *
     * @return mixed
     * @throws \Ailuoy\NeteaseIm\Exceptions\ParameterErrorException
     * @throws \Ailuoy\NeteaseIm\Exceptions\RequestErrorException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E7%BE%A4%E7%BB%84%E5%8A%9F%E8%83%BD%EF%BC%88%E9%AB%98%E7%BA%A7%E7%BE%A4%EF%BC%89?#%E6%8B%89%E4%BA%BA%E5%85%A5%E7%BE%A4
     */
    public function go(string $tid, string $owner, array $members, int $mAgree, string $msg)
    {
        $parameters = $this->mergeArgs([
            'tid'     => $tid,
            'owner'   => $owner,
            'members' => json_encode($members),
            'magree'  => $mAgree,
            'msg'     => $msg
        ]);
        $this->validation($this->rules(), $this->messages(), $parameters);

        return $this->sendRequest('POST', 'nimserver/team/add.action', $parameters);
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
            'members' => 'required|json',
            'magree'  => [
                'required',
                'integer',
                Rule::in([0, 1])
            ],
            'msg'     => 'required|string|max:150',
            'attach'  => 'sometimes|string|max:512'
        ];
    }

    /**
     * @return array
     */
    private function messages()
    {
        return [
            'tid.required'     => '网易云通信team_id : ' . Translate::VALIDATE_REQUIRED,
            'tid.string'       => '网易云通信team_id : ' . Translate::VALIDATE_STRING,
            'tid.max'          => '网易云通信team_id : ' . Translate::VALIDATE_MAX_128,
            'owner.required'   => '群主用户帐号 : ' . Translate::VALIDATE_REQUIRED,
            'owner.string'     => '群主用户帐号 : ' . Translate::VALIDATE_STRING,
            'owner.max'        => '群主用户帐号 : ' . Translate::VALIDATE_MAX_32,
            'members.required' => '群成员 : ' . Translate::VALIDATE_REQUIRED,
            'members.json'     => '群成员 : ' . Translate::VALIDATE_JSON,
            'magree.required'  => '是否被邀请才能加入群 : ' . Translate::VALIDATE_REQUIRED,
            'magree.integer'   => '是否被邀请才能加入群 : ' . Translate::VALIDATE_INT,
            'magree.in'        => '是否被邀请才能加入群 : 值只能值 0 | 1',
            'msg.required'     => '邀请发送的文字 : ' . Translate::VALIDATE_REQUIRED,
            'msg.string'       => '邀请发送的文字 : ' . Translate::VALIDATE_STRING,
            'msg.max'          => '邀请发送的文字 : 最大150个字符',
            'attach.string'    => '自定义扩展字段 : ' . Translate::VALIDATE_STRING,
            'attach.max'       => '自定义扩展字段 : ' . Translate::VALIDATE_MAX_512,
        ];
    }
}