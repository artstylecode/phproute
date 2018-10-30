<?php
		namespace route\controller;
		/**
		 * 
		 */
		class UserController extends Controller
		{
			
		

			public function getUser($id)
			{
				return "userid is :$id";
			}

			public function getUsers()
			{
				$list = [];
				$list[] = ["name" => "user1", "age" => 12];
				$list[] = ["name" => "user2", "age" => 15];
				$list[] = ["name" => "user3", "age" => 16];
				return $this->render("user/list", ["users" => $list]);
			}

			public function test()
			{
				$list = array('user' => 12,'user2'=>13 );
				return $this->jsonRender($list);
			}
		}
?>