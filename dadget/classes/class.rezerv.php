<?php

class rezerv {

	function __construct($name_product, $qty_product, $shop_mail, $customer_name, $customer_mail,$customer_phone,$db){

		$this->name_product=$name_product;

		$this->qty_product=$qty_product;

		$this->shop_mail=$shop_mail;

		$this->customer_name=$customer_name;

		$this->customer_mail=$customer_mail;

		$this->customer_phone=$customer_phone;

		$query="SELECT MAX(id) as id FROM rezerv";

		$result=$db->query($query);

		$row=$result->fetch();

		$id=$row['id']+1;

		$id=str_pad($id, 4, "0", STR_PAD_LEFT);

		$this->order_number=$id;

		$this->db=$db;

	}

	function getOrderNumber(){

		return $this->order_number;

	}

	function getShopAddress(){

		$query="SELECT `email_desc` FROM misc_texts where shop_email='".$this->shop_mail."' LIMIT 1";

		$result=$this->db->query($query);

		$row=$result->fetch();

		return $row['email_desc'];

	}

	function insertProductIntoRezerv($transaction_type,$delivery_type,$summ){
		
		if(!$summ){
			$summ=0;
		}

		$query="INSERT into rezerv (

		transaction_type,

		delivery_type,

		name_product,

		qty_product,
		
		order_summ,

		shop_mail,

		customer_name,

		customer_mail,

		customer_phone,

		order_number

		)

		values (

		'".$transaction_type."',

		'".$delivery_type."',

		'".$this->name_product."',

		'".$this->qty_product."',
		
		".$summ.",

		'".$this->shop_mail."',

		'".$this->customer_name."',

		'".$this->customer_mail."',

		'".$this->customer_phone."',

		'".$this->order_number."'

		)";	
		/*"INSERT into rezerv (
		
		transaction_type,
		
		delivery_type,
		
		name_product,
		
		qty_product,
		
		order_summ,
		
		shop_mail,
		
		customer_name,
		
		customer_mail,
		
		customer_phone,
		
		order_number
		
		)
		
		values (
		
		'".$transaction_type."',
		
		'".$delivery_type."',
		
		'".$this->name_product."',
		
		'".$this->qty_product."',
		
		".$summ.",
		
		'".$this->shop_mail."',
		
		'".$this->customer_name."',
		
		'".$this->customer_mail."',
		
		'".$this->customer_phone."',
		
		'".$this->order_number."'
		
		)"
	;die;*/

		$result=$this->db->query($query);

		if(!$result){

		throw new Exception("Товар не был добавлен в резерв");

		}

		return false;

	}

	function getAllOrders(){

		$query="SELECT * FROM rezerv WHERE 1 order by `date` desc ";

		return $query;

	}

	function getLastDate(){

		$query="SELECT `date` FROM rezerv WHERE 1 order by `date` desc limit 1";

		$result=$this->db->query($query);

		$row=$result->fetch();

		return $row['date'];

	}
	
	function getLastFiltredDate($where){

		$query="SELECT `date` FROM rezerv WHERE ".$where." order by `date` desc limit 1";

		$result=$this->db->query($query);

		$row=$result->fetch();

		return $row['date'];

	}

	function getStatusClass($row){

		if($row['order_ready']==1) $class='status_in_work';

		if($row['order_dispatched']==1) $class='status_shipped';

		if($row['order_canceled']==1) $class='status_canceled';

		return $class;

	}

	function getOrder($row){

		$i=0;

		$title=explode(",",$row['name_product']);

		$qty=explode(",",$row['qty_product']);

		foreach($title as $val){

			$order.=$val." - ".$qty[$i]."шт. <br/>";

			$i++;

		}

		return $order;

	}

	function getDateDone($row){

		$date_done=0;

		if(!empty($row['date_canceled']) and $row['date_canceled']!='0000-00-00 00:00:00'){

			$date_done=$row['date_canceled'];

		}

		if(!empty($row['date_shipped']) and $row['date_shipped']!='0000-00-00 00:00:00'){

			$date_done=$row['date_shipped'];

		}	

		return $date_done;

	}

	static function getFormatDate($date){

		if($date!='0000-00-00 00:00:00'){

			$dateobj= new DateTime($date);

			$formatDate=$dateobj->format('d')." ".self::getMonth($dateobj->format('m'))." ".$dateobj->format('h:i');

			return $formatDate;

		}

	}
	
	static function getPointFormatDate($date){

		if($date!='0000-00-00 00:00:00'){

			$dateobj= new DateTime($date);

			$formatDate=$dateobj->format('d.m.Y');

			return $formatDate;

		}

	}
	
	static function getFormatTime($date){

		if($date!='0000-00-00 00:00:00'){

			$dateobj= new DateTime($date);

			$formatDate=$dateobj->format('H:i');

			return $formatDate;

		}

	}


	

	static function getMonth($monthNumber){

		$monthes=array("01"=>"янв","02"=>"фев","03"=>"мар","04"=>"апр","05"=>"май","06"=>"июн","07"=>"июл","08"=>"авг","09"=>"сен","10"=>"окт","11"=>"ноя","12"=>"дек");

		return $monthes[$monthNumber];

	}

}

?>