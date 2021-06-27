<?php
/**
 * Реализация Payment_System_Invoice для ро6окаss'ы
 * https://docs.robokassa.ru/#1274
 */

class Robot_Box_Office_Invoice extends Payment_System_Invoice
{
    private $_market_obj;
    private $_invoice_info;
    private $_markets_list;

    private $payment_statuses = [100];

    /**
     * Robot_Box_Office_Invoice constructor.
     * @param Robot_Box_Office_Market $market_obj
     * @param int $invoice_id
     * @param array $markets_list
     */
    public function __construct(Robot_Box_Office_Market $market_obj, int $invoice_id, array $markets_list = [])
    {
        $this->_market_obj = $market_obj;
        $this->_invoice_id = $invoice_id;
        if(count($markets_list) > 0) {
            $this->_markets_list = $markets_list;
        }
        $this->set_api();
    }

    /**
     * Указываем нужный нам API класс
     */
    private function set_api() : void
    {
        $this->_api_obj = new Robot_Box_Office_API($this);
    }

    /**
     * Метод получает данные по заявки в системе ро6окаssа
     */
    public function set_invoice_info()
    {
        $this->_invoice_info = $this->_api_obj->get_invoice_data();
    }

    /**
     * Получение инфы о магазине из заявки
     * @return mixed|void
     */
    public function get_market_info()
    {
        if(count($this->_markets_list)>0)
        {
            return $this->_markets_list[$this->_market_obj->id()];
        }
        else {
            return $this->_market_obj->get();
        }
    }

    /**
     * Проверка на статус оплаты. 100 - оплачен
     * @return bool
     */
    public function invoice_is_paid()
    {
        return in_array($this->_invoice_info->State->Code, $this->payment_statuses);
    }

    /**
     * Метод получает сумму оплаты заявки
     * @return mixed
     */
    public function get_payment_summ()
    {
        return $this->_invoice_info->Info->OutSum;
    }

    /**
     * Метод получает сформированный url для текущей заявки
     * @return string
     */
    public function get_url() : string
    {
        return $this->_api_obj->get_url();
    }
}