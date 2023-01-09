<?php
require_once '../model/_constant.php';
?>
<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>

<nav class="navbar navbar-expand-lg bg-dark navbar-dark sticky-top shadow">
    <div class="container-fluid">
        <a class="navbar-brand" href="./index.php">HotelScope</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="./index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="./hotel_list.php">Hotel List</a>
                </li>


            </ul>
            <?php if ($_SERVER['REQUEST_URI'] == "/view/hotel_list.php") {

            ?>
                <form id="searchForm" class="d-flex gap-1" role="search" action="./search_hotel.php" method="post">
                    <select name="searchBy" id="searchBy" class="form-select">
                        <option value="">Search by</option>
                        <option value="title">Hotel Name</option>
                        <option value="rating">Rating</option>
                        <option value="roomType">Room Type</option>
                        <option value="location">Location</option>
                    </select>
                    <select name="rating" id="rating" class="form-select">
                        <option value="">Select Rating</option>
                        <option value="0.5">0-1</option>
                        <option value="1">1</option>
                        <option value="1.5">1-2</option>
                        <option value="2">2</option>
                        <option value="2.5">2-3</option>
                        <option value="3">3</option>
                        <option value="3.5">3-4</option>
                        <option value="4">4</option>
                        <option value="4.5">4-5</option>
                        <option value="5">5</option>
                    </select>
                    <select name="roomType" id="roomType" class="form-select">
                        <option value="">Select Room Type</option>
                        <option value="single">Single</option>
                        <option value="double">Double</option>
                        <option value="triple">Triple</option>
                        <option value="quad">Quad</option>
                    </select>
                    <input class="form-control me-2" id="searchBar" name="searchBar" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" name="submit" type="submit">Search</button>
                </form>
                <button class=" ms-1 btn btn-outline-danger" id="resetBtn">Reset</button>
            <?php } ?>
        </div>
    </div>
</nav>

<script>
    $(document).ready(function() {
        $('#resetBtn').on("click", function() {
            $('#rating').val("");
            $('#roomType').val("");
            $('#searchBar').val("");

            $.ajax({
                method: 'POST',
                url: SITE_URL + 'view/search_hotel.php',
                data: 'searchby=',
                success: function(data) {
                    $('#search-result').html("");
                    $('#search-result').append(data);
                }
            })
        })
    })
</script>