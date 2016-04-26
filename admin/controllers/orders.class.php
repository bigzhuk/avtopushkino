<?php
require_once('../controllers/controller.class.php');
require_once('../controllers/datachecker.class.php');
require_once('../models/orders.class.php');
require_once('../models/customers.class.php');
class OrderController extends AbstractController {
    function addLine(AbstractModel $model){
        $fields['customer_id']   = (int)$_POST['customer_id'];
        $fields['contract_id']   = (int)$_POST['contract_id'];
        $fields['delivery_from'] = "'".DataChecker::checkUserText($_POST['delivery_from'])."'";
        $fields['delivery_to']   = "'".DataChecker::checkUserText($_POST['delivery_to'])."'";
        $fields['date_added']        = (int)$_POST['date_added'];
        $fields['status']        = (int)$_POST['status'];
        $fields['comment']   = "'".DataChecker::checkUserText($_POST['comment'])."'";
        $fields['car_id']   = (int)$_POST['car_id'];
        $field_list = array();
        foreach($fields as $key=>$val){
            $field_list[] = $key.'='.$val;
        }
        $get_fields_line = implode(",", $field_list);
        return  $model->addLine($get_fields_line);
    }

    function updateLine(AbstractModel $model){
        $fields['customer_id']   = (int)$_POST['customer_id'];
        $fields['contract_id']   = (int)$_POST['contract_id'];
        $fields['delivery_from'] = "'".DataChecker::checkUserText($_POST['delivery_from'])."'";
        $fields['delivery_to']   = "'".DataChecker::checkUserText($_POST['delivery_to'])."'";
        $fields['date_added']        = (int)$_POST['date_added'];
        $fields['status']        = (int)$_POST['status'];
        $fields['comment']   = "'".DataChecker::checkUserText($_POST['comment'])."'";
        $fields['car_id']   = (int)$_POST['car_id'];
        $field_list = array();
        foreach($fields as $key=>$val){
            $field_list[] = $key.'='.$val;
        }
        $get_fields_line = implode(",", $field_list);
        $where_line = 'id ='.(int)$_POST['id'];
        return  $model->updateLine($get_fields_line, $where_line);
    }

    function deleteLine(AbstractModel $model){
        $where_line = 'id ='.(int)$_POST['id'];
        return  $model->deleteLine($where_line);
    }
}
$order_controller = new OrderController;
$order_model = new OrderModel();
if($_REQUEST['button_click']=='add'){
    echo $order_controller->addLine($order_model);
}

if($_REQUEST['button_click']=='update'){
    echo $order_controller->updateLine($order_model);
}

if($_REQUEST['button_click']=='delete'){
    echo $order_controller->deleteLine($order_model);
}

if($_REQUEST['button_click']=='get_last_insert_line'){
    $customer_model  = new CustomersModel();
    $order_lines =  $order_model->getTableDataById((int)$_REQUEST['id']);
    $order_line = $order_lines[0]; // получаем первую (и по логике единственную) строку двумерного массива $order_lines
    $order_line['customer_name']  =  $customer_model->getTableDataByField(
        array('name'),
        array(
            array(
                'title'=>'id',
                'value'=>$order_line['customer_id']
            )
        )
    );
    $order_line['customer_name'] = $order_line['customer_name'][0];
    echo json_encode($order_line);

}
