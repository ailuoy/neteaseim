<?php
/**
 * Created by PhpStorm.
 * User: ailuoy
 * Date: 2019/2/21
 * Time: 上午11:38
 */

namespace Ailuoy\NeteaseIm;


use Ailuoy\NeteaseIm\Exceptions\NeteaseImException;

class ResultReturnStructure
{
    /**
     * @var bool
     */
    private $status;
    /**
     * @var string
     */
    private $msg;
    /**
     * @var mixed
     */
    private $data;

    /**
     * @param $name
     *
     * @return mixed
     * @throws NeteaseImException
     */
    public function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
        throw new NeteaseImException('Attribute ' . $name . ' does not exist');
    }

    /**
     * ResultReturnStructure constructor.
     * @param bool $status
     * @param string $msg
     * @param mixed $data
     */
    public function __construct($status, $msg, $data)
    {
        $this->status = $status;
        $this->msg    = $msg;
        $this->data   = $data;

        return $this;
    }
}