<?php 
use core\App;
use core\Database;

$db = App::resolve(Database::class);

$currentUserId = 1;

$note = $db->query('select * from notes where id = :id', [
    'id' => $_GET['id']
])->findOrFail();


authorise($note['user_id'] ===  $currentUserId);

view("notes/edit.view.php",[
    'heading' => 'Edit Note',
    'errors' => [],
    'note' => $note,
]);
