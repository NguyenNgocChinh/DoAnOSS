<?php 

/**
* 
*/
class ClientController extends Controller
{
	
	function __construct()
	{
		$this->folder = "default";
	}
	function search(){
		$q = "";
		if(isset($_GET['q'])){$q = $_GET['q'];}
		require_once 'vendor/Model.php';
		require_once 'models/default/productModel.php';
		$md = new productModel;
		$data = $md->getPrds('gia',0,8,"tensp like '%".$q."%'");
		$title = "<span id='contentTitle' data-type='search'>Kết quả tìm kiếm cho: ".$q."</span>";
		require_once 'views/default/Products.php';
	}
}