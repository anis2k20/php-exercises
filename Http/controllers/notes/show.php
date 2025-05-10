<?php

use core\App;
use core\Database;

$db = App::resolve(Database::class);

$currentUserId = 1;

$note = $db->query('select * from notes where id = :id', [
    'id' => $_GET['id']
])->findOrFail();


authorise($note['user_id'] ===  $currentUserId);

view("notes/show.view.php", [
    'heading' => 'Notes',
    'note' => $note,
]);
