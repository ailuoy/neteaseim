<?php
/**
 * Created by PhpStorm.
 * User: ailuoy
 * Date: 2019/5/12
 * Time: 下午9:13
 */

namespace Ailuoy\NeteaseIm\Models\Team;


use Ailuoy\NeteaseIm\Models\Model;
use Ailuoy\NeteaseIm\Translate;
use Illuminate\Validation\Rule;

class MuteTListAll extends Model
{
    /**
     * 将群组整体禁言
     *
     * @param string $tid
     * @param string $owner
     *
     * @return mixed
     * https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E7%BE%A4%E7%BB%84%E5%8A%9F%E8%83%BD%EF%BC%88%E9%AB%98%E7%BA%A7%E7%BE%A4%EF%BC%89?#%E5%B0%86%E7%BE%A4%E7%BB%84%E6%95%B4%E4%BD%93%E7%A6%81%E8%A8%80
     */
    public function go(string $tid, string $owner)
    {
        $parameters = $this->mergeArgs([
            'tid'   => $tid,
            'owner' => $owner
        ]);
        $this->validation($this->rules(), $this->messages(), $parameters);

        return $this->sendRequest('POST', 'nimserver/team/muteTlistAll.action', $parameters);
    }

    /**
     * true:禁言，false:解禁(mute和muteType至少提供一个，都提供时按mute处理)
     *
     * @param bool $mute
     *
     * @return $this
     */
    public function setMute(bool $mute)
    {
        $this->args['mute'] = $mute ? 'true' : 'false';

        return $this;
    }

    /**
     * 禁言类型 0:解除禁言，1:禁言普通成员 3:禁言整个群(包括群主)
     *
     * @param int $muteType
     *
     * @return $this
     */
    public function setMuteType(int $muteType)
    {
        $this->args['muteType'] = $muteType;

        return $this;
    }

    /**
     * @return array
     */
    private function rules()
    {
        return [
            'tid'      => 'required|string',
            'owner'    => 'required|string|max:32',
            'mute'     => [
                'sometimes',
                'string',
                Rule::in(['true', 'false'])
            ],
            'muteType' => [
                'sometimes',
                'integer',
                Rule::in([0, 1, 3])
            ]
        ];
    }

    /**
     * @return array
     */
    private function messages()
    {
        return [
            'tid.required'     => '群id : ' . Translate::VALIDATE_REQUIRED,
            'tid.string'       => '群id : ' . Translate::VALIDATE_STRING,
            'owner.required'   => '群主用户帐号 : ' . Translate::VALIDATE_REQUIRED,
            'owner.string'     => '群主用户帐号 : ' . Translate::VALIDATE_STRING,
            'owner.max'        => '群主用户帐号 : ' . Translate::VALIDATE_MAX_32,
            'mute.string'      => '禁言 | 解禁 : ' . Translate::VALIDATE_STRING,
            'mute.in'          => '禁言 | 解禁 : 值只能是字符串的 true | false',
            'muteType.integer' => '禁言类型 : ' . Translate::VALIDATE_INT,
            'muteType.in'      => '禁言类型 : 值只能是字符串的 0 | 1 | 3',
        ];
    }
}