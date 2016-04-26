<?php 
class magazine {
	function __construct($db){
		if(!$db){
			require_once($_SERVER['DOCUMENT_ROOT']."/config.php");
		}
		$this->db=$db;
	}
	function getMonthPublishDates($month, $year){
		if($month<10){$month="0".$month;}
		$lastDayOfMonth = date("t", strtotime($year."-".$month));
		$date = new DateTime($year."-".$month."-01");
		$date2 = new DateTime($year."-".$month."-".$lastDayOfMonth);
		$timestampdate1=$date->getTimestamp();
		$timestampdate2=$date2->getTimestamp();
		
		$query="SELECT publish_date FROM rassilka
		WHERE publish_date>=$timestampdate1 and publish_date<=$timestampdate2";
		$result=$this->db->query($query);
		while($row=$result->fetch()){
			$datestr.=date('d',$row['publish_date']).",";
		}
		echo substr($datestr, 0, -1);// обрезаем запятую
	}
}
?>