<?php
	class Helper_class{

		function errorResponse($msg) {
    		$res= [];
    		$res['msg']    =  "$msg";
    		$res['status'] = 0;
    		echo json_encode($res); exit;
  		}



	 function clearSlashes($request){
				foreach($request as $key => $val){
					if(is_array($val)){
						$request[$key] = $this->stripslashes($val);
					} else {
						$request[$key] = addslashes(trim($val));
					}					
				}
				return $request;
		 }
		 
		 
		 
		function hashPassword($password) {
			$salt = sha1(md5($password)).'em01vZsQ2lB8g0spqrzxmlYVVikash';
			$salt = substr($salt, 5, 12);
			$encrypted = base64_encode(sha1($password . $salt, true) . $salt);
			$hash = array("salt" => $salt, "encrypted" => $encrypted);
			return $hash;
		}
	
		

		
		function validateMobile($phoneNumber) {
			if (preg_match('/^\d{10}$/', $phoneNumber)) { // phone number is valid
				return $phoneNumber;
			} else { // phone number is not valid
				return FALSE;
			}
		}
		
		
		 
		 
	}

	
	class Mysql_class{
		
		//private $db_conn;
		public function __construct()
		{
			$database = new Database();
			$db = $database->getConnection();
			$this->db_conn = $db;
		}


		function existing_data($value, $table, $key, $matchkey){
			$prep_state = $this->db_conn->prepare("SELECT ".$value." from ".$table." where ".$key." = '".$matchkey."'");
			$prep_state->execute();			
			$row = $prep_state->fetch(PDO::FETCH_ASSOC);
			if($prep_state->errorInfo()[0]!=0){
				echo "Error: " .$prep_state->errorInfo()[2];
			} else {
				return $row;
			}
		} 

		// Insert row
		function valueSetForInsert($a){
			return "'".$a."'";
		}
		

		function updateData($table,$dataArray,$condition){	
			$fields = array_keys($dataArray);
			$values = array_values($dataArray);
			$data 	= array_map(array($this,'valueSetForUpdate'),$fields,$values);
			
			$sql = "UPDATE ".$table." set " .implode(",",$data) ." ".$condition;
			$stmt= $this->db_conn->prepare($sql);
			return $stmt->execute();
		}


		function insertData($table,$dataArray){
			$fields = array_keys($dataArray);
			$values = array_map(array($this,'valueSetForInsert'),array_values($dataArray));
			
			$sql = "INSERT INTO ".$table." (".implode(",",$fields).") values(".implode(",",$values).")";
			$stmt= $this->db_conn->prepare($sql);
			$stmt->execute();
			if($stmt->errorInfo()[0]!=0){
				echo "Error: " .$stmt->errorInfo()[2];
			} else {
				return $this->db_conn->lastInsertId();
			}
		}
		
		// Update row
		function valueSetForUpdate($k,$v){
			return $k." = '".$v."'";
		}


		function deleteQuery($table,$id,$match_id){
			$sql = "DELETE FROM $table WHERE $id=$match_id";
			$stmt= $this->db_conn->prepare($sql);
			return $stmt->execute();
		}
		
			
		function countRows($sql){
			$prep_state = $this->db_conn->prepare($sql);
			$prep_state->execute();
			$num = $prep_state->rowCount();
			return $num;
		}
		
		function get_field_data($fieldName,$tableName,$condition){
			$prep_state = $this->db_conn->prepare("SELECT ".$fieldName." FROM ".$tableName." ".$condition);
			$prep_state->execute();			
			$row = $prep_state->fetch(PDO::FETCH_ASSOC);			
			if($prep_state->errorInfo()[0]!=0){
				echo "Error: " .$prep_state->errorInfo()[2];
			} else {
				return $row;
			}
		}

		
		function fetchAllData($table,$fields,$condition){
			$prep_state = $this->db_conn->prepare("SELECT ".$fields." FROM ".$table." ".$condition);
			$prep_state->execute();			
			$row = $prep_state->fetchAll(PDO::FETCH_ASSOC);			
			if($prep_state->errorInfo()[0]!=0){
				echo "Error: " .$prep_state->errorInfo()[2];
			} else {
				return $row;
			}
		} 
		
		function mysqlQuery($sql){
			$prep_state = $this->db_conn->prepare($sql);
			$prep_state->execute();
			if($prep_state->errorInfo()[0]!=0){
				echo "Error: " .$prep_state->errorInfo()[2];
			} else {
				return $prep_state;
			}			
		}

	}
?>