<?php
require '../../model/_constant.php';
session_start();
if (!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)) {
    header('Location: ' . SITE_URL . 'view/admin/login.php');
}
