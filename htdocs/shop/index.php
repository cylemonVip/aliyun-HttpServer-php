<?php  
	require 'api_constant.php';

	$a_api_constant = new api_constant();

	//获取post数据
	$input = file_get_contents('php://input');
	//获取请求类型
	$iClass = isset($_GET["class_index"]) ? $_GET["class_index"] : "0";
	//获取请求对应的玩家id
	$id = isset($_GET["id"]) ? $_GET["id"] : "1";
	//token
	$token = isset($_GET["token"]) ? $_GET["token"] : "hello_connection";

	//校验token
	if($token == "")
	{
	    echo "Token expired";
	    exit();
	}
	else
	{
		
		function sendError($errorStr, $iClass)
		{
			$ret["content"] = null;
			$ret["status"] = false;
			$ret["iClass"] = $iClass;
			$ret["error_log"] = api_constant::ID_ERROR;
			echo json_encode($ret);
		}
		echo "$iClass = " . $iClass;
		//test
		if($iClass == api_constant::NONE)
		{
			$ret["content"] = null;
			$ret["iClass"] = $iClass;
			echo json_encode($ret);
		}
		else if($iClass == api_constant::MALL)
		{
			require 'Mall.php';
			$mall = new Mall();
			$ret = $mall->doThings($_GET, $_POST);
			echo json_encode($ret);
		}else if($iClass == api_constant::SET_PLAYER_INFO)
		{
			$input_json = json_decode($input, true);
		    $user_id = $input_json["id"];
			$description = $input_json["description"];
			$update_ret = $a_db_connection->set_student_description($user_id, $description);
			echo "update_ret = " . $update_ret;
		}		
	}
?>