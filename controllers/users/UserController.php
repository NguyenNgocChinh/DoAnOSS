<?php

/**
* 
*/
class UserController extends Controller
{
	
	function __construct()
	{
		$this->folder = "users";
	}
	function index(){
		echo "Trang khong ton tai";
	}
	
	function login(){
		//Xu ly dang nhap
		require_once 'vendor/Model.php';
		require_once 'models/users/userModel.php';
		$md = new userModel;

		$username = $_POST['username'];
		$password = $_POST['password'];
		$data = array();

		if($md->getUserByUsername($username)){
			$data = $md->getUserByUsername($username);
			if($password == $data['matkhau']){
				echo "LoginSuccess";
				$_SESSION['user'] = $data;
				$userCart = array();
				if(isset($_SESSION['cart'])){
					$sql = "SELECT masp FROM giohang WHERE user_id = ".$data['id'];
					$userCart = $md->getListMasp($sql);
					$addData = array();
					for($j = 0; $j < count($_SESSION['cart']); $j++){
						$pos = array_search($_SESSION['cart'][$j], $userCart);
						if($pos === false){
							$addData[] = $_SESSION['cart'][$j];
						}
					}
					$sql = "";
					for ($i=0; $i < count($addData); $i++) { 
						$sql .= "INSERT INTO giohang VALUES (".$data['id'].", ".$addData[$i].");\n";	
					}
					$md->exe_query($sql);
				}
				$sql = "SELECT masp FROM giohang WHERE user_id = ".$data['id']."";
				$_SESSION['cart'] = null;
				$_SESSION['cart'] = $md->getListMasp($sql);
				if($_POST['rmbme'] == 'true'){
					$cookie_value = $username;
					setcookie('user', $cookie_value, time() + (86400 * 30), "/");
				}
				return true;
			} else {
				echo "Sai tên tài khoản hoặc mật khẩu!";
			}
		} else {
			echo "Sai tên tài khoản hoặc mật khẩu!";
		}
		return false;
	
}
	function rememberLogin(){
		//xu ly luu dang nhap
require_once 'vendor/Model.php';
		require_once 'models/users/userModel.php';
		$md = new userModel;
		/*session_start();*/
		if(isset($_COOKIE['user'])){
			$_SESSION['user'] = $md->getUserByUsername($_COOKIE['user']);
			header('location: ../');
		} else {
			echo "Trang khong ton tai";
			return 0;
		}
	}
	
	
}
