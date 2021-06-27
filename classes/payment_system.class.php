<?php
/**
 * Абстрактный класс для платежных систем
 */

abstract class Payment_System
{
    protected $_system_name;

    public function get_system_name()
    {
        return $this->_system_name;
    }
}