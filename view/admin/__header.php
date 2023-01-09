<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="./home.php"><span class="fab fa-houzz fs-2"> </span> Hotel Management System</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="ms-auto">
                <?php if (isset($_SESSION["loggedin"])) { ?>

                    <a class="btn btn-outline-light mx-1" href="../index.php">View Site</a>
                    <a id="logoutBtn" class="btn btn-outline-danger mx-1">Logout</a>
                <?php } ?>
            </div>
        </div>
    </div>
</nav>

<script src="../../lib/js/bootbox.js"></script>

<script>
    let lgtBtn = document.getElementById('logoutBtn');

    lgtBtn.addEventListener("click", function() {
        bootbox.confirm({
            title: 'Confirm logout?',
            message: 'Are you sure you want to Logout?',
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
                    window.location = "./_logout.php";
                }
            }
        });
    })
</script>