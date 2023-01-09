
// FOR LOCATION FORM
$("#msgInsert").hide();
$("#msgUpdate").hide();

function validateLocation(formData) {
    with (formData) {
        isValid = true;
        if (locationName.value == null || locationName.value.trim() == "") {
            $("#locationNameErr").html("Location Name can not be empty");
            isValid = false;
        } else {
            $("#locationNameErr").html("");
        }
        if (locationCity.value == null || locationCity.value.trim() == "") {
            $("#locationCityErr").html("City can not be empty");
            isValid = false;
        } else {
            $("#locationCityErr").html("");
        }
        if (locationState.value == null || locationState.value.trim() == "") {
            $("#locationStateErr").html("State can not be empty");
            isValid = false;
        } else {
            $("#locationStateErr").html("");
        }
    }

    if (isValid) {
        $.ajax({
            method: "POST",
            url: SITE_URL + "view/admin/insert_location.php",
            data: $("#locationForm").serialize(),
            success: function () {
                if ($("#editId").val() == "") {
                    $("#msgInsert").show();
                } else {
                    $("#msgUpdate").show();
                }
                window.scrollTo(0, 0);
            },
        });
    }
}
