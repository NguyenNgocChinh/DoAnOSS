<?php 
/**
* 
*/
class IndexController extends Controller
{
	function __construct(){
		$this->folder = "default";
	}
	
	function index()
	{
		$data = " Xin Chào";
		$this->render('index', $data);
	}

}
?>