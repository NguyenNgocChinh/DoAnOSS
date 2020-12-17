<?php

/**
* 
*/
class IndexAdminController extends Controller
{
	
	function __construct()
	{
		$this->folder = "admin";

	}
	function index(){
		require_once 'views/admin/index.php';
	}
}