<?php
$score = 70; //数字

if ($score >= 80) {
    echo "80以上です";
} elseif ($score >= 60) {
    echo "80以下、60以上です";
} elseif ($score >= 40) {
    echo "60以下、40以上です";
} else {
    echo "40以下です";
}
