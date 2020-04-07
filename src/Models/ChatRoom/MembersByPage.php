<?php
/**
 * Created by PhpStorm.
 * User: ailuoy
 * Date: 2019/5/18
 * Time: 下午10:35
 */

namespace Ailuoy\NeteaseIm\Models\ChatRoom;


use Ailuoy\NeteaseIm\Models\Model;
use Ailuoy\NeteaseIm\Translate;
use Illuminate\Validation\Rule;

class MembersByPage extends Model
{
    /**
     * 分页获取成员列表
     *
     * @param int $roomId
     * @param int $type
     * @param int $endTime
     * @param int $limit
     *
     * @return mixed
     * @throws \Ailuoy\NeteaseIm\Exceptions\ParameterErrorException
     * @throws \Ailuoy\NeteaseIm\Exceptions\RequestErrorException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E8%81%8A%E5%A4%A9%E5%AE%A4?#%E5%88%86%E9%A1%B5%E8%8E%B7%E5%8F%96%E6%88%90%E5%91%98%E5%88%97%E8%A1%A8
     */
    public function go(int $roomId, int $type, int $endTime, int $limit)
    {
        $parameters = [
            'roomid'  => $roomId,
            'type'    => $type,
            'endtime' => $endTime,
            'limit'   => $limit
        ];

        $this->validation($this->rules(), $this->messages(), $parameters);

        return $this->sendRequest('POST', 'nimserver/chatroom/membersByPage.action', $parameters);
    }

    /**
     * @return array
     */
    private function rules()
    {
        return [
            'roomid'  => 'required|integer',
            'type'    => [
                'required',
                'integer',
                Rule::in([0, 1, 2])
            ],
            'endtime' => 'required|integer',
            'limit'   => 'required|integer|max:100',
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
            'type.required'    => '需要查询的成员类型 : ' . Translate::VALIDATE_REQUIRED,
            'type.integer'     => '需要查询的成员类型 : ' . Translate::VALIDATE_INT,
            'type.in'          => '需要查询的成员类型 : 值必须是 0|1|2',
            'endtime.required' => '单位毫秒 : ' . Translate::VALIDATE_REQUIRED,
            'endtime.integer'  => '单位毫秒 : ' . Translate::VALIDATE_INT,
            'limit.required'   => '返回条数 : ' . Translate::VALIDATE_REQUIRED,
            'limit.integer'    => '返回条数 : ' . Translate::VALIDATE_INT,
            'limit.max'        => '返回条数 : 值最大100',
        ];
    }
}