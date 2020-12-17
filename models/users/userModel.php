<?php 

/**
* 

*/
class userModel extends Model
{
	
	function __construct()
	{
		parent::__construct();
	}
	function getUserByUsername($username)
	{
		//GET USER BY USERNAME
$result = array();
		$sql = "SELECT * FROM thanhvien WHERE tentaikhoan = '".$username."'";
		if($this->conn->query($sql)->rowCount() == 0){
			return false;
		} else {
			foreach($this->conn->query($sql) as $row){
				$result = $row;
			}
			return $result;
		}
	}

}