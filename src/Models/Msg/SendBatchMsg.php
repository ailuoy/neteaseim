<?php
/**
 * Created by PhpStorm.
 * User: ailuoy
 * Date: 2019/5/10
 * Time: 上午9:58
 */

namespace Ailuoy\NeteaseIm\Models\Msg;


use Ailuoy\NeteaseIm\Models\Model;
use Ailuoy\NeteaseIm\Translate;
use Illuminate\Validation\Rule;

class SendBatchMsg extends Model
{

    /**
     * 批量发送点对点普通消息
     *
     * @param  string  $fromAccId
     * @param  array   $toAccIds
     * @param  int     $type
     * @param  array   $body
     *
     * @return mixed
     * @throws \Ailuoy\NeteaseIm\Exceptions\ParameterErrorException
     * @throws \Ailuoy\NeteaseIm\Exceptions\RequestErrorException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E6%B6%88%E6%81%AF%E5%8A%9F%E8%83%BD?#%E6%89%B9%E9%87%8F%E5%8F%91%E9%80%81%E7%82%B9%E5%AF%B9%E7%82%B9%E6%99%AE%E9%80%9A%E6%B6%88%E6%81%AF
     */
    public function go(string $fromAccId, array $toAccIds, int $type, array $body)
    {
        if (isset($body['url'])) {
            $body['url'] = urlencode($body['url']);
        }
        if (isset($body['msg'])) {
            $body['msg'] = urlencode($body['msg']);
        }
        $parameters = $this->mergeArgs([
            'fromAccid' => $fromAccId,
            'toAccids'  => json_encode($toAccIds),
            'type'      => $type,
            'body'      => json_encode($body)
        ]);
        $this->validation($this->rules(), $this->messages(), $parameters);

        return $this->sendRequest('POST', 'nimserver/msg/sendBatchMsg.action', $parameters);
    }

    /**
     *   发消息时特殊指定的行为选项,JSON格式，可用于指定消息的漫游，存云端历史，发送方多端同步，推送，消息抄送等特殊行为;option中字段不填时表示默认值 ，option示例:
     *   {"push":false,"roam":true,"history":false,"sendersync":true,"route":false,"badge":false,"needPushNick":true}
     *   字段说明：
     *   1. roam: 该消息是否需要漫游，默认true（需要app开通漫游消息功能）；
     *   2. history: 该消息是否存云端历史，默认true；
     *   3. sendersync: 该消息是否需要发送方多端同步，默认true；
     *   4. push: 该消息是否需要APNS推送或安卓系统通知栏推送，默认true；
     *   5. route: 该消息是否需要抄送第三方；默认true (需要app开通消息抄送功能);
     *   6. badge:该消息是否需要计入到未读计数中，默认true;
     *   7. needPushNick: 推送文案是否需要带上昵称，不设置该参数时默认true;
     *   8. persistent: 是否需要存离线消息，不设置该参数时默认true。
     *
     * @param  array  $options
     *
     * @return $this
     */
    public function setOption(array $options)
    {
        $this->args['option'] = json_encode($options);

        return $this;
    }

    /**
     * 推送文案，android以此为推送显示文案；ios若未填写payload，显示文案以pushcontent为准。超过500字符后，会对文本进行截断。
     *
     * @param  string  $pushContent
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
     * @param  array  $payload
     *
     * @return $this
     */
    public function setPayload(array $payload)
    {
        $this->args['payload'] = json_encode($payload);

        return $this;
    }

    /**
     * 开发者扩展字段，长度限制1024字符
     *
     * @param  string  $ext
     *
     * @return $this
     */
    public function setExt(string $ext)
    {
        $this->args['ext'] = $ext;

        return $this;
    }


    /**
     * 可选，反垃圾业务ID，实现“单条消息配置对应反垃圾”，若不填则使用原来的反垃圾配置
     *
     * @param  string  $bid
     *
     * @return $this
     */
    public function setBid(string $bid)
    {
        $this->args['bid'] = $bid;

        return $this;
    }

    /**
     * 可选，单条消息是否使用易盾反垃圾，可选值为0。
     * 0：（在开通易盾的情况下）不使用易盾反垃圾而是使用通用反垃圾，包括自定义消息。
     * 若不填此字段，即在默认情况下，若应用开通了易盾反垃圾功能，则使用易盾反垃圾来进行垃圾消息的判断
     *
     * @param  int  $useYiDun
     *
     * @return $this
     */
    public function setUseYiDun(int $useYiDun)
    {
        $this->args['useYidun'] = $useYiDun;

        return $this;
    }

    /**
     * 是否需要返回消息ID
     * false：不返回消息ID（默认值）
     * true：返回消息ID（toAccids包含的账号数量不可以超过100个）
     *
     * @param  bool  $returnMsgId
     *
     * @return $this
     */
    public function setReturnMsgId($returnMsgId)
    {
        $this->args['returnMsgid'] = $returnMsgId;

        return $this;
    }

    /**
     * @return array
     */
    private function rules() : array
    {
        return [
            'fromAccid'   => 'required|string|max:32',
            'toAccids'    => 'required|json|max:500',
            'type'        => [
                'required',
                'integer',
                Rule::in([0, 1, 2, 3, 4, 6, 100])
            ],
            'body'        => 'required|string|max:5000',
            'option'      => 'sometimes|array',
            'pushcontent' => 'sometimes|string',
            'payload'     => 'sometimes|string',
            'ext'         => 'sometimes|string|max:1024',
            'bid'         => 'sometimes|string',
            'useYidun'    => [
                'sometimes',
                'integer',
                Rule::in([0])
            ],
            'returnMsgid' => [
                'sometimes',
                Rule::in(['true', 'false'])
            ],
        ];
    }

    /**
     * @return array
     */
    private function messages() : array
    {
        return [
            'fromAccid.required' => '发送者accid: 必须填写',
            'fromAccid.string'   => '发送者accid: 必须是字符串',
            'fromAccid.max'      => '发送者accid: ' . Translate::VALIDATE_MAX_32,
            'toAccids.required'  => '接受者accids: 必须填写',
            'toAccids.json'      => '接受者accids: 必须是json',
            'toAccids.max'       => '接受者accids: 数量最大500个',
            'type.required'      => '消息type: 必须填写',
            'type.integer'       => '消息type: 必须是整型',
            'type.in'            => '消息type: 值不正确',
            'body.required'      => '消息body: 必须填写',
            'body.string'        => '消息body: 必须是字符串',
            'body.max'           => '消息body: 最大5000字符',
            'option.array'       => '发消息时特殊指定的行为选项: 类型必须是数组',
            'pushcontent.string' => '推送文案: 必须是字符串',
            'payload.json'       => 'ios 推送对应的payload : 类型必须是json',
            'ext.string'         => '开发者扩展字段: 必须字符串',
            'ext.max'            => '开发者扩展字段: ' . Translate::VALIDATE_MAX_1024,
            'bid.string'         => '可选，反垃圾业务ID: 必须是字符串',
            'useYidun.integer'   => '单条消息是否使用易盾反垃圾: 必须是整型',
            'useYidun.in'        => '单条消息是否使用易盾反垃圾: 值只能是0',
            'returnMsgid.in'     => '单条消息是否使用易盾反垃圾: 值只能是字符串true|false',
        ];
    }
}