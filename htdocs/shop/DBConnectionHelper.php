<?

/**
* 
*/
require '../utils/DbHelper.php';

class DBConnectionHelper
{
	private $dbHelper;

	function __construct()
	{
		$this->dbHelper = new DbHelper();
	}

	public function getTuijianList()
	{
		$conn = $this->dbHelper->getConnnection();
		$sql = "select * from Goods where is_promote = 1";
		$query = mysql_query($sql, $conn);
		$data = array();
		while($row = mysql_fetch_array($query)){
			array_push($data, $row);
		}
		$this->dbHelper->release($conn);
		return $data;
	}

	public function getHostList()
	{
		$conn = $this->dbHelper->getConnnection();
		$sql = "select * from Goods where is_hot = 1";
		$query = mysql_query($sql, $conn);
		$data = array();
		while($row = mysql_fetch_array($query)){
			array_push($data, $row);
		}
		$this->dbHelper->release($conn);
		return $data;
	}

	public function getNewList()
	{
		$conn = $this->dbHelper->getConnnection();
		$sql = "select * from Goods where is_new = 1";
		$query = mysql_query($sql, $conn);
		$data = array();
		while($row = mysql_fetch_array($query)){
			array_push($data, $row);
		}
		$this->dbHelper->release($conn);
		return $data;
	}

	public function getCateList()
	{
		$conn = $this->dbHelper->getConnnection();
		$sql = "select * from Cate where is_show = 1";
		$query = mysql_query($sql, $conn);
		$data = array();
		while($row = mysql_fetch_array($query)){
			array_push($data, $row);
		}
		$this->dbHelper->release($conn);
		return $data;
	}
	
}
?>