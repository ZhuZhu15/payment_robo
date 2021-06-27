<?php
/**
 * Класс запускаемый демоном с определенным интервалом. Т.к в примере демонов нет - запускаю его в index.php :)
 */
class Cron
{
    /**
     * метод запрашивает данные из платежной системы и проставляет оплаты
     */
    public static function get_payments_from_robot_box_office() : void
    {
        $commercial_orders_list = Commercial_Order::get_list(['robot_box'=>true, 'nopay'=>true]);
        $robot_box_office_market_list = Robot_Box_Office_Market::get_list();

        foreach($commercial_orders_list as $order)
        {
            $invoice_obj = new Robot_Box_Office_Invoice(
                new Robot_Box_Office_Market($order['robot_box_office_market_id']),
                $order['robot_box_office_invoice_id'],
                $robot_box_office_market_list
            );
            $invoice_obj->set_invoice_info();
            if($invoice_obj->invoice_is_paid())
            {
                $order_obj = new Commercial_Order($order['id']);
                $order_obj->set_payment_by_payment_system_invoice_obj($invoice_obj);
            }
        }

        echo 'Для наглядных результатов дописать CRUD для commercial_orders и robot_box_office_market :)';
    }

}