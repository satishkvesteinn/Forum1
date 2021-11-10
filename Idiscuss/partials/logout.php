<?php

session_start();

echo "logging you out. PLease wait";

session_destroy();
header('Location: /idiscuss/index.php');

?>