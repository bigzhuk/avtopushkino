<?php
class basket {
	function __construct($productid,$qty,$userid,$db){
		if(!$db){
			require_once($_SERVER['DOCUMENT_ROOT']."/config.php");
		}
		$this->productid=$productid;
		$this->qty=$qty;
		$this->userid=$userid;
		$this->db=$db;
	}
	function getTotalQty(){
		$query="SELECT sum(qty) as totalqty FROM basket 
		WHERE userid=$this->userid 
		GROUP BY userid";
		$result=$this->db->query($query);	
		if(!$result){
			throw new Exception("Не удалось подсчитать количество товара для пользователя $this->userid");
		}
		$row=$result->fetch();
		return $row['totalqty'];
	}
	function getBasketLines(){
		$query="SELECT id, productid, userid, qty as totalqty FROM basket 
		WHERE userid=$this->userid 
		GROUP BY productid ORDER BY id desc";
		$result=$this->db->query($query);	
		if(!$result){
			throw new Exception("Не удалось получить из базы инфомацию о товарах");
		}
		while($row=$result->fetch()){
			$basketLines[]=$row;
		}
		return $basketLines;
	}
	function checkBaketRecord(){
		$query="SELECT productid  FROM basket 
		WHERE userid=".$this->userid." AND productid=".$this->productid;
		$result=$this->db->query($query);	
		if(!$result){
			throw new Exception("Не удалось проверить корзину");
		}
		$row=$result->fetch();
		if($row['productid']){
			return true;
		}
		return false;
	}
	
	function checkBasketEmpty(){
		$query="SELECT productid  FROM basket
		WHERE userid=".$this->userid;
		$result=$this->db->query($query);
		if(!$result){
			throw new Exception("Не удалось проверить корзину");
		}
		$row=$result->fetch();
		if($row['productid']){
			return true;
		}
		return false;
	}
	
	function getQty(){
		$query="SELECT qty  FROM basket 
		WHERE userid=".$this->userid." AND productid=".$this->productid;
		$result=$this->db->query($query);	
		if(!$result){
			throw new Exception("Не удалось получить количество товара в корзине");
		}
		$row=$result->fetch();
		if($row['qty']){
			return $row['qty'];
		}
		return false;
	}
	
	function insertProductIntoBasket(){
		$query="INSERT into basket (
		productid,
		userid,
		qty
		) 
		values (
		$this->productid,
		$this->userid,
		$this->qty
		)";
		$result=$this->db->query($query);		
		if(!$result){
			throw new Exception("Товар не был добавлен в корзину");
		}
		return false;
	}
	
	
	function deleteProductFromBasket(){
		$query="DELETE FROM basket
		WHERE userid=".$this->userid." AND productid=".$this->productid;
		$result=$this->db->query($query);		
		if(!$result){
			throw new Exception("Товар не был удален из корзины");
		}
		return false;	
	}
	
	function deleteAllProductsFromBasket(){
		$query="DELETE FROM basket
		WHERE userid=".$this->userid;
		$result=$this->db->query($query);
		if(!$result){
			throw new Exception("Товары не был удалены из корзины");
		}
		return false;
	}
	
	function updateProductQtyInBasket(){
		$query="UPDATE basket SET qty=".$this->qty."
		WHERE userid=".$this->userid." AND  productid=".$this->productid;
		$result=$this->db->query($query);		
		if(!$result){
			throw new Exception("Количество не было обновлено");
		}
		return false;	
	}
	function insertTransaction($dealer,$summ){
		$ip=$_SERVER['REMOTE_ADDR'];
		$pattern = '/^91\.237\.37\.([1-9]|[1-2][0-9]|3[0-1])$/'; 
		$checkip=preg_match($pattern, $ip); 
		if($checkip){$ip='compel';}
			$date=date("Y-m-d H:i");
			$query="INSERT into transactions (
			dealer,
			`date`,
			summ,
			ip
			)
			values (
			'".$dealer."',
			'".$date."',
			".$summ.",
			'".$ip."'
			)";
			$result=$this->db->query($query);
			if(!$result){
				throw new Exception("Транзакция не был добавлена в базу");
			}
		return false;
	}
	function getLastTransaction(){ // надо было делать через транзакции, но MYISAM не поддерживает их
		$query="SELECT id,summ,dealer FROM transactions
		order by id desc limit 1";
		$result=$this->db->query($query);
		if(!$result){
			throw new Exception("Не удалось получить id транзакции");
		}
		$row=$result->fetch();
		if($row){
			return $row;
		}
	return false;
	}

	
function connetcEcommerceJs() {
return <<<HTML
ga('require', 'ecommerce', 'ecommerce.js');
HTML;
}	
	
function getTransactionJs($transaction_prop) {
return <<<HTML
ga('ecommerce:addTransaction', {
  'id': '{$transaction_prop['id']}',
  'affiliation': '{$transaction_prop['dealer']}',
  'revenue': '{$transaction_prop['summ']}',
  'shipping': '0',
  'tax': '0'
});
HTML;
}

function getItemJs(&$transId, &$item, $axcode,$category) {
return <<<HTML
ga('ecommerce:addItem', {
  'id': '$transId',
  'name': '{$item['title'][$axcode]}',
  'sku': '{$axcode}',
  'category': '{$category}',
  'price': '{$item['price'][$axcode]}',
  'quantity': '{$item['qty'][$axcode]}'
});
HTML;
}

function sendEcommerceJs() {
return <<<HTML
ga('ecommerce:send');
HTML;
}
	
}
?>