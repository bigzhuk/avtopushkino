<?php
require_once('../models/users.class.php');
require_once('../controllers/controller.class.php');
require_once('../controllers/datachecker.class.php');
//require_once('../models/customers.class.php');
class UsersController extends AbstractController {
    function addLine(AbstractModel $model){
       return null;
    }

    function updateLine(AbstractModel $model){
       return null;
    }

    function deleteLine(AbstractModel $model){
       return null;
    }


}

$users_model = new UsersModel();
if($_REQUEST['button_click']=='get_user_by_customer_id'){
    $customer_id = (int)$_REQUEST['id'];
    $users_line =  $users_model->getTableDataByField(
        array('id', 'user_login', 'user_password'),
        array(
            array(
                'title'=>'customer_id',
                'value'=>$customer_id
            )
        )
    );
    echo json_encode($users_line[0]);
}
