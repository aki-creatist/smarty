<?php
//カウンター変数が両方i
for ($i = 0; $i < 3; $i++) {
    echo "<span style=color:#F0F;>" . ($i +1) . "周目の中の、</span><br>";
    for ($i = 0; $i < 2; $i++) {
        echo "<span style=color:#C9F;>入れ子の" . ($i + 1) . "回目のループです。</span><br>";
    }
}

//カウンター変数が両方i
//for( $i=0; $i<3; $i++){
//    echo "<span style=color:#F0F;>" . ($i +1) . "周目の中の、</span><br>";
//    echo "<span style=color:#C3F>子ループ前の変数i=" . $i . "</span><br>";
//    for($i=0; $i<2; $i++){
//        echo "<span style=color:#C9F;>入れ子の" . ($i + 1) . "回目のループです。<br>";
//    }
//    echo "<span style=color:#C3F>子ループ後の変数i=" . $i . "</span><br>";
//}
//echo "<span style=color:#FCF>親ループ後の" . $i . "</span><br>";
