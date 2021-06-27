<?php
/**
 * Абстрактный класс для конктретной заявки(заказа) в платежной системе
 */

abstract class Payment_System_Invoice
{
    protected $_invoice_id;

    abstract function get_payment_summ();

    public function invoice_id()
    {
        return $this->_invoice_id;
    }
}