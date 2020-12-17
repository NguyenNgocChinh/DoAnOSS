<?php 
/**
* 
*/
class AbcController extends Controller
{
	function __construct(){
		$this->folder = "default";
	}
	
	function signin(){

		if(isset($_SESSION['user'])){
			header('location: ../');
		}
		$this->render('signin');
	}
		function signup(){
		if(isset($_SESSION['user'])){
			header('location: ../');
		}
		$this->render('signup');
	}
}
?>