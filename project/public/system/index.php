<?php

require_once '../../php_libs/init.php';

$systems = new SystemsController();
$members = new MembersController(true);

systems\run($systems, $members);
