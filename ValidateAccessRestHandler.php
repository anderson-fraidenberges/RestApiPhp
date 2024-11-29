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

   function renderResultNotAccess() {
    $requestContentType = 'application/json';
    $statusCode = 401;

    $this ->setHttpHeaders($requestContentType, $statusCode);
            
     if(strpos($requestContentType,'application/json') !== false){
        $response = $this->getHttpStatusMessage($statusCode);
        echo $response;
     }		
   }

   function renderResultBadRequest() {
    
    $requestContentType = 'application/json';
    $statusCode = 400;
        
    $this ->setHttpHeaders($requestContentType, $statusCode);
            
     if(strpos($requestContentType,'application/json') !== false){
        $response = $this->getHttpStatusMessage($statusCode);
        echo $response;
     }		
   }
 }
?>