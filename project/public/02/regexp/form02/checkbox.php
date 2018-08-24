<?php
if (isset($_POST["hobby"])) {
    $hobby = implode('と', $_POST["hobby"]);
    echo "私の趣味は" . $hobby . "です。";
} else {
    echo "=>私の趣味はなにもありません。";
}
