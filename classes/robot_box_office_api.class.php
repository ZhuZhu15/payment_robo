<?php
/**
 * Класс для получения xml-интерфейсов в частности
 * https://docs.robokassa.ru/#1274
 */
use GuzzleHttp\Client;

class Robot_Box_Office_API
{
    private $_api_url;
    private $_response_xml;
    private $_invoice_obj;

    /**
     * Robot_Box_Office_API constructor.
     * @param Robot_Box_Office_Invoice $invoice_obj
     */
    public function __construct(Robot_Box_Office_Invoice $invoice_obj)
    {
        $this->_invoice_obj = $invoice_obj;
    }

    /**
     * 'Фасад' для получения данных из сервиса в нужном виде
     * @return bool|SimpleXMLElement
     */
    public function get_invoice_data()
    {
        return $this->parse_xml($this->get_xml());
    }

    /**
     * Запрос в сервис и получение xml
     * @return mixed
     */
    private function get_xml()
    {
        $client = new Client();
        return $client->request('POST', $this->get_url(), [
                'headers' => ['Accept' => 'application/xml'],
            ])->getbody()->getContents();
    }

    /**
     * Метод который приводит данный из сервиса в нужный вид
     * @return mixed
     */
    private function parse_xml(string $response)
    {
        $response_xml = simplexml_load_string($response);
        if($response_xml instanceof \SimpleXMLElement)
        {
            $this->_response_xml = $response_xml;
            return $this->_response_xml;
        }
        return false;
    }

    /**
     * @return string
     */
    public function get_url() : string
    {
        if(!$this->_api_url)
        {
            $this->create_url();
        }
        return $this->_api_url;
    }

    /**
     * Метод создает url-адрес на основе заявки
     */
    private function create_url() : void
    {
        $market_info = $this->_invoice_obj->get_market_info();
        $signature = md5($market_info['merchant_login'].":".$this->_invoice_obj->invoice_id().":".$market_info['password2']);
        $this->_api_url = 'https://auth.robokassa.ru/Merchant/WebService/Service.asmx/OpState?MerchantLogin='.
            $market_info['merchant_login'].'&InvoiceID='.$this->_invoice_obj->invoice_id().'&Signature='.$signature;
    }

}