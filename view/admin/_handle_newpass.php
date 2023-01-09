<?php
require_once '../../controller/Query.php';

$password = $_POST["newPass"];
$confirmPassword = $_POST["conNewPass"];
$userEmail = $_POST["userEmail"];

//RETRIVING OLD PASSWORD
$queryObject = new Query();

$userData = $queryObject->getData("users", '*', ["user_email" => $userEmail]);
$oldPassword = $userData[0]["user_password"];

if (!empty($password) && !empty($confirmPassword)) {
    if ($password == $confirmPassword) {
        if (preg_match('/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/i', $password)) {

            if ($password != $oldPassword) {
                $passChange = $queryObject->updateData("users", ["user_password" => $password], ["user_email" => $userEmail]);
                if ($passChange) {
                    echo "Your password has been change";
                } else {
                    echo "Error in changing password";
                }
            } else {
                echo "Password can not be same as old , Please change it";
            }
        } else {
            echo "Please use at least one lowercase and one uppercase and one number and password must have at least 8 characters";
        }
    } else {
        echo "Both Password does not match";
    }
} else {
    echo "Password can not be empty";
}
