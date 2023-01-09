// For edit Location
editbtns = document.getElementsByClassName('editbtn');
Array.from(editbtns).forEach((element) => {
    element.addEventListener("click", (e) => {
        editid = e.target.id.substr(1, );
        console.log(editid);

        window.location = `/view/admin/insert_hotel.php?editid=${editid}`;
    })
})

// For delete location
delbtns = document.getElementsByClassName('delbtn');
Array.from(delbtns).forEach((element) => {
    element.addEventListener("click", (e) => {
        delid = e.target.id.substr(1, );

        bootbox.confirm({
            title: 'Delete Hotel?',
            message: 'Do you really want to delete these hotel? This process cannot be undone.',
            buttons: {
                confirm: {
                    label: 'Yes',
                    className: 'btn-success'
                },
                cancel: {
                    label: 'No',
                    className: 'btn-danger'
                }
            },
            callback: function(result) {
                if (result == true) {
                    window.location = `/view/admin/manage_hotel.php?delid=${delid}`;
                }
            }
        });
    })
})

$('.statusSwitch').change(function() {
    let thisId = this.id;
    let hid = this.id.substr(12, );
    let status;
    if ($(this).prop("checked") == true) {
        status = 1;
    } else {
        status = 2;
    }

    var statusData = {
        "status": status,
        "hid": hid
    };
    if (confirm("Are you sure you want to change hotel status?")) {

        $.ajax({
            type: 'POST',
            url: SITE_URL + 'view/admin/manage_hotel.php',
            data: statusData,
            success: function() {

            }
        })
    } else {
        if (status == 1) {
            $(this).prop("checked", false);
        } else {
            $(this).prop("checked", true);
        }
    }
})


$(document).ready(function() {
    $('#hotelTable').DataTable();
});