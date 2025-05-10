<?php
use core\App;
use core\Database;

$db = App::resolve(Database::class);

$notes = $db->query('SELECT * FROM `notes` WHERE user_id =1;')->fetchAll();

view("notes/index.view.php",[
    'heading' => 'My Notes',
    'notes' => $notes,
]);
