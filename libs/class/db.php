<?php

/*
 * 2013-11-01 : Edit Connect() by adding query("SET NAMES 'UTF8'") : Supaporn S.
 * 2013-11-01 : Add transaction_begin(), transaction_commit(), transaction_rollback() : Supaporn S.
 * 2013-11-01 : Add UpdateNotCheckAffected : Supaporn S.
 * 2014-01-06 : Add $debugMode : Supaporn S.
 * 2014-01-06 : Add activatedDebugMode() : Supaporn S.
 * 2014-01-29 : Change to use password from config Files;
 * 2015-02-15 : Add Timezone Management : Todsaporn S.
 * 2015-03-15 : Add DBLog
 */
 
class SQLBuilder{
	
	public function multiple_parent_where($parent,$items){
		$s = '';
		if(count($items)>0){
			$s .= '(';
			$counter = 0;
			foreach ($items as $item) {
				if($counter>0)$s .= ' OR ';
				$s .= $parent."='".$item."'";
				$counter ++;
			}
			$s .= ')';
		}else{
			$s .= "1";
		}
		return $s;
	}	
}
 
class dbc extends SQLBuilder{
	protected $conn = null;
	protected $debugMode = true;
	protected $dblog = false;
	
	private $username = "root";
	private $password = "";
	private $dbname = "";
	private $server = "localhost";
	
	function __construct() {
		if(defined('DB_SERVER'))$this->server = DB_SERVER;
		if(defined('DB_USER'))$this->username = DB_USER;
		if(defined('DB_PASS'))$this->password = DB_PASS;
		if(defined('DB_SERVER'))$this->dbname = DB_NAME;
		
		
   }

	function Connect(){
		$this->conn = new mysqli(
			$this->server,
			$this->username,
			$this->password,
			$this->dbname
		);
		$this->conn->query("SET NAMES 'UTF8'");
	}
	
	function SetTimezone($now){
		$mins = $now->getOffset() / 60;
		$sgn = ($mins < 0 ? -1 : 1);
		$mins = abs($mins);
		$hrs = floor($mins / 60);
		$mins -= $hrs * 60;
		$offset = sprintf('%+d:%02d', $hrs*$sgn, $mins);
		$this->Query("SET @@session.time_zone = '$offset';");

	}
	
	function Close(){
		$this->conn->close();
		//mysql_close();
	}
	
	function __destruct(){
		//$this->Close();
	}
	
	function activatedDebugMode(){
		$this->debugMode = true;
	}
	
	function logging($sql,$result){
		//CREATE TABLE dblog (id int(11) NOT NULL AUTO_INCREMENT, command text, result int(11), PRIMARY KEY (id));
		mysqli_query($this->conn,"INSERT dblog(id,command,result) VALUES(DEFAULT,'".addslashes($sql)."',".$result.");");
	}
	
	function Query($sql){
		if($this->debugMode){ //$this->debugMode = true;
			$rst = mysqli_query($this->conn,$sql) or die(mysqli_error($this->conn)."\r\n".$sql."\r\n");
			if ($this->conn->connect_errno) {
				printf("Connect failed: %s\n", $this->conn->connect_error);
				if($this->dblog)$this->logging($sql,0);
			}else{
				if($this->dblog)$this->logging($sql,1);
			}
			return $rst;
		}
		else{ //$this->debugMode = false;
			$rst = mysqli_query($this->conn,$sql);
			if ($this->conn->connect_errno) {
				printf("Connect failed: %s\n", $this->conn->connect_error);
				if($this->dblog)$this->logging($sql,0);
			}else{
				if($this->dblog)$this->logging($sql,1);
			}
			
			return $rst;
		}
	}
	
	function Escape_String($data){
		return mysqli_escape_string($this->conn, $data);
	}
	
	function Clean($data){
		mysqli_free_result($data);
	}
	
	function Fetch($rst){
		return mysqli_fetch_array($rst);
	}
	
	function Insert($table_name,$list_variable){
		$sql="INSERT INTO $table_name";
		$s_column="(";
		$s_value=" VALUES(";
		$count=0;
		foreach($list_variable as $name => $value){
			if($count>0){
				$s_column.=",";
				$s_value.=",";
			}
			$s_column.=str_replace("#","",$name);
			if(preg_match("/#/",$name)){
				$s_value.="$value";
			}else{
				$s_value.="'$value'";
			}
			$count++;
		}
		$s_column.=")";
		$s_value.=")";
		$sql.=$s_column.$s_value;
		//echo $sql."\n";
		$this->Query($sql);
		if(mysqli_affected_rows($this->conn)>0){
			return true;
		}else{
			return false;
		}
	}
	
	function GetID(){
		return mysqli_insert_id($this->conn);
	}
	
	function Update($table_name,$list_variable,$condition="1"){
		$sql="UPDATE $table_name SET ";
		$count=0;
		foreach($list_variable as $name => $value){
			if($count>0)$sql.=",";
			
			$sql.=str_replace("#","",$name);
			if(preg_match("/#/",$name)){
				$sql.="=$value";
			}else{
				$sql.="='$value'";
				
			}
			$count++;
		}
		$sql.=" WHERE $condition";
		$this->Query($sql);
		if(mysqli_affected_rows($this->conn)>0){
			return true;
		}else{
			return false;
		}
		
	}
	
	function UpdateNotCheckAffected($table_name,$list_variable,$condition="1"){
		$sql="UPDATE $table_name SET ";
		$count=0;
		foreach($list_variable as $name => $value){
			if($count>0)$sql.=",";
			
			$sql.=str_replace("#","",$name);
			if(preg_match("/#/",$name)){
				$sql.="=$value";
			}else{
				$sql.="='$value'";
				
			}
			$count++;
		}
		$sql.=" WHERE $condition";
		
		if($this->Query($sql)){
			return true;
		}else{
			return false;
		}
	}
	
	function Delete($table,$condition="1"){
		$sql="DELETE FROM $table WHERE $condition";
		$this->Query($sql);
		if(mysqli_affected_rows($this->conn)>0){
			return true;
		}else{
			return false;
		}
	}
	
	function HasRecord($table,$condition="1"){
		$sql="SELECT * FROM $table WHERE $condition";

		$rst = mysqli_query($this->conn,$sql) or die(mysqli_error($this->conn)."\r\n".$sql."\r\n");
		if (mysqli_connect_errno($this->conn)){
			printf("Connect failed: %s\n", $this->conn->connect_error);
			return false;
		}else if(mysqli_num_rows($rst)>0){
			return true;
		}else{
			return false;
		}
		
	}
	
	function GetRecord($table,$feild,$condition="1"){
		$sql="SELECT $feild FROM $table WHERE $condition";
		
		$rst = mysqli_query($this->conn,$sql) or die(mysqli_error($this->conn)."\r\n".$sql."\r\n");
		if ($rst == false) {
			printf("Query failed: %s\n", mysqli_error($this->conn));
			return false;
		}else{
			if(mysqli_num_rows($rst)>0){
				return mysqli_fetch_array($rst);
			}else{
				return 0;
			}
			
		}
	}
	
	function Real_Escape_String($string){
		return mysqli_real_escape_string($this->conn,$string);
	}
	
	function GetCount($table,$condition="1"){
		$sql="SELECT COUNT(*) AS NumberOfAll FROM $table WHERE $condition";
		
		$rst = mysqli_query($this->conn,$sql);
		if (mysqli_connect_errno($this->conn)) {
			printf("Connect failed: %s\n", $this->conn->connect_error);
			return false;
		}else{
			if(mysqli_num_rows($rst)>0){
				while($row = mysqli_fetch_array($rst)) {
					$count = $row['NumberOfAll'];
				}
				return $count;
			}else{
				return 0;
			}
		}
	}
	
	function GetSum($field,$table,$condition="1"){
		$sql="SELECT SUM($field) AS sum FROM $table WHERE $condition";
		
		$rst = mysqli_query($this->conn,$sql);
		if (mysqli_connect_errno($this->conn)) {
			printf("Connect failed: %s\n", $this->conn->connect_error);
			return false;
		}else{
			if(mysqli_num_rows($rst)>0){
				while($row = mysqli_fetch_array($rst)) {
					$sum = $row['sum'];
				}
				return ($sum != NULL ? $sum : 0);
			}else{
				return 0;
			}
		}
	}
	
	function transaction_begin(){
		$this->Query("BEGIN");
	}
	
	function transaction_commit(){
		$this->Query("COMMIT");
	}
	
	function transaction_rollback(){
		$this->Query("ROLLBACK");
	}
	
	function QueryAndFetch($sql){
		//**This Method look alike GetRecord() , you can use your SQL that unlike [SELECT FROM WHERE] such as LEFT JOIN, RIGHT JOIN etc.
		$rst = mysqli_query($this->conn,$sql);
		if (mysqli_connect_errno($this->conn)) {
			printf("Connect failed: %s\n", $this->conn->connect_error);
			return false;
		}else{
			if(mysqli_num_rows($rst)>0){
				return mysqli_fetch_array($rst);
			}else{
				return 0;
			}
		}
	}
	
	function Getnum($sql){
		return mysqli_num_rows($sql);
	}
	
	function pagination($table,$where,$link,$limit,$pagActive,$cate)
	{
		global $dbc;
		$Qry = $dbc->Query("select * from ".$table." Where $where ");
		$nums = $dbc->Getnum($Qry);
		
		$total = $nums/$limit;
		for($i=1;$i<=ceil($total);$i++)
		{
			if($i==1)
			{
				$start = 0;
			}
			else
			{
				$start += $limit;
			}
			$active = ($pagActive == $start)?'active':'';
			echo '<li class="'.$active.' pa"><a href="'.$link.'&pag='.$start.'&limit='.$limit.'&cate='.$cate.'">'.$i.'</a></li>';
			//echo '<li class="'.$active.'" onClick="load_product_page(7,'.$start.','.$limit.')"><a>'.$i.'</a></li>';
			
		}
	}
	
	function pagination_prev($link,$start,$limit,$cate)
	{
		$prev = $start - $limit;
		if($prev<0)
		{
			echo '<li class="disabled"><a href="#">&laquo;</a></li>';
		}
		else
		{
			echo '<li class="disableds"><a href="'.$link.'&pag='.$prev.'&limit='.$limit.'&cate='.$cate.'">&laquo;</a></li>';
		}
		
	}
	function pagination_next($link,$start,$limit,$total,$cate)
	{
		$next = $start + $limit;
		if($next >= $total)
		{
			echo '<li class="disabled"><a href="#">&raquo;</a></li>';
		}
		else
		{
			echo '<li><a href="'.$link.'&pag='.$next.'&limit='.$limit.'&cate='.$cate.'">&raquo;</a></li>';
		}
	}
	
	function date_type($data)
	{
		if($data=='')
		{
			return '';
		}
		else
		{
			$y = substr($data,0,4);
			$m = substr($data,5,2);
			$d = substr($data,8,2);
			switch($m)
			{
				case'01':  $month = 'January';break;
				case'02':  $month = 'February';break;
				case'03':  $month = 'March';break;
				case'04':  $month = 'April';break;
				case'05':  $month = 'May';break;
				case'06':  $month = 'June';break;
				case'07':  $month = 'July';break;
				case'08':  $month = 'August';break;
				case'09':  $month = 'September';break;
				case'10':  $month = 'October';break;
				case'11':  $month = 'November';break;
				case'12':  $month = 'December';break;
			}
			return  $month.', '.$y;
		}
	}
	
	function string_len($text,$amount)
   {
		if(strlen($text)>$amount)
		{
			return substr($text,0,$amount).'...';
		}
		else
		{
			return $text;
		}
   }
}