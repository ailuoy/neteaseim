<?php
/**
 * Created by PhpStorm.
 * User: ailuoy
 * Date: 2019/5/18
 * Time: 下午11:05
 */

namespace Ailuoy\NeteaseIm\Models\ChatRoom;


use Ailuoy\NeteaseIm\Models\Model;
use Ailuoy\NeteaseIm\Translate;
use Illuminate\Validation\Rule;

class QueueBatchUpdateElements extends Model
{
    /**
     * 批量更新聊天室队列元素
     *
     * @param int    $roomId
     * @param string $operator
     * @param array  $elements
     *
     * @return mixed
     * @throws \Ailuoy\NeteaseIm\Exceptions\ParameterErrorException
     * @throws \Ailuoy\NeteaseIm\Exceptions\RequestErrorException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function go(int $roomId, string $operator, array $elements)
    {
        $parameters = $this->mergeArgs([
            'roomid'   => $roomId,
            'operator' => $operator,
            'elements' => json_encode($elements),
        ]);

        $this->validation($this->rules(), $this->messages(), $parameters);

        return $this->sendRequest('POST', 'nimserver/chatroom/queueBatchUpdateElements.action', $parameters);
    }

    /**
     * true或false,是否需要发送更新通知事件，默认true
     *
     * @param bool $needNotify
     *
     * @return $this
     */
    public function setNeedNotify(bool $needNotify)
    {
        $this->args['needNotify'] = $needNotify;

        return $this;
    }

    /**
     * 通知事件扩展字段，长度限制2048
     *
     * @param string $notifyExt
     *
     * @return $this
     */
    public function setNotifyExt(string $notifyExt)
    {
        $this->args['notifyExt'] = $notifyExt;

        return $this;
    }

    /**
     * @return array
     */
    private function rules()
    {
        return [
            'roomid'     => 'required|integer',
            'operator'   => 'required|string',
            'elements'   => 'required|json',
            'needNotify' => [
                'sometimes',
                'boolean',
                Rule::in([true, false])
            ],
            'notifyExt'  => 'sometimes|string|max:2048',
        ];
    }

    /**
     * @return array
     */
    private function messages()
    {
        return [
            'roomid.required'    => Translate::FIELD_CHATROOM_ROOM_ID . Translate::VALIDATE_REQUIRED,
            'roomid.integer'     => Translate::FIELD_CHATROOM_ROOM_ID . Translate::VALIDATE_INT,
            'operator.required'  => '操作者accid,必须是管理员或创建者 : ' . Translate::VALIDATE_REQUIRED,
            'operator.string'    => '操作者accid,必须是管理员或创建者 : ' . Translate::VALIDATE_STRING,
            'elements.required'  => '更新的key-value对 : ' . Translate::VALIDATE_REQUIRED,
            'elements.json'      => '更新的key-value对 : ' . Translate::VALIDATE_JSON,
            'needNotify.boolean' => '是否需要发送更新通知事件 : ' . Translate::VALIDATE_STRING,
            'needNotify.in'      => '是否需要发送更新通知事件 : 值只能是布尔型的 true | false',
            'notifyExt.string'   => '通知事件扩展字段 : ' . Translate::VALIDATE_STRING,
            'notifyExt.max'      => '通知事件扩展字段 : ' . Translate::VALIDATE_MAX_2048,
        ];
    }
}