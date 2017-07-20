<?

/**
* 
*/
require '../utils/DbHelper.php';

class db_connection
{
	// private $conn = null;

	// public function get_connection(){
	// 	if($this->conn != null){
	// 		return $this->conn;
	// 	}
	// 	$this->conn = @mysql_connect("bdm29971491.my3w.com","bdm29971491","c649605210")or die("connection failed!");
	// 	mysql_select_db("bdm29971491_db");
	// 	mysql_query("set names utf8");
	// 	return $this->conn;
	// }

	private $dbHelper;

	function __construct()
	{
		$this->dbHelper = new DbHelper();
	}

	public function get_student_info($id){
		$conn = $this->dbHelper->getConnnection();
		$sql = "select * from student where id = " . $id;
		$query = mysql_query($sql, $conn);
		$row = mysql_fetch_array($query);
		$this->dbHelper->release($conn);
		return $row;
	}

	public function set_student_description($id, $description){
		$conn = $this->dbHelper->getConnnection();
		$sql = "UPDATE student SET description = '$description' where id = '$id'";
		$sql_ret = mysql_query($sql, $conn);
		// 获取影响的行数
	  	$rows_count = mysql_affected_rows();
	  	$this->dbHelper->release($conn);
	  	// 如果影响行数>=1,则判断添加成功,否则失败
	  	if($rows_count >= 1)
	  	{
	    	return true;
	  	}else{
	    	return false;
	    }
	}
}
?>