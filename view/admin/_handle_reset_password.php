<?php
require_once '../../controller/Query.php';

extract($_POST);

$queryObject = new Query();

$data = $queryObject->getData('users', '*', ["user_id" => $userId]);

$currentPass = $data[0]["user_password"];

if (!empty($oldPassword) && !empty($newPassword) && !empty($confirmPassword)) {
    if ($oldPassword === $currentPass) {
        if ($newPassword == $confirmPassword) {
            if (preg_match('/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/i', $newPassword)) {

                if ($newPassword != $currentPass) {
                    $passChange = $queryObject->updateData("users", ["user_password" => $newPassword], ["user_id" => $userId]);
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
        echo "Your Current Password is wrong";
    }
} else {
    echo "Passwords can not be empty";
}
