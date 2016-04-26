<?php
require_once('../controllers/controller.class.php');
require_once('../controllers/datachecker.class.php');
require_once('../models/cars.class.php');
//require_once('../models/customers.class.php');
class CarsController extends AbstractController {
    function addLine(AbstractModel $model){
        $fields['name']  = "'".DataChecker::checkUserText($_POST['name'])."'";
        $fields['phone']   = (int)$_POST['phone'];
        $fields['number'] = "'".DataChecker::checkUserText($_POST['number'])."'";
        $field_list = array();
        foreach($fields as $key=>$val){
            $field_list[] = $key.'='.$val;
        }
        $get_fields_line = implode(",", $field_list);
        return  $model->addLine($get_fields_line);
    }

    function updateLine(AbstractModel $model){
        $fields['name']  = "'".DataChecker::checkUserText($_POST['name'])."'";
        $fields['phone']   = (int)$_POST['phone'];
        $fields['number'] = "'".DataChecker::checkUserText($_POST['number'])."'";
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
        $result = json_encode($model->getTableDataByField( array('number','id'), array() ));
        return $result;
    }
}
$cars_controller = new CarsController;
$cars_model = new CarsModel();

if($_REQUEST['button_click']=='getAutocomplete'){
    echo $cars_controller->getAutocomplete($cars_model);
}

if($_REQUEST['button_click']=='add'){
    echo $cars_controller->addLine($cars_model);
}

if($_REQUEST['button_click']=='update'){
    echo $cars_controller->updateLine($cars_model);
}
if($_REQUEST['button_click']=='delete'){
    echo $cars_controller->deleteLine($cars_model);
}

if($_REQUEST['button_click']=='get_last_insert_line'){
    $customer_model  = new CustomersModel();
    $cars_lines =  $cars_model->getTableDataById((int)$_REQUEST['id']);
    $cars_line = $cars_lines[0]; // получаем первую (и по логике единственную) строку двумерного массива $order_lines
    $cars_line['customer_name']  =  $customer_model->getTableDataByField(
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
