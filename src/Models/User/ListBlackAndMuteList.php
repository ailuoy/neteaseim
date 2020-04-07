<?php
/**
 * Created by PhpStorm.
 * User: ailuoy
 * Date: 2019/5/8
 * Time: 上午7:49
 */

namespace Ailuoy\NeteaseIm\Models\User;


use Ailuoy\NeteaseIm\Models\Model;
use Ailuoy\NeteaseIm\Translate;

class ListBlackAndMuteList extends Model
{
    /**
     * 查看指定用户的黑名单和静音列表
     *
     * @param string $accId
     *
     * @return mixed
     * @throws \Ailuoy\NeteaseIm\Exceptions\ParameterErrorException
     * @throws \Ailuoy\NeteaseIm\Exceptions\RequestErrorException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E7%94%A8%E6%88%B7%E5%85%B3%E7%B3%BB%E6%89%98%E7%AE%A1?#%E6%9F%A5%E7%9C%8B%E6%8C%87%E5%AE%9A%E7%94%A8%E6%88%B7%E7%9A%84%E9%BB%91%E5%90%8D%E5%8D%95%E5%92%8C%E9%9D%99%E9%9F%B3%E5%88%97%E8%A1%A8
     */
    public function go(string $accId)
    {
        $parameters = ['accid' => $accId];
        $this->validation($this->rules(), $this->messages(), $parameters);

        return $this->sendRequest('POST', 'nimserver/user/listBlackAndMuteList.action', $parameters);
    }

    /**
     * @return array
     */
    private function rules(): array
    {
        return [
            'accid' => 'required|string|max:32'
        ];
    }

    /**
     * @return array
     */
    private function messages(): array
    {
        return [
            'accid.required' => Translate::FIELD_USER_ACCID . Translate::VALIDATE_REQUIRED,
            'accid.string'   => Translate::FIELD_USER_ACCID . Translate::VALIDATE_STRING,
            'accid.max'      => Translate::FIELD_USER_ACCID . Translate::VALIDATE_MAX_32
        ];
    }
}