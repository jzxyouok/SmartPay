<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/5 0005
 * Time: 17:31
 */

namespace Payment;

/**
 * 需要由用户实现的业务逻辑接口
 * Interface NotifyInterface
 * @package Payment
 */
interface NotifyInterface
{
    /**
     * 需要由用户实现的业务逻辑
     * @param array $data
     * @return mixed
     */
    public function process(array $data);
}