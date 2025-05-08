<?php

use core\App;
use core\Database;
use core\validator;

$email = $_POST['email'];
$password = $_POST['password'];

$errors = [];
if(! validator::email($email)){
    $errors['email'] = "Please provide a valid email adderess";
}

if(! validator::string($password,6,50)){
    $errors['password'] = "Please provide a password at least 6 character";
}

if(! empty($errors)){
    return view('registration/create.view.php',[
        'errors' => $errors,
    ]);
}

$db = App::resolve(Database::class);

$user = $db->query('select * from users where email = :email',[
    'email' => $email,
])->find();

if($user){
    header('location: /');
    exit();
}else{
    $db->query('INSERT INTO users(email,password) VALUE(:email, :password)',[
        'email' => $email,
        'password' => password_hash($password, PASSWORD_BCRYPT),
    ]);

    $_SESSION['user'] = [
        'email' => $email,
    ];

    header('location: /');
    exit();
}