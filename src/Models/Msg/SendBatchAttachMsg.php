<?php
/**
 * Created by PhpStorm.
 * User: ailuoy
 * Date: 2019/5/11
 * Time: 上午9:26
 */

namespace Ailuoy\NeteaseIm\Models\Msg;


use Ailuoy\NeteaseIm\Models\Model;
use Ailuoy\NeteaseIm\Translate;
use Illuminate\Validation\Rule;

class SendBatchAttachMsg extends Model
{
    /**
     * 批量发送点对点自定义系统通知
     *
     * @param string $fromAccId
     * @param array  $toAccIds
     * @param string $attach
     *
     * @return mixed
     * @throws \Ailuoy\NeteaseIm\Exceptions\ParameterErrorException
     * @throws \Ailuoy\NeteaseIm\Exceptions\RequestErrorException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E6%B6%88%E6%81%AF%E5%8A%9F%E8%83%BD?#%E6%89%B9%E9%87%8F%E5%8F%91%E9%80%81%E7%82%B9%E5%AF%B9%E7%82%B9%E8%87%AA%E5%AE%9A%E4%B9%89%E7%B3%BB%E7%BB%9F%E9%80%9A%E7%9F%A5
     */
    public function go(string $fromAccId, array $toAccIds, string $attach)
    {
        $parameters = $this->mergeArgs([
            'fromAccid' => $fromAccId,
            'toAccids'  => json_encode($toAccIds),
            'attach'    => $attach
        ]);
        $this->validation($this->rules(), $this->messages(), $parameters);

        return $this->sendRequest('POST', 'nimserver/msg/sendBatchAttachMsg.action', $parameters);
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
     * 如果有指定推送，此属性指定为客户端本地的声音文件名，长度不要超过30个字符，如果不指定，会使用默认声音
     *
     * @param string $sound
     *
     * @return $this
     */
    public function setSound(string $sound)
    {
        $this->args['sound'] = $sound;

        return $this;
    }

    /**
     * 1表示只发在线，2表示会存离线，其他会报414错误。默认会存离线
     *
     * @param int $save
     *
     * @return $this
     */
    public function setSave(int $save)
    {
        $this->args['save'] = $save;

        return $this;
    }

    /**
     * 发消息时特殊指定的行为选项,Json格式，可用于指定消息计数等特殊行为;option中字段不填时表示默认值。
     * option示例：
     * {"badge":false,"needPushNick":false,"route":false}
     * 字段说明：
     * 1. badge:该消息是否需要计入到未读计数中，默认true;
     * 2. needPushNick: 推送文案是否需要带上昵称，不设置该参数时默认false(ps:注意与sendMsg.action接口有别);
     * 3. route: 该消息是否需要抄送第三方；默认true (需要app开通消息抄送功能)
     *
     * @param array $options
     *
     * @return $this
     */
    public function setOption(array $options)
    {
        $this->args['option'] = json_encode($options);

        return $this;
    }

    /**
     * @return array
     */
    private function rules(): array
    {
        return [
            'fromAccid'   => 'required|string|max:32',
            'toAccids'    => 'required|json',
            'attach'      => 'required|string|max:4096',
            'pushcontent' => 'sometimes|string|max:500',
            'payload'     => 'sometimes|json',
            'sound'       => 'sometimes|string|max:30',
            'save'        => [
                'sometimes',
                'integer',
                Rule::in([1, 2])
            ],
            'option'      => 'sometimes|json',
        ];
    }

    /**
     * @return array
     */
    private function messages(): array
    {
        return [
            'fromAccid.required' => '发送者accid : ' . Translate::VALIDATE_REQUIRED,
            'fromAccid.string'   => '发送者accid : ' . Translate::VALIDATE_STRING,
            'fromAccid.max'      => '发送者accid : ' . Translate::VALIDATE_MAX_32,
            'toAccids.required'  => '接受者id : ' . Translate::VALIDATE_REQUIRED,
            'toAccids.json'      => '接受者id : ' . Translate::VALIDATE_JSON,
            'attach.required'    => '自定义通知内容 : ' . Translate::VALIDATE_REQUIRED,
            'attach.string'      => '自定义通知内容 : ' . Translate::VALIDATE_STRING,
            'attach.max'         => '自定义通知内容 : ' . Translate::VALIDATE_MAX_4096,
            'pushcontent.string' => '推送文案 : ' . Translate::VALIDATE_STRING,
            'pushcontent.max'    => '推送文案 : 最大500个字符',
            'payload.json'       => 'ios 推送对应的payload : 类型必须是json',
            'sound.string'       => '本地声音文件名 : ' . Translate::VALIDATE_STRING,
            'sound.max'          => '本地声音文件名 : 最大30个字符',
            'save.integer'       => '在线|离线状态 : ' . Translate::VALIDATE_INT,
            'save.in'            => '在线|离线状态 : 值类型必须是 1|2 ',
            'option.json'        => '发消息时特殊指定的行为选项 : 类型必须是json',
        ];
    }
}