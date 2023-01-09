<?php

require './__check_login.php';
require_once '../../controller/Hotel.php';
require_once '../../controller/Location.php';


$heading = "Add new Hotel";
$hotelObject = new Hotel();

//ASSIGN NULL VALUE FOR ERROR HANDLING

$hotelNameOld = null;
$hotelLocationOld = null;
$shortDescOld = null;
$longDescOld = null;
$ratingOld = null;
$roomsOld = null;
$roomTypeOld = null;
$registerDateOld = null;
$statusOld = null;

if (isset($_GET["editid"])) {
    $heading = "Edit Hotel Detail";

    $editId = $_GET["editid"];
    $hotelData = $hotelObject->getHotels('*', ["hotel_id" => $editId]);

    $hotelNameOld = $hotelData[0]["hotel_title"];
    $hotelLocationOld = $hotelData[0]["hotel_location_id"];
    $shortDescOld = $hotelData[0]["short_desc"];
    $longDescOld = $hotelData[0]["long_desc"];
    $ratingOld = $hotelData[0]["hotel_star"];
    $roomsOld = $hotelData[0]["number_of_room"];
    $roomTypeOld = $hotelData[0]["room_type"];
    $registerDateOld = date("Y-m-d", strtotime($hotelData[0]["hotel_register_date"]));
    $statusOld = $hotelData[0]["status"];
    $_SESSION["smallPicOld"] = $hotelData[0]["hotel_small_pic"];
    $_SESSION["largePicOld"] = $hotelData[0]["hotel_large_pic"];
}

$validImageExt = ["jpg", "jpeg", "png"];

if (isset($_POST["editid"])) {
    if ($_POST["editid"] != '') {
        // extract($_POST);

        $editid = $_POST["editid"];
        $smallPicOld = $_SESSION["smallPicOld"];
        $largePicOld = $_SESSION["largePicOld"];
        // FOR UPDATING DATA

        $smallPic = $_FILES["smallPic"]["name"];
        $largePic = $_FILES["largePic"]["name"];

        $time = date("Y-m-d H:i:s", strtotime("now"));


        if ($smallPic == "" && $largePic == "") {

            $hotelObject->setVariables($_POST, $smallPicOld, $largePicOld);
            $updateDataMsg = $hotelObject->updateHotel($editid);
        } elseif ($smallPic != "" && $largePic != "") {

            $validImg = true;

            //For small image
            if (isset($_FILES["smallPic"])) {
                $fileName = $_FILES["smallPic"]["name"];
                $fileName = date("mdyhis") . '-' . $fileName;
                $smallName = $fileName;
                $tmpName = $_FILES["smallPic"]["tmp_name"];
                $fileext = strtolower(end(explode(".", $fileName)));
                $fileSize = $_FILES["smallPic"]["size"];

                if (in_array($fileext, $validImageExt)) {
                    if ($fileSize <= 2097152) {

                        unlink("../../lib/images/" . $_SESSION["smallPicOld"]);
                        move_uploaded_file($tmpName, "../../lib/images/" . $fileName);
                    } else {
                        echo "file size must be less than 2 mb";
                        $validImg = false;
                    }
                } else {
                    $validImg = false;
                }
            }

            // for large image
            if (isset($_FILES["largePic"])) {
                $fileName = $_FILES["largePic"]["name"];
                $fileName = date("mdyhis") . '-' . $fileName;
                $largeName = $fileName;
                $tmpName = $_FILES["largePic"]["tmp_name"];
                $fileext = strtolower(end(explode(".", $fileName)));
                $fileSize = $_FILES["largePic"]["size"];

                if (in_array($fileext, $validImageExt)) {
                    if (!file_exists(SITE_URL . 'lib/images' . $fileName)) {
                        if ($fileSize <= 2097152) {

                            unlink("../../lib/images/" . $_SESSION["largePicOld"]);
                            move_uploaded_file($tmpName, "../../lib/images/" . $fileName);
                        } else {
                            echo "file size must be less than 2 mb";
                            $validImg = false;
                        }
                    } else {
                        echo "Please Chage filename";
                    }
                } else {
                    $validImg = false;
                }
            }

            if ($validImg) {

                $hotelObject->setVariables($_POST, $smallName, $largeName);
                $updateDataMsg = $hotelObject->updateHotel($editid);
            }
        } elseif ($smallPic != "" && $largePic == "") {

            $validImg = true;

            //For small image
            if (isset($_FILES["smallPic"])) {
                $fileName = $_FILES["smallPic"]["name"];
                $fileName = date("mdyhis") . '-' . $fileName;
                $smallName = $fileName;
                $tmpName = $_FILES["smallPic"]["tmp_name"];
                $fileext = strtolower(end(explode(".", $fileName)));
                $fileSize = $_FILES["smallPic"]["size"];

                if (in_array($fileext, $validImageExt)) {
                    if (!file_exists(SITE_URL . 'lib/images' . $fileName)) {
                        if ($fileSize <= 2097152) {

                            unlink("../../lib/images/" . $_SESSION["smallPicOld"]);
                            move_uploaded_file($tmpName, "../../lib/images/" . $fileName);
                        } else {
                            echo "file size must be less than 2 mb";
                            $validImg = false;
                        }
                    }
                } else {
                    $validImg = false;
                }
            }


            if ($validImg) {

                $hotelObject->setVariables($_POST, $smallName, $largePicOld);
                $updateDataMsg = $hotelObject->updateHotel($editid);
            }
        } elseif ($smallPic == "" && $largePic != "") {
            $validImg = true;

            // for large image
            if (isset($_FILES["largePic"])) {
                $fileName = $_FILES["largePic"]["name"];
                $fileName = date("mdyhis") . '-' . $fileName;
                $largeName = $fileName;
                $tmpName = $_FILES["largePic"]["tmp_name"];
                $fileext = strtolower(end(explode(".", $fileName)));
                $fileSize = $_FILES["largePic"]["size"];

                if (in_array($fileext, $validImageExt)) {
                    if (!file_exists(SITE_URL . 'lib/images' . $fileName)) {
                        if ($fileSize <= 2097152) {

                            unlink("../../lib/images/" . $_SESSION["largePicOld"]);
                            move_uploaded_file($tmpName, "../../lib/images/" . $fileName);
                        } else {
                            echo "filesize must be less than 2 mb";
                            $validImg = false;
                        }
                    } else {
                        echo "Please Change filename";
                    }
                } else {
                    $validImg = false;
                }
            }

            if ($validImg) {
                $hotelObject->setVariables($_POST, $smallPicOld, $largeName);
                $updateDataMsg = $hotelObject->updateHotel($editid);
            }
        }
    }
} else {

    // FOR INSERTING DATA


    // FOR SMALL IMAGE 

    $validImg = true;

    if (isset($_FILES["smallPic"])) {
        $fileName1 = $_FILES["smallPic"]["name"];
        $tmpName1 = $_FILES["smallPic"]["tmp_name"];
        $fileName1 = date("mdyhis") . '-' . $fileName1;
        $smallPic = $fileName1;
        $fileext = strtolower(end(explode(".", $fileName1)));

        $fileSize1 = $_FILES["smallPic"]["size"];

        if (in_array($fileext, $validImageExt)) {
            if ($fileSize1 <= 2097152) {

                move_uploaded_file($tmpName1, "../../lib/images/" . $fileName1);
            } else {
                echo "File size must be less than 2 mb";
                $validImg = false;
            }
        } else {
            $validImg = false;
        }
    }

    // FOR LARGE IMAGE
    if (isset($_FIES["largePic"])) {

        $fileName2 = $_FILES["largePic"]["name"];
        $tmpName2 = $_FILES["largePic"]["tmp_name"];
        $fileName2 = date("mdyhis") . '-' . $fileName2;
        $largePic = $fileName2;
        $fileext = strtolower(end(explode(".", $fileName2)));

        $fileSize2 = $_FILES["smallPic"]["size"];
        if (in_array($fileext, $validImageExt)) {
            if ($fileSize2 <= 2097152) {

                move_uploaded_file($tmpName2, "../../lib/images/" . $fileName2);
            } else {
                echo "File size must be less than 2 mb";
                $validImg = false;
            }
        } else {
            $validImg = false;
        }
    }

    if ($validImg && isset($smallPic) && isset($largePic)) {
        $hotelObject->setVariables($_POST, $smallPic, $largePic);
        $insertData = $hotelObject->insertHotel();
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

    <link rel="stylesheet" href="../../lib/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script>

</head>

<body>
    <?php include './__header.php'; ?>
    <?php include './__sidebar.php'; ?>

    <div class="container">
        <div id="msg">
            <div id="msg-content" class=" alert alert-success alert-dismissible fade show" role="alert">
                <?php if (isset($_GET['editid'])) {
                    echo "Data has been updated";
                } else {
                    echo "Data has been inserted";
                }
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        <div class="mb-4">
            <h1 class="text-center"><?php echo $heading; ?></h1>
        </div>
        <div>
            <form id="hotelForm" action="javascript:void(0)" method="POST" onsubmit="validateHotel(this)">
                <div class="row mb-3">
                    <div class="col-md-3 text-end">
                        <label for="hName" class="form-label">Hotel Name <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" name="hName" id="hName" class="form-control" value="<?php echo $hotelNameOld; ?>">
                        <input type="hidden" name="editid" value="<?php echo $editId; ?>">
                        <div id="hNameErr" class="form-text text-danger"></div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 text-end">
                        <label for="hLocation" class="form-label">Hotel Location <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-md-9">
                        <select name="hLocation" id="hLocation" class="form-select">
                            <option value="" selected>Select Here</option>
                            <?php
                            $locationObj = new Location();
                            $locationData = $locationObj->getLocations('*', ["deleted_date" => "0000-00-00 00:00:00"]);

                            foreach ($locationData as $location) {
                                $str = $location["location_name"] . ' , ' . $location["location_city"] . ' , ' . $location["location_state"];
                                if ($hotelLocationOld == $location["location_id"]) {
                                    $option = "<option value='" . $location["location_id"] . "' selected>$str</option>";
                                } else {
                                    $option = "<option value='" . $location["location_id"] . "'>$str</option>";
                                }
                                echo $option;
                            }
                            ?>
                        </select>
                        <div id="hLocationErr" class="form-text text-danger"></div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 text-end">
                        <label for="shortDesc" class="form-label">Short Description <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" name="shortDesc" id="shortDesc" class="form-control" value="<?php echo $shortDescOld; ?>">
                        <div id="shortDescErr" class="form-text text-danger"></div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 text-end">
                        <label for="longDesc" class="form-label">Long Description <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-md-9">
                        <textarea name="longDesc" id="longDesc" class="form-control" cols="30" rows="5"><?php echo $longDescOld; ?></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 text-end">
                        <label for="rating" class="form-label">Rating <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-md-9">
                        <select name="rating" id="rating" class="form-select">
                            <option value="" selected>Select Here</option>

                            <option value="1" <?php if ($ratingOld == "1") {
                                                    echo "selected";
                                                } ?>>0-1</option>
                            <option value="1.5" <?php if ($ratingOld == "1.5") {
                                                    echo "selected";
                                                } ?>>1-2</option>
                            <option value="2" <?php if ($ratingOld == "2") {
                                                    echo "selected";
                                                } ?>>2</option>
                            <option value="2.5" <?php if ($ratingOld == "2.5") {
                                                    echo "selected";
                                                } ?>>2-3</option>
                            <option value="3" <?php if ($ratingOld == "3") {
                                                    echo "selected";
                                                } ?>>3</option>
                            <option value="3.5" <?php if ($ratingOld == "3.5") {
                                                    echo "selected";
                                                } ?>>3-4</option>
                            <option value="4" <?php if ($ratingOld == "4") {
                                                    echo "selected";
                                                } ?>>4</option>
                            <option value="4.5" <?php if ($ratingOld == "4.5") {
                                                    echo "selected";
                                                } ?>>4-5</option>
                            <option value="5" <?php if ($ratingOld == "5") {
                                                    echo "selected";
                                                } ?>>5</option>
                        </select>
                        <div id="ratingErr" class="form-text text-danger"></div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 text-end">
                        <label for="rooms" class="form-label">Number of Rooms <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-md-9">
                        <input type="number" name="rooms" id="rooms" class="form-control" value="<?php echo $roomsOld; ?>">
                        <div id="roomsErr" class="form-text text-danger"></div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 text-end">
                        <label for="roomType" class="form-label">Type of Rooms <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-md-9">
                        <select name="roomType" id="roomType" class="form-select">
                            <option value="" selected>Select Here</option>
                            <option value="single" <?php if ($roomTypeOld == "single") {
                                                        echo "selected";
                                                    } ?>>Single</option>
                            <option value="double" <?php if ($roomTypeOld == "double") {
                                                        echo "selected";
                                                    } ?>>Double</option>
                            <option value="triple" <?php if ($roomTypeOld == "triple") {
                                                        echo "selected";
                                                    } ?>>Triple</option>
                            <option value="quad" <?php if ($roomTypeOld == "quad") {
                                                        echo "selected";
                                                    } ?>>Quad</option>
                        </select>
                        <div id="roomTypeErr" class="form-text text-danger"></div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 text-end">
                        <label for="registerDate" class="form-label">Hotel Register Date <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-md-9">
                        <input type="date" name="registerDate" id="registerDate" class="form-control" value="<?php echo $registerDateOld; ?>" min="<?php if (!isset($_GET["editid"])) {
                                                                                                                                                        echo date("Y-m-d");
                                                                                                                                                    } ?>" max="<?php echo date("Y-m-d"); ?>">


                        <div id=" registerDateErr" class="form-text text-danger">
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 text-end">
                        <label for="smallPic" class="form-label">Small Picture of Hotel <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-md-9">
                        <input type="file" name="smallPic" id="smallPic" class="form-control" accept="image/*">
                        <div id="smallPicErr" class="form-text text-danger"></div>
                        <div>
                            <?php
                            if (isset($_GET["editid"])) {
                            ?>
                                <img id="smallImagePreview" src="../../lib/images/<?php echo $_SESSION["smallPicOld"]; ?>" alt="Select Image" height="100" width="150">
                            <?php
                            } else {
                            ?>
                                <img id="smallImagePreview" src="" alt="Select Image" height="100" width="150">
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 text-end">
                        <label for="largePic" class="form-label">Large Picture of Hotel <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-md-9">

                        <input type="file" name="largePic" id="largePic" class="form-control" accept="image/*">
                        <div id="largePicErr" class=" form-text text-danger"></div>
                        <div>
                            <?php
                            if (isset($_GET["editid"])) {
                            ?>
                                <img id="largeImagePreview" src="../../lib/images/<?php echo $_SESSION["largePicOld"]; ?>" alt="Select Image" height="100" width="150">
                            <?php
                            } else {
                            ?>
                                <img id="largeImagePreview" src="" alt="Select Image" height="100" width="150">
                            <?php
                            }
                            ?>

                        </div>


                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 text-end">
                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-md-9">
                        <input type="radio" name="status" id="active" class="form-check-input" value="1" <?php if ($statusOld == "1") {
                                                                                                                echo "checked";
                                                                                                            } ?>>
                        <label for="active" class="form-check-label">Active</label>
                        <input type="radio" name="status" id="inactive" class="form-check-input" value="2" <?php if ($statusOld == "2") {
                                                                                                                echo "checked";
                                                                                                            } ?>>
                        <label for="inactive" class="form-check-label">Inactive</label>
                        <div id="statusErr" class="form-text text-danger"></div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3"></div>
                    <div class="col-md-9">
                        <?php
                        if (isset($_GET["editid"])) {
                        ?>

                            <input type="submit" value="Update" id="submit" name="submit" class="btn btn-primary">
                        <?php
                        } else {
                        ?>
                            <input type="submit" value="Add" id="submit" name="submit" class="btn btn-primary">

                        <?php
                        }
                        ?>
                        <a href="./manage_hotel.php" class="btn btn-danger">Back</a>
                    </div>
                </div>
            </form>

        </div>
    </div>
    </div>

    <?php include './__footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>


    <script>
        //CKEDITOR FOR TEXTAREA
        // ClassicEditor
        //     .create(document.getElementById("longDesc"))
        //     .catch(error => {
        //         console.error(error);
        //     })

        $('#msg').hide();

        <?php
        if (!isset($_GET["editid"])) {
        ?>
            if ($('#smallPic').val() == '') {
                $('#smallImagePreview').hide();
            } else {
                $('#smallImagePreview').show();
            }
            if ($('#largePic').val() == '') {
                $('#largeImagePreview').hide();
            } else {
                $('#largeImagePreview').show();
            }
        <?php
        }
        ?>


        $('#smallPic').change(function() {
            $('#smallImagePreview').show();
            const file = this.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(event) {
                    $('#smallImagePreview').attr('src', event.target.result);
                }
                reader.readAsDataURL(file);
            }
        })
        $('#largePic').change(function() {
            $('#largeImagePreview').show();
            const file = this.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(event) {
                    $('#largeImagePreview').attr('src', event.target.result);
                }
                reader.readAsDataURL(file);
            }
        })


        function validateHotel(formData) {
            var isValid = true;
            with(formData) {
                if (hName.value == null || hName.value.trim() == "") {
                    $('#hNameErr').html("Name can not be empty");
                    isValid = false;
                } else {
                    $('#hNameErr').html("");
                }

                if (hLocation.value == null || hLocation.value.trim() == "") {
                    $('#hLocationErr').html("Please Select location");
                    isValid = false;
                } else {
                    $('#hLocationErr').html("");
                }

                if (shortDesc.value == null || shortDesc.value.trim() == "") {
                    $('#shortDescErr').html("Short description can not be empty");
                    isValid = false;
                } else {
                    $('#shortDescErr').html("");
                }

                if (longDesc.value == null || longDesc.value.trim() == "") {
                    $('#longDescErr').html("Please Select location");
                    isValid = false;
                } else {
                    $('#longDescErr').html("");
                }

                if (rating.value == null || rating.value == "") {
                    $('#ratingErr').html("Please Select rating");
                    isValid = false;
                } else {
                    $('#ratingErr').html("");
                }

                if (rooms.value == null || rooms.value.trim() == "") {
                    $('#roomsErr').html("Please Enter number of rooms");
                    isValid = false;
                } else {
                    $('#roomsErr').html("");
                }

                if (roomType.value == null || roomType.value == "") {
                    $('#roomTypeErr').html("Please Select room type");
                    isValid = false;
                } else {
                    $('#roomTypeErr').html("");
                }

                if (registerDate.value == null || registerDate.value == "") {
                    $('#registerDateErr').html("Please Enter Hotel Register Date");
                    isValid = false;
                } else {
                    $('#registerDateErr').html("");
                }

                let status = $('input[name=status]:checked', '#hotelForm').val();
                if (status == undefined) {
                    $('#statusErr').html("Please Select hotel's status");
                    isValid = false;
                } else {
                    $('#statusErr').html("");
                }


                let smallPic = $('#smallPic').val();
                let largePic = $('#largePic').val();

                let smallPicExtension = smallPic.split('.').pop().toLowerCase();
                let largePicExtension = largePic.split('.').pop().toLowerCase();

                var validFileExtensions = ["jpg", "jpeg", "png"];
                <?php
                if (isset($_GET["editid"])) {
                ?>
                    //VALIDATION FOR SMALL IMAGE IF IT IS UPLODED
                    if (smallPic != "") {

                        if (smallPic != "" && !validFileExtensions.includes(smallPicExtension)) {
                            $('#smallPicErr').html("Only .jpg, .jpeg, .png files are allowed");
                            isValid = false;
                        } else if ($('#smallPic')[0].files[0].size > 2097152) {
                            $('#smallPicErr').html("Image size must be less than 2 mb");
                            isValid = false;
                        } else {
                            $('#smallPicErr').html("");
                        }
                    }
                    //VALIDATION FOR LARGE IMAGE IF IT IS UPLODED
                    if (largePic != "") {

                        if (largePic != "" && !validFileExtensions.includes(largePicExtension)) {
                            $('#largePicErr').html("Only .jpg, .jpeg, .png files are allowed");
                            isValid = false;
                        } else if ($('#largePic')[0].files[0].size > 2097152) {
                            $('#largePicErr').html("Image size must be less than 2 mb");
                            isValid = false;
                        } else {
                            $('#largePicErr').html("");
                        }
                    }
                <?php
                } else {
                ?>
                    //FILE VALIDATION FOR INSERT
                    if (!validFileExtensions.includes(smallPicExtension)) {
                        $('#smallPicErr').html("Only .jpg, .jpeg, .png files are allowed");
                        isValid = false;
                    } else if ($('#smallPic')[0].files[0].size > 2097152) {
                        $('#smallPicErr').html("Image size must be less than 2 mb");
                        isValid = false;
                    } else {
                        $('#smallPicErr').html("");
                    }


                    if (!validFileExtensions.includes(largePicExtension)) {
                        $('#largePicErr').html("Only .jpg, .jpeg, .png files are allowed");
                        isValid = false;
                    } else if ($('#largePic')[0].files[0].size > 2097152) {
                        $('#largePicErr').html("Image size must be less than 2 mb");
                        isValid = false;
                    } else {
                        $('#largePicErr').html("");
                    }

                <?php
                }
                ?>


            }

            if (isValid) {
                let form = document.getElementById('hotelForm');
                var formData = new FormData(form);
                $.ajax({
                    method: 'POST',
                    url: SITE_URL + 'view/admin/insert_hotel.php',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function() {
                        $('#msg').show();
                        window.scrollTo(0, 0);
                    }

                })
            }
        }
    </script>
</body>

</html>