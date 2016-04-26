<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="../js.js"></script>
<link rel="stylesheet" href="../style.css">
 <script src="../../js/kladr.js" type="text/javascript"></script>                              <!--Автокомплит адресов -->



<script>
    $(document).ready(function(){

        $('.show_on_change').hide();
        var changers = $('.customer_id,.id,.contract_id,.delivery_from,.delivery_to,.status');
        $(changers).on('change', function(){
            //$(this).parent().parent().find('.customer_id').attr('id'); Айдишка
            $(this).parent().parent().find('.show_on_change').show();
        });

       $('.add').click(function(){
           var customer_id = $(this).parent().parent().find('.customer_id').attr('id');
           var id = $(this).parent().parent().find('.id').val();
           var contract_id = $(this).parent().parent().find('.contract_id').val();
           var delivery_from = $(this).parent().parent().find('.delivery_from').val();
           var delivery_to = $(this).parent().parent().find('.delivery_to').val();
           var status = $(this).parent().parent().find('.status').val();
           $.post("../controllers/orders.class.php", {
                    customer_id: customer_id,
                    id: id,
                    contract_id: contract_id,
                    delivery_from: delivery_from,
                    delivery_to: delivery_to,
                    status: status,
                    button_click: 'add'
                },
                function(data) {
                    if(data != false) {
                        $.getJSON("../controllers/orders.class.php", {id: data, button_click: 'get_last_insert_line'}, function(json) {
                            var line_customer_id   = '<tr><td><input type="text" class="customer_id"   value='+json.customer_name+' id="'+json.customer_id+'"></td>';
                            var line_id   = '<td><input type="text" class="id"   value='+json.id+'></td>';
                            var line_contract_id   = '<td><input type="text" class="contract_id "   value='+json.contract_id  +'></td>';
                            var line_delivery_from = '<td><input type="text" class="delivery_from"   value='+json.delivery_from +'></td>';
                            var line_delivery_to   = '<td><input type="text" class="delivery_to"   value='+json.delivery_to+'></td>';
                            var line_status        = '<td>' +
                                '                         <select name="Статус" class="status">' +
                                                                '<option value='+json.status+'>Новый</option>' +
                                                                '<option value='+json.status+'>Выполняется</option>' +
                                                                '<option value='+json.status+'>Завершен</option>' +
                                                          '</select>' +
                                                      '</td></tr>';
                            var line = line_customer_id+line_id+line_contract_id+line_delivery_from+line_delivery_to+line_status;
                            $('#order_table').append(line);
                        });
                    }
                    else {
                        alert('не добавили');
                    }
                });
        });

        $('.update').click(function(element){

            var element = $(this);
            var customer_id = $(this).parent().parent().find('.customer_id').attr('id');
            var id = $(this).parent().parent().find('.id').val();
            var contract_id = $(this).parent().parent().find('.contract_id').val();
            var delivery_from = $(this).parent().parent().find('.delivery_from').val();
            var delivery_to = $(this).parent().parent().find('.delivery_to').val();
            var status = $(this).parent().parent().find('.status').val();
            $.post("../controllers/orders.class.php", {
                    customer_id: customer_id,
                    id: id,
                    contract_id: contract_id,
                    delivery_from: delivery_from,
                    delivery_to: delivery_to,
                    status: status,
                    button_click: 'update'
                },
                function(data) {
                    if(data != false) {
                        Notify('Готово');
                        $(element).hide();
                    }
                    else {
                        Notify('Не сохранили');
                    }
                });
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
            <td><input type='text' class='customer_id' value='".$customer_data['name']."' id='".$orders_line['customer_id']."'></td>
            <td><input type='text' class='id' value='".$orders_line['id']."'></td>
            <td><input type='text' class='contract_id' value='".$orders_line['contract_id']."'></td>
            <td><input type='text' class='delivery_from' value='".$orders_line['delivery_from']."'></td>
            <td><input type='text' class='delivery_to' value='".$orders_line['delivery_to']."'></td>
            <td>
                <select name='Статус' class='status'>";
                    echo "<option value=0"; if($orders_line['status']==0){echo " selected ";} echo ">Новый</option>";
                    echo "<option value=1"; if($orders_line['status']==1){echo " selected ";} echo ">Выполняется</option>";
                    echo "<option value=2"; if($orders_line['status']==2){echo " selected ";} echo ">Завершен</option>";
                echo "
                </select>
            </td>
            <td><input type='button' class='update show_on_change' name='update' value='Сохранить'></td>
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
            <td><input type='text' class='customer_id'   value='клиент' id='1'></td> <!-- сделать чтобы id заполнялся из автокомплита-->
            <td><input type='text' class='id'   value=''></td>
            <td><input type='text' class='contract_id'    value='договор'></td>
            <td>

            <div class='kladr'> 
                <div class ='address'>
                    <input class='delivery_from' type='text' name='location_1' id='distance_start_town' value='пункт отправки'>
                        </div>
                <div id='kladr_autocomplete'>
                    <ul class='kladr_autocomplete_location' style='display: none;'></ul>
                    <div class='spinner kladr_autocomplete_location_spinner' style='display: none;'></div>
                    <ul class='kladr_autocomplete_street' style='display: none;'></ul>
                    <div class='spinner kladr_autocomplete_street_spinner' style='display: none;'></div>
                </div>

            </td>
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

?>

        <script>    

        var container = $('.kladr');
        
        // Автодополнение населённых пунктов
        container.find( '[name="location_1"]' ).kladr({
            token: '51dfe5d42fb2b43e3300006e',
            key: '86a2c2a06f1b2451a87d05512cc2c3edfdf41969',
            type: $.kladr.type.city,
            select: function( obj ) {
                // Изменения родительского объекта для автодополнения улиц
                container.find( '[name="street_1"]' ).kladr('parentId', obj.id);
            }
        });
        </script>