<?php
/**
 * Created by PhpStorm.
 * User: ailuoy
 * Date: 2019/5/11
 * Time: 下午3:16
 */

namespace Ailuoy\NeteaseIm\Models\Team;


use Ailuoy\NeteaseIm\Models\Model;
use Ailuoy\NeteaseIm\Translate;

class Remove extends Model
{
    /**
     * 解散群
     *
     * @param string $tid
     * @param string $owner
     *
     * @return mixed
     */
    public function go(string $tid, string $owner)
    {
        $parameters = ['tid' => $tid, 'owner' => $owner];
        $this->validation($this->rules(), $this->messages(), $parameters);

        return $this->sendRequest('POST', 'nimserver/team/remove.action', $parameters);
    }

    private function rules()
    {
        return [
            'tid'   => 'required|string|max:128',
            'owner' => 'required|string|max:32',
        ];
    }

    private function messages()
    {
        return [
            'tid.required'   => '网易云通信team_id : ' . Translate::VALIDATE_REQUIRED,
            'tid.string'     => '网易云通信team_id : ' . Translate::VALIDATE_STRING,
            'tid.max'        => '网易云通信team_id : ' . Translate::VALIDATE_MAX_128,
            'owner.required' => '群主用户帐号 : ' . Translate::VALIDATE_REQUIRED,
            'owner.string'   => '群主用户帐号 : ' . Translate::VALIDATE_STRING,
            'owner.max'      => '群主用户帐号 : ' . Translate::VALIDATE_MAX_32,
        ];
    }
}