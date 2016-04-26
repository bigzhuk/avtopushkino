<?php
//require_once('model.class.php');
	require_once('model.class.php');

class OrderModel extends AbstractModel {
    public function getTableName() {
        return 'orders';
    }
}
?>
