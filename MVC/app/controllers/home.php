<?php
	class home extends controller{
		public function index(){
			echo "Welcome to the Index site";
		}
		public function user($name = ''){
			$user = $this->model('User');
			$user->name = $name;
			$this->view('home/index',['name'=>$user->name]);
		}

		public function admin(){
			require_once "../app/views/admin/admin.php";
		}
	}

?>