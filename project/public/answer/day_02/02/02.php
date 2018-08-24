<?php

$email = "u.*#$%&+/=ari145@gmail.com";
$pattern = '/^([a-zA-Z0-9])+([a-zA-Z0-9\?\*\[|\]%\'=~^\{\}\/\+!#&\$\._-])*@([a-zA-Z0-9_-])+\.([a-zA-Z0-9\._-]+)+$/';

if (preg_match($pattern, $email) === 1) {
    echo "correct";
} else {
    echo "incorrect";
}
