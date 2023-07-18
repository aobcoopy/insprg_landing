<?php

/*
 * 2016-02-16 : Created New System : Todsaporn S.
 * 
 */

 
class minerva{
	private $dbc = null;
	private $user_id = null;
	private $group_id = null;
	
	function __construct($dbc) {
		$this->dbc = $dbc;
	}
	
	function allow($app,$action){
		global $_SESSION;
		if(isset($_SESSION['auth'])){
			if($_SESSION['auth']['group_id']==0){
				return true;
			}else{
				return $this->dbc->HasRecord("permissions","name='$app' AND action = '$action' AND gid=".$_SESSION['auth']['group_id']);
			}
		}else{
			return false;
		}
	}
	
	function save_log(
		$user_type,
		$user_id,
		$action,
		$value,
		$data
	){
		global $_SERVER;
		$data = array(
			"#log_id" => "DEFAULT",
			"#log_datetime" => "NOW()",
			"#log_user_type" => $user_type,
			"#log_user" => $user_id,
			"log_action" => $action,
			"log_value" => $value,
			"log_location" => $_SERVER['REMOTE_ADDR'],
			"log_data" => json_encode($data)
		);
		$this->dbc->Insert("logs",$data);
	}
	
	
	function make_combobox($name,$dbname,$value,$caption,$where=1,$initval="",$id="",$class="form-control"){
		$dbc = $this->dbc;
		$out = '';
		$out .= '<select name="'.$name.'" class="'.$class.'">';
		$sql = "SELECT $value,$caption FROM $dbname WHERE $where";
		$rst = $dbc->Query($sql);
		while($line = $dbc->fetch($rst)){
			$out .= '<option value="'.$line[0].'"';
			if($initval!=""){
				if($line[0]==$initval){
					$out .= ' selected'; 
				}
			}
			$out .= '>';
			$out .= $line[1];
			$out .= '</option>';
		}
		$out .= '</select>';
		return $out;
	}

	
}