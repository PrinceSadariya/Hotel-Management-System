<?php
require '../../model/_constant.php';
require_once '../../controller/Query.php';

require_once '../../vendor/autoload.php';

//FOR ERROR HANDLING 
if (!isset($_GET["hit_limit"])) {
    $_GET["hit_limit"] = null;
}

$errorMsg = false;
$sentMsg = false;
if (isset($_POST["submit"])) {

    $userEmail = $_POST["userEmail"];
    $queryObject = new Query();
    $userData = $queryObject->getData("users", '*', ["user_email" => $userEmail]);
    if ($userData != 0) {
        $userName = $userData[0]["user_name"];

        $token = md5($userEmail) . rand(10, 9999);
        // echo $token;
        $link = SITE_URL . "view/admin/new_password_page.php?token=" . $token . "&eid=" . $userEmail;
        $insertArr = ["token" => $token, "user_email" => $userEmail];
        $queryObject->insertData("forgot_pass_tokens", $insertArr);
        echo "Your Password Forgot link : <a href='$link' target='_blank'>Clikc here</a>";
        $sentMsg = true;


        //SENDING EMAIL USING SENDGRID

        // $email = new \SendGrid\Mail\Mail();
        // $email->setFrom("sadariyaprince3516@gmail.com", "Prince");
        // $email->setSubject("Hotel Management Password Reset Link");
        // $email->addTo("190770116123@socet.edu.in", "Prince Sadariya");
        // $email->addContent("text/plain", "Hello $userName");
        // $email->addContent(
        //     "text/html",
        //     "<strong style='color:red'>This link can open only one time</strong><br>
        //     <a href='$link'>Click here to change password</a>"
        // );
        // $sendgrid = new \SendGrid(SENDGRID_API_KEY);
        // try {
        //     $response = $sendgrid->send($email);
        //     // print $response->statusCode() . "\n";
        //     // print_r($response->headers());
        //     // print $response->body() . "\n";
        // } catch (Exception $e) {
        //     echo 'Caught exception: ' . $e->getMessage() . "\n";
        // }
    } else {
        $errorMsg = true;
    }
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

    if ($errorMsg) {

        echo ' <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    Please enter valid email id
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>';
    }
    if ($sentMsg) {

        echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Link has been sent to your email id
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>';
    }
    if ($_GET["hit_limit"] == true) {
        echo ' <div class="alert alert-warning alert-dismissible fade show" role="alert">
                Your forgot password link is already open one time , now please request for new forgot password link
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }
    ?>

    <div class="container">

        <div class="container d-flex justify-content-center mt-4">
            <div class="d-flex flex-column justify-content-center w-50">
                <div>
                    <h3 class="text-center">Forgot your password?</h3>
                    <p class="text-center text-muted">Link to reset your password will be sent to your email</p>
                </div>
                <div>
                    <form action="./forgot_password.php" method="post">

                        <div>
                            <label for="userEmail" class="form-label">Email</label>
                            <input type="email" name="userEmail" id="userEmail" class="form-control">
                        </div>
                        <div class="mt-3 text-center">
                            <input type="submit" value="Request password reset" name="submit" class="btn btn-primary">
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
    <?php include './__footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>