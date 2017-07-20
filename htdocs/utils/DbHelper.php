<?php
	/**
	* 
	*/
	class DbHelper
	{
		private $dbconfig;
		private $dbpool;
		public $poolsize = 20;
		function __construct()
		{
			if(!file_exists('../utils/XMLUtil.php'))
			{
				throw new RuntimeException("<mark>utils.php LLose</mark><br />");
			}else
			{
				require '../utils/XMLUtil.php';
			}

			//初始化配置文件
			$this->dbconfig = XMLUtil::getDBConfiguration();

			//准备好数据库连接池 ‘伪队列’
			$this->dbpool = array();

			for ($index = 0; $index < $this->poolsize; $index++) { 
				$conn = @mysql_connect($this->dbconfig['host'], $this->dbconfig['user'], $this->dbconfig['password']) or die('new connect failed');
				mysql_select_db($this->dbconfig['db']);
				mysql_query("set names utf8");
				array_push($this->dbpool, $conn);
			}
		}
		
		/*
		* 从数据库连接池中获取一个数据库连接资源
		*/

		public function getConnnection()
		{
			if(count($this->dbpool) <= 0)
			{
				$conn = mysqli_connect($this->dbconfig['host'], $this->dbconfig['user'], $this->dbconfig['password'], $this->dbconfig['db']) or die('get connect failed');
				$this->poolsize = $this->poolsize + 1;
				return $conn;
			}else
			{
				return array_pop($this->dbpool);
			}
		}

		/*
		* 将用完的数据库连接资源放回数据库连接池
		*/

		public function release($conn)
		{
			if(count($this->dbpool) < $this->poolsize)
			{
				array_push($this->dbpool, $conn);
			}
		}

		public function closeConnection(){
			mysql_close();
		}
	}

?>