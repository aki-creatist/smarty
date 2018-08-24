<?php
//カウンター変数が両方i
for ($i = 0; $i < 3; $i++) {
    echo "<span style=color:#F0F;>" . ($i + 1)  . "周目の中の、</span><br>";
    echo "<span style=color:#C3F>子ループ前の変数i=" . $i . "</span><br>";

    miniRoop(2);

    echo "<span style=color:#C3F>子ループ後の変数i=" . $i . "</span><br>";
}
echo "<span style=color:#FCF>親ループ後の" . $i . "</span>";

function miniRoop($kazu)
{
    for ($i = 1; $i <= $kazu; $i++) {
        echo  "<span style=color:#C9F;>関数内の" . $i . "回目のループ</span><br>";
    }
}
