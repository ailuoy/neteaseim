<?php
/**
 * Created by PhpStorm.
 * User: ailuoy
 * Date: 2019/5/11
 * Time: 下午6:40
 */

namespace Ailuoy\NeteaseIm\Models\Team;


use Ailuoy\NeteaseIm\Models\Model;
use Ailuoy\NeteaseIm\Translate;

class GetMarkReadInfo extends Model
{
    /**
     * 获取群组已读消息的已读详情信息
     *
     * @param string $tid
     * @param int    $msgId
     * @param string $fromAccid
     *
     * @return mixed
     *
     * https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E7%BE%A4%E7%BB%84%E5%8A%9F%E8%83%BD%EF%BC%88%E9%AB%98%E7%BA%A7%E7%BE%A4%EF%BC%89?#%E8%8E%B7%E5%8F%96%E7%BE%A4%E7%BB%84%E5%B7%B2%E8%AF%BB%E6%B6%88%E6%81%AF%E7%9A%84%E5%B7%B2%E8%AF%BB%E8%AF%A6%E6%83%85%E4%BF%A1%E6%81%AF
     */
    public function go(string $tid, int $msgId, string $fromAccid)
    {
        $parameters = $this->mergeArgs([
            'tid'       => $tid,
            'msgid'     => $msgId,
            'fromAccid' => $fromAccid,
        ]);
        $this->validation($this->rules(), $this->messages(), $parameters);

        return $this->sendRequest('POST', 'nimserver/team/getMarkReadInfo.action', $parameters);
    }

    /**
     * 是否返回已读、未读成员的accid列表，默认为false
     *
     * @param bool $snapshot
     *
     * @return $this
     */
    public function setSnapsHot(bool $snapshot)
    {
        $this->args['snapshot'] = $snapshot;

        return $this;
    }

    private function rules()
    {
        return [
            'tid'       => 'required|string',
            'msgid'     => 'required|integer',
            'fromAccid' => 'required|string|max:32',
            'snapshot'  => 'sometimes|boolean',
        ];
    }

    private function messages()
    {
        return [
            'tid.required'       => '群id : ' . Translate::VALIDATE_REQUIRED,
            'tid.string'        => '群id : ' . Translate::VALIDATE_STRING,
            'msgid.required'     => '发送群已读业务消息时服务器返回的消息ID : ' . Translate::VALIDATE_REQUIRED,
            'msgid.integer'      => '发送群已读业务消息时服务器返回的消息ID : ' . Translate::VALIDATE_INT,
            'fromAccid.required' => '消息发送者账号 : ' . Translate::VALIDATE_REQUIRED,
            'fromAccid.string'   => '消息发送者账号 : ' . Translate::VALIDATE_STRING,
            'fromAccid.max'      => '消息发送者账号 : ' . Translate::VALIDATE_MAX_32,
            'snapshot.boolean'   => '是否返回已读  : ' . Translate::VALIDATE_BOOLEAN,
        ];
    }


}