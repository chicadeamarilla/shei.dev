<?php

//print_r($_COOKIE);

foreach ($_COOKIE as $name => $value) {
    // expire cookie for path /
    setcookie($name, '', time() - 3600, '/');
    // for good measure, also unset from PHP's $_COOKIE
    unset($_COOKIE[$name]);
}

header("Location: index.php");
exit;




?>