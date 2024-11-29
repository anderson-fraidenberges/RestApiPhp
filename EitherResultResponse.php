<?php

abstract class EitherResultResponse {
    abstract public function isSuccess(): bool;
    abstract public function isError(): bool;
}

class ResultSuccess extends EitherResultResponse {
    private $value;
    private $statusCode;
    private $message;

    public function __construct($value, $message ="", $statusCode = "200") {
        $this->value = $value;
        $this->statusCode = $statusCode;
        $this->message = $message;
    }

    public function isSuccess(): bool {
        return true;
    }

    public function isError(): bool {
        return false;
    }

     public function getValue() {
         return [
             "statusCode" => $this->statusCode,
             "message" => $this->message,
             "data" => $this->value
         ];
     }    
}


class ResultError extends EitherResultResponse {
    private $error;    

    public function __construct($error) {
        $this->error = $error;
    }

    public function isSuccess(): bool {
        return false;
    }

    public function isError(): bool {
        return true;
    }

    public function getValue() {
        return [
            "statusCode" => "500",
            "message" => "Error executing: $this->error"
        ];
    }   
}
