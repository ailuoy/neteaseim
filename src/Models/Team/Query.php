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
use Illuminate\Validation\Rule;

class Query extends Model
{
    /**
     * 群信息与成员列表查询
     *
     * @param array $tids
     * @param int   $ope
     *
     * @return mixed
     */
    public function go(array $tids, int $ope)
    {
        $parameters = ['tids' => json_encode($tids), 'ope' => $ope];
        $this->validation($this->rules(), $this->messages(), $parameters);

        return $this->sendRequest('POST', 'nimserver/team/query.action', $parameters);
    }

    private function rules()
    {
        return [
            'tids' => 'required|string|json',
            'ope'  => [
                'required',
                'integer',
                Rule::in([0, 1])
            ]
        ];
    }

    private function messages()
    {
        return [
            'tids.required' => '群id列表 : ' . Translate::VALIDATE_REQUIRED,
            'tids.string'   => '群id列表 : ' . Translate::VALIDATE_STRING,
            'tids.json'     => '群id列表 : ' . Translate::VALIDATE_JSON,
            'ope.required'  => '操作code : ' . Translate::VALIDATE_REQUIRED,
            'ope.integer'   => '操作code : ' . Translate::VALIDATE_INT,
            'ope.in'        => '操作code : 值只能是 0 | 1',
        ];
    }
}