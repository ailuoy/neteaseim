<?php
/**
 * Created by PhpStorm.
 * User: ailuoy
 * Date: 2019/5/12
 * Time: 下午9:23
 */

namespace Ailuoy\NeteaseIm\Models\Team;


use Ailuoy\NeteaseIm\Models\Model;
use Ailuoy\NeteaseIm\Translate;

class ListTeamMute extends Model
{
    /**
     * 获取群组禁言列表
     *
     * @param string $tid
     * @param string $owner
     *
     * @return mixed
     * https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E7%BE%A4%E7%BB%84%E5%8A%9F%E8%83%BD%EF%BC%88%E9%AB%98%E7%BA%A7%E7%BE%A4%EF%BC%89?#%E8%8E%B7%E5%8F%96%E7%BE%A4%E7%BB%84%E7%A6%81%E8%A8%80%E5%88%97%E8%A1%A8
     */
    public function go(string $tid, string $owner)
    {
        $parameters = [
            'tid'   => $tid,
            'owner' => $owner
        ];
        $this->validation($this->rules(), $this->messages(), $parameters);

        return $this->sendRequest('POST', 'nimserver/team/listTeamMute.action', $parameters);
    }

    /**
     * @return array
     */
    private function rules()
    {
        return [
            'tid'   => 'required|string',
            'owner' => 'required|string|max:32'
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
            'owner.required' => '群主用户帐号 : ' . Translate::VALIDATE_REQUIRED,
            'owner.string'   => '群主用户帐号 : ' . Translate::VALIDATE_STRING,
            'owner.max'      => '群主用户帐号 : ' . Translate::VALIDATE_MAX_32
        ];
    }
}