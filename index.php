<!DOCTYPE html>
<?php class App {
	const COMPANY_NAME = 'Авто-Пушкино';

	public static $phones = array(
		'88888888',
		'99999999'
	);

	public static  $pages = array(
		'/about' => 'О компании',
		'/contacts' => 'Контактная информация',
		'/price_list' => 'Цены',
		'/photo' => 'Галерея работ',
		'/tecknology' => 'Технология строительсва дорог',
		'/service/asfaltirovanie_dorog' => 'Асфальтирование дорог',
		'/service/asfaltirovanie_malih_ploshadei' => 'Асфальтирование малых площадей',
		'/service/prodaja_asfaltovoi_kroshki' => 'Продажа асфальтовой крошки',
		'/service/remont_dachnih_i_kottedjnih_dorog' => 'Ремонт дачных и коттеджных дорог',
		'/service/stroitelstvo_dorog' => 'Строительство дорог',
		'/service/ukladka_asfaltovoi_kroshki' => 'Укладка асфальтовой крошки',
		'/service/ukladka_tratuarnoi_plitki' => 'Укладка тратуарной плитки',
		'/service/ustanovka_bortovih_kamnei' => 'Установка бортовых камней',
		'/service/yamochnii_remont_dorog' => 'Ямочный ремонт дорог'
	);

	public static function getPageTitle() {
		$current_page = $_SERVER['REQUEST_URI'];
		if(!empty(self::$pages[$current_page])) {
			return self::$pages[$current_page];
		}
		return 'Строительсвтво и ремонт дорог';
	}
}
?>
<html lang="ru">
<head>
    <!-- <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic&subset=latin,cyrillic' rel='stylesheet' type='text/css'> -->
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    <meta charset="UTF-8">
    <title>Авто Пушкино</title>
    <link rel="stylesheet" href="style/reset.css">
    <link rel="stylesheet/less" href="style/style.less?v='<?php echo rand(0, 25); ?>'">
    <script src="js/less.js"></script>
    <script src="//api-maps.yandex.ru/2.1/?load=package.full&lang=ru_RU" type="text/javascript"></script>
    <script src="//yandex.st/jquery/1.6.4/jquery.min.js" type="text/javascript"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/style.js"></script>
    <link rel="icon" href="style/favicon.ico" type="image/x-icon">
</head>
<body>
	<div class="wrapper">
			<?php include('pages/header.php') ?>
		<div class="container">
			<?php include('modules/redirect.php') ?>
		</div>

		<div class="push"></div>
	</div>
	
	<?php include('pages/footer.php') ?>

</body> 
</html>