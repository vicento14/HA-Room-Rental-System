<?php
session_set_cookie_params(0, "/harrs");
session_name("harrs");
session_start();

session_unset();
session_destroy();
header('location:../');
?>