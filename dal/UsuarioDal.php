<?php
require_once("dbcontroller.php");

Class UsuarioDal {
	private $usuario = array();	    
    
	public function getAll() {
		
		$query = "SELECT id, name, email, createdAt, updatedAt FROM users";
		$dbcontroller = new DBController();
		$this->contato = $dbcontroller->executeSelectQuery($query);

		return $this->contato;
	}
	
	public function insert($name, $email, $password) {	
		$dbcontroller = new DBController();

		$strIns = "INSERT INTO users (name, email, password, createdAt, updatedAt) values (?, ?, ?, now(), now())";
        $params = [$name, $email, $password];

		return $dbcontroller->executeInsertWithReturnId($strIns, $params);		
    }
    
    public function delete($id) {	
		$dbcontroller = new DBController();
		$strDel = "DELETE FROM users WHERE id = ?";
		
		return $dbcontroller->executeDelete($strDel,[$id]);		
    }
}
?>