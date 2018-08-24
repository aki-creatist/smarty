<?php

$questions = getQuestionList('./question_list.txt');

foreach ($questions as $value) {
    echo $value["no"];
    echo $value["question"] . "<br>";
}

/**
 * 外部ファイルのテキストを配列で取得する
 * @param $file_path
 * @return array
 */
function getQuestionList($file_path)
{
    $fp = fopen($file_path, "r");
    $questions = [];
    $question_no = 1;
    while ($res = fgets($fp)) {
        $single_question = [
            "no"       => "No" . $question_no,
            "question" => $res
        ];
        $questions[] = $single_question;
        $question_no ++;
    }
    return $questions;
}