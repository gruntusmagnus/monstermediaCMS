<?php

namespace App\Modules\ApiVento\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Catalog\Product;

class ApiVentoController extends Controller
{
    private $header;
    private $url;

    public function __construct()
    {
        $this->url = 'https://vento.delivers.cz/prezentace-server/api/';

        $this->header = array(
            'Content-Type: application/json',
            'LicenseToken: A4D71191-304C-4F54-A7E7-099F13A6132A'
        );

    }


    /**
     * returns product id,name,code,pcsavailable and quantityUnit with id and code
     * @param int $idStock
     * @return {ID,Code,Name,Unit{ID,Code},PcsAvailable}
     */
    public function indexProducts($idStock = 1000079)
    {
        $url = $this->url . 'StockState/ProductStockState';
        $header = $this->header;
        $data = json_encode(array('IDStock' => $idStock));
        $tp = gettype($data);
        $responseData = $this->sendRequest($url,'POST',$header,$data);
        $data = json_decode($responseData);
//        if(!$data->isEmpty())
//        $this->saveProducts($data);
        return $data;
    }

    public function saveProducts($data){
        foreach($data as $product);
        $productObj = new Product();
        $productObj->code = $product->code;
    }

    /**
     * @param $url = url for current api request
     * @param $type = GET | POST
     * @param array $header = array without keys only value in string like 'name: value'
     * @param array $postData = array(

     * )
     * @return mixed
     */
    public function sendRequest($url, $type, $header = array(), $postData = array())
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        if ($type == 'POST') {
            if (empty($postData)) {
                array_push($header, 'Content-Length: 0');
            }
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        }
        if (sizeof($header) <= 0) {
            url_setopt($ch, CURLOPT_HEADER, true);
        } else {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_REFERER, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
}
