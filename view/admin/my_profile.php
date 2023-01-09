<?php
require './__check_login.php';
require_once '../../controller/Query.php';

$userId = $_SESSION["userId"];

$queryObject = new Query();

$userData = $queryObject->getData('users', '*', ["user_id" => $userId]);

$userName = $userData[0]["user_name"];
$userEmail = $userData[0]["user_email"];
$userPass = $userData[0]["user_password"];
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hotel Scope | A Hotel Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <link rel="stylesheet" href="../../lib/css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <?php include './__header.php'; ?>
    <?php include './__sidebar.php'; ?>

    <div class="container">
        <div>
            <h2 class="text-center">My Profile</h2>
        </div>
        <div class="mt-4">
            <table class="table table-bordered">
                <tr>
                    <th>Username</th>
                    <th class="text-center">:</th>
                    <td><?php echo $userName ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <th class="text-center">:</th>
                    <td><?php echo $userEmail ?></td>
                </tr>
                <tr>
                    <th>Password</th>
                    <th class="text-center">:</th>
                    <td> <?php for ($i = 0; $i < strlen($userPass); $i++) {
                                if ($i == 0 || $i == strlen($userPass) - 1) {
                                    echo $userPass[$i];
                                } else {
                                    echo "*";
                                }
                            } ?>
                        <div class="text-end"><a class="btn btn-primary" href="./reset_password.php">Change Password</a></div>
                    </td>
                </tr>
            </table>
        </div>
    </div>


    <?php include './__footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="../../lib/js/bootbox.js"></script>

</body>

</html>