<?php
error_reporting(0);
/* Основной блок конфигурации */

$base_url="http://test.gadgets.masterkit.ru";
$domain="http://test.gadgets.masterkit.ru";
$multilanguage=0; //многоязычный сайт или нет
$lang='ru'; //язык для выбора значений из таблицы языковых массивов - язык сайта по умолчанию
$offset=0; //устанавливаем смещение для того, если сайт расположен не в document_root, а в поддиректории. Тогда в $_SERVER['REQUEST_URI'] появляется лишняя поддиректория, которую надо устранить

//подключаем базу данных. Будем работать через PDO.
$dsn = 'mysql:dbname=test-gadgets;host=172.20.30.101';
$user = 'dbadm';
$password = 'TckbDfcWtke7nHfp';
//$password = 'fewEDYQe#Aje';


try {
  $db = new PDO($dsn, $user, $password);  
} catch (PDOException $e) {
	header("location: {$base_url}/error.php");
    echo 'Connection failed: ' . $e->getMessage();
}
$db->exec("SET NAMES UTF8");

//подключились к БД и научили ее работать с UTF8

setlocale(LC_ALL, 'ru_RU');


$contact_mail="infomk@masterkit.ru,oglebova@compel.ru";

$support_mail="infomk@masterkit.ru,oglebova@compel.ru";

$noreply_mail="noreply@masterkit.ru,oglebova@compel.ru";

$date_format="H:i d:m:Y";

?>
