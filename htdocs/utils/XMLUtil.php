<?
	/**
	* 
	*/
	class XMLUtil
	{
		public static $db_config_path = '../config/DBconfig.xml';
		public static function getDBConfiguration()
		{
			$dbconfig = array();
			try{
				//读取配置文件
				$handler = fopen(self::$db_config_path, 'r');
				$content = fread($handler, filesize(self::$db_config_path));

				//获取XML节点信息赋值给关联数组
				$mysql = simplexml_load_string($content);
				$dbconfig['host'] = $mysql->host;
				$dbconfig['user'] = $mysql->user;
				$dbconfig['password'] = $mysql->password;
				$dbconfig['db'] = $mysql->db;
				$dbconfig['port'] = $mysql->port;
			}catch(Exception $e)
			{
				throw new RuntionException('XML read failed');
			}

			return $dbconfig;
		}
	}

?>