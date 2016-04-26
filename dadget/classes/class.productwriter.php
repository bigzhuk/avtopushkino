<?php
class shopProductWriter {
	static function updateNewTable ($db){ // функция для переноса некоторых старых значений 
		$query="SELECT id, categ, name FROM product";
		$result=$db->query($query);
		while($row=$result->fetch()){
			$id=$row['id'];
			$categ=$row['categ'];
			$mtcode=substr($row['name'],-6);
			$title=substr($row['name'],0,-6);
			$queryInsert="INSERT into  product2 (id, categ,title, mtcode) values ($id,$categ,'$title','$mtcode')";
			$resultInsert=$db->query($queryInsert);
		}
		return true;
	}
	
	static function foreignIdUpdate ($db){// обновляем id в новой таблице product2  в соотвествии с product, т.к. они не связаны как foreign key на уровне базы
		$query="UPDATE product,product2 SET product2.id=product.id
		WHERE product2.mtcode=RIGHT(product.name, 6)";
		/*echo "UPDATE product,product2 SET product2.id=product.id
		WHERE product2.mtcode=RIGHT(product.name, 6)";*/
		$result=$db->query($query);
		if($result){
			return true;
		}
		else{
			echo "Ошибка при синхронизации id товаров на сайте. Сообщите программисту!";
			return false;
		}
		return false;	
	}
	/*static function foreignCatalogDescUpdate ($db){// обновляем id в новой таблице product2  в соотвествии с product, т.к. они не связаны как foreign key на уровне базы
		$query="UPDATE product,product2 SET product2.id=product.id
		WHERE product2.mtcode=RIGHT(product.name, 6)";
		$result=$db->query($query);
		if($result){
			return true;
		}
		return false;
	}*/
	static function insertProductToBase($shopProduct,$db){
		$query="INSERT into product2 (
		axcode,
		mtcode,
		title,
		slogan,
		categ,
		`desc`,
		desclong,
		desccatalog,
		carouselpict,
		toppict,
		video_useplaces,
		forwho,
		tech,
		techlong,
		benifits,
		price,
		eshoplink,
		alsobuy,
		color
		) 
		values (
		$shopProduct->axcode,
		'".$shopProduct->mtcode."',
		'".$shopProduct->title."',
		'".$shopProduct->slogan."',
		   $shopProduct->categ,
		'".$shopProduct->desc."',
		'".$shopProduct->desclong."',
		'".$shopProduct->desccatalog."',
		'".$shopProduct->carouselpict."',
		'".$shopProduct->toppict."',
		'".$shopProduct->video_useplaces."',
		'".$shopProduct->forwho."',
		'".$shopProduct->tech."',
		'".$shopProduct->techlong."',
		'".$shopProduct->benifits."',
		'".$shopProduct->price."',
		'".$shopProduct->eshoplink."',
		'".$shopProduct->alsobuy."',
		'".$shopProduct->color."'
		)";
		$result=$db->query($query);		
		if($result){
			return true;
		}
		return false;
	}
	
	
	static function updateProductToBase($shopProduct,$db){
		$query="UPDATE product2 SET
		axcode=$shopProduct->axcode,
		mtcode='".$shopProduct->mtcode."',
		title='".$shopProduct->title."',
		slogan='".$shopProduct->slogan."',
		categ=$shopProduct->categ,
		`desc`='".$shopProduct->desc."',
		desclong='".$shopProduct->desclong."',
		desccatalog='".$shopProduct->desccatalog."',
		carouselpict='".$shopProduct->carouselpict."',
		toppict='".$shopProduct->toppict."',
		video_useplaces='".$shopProduct->video_useplaces."',
		forwho='".$shopProduct->forwho."',
		tech='".$shopProduct->tech."',
		techlong='".$shopProduct->techlong."',
		benifits='".$shopProduct->benifits."',
		price='".$shopProduct->price."',
		eshoplink='".$shopProduct->eshoplink."',
		alsobuy='".$shopProduct->alsobuy."',
		color='".$shopProduct->color."'
		WHERE id=".$shopProduct->id;
		/*echo "UPDATE product2 SET
		axcode=$shopProduct->axcode,
		mtcode='".$shopProduct->mtcode."',
		title='".$shopProduct->title."',
		slogan='".$shopProduct->slogan."',
		categ=$shopProduct->categ,
		`desc`='".$shopProduct->desc."',
		desclong='".$shopProduct->desclong."',
		desccatalog='".$shopProduct->desccatalog."',
		carouselpict='".$shopProduct->carouselpict."',
		toppict='".$shopProduct->toppict."',
		forwho='".$shopProduct->forwho."',
		tech='".$shopProduct->tech."',
		techlong='".$shopProduct->techlong."',
		benifits='".$shopProduct->benifits."',
		price='".$shopProduct->price."',
		eshoplink='".$shopProduct->eshoplink."',
		alsobuy='".$shopProduct->alsobuy."',
		color='".$shopProduct->color."'
		WHERE id=".$shopProduct->id;
		die();*/
		$result=$db->query($query);	
		
		if($result){
			return true;
		}
		return false;
	}	
	
	static function img_resize($src, $dest, $width, $height, $rgb = 0xFFFFFF, $quality = 100) {  
    if (!file_exists($src)) {  
        return false;  
    }  
  
    $size = getimagesize($src);  
  
    if ($size === false) {  
        return false;  
    }  
  
    $format = strtolower(substr($size['mime'], strpos($size['mime'], '/') + 1));  
    $icfunc = 'imagecreatefrom'.$format;  
  
    if (!function_exists($icfunc)) {  
        return false;  
    }  
  
    $x_ratio = $width  / $size[0];  
    $y_ratio = $height / $size[1];  
  
    if ($height == 0) {  
  
        $y_ratio = $x_ratio;  
        $height  = $y_ratio * $size[1];  
  
    } elseif ($width == 0) {  
  
        $x_ratio = $y_ratio;  
        $width   = $x_ratio * $size[0];  
  
    }  
  
    $ratio       = min($x_ratio, $y_ratio);  
    $use_x_ratio = ($x_ratio == $ratio);  
  
    $new_width   = $use_x_ratio  ? $width  : floor($size[0] * $ratio);  
    $new_height  = !$use_x_ratio ? $height : floor($size[1] * $ratio);  
    $new_left    = $use_x_ratio  ? 0 : floor(($width - $new_width)   / 2);  
    $new_top     = !$use_x_ratio ? 0 : floor(($height - $new_height) / 2);  
  
    $isrc  = $icfunc($src);  
    $idest = imagecreatetruecolor($width, $height);  
  
    imagefill($idest, 0, 0, $rgb);  
    imagecopyresampled($idest, $isrc, $new_left, $new_top, 0, 0, $new_width, $new_height, $size[0], $size[1]);  
  
    imagejpeg($idest, $dest, $quality);  
  
    imagedestroy($isrc);  
    imagedestroy($idest);  
  
    return true;  
}  
	static function makeThumbs($CSVString){
		$arr=explode(",",$CSVString);
		foreach($arr as $item){
			$itemTh=str_replace("../pictures/productpict/", "../pictures/productpict/th/", $item);
			shopProductWriter::img_resize($item,$itemTh,160,160);//создаем thumbs для userplaces
		}
		return true;
	}
	
	static function makeSingleThumbs($item){
			$itemTh=str_replace("/pictures/productpict/", "/pictures/productpict/th/", $item);
			shopProductWriter::img_resize($item,$itemTh,160,160);//создаем thumbs для userplaces
		return true;
	}
	
	static function uploadPicture($db,$mtcode,$allfiles){ 
	   define("PATH_TO_PICT", "../pictures/productpict");
	   $possible_ext=array(0=>"png",1=>"gif",2=>"jpg");	
	   foreach($allfiles as $filename => $files){
	   		if(is_array($files['name'])){
	   			for($i=0;$i<=count($files['name']);$i++){
		   				if(!empty($files['name'][$i])){
				   		if(!empty($files['type'][$i])){
				   			$type=$files['type'][$i];
				   		}
				   	  	switch ($type){
				   		case 'image/png':
				   	  		$ext="png";
				   	  		break;
						case 'image/gif':
							$ext="gif";
							break;
				   		case 'image/jpg': 
							$ext="jpg";
							break;
				   		case 'image/jpeg':
				   			$ext="jpg";
				   			break;
						default:
							$errname="Файл должен быть jpg, png или gif, а вы загружаете: ".$files['type'][$i];
					        $errors[$filename]=$errname;
					        return $errors;
				   	  	}    
						
					   $tmpname=$files['tmp_name'][$i];
					   
					   $oldname=PATH_TO_PICT."/".$filename."/".$mtcode."_".$filename.$i;
					   foreach($possible_ext as $value){// удаляем залитые ранее картинки со всеми возможными расширениями
					   		if(file_exists($oldname.".".$value)){
					   			unlink($oldname.".".$value);
					   		}
					   }
					   
					   $name=PATH_TO_PICT."/".$filename."/".$mtcode."_".$filename.$i.".".$ext; // файл будет называть например так: pictures/MK303_topppict.jpg
					   list($x, $y) = getimagesize($files['tmp_name'][$i]);
					   if($files['size'][$i] > 1024*3*1024){
					   		$errname="Размер файла превышает 3 МБ";
					        $errors[$filename]=$errname;
					        return $errors;
					   }
					   if(is_uploaded_file($files['tmp_name'][$i])){// Проверяем загружен ли файл
					     	move_uploaded_file($tmpname, $name); // Если файл загружен перемещаем его
					   }
			 	    } 		
	   			}
	   		}
	   		else{
		 		if(!empty($files['name'])){
			   		if(!empty($files['type'])){
			   			$type=$files['type'];
			   		}
			   	  	switch ($type){
			   		case 'image/png':
			   	  		$ext="png";
			   	  		break;
					case 'image/gif':
						$ext="gif";
						break;
			   		case 'image/jpg': 
						$ext="jpg";
						break;
			   		case 'image/jpeg':
			   			$ext="jpg";
			   			break;
					default:
						$errname="Файл должен быть jpg, png или gif, а вы загружаете: ".$files['type'];
				        $errors[$filename]=$errname;
				        return $errors;
			   	  	}    
					
				   $tmpname=$files['tmp_name'];
				   
				   $oldname=PATH_TO_PICT."/".$filename."/".$mtcode."_".$filename;
				   foreach($possible_ext as $value){// удаляем залитые ранее картинки со всеми возможными расширениями
				   		if(file_exists($oldname.".".$value)){
				   			unlink($oldname.".".$value);
				   		}
				   }
				   
				   $name=PATH_TO_PICT."/".$filename."/".$mtcode."_".$filename.".".$ext; // файл будет называть например так: pictures/MK303_topppict.jpg
				   list($x, $y) = getimagesize($files['tmp_name']);
				   if($files['size'] > 1024*3*1024){
				   		$errname="Размер файла превышает 3 МБ";
				        $errors[$filename]=$errname;
				        return $errors;
				   }
				   if(is_uploaded_file($files['tmp_name'])){// Проверяем загружен ли файл
				     	move_uploaded_file($tmpname, $name); // Если файл загружен перемещаем его
				   }
		 	   }
	   	   }
	   }
	   return true;
	}
}
?>