<?php
/**
 * Created by PhpStorm.
 * User: ailuoy
 * Date: 2019/5/15
 * Time: 下午11:04
 */

namespace Ailuoy\NeteaseIm\Models\ChatRoom;


use Ailuoy\NeteaseIm\Models\Model;
use Ailuoy\NeteaseIm\Translate;
use Illuminate\Validation\Rule;

class SetMemberRole extends Model
{
    /**
     * @param int    $roomId
     * @param string $operator
     * @param string $target
     * @param int    $opt
     * @param bool   $optValue
     *
     * @return mixed
     * https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E8%81%8A%E5%A4%A9%E5%AE%A4?#%E8%AE%BE%E7%BD%AE%E8%81%8A%E5%A4%A9%E5%AE%A4%E5%86%85%E7%94%A8%E6%88%B7%E8%A7%92%E8%89%B2
     */
    public function go(int $roomId, string $operator, string $target, int $opt, bool $optValue)
    {
        $parameters = $this->mergeArgs([
            'roomid'   => $roomId,
            'operator' => $operator,
            'target'   => $target,
            'opt'      => $opt,
            'optvalue' => $optValue ? 'true' : 'false',
        ]);

        $this->validation($this->rules(), $this->messages(), $parameters);

        return $this->sendRequest('POST', 'nimserver/chatroom/setMemberRole.action', $parameters);
    }

    /**
     * 通知事件扩展字段，长度限制2048
     *
     * @param array $notifyExt
     *
     * @return $this
     */
    public function setNotifyExt(array $notifyExt)
    {
        $this->args['notifyExt'] = json_encode($notifyExt);

        return $this;
    }

    /**
     * @return array
     */
    private function rules()
    {
        return [
            'roomid'    => 'required|integer',
            'operator'  => 'required|string',
            'target'    => 'required|string',
            'opt'       => [
                'required',
                'integer',
                Rule::in([1, 2, -1, -2])
            ],
            'optvalue'  => [
                'required',
                'string',
                Rule::in(['true', 'false'])
            ],
            'notifyExt' => 'sometimes|json|max:2048'
        ];
    }

    /**
     * @return array
     */
    private function messages()
    {
        return [
            'roomid.required'   => Translate::FIELD_CHATROOM_ROOM_ID . Translate::VALIDATE_REQUIRED,
            'roomid.integer'    => Translate::FIELD_CHATROOM_ROOM_ID . Translate::VALIDATE_INT,
            'operator.required' => '操作者账号accid : ' . Translate::VALIDATE_REQUIRED,
            'operator.string'   => '操作者账号accid : ' . Translate::VALIDATE_STRING,
            'target.required'   => '被操作者账号accid : ' . Translate::VALIDATE_REQUIRED,
            'target.string'     => '被操作者账号accid : ' . Translate::VALIDATE_STRING,
            'opt.required'      => '操作 : ' . Translate::VALIDATE_REQUIRED,
            'opt.integer'       => '操作 : ' . Translate::VALIDATE_INT,
            'opt.in'            => '操作 : 值只能是 1 | 2 | -1 | -2',
            'optvalue.required' => '设置 : ' . Translate::VALIDATE_REQUIRED,
            'optvalue.string'   => '设置 : ' . Translate::VALIDATE_STRING,
            'optvalue.in'       => '设置 : 值只能是 false | true',
            'notifyExt.json'    => '通知扩展字段 : ' . Translate::VALIDATE_JSON,
            'notifyExt.max'     => '通知扩展字段 : ' . Translate::VALIDATE_MAX_2048
        ];
    }
}