<?php
/**
 * Created by PhpStorm.
 * User: ailuoy
 * Date: 2019/5/11
 * Time: 下午7:13
 */

namespace Ailuoy\NeteaseIm\Models\Team;


use Ailuoy\NeteaseIm\Models\Model;
use Ailuoy\NeteaseIm\Translate;

class UpdateTeamNick extends Model
{
    /**
     * 修改群昵称
     *
     * @param string $tid
     * @param string $owner
     * @param string $accId
     *
     * @return mixed
     * https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E7%BE%A4%E7%BB%84%E5%8A%9F%E8%83%BD%EF%BC%88%E9%AB%98%E7%BA%A7%E7%BE%A4%EF%BC%89?#%E4%BF%AE%E6%94%B9%E7%BE%A4%E6%98%B5%E7%A7%B0
     */
    public function go(string $tid, string $owner, string $accId)
    {
        $parameters = $this->mergeArgs([
            'tid'   => $tid,
            'owner' => $owner,
            'accid' => $accId,
        ]);
        $this->validation($this->rules(), $this->messages(), $parameters);

        return $this->sendRequest('POST', 'nimserver/team/updateTeamNick.action', $parameters);
    }

    /**
     * accid 对应的群昵称，最大长度32字符
     *
     * @param string $nick
     *
     * @return $this
     */
    public function setNick(string $nick)
    {
        $this->args['nick'] = $nick;

        return $this;
    }

    /**
     * 自定义扩展字段，最大长度1024字节
     *
     * @param string $custom
     *
     * @return $this
     */
    public function setCustom(string $custom)
    {
        $this->args['custom'] = $custom;

        return $this;
    }
    
    /**
     * @return array
     */
    private function rules()
    {
        return [
            'tid'    => 'required|string|max:128',
            'owner'  => 'required|string|max:32',
            'accid'  => 'required|string|max:32',
            'nick'   => 'sometimes|string|max:32',
            'custom' => 'sometimes|string|max:1024'
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
            'owner.required' => '群主 accid : ' . Translate::VALIDATE_REQUIRED,
            'owner.string'   => '群主 accid : ' . Translate::VALIDATE_STRING,
            'owner.max'      => '群主 accid : ' . Translate::VALIDATE_MAX_32,
            'accid.required' => '要修改群昵称的群成员 accid : ' . Translate::VALIDATE_REQUIRED,
            'accid.string'   => '要修改群昵称的群成员 accid : ' . Translate::VALIDATE_STRING,
            'accid.max'      => '要修改群昵称的群成员 accid : ' . Translate::VALIDATE_MAX_32,
            'nick.string'    => 'accid 对应的群昵称 : ' . Translate::VALIDATE_STRING,
            'nick.max'       => 'accid 对应的群昵称 : ' . Translate::VALIDATE_MAX_32,
            'custom.string'  => '自定义扩展字段 : ' . Translate::VALIDATE_STRING,
            'custom.max'     => '自定义扩展字段 : ' . Translate::VALIDATE_MAX_1024
        ];
    }
}