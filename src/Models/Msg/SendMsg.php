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

class SendMsg extends Model
{
    /**
     * 发送普通消息
     *
     * @param  string  $from  发送者accid，用户帐号，最大32字符，必须保证一个APP内唯一
     * @param  int     $ope   0：点对点个人消息，1：群消息（高级群），其他返回414
     * @param  string  $to    ope==0是表示accid即用户id，ope==1表示tid即群id
     * @param  int     $type
     *                        0 表示文本消息,
     *                        1 表示图片，
     *                        2 表示语音，
     *                        3 表示视频，
     *                        4 表示地理位置信息，
     *                        6 表示文件，
     *                        100 自定义消息类型（特别注意，对于未对接易盾反垃圾功能的应用，该类型的消息不会提交反垃圾系统检测）
     * @param  array   $body  最大长度5000字符，JSON格式。
     *
     * @return mixed
     * @throws \Ailuoy\NeteaseIm\Exceptions\ParameterErrorException
     * @throws \Ailuoy\NeteaseIm\Exceptions\RequestErrorException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E6%B6%88%E6%81%AF%E5%8A%9F%E8%83%BD?#%E5%8F%91%E9%80%81%E6%99%AE%E9%80%9A%E6%B6%88%E6%81%AF
     *
     */
    public function go(string $from, int $ope, string $to, int $type, array $body)
    {
        if (isset($body['url'])) {
            $body['url'] = urlencode($body['url']);
        }
        if (isset($body['msg'])) {
            $body['msg'] = urlencode($body['msg']);
        }
        $parameters = $this->mergeArgs([
            'from' => $from,
            'ope'  => $ope,
            'to'   => $to,
            'type' => $type,
            'body' => json_encode($body)
        ]);
        $this->validation($this->rules(), $this->messages(), $parameters);

        return $this->sendRequest('POST', 'nimserver/msg/sendMsg.action', $parameters);
    }

    /**
     *
     * 对于对接了易盾反垃圾功能的应用，本消息是否需要指定经由易盾检测的内容（antispamCustom）。
     * true或false, 默认false。
     * 只对消息类型为：100 自定义消息类型 的消息生效。
     *
     * @param  bool  $boolean
     *
     * @return $this
     */
    public function setAntisPam(bool $boolean)
    {
        $this->args['antispam'] = $boolean ? 'true' : 'false';

        return $this;
    }

    /**
     * 在antispam参数为true时生效。
     * 自定义的反垃圾检测内容, JSON格式，长度限制同body字段，不能超过5000字符，要求antispamCustom格式如下：
     * {"type":1,"data":"custom content"}
     * 字段说明：
     *    1. type: 1：文本，2：图片。
     *    2. data: 文本内容or图片地址。
     *
     * @param  array  $arr
     *
     * @return $this
     */
    public function setAntisPamCustom(array $arr)
    {
        $this->args['antispamCustom'] = json_encode($arr);

        return $this;
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
     * 发送群消息时的强推（@操作）用户列表，格式为JSONArray，如["accid1","accid2"]。若forcepushall为true，则forcepushlist为除发送者外的所有有效群成员
     *
     * @param  array  $forcePushList
     *
     * @return $this
     */
    public function setForcePushList(array $forcePushList)
    {
        $this->args['forcepushlist'] = json_encode($forcePushList);

        return $this;
    }

    /**
     * 发送群消息时，针对强推（@操作）列表forcepushlist中的用户，强制推送的内容
     *
     * @param  string  $forcePushContent
     *
     * @return $this
     */
    public function setForcePushContent(string $forcePushContent)
    {
        $this->args['forcepushcontent'] = $forcePushContent;

        return $this;
    }

    /**
     * 发送群消息时，强推（@操作）列表是否为群里除发送者外的所有有效成员，true或false，默认为false
     *
     * @param  bool  $boolean
     *
     * @return $this
     */
    public function setForcePushAll(bool $boolean)
    {
        $this->args['forcepushall'] = $boolean ? 'true' : 'false';

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
     * 可选，群消息是否需要已读业务（仅对群消息有效），0:不需要，1:需要
     *
     * @param  int  $markRead
     *
     * @return $this
     */
    public function setMarkRead(int $markRead)
    {
        $this->args['markRead'] = $markRead;

        return $this;
    }

    /**
     * 是否为好友关系才发送消息，默认否
     * 注：使用该参数需要先开通功能服务
     *
     * @param  bool  $checkFriend
     *
     * @return $this
     */
    public function setCheckFriend(bool $checkFriend)
    {
        $this->args['checkFriend'] = $checkFriend;

        return $this;
    }

    /**
     * @return array
     */
    private function rules() : array
    {
        return [
            'from'             => 'required|string|max:32',
            'ope'              => [
                'required',
                'integer',
                Rule::in([0, 1])
            ],
            'to'               => 'required|string',
            'type'             => [
                'required',
                'integer',
                Rule::in([0, 1, 2, 3, 4, 6, 100])
            ],
            'body'             => 'required|string|max:5000',
            'antispam'         => [
                'sometimes',
                'string',
                Rule::in(['true', 'false'])
            ],
            'antispamCustom'   => 'sometimes|json|max:5000',
            'option'           => 'sometimes|json',
            'pushcontent'      => 'sometimes|string|max:500',
            'payload'          => 'sometimes|json',
            'ext'              => 'sometimes|string|max:1024',
            'forcepushlist'    => 'sometimes|json',
            'forcepushcontent' => 'sometimes|string',
            'forcepushall'     => [
                'sometimes',
                'string',
                Rule::in(['true', 'false'])
            ],
            'bid'              => 'sometimes|string',
            'useYidun'         => [
                'sometimes',
                'integer',
                Rule::in([0])
            ],
            'markRead'         => [
                'sometimes',
                'integer',
                Rule::in([0, 1])
            ],
            'checkFriend'      => [
                'sometimes',
                'boolean',
                Rule::in([true, false])
            ],
        ];
    }

    /**
     * @return array
     */
    private function messages() : array
    {
        return [
            'from.required'           => '发送者accid : ' . Translate::VALIDATE_REQUIRED,
            'from.string'             => '发送者accid : ' . Translate::VALIDATE_STRING,
            'from.max'                => '发送者accid : ' . Translate::VALIDATE_MAX_32,
            'ope.required'            => '消息消息 : ' . Translate::VALIDATE_REQUIRED,
            'ope.integer'             => '消息消息 : ' . Translate::VALIDATE_INT,
            'ope.in'                  => '消息消息 : 必须是 0,1',
            'to.required'             => '接受者id : ' . Translate::VALIDATE_REQUIRED,
            'to.string'               => '接受者id : ' . Translate::VALIDATE_STRING,
            'type.required'           => '消息类型 : ' . Translate::VALIDATE_REQUIRED,
            'type.integer'            => '消息类型 : ' . Translate::VALIDATE_INT,
            'type.in'                 => '消息类型 : 类型不正确',
            'body.required'           => '消息 : ' . Translate::VALIDATE_REQUIRED,
            'body.string'             => '消息 : ' . Translate::VALIDATE_STRING,
            'body.max'                => '消息 : 最大5000字符',
            'antispam.string'         => '本消息是否需要指定经由易盾检测的内容: 必须是字符串',
            'antispam.in'             => '本消息是否需要指定经由易盾检测的内容: 类型只能是字符串的true|false',
            'antispamCustom.json'     => '自定义的反垃圾检测内容: 类型必须是json',
            'antispamCustom.max'      => '自定义的反垃圾检测内容: 最大5000字符',
            'option.json'             => '发消息时特殊指定的行为选项: 类型必须是json',
            'pushcontent.string'      => '推送文案: 类型必须是字符串',
            'pushcontent.max'         => '推送文案: 最大500字符',
            'payload.json'            => 'ios 推送对应的payload: 类型必须是json',
            'ext.string'              => '开发者扩展字段: 类型必须是字符串',
            'ext.max'                 => '开发者扩展字段: 最大1024字符',
            'forcepushlist.json'      => '发送群消息时的强推（@操作）用户列表: 类型必须是json',
            'forcepushcontent.string' => '发送群消息时，针对强推（@操作）列表forcepushlist中的用户，强制推送的内容: 类型必须是字符串',
            'forcepushall.string'     => '强推（@操作）列表是否为群里除发送者外的所有有效成员: 类型必须是字符串',
            'forcepushall.in'         => '强推（@操作）列表是否为群里除发送者外的所有有效成员: 值只能是字符串的true|false',
            'bid.string'              => '反垃圾业务ID: 类型必须是字符串',
            'useYidun.integer'        => '单条消息是否使用易盾反垃圾: 必须是整型',
            'useYidun.in'             => '单条消息是否使用易盾反垃圾: 值只能是0',
            'markRead.integer'        => '群消息是否需要已读业务: 必须是整型',
            'markRead.in'             => '群消息是否需要已读业务: 值只能是0|1',
            'checkFriend.boolean'     => '是否为好友关系才发送消息: 必须是布尔型',
            'checkFriend.in'          => '是否为好友关系才发送消息: 值只能是布尔true|false',
        ];
    }
}