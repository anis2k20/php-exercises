<?php

use core\Session;

view('session/create.view.php', [
    'heading'=>"Login",
    'errors'=>Session::get('errors'),
]);