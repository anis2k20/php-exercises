<?php

use core\App;
use core\Database;
use core\validator;

$db = App::resolve(Database::class);

$email = $_POST['email'];
$password = $_POST['password'];

$errors = [];
if(! validator::email($email)){
    $errors['email'] = "Please provide a valid email adderess";
}

if(! validator::string($password)){
    $errors['password'] = "Please provide a password";
}

if(! empty($errors)){
    return view('sessions/create.view.php',[
        'errors' => $errors,
    ]);
}
// match
$user = $db->query('select * from users where email = :email',[
    'email'=>$email
])->find();

if($user){
    if(password_verify($password, $user['password'])){

        login([
            'email'=> $email
        ]);
        header('location: /');
        exit();
    }
    // return view('sessions/create.view.php',[
    //     'errors' => [
    //         'email'=>'No matching account found according to this email.'
    //     ],
    // ]);
}

return view('session/create.view.php',[
    'errors' => [
        'email'=>'No matching account found according to this email and password.'
    ],
]);