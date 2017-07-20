<?php
	require 'MallConstant.php';
	require 'DBConnectionHelper.php';
	
	/**
	* 
	*/
	require 'ShopBase.php';
	class Mall extends ShopBase
	{
		function __construct()
		{
			//数据库连接
			$this->a_db_connection = new DBConnectionHelper();
		}

		public function doThings($getData, $postData)
		{
			$ret = 0;
			//请求的方法编号
			$iFunc = isset($_GET["func_index"]) ? $_GET["func_index"] : "0";
			if($iFunc == MallConstant::GET_MALL_LIST_DATA){
				$ret = $this->getMallListData();
			}
			
			return $ret;
		}

		function getMallListData()
		{
            
            $index_tuijian_list = $this->getTuijianList();
            $index_hot_list = $this->getHostList();
            $index_new_list = $this->getNewList();
            $index_cate_list = $this->getCateList();

            $data['index_tuijian_list'] = $index_tuijian_list;
            $data['index_hot_list'] = $index_hot_list;
            $data['index_new_list'] = $index_new_list;
            $data['index_cate_list'] = $index_cate_list;

            return $data;
		}

		//请求商品数据库，获取推荐的商品
		function getTuijianList()
		{
            $ret = $this->a_db_connection->getTuijianList();
            return $ret;
		}

		//请求商品数据库，获取热卖的商品
		function getHostList()
		{
            $ret = $this->a_db_connection->getHostList();
            return $ret;
		}

		//请求商品数据库，获取新上的商品
		function getNewList()
		{
            $ret = $this->a_db_connection->getNewList();
            return $ret;
		}

		//请求商品数据库，获取商品分类
		function getCateList()
		{
			$ret = $this->a_db_connection->getCateList();
            return $ret;
		}

		
	}
?>