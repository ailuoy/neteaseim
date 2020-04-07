<?php
/**
 * Created by PhpStorm.
 * User: ailuoy
 * Date: 2019/5/11
 * Time: 下午3:51
 */

namespace Ailuoy\NeteaseIm\Models\Team;


use Ailuoy\NeteaseIm\Models\Model;
use Ailuoy\NeteaseIm\Translate;

class QueryDetail extends Model
{

    /**
     * 获取群组详细信息
     *
     * @param string $tid
     *
     * @return mixed
     */
    public function go(string $tid)
    {
        $parameters = ['tid' => $tid];
        $this->validation($this->rules(), $this->messages(), $parameters);

        return $this->sendRequest('POST', 'nimserver/team/queryDetail.action', $parameters);
    }

    private function rules()
    {
        return [
            'tid' => 'required|string'
        ];
    }

    private function messages()
    {
        return [
            'tid.required' => 'team_id : ' . Translate::VALIDATE_REQUIRED,
            'tid.string'   => 'team_id : ' . Translate::VALIDATE_STRING
        ];
    }
}