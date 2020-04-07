<?php
/**
 * Created by PhpStorm.
 * User: ailuoy
 * Date: 2019/5/16
 * Time: 上午9:09
 */

namespace Ailuoy\NeteaseIm\Models\ChatRoom;


use Ailuoy\NeteaseIm\Models\Model;
use Ailuoy\NeteaseIm\Translate;
use Illuminate\Validation\Rule;
use Ailuoy\NeteaseIm\Exceptions\ParameterErrorException;

class SendMsg extends Model
{
    /**
     * 发送聊天室消息
     *
     * @param  int     $roomId
     * @param  string  $msgId
     * @param  string  $fromAccId
     * @param  int     $msgType
     *
     * @return mixed
     * @throws ParameterErrorException
     * @throws \Ailuoy\NeteaseIm\Exceptions\RequestErrorException
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E8%81%8A%E5%A4%A9%E5%AE%A4?#%E5%8F%91%E9%80%81%E8%81%8A%E5%A4%A9%E5%AE%A4%E6%B6%88%E6%81%AF
     */
    public function go(int $roomId, string $msgId, string $fromAccId, int $msgType)
    {
        $parameters = $this->mergeArgs([
            'roomid'    => $roomId,
            'msgId'     => $msgId,
            'fromAccid' => $fromAccId,
            'msgType'   => $msgType,
        ]);
        $this->validation($this->rules(), $this->messages(), $parameters);

        return $this->sendRequest('POST', 'nimserver/chatroom/sendMsg.action', $parameters);
    }

    /**
     * 重发消息标记，0：非重发消息，1：重发消息，如重发消息会按照msgid检查去重逻辑
     *
     * @param  int  $resendFlag
     *
     * @return $this
     */
    public function setResendFlag(int $resendFlag)
    {
        $this->args['resendFlag'] = $resendFlag;

        return $this;
    }

    /**
     * 消息内容，格式同消息格式示例中的body字段,长度限制4096字符
     *
     * @param  array  $attach
     *
     * @return $this
     */
    public function setAttach(array $attach)
    {
        $this->args['attach'] = json_encode($attach);

        return $this;
    }

    /**
     * 消息扩展字段，内容可自定义，请使用JSON格式，长度限制4096字符
     *
     * @param  array  $ext
     *
     * @return $this
     */
    public function setExt(array $ext)
    {
        $this->args['ext'] = json_encode($ext);

        return $this;
    }

    /**
     * 对于对接了易盾反垃圾功能的应用，本消息是否需要指定经由易盾检测的内容（antispamCustom）。
     * true或false, 默认false。
     * 只对消息类型为：100 自定义消息类型 的消息生效。
     *
     * @param  bool  $antispam
     *
     * @return $this
     */
    public function setAntispam(bool $antispam)
    {
        $this->args['antispam'] = $antispam ? 'true' : 'false';

        return $this;
    }

    /**
     * 在antispam参数为true时生效。
     * 自定义的反垃圾检测内容, JSON格式，长度限制同body字段，不能超过5000字符，要求antispamCustom格式如下：
     * {"type":1,"data":"custom content"}
     * 字段说明：
     * 1. type: 1：文本，2：图片。
     * 2. data: 文本内容or图片地址。
     *
     * @param  int     $type
     * @param  string  $data
     *
     * @return $this
     * @throws ParameterErrorException
     */
    public function setAntispamCustom(int $type, string $data)
    {
        if (!in_array($type, [1, 2])) {
            throw new ParameterErrorException('type 值只能是 1|2');
        }
        $this->args['antispamCustom'] = json_encode([
            'type' => $type,
            'data' => $data
        ]);

        return $this;
    }

    /**
     * 是否跳过存储云端历史，0：不跳过，即存历史消息；1：跳过，即不存云端历史；默认0
     *
     * @param  int  $skipHistory
     *
     * @return $this
     * @throws ParameterErrorException
     */
    public function setSkipHistory(int $skipHistory)
    {
        if (!in_array($skipHistory, [0, 1])) {
            throw new ParameterErrorException('skipHistory 值只能是 0|1');
        }

        $this->args['skipHistory'] = $skipHistory;

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
     * 可选，true表示是高优先级消息，云信会优先保障投递这部分消息；false表示低优先级消息。默认false。
     * 强烈建议应用恰当选择参数，以便在必要时，优先保障应用内的高优先级消息的投递。若全部设置为高优先级，则等于没有设置。
     *
     * @param  bool  $highPriority
     *
     * @return $this
     */
    public function setHighPriority(bool $highPriority)
    {
        $this->args['highPriority'] = $highPriority;

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
     * @throws ParameterErrorException
     */
    public function setUseYidun(int $useYiDun)
    {
        if (!in_array($useYiDun, [0])) {
            throw new ParameterErrorException('useYidun 值只能是 0');
        }
        $this->args['useYidun'] = $useYiDun;

        return $this;
    }

    /**
     * 可选，true表示会重发消息，false表示不会重发消息。默认true
     *
     * @param  bool  $needHighPriorityMsgResend
     *
     * @return $this
     */
    public function setNeedHighPriorityMsgResend(bool $needHighPriorityMsgResend)
    {
        $this->args['needHighPriorityMsgResend'] = $needHighPriorityMsgResend;

        return $this;
    }

    /**
     * 可选，消息丢弃的概率。取值范围[0-9999]；
     * 其中0代表不丢弃消息，9999代表99.99%的概率丢弃消息，默认不丢弃；
     * 注意如果填写了此参数，highPriority参数则会无效；
     * 此参数可用于流控特定业务类型的消息。
     *
     * @param  int  $abandonRatio
     *
     * @return $this
     * @throws ParameterErrorException
     */
    public function setAbandonRatio(int $abandonRatio)
    {
        if ($abandonRatio < 0 || $abandonRatio > 9999) {
            throw new ParameterErrorException('消息丢弃的概率 :  取值范围[0-9999]');
        }
        $this->args['abandonRatio'] = $abandonRatio;

        return $this;
    }

    /**
     * @return array
     */
    private function rules() : array
    {
        return [
            'roomid'                    => 'required|numeric',
            'msgId'                     => 'required|string',
            'fromAccid'                 => 'required|string',
            'msgType'                   => [
                'required',
                'integer',
                Rule::in([0, 1, 2, 3, 4, 6, 10, 100])
            ],
            'resendFlag'                => [
                'sometimes',
                'integer',
                Rule::in([0, 1])
            ],
            'attach'                    => 'sometimes|max:4096',
            'ext'                       => 'sometimes|json|max:4096',
            'antispam'                  => [
                'sometimes',
                'string',
                Rule::in(['true', 'false'])
            ],
            'antispamCustom'            => 'sometimes|json|max:5000',
            'skipHistory'               => [
                'sometimes',
                'integer',
                Rule::in([0, 1])
            ],
            'bid'                       => 'sometimes|string',
            'highPriority'              => [
                'sometimes',
                'boolean',
                Rule::in([true, false])
            ],
            'useYidun'                  => [
                'sometimes',
                'integer',
                Rule::in([0])
            ],
            'needHighPriorityMsgResend' => [
                'sometimes',
                'boolean',
                Rule::in([true, false])
            ],
            'abandonRatio'              => 'sometimes|integer|min:0|max:999'
        ];
    }

    /**
     * @return array
     */
    private function messages() : array
    {
        return [
            'roomid.required'      => Translate::FIELD_CHATROOM_ROOM_ID . Translate::VALIDATE_REQUIRED,
            'roomid.numeric'       => Translate::FIELD_CHATROOM_ROOM_ID . Translate::VALIDATE_INT,
            'msgId.required'       => '客户端消息id : ' . Translate::VALIDATE_REQUIRED,
            'msgId.string'         => '客户端消息id : ' . Translate::VALIDATE_STRING,
            'fromAccid.required'   => '消息发出者的账号accid : ' . Translate::VALIDATE_REQUIRED,
            'fromAccid.string'     => '消息发出者的账号accid : ' . Translate::VALIDATE_STRING,
            'msgType.required'     => '消息类型 : ' . Translate::VALIDATE_REQUIRED,
            'msgType.integer'      => '消息类型 : ' . Translate::VALIDATE_INT,
            'msgType.in'           => '消息类型 : 值只能是 0,1,2,3,4,6,10,100',
            'resendFlag.integer'   => '重发消息标记 : ' . Translate::VALIDATE_INT,
            'resendFlag.in'        => '重发消息标记 : 值只能是 0,1',
            'attach.string'        => '消息内容 : ' . Translate::VALIDATE_STRING,
            'attach.max'           => '消息内容 : ' . Translate::VALIDATE_MAX_4096,
            'ext.json'             => '消息扩展字段 : ' . Translate::VALIDATE_JSON,
            'ext.max'              => '消息扩展字段 : ' . Translate::VALIDATE_MAX_4096,
            'antispam.string'      => '本消息是否需要指定经由易盾检测的内容 : ' . Translate::VALIDATE_STRING,
            'antispam.in'          => '本消息是否需要指定经由易盾检测的内容 : 值只能是字符串的true|false',
            'antispamCustom.json'  => '自定义的反垃圾检测内容 : ' . Translate::VALIDATE_JSON,
            'antispamCustom.max'   => '自定义的反垃圾检测内容 : 最大5000字符',
            'skipHistory.integer'  => '是否跳过存储云端历史 : ' . Translate::VALIDATE_INT,
            'skipHistory.in'       => '是否跳过存储云端历史 : 值只能是整型的0,1',
            'bid.string'           => '反垃圾业务ID : ' . Translate::VALIDATE_STRING,
            'highPriority.boolean' => '消息优先级 : ' . Translate::VALIDATE_BOOLEAN,
            'highPriority.in'      => '消息优先级 : 值只能是布尔的true|false',
            'useYidun.integer'     => '单条消息是否使用易盾反垃圾 : ' . Translate::VALIDATE_INT,
            'useYidun.in'          => '单条消息是否使用易盾反垃圾 : 值只能是0',
            'highPriority.boolean' => '消息是否重发 : ' . Translate::VALIDATE_BOOLEAN,
            'highPriority.in'      => '消息是否重发 : 值只能是布尔的true|false',
            'abandonRatio.integer' => '消息丢弃的概率 : 值只能是整型' . Translate::VALIDATE_INT,
            'abandonRatio.min'     => '消息丢弃的概率 : 只最小是0',
            'abandonRatio.max'     => '消息丢弃的概率 : 只最大是9999',
        ];
    }
}