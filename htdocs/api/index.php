<?php  
	require 'api_constant.php';
	require 'db_connection.php';

	$a_api_constant = new api_constant();
	//数据库连接
	$a_db_connection = new db_connection();

	//获取post数据
	$input = file_get_contents('php://input');
	//获取请求的服务
	$ptCode = isset($_GET["ptcode"]) ? $_GET["ptcode"] : "0";
	//获取请求类型
	$request_type = isset($_GET["type"]) ? $_GET["type"] : "0";
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
		
		function sendError($errorStr, $request_type)
		{
			$ret["content"] = null;
			$ret["status"] = false;
			$ret["request_type"] = $request_type;
			$ret["error_log"] = api_constant::ID_ERROR;
			echo json_encode($ret);
		}
		
		if($ptCode == api_constant::PTCODE_WX_NOTE_BOOK)
		{
			require '../wx_notebook/index.php';
			$noteBook = new NoteBook();
			$result = $noteBook->doSomething($_GET, $_POST);
		}else if($ptCode == api_constant::PTCODE_WX_SHOP)
		{

		}else
		{
			//test
			if($request_type == api_constant::NONE)
			{
				$ret["content"] = null;
				$ret["request_type"] = $request_type;
				echo json_encode($ret);
			}
			else if($request_type == api_constant::GET_PLAYER_INFO)
			{
				$row = $a_db_connection->get_student_info($id);
			    $ret["id"] = $row["id"];

			    if(null == $row["id"])
			    {
			    	sendError(api_constant::ID_ERROR, $request_type);
			    	exit();
			    }
			    $ret["name"] = $row["name"];
			    $ret["age"] = $row["age"];
			    $ret["description"] = $row["description"];
			    $ret1["content"] = $ret;
			    $ret1["status"] = true;
			    $ret1["request_type"] = $request_type;
			    echo json_encode($ret1);
			}else if($request_type == api_constant::SET_PLAYER_INFO)
			{
				$input_json = json_decode($input, true);
			    $user_id = $input_json["id"];
				$description = $input_json["description"];
				$update_ret = $a_db_connection->set_student_description($user_id, $description);
				echo "update_ret = " . $update_ret;
			}
		}
		

		
	}
?>