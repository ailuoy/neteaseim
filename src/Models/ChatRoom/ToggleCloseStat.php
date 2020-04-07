<?php
/**
 * Created by PhpStorm.
 * User: ailuoy
 * Date: 2019/5/12
 * Time: 下午11:11
 */

namespace Ailuoy\NeteaseIm\Models\ChatRoom;


use Ailuoy\NeteaseIm\Models\Model;
use Ailuoy\NeteaseIm\Translate;
use Illuminate\Validation\Rule;

class ToggleCloseStat extends Model
{
    /**
     * 修改聊天室开/关闭状态
     *
     * @param int    $roomId
     * @param string $operator
     * @param bool   $valid
     *
     * @return mixed
     * @throws \Ailuoy\NeteaseIm\Exceptions\ParameterErrorException
     * @throws \Ailuoy\NeteaseIm\Exceptions\RequestErrorException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E8%81%8A%E5%A4%A9%E5%AE%A4?#%E4%BF%AE%E6%94%B9%E8%81%8A%E5%A4%A9%E5%AE%A4%E5%BC%80/%E5%85%B3%E9%97%AD%E7%8A%B6%E6%80%81
     */
    public function go(int $roomId, string $operator, bool $valid)
    {
        $parameters = $this->mergeArgs([
            'roomid'   => $roomId,
            'operator' => $operator,
            'valid'    => $valid ? 'true' : 'false'
        ]);
        $this->validation($this->rules(), $this->messages(), $parameters);

        return $this->sendRequest('POST', 'nimserver/chatroom/toggleCloseStat.action', $parameters);
    }

    /**
     * @return array
     */
    private function rules()
    {
        return [
            'roomid'   => 'required|integer',
            'operator' => 'required|string|max:32',
            'valid'    => [
                'required',
                'string',
                Rule::in(['true', 'false'])
            ],
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
            'operator.required' => '操作者账号 : ' . Translate::VALIDATE_REQUIRED,
            'operator.string'   => '操作者账号 : ' . Translate::VALIDATE_STRING,
            'operator.max'      => '操作者账号 : ' . Translate::VALIDATE_MAX_32,
            'valid.required'    => '打开|关闭 聊天室 : ' . Translate::VALIDATE_REQUIRED,
            'valid.string'      => '操作者账号 : ' . Translate::VALIDATE_STRING,
            'valid.in'          => '操作者账号 : 只能是字符串的 true | false'
        ];
    }
}