<?php
/**
 * Created by PhpStorm.
 * User: ailuoy
 * Date: 2019/5/16
 * Time: 上午9:44
 */

namespace Ailuoy\NeteaseIm\Models\ChatRoom;


use Ailuoy\NeteaseIm\Models\Model;
use Ailuoy\NeteaseIm\Translate;

class AddRobot extends Model
{
    /**
     * 往聊天室内添加机器人
     *
     * @param int   $roomId
     * @param array $accIds
     *
     * @return mixed
     * @throws \Ailuoy\NeteaseIm\Exceptions\ParameterErrorException
     * @throws \Ailuoy\NeteaseIm\Exceptions\RequestErrorException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E8%81%8A%E5%A4%A9%E5%AE%A4?#%E5%BE%80%E8%81%8A%E5%A4%A9%E5%AE%A4%E5%86%85%E6%B7%BB%E5%8A%A0%E6%9C%BA%E5%99%A8%E4%BA%BA
     */
    public function go(int $roomId, array $accIds)
    {
        $parameters = $this->mergeArgs([
            'roomid' => $roomId,
            'accids' => json_encode($accIds)
        ]);

        $this->validation($this->rules(), $this->messages(), $parameters);

        return $this->sendRequest('POST', 'nimserver/chatroom/addRobot.action', $parameters);
    }

    /**
     * 机器人信息扩展字段，请使用json格式，长度4096字符
     *
     * @param array $roleExt
     *
     * @return $this
     */
    public function setRoleExt(array $roleExt)
    {
        $this->args['roleExt'] = json_encode($roleExt);

        return $this;
    }

    /**
     * 机器人进入聊天室通知的扩展字段，请使用json格式，长度2048字符
     *
     * @param array $notifyExt
     *
     * @return $this
     */
    public function setNotifyExt(array $notifyExt)
    {
        $this->args['notifyExt'] = json_encode($notifyExt);

        return $this;
    }

    /**
     * @return array
     */
    private function rules()
    {
        return [
            'roomid'    => 'required|integer',
            'accids'    => 'required|json',
            'roleExt'   => 'sometimes|json|max:4096',
            'notifyExt' => 'sometimes|json|max:2048',
        ];
    }

    /**
     * @return array
     */
    private function messages()
    {
        return [
            'roomid.required' => Translate::FIELD_CHATROOM_ROOM_ID . Translate::VALIDATE_REQUIRED,
            'roomid.integer'  => Translate::FIELD_CHATROOM_ROOM_ID . Translate::VALIDATE_INT,
            'accids.required' => '机器人账号accid列表 : ' . Translate::VALIDATE_REQUIRED,
            'accids.json'     => '机器人账号accid列表 : ' . Translate::VALIDATE_JSON,
            'roleExt.json'    => '机器人信息扩展字段 : ' . Translate::VALIDATE_JSON,
            'roleExt.max'     => '机器人信息扩展字段 : ' . Translate::VALIDATE_MAX_4096,
            'notifyExt.json'  => '机器人进入聊天室通知的扩展字段 : ' . Translate::VALIDATE_JSON,
            'notifyExt.max'   => '机器人进入聊天室通知的扩展字段 : ' . Translate::VALIDATE_MAX_2048,
        ];
    }
}