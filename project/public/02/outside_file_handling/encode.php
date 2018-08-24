<?php
function e($str, $charset = 'UTF-8')
{
    echo(htmlspecialchars($str, ENT_QUOTES, $charset));
}
