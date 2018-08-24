<?php
if (isset($_POST["gender"]) && ($_POST["gender"] == "男" || $_POST["gender"] == "女")) {
    echo "性別：";
    echo $_POST["gender"];
} else {
    echo "性別を選んでください。<br>";
}
