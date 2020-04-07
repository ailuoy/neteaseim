<?php
/**
 * Created by PhpStorm.
 * User: ailuoy
 * Date: 2019/5/11
 * Time: 下午12:54
 */

namespace Ailuoy\NeteaseIm\Models\Msg;


use Ailuoy\NeteaseIm\Models\Model;
use Ailuoy\NeteaseIm\Translate;
use Illuminate\Validation\Rule;

class Recall extends Model
{
    /**
     * 消息撤回
     *
     * @param string $deleteMsgId
     * @param int    $timeTag
     * @param int    $type
     * @param string $from
     * @param string $to
     *
     * @return mixed
     * @throws \Ailuoy\NeteaseIm\Exceptions\ParameterErrorException
     * @throws \Ailuoy\NeteaseIm\Exceptions\RequestErrorException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E6%B6%88%E6%81%AF%E5%8A%9F%E8%83%BD?#%E6%B6%88%E6%81%AF%E6%92%A4%E5%9B%9E
     */
    public function go(string $deleteMsgId, int $timeTag, int $type, string $from, string $to)
    {
        $parameters = $this->mergeArgs([
            'deleteMsgid' => $deleteMsgId,
            'timetag'     => $timeTag,
            'type'        => $type,
            'from'        => $from,
            'to'          => $to,
        ]);
        $this->validation($this->rules(), $this->messages(), $parameters);

        return $this->sendRequest('POST', 'nimserver/msg/recall.action', $parameters);
    }

    public function setMsg(string $msg)
    {
        $this->args['msg'] = $msg;

        return $this;
    }

    public function setIgnoreTime(string $ignoreTime)
    {
        $this->args['ignoreTime'] = $ignoreTime;

        return $this;
    }

    /**
     * 推送文案，android以此为推送显示文案；ios若未填写payload，显示文案以pushcontent为准。超过500字符后，会对文本进行截断。
     *
     * @param string $pushContent
     *
     * @return $this
     */
    public function setPushContent(string $pushContent)
    {
        $this->args['pushcontent'] = $pushContent;

        return $this;
    }

    /**
     * ios 推送对应的payload,必须是JSON,不能超过2k字符
     *
     * @param array $payload
     *
     * @return $this
     */
    public function setPayload(array $payload)
    {
        $this->args['payload'] = json_encode($payload);

        return $this;
    }

    /**
     * @return array
     */
    private function rules(): array
    {
        return [
            'deleteMsgid' => 'required|string',
            'timetag'     => 'required|integer',
            'type'        => [
                'required',
                'integer',
                Rule::in([7, 8])
            ],
            'from'        => 'required|string',
            'to'          => 'required|string',
            'msg'         => 'sometimes|string',
            'ignoreTime'  => [
                'sometimes',
                'string',
                Rule::in(['1'])
            ],
            'pushcontent' => 'sometimes|string|max:500',
            'payload'     => 'sometimes|json',
        ];
    }

    /**
     * @return array
     */
    private function messages(): array
    {
        return [
            'deleteMsgid.required' => '要撤回消息的msgid : ' . Translate::VALIDATE_REQUIRED,
            'deleteMsgid.string'   => '要撤回消息的msgid : ' . Translate::VALIDATE_STRING,
            'timetag.required'     => '要撤回消息的创建时间 : ' . Translate::VALIDATE_REQUIRED,
            'timetag.integer'      => '要撤回消息的创建时间 : ' . Translate::VALIDATE_INT,
            'type.required'        => '消息撤回类型 : ' . Translate::VALIDATE_REQUIRED,
            'type.integer'         => '消息撤回类型 : ' . Translate::VALIDATE_INT,
            'type.in'              => '消息撤回类型 : 值类型只能是 7|8',
            'from.required'        => '发消息的accid : ' . Translate::VALIDATE_REQUIRED,
            'from.string'          => '发消息的accid : ' . Translate::VALIDATE_STRING,
            'to.required'          => '接收消息id : ' . Translate::VALIDATE_REQUIRED,
            'to.string'            => '接收消息id : ' . Translate::VALIDATE_STRING,
            'msg.string'           => '对应的描述 : ' . Translate::VALIDATE_STRING,
            'ignoreTime.string'    => '略撤回时间检测 : ' . Translate::VALIDATE_STRING,
            'ignoreTime.in'        => '略撤回时间检测 : 值只能是 1',
            'pushcontent.string'   => '推送文案: 类型必须是字符串',
            'pushcontent.max'      => '推送文案: 最大500字符',
            'payload.json'         => 'ios 推送对应的payload: 类型必须是json'
        ];
    }
}