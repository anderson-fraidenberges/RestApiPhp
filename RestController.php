<?php
require_once("UsuarioRestHandler.php");
require_once("ValidateAccessRestHandler.php");
		
$view = "";
if(isset($_GET["c"]))
  $view = $_GET["c"];
  
if(isset($_GET["page_key"]))
  $page_key = $_GET["page_key"];

$validateHandler = new ValidateAccessRestHandler();

if (!isset(getallheaders()['x-req'])) {
   $validateHandler->renderResultNotAccess();
     return;
} else {
  $xreq = getallheaders()['x-req'];
  if (!$validateHandler->isValidated($xreq))    
    return;
}
 if ($view == 'user') { 
  $usuarioRestHandler = new UsuarioRestHandler();  

   switch ($page_key) {

   case 'list':               
         $usuarioRestHandler->getAll();
    break;   
  case 'create':
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    $usuarioRestHandler->insert($data["name"], $data["email"], $data["password"]);
    break;    
  case 'delete':
    $id = $_GET["id"];    
    $usuarioRestHandler->delete($id);
    break;
 }  
}
?>