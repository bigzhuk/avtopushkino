<?php
class wherebuy {
	function __construct($db){
		if(!$db){
			require_once($_SERVER['DOCUMENT_ROOT']."/config.php");
		}
		$this->db=$db;
	}
	function getShops($shoptype){
		$query="SELECT content FROM misc_texts WHERE alias='".$shoptype."' LIMIT 1";
		$result=$this->db->query($query);
		if ($result) $row=$result->fetch();
		return $row['content'];
	}
	
	function getFirmShopsMoscow(){
		$query="SELECT content,shop_email FROM misc_texts WHERE alias='shops_firm' and city='Москва' and hide!=1";
		$result=$this->db->query($query);
		while($row=$result->fetch()){
			$content[$row['shop_email']]=$row['content'];
		}
		return $content;
	}
	
	function getFirmShopNamesMoscow(){
		/*echo "SELECT shop_name,shop_email FROM misc_texts WHERE alias='shops_firm' and city='Москва' and hide!=1";;
		die;*/
		$query="SELECT shop_name,shop_email FROM misc_texts WHERE alias='shops_firm' and city='Москва' and hide!=1";
		$result=$this->db->query($query);
		while($row=$result->fetch()){
			$shop_names[$row['shop_email']]=$row['shop_name'];
		}
		return $shop_names;
	}
	
	function getFirmShopsOthers(){// переделать
		$query="SELECT content FROM misc_texts WHERE alias='".$shoptype."'";
		$result=$this->db->query($query);
		if ($result) $row=$result->fetch();
		return $row['content'];
	}
	
	function getDilersMoscow(){
		$query="SELECT id, answer, SUBSTRING_INDEX(question,',',-1) as city FROM where_buy WHERE SUBSTRING_INDEX(question,',',-1) =' Москва'";
		$result=$this->db->query($query);
		if ($result) $row=$result->fetch();
		 $dilers[]=$row;
		 return $dilers;
	}
	function getDilersRussia(){
		$query="SELECT  id, answer, SUBSTRING_INDEX(question,',',-1) as city FROM where_buy WHERE  SUBSTRING_INDEX(question,',',1) ='Россия' and SUBSTRING_INDEX(question,',',-1) !=' Москва' ORDER BY question";
		$result=$this->db->query($query);
		if ($result){ 
			while($row=$result->fetch()){
				$deales[]=$row;	
			}
		}
		return $deales;	
	}
	function getDilersRestOfWorld(){
		$query="SELECT  id, answer, SUBSTRING_INDEX(question,',',-1) as city, SUBSTRING_INDEX(question,',',1) as country FROM where_buy WHERE  SUBSTRING_INDEX(question,',',1) !='Россия' ORDER BY question";
		$result=$this->db->query($query);
		if ($result){ 
			while($row=$result->fetch()){
				$deales[]=$row;	
			}
		}
		return $deales;	
	}
	function getShopByEmail($email){
		$query="SELECT shop_name FROM misc_texts WHERE shop_email='".$email."'";
		$result=$this->db->query($query);
		if ($result) $row=$result->fetch();
		return $row['shop_name'];
	}
}
?>