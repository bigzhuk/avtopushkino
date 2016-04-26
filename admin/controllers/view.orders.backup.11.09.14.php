<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script>
    $(document).ready(function(){

        $('.add').click(function(){
            var customer_id = $('.customer_id').val();
            var contract_id = $('.contract_id').val();
            var date_added = $('.date_added').val();
            var delivery_from = $('.delivery_from').val();
            var delivery_to = $('.delivery_to').val();
            var status = $('.status').val();
            $.post("../controllers/orders.class.php", {
                    customer_id: customer_id,
                    contract_id: contract_id,
                    date_added: date_added,
                    delivery_from: delivery_from,
                    delivery_to: delivery_to,
                    status: status,
                    button_click: 'add'
                },
                function(data) {
                    if(data != false) {
                        $.getJSON("../controllers/orders.class.php", {id: data, button_click: 'get_last_insert_line'}, function(json) {
                            var line_customer_id   = '<tr><td>' + json.customer_id + '</td>';
                            var line_contract_id   = '<td>' + json.contract_id + '</td>';
                            var line_date_added    = '<td>' + json.date_added + '</td>';
                            var line_delivery_from = '<td>' + json.delivery_from + '</td>';
                            var line_delivery_to   = '<td>' + json.delivery_to + '</td>';
                            var line_status        = '<td>' + json.status + '</td></tr>';
                            var line = line_customer_id+line_contract_id+line_date_added+line_delivery_from+line_delivery_to+line_status;
                            $('#order_table').append(line);
                        });
                    }
                    else {
                        alert('не добавили');
                    }
                });
        });

        $('.update').click(function(){
            alert('a');
        });
    });
</script>
<?php
require_once('../models/orders.class.php');
require_once('../models/customers.class.php');
$order_model = new OrderModel();
$customer_model  = new CustomersModel();
$orders_lines = $order_model->getTableData();
echo "
<table>
    <thead>
        <tr>
            <td>Клиент</td>
            <td>№ заказа</td>
            <td>№ договора</td>
            <td>пункт отправления</td>
            <td>пункт назначения</td>
            <td>статус заказа</td>
            <td></td>
        </tr>
    </thead>
    <tbody id='order_table'>";
foreach ($orders_lines as $orders_line) {
    $customer_data  =  $customer_model->getTableDataByField(
        array('name'),
        array(
            array(
                'title'=>'id',
                'value'=>$orders_line['customer_id']
            )
        )
    );

    echo "
         <tr>
            <td><input type='text' class='customer_id' value='".$customer_data['name']."'></td>
            <td><input type='text' value='".$orders_line['id']."'></td>
            <td><input type='text' value='".$orders_line['contract_id']."'></td>
            <td><input type='text' value='".$orders_line['delivery_from']."'></td>
            <td><input type='text' value='".$orders_line['delivery_to']."'></td>
            <td>
                <select name='Статус'>";
    echo "<option value=0"; if($orders_line['status']==0){echo " selected ";} echo ">Новый</option>";
    echo "<option value=1"; if($orders_line['status']==1){echo " selected ";} echo ">Выполняется</option>";
    echo "<option value=2"; if($orders_line['status']==2){echo " selected ";} echo ">Завершен</option>";
    echo "
                </select>
            </td>
            <td><input type='button' class='update' name='update' value='Сохранить'></td>
        </tr>";
}
echo "
    </tbody>
</table>
<hr>
Добавить данные
<table>
    <tbody>
        <tr>
            <td><input type='text' class='customer_id'   value='клиент'></td>
            <td><input type='text' class='contract_id'   value='договор'></td>
            <td><input type='text' class='date_added'    value='дата добавления'></td>
            <td><input type='text' class='delivery_from' value='пункт отправки'></td>
            <td><input type='text' class='delivery_to'   value='пункт назначения '></td>
            <td>
                <select class='status'>
                    <option value='0'>Новый</option>
                    <option value='1'>Выполняется</option>
                    <option value='2'>Завершен</option>
                </select>
            </td>
            <td><input type='button' name='add' class='add' value='Добавить'></td>
        </tr>
    </tbody>
</table>";
