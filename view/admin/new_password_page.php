<?php
require '../../model/_constant.php';
require_once '../../controller/Query.php';

$limitMsg = false;

if (isset($_GET["token"]) && isset($_GET["eid"])) {
    $toekn = $_GET["token"];
    $userEmail = $_GET["eid"];

    $queryObject = new Query();

    $tokenData = $queryObject->getData("forgot_pass_tokens", '*', ["user_email" => $userEmail, "token" => $toekn]);

    if ($datokenDatata != 0) {
        if ($tokenData[0]["hit_time"] == 0) {
            $abc = $queryObject->updateData("forgot_pass_tokens", ["hit_time" => 1], ["user_email" => $userEmail, "token" => $toekn]);
        } else {
            header("Location: " . SITE_URL . "view/admin/forgot_password.php?hit_limit=true");
        }
    } else {
        header("Location: login.php");
    }
} else {
    header("Location: login.php");
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hotel Scope | A Hotel Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../lib/css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
</head>

<body>
    <?php include './__header.php';

    if ($limitMsg) {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            Site is already open one time , Now please request for new email, <a class="text-warning" href="./forgot_password.php">Click here</a> to go back
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        exit;
    }
    ?>

    <!-- FOR SUCCESS MESSAGE -->
    <div id="successMsg" class="alert alert-success alert-dismissible fade show" role="alert">
        Your password has been change, now <a href="./login.php" class="text-success">Clicl here </a> to login
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <!-- TOAST FOR ERROR MESSAGES -->
    <div class="toast-container position-fixed top-0 end-0 p-3 mt-5">
        <div id="liveToast" class="toast  bg-secondary text-light" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Hotel Management</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">

            </div>
        </div>
    </div>
    <div class="container">

        <div style="min-height: 80vh;" id="change-pass-container" class="container d-flex align-items-center">

            <div class="mt-4 row bg-light rounded shadow p-3 w-100">
                <div class="col-md-8">
                    <div class="text-center">
                        <h2>Forgot Password</h2>
                        <div class="mt-4 text-muted">
                            <p>Password must contain</p>
                            <div class="mt-2 ">
                                <div>
                                    <span class="fas fa-check text-success"></span><span> at lease one uppercase</span>
                                </div>
                                <div>
                                    <span class="fas fa-check text-success"></span><span> at lease one lowercase</span>
                                </div>
                                <div>
                                    <span class="fas fa-check text-success"></span><span> at lease one number</span>
                                </div>
                                <div>
                                    <span class="fas fa-check text-success"></span><span> at lease 8 character</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">

                    <form action="javascript:void(0)" id="newPassForm" onsubmit="return validate(this)" method="post">

                        <div>
                            <input type="hidden" name="userEmail" value="<?php echo $userEmail; ?>">
                            <label for="newPass" class="form-label">Enter new Password</label>
                            <input type="text" name="newPass" id="newPass" class="form-control">
                            <div id="newPassErr" class="text-danger form-text">Please Enter New Password</div>
                            <div id="lowerCaseErr" class="text-danger form-text">At least one lowercase letter</div>
                            <div id="upperCaseErr" class="text-danger form-text">At least one uppercase letter</div>
                            <div id="numberErr" class="text-danger form-text">At least one number</div>
                            <div id="lengthErr" class="text-danger form-text">At least 8 characters</div>
                        </div>
                        <div>
                            <label for="conNewPass" class="form-label">Confirm Password</label>
                            <input type="text" name="conNewPass" id="conNewPass" class="form-control">
                            <div id="conNewPassErr" class="text-danger form-text">Please Re Enter New Password</div>
                        </div>
                        <div class="mt-3 text-center">
                            <input id="submit" type="submit" value="Submit" name="submit" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include './__footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="../../lib/js/new_password_page.js"></script>
</body>

</html>