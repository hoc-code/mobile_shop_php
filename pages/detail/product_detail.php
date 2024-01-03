<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/img/zalo suopprt/cellphones.png">
    <link rel="stylesheet" href="../assets/font/themify-icons-font/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="../assets/font/fontawesome-free-5.15.4/fontawesome-free-5.15.4-web/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../../css/home.css">
    <link rel="stylesheet" href="../../action/javascript.js">
    <link rel="stylesheet" href="../../css/product_detail.css">
    <link rel="stylesheet" href="../../css/dropbox.css">
    <link rel="stylesheet" href="../../css/find.css">
    <link rel="stylesheet" href="../../action/dropbox.js">

    <title>Nhóm 13 - Chi tiết sản phẩm</title>
</head>
<?php
session_start();
require_once("../connect.php");

if (!isset($_GET['pname'])) {
    echo "Product name not found!";
} else {
    $pname = $_GET['pname'];
    $sql = "SELECT a.*, b.cname FROM product a, categories b WHERE a.cid = b.cid AND a.pname = '$pname'";
    $result = $conn->query($sql) or die($conn->error);
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
    <div class="product_detail">
    <?php
        if (isset($_GET['pname'])) {
            $phoneName = $_GET['pname'];
            echo '<h1 style =>' . $phoneName . '</h1>';
        }
    ?>

        <div class="product_detail_row">
            <div class="product_detail_container">
                <div class="product_detail_picture">
                    <?php
                    include('../connect.php');
                    $receivedPname = $_GET['pname'];
                    $escapedPname = $conn->real_escape_string($receivedPname);
                    $sql = "SELECT * FROM product WHERE pname = '$escapedPname'";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $pname = $row['pname'];
                        echo '<img src="../assets/images1/' . $row["pimage"] . '" alt="điện thoại ' . $row["pname"] . '">';
                    } else {
                        echo "Không có dữ liệu";
                    }
                    $conn->close();
                    ?>
                </div>
                <div class="product_detail_info_product">
                    <h2>Thông số kỹ thuật</h2>
                    <?php
                        if (isset($_GET['pname'])) {
                            include('../connect.php');

                            // Lấy pname từ URL
                            $receivedPname = $conn->real_escape_string($_GET['pname']);

                            // Truy vấn pid từ bảng product
                            $pidQuery = "SELECT pid FROM product WHERE pname = '$receivedPname'";
                            $pidResult = $conn->query($pidQuery);

                            if ($pidResult->num_rows > 0) {
                                $row = $pidResult->fetch_assoc();
                                $pid = $row['pid'];

                                // Truy vấn thông số từ bảng attribute dựa trên pid
                                $sql = "SELECT * FROM attribute WHERE pid = $pid";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    echo '<ul class="info">';
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<li>';
                                        echo '<p>' . $row['aname'] . ':' . '</p>';
                                        echo '<div>' . $row['avalue'] . '</div>';
                                        echo '</li>';
                                    }
                                    echo '</ul>';
                                } else {
                                    echo "Không có thông tin sản phẩm";
                                }
                            } else {
                                echo "Không tìm thấy sản phẩm";
                            }
                            $conn->close();
                        }
                    ?>

                </div>
            </div>
            <div class="product_detail_payment">
                <h2 style="margin-top: 9%;">Thanh toán</h2>
                <?php
                include('../connect.php');
                $receivedPname = $_GET['pname'];
                $escapedPname = $conn->real_escape_string($receivedPname);
                
                // Truy vấn để lấy thông tin sản phẩm từ bảng product và season (nếu có)
                $sql = "SELECT p.pprice, se.discount_percentage 
                        FROM product p
                        LEFT JOIN sale s ON p.pid = s.pid
                        LEFT JOIN season se ON s.seasonid = se.seasonid
                        WHERE p.pname = '$escapedPname'";
                
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                
                    if ($row["discount_percentage"] !== null) {
                        // Nếu sản phẩm có liên kết với mùa bán hàng (season)
                        $oldPrice = $row["pprice"];
                        $discountPercentage = $row["discount_percentage"];
                
                        // Tính toán giá mới (pnewprice)
                        $newPrice = $oldPrice * (1 - ($discountPercentage / 100));
                
                        // Hiển thị giá mới
                        echo '<div class="payment_price">';
                        echo '<p>Giá: ' . $newPrice . '</p>';
                        echo '</div>';
                    } else {
                        // Nếu sản phẩm không có liên kết với mùa bán hàng (season)
                        $price = $row["pprice"];
                
                        // Hiển thị giá thông thường
                        echo '<div class="payment_price">';
                        echo '<p>Giá: ' . $price . '</p>';
                        echo '</div>';
                    }
                } else {
                    echo "Không có thông tin sản phẩm";
                }
                
                $conn->close();
                
                ?>

                <div class="payment_buttons">
                <form action="../../action/add_product_to_cart.php" method="GET">
                        <!-- Hidden input to pass product name to the PHP script -->
                        <input type="hidden" name="pname" value="<?php echo $receivedPname; ?>">
                        <button type="submit">Thêm vào giỏ hàng</button>
                    </form>
                </div>
            </div>
        </div>
        <hr>
        <div class="comment-area">
        <form action="../../action/comment_action.php" method="POST" class="guibinhluan">
            <!-- Thêm input ẩn để chứa giá trị pname và mid -->
            <input type="hidden" name="pname" value="<?php echo $receivedPname; ?>">
            <input type="hidden" name="mid" value="<?php echo $userID; ?>">
            <!-- Phần textarea cho comment -->
            <textarea name="comment" placeholder="Type your comment here..."></textarea>
            <button type="submit">Gửi</button>
        </form>

</div>
    <div class="container_comment">
        <!-- Hiển thị bình luận đã có -->
        <?php
            if (isset($_GET['pname'])) {
                include '../connect.php';
                $receivedPname = $conn->real_escape_string($_GET['pname']);

                // Tìm pid từ bảng product dựa trên pname
                $pidQuery = "SELECT pid FROM product WHERE pname = '$receivedPname'";
                $pidResult = $conn->query($pidQuery);

                if ($pidResult->num_rows > 0) {
                    $row = $pidResult->fetch_assoc();
                    $pid = $row['pid'];
                    // Tiếp tục thực hiện truy vấn để lấy dữ liệu từ bảng comment với pid đã có
                    $commentQuery = "SELECT * FROM comment WHERE pid = $pid AND comstatus = 1";                    
                    $commentResult = $conn->query($commentQuery);

                    if ($commentResult->num_rows > 0) {
                        while ($comment = $commentResult->fetch_assoc()) {
                            $mid = $comment['mid'];

                            // Truy vấn để lấy mname từ members table dựa trên mid
                            $memberQuery = "SELECT mname FROM member WHERE mid = $mid";
                            $memberResult = $conn->query($memberQuery);

                            if ($memberResult->num_rows > 0) {
                                $member = $memberResult->fetch_assoc();
                                $mname = $member['mname'];
            
                                echo '<div class="comment">';
                                echo '<div class="title_comment">';
                                echo '<i class="fa fa-user-circle"></i>';
                                echo '<h4>' . $mname . '</h4>';
                                if ($mid === $userID) {
                                    echo '<a class="delete_comment" href="../../action/delete_comment_action.php?comid=' . $comment['comid'] . '&mid=' . $userID .  '&pname=' . $receivedPname .   '&pid=' . $pid . '">Xóa comment</a>';
                                }
                                echo '</div>';
                                echo '<p>' . $comment['content'] . '</p>';
                                echo '<span class="time">' . $comment['comdate'] . '</span>';
                                // Kiểm tra xem comment thuộc về người dùng đăng nhập hay không để hiển thị nút xóa
                                
            
                                echo '</div>';
                            } else {
                                echo "Không tìm thấy thông tin thành viên.";
                            }
                        }
                    } else {
                        echo "Chưa có bình luận nào cho sản phẩm này.";
                    }
                } else {
                    echo "Không tìm thấy sản phẩm.";
                }
            }
            ?>

    </div>
</div>

    </div>
</body>

</html>