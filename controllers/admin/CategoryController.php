<?php


/**
* 
*/
class CategoryController extends Controller
{
	
	function __construct()
	{
		$this->folder = "admin";
		if(!isset($_SESSION['admin'])){
			header("Location:".APP_URL."indexadmin");
		}
	}
	function index(){
		//Xu ly hien thi
		require_once 'vendor/Model.php';
		require_once 'models/admin/categoryModel.php';
		$md = new categoryModel;
		$data = $md->getAllCtgrs();
		$this->render('category',$data,'DANH MỤC SẢN PHẨM','admin');
	}
	function action(){
		//Xu ly action
		//$actionName = $id = $cname = $ccountry = '';
		if(isset($_GET['name'])){$actionName = $_GET['name'];}
		if(isset($_GET['id'])){$id = $_GET['id'];}
		require_once 'vendor/Model.php';
		require_once 'models/admin/categoryModel.php';
		$md = new categoryModel;
		
		switch ($actionName) {
			case 'add':
			if(isset($_GET['cname'])){$cname = $_GET['cname'];}
			if(isset($_GET['ccountry'])){$ccountry = $_GET['ccountry'];}
			if($cname == ''){echo "Bạn chưa điền tên danh mục!";return;}
			$data = array('',$cname, $ccountry);
			if($md->insert('danhmucsp',$data)){
				echo "OK";
			}
			break;

			case 'del':
			$md->delete('danhmucsp','madm = '.$id);
			echo "OK";
			break;

			case 'edit':
			$c4edit = $n4edit = '';
			$setRow = array('tendm','xuatsu');
			if(isset($_GET['country4edit'])){$c4edit = $_GET['country4edit'];}
			if(isset($_GET['name4edit'])){$n4edit = $_GET['name4edit'];}
			$setVal = array($n4edit, $c4edit);
			$md->update('danhmucsp',$setRow, $setVal, 'madm = '.$id);
			echo "OK";
			break;
			
			default:
				# code...
			break;
		}
	}
}

class CategoryController extends Controller
	{	
function index(){
echo"Day la trang";
		}
	}

