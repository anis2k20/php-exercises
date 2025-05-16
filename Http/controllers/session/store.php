<?php

use core\Authenticator;
use core\Session;
use core\ValidationException;
use Http\Forms\LoginForm;


try {

    $form = LoginForm::validate($attributes = [
        'email' => $_POST['email'],
        'password' => $_POST['password'],
    ]);
} catch (ValidationException $exception) {
    Session::flash('errors', $form->errors());

    Session::flash('old', [
        'email' => $attributes['email'],
    ]);

    
    redirect('/login');
}

// $form = new LoginForm();


if ((new Authenticator())->attempt($attributes['email'], $attributes['password'])) {
    redirect('/');
}

$form->error('email', 'No matching email found');


// $_SESSION['_flashed']['errors'] = $form->errors(); 


redirect('/login');


// return view('sessions/create.view.php', [
//     'errors' => $form->errors(),
// ]);
