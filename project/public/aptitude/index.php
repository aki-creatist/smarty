<?php

require_once './getContents.php';
require_once  '../../php_libs/vendor/autoload.php';
ini_set('date.timezone', 'Asia/Tokyo');

//テンプレート指定
$smarty = new Smarty();
$smarty->setTemplateDir('../../php_libs/view/aptitude')
    ->setCompileDir('../../php_libs/templates_c');

$getCon = new getContents();

//ラジオの配列を取得
$arr_question_index = $getCon->getQuestionIndex();

//質問のリストを取得
$arr_question = $getCon->getQuestionList('./question_list.txt');

//エラーの配列
$arr_err = [];

//タイプを取得
$my_type = "";
if (isset($_POST['send']) === true) {

    unset($_POST["send"]);
    $arr_param = $_POST;

    //ラジオで値がないものを空白で出力
    $arr_param = $getCon->getArrParam($arr_param);

    //エラーメッセージの出力
    $arr_err = $getCon->getErrorMessage($arr_param);
    if ($arr_err === []) {
        //点数の取得
        $arr_score = $getCon->getScore($arr_param);
        //タイプの取得
        $my_type = $getCon->getType($arr_score);
    }
} else {
   //初回読み込み時の値の取得
   $arr_param = $getCon->getArrParam();
}

$smarty->assign('arr_question', $arr_question);
$smarty->assign('arr_question_index', $arr_question_index);
$smarty->assign('arr_err', $arr_err);
$smarty->assign('arr_param', $arr_param);
$smarty->assign('my_type', $my_type);

$smarty->display('index.tpl');

