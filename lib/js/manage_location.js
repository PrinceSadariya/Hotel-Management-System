//FOR DATATABLES WITH AJAX
$(document).ready(function() {
    var t = $('#locationTable').DataTable({
        "ajax": {
            url: SITE_URL + 'api/read.php?token=aaaaabbbbb',
            dataSrc: "data"
        },
        "columns": [{
                data: null,
                searchable: false,
                orderable: false
            },
            {
                data: "location_name"
            },
            {
                data: "location_city"
            },
            {
                data: "location_state"
            },
            {
                data: null,
                render: function(data) {
                    return '<span id="e' + data.location_id + '" class="fas fa-pen editbtn text-primary me-3 cursor-pointer"></span><span id="d' + data.location_id + '" class="delbtn fas fa-trash text-danger ms-3 cursor-pointer"></span>';
                }
            }
        ]
    });

    t.on('order.dt search.dt', function() {
        t.column(0, {
            search: 'applied',
            order: 'applied'
        }).nodes().each(function(cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();

    $('#locationTable tbody').on("click", "span", function() {
        // console.log(this);
        let dataId = this.id.substr(1, );
        let action = this.id.substr(0, 1);

        if (action == 'e') {
            window.location = `/view/admin/insert_location.php?editid=${dataId}`;
        } else if (action == 'd') {
            bootbox.confirm({
                title: 'Delete Location?',
                message: 'Do you really want to delete these location? This process cannot be undone.',
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
                        window.location = `/view/admin/manage_location.php?delid=${dataId}`;
                    }
                }
            });
        }
    })

});