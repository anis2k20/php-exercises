<?php

use core\Validator;
use core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$errors = [];

if (! Validator::string($_POST['body'], 1, 10)) {
    $errors['body'] = 'A body is required and note more than 10 characters';
}

if (! empty($errors)) {
    //validation issues
    return view("notes/create.view.php",[
        'heading' => 'Note Create',
        'errors' => $errors,
    ]);
}

$db->query('INSERT INTO notes(body,user_id) VALUES(:body, :user_id)', [
    'body' => $_POST['body'],
    'user_id' => 1,
]);

header("location: /notes");
die();
