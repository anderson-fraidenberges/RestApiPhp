<?php
require_once("SimpleRest.php");
require_once("dal/UsuarioDal.php");
		
class UsuarioRestHandler extends SimpleRest {		

	function getAll() {		
		$usuario = new UsuarioDal();
		$rawData = $usuario->getAll();		
		$this->renderResult($rawData);		
		}
    
    function insert($name, $email, $password) {
        $usuario = new UsuarioDal();
		$rawData = $usuario->insert($name, $email, $password);
		$this->renderResult($rawData);	
    }
    
    function delete($id) {
        $usuario = new UsuarioDal();
		$rawData = $usuario->delete($id);
		$this->renderResult($rawData);	
    }
}
?>