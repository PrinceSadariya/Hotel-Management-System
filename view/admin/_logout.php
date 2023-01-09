<?php
require '../../model/_constant.php';

session_start();
session_unset();
session_destroy();

header("Location: " . SITE_URL . "view/admin/login.php");
