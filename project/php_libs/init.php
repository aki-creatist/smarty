<?php

define('ROOT_DIR', __DIR__ );

require_once ROOT_DIR . '/vendor/autoload.php';

ini_set('date.timezone', 'Asia/Tokyo');

define("_MEMBER_SESSNAME", "PHPSESSION_MEMBER");
define("_SYSTEM_SESSNAME", "PHPSESSION_MEMBER");
define("_MEMBER_AUTHINFO", "userinfo");   // 会員用フラグ
define("_SYSTEM_AUTHINFO", "systeminfo"); // 管理者フラグ

$smarty = new Smarty();
define('MY_TITLE', '会員制掲示板');

define('_SMARTY_TEMPLATES_DIR', ROOT_DIR . '/view/');
define('_SMARTY_TEMPLATES_C_DIR', ROOT_DIR . '/templates_c');

$mail = '/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+[a-zA-Z0-9\._-]+$/';
define('RULE_MAIL', $mail);

require_once '../../config.php';

require_once '../../php_libs/routes/contents.php';
require_once '../../php_libs/routes/members.php';
require_once '../../php_libs/routes/systems.php';

require_once '../../php_libs/controller/base/BaseController.php';
require_once '../../php_libs/controller/base/Validator.php';
require_once '../../php_libs/controller/base/SessionController.php';
require_once '../../php_libs/controller/base/FormTrait.php';

require_once '../../php_libs/controller/ContentsController.php';
require_once '../../php_libs/controller/MembersController.php';
require_once '../../php_libs/controller/PreMembersController.php';
require_once '../../php_libs/controller/SystemsController.php';

require_once '../../php_libs/model/base/BaseModel.php';
require_once '../../php_libs/model/base/Database.php';
require_once '../../php_libs/model/Contents.php';
require_once '../../php_libs/model/Members.php';
require_once '../../php_libs/model/MemberPostcode.php';
require_once '../../php_libs/model/MemberTraffic.php';
require_once '../../php_libs/model/PreMember.php';
require_once '../../php_libs/model/Systems.php';
require_once '../../php_libs/model/Traffic.php';

require_once '../../php_libs/controller/AuthController.php';

