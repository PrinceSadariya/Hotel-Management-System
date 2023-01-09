<?php

require '../../model/_constant.php';
require_once '../../controller/Query.php';

if (isset($_POST["submit"])) {

    $uname = $_POST["uname"];
    $upass = $_POST["upass"];

    if (!empty($uname) && !empty($upass)) {
        $obj = new Query();

        $conditionArr = array('user_name' => $uname);

        $data = $obj->getData('users', '*', $conditionArr);

        if (count($data) > 0) {
            if ($data[0]["user_password"] === $upass) {
                session_start();
                $_SESSION["loggedin"] = true;
                $_SESSION["uname"] = $uname;
                $_SESSION["userId"] = $data[0]["user_id"];
                header("Location: " . SITE_URL . "view/admin/home.php");
                exit;
            }
        }
    }
    header("Location: " . SITE_URL . "view/admin/login.php?error_msg=false");
}
