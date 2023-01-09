$(document).ready(function () {
    $("#oldPassErr").hide();
    $("#newPassErr").hide();
    $("#conPassErr").hide();
    $("#conNewPassErr").hide("");
    $("#lowerCaseErr").hide("");
    $("#upperCaseErr").hide("");
    $("#numberErr").hide("");
    $("#lengthErr").hide("");
});

//ONCHANGE VALIDATION OF NEW PASSWORD
$("#newPassword").keyup(function () {
    let newPassValid = true;

    let newPassword = $("#newPassword").val();

    //VALIDATION OF AT LEAST ONE LOWERCASE
    let lowerCaseLetters = /[a-z]/g;
    if (newPassword.match(lowerCaseLetters)) {
        $("#lowerCaseErr").hide();
    } else {
        $("#lowerCaseErr").show();
        newPassValid = false;
    }

    //VALIDATION OF AT LEAST ONE UPPERCASE
    let upperCaseLetters = /[A-Z]/g;
    if (newPassword.match(upperCaseLetters)) {
        $("#upperCaseErr").hide();
    } else {
        $("#upperCaseErr").show();
        newPassValid = false;
    }

    //VALIDATION OF AT LEAST ONE UPPERCASE
    let numbers = /[0-9]/g;
    if (newPassword.match(numbers)) {
        $("#numberErr").hide();
    } else {
        $("#numberErr").show();
        newPassValid = false;
    }

    //VALIDATION OF LENGTH
    if (newPassword.length >= 8) {
        $("#lengthErr").hide();
    } else {
        $("#lengthErr").show();
        newPassValid = false;
    }

    if (newPassValid == true) {
        $("#newPassword").addClass("is-valid");
        $("#newPassword").removeClass("is-invalid");
    } else {
        $("#newPassword").addClass("is-invalid");
        $("#newPassword").removeClass("is-valid");
    }
});

function validate(passwordForm) {
    let isValid = true;
    with (passwordForm) {
        if (oldPassword.value == null || oldPassword.value.trim() == "") {
            $("#oldPassErr").show();
            isValid = false;
        } else {
            $("#oldPassErr").hide();
        }
        if (newPassword.value == null || newPassword.value.trim() == "") {
            $("#newPassErr").show();
            isValid = false;
        } else {
            $("#newPassErr").hide();
        }
        if (
            confirmPassword.value == null ||
            confirmPassword.value.trim() == ""
        ) {
            $("#conPassErr").show();
            isValid = false;
        } else {
            $("#conPassErr").hide();
        }
        //VALIDATION OF AT LEAST ONE LOWERCASE
        let lowerCaseLetters = /[a-z]/g;
        if (newPassword.value.match(lowerCaseLetters)) {
            $("#lowerCaseErr").hide();
        } else {
            $("#lowerCaseErr").show();
            isValid = false;
        }

        //VALIDATION OF AT LEAST ONE UPPERCASE
        let upperCaseLetters = /[A-Z]/g;
        if (newPassword.value.match(upperCaseLetters)) {
            $("#upperCaseErr").hide();
        } else {
            $("#upperCaseErr").show();
            isValid = false;
        }

        //VALIDATION OF AT LEAST ONE UPPERCASE
        let numbers = /[0-9]/g;
        if (newPassword.value.match(numbers)) {
            $("#numberErr").hide();
        } else {
            $("#numberErr").show();
            isValid = false;
        }

        //VALIDATION OF LENGTH
        if (newPassword.value.length >= 8) {
            $("#lengthErr").hide();
        } else {
            $("#lengthErr").show();
            isValid = false;
        }
    }

    if (isValid) {
        let form = document.getElementById("changePassForm");
        let formData = new FormData(form);
        $.ajax({
            method: "POST",
            url: SITE_URL + "view/admin/_handle_reset_password.php",
            data: formData,
            contentType: false,
            processData: false,
            success: function (result) {
                $("#errMsg").hide();
                if (result == "Your password has been change") {
                    $("#submit").addClass("disabled");
                    $("#changePassForm").trigger("reset");
                }
                let myAlert = document.querySelector(".toast");
                let bsAlert = new bootstrap.Toast(myAlert);
                $(".toast-body").html(result);
                bsAlert.show();
            },
        });
    }
}
