<?php

class shopProduct {

	public $id;

	public $axcode;

	public $mtcode;

	public $title;

	public $slogan;

	public $categ;

	public $desc;        //описание видимое на странице	

	public $desclong;    //описание показывающееся по кнопке подробнее

	public $desccatalog; //описание в каталоге

	public $carouselpict;//картинка в карусели

	public $toppict;  	 //картинка в карусели
	
	public $video_useplaces;//код видео c применением с youtube 

	public $useplaces;   //массив url'ов фоток с местами применения

	public $howitworks;  //массив url'ов фоток, на которых показано как товар работет

	public $forwho;      //для кого этот товар

	public $tech;        //технические характеристики

	public $techlong;        //технические характеристики

	public $benifits;     

	public $price;	

	public $eshoplink;	

	public $alsobuy;	//id товаров, которые будут показаны в блоке "с этим товаром также покупают"



	function __construct ($id,$axcode,$mtcode,$title,$slogan,$categ,$desc,$desclong,$desccatalog,$carouselpict,$toppict,$video_useplaces,$useplaces,$howitworks,$forwho,$tech,$techlong,$benifits,$price,$eshoplink,$alsobuy,$color){

		$this->id=$id;

		$this->axcode=$axcode;

		$this->mtcode=$mtcode;

		$this->slogan=$slogan;

		$this->title=$title;

		$this->categ=$categ;

		$this->desc=$desc;

		$this->desclong=$desclong;

		$this->desccatalog=$desccatalog;

		$this->carouselpict=$carouselpict;
		
		$this->video_useplaces=$video_useplaces; 	//

		$this->toppict=$toppict;

		$this->useplaces=$useplaces;

		$this->howitworks=$howitworks;

		$this->forwho=$forwho;

		$this->tech=$tech;

		$this->techlong=$techlong;

		$this->benifits=$benifits;

		$this->price=$price;

		$this->eshoplink=$eshoplink;

		$this->alsobuy=$alsobuy;

		$this->color=$color;

	}

	

	static function test(){

		return "I am test";

	}

	

	static function getCategories ($db){

		$query="SELECT id, title FROM categories WHERE schema_id<>0";

		$result=$db->query($query);

		$i=0;

		while($row=$result->fetch()){

			$categories[$i]['id']=$row['id'];

			$categories[$i]['title']=$row['title'];

			$i++;

		}

		return $categories;

	}

	

	static function getAxcodePriceJSON($db){

		$query="SELECT axcode, price FROM product2";

		$result=$db->query($query);

		while($row=$result->fetch()){

			if(!empty($row['axcode']) and !empty($row['price'])){

				$axcodePriceJSON.=$row['axcode'].";".$row['price']."\n";

			}

		}

		$axcodePriceJSON.="878309;2970\n";// выводим спеццену для mt9000

		return $axcodePriceJSON;

	}

	static function checkAxcodePrice($db, $axcode_price){

		$query="SELECT p2.axcode, p2.mtcode, p2.price, p2.title FROM product2 as p2, product as p 

		WHERE p.id=p2.id and in_sale=1 order by p2.mtcode";

		$result=$db->query($query);

		while($row=$result->fetch()){

			$check_qty=getQtyDKO($row['axcode']);

			if(empty($row['axcode']) or empty($row['price']) or (!array_key_exists($row['axcode'],$axcode_price)) or !$check_qty ){

				$err_mtcodes[]=$row['mtcode']."-".$row['title']."<br />";

			}

		}

		return $err_mtcodes;

	}

	

	

	static function getProducts ($db){

		$query="SELECT p2.title, p2.mtcode, p2.id, p.id FROM product2 as p2, product as p 

		WHERE p.id=p2.id and p.end_production=0 and in_sale=1 order by p2.mtcode";// убираем снятые с производства

		$result=$db->query($query);

		$i=0;

		while($row=$result->fetch()){

			$products[$i]['id']=$row['id'];

			$products[$i]['title']=$row['mtcode']."-".$row['title'];

			$i++;

		}

		return $products;

	}

	static function getProductsAll ($db){

		$query="SELECT p2.title, p2.mtcode, p2.id, p.id FROM product2 as p2, product as p

		WHERE p.id=p2.id and p.end_production=0 order by p2.mtcode";// все товары в том числе снятые с продажи

		$result=$db->query($query);

		$i=0;

		while($row=$result->fetch()){

			$products[$i]['id']=$row['id'];

			$products[$i]['title']=$row['mtcode']."-".$row['title'];

			$i++;

		}

		return $products;

	}

	

	static function getAllProductsForCatalog ($db, $sort, $order){

		if(!$sort){

			$sort='`title`';

		}

		if(!$order){

			$order='asc';

		}

		$query="SELECT p2.title, p2.mtcode,p2.price,p2.carouselpict,p2.desccatalog, p2.id, p2.eshoplink, p2.benifits, p.id, p.novinka,p.in_carousel,p.in_sale,p.na_sklade, p.ishop_url3 FROM product2 as p2, product as p

		WHERE p.id=p2.id and p.in_sale=1 order by p2.".$sort." ".$order;// убираем снятые с производства

		/*echo "SELECT p2.title, p2.mtcode,p2.price,p2.carouselpict,p2.desccatalog, p2.id, p2.eshoplink, p2.benifits, p.id, p.novinka,p.in_carousel,p.in_sale,p.na_sklade, p.ishop_url3 FROM product2 as p2, product as p

		WHERE p.id=p2.id and p.in_sale=1 order by p2.".$sort." ".$order;*/

		$result=$db->query($query);

		return $result;

	}

	

	static function getSearchProductIds($db,$searchstring){

		$query="SELECT product.id  FROM product	

		left join describes

		on product.id=describes.product_id		

		left join tags_array		

		on tags_array.product_id=describes.product_id		

		left join tags		

		on tags_array.tag_id=tags.id		

		left join tags_array1		

		on tags_array1.product_id=describes.product_id		

		left join tags1		

		on tags_array1.tag_id=tags1.id	

		left join product2

		on product.id=product2.id			

		WHERE  (`product`.`in_sale`=1) AND ((`product`.`name` LIKE '%".$searchstring."%') OR (tags.name like '%".$searchstring."%') OR (tags1.name like '%".$searchstring."%')		

		OR (`product2`.`title` LIKE '%".$searchstring."%') OR  (`product2`.`benifits` LIKE '%".$searchstring."%')

		OR (`describes`.`catalog_descr` LIKE '%".$searchstring."%' OR `describes`.`short_descr` LIKE '%".$searchstring."%' OR `describes`.`full_descr` LIKE '%".$searchstring."%')) group by product.id		

		order by RIGHT(product.name, 6)"; 

		$result=$db->query($query);

		if(!$result){

			return false;

		}

		while($row=$result->fetch()){

			$idsArray[]=$row['id'];

		}

		return $idsArray;

	}

	

	static function getCategoryProductIds($db,$category, $sort, $order){

		/*Имена полей в базе взяты со старой базы.

		 Не стал переименовывать поля-признаки, которые выполняли ровно тот же 

		 функционал, но назывались по другому

		 поля соотносятся так: 

		 hits(хиты) - in_carousel

		 new (новинки) - novinka

		 actions (акции) - zakaz

		 soon (скоро) - na_sklade

		 */

		if(!$sort){

			$sort='`title`';

		}

		if(!$order){

			$order='asc';

		}

		if($category=='hits'){

			$category='in_carousel'; // имя поля в базе

		}

		if($category=='new'){

			$category='novinka';

		}

		if($category=='gifts'){

			$category='zakaz';

		}

		if($category=='soon'){

			$category='na_sklade';

		}

		$query="SELECT product.id  FROM product 

		left join product2 on (product.id=product2.id )

		WHERE product.".$category."=1 and in_sale=1 order by product2.".$sort." ".$order;

		$result=$db->query($query);

		if(!$result){

			return false;

		}

		while($row=$result->fetch()){

			$idsArray[]=$row['id'];

		}

		return $idsArray;

	}

	

	

	static function getShopProduct($id,$db){

		$query="SELECT * FROM product2 WHERE id=".$id." limit 1";

		$result=$db->query($query);

		$row=$result->fetch();

		$shopProduct=new shopProduct(

			$row['id'],$row['axcode'],$row['mtcode'],$row['title'],$row['slogan'],$row['categ'],$row['desc'],$row['desclong'],

			$row['desccatalog'],$row['carouselpict'],$row['toppict'],$row['video_useplaces'],$row['useplaces'],$row['howitworks'],$row['forwho'],$row['tech'],

			$row['techlong'], $row['benifits'],$row['price'],$row['eshoplink'],$row['alsobuy'],$row['color']

		);

		return $shopProduct;

	}

	static function getShopProductVersion($id,$db){

		$query="SELECT ishop_url3 FROM product WHERE id=".$id." limit 1";

		$result=$db->query($query);

		$row=$result->fetch();

		return $row['ishop_url3']; // в этом поле храниться версия карточки товара v2.0 (чудокит) либо пусто

	}

	

	static function getShopCatalogProperties($id,$db){ // получаем "каталожные" свойства товаров: хит, новинка, снят с пр-ва, в_карусели, в продаже

		$query="SELECT  in_carousel,in_sale,end_production,novinka,na_sklade,ishop_url3  FROM product WHERE id=".$id." limit 1";

		$result=$db->query($query);

		$row=$result->fetch();

		return $row;

	}
	
	static function getShopCatalogName($id,$db){ // получаем "каталожные" свойства товаров: хит, новинка, снят с пр-ва, в_карусели, в продаже
	
		$query="SELECT  RIGHT(name, 6) as code, `name`  FROM product WHERE id=".$id." limit 1";
	
		$result=$db->query($query);
	
		$row=$result->fetch();
	
		return $row;
	
	}
	

	

	static function getShopProductProp($id,$propName,$db){

		$query="SELECT `$propName` FROM product2 WHERE id=".$id." limit 1";

		$result=$db->query($query);

		$row=$result->fetch();

		$propValue=$row[$propName];

		return $row[$propName];

	}

	static function getShopProductForMap($id,$db){ // надо будет добавить количество, когда появится

		$query="SELECT title, eshoplink FROM product2 WHERE id=".$id." limit 1"; // title2 лежит в echoplink

		$result=$db->query($query);

		$row=$result->fetch();

		$totalres=$row['title'].":".$row['eshoplink'];

		return $totalres;

	}

		

	

	static function getShopProductFromForm(){

		//var_dump($_FILES);

		$id=dataChecker::checkStr($_POST['id']);

		$axcode=dataChecker::checkStr($_POST['axcode']);

		$mtcode=dataChecker::checkStr($_POST['mtcode']);

		$title=dataChecker::checkStr($_POST['title']);

		$slogan=dataChecker::checkStr($_POST['slogan']);

		$categ=dataChecker::checkStr($_POST['categ']);

		$desc=dataChecker::checkStr($_POST['desc']);

		$desclong=dataChecker::checkStr($_POST['desclong']);

		$desccatalog=dataChecker::checkStr($_POST['desccatalog']);

		$carouselpict=dataChecker::checkStr($_POST['carouselpictlink']);

		$toppict=dataChecker::checkStr($_POST['toppictlink']);
		
		$video_useplaces=dataChecker::checkStr($_POST['video_useplaces']);	// замена

		$useplaces=implode(",", $_POST['useplaceslink']);

		$howitworks=implode(",", $_POST['howitworkslink']);

		$forwho=dataChecker::checkStr($_POST['forwho']);

		$tech=dataChecker::checkStr($_POST['tech']);

		$techlong=dataChecker::checkStr($_POST['techlong']);

		$benifits=implode(";", $_POST['benifits']);

		$price=dataChecker::checkStr($_POST['price']);

		$eshoplink=dataChecker::checkStr($_POST['eshoplink']);

		$alsobuy=$_POST['alsobuy0'].",".$_POST['alsobuy1'].",".$_POST['alsobuy2'].",".$_POST['alsobuy3'];

		$color=$_POST['color'];

		$shopProduct=new shopProduct(

			$id,$axcode,$mtcode,$title,$slogan,$categ,$desc,$desclong,

			$desccatalog,$carouselpict,$toppict,$video_useplaces,$useplaces,$howitworks,	// Замена

			$forwho,$tech,$techlong,$benifits,$price,$eshoplink,$alsobuy,$color

		);

		return $shopProduct;

	}

	

	

	function pictureExist($pict){

		$PATH_TO_PICT="../pictures/productpict";

		$possibleFiles=glob($PATH_TO_PICT."/".$pict."/".$this->mtcode."_".$pict."*", GLOB_NOSORT);

		if(is_array($possibleFiles)){

			return $possibleFiles;

		}

		return false;

	}

	function unlinkPicture($pict){

		return false;

	}

	function delPictureFromDB($pict){

		return false;

	}

	

	

	

	

	function showProductList($selectname,$selectid,$db){

		$products=self::getProducts($db);

		if(!$selectname){

			return false;

		}

		if($selectid){

			$fcontent.="<select name='".$selectname."' >";

		}

		else{

			$fcontent.="<select name='".$selectname."'>";

		}

		$alsobuyIds=explode(",",$this->alsobuy);



		/*var_dump($products);die;*/

		foreach($products as $value){

				if($value['id']==$alsobuyIds[substr($selectname,-1)]){ 

					/*Строка выше: вырезаем последний символ из select Это цифра. 

					Соотвественно получаем номер select'a: 1,2,3 или 4.Это пиздец и надо было делать через массив, но так получилось:(*/

			   			$fcontent.="<option value='".$value['id']."' selected>".$value['title']."</option>";

		   		}

		   		else{

		   			$fcontent.="<option value='".$value['id']."'>".$value['title']."</option>";

		   		}

	   }

	   $fcontent.="</select>";

	   return $fcontent;

	}

	

	

	function getProductEditForm($db){

	$carouselpict=$this->pictureExist("carouselpict");	   

	$toppict=$this->pictureExist("toppict");

	$useplaces=$this->pictureExist("useplaces");

	natsort($useplaces);

	$howitworks=$this->pictureExist("howitworks");	

	natsort($howitworks);

	$content.="<br/><br/>

			   <form name=frm1 action='' method=post enctype=multipart/form-data>

			   <table cellspacing=1 cellpadding=5 bgcolor=#cccccc>

			   <tr><td colspan =3 bgcolor=#ffffff align=center><input type=submit name=go value='Сохранить изменения'></td></tr>

			   <tr><td width=200 bgcolor=#ffffff>Места применения </td>

			   <td width=200 bgcolor=#ffffff id='useplace'>

			   <a href=http://".$_SERVER['HTTP_HOST']."/admin/mod/uploadify/index.php?mtcode=".$this->mtcode."&phototype=useplaces>Загрузить фото в раздел \"места применения\"</a>

			   </td>

			   <td width=600 bgcolor=#ffffff>";

				foreach ($useplaces as $value){	

					if(!empty($value)){	

						$valueTh=str_replace('../pictures/productpict/', '../pictures/productpict/th/', $value);		

						$content.="<span style='cursor:pointer; margin:3px;'><img class='".$this->id."' src='".$valueTh."' height='100'></span>";

					}

				}

	$content.="</td>

			   </tr>

			   <tr><td width=200 bgcolor=#ffffff>Как это работает</td>

			   <td width=200 bgcolor=#ffffff id='useplace'>

			   <a href=http://".$_SERVER['HTTP_HOST']."/admin/mod/uploadify/index.php?mtcode=".$this->mtcode."&phototype=howitworks>Загрузить фото в раздел \"как это работает\"</a>

			   </td>

			   <td width=600 bgcolor=#ffffff>";

				foreach ($howitworks as $value){	

					if(!empty($value)){	

						$valueTh=str_replace('../pictures/productpict/', '../pictures/productpict/th/', $value);		

						$content.="<span style='cursor:pointer; margin:3px;'><img class='".$this->id."' src='".$valueTh."' height='100'></span>";

					}

				}

	$content.="</td>

			   </tr>";

	$content.="</td>

			   </tr>

			   <tr><td width=200 bgcolor=#ffffff>Название</td><td colspan=2  width=800 bgcolor=#ffffff><input type='text' size=40 name='title' value='".$this->title."'></td></tr>

			   <tr><td width=200 bgcolor=#ffffff>Axcode</td><td colspan=2 width=800 bgcolor=#ffffff><input type='text' size=16 name='axcode' value=".$this->axcode."></td></tr>

			   <tr><td width=200 bgcolor=#ffffff>MTcode</td><td colspan=2 width=800 bgcolor=#ffffff><input type=''text' size=16 name='mtcode' value='".$this->mtcode."'></td></tr>

			   <tr><td width=200 bgcolor=#ffffff>Цена</td><td colspan=2 width=800 bgcolor=#ffffff><input type='text' size=16 name='price' value=".$this->price."></td></tr>

			   <tr><td width=200 bgcolor=#ffffff>-Цвет фона <br/> -Цвет шрифта блока ключевая полезность<br/> -Цвет рекомендованной цены. <br/>Все через запятую</td><td colspan=2 width=800 bgcolor=#ffffff><input type='text' size=16 name='color' value=".$this->color."></td></tr>";

	$content.="<tr><td width=200 bgcolor=#ffffff>Слоган</td>

			   <td colspan=2 width=800 bgcolor=#ffffff>

			   <script type=\"text/javascript\">

				var oFCKeditor = new FCKeditor('slogan');

				oFCKeditor.BasePath = \"../fckeditor/\";

				oFCKeditor.Value='$this->slogan';

				oFCKeditor.Height=120;

				oFCKeditor.Create();

			   </script>

			   </td></tr>";
			   
			   
			   $content.="<tr><td width=200 bgcolor=#ffffff>Код Видео применения с youtube</td>
			   <td colspan=2 width=800 bgcolor=#ffffff>
			   <input name='video_useplaces' type='text' style='width:100%;' value='".$this->video_useplaces."'>
			   </td></tr>";

	$content.="<tr><td width=200 bgcolor=#ffffff>Картинка в карусели</td><td width=200 bgcolor=#ffffff><input type='file' name='carouselpict'><input name='carouselpictlink' type=hidden value='".$carouselpict[0]."'></td>

			   <td width=600 bgcolor=#ffffff>";

	if($carouselpict[0]){$content.="<img src='".$carouselpict[0]."'>";}

	$content.="</td>

			   </tr>

			   <tr><td width=200 bgcolor=#ffffff>Картинка в шапке</td><td width=200 bgcolor=#ffffff><input type='file' name='toppict' value='".$toppict[0]."'><input name='toppictlink' type='hidden' value='".$toppict[0]."'></td>

			   <td width=600 bgcolor=#ffffff>";

	if($toppict[0]){$content.="<img src='".$toppict[0]."'>";}

	$content.="</td></tr>

			   <tr><td width=200 bgcolor=#ffffff>Полезность <span id='addbenefit' class='additem'>+/</span><span id='delbenefit' class='additem'>-</span></td><td colspan=2 width=800 bgcolor=#ffffff id='benefits'>";

				$benefits=explode(";",$this->benifits);

				foreach ($benefits as $value){	

					if(!empty($value)){			

						$content.="<input type='text' size=100 name='benifits[]' value='".$value."'>";

					}

				}

	$content.="</td></tr>

			   <tr><td width=200 bgcolor=#ffffff>Расшифровка имени</td><td colspan=2 width=800 bgcolor=#ffffff><input type='text' size=40 name='eshoplink' value='".$this->eshoplink."'></td></tr>

			   <tr><td width=200 bgcolor=#ffffff>Категория</td><td colspan=2 width=800 bgcolor=#ffffff>

			   <select name=categ>";

			   $categories=shopProduct::getCategories($db);

			   foreach($categories as $value){

			   		if($value['id']==$this->categ){

			   			$content.="<option value=".$value['id']." selected>".$value['title']."</option>";

			   		}

			   		else{

			   			$content.="<option value=".$value['id'].">".$value['title']."</option>";

			   		}

			   }

	$content.="</select>

			   </td></tr>";

	$content.="<tr><td width=200 bgcolor=#ffffff>Описание</td>

			   <td colspan=2 width=800 bgcolor=#ffffff>

			   <script type=\"text/javascript\">

				var oFCKeditor = new FCKeditor('desc');

				oFCKeditor.BasePath = \"../fckeditor/\";

				oFCKeditor.Value='$this->desc';

				oFCKeditor.Height=200;

				oFCKeditor.Create();

			   </script>

			   </td></tr>";

	$content.="<tr><td width=200 bgcolor=#ffffff>Подробное описание</td>

			   <td colspan=2 width=800 bgcolor=#ffffff>

			   <script type=\"text/javascript\">

				var oFCKeditor = new FCKeditor('desclong');

				oFCKeditor.BasePath = \"../fckeditor/\";

				oFCKeditor.Value='$this->desclong';

				oFCKeditor.Height=200;

				oFCKeditor.Create();

			   </script>

			   </td></tr>";

	$content.="<tr><td width=200 bgcolor=#ffffff>Описание в каталоге</td>

			   <td colspan=2 width=800 bgcolor=#ffffff>

			   <script type=\"text/javascript\">

				var oFCKeditor = new FCKeditor('desccatalog');

				oFCKeditor.BasePath = \"../fckeditor/\";

				oFCKeditor.Value='$this->desccatalog';

				oFCKeditor.Height=200;

				oFCKeditor.Create();

			   </script>

			   </td></tr>";

	

	$content.="<tr><td width=200 bgcolor=#ffffff>Кому пригодится</td>

			   <td colspan=2 width=800 bgcolor=#ffffff>

			   <script type=\"text/javascript\">

				var oFCKeditor = new FCKeditor('forwho');

				oFCKeditor.BasePath = \"../fckeditor/\";

				oFCKeditor.Value='$this->forwho';

				oFCKeditor.Height=200;

				oFCKeditor.Create();

			   </script>

			   </td></tr>";

	$content.="<tr><td width=200 bgcolor=#ffffff>Технические данные</td>

			   <td colspan=2 width=800 bgcolor=#ffffff>

			   <script type=\"text/javascript\">

				var oFCKeditor = new FCKeditor('tech');

				oFCKeditor.BasePath = \"../fckeditor/\";

				oFCKeditor.Value='$this->tech';

				oFCKeditor.Height=200;

				oFCKeditor.Create();

			   </script>

			   </td></tr>";

	$content.="<tr><td width=200 bgcolor=#ffffff>Технические данные (подробно)</td>

			   <td colspan=2 width=800 bgcolor=#ffffff>

			   <script type=\"text/javascript\">

				var oFCKeditor = new FCKeditor('techlong');

				oFCKeditor.BasePath = \"../fckeditor/\";

				oFCKeditor.Value='$this->techlong';

				oFCKeditor.Height=200;

				oFCKeditor.Create();

			   </script>

			   </td></tr>

			    <tr><td width=200 bgcolor=#ffffff>Также  покупают</td><td colspan=2  width=800 bgcolor=#ffffff>

			    ".$this->showProductList('alsobuy0',null,$db)."<br/>"

				 .$this->showProductList('alsobuy1',null,$db)."<br/>"

				 .$this->showProductList('alsobuy2',null,$db)."<br/>"

				 .$this->showProductList('alsobuy3',null,$db)."

			    </td></tr>";

	$content.="<tr><td colspan=3 bgcolor=#ffffff align=center><input type='submit' name='go' value='Сохранить изменения'></td></tr>";

	$content.="<tr><td colspan=3 bgcolor=#ffffff align=center><input type='hidden' name='id' value=".$this->id."></td></tr>";

	$content.="</table>

			   </form>"; 

	return $content;

	}

	static function showCatalogProduct($product,$productProp,$desc, $row){

		if($row){// показываем весь каталог,  свойства продукта получены через $row

			$carouselpict=$row['carouselpict'];

			$price=$row['price'];

			$novinka=$row['novinka'];

			$hit=$row['in_carousel'];

			$soon=$row['na_sklade']; // скоро

			$in_sale=$row['in_sale'];

			$title=$row['title'];

			$title2=$row['eshoplink'];

			$id=$row['id'];

			$version=$row['ishop_url3']; //v2.0 - чудокит, влияет на паттерн в каталоге

			$qty=3;

			$mtcode=$row['mtcode'];

			$benifits=explode(";",$row['benifits']);

				foreach($benifits as $benifit){

					$usefullness.="<div class='catalog_usefullness_item'>".$benifit."</div>";

				}

		}

		else{

			$carouselpict=$product->carouselpict;

			$price=$product->price;

			$novinka=$productProp['novinka'];

			$hit=$productProp['in_carousel'];

			$soon=$productProp['na_sklade']; // скоро

			$in_sale=$productProp['in_sale'];

			$title=$product->title;

			$title2=$product->eshoplink;

			$version=$productProp['ishop_url3'];//v2.0 - чудокит, влияет на паттерн в каталоге

			$id=$product->id;

			$qty=3;

			$mtcode=$product->mtcode;

				$benifits=explode(";",$product->benifits);

				foreach($benifits as $benifit){

					$usefullness.="<div class='catalog_usefullness_item'>".$benifit."</div>";

				}

		}

		if($version=="v2.0"){ // чудокит

			$catalog_class="catalog-itemfs-chudo";

			$catalog_name="catalog_name-chudo";

			$catalog_logo="catalog_logo";

			$catalog_name_a="catalog_name-chudo_a";

			

		}

		else{ // гаджеты

			$catalog_class="catalog-itemfs";

			$catalog_name="catalog_name";

			$catalog_logo="";

			$catalog_name_a="none";

		}

		$res="

			<div class='".$catalog_class."'>

					

				<div id='".$id."' class='catalog_foto'  style='cursor:pointer; background-size: cover'>";

				if($hit){

					$res.="<div class='catalog_top_hit' onclick='linkHits()'>хит</div>";

				}

				if($carouselpict){

					$res.="<img id='".$id."'  src='".$carouselpict."' class='catalog_img' onclick='linkProduct(this)'>";

				}

				else{

					$res.="<img id='".$id."'  src='../templates/new_images/no_photo.png' class='catalog_img' onclick='linkProduct(this)'>";

				}

				if($soon){	

					$res.="

					<div id='".$id."' class='catalog_price_soon'>Скоро</div>";

				}

				else{

					$res.="

					<div id='".$id."' class='catalog_price' onMouseOver='showBuy(this);' onMouseOut='showPrice(this);' onclick='insProduct(this);'>".$price." Р</div><span id='".$price."'></span>";

				}	

				if($novinka){

					$res.="<div class='catalog_hit' onclick='linkNews()'>новинка</div>";

				}

					$res.="

				<div class='".$catalog_logo."'></div>

				</div>

				

				<div class='catalog_names'>

					<div class='catalog_disc'>".$title2."</div>
					
					<div id='".$id."' class='".$catalog_name."'  onclick='linkProduct(this)' ><!--<a class='".$catalog_name_a."' href='../product/".$id.".htm'>-->".$title."<!--</a>--></div>

				</div>

				

				<div class='catalog_texts'>

					<div class='catalog_usefullness'>".$usefullness."</div>

					<div class='catalog_text'>".$desc."</div>

				</div>

				<div id='".$id."' class='catalog_cart' onclick='insProduct(this)'><div class='catalog_cart_in'>в корзину</div></div>

				<div style='position: absolute;  bottom: 2px; right: 5px; color: #888; font-size: 11px;'>".$mtcode."</div>

			</div>";

		return $res;

	}

	static function getIdBySeoname($seoname,$db){
		$query="SELECT id FROM product2 WHERE seoname='".$seoname."' limit 1";
		$result=$db->query($query);
		if($result){
			$row=$result->fetch();
			return $row['id'];
		}
		else{
			return false;
		}
	}
	
	static function getSeonameById($id,$db){
		$query="SELECT seoname FROM product2 WHERE id=".$id." limit 1";
		$result=$db->query($query);
		if($result){
			$row=$result->fetch();
			return $row['seoname'];
		}
		else{
			return false;
		}
	}
}



?>