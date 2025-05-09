<?php

namespace Http\Forms;
use core\validator;

class LoginForm
{
    protected $errors = [];
    public function validate($email, $password)
    {
        if (! validator::email($email)) {
            $this->errors['email'] = "Please provide a valid email adderess";
        }

        if (! validator::string($password)) {
            $this->errors['password'] = "Please provide a valid password";
        }

        return empty($this->errors);
    }
    public function errors(){
        return $this->errors;
    }
}
