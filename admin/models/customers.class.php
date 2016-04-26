<?php
require_once('model.class.php');
//require_once('../models/model.class.php');
class CustomersModel extends AbstractModel {
    public function getTableName() {
        return 'customers';
    }

}
