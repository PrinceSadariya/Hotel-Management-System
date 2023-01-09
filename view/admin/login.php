<?php
require '../../model/_constant.php';
session_start();
if (isset($_SESSION["loggedin"])) {
    header("Location: " . SITE_URL . "view/admin/home.php");
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
    <?php include './__header.php'; ?>

    <div class="container">
        <?php
        if (isset($_GET["error_msg"])) {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        Username or Password is incorrect
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
        }
        ?>
        <div class="container d-flex justify-content-center mt-4">
            <div class="d-flex flex-column justify-content-center w-50">
                <div>
                    <h2 class="text-center">Admin Login</h2>
                </div>
                <div>
                    <form action="./_handle_login.php" method="POST">

                        <div class="mb-3">
                            <label for="uname" class="form-label">User Name</label>
                            <input type="text" name="uname" id="uname" class="form-control">
                            <div id="userNameErr" class="form-text text-danger"></div>
                        </div>
                        <div class="mb-3">
                            <label for="upass" class="form-label">Enter Your Password</label>
                            <input type="password" name="upass" id="upass" class="form-control">
                        </div>
                        <div class="text-end">
                            <a href="./forgot_password.php">Forgot Password?</a>
                        </div>
                        <div class="mb-3 text-center">
                            <input type="submit" value="Login" name="submit" class="btn btn-primary">
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
    <?php include './__footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            $('#uname').keyup(function() {
                if ($('#uname').val().indexOf("@") == -1) {
                    $('#userNameErr').html("Invalid input format");
                } else {
                    $('#userNameErr').html("");
                }
            })
        })
    </script>
</body>

</html>