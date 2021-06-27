<?php
/**
 * Объект коммерческого заказа
 */

class Commercial_Order
{
    private $_id;

    /**
     * Commercial_Order constructor.
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->_id = $id;
    }

    //ТУТ CRUD и ещё много всего

    /**
     * получаем список заказов по фильтру
     * @param array $filter
     * @return array
     */
    public static function get_list(array $filter = []) : array
    {
        return [123 => [
            'id' => 123,
            'summ' => '500',
            'robot_box_office_market_id' => 1,
            'robot_box_office_invoice_id' => 1
        ]];
    }

    /**
     * Тут происходит оплата заказа(композиция на класс Order_Pay, не стал включать её сюда)
     * @param Payment_System_Invoice $invoice_obj
     */
    public static function set_payment_by_payment_system_invoice_obj(Payment_System_Invoice $invoice_obj)
    {

    }
}