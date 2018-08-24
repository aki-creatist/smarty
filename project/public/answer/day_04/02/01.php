<?php

require_once 'PDODatabase.class.php';
require_once 'CheckError.class.php';
require_once 'smarty/libs/Smarty.class.php';
require_once 'config.php';

$smarty = new Smarty();
$db     = new PDODatabase(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$checkError = new CheckError();

// テンプレートディレクトリ指定
$smarty->template_dir = 'smarty/templates/';
$smarty->compile_dir  = 'smarty/templates_c/';

$table = 'member_tb';

//選択肢リスト
$arr_choice_sex = ["男", "女"];
$arr_choice_language = ["", "C/C++", "Java", "C#", "PHP", "Perl", "Ruby"];

$name        = isset($_POST['name']) === true ? $_POST['name'] : '';
$age         = isset($_POST['age']) === true ? $_POST['age'] : '';
$sex         = isset($_POST['sex']) === true ? $_POST['sex'] : '';
$language    = isset($_POST['language']) === true ? $_POST['language'] : '';
$file_name ="none";

$arr_err_msg = [
    "name"        => '',
    "age"         => '',
    "sex"         => '',
    "image"       => '',
    "language"    => '',
];

$arr_form = [
    "name" =>$name,
    "age"  =>$age,
    "sex"  =>$sex,
    "language" =>$language
];

if (isset ($_POST['send']) === true) {
    $files = $_FILES;
    $arr_err_msg = $checkError->errorCheck($arr_form, $files);
    $check_flg = $checkError->getErrorFlg();

    if ($check_flg === true) {
        var_dump($_FILES);
        $file_name = isset($_FILES["image"]) === true ? $_FILES["image"]["name"] : 'none';

        $ins_data = [
            'name' => $name,
            'age' => $age,
            'sex' => $sex,
            'language' => $language,
            'image' => $file_name
        ];

        $res = $db->insert($table, $ins_data);

        if ($res !== false) {
            //ファイルUP
            if ($file_name !== 'none') {
                if (move_uploaded_file($_FILES['image']['tmp_name'], './image/' . $file_name) === true) {
                    echo "success!";
                    exit;
                }
            } else {
                echo "success!";
                exit;
            }
        }else{
            echo "データ入力に失敗しました。";
            exit;
        }
    }
}

$query = "SELECT name, sex, age, language, image FROM $table";
$columns = 'name, sex, age, language, image';

$arrMember = $db->select($table, $columns);

$smarty->assign('selected_gender', $arr_choice_sex);
$smarty->assign('selected_language', $arr_choice_language);
$smarty->assign('posted_data', $arr_form);
$smarty->assign('err_msg', $arr_err_msg);
$smarty->assign('arrMember', $arrMember);

$smarty->display('01.tpl');
