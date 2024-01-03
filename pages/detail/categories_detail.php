<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/img/zalo suopprt/cellphones.png">
    <link rel="stylesheet" href="../assets/font/themify-icons-font/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="../assets/font/fontawesome-free-5.15.4/fontawesome-free-5.15.4-web/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../../css/find.css">
    <link rel="stylesheet" href="../../css/toast.css">
    <link rel="stylesheet" href="../../css/home.css">  
    <title>Nhom 13 - Categories</title>
</head>
<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    $_SESSION["error_message"] = "Thông tin đăng nhập bị sai. Vui lòng kiểm tra lại!";
    header("Location: ../dashboard/login.php");
    exit();
}
include '../connect.php'; // Đảm bảo đường dẫn đến file connect.php là chính xác
$username = $_SESSION['TenDangNhap1'];
// Thực hiện truy vấn để lấy ID của người dùng dựa trên tên đăng nhập
$sql = "SELECT mid FROM member WHERE username = '$username'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    // Lấy kết quả và hiển thị ID của người dùng
    $row = mysqli_fetch_assoc($result);
    $userID = $row['mid'];
    echo "ID của người dùng đăng nhập là: " . $userID;
} else {
    echo "Không tìm thấy người dùng.";
}
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">



<body>
    <div id="main">
        <!-- Header -->
        <div class="header__height"></div>
            <div class="header__background">
                <div class="header grid wide">
                    <div class="row">
                        <!-- Logo Icon -->
                        <div class="header__logo__wrapper">
                            <div class="header__logo">
                            </div>
                            <span class="header__logo__line__1st"></span>
                            <span class="header__logo__line__2nd"></span>
                            <span class="header__logo__line__3rd"></span>
                        </div>
                        <!-- Logo Image -->
                        <div class="header__logo__img">
                            <a href="../../pages/dashboard/home.php"><img src="../assets/logo/logo.png" alt=""></a>
                        </div>
                        <!-- Search bar -->
                        <div class="header__search__bar">
                            <div class="header__search__bar__icon">
                                <i class="fas fa-search"></i>
                            </div>
                            <div class="header__search__bar__input">
                                <input type="text" id="search-box" placeholder="Bạn cần tìm gì?">
                                <div id="suggestion-box"></div>
                            </div>
                        </div>
                        <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
                        <script>
                            $(document).ready(function() {
                                // Lắng nghe sự kiện khi người dùng gõ vào #search-box
                                $("#search-box").keyup(function() {
                                    // Thực hiện AJAX để tìm kiếm và hiển thị kết quả trong #suggestion-box
                                    $.ajax({
                                        type: "GET",
                                        url: "../../action/readProduct.php",
                                        data: 'keyword=' + $(this).val(),
                                        beforeSend: function() {
                                            $("#search-box").css("background", "#FFF url(../assets/icon/loadicon.png) no-repeat 165px");
                                        },
                                        success: function(data) {
                                            $("#suggestion-box").show();
                                            $("#suggestion-box").html(data);
                                            $("#search-box").css("background", "#FFF");
                                        }
                                    });
                                });
                                // Lắng nghe sự kiện click trên toàn bộ document
                                $(document).click(function(event) {
                                    // Kiểm tra xem sự kiện click có xảy ra trên #search-box hay không
                                    if (!$(event.target).closest('#search-box').length) {
                                        // Nếu không phải là #search-box hoặc bất kỳ phần tử con của nó
                                        $("#suggestion-box").hide();
                                    }
                                });
                                // Hàm để chọn một mục từ #suggestion-box
                                function selectCountry(val) {
                                    $("#search-box").val(val);
                                    $("#suggestion-box").hide();
                                }
                            });
                        </script>
                        <div class="header__search__bar__modal" style="display: none;"></div>
                        <script>
                            var search__input = document.querySelector('.header__search__bar__input input');
                            var search__modal = document.querySelector('.header__search__bar__modal');
                            var list_cate = document.querySelector('.list_cate');
                            search__input.addEventListener('click', function(event) {
                                search__modal.style.display = 'block';
                                event.stopPropagation();
                            });

                            search__modal.addEventListener('click', function() {
                                search__modal.style.display = 'none';
                            });
                        </script>
                        <!-- Navbar list -->
                        <div class="header__navbar">
                            <ul class="header__navbar__list">
                                <li class="header__navbar__item">
                                    <div class="header__navbar__item__wrapper">
                                        <a href="../dashboard/history.php" class="header__navbar__item__link">
                                            <i class="fas fa-shipping-fast"></i>
                                            <div class="header__navbar__item__link__desc__wrapper">
                                                <p>Lịch sử</p>
                                                <p>đơn hàng</p>
                                            </div>
                                        </a>
                                    </div>
                                </li>
                                <li class="header__navbar__item">
                                    <div class="header__navbar__item__wrapper">
                                        <a href="../dashboard/cart.php" class="header__navbar__item__link">
                                            <i class="ti-bag"></i>
                                            <div class="header__navbar__item__link__desc__wrapper">
                                                <p>Giỏ</p>
                                                <p>hàng</p>
                                            </div>
                                        </a>
                                    </div>
                                </li>
                                <li class="header__navbar__item">
                                    <div class="header__navbar__item__wrapper">
                                        <div class="header__navbar__item__link" onclick="toggleDropdown()">
                                            <div class="header__navbar__item__link__icon__wrapper__last">
                                                <i class="far fa-user-circle"></i>
                                            </div>
                                            <div class="header__navbar__item__link__desc__wrapper_last">
                                                <p id="username">
                                                    <?php
                                                    if (isset($_SESSION['TenDangNhap1'])) {
                                                        echo $_SESSION['TenDangNhap1']; // Hiển thị tên người dùng từ session
                                                    }
                                                    ?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="dropdown" id="dropdown-smem">
                                            <div class="dropdown-content">
                                                <a href="../member/member.php"><i class="fa-regular fa-user"></i>Trang cá nhân</a>
                                                <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i>Đăng xuất</a>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <style>
                                    .dropdown-content {
                                    display: none;
                                    position: absolute;
                                    background-color: #fff;
                                    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.5);
                                    width: 100px;
                                    border-radius: 10px;
                                    z-index: 1;
                                    color: #000; /* Màu chữ đen */
                                    font-weight: bold; /* In đậm */
                                }
                                .dropdown-content i{
                                    font-weight: bold;
                                    margin: 0 3px 0 5px;
                                }
                                /* Hiển thị dropdown khi có class 'show' */
                                .dropdown-content.show {
                                    display: block;
                                    border-radius: 10px;
                                    width: 180px;
                                }
                                .dropdown-content a {
                                    display: block;
                                    width: 100%;
                                    white-space: normal;
                                    text-align: left;
                                    padding: 8px 16px;
                                    text-decoration: none;
                                    color: #000; /* Màu chữ đen */
                                    font-weight: bold; /* In đậm */
                                    transition: background-color 0.3s ease; /* Hiệu ứng hover */
                                    border-radius: 10px;
                                }

                                .dropdown-content a:hover {
                                    background-color: #ff7e7e; 
                                    cursor: pointer;
                                }
                                </style>

                                <script>
                                    function toggleDropdown() {
                                        var dropdown = document.querySelector("#dropdown-smem .dropdown-content");
                                        dropdown.classList.toggle("show");
                                    }
                                    // Đóng dropdown nếu click ra ngoài dropdown
                                    window.onclick = function(event) {
                                        if (!event.target.closest('.header__navbar__item__wrapper')) {
                                            var dropdowns = document.querySelectorAll(".dropdown-content");
                                            dropdowns.forEach(function(dropdown) {
                                                if (dropdown.classList.contains('show')) {
                                                    dropdown.classList.remove('show');
                                                }
                                            });
                                        }
                                    }
                                </script>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flash__sale grid wide">
            <div class="row">
                <div class="c-6">
                    <div class="flash__hot__sale">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="272.222" height="38.337" viewBox="0 0 272.222 38.337">
                            <defs>
                                <filter id="Path_1419" x="27.652" y="8.388" width="111.756" height="22.383" filterUnits="userSpaceOnUse">
                                    <feOffset dy="1" input="SourceAlpha"></feOffset>
                                    <feGaussianBlur stdDeviation="0.5" result="blur"></feGaussianBlur>
                                    <feFlood flood-opacity="0.502"></feFlood>
                                    <feComposite operator="in" in2="blur"></feComposite>
                                    <feComposite in="SourceGraphic"></feComposite>
                                </filter>
                                <filter id="Path_1420" x="140.854" y="1.116" width="131.369" height="29.655" filterUnits="userSpaceOnUse">
                                    <feOffset dy="1" input="SourceAlpha"></feOffset>
                                    <feGaussianBlur stdDeviation="0.5" result="blur-2"></feGaussianBlur>
                                    <feFlood flood-opacity="0.502"></feFlood>
                                    <feComposite operator="in" in2="blur-2"></feComposite>
                                    <feComposite in="SourceGraphic"></feComposite>
                                </filter>
                                <filter id="power" x="0" y="0" width="27.109" height="38.337" filterUnits="userSpaceOnUse">
                                    <feOffset dy="2" input="SourceAlpha"></feOffset>
                                    <feGaussianBlur stdDeviation="0.5" result="blur-3"></feGaussianBlur>
                                    <feFlood flood-opacity="0.502"></feFlood>
                                    <feComposite operator="in" in2="blur-3"></feComposite>
                                    <feComposite in="SourceGraphic"></feComposite>
                                </filter>
                            </defs>
                            <g id="Group_184" data-name="Group 184" transform="translate(-98.699 -620)">
                                <g id="Group_364" data-name="Group 364" transform="translate(-107 6)">
                                    <g id="Group_185" data-name="Group 185" transform="translate(134 10)">
                                        <g transform="matrix(1, 0, 0, 1, 71.7, 604)" filter="url(#Path_1419)">
                                            <path id="Path_1419-2" data-name="Path 1419" d="M-38.372,0h-4.309l1.514-7.583H-47.3L-48.814,0h-4.335l3.765-18.84h4.335l-1.579,7.893h6.133l1.579-7.893h4.309Zm18.917-7.725a10.532,10.532,0,0,1-3.06,5.868A8.045,8.045,0,0,1-28.176.272a6.224,6.224,0,0,1-5.059-2.31,6.5,6.5,0,0,1-1.229-5.687l.686-3.39a10.7,10.7,0,0,1,3-5.875,7.853,7.853,0,0,1,5.6-2.122,6.358,6.358,0,0,1,5.111,2.323,6.438,6.438,0,0,1,1.294,5.674Zm-3.623-3.416a4.488,4.488,0,0,0-.382-3.338,2.633,2.633,0,0,0-2.387-1.268,2.732,2.732,0,0,0-2.31,1.255,8.575,8.575,0,0,0-1.313,3.351l-.686,3.416a4.769,4.769,0,0,0,.3,3.377A2.513,2.513,0,0,0-27.5-3.093a2.876,2.876,0,0,0,2.355-1.281,8.122,8.122,0,0,0,1.385-3.351Zm19.461-4.335h-4.49L-11.2,0h-4.335l3.093-15.476h-4.451l.673-3.364H-2.944ZM4.975-4.7a1.83,1.83,0,0,0-.323-1.714A8.106,8.106,0,0,0,2.465-7.686,11.971,11.971,0,0,1-2.109-10.3a4,4,0,0,1-1.016-3.817A5.512,5.512,0,0,1-.621-17.8a8.742,8.742,0,0,1,4.846-1.307,6.476,6.476,0,0,1,4.6,1.553,4.163,4.163,0,0,1,1.08,4.218l-.039.078H5.661a2.018,2.018,0,0,0-.375-1.812,2.193,2.193,0,0,0-1.734-.673,2.63,2.63,0,0,0-1.5.472,1.79,1.79,0,0,0-.828,1.132,1.481,1.481,0,0,0,.4,1.572,12.773,12.773,0,0,0,2.769,1.352A9.4,9.4,0,0,1,8.482-8.7a4.479,4.479,0,0,1,.8,3.979A5.516,5.516,0,0,1,6.8-.983,8.885,8.885,0,0,1,1.947.272,8.1,8.1,0,0,1-2.885-1.145Q-4.872-2.562-4.212-5.5l.026-.078H.019q-.3,1.423.524,1.954a3.759,3.759,0,0,0,2.077.531,2.735,2.735,0,0,0,1.495-.459A1.79,1.79,0,0,0,4.975-4.7ZM20.166-3.662h-5.2L13.269,0H8.935L18.29-18.84h4.632L24.76,0H20.412ZM16.517-7.026h3.429l-.414-6.3-.078-.013ZM31.009-3.364h7.44L37.777,0H26l3.765-18.84H34.1ZM52.2-8.061H45.463l-.932,4.7h7.958L51.816,0H39.524l3.765-18.84H55.607l-.673,3.364H46.951l-.815,4.05h6.741Z" transform="translate(82.3 28)" fill="#fb4700"></path>
                                        </g>
                                        <path id="Path_1418" data-name="Path 1418" d="M-37.648,0h-4.228l1.485-7.439h-6.018L-47.893,0h-4.253l3.694-18.484H-44.2l-1.549,7.744h6.018l1.549-7.744h4.228Zm18.561-7.579a10.333,10.333,0,0,1-3,5.757A7.894,7.894,0,0,1-27.644.267,6.107,6.107,0,0,1-32.608-2a6.382,6.382,0,0,1-1.206-5.58l.673-3.326A10.494,10.494,0,0,1-30.2-16.669a7.7,7.7,0,0,1,5.5-2.082,6.238,6.238,0,0,1,5.015,2.279,6.316,6.316,0,0,1,1.27,5.567Zm-3.555-3.352a4.4,4.4,0,0,0-.375-3.275,2.583,2.583,0,0,0-2.342-1.244,2.68,2.68,0,0,0-2.266,1.231,8.413,8.413,0,0,0-1.289,3.288l-.673,3.352a4.679,4.679,0,0,0,.3,3.313,2.466,2.466,0,0,0,2.3,1.231,2.822,2.822,0,0,0,2.311-1.257,7.969,7.969,0,0,0,1.358-3.288Zm19.094-4.253H-7.954L-10.988,0h-4.253l3.034-15.184h-4.367l.66-3.3H-2.888ZM4.881-4.608a1.8,1.8,0,0,0-.317-1.682,7.953,7.953,0,0,0-2.146-1.25,11.745,11.745,0,0,1-4.488-2.564,3.923,3.923,0,0,1-1-3.745A5.408,5.408,0,0,1-.609-17.469a8.578,8.578,0,0,1,4.754-1.282,6.354,6.354,0,0,1,4.513,1.523,4.084,4.084,0,0,1,1.06,4.139l-.038.076H5.554a1.98,1.98,0,0,0-.368-1.777,2.151,2.151,0,0,0-1.7-.66,2.581,2.581,0,0,0-1.473.463A1.756,1.756,0,0,0,1.2-13.876a1.453,1.453,0,0,0,.394,1.542A12.532,12.532,0,0,0,4.31-11.007,9.226,9.226,0,0,1,8.322-8.538a4.394,4.394,0,0,1,.787,3.9A5.411,5.411,0,0,1,6.671-.965,8.717,8.717,0,0,1,1.911.267a7.952,7.952,0,0,1-4.742-1.39Q-4.78-2.514-4.132-5.4l.025-.076H.019q-.292,1.4.514,1.917a3.688,3.688,0,0,0,2.038.521,2.683,2.683,0,0,0,1.466-.451A1.756,1.756,0,0,0,4.881-4.608Zm14.9,1.016h-5.1L13.019,0H8.766l9.179-18.484H22.49L24.292,0H20.027Zm-3.58-3.3H19.57l-.406-6.183-.076-.013ZM30.424-3.3h7.3L37.064,0H25.511l3.694-18.484h4.253ZM51.219-7.909H44.6L43.691-3.3H51.5L50.838,0H38.778l3.694-18.484H54.558l-.66,3.3H46.065l-.8,3.974h6.614Z" transform="translate(154.5 631)" fill="#fedb00" stroke="#a71609" stroke-linecap="round" stroke-width="0.5"></path>
                                    </g>
                                    <g id="Group_363" data-name="Group 363" transform="translate(257 10)">
                                        <g transform="matrix(1, 0, 0, 1, -51.3, 604)" filter="url(#Path_1420)">
                                            <path id="Path_1420-2" data-name="Path 1420" d="M-48.782-6.612l.039.078a9.606,9.606,0,0,1-2.691,5.085A7.368,7.368,0,0,1-56.571.272a6.244,6.244,0,0,1-4.995-2.193,6.189,6.189,0,0,1-1.2-5.532l.789-3.934A10.413,10.413,0,0,1-59.114-17.1a7.381,7.381,0,0,1,5.273-2.012A6.4,6.4,0,0,1-48.9-17.248a5.918,5.918,0,0,1,1.3,5.059l-.026.065h-4.231a4.035,4.035,0,0,0-.233-2.717,2.286,2.286,0,0,0-2.135-.906,2.654,2.654,0,0,0-2.116,1.2,7.455,7.455,0,0,0-1.313,3.138l-.789,3.959a5.178,5.178,0,0,0,.123,3.228,2.023,2.023,0,0,0,2,1.132A2.754,2.754,0,0,0-54.2-3.959a5.8,5.8,0,0,0,1.216-2.653Zm19.2-12.228L-32.051-6.5a7.885,7.885,0,0,1-2.989,5.1A9.4,9.4,0,0,1-40.695.272a6.516,6.516,0,0,1-4.872-1.8A5.213,5.213,0,0,1-46.7-6.5l2.471-12.344h4.335L-42.364-6.5a3.245,3.245,0,0,0,.239,2.627,2.533,2.533,0,0,0,2.1.776,3.437,3.437,0,0,0,2.329-.841A4.378,4.378,0,0,0-36.386-6.5l2.471-12.344ZM-14.505-7.725a10.532,10.532,0,0,1-3.06,5.868A8.045,8.045,0,0,1-23.226.272a6.224,6.224,0,0,1-5.059-2.31,6.5,6.5,0,0,1-1.229-5.687l.686-3.39a10.7,10.7,0,0,1,3-5.875,7.853,7.853,0,0,1,5.6-2.122,6.358,6.358,0,0,1,5.111,2.323,6.438,6.438,0,0,1,1.294,5.674Zm-3.623-3.416a4.488,4.488,0,0,0-.382-3.338A2.633,2.633,0,0,0-20.9-15.747a2.732,2.732,0,0,0-2.31,1.255,8.575,8.575,0,0,0-1.313,3.351l-.686,3.416a4.769,4.769,0,0,0,.3,3.377,2.513,2.513,0,0,0,2.349,1.255A2.876,2.876,0,0,0-20.2-4.374a8.122,8.122,0,0,0,1.385-3.351Zm-2.29-12.81h3.558l3,3.241-.026.071h-3.74l-1.333-1.773L-21-20.638h-3.714l-.026-.084Zm8.281-2.433h3.688l.039.078-3.312,3.481-2.95-.006ZM-9.109,0h-4.309l3.765-18.84h4.309ZM15.527-15.476h-4.49L7.945,0H3.61L6.7-15.476H2.251l.673-3.364H16.2ZM32.439-18.84,29.968-6.5a7.885,7.885,0,0,1-2.989,5.1A9.4,9.4,0,0,1,21.324.272a6.516,6.516,0,0,1-4.872-1.8A5.213,5.213,0,0,1,15.32-6.5L17.792-18.84h4.335L19.655-6.5a3.245,3.245,0,0,0,.239,2.627,2.533,2.533,0,0,0,2.1.776,3.437,3.437,0,0,0,2.329-.841A4.378,4.378,0,0,0,25.633-6.5L28.1-18.84Zm8.6,15.178h-5.2L34.147,0H29.813l9.355-18.84H43.8L45.637,0H41.29ZM37.4-7.026h3.429l-.414-6.3-.078-.013Zm9.7-13.4-.039.084h-3.74L42-22.114l-2.07,1.773h-3.7l-.026-.084,4.322-3.228h3.545Zm-9.239-2.1H34.937L32.97-26.086h3.778ZM61.656,0H57.335L53.608-11.568l-.078.013L51.214,0H46.88l3.765-18.84H54.98L58.706-7.272l.078-.013L61.1-18.84h4.322Z" transform="translate(205.3 28)" fill="#fb4700"></path>
                                        </g>
                                        <path id="Path_1421" data-name="Path 1421" d="M-47.861-6.487l.038.076a9.425,9.425,0,0,1-2.641,4.989A7.229,7.229,0,0,1-55.5.267a6.126,6.126,0,0,1-4.9-2.152,6.072,6.072,0,0,1-1.181-5.427l.774-3.859A10.217,10.217,0,0,1-58-16.777a7.242,7.242,0,0,1,5.173-1.974,6.278,6.278,0,0,1,4.843,1.828,5.806,5.806,0,0,1,1.276,4.964l-.025.063h-4.151a3.959,3.959,0,0,0-.229-2.666,2.243,2.243,0,0,0-2.095-.889,2.6,2.6,0,0,0-2.076,1.174A7.314,7.314,0,0,0-56.57-11.2l-.774,3.885a5.081,5.081,0,0,0,.121,3.167,1.984,1.984,0,0,0,1.961,1.111,2.7,2.7,0,0,0,2.082-.851,5.7,5.7,0,0,0,1.193-2.6Zm18.84-12L-31.446-6.373a7.736,7.736,0,0,1-2.933,5.008A9.227,9.227,0,0,1-39.927.267,6.393,6.393,0,0,1-44.707-1.5a5.115,5.115,0,0,1-1.111-4.875l2.425-12.111h4.253L-41.564-6.373A3.184,3.184,0,0,0-41.33-3.8a2.485,2.485,0,0,0,2.063.762,3.372,3.372,0,0,0,2.285-.825A4.3,4.3,0,0,0-35.7-6.373l2.425-12.111Zm14.79,10.905a10.333,10.333,0,0,1-3,5.757A7.894,7.894,0,0,1-22.788.267,6.107,6.107,0,0,1-27.752-2a6.382,6.382,0,0,1-1.206-5.58l.673-3.326a10.494,10.494,0,0,1,2.945-5.764,7.7,7.7,0,0,1,5.5-2.082,6.238,6.238,0,0,1,5.015,2.279,6.316,6.316,0,0,1,1.27,5.567Zm-3.555-3.352a4.4,4.4,0,0,0-.375-3.275A2.583,2.583,0,0,0-20.5-15.45a2.68,2.68,0,0,0-2.266,1.231,8.413,8.413,0,0,0-1.289,3.288l-.673,3.352a4.679,4.679,0,0,0,.3,3.313,2.466,2.466,0,0,0,2.3,1.231,2.822,2.822,0,0,0,2.311-1.257,7.969,7.969,0,0,0,1.358-3.288ZM-20.033-23.5h3.491l2.945,3.18-.025.07h-3.669L-18.6-21.988-20.6-20.249h-3.644l-.025-.083Zm8.125-2.387H-8.29l.038.076-3.25,3.415L-14.4-22.4ZM-8.937,0h-4.228l3.694-18.484h4.228ZM15.234-15.184H10.829L7.795,0H3.542L6.576-15.184H2.209l.66-3.3H15.895Zm16.593-3.3L29.4-6.373A7.736,7.736,0,0,1,26.47-1.365,9.227,9.227,0,0,1,20.922.267,6.393,6.393,0,0,1,16.142-1.5a5.115,5.115,0,0,1-1.111-4.875l2.425-12.111h4.253L19.284-6.373A3.184,3.184,0,0,0,19.519-3.8a2.485,2.485,0,0,0,2.063.762,3.372,3.372,0,0,0,2.285-.825,4.3,4.3,0,0,0,1.282-2.514l2.425-12.111ZM40.27-3.593h-5.1L33.5,0H29.25l9.179-18.484h4.545L44.776,0H40.511Zm-3.58-3.3h3.364l-.406-6.183-.076-.013ZM46.211-20.04l-.038.083H42.5L41.209-21.7l-2.031,1.739H35.547l-.025-.083,4.24-3.167H43.24ZM37.146-22.1H34.277l-1.93-3.491h3.707ZM60.493,0h-4.24L52.6-11.35l-.076.013L50.248,0H46l3.694-18.484h4.253L57.6-7.135l.076-.013,2.272-11.337h4.24Z" transform="translate(154.5 631)" fill="#fedb00" stroke="#a71609" stroke-linecap="round" stroke-width="0.5"></path>
                                    </g>
                                </g>
                                <g transform="matrix(1, 0, 0, 1, 98.7, 620)" filter="url(#power)">
                                    <path id="power-2" data-name="power" d="M8.315,0,0,17H8.315L2.772,34l19.4-21.25H11.087L19.4,0Z" transform="translate(2.3 0.5)" fill="#fedb00" stroke="#f3a306" stroke-width="1"></path>
                                </g>
                            </g>
                        </svg>
                    </div>
                </div>
                <div class="c-6 flash__sale__box__tablet">
                    <div class="coutdown">
                        <h1 class="coutdown__title">
                            Kết thúc sau
                        </h1>
                        <div class="time">
                            <h1 id="day">01</h1>
                        </div>
                        <span>:</span>
                        <div class="time">
                            <h1 id="hour">11</h1>
                        </div>
                        <span>:</span>
                        <div class="time">
                            <h1 id="minutes">59</h1>
                        </div>
                        <span>:</span>
                        <div class="time">
                            <h1 id="sec">22</h1>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            include '../connect.php';
            if (isset($_GET['cname'])) {
                $cname = $_GET['cname'];
                // Lấy danh sách sản phẩm trong danh mục
                $sql = "SELECT p.pid, p.pname, p.pprice, p.pquantity, p.pimage FROM product p INNER JOIN categories c ON p.cid = c.cid WHERE c.cname = '$cname'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    echo '<div class="row flash__sale__product__list__wrapper">';
                    echo '<div class="flash__sale__product__list">';
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="flash__sale__product">';
                        echo '<div class="flash__sale__discount">';
                        echo '<p>' . $row["pprice"] . '</p>';
                        echo '</div>';
                        echo '<div class="flash__sale__product__img__wrapper">';
                        echo '<a href=""><img src="../assets/images/' . $row["pimage"] . '" alt=""></a>';
                        echo '</div>';
                        echo '<div class="flash__sale__product__desc">';
                        echo '<a href="" class="flash__sale__product__desc__title">';
                        echo '<p class="flash__sale__product__desc__title__1st">' . $row["pname"] . '</p>';
                        echo '</a>';
                        echo '<div class="flash__sale__product__desc__price">';
                        echo '<div class="flash__sale__product__desc__price__new">';
                        echo '<p>' . $row["pprice"] . ' <span class="flash__sale__product__desc__price__unit__new">đ</span></p>';
                        echo '</div>';
                        echo '<div class="flash__sale__product__desc__price__old">';
                        echo '<p>' . $row["pprice"] . ' <span class="flash__sale__product__desc__price__unit__old">đ</span></p>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }

                    echo '</div>';
                    echo '</div>';
                } else {
                    echo "Không có sản phẩm.";
                }
            } else {
                echo "Danh mục không được cung cấp.";
            }
            $conn->close();
            ?>
        </div>
    </div>
</body>

</html>