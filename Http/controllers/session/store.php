<?php

use core\Authenticator;
use core\Session;
use Http\Forms\LoginForm;


$email = $_POST['email'];
$password = $_POST['password'];

$form = new LoginForm();
if ($form->validate($email, $password)) {
    if ((new Authenticator())->attempt($email, $password)) {
        redirect('/');
    }
    $form->error('email', 'No matching email found');
}

// $_SESSION['_flashed']['errors'] = $form->errors(); 
Session::flash('errors', $form->errors());

Session::flash('old',[
    'email' => $_POST['email']
]);

redirect('/login');


// return view('sessions/create.view.php', [
//     'errors' => $form->errors(),
// ]);

