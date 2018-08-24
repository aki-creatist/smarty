<?php
for ($y = 0; $y < 3; $y++) {
    echo "<span style=color:#F0F;>" . ($y + 1) . "周目の中の、</span><br>";
    for ($x = 0; $x < 2; $x++) {
        echo "<span style=color:#C9F;>入れ子の" . ($x + 1) . "回目のループです。</span><br>";
    }
}
