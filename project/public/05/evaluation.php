<!doctype html>
<html>
<head>
    <?php include('/var/www/html/head.php');?>
</head>

<body id="about">
<div id="container">

    <header class="basicinfo" id="header">
        <h1>学習課題</h1>
    </header>

    <nav id="nav">
        <?php include('/var/www/html/nav.php');?>
    </nav>

    <div id="main">
        <article id="content">
            <h2>評価表</h2>
            <?php
            $arr_param = initArrParam(); // 初期化
            $questions = getQuestions(); // 質問項目首藤
            $sum = 0;                    // 初期時の持ち点
            $arr_err = [];               // エラーメッセージ

            // ラジオボタンの値の受け取り
            $arr_param = [];
            $posted = [];
            if (isset($_POST["send"]) === true) {
                unset($_POST["send"]);
                $posted = $_POST;
                $sum = getSum($posted);           // 合計点算出
                $arr_err = errorMessage($posted); // 未入力項目にエラーメッセージ
            }

            $arr_param = createArrParam($posted, $arr_param);

            $Questions = new Questions();
            $points = $Questions->getPoints();

            /**
             * 外部ファイルの読み込み
             */
            function getQuestions()
            {
                $fp = fopen("goal.txt", "r");
                $questions = [];
                $question_no =1;

                while ($res = fgets($fp)) {
                    $single_question = [
                        "no"       => "No" . $question_no,
                        "question" => $res
                    ];

                    $questions[] = $single_question;
                    $question_no++;
                }
                return $questions;
            }

            /**
             * 初期化
             */
            function initArrParam()
            {
                for ($i=1; $i <= 20; $i++) {
                    $key_no = "No" . $i;
                    $arr_param[$key_no] = "";
                }
                return $arr_param;
            }

            /**
             * 質問項目の作成
             */
            function createArrParam($posted, $arr_param)
            {
                for ($i=1; $i <= 20; $i++) {
                    $key_no = "No" . $i;
                    if (array_key_exists($key_no, $posted)) {
                        $arr_param[$key_no] = $posted[$key_no];
                    } else {
                        $arr_param[$key_no] = "";
                    }
                }
                return $arr_param;
            }

            /**
             * 送信された値が空の場合にエラーメッセージを挿入
             */
            function errorMessage($posted)
            {
                // エラー処理
                for ($i=1; $i <= 20; $i++) {
                    $key_no = "No" . $i;

                    if (!array_key_exists($key_no, $posted)) {
                        $arr_err[$key_no] = "選択をしてください。";
                    } else {
                        $arr_err[$key_no] = "";
                    }
                }
                return $arr_err;
            }

            /**
             * 結果の計算
             */
            function getSum($posted)
            {
                $sum = 0;
                if ($posted !== []) {
                    foreach ($posted as $key_no => $score) {
                        $sum += $score;
                    }
                }
                return $sum;
            }

            /**
             * Class Questions
             * 評価の定義(C-, C, C+...)と評価ごとの点数を配列で返す
             */
            class Questions
            {
                public function getPoints()
                {
                    $evals = $this->getEvals();

                    $point = 1;
                    for ($i = 1; $i < 10; $i++) {
                        $points[$evals[$i]] = $point;
                        $point += 0.5;
                    }
                    return $points;
                }

                private function getEvals()
                {
                    $evals_a_b_c = ['C', 'B', 'A'];
                    foreach ($evals_a_b_c as $eval) {
                        $evals[] = $eval . '-';
                        $evals[] = $eval;
                        $evals[] = $eval . '+';
                    }
                    $evals[] = 'S';
                    return $evals;
                }
            }
            ?>

            <form method ="post" action="#POST">
                <table class="clear">
                    <?php foreach ($questions as $no => $value) { ?>
                        <tr>
                            <th>
                                <?=$value['no']?>
                            </th>
                            <td>
                                <?=$value['question']?>
                            </td>
                            <td width="400">
                                <?php foreach($points as $eval => $point) { ?>
                                    <input type = radio name = "<?=$value['no'] ?>" value=<?=$point?> <?=$arr_param[$value['no']] == $point ? " checked" : ""?> ><?=$eval?>
                                <?php } ?>
                                <p style="color:red;">
                                    <?=isset($arr_err[$value['no']]) == true ? $arr_err[$value['no']] : ''?>
                                </p>
                            </td>
                        </tr>
                        <?php } ?>

                    <a name="POST"></a>
                    <tr>
                        <th>合計点数</th>
                        <td>
                            <?=$sum?>
                        </td>
                    </tr>
                </table>
                <input type = "submit" name = "send" value ="入力します">
            </form>
        </article>
        <div id="sidebar">
            <script>
                $(function(){
                    $("#sidebar").load("../sidebar.php");
                })
            </script>
        </div>
    </div>
</div>
</body>
</html>
