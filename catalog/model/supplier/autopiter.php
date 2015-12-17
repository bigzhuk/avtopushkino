<?php

require_once("supplier_interaction_interface.php");

class ModelSupplierAutopiter extends Model implements SupplierInteractionInterface {

    public $soap_url = 'http://service.autopiter.ru/price.asmx?WSDL';
    private $user_id =  '217443';
    private $password = 'avtopushkino';
    private $soap_client = null;


    public function sayHello() {
        $str = '1605808'; // колодки опель
        $result = $this->getSoapClient()->FindCatalog (array("ShortNumberDetail"=>$str));
        $items = $result->FindCatalogResult->SearchedTheCatalog;
        var_dump($items);
        return 'hello';
    }

    public function getSoapClient() {
        if($this->soap_client === null) {
            $this->setSoapClient();
        }
        return $this->soap_client;
    }

    public function setSoapClient() {
        $this->soap_client = new SoapClient("http://service.autopiter.ru/price.asmx?WSDL");
            //http://service.autopiter.ru/price.asmx?op=IsAuthorization
        if (!($this->soap_client->IsAuthorization()->IsAuthorizationResult)) {
            //http://service.autopiter.ru/price.asmx?op=Authorization
            //UserID - ваш клиентский id, Password - ваш пароль
            $this->soap_client->Authorization(array("UserID"=>$this->user_id, "Password"=>$this->password, "Save"=> "true"));
        }
    }

    public function addPartToCatalog() {

    }

    public function deletePartFromCatalog() {

    }

    public function updatePartInCatalog() {
        // TODO: Implement updatePartInCatalog() method.
    }

    public function getPartData($supplier) {

    }
}