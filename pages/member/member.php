<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/img/zalo suopprt/cellphones.png">
    <link rel="stylesheet" href="../assets/font/themify-icons-font/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="../assets/font/fontawesome-free-5.15.4/fontawesome-free-5.15.4-web/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../../action/javascript.js">
    <link rel="stylesheet" href="../../css/product_detail.css">
    <link rel="stylesheet" href="../../css/dropbox.css">
    <link rel="stylesheet" href="../../action/dropbox.js">
    <link rel="stylesheet" href="../../css/find.css">
    <link rel="stylesheet" href="../../css/home.css">
    <link rel="stylesheet" href="../../css/member.css">
    <title>Nhóm 13 - Member</title>
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
$sql = "SELECT * FROM member WHERE username = '$username'";
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
<html>

<body>
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
                                                <a href="../member/member.php">Trang cá nhân</a>
                                                <a href="../dashboard/logout.php    ">Đăng xuất</a>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <style>
                                    /* Ẩn dropdown content mặc định */
                                    .dropdown-content {
                                    display: none;
                                    position: absolute;
                                    background-color: #fff;
                                    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
                                    z-index: 1;
                                    color: #000; /* Màu chữ đen */
                                    font-weight: bold; /* In đậm */
                                }
                                /* Hiển thị dropdown khi có class 'show' */
                                .dropdown-content.show {
                                    display: block;
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
                                }

                                .dropdown-content a:hover {
                                    background-color: #f0f0f0; /* Màu nền khi di chuột qua */
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
        <div id="container">
            <div id="sidebar">
                <ul>
                    <li><a href="#content"> <i class="far fa-user-circle"></i>Tài khoản của bạn</a></li>
                    <li><a href="../dashboard/history.php"><i class="fas fa-shipping-fast"></i>Lịch sử mua hàng</a></li>
                    <li><a href="../dashboard/logout.php"><i class="fa-solid fa-right-from-bracket"></i>Đăng xuất</a></li>
                </ul>
            </div>
            <div id="content">
                <form method="POST" action="../../action/update_member_action.php">
                    <input type="hidden" name="user_id" value="<?php echo $row['mid']; ?>">
                    <div class="user_name">
                        <label for="username">Username:</label>
                        <input type="text" name="username" id="username" value="<?php echo $row['username']; ?>">
                    </div>
                    <div class="full_name">
                        <label for="fullname">Full Name:</label>      
                        <input type="text" name="fullname" id="fullname" value="<?php echo $row['mname']; ?>">
                    </div>
                    <div class="address">
                        <label for="address">Address:</label>
                        <input type="text" name="address" id="address" value="<?php echo $row['madd']; ?>">
                    </div>
                    <div class="phone">
                        <label for="phone">Phone:</label>
                        <input type="text" name="phone" id="phone" value="<?php echo $row['mphone']; ?>">
                    </div>
                    <div class="email">
                        <label for="email">Email:</label>
                        <input type="text" name="email" id="email" value="<?php echo $row['memail']; ?>">
                    </div>
                    <input class="update_button" type="submit" value="Cập nhật thông tin">
                </form>
            </div>
        </div>
</body>
</html>
