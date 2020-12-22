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

	function loadmore(){
		require_once 'vendor/Model.php';
		require_once 'models/default/productModel.php';
		require_once 'models/default/categoryModel.php';
		$ctgr = new categoryModel;
		$allCtgrs = $ctgr->getAllCtgrs();
		$md = new productModel;
		$q = "";
		if(isset($_GET['q'])){$q = $_GET['q'];}
		$st = $sql = $type = "";
		if(isset($_GET['start'])){$st = $_GET['start'];}
		if(isset($_GET['type'])){$type = $_GET['type'];}
		switch ($type) {
			case 'bestselling':
			$data_tmp = $md->getPrds('luotmua',$st,8);
			break;
			case 'newest':
			$data_tmp = $md->getPrds('ngay_nhap',$st,8);
			break;
			case 'onsale':
			$data_tmp = $md->getPrds('khuyenmai',$st,8);
			break;
			case 'all':
			$data_tmp = $md->getPrds('gia',$st,8);
			break;
			$data_tmp = $md->getPrds('gia',$st,8,'madm = 6');
			break;
			case 'search':
			$data_tmp = $md->getPrds('gia',$st,8,"tensp like '%".$q."%'");
			break;
			default:
			for ($i=0; $i < count($allCtgrs); $i++) {
				$case = preg_replace('/\s+/', '', ucfirst($allCtgrs[$i]['tendm']));
				switch ($type) {
					case $case:
					$data = $md->getPrds('gia',0,8,'madm = '.$allCtgrs[$i]['madm']);
					$title = "<span id='contentTitle' data-type='".$case."'>Thương hiệu daf: ".$allCtgrs[$i]['tendm']."</span>";
					break;
				}
			}
		}
		if(empty($data_tmp)){return 0;};
		for ($i=0; $i < count($data_tmp); $i++) {
			$data[$i] = $data_tmp[$i];
			require 'views/default/loadmore.php';
		}
	}

}