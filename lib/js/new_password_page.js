//HIDING ALL ERROR MESSAGES
$("#successMsg").hide();
$("#errMsg").hide();
$("#newPassErr").hide("");
$("#conNewPassErr").hide("");
$("#lowerCaseErr").hide("");
$("#upperCaseErr").hide("");
$("#numberErr").hide("");
$("#lengthErr").hide("");

$("#newPass").keyup(function () {
    let newPassValid = true;

    let newPass = $("#newPass").val();

    //VALIDATION OF AT LEAST ONE LOWERCASE
    let lowerCaseLetters = /[a-z]/g;
    if (newPass.match(lowerCaseLetters)) {
        $("#lowerCaseErr").hide();
    } else {
        $("#lowerCaseErr").show();
        newPassValid = false;
    }

    //VALIDATION OF AT LEAST ONE UPPERCASE
    let upperCaseLetters = /[A-Z]/g;
    if (newPass.match(upperCaseLetters)) {
        $("#upperCaseErr").hide();
    } else {
        $("#upperCaseErr").show();
        newPassValid = false;
    }

    //VALIDATION OF AT LEAST ONE UPPERCASE
    let numbers = /[0-9]/g;
    if (newPass.match(numbers)) {
        $("#numberErr").hide();
    } else {
        $("#numberErr").show();
        newPassValid = false;
    }

    //VALIDATION OF LENGTH
    if (newPass.length >= 8) {
        $("#lengthErr").hide();
    } else {
        $("#lengthErr").show();
        newPassValid = false;
    }

    if (newPassValid == true) {
        $("#newPass").addClass("is-valid");
        $("#newPass").removeClass("is-invalid");
    } else {
        $("#newPass").addClass("is-invalid");
        $("#newPass").removeClass("is-valid");
    }
});

function validate(formData) {
    with (formData) {
        isValid = true;
        if (newPass.value == null || newPass.value.trim() == "") {
            $("#newPassErr").show("");
            isValid = false;
        } else {
            $("#newPassErr").hide("");
        }

        if (conNewPass.value == null || conNewPass.value.trim() == "") {
            $("#conNewPassErr").show("");
            isValid = false;
        } else {
            $("#conNewPassErr").hide("");
        }

        //VALIDATION OF AT LEAST ONE LOWERCASE
        let lowerCaseLetters = /[a-z]/g;
        if (newPass.value.match(lowerCaseLetters)) {
            $("#lowerCaseErr").hide();
        } else {
            $("#lowerCaseErr").show();
            isValid = false;
        }

        //VALIDATION OF AT LEAST ONE UPPERCASE
        let upperCaseLetters = /[A-Z]/g;
        if (newPass.value.match(upperCaseLetters)) {
            $("#upperCaseErr").hide();
        } else {
            $("#upperCaseErr").show();
            isValid = false;
        }

        //VALIDATION OF AT LEAST ONE UPPERCASE
        let numbers = /[0-9]/g;
        if (newPass.value.match(numbers)) {
            $("#numberErr").hide();
        } else {
            $("#numberErr").show();
            isValid = false;
        }

        //VALIDATION OF LENGTH
        if (newPass.value.length >= 8) {
            $("#lengthErr").hide();
        } else {
            $("#lengthErr").show();
            isValid = false;
        }

        if (isValid) {
            let newPassForm = document.getElementById("newPassForm");
            formData = new FormData(newPassForm);
            $.ajax({
                method: "POST",
                url: SITE_URL + "view/admin/_handle_newpass.php",
                data: formData,
                contentType: false,
                processData: false,
                success: function (result) {
                    $("#errMsg").hide();
                    if (result == "Your password has been change") {
                        $("#successMsg").show();
                        $("#submit").addClass("disabled");
                        $("#newPassForm").trigger("reset");
                    } else {
                        let myAlert = document.querySelector(".toast");
                        let bsAlert = new bootstrap.Toast(myAlert);
                        $(".toast-body").html(result);
                        bsAlert.show();
                    }
                },
            });
        }
    }
}
