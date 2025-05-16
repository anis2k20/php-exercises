<?php

namespace Http\Forms;

use core\ValidationException;
use core\validator;

class LoginForm
{
    protected $errors = [];

    public function __construct($attributes)
    {
         if (! validator::email($attributes['email'])) {
                $this->errors['email'] = "Please provide a valid email adderess";
            }
    
            if (! validator::string($attributes['password'])) {
                $this->errors['password'] = "Please provide a valid password";
            }
    }

    public static function validate($attributes)
    {

        $instance = new static($attributes);
        
        if($instance->faild()){
            throw new ValidationException();
        }

        return $instance;
    }

    public function faild(){
        return count($this->errors);
    }
    public function errors(){
        return $this->errors;
    }

    public function error($field, $message){
        $this->errors[$field] = $message;
    }
}
