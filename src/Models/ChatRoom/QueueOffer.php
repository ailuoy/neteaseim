<?php
/**
 * Created by PhpStorm.
 * User: ailuoy
 * Date: 2019/5/18
 * Time: 下午6:52
 */

namespace Ailuoy\NeteaseIm\Models\ChatRoom;


use Ailuoy\NeteaseIm\Models\Model;
use Ailuoy\NeteaseIm\Translate;
use Illuminate\Validation\Rule;

class QueueOffer extends Model
{
    /**
     * 往聊天室有序队列中新加或更新元素
     *
     * @param int    $roomId
     * @param string $key
     * @param string $value
     *
     * @return mixed
     * @throws \Ailuoy\NeteaseIm\Exceptions\ParameterErrorException
     * @throws \Ailuoy\NeteaseIm\Exceptions\RequestErrorException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E8%81%8A%E5%A4%A9%E5%AE%A4?#%E5%BE%80%E8%81%8A%E5%A4%A9%E5%AE%A4%E6%9C%89%E5%BA%8F%E9%98%9F%E5%88%97%E4%B8%AD%E6%96%B0%E5%8A%A0%E6%88%96%E6%9B%B4%E6%96%B0%E5%85%83%E7%B4%A0
     */
    public function go(int $roomId, string $key, string $value)
    {
        $parameters = $this->mergeArgs([
            'roomid' => $roomId,
            'key'    => $key,
            'value'  => $value,
        ]);
        $this->validation($this->rules(), $this->messages(), $parameters);

        return $this->sendRequest('POST', 'nimserver/chatroom/queueOffer.action', $parameters);
    }

    /**
     * 提交这个新元素的操作者accid，默认为该聊天室的创建者，若operator对应的帐号不存在，会返回404错误。
     * 若指定的operator不在线，则添加元素成功后的通知事件中的操作者默认为聊天室的创建者；若指定的operator在线，则通知事件的操作者为operator。
     *
     * @param string $operator
     *
     * @return $this
     */
    public function setOperator(string $operator)
    {
        $this->args['operator'] = $operator;

        return $this;
    }

    /**
     * 这个新元素的提交者operator的所有聊天室连接在从该聊天室掉线或者离开该聊天室的时候，提交的元素是否需要删除。
     * true：需要删除；false：不需要删除。默认false。
     * 当指定该参数为true时，若operator当前不在该聊天室内，则会返回403错误。
     *
     * @param bool $transient
     *
     * @return $this
     */
    public function setTransient(bool $transient)
    {
        $this->args['transient'] = $transient ? 'true' : 'false';

        return $this;
    }

    /**
     * @return array
     */
    private function rules()
    {
        return [
            'roomid'    => 'required|integer',
            'key'       => 'required|string|max:128',
            'value'     => 'required|string|max:4096',
            'operator'  => 'sometimes|string',
            'transient' => [
                'sometimes',
                'string',
                Rule::in(['true', 'false'])
            ]
        ];
    }

    /**
     * @return array
     */
    private function messages()
    {
        return [
            'roomid.required'  => Translate::FIELD_CHATROOM_ROOM_ID . Translate::VALIDATE_REQUIRED,
            'roomid.integer'   => Translate::FIELD_CHATROOM_ROOM_ID . Translate::VALIDATE_INT,
            'key.required'     => '新元素的UniqKe : ' . Translate::VALIDATE_REQUIRED,
            'key.string'       => '新元素的UniqKe : ' . Translate::VALIDATE_STRING,
            'key.max'          => '新元素的UniqKe : ' . Translate::VALIDATE_MAX_128,
            'value.required'   => '新元素内容 : ' . Translate::VALIDATE_REQUIRED,
            'value.string'     => '新元素内容 : ' . Translate::VALIDATE_STRING,
            'value.max'        => '新元素内容 : ' . Translate::VALIDATE_MAX_4096,
            'operator.string'  => '提交这个新元素的操作者accid : ' . Translate::VALIDATE_STRING,
            'transient.string' => '这个新元素的提交者operator的所有聊天室连接在从该聊天室掉线或者离开该聊天室的时候，提交的元素是否需要删除 : ' . Translate::VALIDATE_STRING,
            'transient.in'     => '这个新元素的提交者operator的所有聊天室连接在从该聊天室掉线或者离开该聊天室的时候，提交的元素是否需要删除 : 值只能是 true|false'
        ];
    }
}