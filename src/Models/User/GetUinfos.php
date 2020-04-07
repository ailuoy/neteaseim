<?php
/**
 * Created by PhpStorm.
 * User: ailuoy
 * Date: 2019/5/6
 * Time: 下午12:05
 */

namespace Ailuoy\NeteaseIm\Models\User;

use Ailuoy\NeteaseIm\Models\Model;
use Ailuoy\NeteaseIm\Translate;

class GetUinfos extends Model
{
    /**
     * 获取用户名片
     *
     * @param  array  $accIds
     *
     * @return mixed
     * @throws \Ailuoy\NeteaseIm\Exceptions\ParameterErrorException
     * @throws \Ailuoy\NeteaseIm\Exceptions\RequestErrorException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E7%94%A8%E6%88%B7%E5%90%8D%E7%89%87?#%E8%8E%B7%E5%8F%96%E7%94%A8%E6%88%B7%E5%90%8D%E7%89%87
     */
    public function go(array $accIds)
    {
        $parameters = ['accids' => json_encode($accIds)];
        $this->validation($this->rules(), $this->messages(), $parameters);

        return $this->sendRequest('POST', 'nimserver/user/getUinfos.action', $parameters);
    }

    /**
     * @return array
     */
    private function rules() : array
    {
        return [
            'accids' => 'required|json',
        ];
    }

    /**
     * @return array
     */
    private function messages() : array
    {
        return [
            'accids.required' => Translate::FIELD_USER_ACCIDS . Translate::VALIDATE_REQUIRED,
            'accids.json'     => Translate::FIELD_USER_ACCIDS . Translate::VALIDATE_JSON,
        ];
    }
}