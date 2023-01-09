<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hotel Scope | A Hotel Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../lib/css/style.css">
    <style>
        #hrdiv {
            background-color: gainsboro;
            width: 2px;
            height: 100%;
        }
    </style>
</head>

<body>
    <?php include './__header.php'; ?>

    <div class="container py-3">
        <div>
            <p class="h2 text-center"><u>Hotel List</u></p>
        </div>
        <div id="search-result"></div>

    </div>


    <?php include './__footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>


    <script>
        $(document).ready(function() {

            $.ajax({
                method: 'POST',
                url: SITE_URL+'view/search_hotel.php',
                data: 'searchby=',
                success: function(data) {
                    $('#search-result').html("");
                    $('#search-result').append(data);
                }
            })


            $('#searchBar').hide();
            $('#roomType').hide();
            $('#rating').hide();
            $('#searchBy').change(function() {
                // console.log("Changed");
                if ($('#searchBy').val() == "title" || $('#searchBy').val() == "location") {
                    // console.log("yes");
                    $('#searchBar').show();
                    $('#roomType').hide();
                    $('#rating').hide();

                } else if ($('#searchBy').val() == "rating") {
                    $('#rating').show();
                    $('#searchBar').hide();
                    $('#roomType').hide();
                } else if ($('#searchBy').val() == "roomType") {
                    $('#rating').hide();
                    $('#searchBar').hide();
                    $('#roomType').show();
                } else {
                    $('#searchBar').hide();
                    $('#roomType').hide();
                    $('#rating').hide();
                }

                $('#searchForm').on("submit", function(e) {
                    e.preventDefault();
                    $.ajax({
                        type: 'POST',
                        url: SITE_URL+'view/search_hotel.php',
                        data: $('#searchForm').serialize(),
                        success: function(data) {
                            $('#search-result').html("");
                            $('#search-result').append(data);
                        }
                    })
                })
            })

        })
    </script>

</body>

</html>