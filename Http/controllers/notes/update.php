<?php

use core\App;
use core\Database;
use core\validator;

$db = App::resolve(Database::class);

$currentUserId = 1;

$note = $db->query('select * from notes where id = :id', [
    'id' => $_POST['id']
])->findOrFail();

authorise($note['user_id'] === $currentUserId);

$errors = [];

if (! Validator::string($_POST['body'], 1, 100)) {
    $errors['body'] = 'A body is required and note more than 10 characters';
}

if(count($errors)){
    return view('notes/edit.view.php', [
        'heading'=> 'Edit Note',
        'errors' => $errors,
        'note' => $note,
    ]);
}

$db->query('update notes set body = :body where id = :id', [
    'id'=>$_POST['id'],
    'body'=>$_POST['body']
]);

header('location: /notes');
die();