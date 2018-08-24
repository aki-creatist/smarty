<?php
if (isset($_POST['year']) === true) {
    if ($_POST["year"] != "") {
        echo $_POST["year"];
    } else {
        echo "年を選択してください。<br>";
    }
}
