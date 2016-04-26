<?php
require_once('../controllers/controller.class.php');
require_once('../controllers/datachecker.class.php');
require_once('../models/orders.class.php');
require_once('../models/customers.class.php');
class CustomerController extends AbstractController {
    function addLine(AbstractModel $model){
       // $fields['id']   = (int)$_POST['id'];
        $err= array();
        $fields['name']   = "'".DataChecker::checkUserText($_POST['name'])."'";
        $fields['company']   = "'".DataChecker::checkUserText($_POST['company'])."'";
        if(DataChecker::checkEmail($_POST['email']) == false){
            $err['email']=DataChecker::INVALID_EMAIL;
        }
        else{
            $fields['email'] = "'".$_POST['email']."'";
        }
        $fields['phone']   = (int)$_POST['phone'];
        $fields['status']        = (int)$_POST['status'];
        $fields['comment']   = "'".DataChecker::checkUserText($_POST['comment'])."'";
        $field_list = array();
        foreach($fields as $key=>$val){
            if(empty($val)){
                $err[$key] = DataChecker::EMPTY_FIELD;
            }
            else{
                $field_list[] = $key.'='.$val;
            }
        }
        if(!empty($err)){
            echo json_encode($err);
            return;

        }
        $get_fields_line = implode(",", $field_list);
        return  $model->addLine($get_fields_line);
    }

    function updateLine(AbstractModel $model){
       // $fields['id']   = (int)$_POST['id'];
        $fields['name']   = "'".DataChecker::checkUserText($_POST['name'])."'";
        $fields['company']   = "'".DataChecker::checkUserText($_POST['company'])."'";
        $fields['email'] = "'".DataChecker::checkUserText($_POST['email'])."'";
        $fields['phone']   = (int)$_POST['phone'];
        $fields['status']        = (int)$_POST['status'];
        $fields['comment']   = "'".DataChecker::checkUserText($_POST['comment'])."'";
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

    function getAutocomplete(AbstractModel $model){
        $result = json_encode($model->getTableDataByField( array('name', 'id'), array() ));
        return $result;
    }
    
}
$customer_controller = new CustomerController;
$customer_model = new CustomersModel();

if($_REQUEST['button_click']=='getAutocomplete'){
    echo $customer_controller->getAutocomplete($customer_model);
}

if($_REQUEST['button_click']=='add'){
    echo $customer_controller->addLine($customer_model);
}

if($_REQUEST['button_click']=='update'){
    echo $customer_controller->updateLine($customer_model);
}

if($_REQUEST['button_click']=='delete'){
    echo $customer_controller->deleteLine($customer_model);
}



if($_REQUEST['button_click']=='get_last_insert_line'){
    $customer_model  = new CustomersModel();
    $order_lines =  $customer_model->getTableDataById((int)$_REQUEST['id']);
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
 