<?php
session_start();
echo "logging you out. PLease wait";
session_unset();
session_destroy();
header('Location: /idiscuss/admin/adminlogin.php');
?>