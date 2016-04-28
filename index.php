<!DOCTYPE html>
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
			<?php 
				if(isset($_GET['page']) && $_GET['page']!==''){
					if (file_exists('pages/'.$_GET['page'].'.php')) { // todo запилить массив файлов вместо file_exists
						include('pages/'.$_GET['page'].'.php');
					} else {
						include('pages/404.php');
					}
				} else {
					include('pages/'.'home.php');
				}
			?>
		</div>

		<div class="push"></div>
	</div>
	
	<?php include('pages/footer.php') ?>

</body> 
</html>