<?php
 require_once("SimpleRest.php");

 class ValidateAccessRestHandler extends SimpleRest
 {
   function isValidated($xreq):bool
   {
       if ($xreq !== "#ProjetoIntegradorAccessKey#") {
            $this->renderResultNotAccess();
            return false;
        };
         return true;
   }

   public function renderResultNotAccess() {
    $requestContentType = 'application/json';
    $this ->setHttpHeaders($requestContentType, 401);
            
     if(strpos($requestContentType,'application/json') !== false){
        $response = $this->encodeJson("Not Unauthorized");
        echo $response;
     }		
   }
 }
?>