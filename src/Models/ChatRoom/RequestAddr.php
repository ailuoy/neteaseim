<?php
/**
 * Created by PhpStorm.
 * User: ailuoy
 * Date: 2019/5/15
 * Time: 下午11:50
 */

namespace Ailuoy\NeteaseIm\Models\ChatRoom;


use Ailuoy\NeteaseIm\Models\Model;
use Ailuoy\NeteaseIm\Translate;
use Illuminate\Validation\Rule;

class RequestAddr extends Model
{

    /**
     * 请求聊天室地址
     *
     * @param int    $roomId
     * @param string $accId
     * @param int    $clientType
     *
     * @return mixed
     * @throws \Ailuoy\NeteaseIm\Exceptions\ParameterErrorException
     * @throws \Ailuoy\NeteaseIm\Exceptions\RequestErrorException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E8%81%8A%E5%A4%A9%E5%AE%A4?#%E8%AF%B7%E6%B1%82%E8%81%8A%E5%A4%A9%E5%AE%A4%E5%9C%B0%E5%9D%80
     */
    public function go(int $roomId, string $accId, int $clientType)
    {
        $parameters = $this->mergeArgs([
            'roomid'     => $roomId,
            'accid'      => $accId,
            'clienttype' => $clientType,
        ]);
        $this->validation($this->rules(), $this->messages(), $parameters);

        return $this->sendRequest('POST', 'nimserver/chatroom/update.action', $parameters);
    }

    /**
     * 客户端ip，传此参数时，会根据用户ip所在地区，返回合适的地址
     *
     * @param string $clientIp
     *
     * @return RequestAddr
     */
    public function setClientIp(string $clientIp): self
    {
        $this->args['clientip'] = $clientIp;

        return $this;
    }

    /**
     * @return array
     */
    private function rules(): array
    {
        return [
            'roomid'     => 'required|integer',
            'accid'      => 'required|string',
            'clienttype' => [
                'required',
                'integer',
                Rule::in([1, 2, 3])
            ],
            'clientip'   => 'sometimes|string'
        ];
    }

    /**
     * @return array
     */
    private function messages(): array
    {
        return [
            'roomid.required'     => Translate::FIELD_CHATROOM_ROOM_ID . Translate::VALIDATE_REQUIRED,
            'roomid.integer'      => Translate::FIELD_CHATROOM_ROOM_ID . Translate::VALIDATE_INT,
            'accid.required'      => '进入聊天室的账号 : ' . Translate::VALIDATE_REQUIRED,
            'accid.string'        => '进入聊天室的账号 : ' . Translate::VALIDATE_STRING,
            'clienttype.required' => '客户端类型 : ' . Translate::VALIDATE_REQUIRED,
            'clienttype.integer'  => '客户端类型 : ' . Translate::VALIDATE_INT,
            'clienttype.in'       => '客户端类型 : 值只能是 1 | 2 | 3',
            'clientip.string'     => '客户端ip : ' . Translate::VALIDATE_STRING
        ];
    }
}