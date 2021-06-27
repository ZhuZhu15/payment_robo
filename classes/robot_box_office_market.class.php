<?php
/**
 * Реализация Payment_System для ро6окаss'ы
 */
class Robot_Box_Office_Market extends Payment_System
{
    private $_id;
    private $_market_info;

    /**
     * Robot_Box_Office_Market constructor.
     * @param int $market_id
     */
    public function __construct(int $market_id)
    {
        $this->_id = $market_id;
        $this->_system_name = 'Ро6окаssа';
    }

    /**
     * Запрос в базу на список Магазинов для Робокассы(Внутри одного аккаунта может быть несколько магазинов)
     * @param array $filter
     * @return array
     */
    public static function get_list(array $filter = []) : array
    {
        return ['123' => ['name' => 'test_market_1']];
    }

    /**
     * @param array $new_market_data
     */
    public static function create(array $new_market_data)
    {

    }

    public function get()
    {
        $this->_market_info = ['test' => 'ok'];
    }

    /**
     * @return int
     */
    public function id() : int
    {
        return $this->_id;
    }

    /**
     * @param array $new_market_data
     */
    public function update(array $new_market_data)
    {
        //
    }

    public function delete()
    {
        //Удаление объекта. delete - CRUD
    }
}