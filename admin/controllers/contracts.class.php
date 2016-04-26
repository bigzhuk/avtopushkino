<?php
require_once('../controllers/controller.class.php');
require_once('../controllers/datachecker.class.php');
require_once('../models/contracts.class.php');
//require_once('../models/customers.class.php');
class ContractsController extends AbstractController {
    function addLine(AbstractModel $model){
        //$fields['name']  = "'".DataChecker::checkUserText($_POST['name'])."'";
        $fields['contract_sign_date'] = (int)$_POST['contract_sign_date'];
        $fields['customer_id'] = (int)$_POST['customer_id'];
        $fields['number'] = "'".DataChecker::checkUserText($_POST['number'])."'";
        $field_list = array();
        foreach($fields as $key=>$val){
            $field_list[] = $key.'='.$val;
        }
        $get_fields_line = implode(",", $field_list);
        return  $model->addLine($get_fields_line);
    }

    function updateLine(AbstractModel $model){
        //$fields['id']  = "'".DataChecker::checkUserText($_POST['name'])."'";
        $fields['contract_sign_date'] = (int)$_POST['contract_sign_date'];
        $fields['customer_id'] = (int)$_POST['customer_id'];
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
        
        if (isset($_POST['where'])){
            $where[] = array('title'=>'customer_id','value'=>$_POST['where']);
        } else { 
            $where = array();
        }
        $result = json_encode($model->getTableDataByField( array('number', 'id'), $where));

        return $result;
    }
}
$contracts_controller = new ContractsController;
$contracts_model = new ContractsModel();

if($_REQUEST['button_click']=='getAutocomplete'){
    echo $contracts_controller->getAutocomplete($contracts_model);
}

if($_REQUEST['button_click']=='add'){
    echo $contracts_controller->addLine($contracts_model);
}

if($_REQUEST['button_click']=='update'){
    echo $contracts_controller->updateLine($contracts_model);
}

if($_REQUEST['button_click']=='delete'){
    echo $contracts_controller->deleteLine($contracts_model);
}

if($_REQUEST['button_click']=='get_last_insert_line'){
    $contracts_model  = new ContractsModel();
    $contracts_lines =  $contracts_model->getTableDataById((int)$_REQUEST['id']);
    $contracts_line = $contracts_lines[0]; // получаем первую (и по логике единственную) строку двумерного массива $order_lines
    $contracts_line['customer_name']  =  $customer_model->getTableDataByField(
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
