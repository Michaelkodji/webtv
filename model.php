<?php

	class crud {

		private function server (){
			$db= new PDO('mysql:host=localhost;dbname=webtv_db','root','');
			return $db;
		}

		public function readWhere($field,$table,$condition,$data){
			$db=$this->server();
			$req = $db->prepare('SELECT '.$field.' FROM '.$table.' WHERE '.$condition.'');
			$req->execute($data);
			return $req;
		}

		public function readAll($field,$table){
			$db  = $this->server();
			$req = $db->query('SELECT '.$field.' FROM '.$table.'');
			return $req;
		}

		public function add($table,$field,$value,$data){
			$db = $this->server();
			$req = $db->prepare('INSERT INTO '.$table.'('.$field.') VALUES('.$value.')');
			$req->execute($data);
			return $db->lastInsertId();
		}

		public function up($table,$field,$condition,$data){
			$db = $this->server();
			$req = $db->prepare('UPDATE '.$table.' SET '.$field.' WHERE '.$condition.'');
			$req->execute($data);
		}


		public function del($table,$condition,$data){
			$db = $this->server();
			$req = $db->prepare('DELETE FROM '.$table.' WHERE '.$condition.'');
            $req->execute($data);
		}
	}

?>