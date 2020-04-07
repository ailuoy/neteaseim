<?php
/**
 * Created by PhpStorm.
 * User: ailuoy
 * Date: 2019/5/11
 * Time: 下午2:17
 */

namespace Ailuoy\NeteaseIm\Models\Team;


use Ailuoy\NeteaseIm\Models\Model;
use Ailuoy\NeteaseIm\Translate;
use Illuminate\Validation\Rule;

class Create extends Model
{

    /**
     * 创建群
     *
     * @param string $tname
     * @param string $owner
     * @param array  $members
     * @param string $msg
     * @param int    $mAgree
     * @param int    $joinMode
     *
     * @return mixed
     * @throws \Ailuoy\NeteaseIm\Exceptions\ParameterErrorException
     * @throws \Ailuoy\NeteaseIm\Exceptions\RequestErrorException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E7%BE%A4%E7%BB%84%E5%8A%9F%E8%83%BD%EF%BC%88%E9%AB%98%E7%BA%A7%E7%BE%A4%EF%BC%89?#%E5%88%9B%E5%BB%BA%E7%BE%A4
     */
    public function go(
        string $tname,
        string $owner,
        array $members,
        string $msg,
        int $mAgree,
        int $joinMode
    ) {
        $parameters = $this->mergeArgs([
            'tname'    => $tname,
            'owner'    => $owner,
            'members'  => json_encode($members),
            'msg'      => $msg,
            'magree'   => $mAgree,
            'joinmode' => $joinMode,
        ]);
        $this->validation($this->rules(), $this->messages(), $parameters);

        return $this->sendRequest('POST', 'nimserver/team/create.action', $parameters);
    }

    /**
     * 群公告，最大长度1024字符
     *
     * @param string $announcement
     *
     * @return $this
     */
    public function setAnnouncement(string $announcement)
    {
        $this->args['announcement'] = $announcement;

        return $this;
    }

    /**
     * 群描述，最大长度512字符
     *
     * @param string $intro
     *
     * @return $this
     */
    public function setIntro(string $intro)
    {
        $this->args['intro'] = $intro;

        return $this;
    }

    /**
     * 自定义高级群扩展属性，第三方可以跟据此属性自定义扩展自己的群属性。（建议为json）,最大长度1024字符
     *
     * @param string $custom
     *
     * @return $this
     */
    public function setCustom(string $custom)
    {
        $this->args['msg'] = $custom;

        return $this;
    }

    /**
     * 群头像，最大长度1024字符
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
     * 被邀请人同意方式，0-需要同意(默认),1-不需要同意。其它返回414
     *
     * @param int $beInviteMode
     *
     * @return $this
     */
    public function setBeInviteMode(int $beInviteMode)
    {
        $this->args['beinvitemode'] = $beInviteMode;

        return $this;
    }

    /**
     * 谁可以邀请他人入群，0-管理员(默认),1-所有人。其它返回414
     *
     * @param int $inviteMode
     *
     * @return $this
     */
    public function setInviteMode(int $inviteMode)
    {
        $this->args['invitemode'] = $inviteMode;

        return $this;
    }

    /**
     * 谁可以修改群资料，0-管理员(默认),1-所有人。其它返回414
     *
     * @param int $uptInfoMode
     *
     * @return $this
     */
    public function setUptInfoMode(int $uptInfoMode)
    {
        $this->args['uptinfomode'] = $uptInfoMode;

        return $this;
    }

    /**
     * 谁可以更新群自定义属性，0-管理员(默认),1-所有人。其它返回414
     *
     * @param int $upCustomMode
     *
     * @return $this
     */
    public function setUpCustomMode(int $upCustomMode)
    {
        $this->args['upcustommode'] = $upCustomMode;

        return $this;
    }

    /**
     * 该群最大人数(包含群主)，范围：2至应用定义的最大群人数(默认:200)。其它返回414
     *
     * @param int $teamMemberLimit
     *
     * @return $this
     */
    public function setTeamMemberLimit(int $teamMemberLimit)
    {
        $this->args['teamMemberLimit'] = $teamMemberLimit;

        return $this;
    }

    private function rules()
    {
        return [
            'tname'           => 'required|string|max:64',
            'owner'           => 'required|string|max:32',
            'members'         => 'required|json|max:200',
            'msg'             => 'required|string|max:150',
            'magree'          => [
                'required',
                'integer',
                Rule::in([0, 1])
            ],
            'joinmode'        => [
                'required',
                'integer',
                Rule::in([0, 1, 2])
            ],
            'announcement'    => 'sometimes|string|max:1024',
            'intro'           => 'sometimes|string|max:512',
            'custom'          => 'sometimes|string|max:1024',
            'icon'            => 'sometimes|string|max:1024',
            'beinvitemode'    => [
                'sometimes',
                'integer',
                Rule::in([0, 1])
            ],
            'invitemode'      => [
                'sometimes',
                'integer',
                Rule::in([0, 1])
            ],
            'uptinfomode'     => [
                'sometimes',
                'integer',
                Rule::in([0, 1])
            ],
            'upcustommode'    => [
                'sometimes',
                'integer',
                Rule::in([0, 1])
            ],
            'teamMemberLimit' => [
                'sometimes',
                'integer'
            ],
        ];
    }

    private function messages()
    {
        return [
            'tname.required'          => '群名称 : ' . Translate::VALIDATE_REQUIRED,
            'tname.string'            => '群名称 : ' . Translate::VALIDATE_STRING,
            'tname.max'               => '群名称 : ' . Translate::VALIDATE_MAX_64,
            'owner.required'          => '群主用户帐号 : ' . Translate::VALIDATE_REQUIRED,
            'owner.string'            => '群主用户帐号 : ' . Translate::VALIDATE_STRING,
            'owner.max'               => '群主用户帐号 : ' . Translate::VALIDATE_MAX_32,
            'members.required'        => '群成员 : ' . Translate::VALIDATE_REQUIRED,
            'members.json'            => '群成员 : ' . Translate::VALIDATE_JSON,
            'msg.required'            => '邀请发送的文字 : ' . Translate::VALIDATE_REQUIRED,
            'msg.string'              => '邀请发送的文字 : ' . Translate::VALIDATE_STRING,
            'msg.max'                 => '邀请发送的文字 : 最大150个字符',
            'magree.required'         => '是否被邀请才能加入群 : ' . Translate::VALIDATE_REQUIRED,
            'magree.integer'          => '是否被邀请才能加入群 : ' . Translate::VALIDATE_INT,
            'magree.in'               => '是否被邀请才能加入群 : 值只能值 0 | 1',
            'joinmode.required'       => '加入群的验证 : ' . Translate::VALIDATE_REQUIRED,
            'joinmode.integer'        => '加入群的验证 : ' . Translate::VALIDATE_INT,
            'joinmode.in'             => '加入群的验证 : 值只能值 0 | 1 | 2',
            'announcement.string'     => '群公告 : ' . Translate::VALIDATE_STRING,
            'announcement.max'        => '群公告 : ' . Translate::VALIDATE_MAX_1024,
            'intro.string'            => '群描述 : ' . Translate::VALIDATE_STRING,
            'intro.max'               => '群描述 : ' . Translate::VALIDATE_MAX_512,
            'custom.string'           => '自定义高级群扩展属性 : ' . Translate::VALIDATE_STRING,
            'custom.max'              => '自定义高级群扩展属性 : ' . Translate::VALIDATE_MAX_1024,
            'icon.string'             => '群头像 : ' . Translate::VALIDATE_STRING,
            'icon.max'                => '群头像 : ' . Translate::VALIDATE_MAX_1024,
            'beinvitemode.integer'    => '被邀请人同意方式 : ' . Translate::VALIDATE_INT,
            'beinvitemode.in'         => '被邀请人同意方式 : 值只能值 0 | 1',
            'invitemode.integer'      => '谁可以邀请他人入群 : ' . Translate::VALIDATE_INT,
            'invitemode.in'           => '谁可以邀请他人入群 : 值只能值 0 | 1',
            'uptinfomode.integer'     => '谁可以修改群资料 : ' . Translate::VALIDATE_INT,
            'uptinfomode.in'          => '谁可以修改群资料 : 值只能值 0 | 1',
            'upcustommode.integer'    => '谁可以更新群自定义属性 : ' . Translate::VALIDATE_INT,
            'upcustommode.in'         => '谁可以更新群自定义属性 : 值只能值 0 | 1',
            'teamMemberLimit.integer' => '该群最大人数(包含群主) : ' . Translate::VALIDATE_INT,
        ];
    }
}