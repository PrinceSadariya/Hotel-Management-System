<?php
require './__check_login.php';

require_once '../../controller/Query.php';

require_once '../../vendor/autoload.php';

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
    <?php include './__header.php'; ?>
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
    <div style="min-height: 80vh;" id="change-pass-container" class="container d-flex align-items-center">

        <div class="mt-4 row bg-light rounded shadow p-3 w-100">
            <div class="col-md-8">
                <div class="text-center">
                    <h2>Change Password</h2>
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

                <form id="changePassForm" action="javascript:void(0)" method="post" class="text-center" onsubmit="return validate(this)">
                    <div class="mb-3">
                        <input type="hidden" name="userId" value="<?php echo $_SESSION["userId"] ?>">
                        <label for="oldPassword" class="form-label">Enter Your Current Password</label>
                        <input type="text" name="oldPassword" id="oldPassword" class="form-control">
                        <div id="oldPassErr" class="text-danger form-text">Please enter your current password</div>
                    </div>
                    <div class="mb-3">
                        <label for="newPassword" class="form-label">New Password</label>
                        <input type="text" name="newPassword" id="newPassword" class="form-control">
                        <div id="newPassErr" class="text-danger form-text">Please enter new password</div>
                        <div id="lowerCaseErr" class="text-danger form-text">At least one lowercase letter</div>
                        <div id="upperCaseErr" class="text-danger form-text">At least one uppercase letter</div>
                        <div id="numberErr" class="text-danger form-text">At least one number</div>
                        <div id="lengthErr" class="text-danger form-text">At least 8 characters</div>
                    </div>
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Confirm Password</label>
                        <input type="text" name="confirmPassword" id="confirmPassword" class="form-control">
                        <div id="conPassErr" class="text-danger form-text">Please reenter new password</div>
                    </div>
                    <div>
                        <input id="submit" type="submit" value="Save" name="submit" class="btn btn-primary w-100">
                    </div>
                    <div class="mt-2">
                        <a href="./my_profile.php" class="text-dark">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php include './__footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="../../lib/js/reset_password.js"></script>
</body>

</html>