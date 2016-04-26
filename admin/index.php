<?php
require_once('config.php');
require_once('models/users.class.php');
?>
<head>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
	<script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
	<script src="js.js"></script>
	<link rel="stylesheet/less" href="style.less">
	<script src="../js/less.js"></script>
    <script src="../js/login_substitute.js" type="text/javascript"></script>
    <script src="../js/auth.js" type="text/javascript"></script>

	<script src="../js/kladr.js" type="text/javascript"></script>
</head>
<span class='error'></span><br/>
<?php
if(empty($_SESSION) || (isset($_SESSION['error']) && $_SESSION['error'] == true)) {
    ?>
    <input type="text" name="username" class="tracking_input" id="username" value="Логин"><br/>
    <input type="password" name="password" class="tracking_input" id="password" value="Пароль"><br/>
    <input type="button" name="login" class="tracking_input" type="button" id="login" value="Вход">
<?php
}
if(isset($_SESSION['user_id']) && $_SESSION['user_id'] > 0 ) {
    $user = new UsersModel();
    $user_data = $user->getTableDataById((int)$_SESSION['user_id']);
    if($user_data[0]['role'] == 'admin') {
        ?>
        <div id="tabs">
            <div class="header">
                <ul class="tabs">
                    <li><a href="#orders">Заказы</a></li>
                    <li><a href="#contracts">Договора</a></li>
                    <li><a href="#customers">Клиенты</a></li>
                    <li><a href="#cars">Машины</a></li>
                </ul>

            </div>

            <div id="orders">
                <?php include(BASE_PATH . '/admin/view/orders_2.php'); ?>

            </div>

            <div id="contracts">
                <?php include(BASE_PATH . '/admin/view/contracts_2.php'); ?>
            </div>

            <div id="customers">
                <?php include(BASE_PATH . '/admin/view/customers_2.php'); ?>
            </div>

            <div id="cars">
                <?php include(BASE_PATH . '/admin/view/cars_2.php'); ?>
            </div>

        </div>
    <?php
    }
    else {
        echo "У вас нет прав доступа к этой странице<br/>";
        echo '<input type="button" name="logout" class="tracking_input " id="logout" value="Выход">';
    }
}
?>



