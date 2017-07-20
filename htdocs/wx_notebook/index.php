<?php
	/**
	* 
	*/
	class NoteBook
	{
		function __construct()
		{
			
		}


		public function doSomething()
		{
			$numargs = func_num_args();
		    $GET = func_get_arg(0); //get的数据
		    $POST = func_get_arg(1); //post的数据
			echo "exe doSomething";
		}
	}
?>