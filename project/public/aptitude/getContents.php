<?php

class getContents
{
    /**
     * 外部ファイルを読み込み、[行番号 => 内容],を多次元配列で返す
     * @param $file_path
     * @return array
     */
    public function getQuestionList($file_path)
    {
        $fp = fopen($file_path, "r");
        $arr_question = [];
        // 質問番号は１から始まるようにする
        $question_no = 1;

        while ($res = fgets($fp)) {
            $single_question = [
                "no"       => "No" . $question_no,
                "question" => $res
            ];
            $arr_question[] = $single_question;
            $question_no++;
        }

        return $arr_question;

    }

    public function getQuestionIndex()
    {
        $arr_question_index = [
            "1" => "1",
            "2" => "2",
            "3" => "3",
            "4" => "4"
        ];
        return $arr_question_index;
    }

    public function getErrorMessage($arr_param)
    {
        $arr_err = [];
        for ($i=1; $i<=20; $i++) {
            $key_no ="No".$i;
            if ($arr_param[$key_no] === "") {
                $arr_err[$key_no] = "選択肢を選択してください";
            }
        }

        return $arr_err;
    }

    public function getArrParam($arr_post = [])
    {
        $arr_param = [];
        for ($i=1; $i<=20; $i++) {
            $key_no ="No".$i;

            if (isset($arr_post[$key_no]) !== true) {
                $arr_param[$key_no] = "";
            } else {
                $arr_param[$key_no] = $arr_post[$key_no];
            }
        }
        return $arr_param;
    }

    public function getScore($arr_param)
    {
        $arr_score = [
            'controller' => 11,
            'promoter'   => 12,
            'supporter'  => 12,
            'analyzer'   => 13
        ];

        foreach ($arr_param as $key_no => $score) {

            switch ($key_no) {
                case 'No4':
                case 'No7':
                case 'No17':
                case 'No19':
                case 'No20':
                    $arr_score["controller"] -= $score;
                    break;

                case 'No2':
                case 'No6':
                case 'No8':
                case 'No11':
                case 'No14':
                    $arr_score["promoter"] -= $score;
                    break;

                case 'No3':
                case 'No9':
                case 'No13':
                case 'No16':
                case 'No18':
                    $arr_score["supporter"] -= $score;
                    break;

                case 'No1':
                case 'No5':
                case 'No10':
                case 'No12':
                case 'No15':
                    $arr_score["analyzer"] -= $score;
                    break;
            }

        }
        return $arr_score;
    }

    public function getType($arr_score)
    {
        $loop_cnt = 0;
        $max = '';
        $my_type = '';

        foreach ($arr_score as $type => $score) {

            if ($loop_cnt === 0) {
                $max = $score;
                $my_type = $type;
            }

            if ($score > $max) {
                $max = $score;
                $my_type = $type;
            }
            $loop_cnt++;
        }
        return $my_type;
    }
}
