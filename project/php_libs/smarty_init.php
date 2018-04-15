<?php

define("_SMARTY_TEMPLATES_DIR",   __DIR__ . "/templates/" . _BASE_NAME);
define("_SMARTY_TEMPLATES_C_DIR", __DIR__ . "/templates_c/" . _BASE_NAME);

require_once _PHP_LIBS_DIR . '/vendor/autoload.php';

if (_BASE_NAME === 'contents') {
    define("_GLOBAL_CLASS_DIR", _PHP_LIBS_DIR . "../class/");
    define("_COMMON_CLASS_DIR", _PHP_LIBS_DIR . "class/");
    define("_CLASS_DIR", _PHP_LIBS_DIR . $base_name . "/class/");

    require_once _GLOBAL_CLASS_DIR . 'BaseModel.php';
    require_once _GLOBAL_CLASS_DIR . 'PDODatabase.class.php';
    require_once _GLOBAL_CLASS_DIR . 'Paginator.class.php';
    require_once _COMMON_CLASS_DIR . 'SmartyController.php';

    require_once _CLASS_DIR . 'Validator.class.php';
    require_once _CLASS_DIR . 'controller/BaseController.php';
    require_once _CLASS_DIR . 'Assign.class.php';
    require_once _CLASS_DIR . 'controller/ContentsController.php';
    require_once _CLASS_DIR . 'model/ContentsModel.php';
}

