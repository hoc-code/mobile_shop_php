<?php
session_start();
include '../connect.php';
// Kiểm tra phiên làm việc
if (isset($_SESSION['login']) && isset($_SESSION['TenDangNhap1'])) {
    // Kiểm tra xem người dùng đã đăng nhập với vai trò admin chưa
    if ($_SESSION['login'] === true) {
        // Đã đăng nhập với vai trò admin, cho phép truy cập vào trang admin
        $username = $_SESSION['TenDangNhap1'];
        // Hiển thị nội dung của trang admin ở đây
    } else {
        // Không có quyền truy cập, chuyển hướng về trang đăng nhập
        header("Location: ../../pages/dashboard/login.php");
        exit();
    }
} else {
    // Nếu chưa đăng nhập, chuyển hướng về trang đăng nhập
    header("Location: ../../pages/dashboard/login.php");
    exit();
}



$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';

switch ($action) {
    case "add_product":
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_product"])) {
            $cid = $_POST["cid"];
            $sid = $_POST["sid"];
            $pname = $_POST["pname"];
            $pdesc = $_POST["pdesc"];
            $pinsertdate = $_POST["pinsertdate"];
            $pupdatedate = $_POST["pupdatedate"];
            $pprice = $_POST["pprice"];
            $pquantity = $_POST["pquantity"];
            $pstatus = $_POST["pstatus"];
            $pimage = $_POST["pimage"];
    
            // Kiểm tra pquantity không phải là số
            if (!preg_match('/^\D+$/', $pquantity)) {
                $error_message = "Số lượng không được chứa ký tự";
            }
    
            // Kiểm tra ngày insert nhỏ hơn ngày update
            $insertDate = strtotime($pinsertdate);
            $updateDate = strtotime($pupdatedate);
            if ($insertDate >= $updateDate) {
                $error_message = "Ngày Insert phải nhỏ hơn ngày Update";
            }
    
            // Kiểm tra các trường bắt buộc
            $requiredFields = [$cid, $sid, $pname, $pprice, $pquantity, $pstatus];
            if (in_array("", $requiredFields, true)) {
                $error_message = "Vui lòng điền đầy đủ thông tin bắt buộc";
            }
    
            if (!isset($error_message)) {
                $insert_product_query = $conn->prepare("INSERT INTO product (cid, sid, pname, pdesc, pinsertdate, pupdatedate, pprice, pquantity, pstatus, pimage) 
                                                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $insert_product_query->bind_param("ssssssddss", $cid, $sid, $pname, $pdesc, $pinsertdate, $pupdatedate, $pprice, $pquantity, $pstatus, $pimage);
    
                if ($insert_product_query->execute()) {
                    $success_message = "Thêm sản phẩm thành công";
                } else {
                    $error_message = "Lỗi: " . $conn->error;
                }
    
                $insert_product_query->close();
            }
    
            // Hiển thị thông báo thành công hoặc lỗi
            if (isset($error_message)) {
                echo '<script>alert("' . $error_message . '");</script>';
            } elseif (isset($success_message)) {
                echo '<script>alert("' . $success_message . '");</script>';
            }
        }
        break;
    
        //
        case "edit_product":
    if (isset($_GET["pid"])) {
        $pid = $_GET["pid"];

        $cid = isset($_POST["cid"]) ? $_POST["cid"] : null;
        $sid = isset($_POST["sid"]) ? $_POST["sid"] : null;
        $pname = isset($_POST["pname"]) ? $_POST["pname"] : null;
        $pdesc = isset($_POST["pdesc"]) ? $_POST["pdesc"] : null;
        $pinsertdate = isset($_POST["pinsertdate"]) ? $_POST["pinsertdate"] : null;
        $pupdatedate = isset($_POST["pupdatedate"]) ? $_POST["pupdatedate"] : null;
        $pprice = isset($_POST["pprice"]) ? $_POST["pprice"] : null;
        $pquantity = isset($_POST["pquantity"]) ? $_POST["pquantity"] : null;
        $pstatus = isset($_POST["pstatus"]) ? $_POST["pstatus"] : null;
        $pimage = isset($_POST["pimage"]) ? $_POST["pimage"] : null;

        $intRegex = '/^\d{1,10}$/';
        $decimalRegex = '/^\d{1,8}(\.\d{1,2})?$/';

        $error_messages = [];

        if ($pquantity !== null && !preg_match($intRegex, $pquantity)) {
            $error_messages[] = "Số lượng không hợp lệ";
        }

        if ($pprice !== null && !preg_match($decimalRegex, $pprice)) {
            $error_messages[] = "Giá không hợp lệ";
        }

        if (!is_numeric($pid) || ($pquantity !== null && !is_numeric($pquantity)) || ($pprice !== null && !is_numeric($pprice)) || !is_numeric($pstatus)) {
            $error_messages[] = "Giá trị của một hoặc nhiều trường kiểu số không hợp lệ";
        }

        if (empty($error_messages)) {
            // Update product information
            $update_product_query = "UPDATE product SET cid=?, sid=?, pname=?, pdesc=?, pinsertdate=?, pupdatedate=?, 
                                        pprice=?, pquantity=?, pstatus=?, pimage=? WHERE pid=?";
            $stmt = $conn->prepare($update_product_query);
            $stmt->bind_param("ssssssddssi", $cid, $sid, $pname, $pdesc, $pinsertdate, $pupdatedate,
                $pprice, $pquantity, $pstatus, $pimage, $pid);

            if ($stmt->execute()) {
                $success_message = "Cập nhật sản phẩm thành công";
            } else {
                $error_message = "Lỗi khi cập nhật sản phẩm: " . $conn->error;
            }
            $stmt->close();
        } else {
            $error_message = "Thiếu dữ liệu cần thiết hoặc giá trị không hợp lệ để cập nhật sản phẩm";
        }
    } else {
        $error_message = "Thiếu dữ liệu cần thiết để cập nhật sản phẩm";
    }

    // Display success or error message
    if (isset($error_message)) {
        echo "<script>alert('{$error_message}');</script>";
    } elseif (isset($success_message)) {
        echo "<script>alert('{$success_message}');</script>";
    }
    break;

        
        

        case "delete_product":
            $pid = $_GET["pid"];
            $update_product_query = "UPDATE product SET pstatus=0 WHERE pid=?";
            $stmt = $conn->prepare($update_product_query);
            $stmt->bind_param("i", $pid);

            if ($stmt->execute()) {
                echo "<script>alert('Cập nhật trạng thái sản phẩm thành công');</script>";
            } else {
                echo "<script>alert('Lỗi khi cập nhật trạng thái sản phẩm: " . $stmt->error . "');</script>";
            }
            $stmt->close();
            break;
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/img/zalo suopprt/cellphones.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="admin_ql_Product3.css">
    <link rel="stylesheet" href="css/sanpham.css">
    <link rel="stylesheet" href="admin_ql_member.css">
    <title>Sản phẩm</title>
    <link rel="stylesheet" href="admin_side_bar.css">
</head>

<body>
    <div>
    <nav class="nav1">
            <!-- <a href="admin.php"><i class="fa fa-home" aria-hidden="true"></i>Home</a> -->
            <a href="admin_ql_member.php"><i class="fa fa-user" aria-hidden="true"></i>Khách hàng</a>
            <a href="admin_ql_sanpham.php"><i class="fa-solid fa-box"></i>Sản phẩm</a>
            <a href="admin_ql_order.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i>Đơn đặt</a>
            <a href="admin_ql_doanhthu.php"><i class="fa fa-line-chart" aria-hidden="true"></i>Doanh thu</a>
            <a href="admin_ql_thongke.php"><i class="fa-solid fa-chart-simple"></i>Thống Kê</a>
            <a href="../../pages/dashboard/logout.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i>Đăng xuất</a>
    </nav>
    </div>
    <div class="content">
        <h1 align="center">Điện Thoại</h1>
        <center>
        <button style="margin-bottom: 10px;" onclick="toggleForm()">Thêm mới</button>
        </center>
        <?php
        include '../connect.php';
        $num_rows = 4;
        $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
        $start = ($page - 1) * $num_rows;

        $count_query = "SELECT COUNT(*) as total FROM Product";
        $count_result = $conn->query($count_query);
        $total_rows = $count_result->fetch_assoc()['total'];

        $num_of_pages = ceil($total_rows / $num_rows);

        $select_query = "SELECT * FROM product LIMIT ?, ?";
        $stmt = $conn->prepare($select_query);
        $stmt->bind_param("ii", $start, $num_rows);

        if (!$stmt->execute()) {
            die("Lỗi khi thực hiện truy vấn: " . $stmt->error);
        }

        $result = $stmt->get_result();

        echo '<table border="1" width="100%">';
        echo '<tr>';
        echo '<th>ID</th>';
        echo '<th>Product ID</th>';
        echo '<th>Category ID</th>';
        echo '<th>Supplier ID</th>';
        echo '<th>Product Name</th>';
        echo '<th>Description</th>';
        echo '<th>Insert Date</th>';
        echo '<th>Update Date</th>';
        echo '<th>Price</th>';
        echo '<th>Quantity</th>';
        echo '<th>Status</th>';
        echo '<th>Image</th>';
        echo '<th>Edit</th>';
        echo '<th>Delete</th>';
        echo '</tr>';

        if ($result->num_rows == 0) {
            echo "<tr><td style='color: red;' colspan='13'>No products!</td></tr>";
        } else {
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row["pid"] . '</td>';
                echo '<td>' . $row["pid"] . '</td>';
                echo '<td>' . $row["cid"] . '</td>';
                echo '<td>' . $row["sid"] . '</td>';
                echo '<td>' . $row["pname"] . '</td>';
                echo '<td>' . $row["pdesc"] . '</td>';
                echo '<td>' . $row["pinsertdate"] . '</td>';
                echo '<td>' . $row["pupdatedate"] . '</td>';
                echo '<td>' . $row["pprice"] . '</td>';
                echo '<td>' . $row["pquantity"] . '</td>';
                echo '<td>';
                if ($row["pstatus"] == 1) {
                    echo 'Active';
                } elseif ($row["pstatus"] == 0) {
                    echo 'Inactive';
                } else {
                    echo 'Unknown';
                }
                echo '</td>';
                echo "<td><img src=\"../assets/images1/{$row['pimage']}\" alt=\"điện thoại {$row['pname']}\" style=\"width: 100px; height: 100px;     object-fit: contain;\"></td>";
                echo '<td><button id="editButton" onclick="toggleEdit(' . $row['pid'] . ')">Edit</button></td>';
                echo '<td><a style="background-color: red;
                    padding: 10px;
                    border-radius: 10px;
                    text-decoration: none;
                    color: #fff;
                    font-weight: bold;" 
                    href="?action=delete_product&pid=' . $row['pid'] . '">Delete</a></td>';
                echo '</tr>';
            }
        }
        echo '</table>';

        // Phần phân trang ở đây...

        echo '<center>';
        if ($num_of_pages > 1) {
            echo "<p>";
            for ($i = 1; $i <= $num_of_pages; $i++) {
                if ($i == $page) {
                    echo "<strong>" . $i . "</strong> ";
                } else {
                    echo "<a href='?page=" . $i . "'>" . $i . "</a> ";
                }
            }
            echo "</p>";
        }
        echo '</center>';
        ?>


        </div>
        <div id="addProductForm" style="display: none;">
        <h2>Add New Product</h2>
        <form action="admin_ql_sanpham.php?action=add_product" method="POST" class="flex-form" onsubmit="return validateForm()">
            <div class="form-row">
                <input type="hidden" id="pid" name="pid" required>
            </div>
            <div class="form-row">
                <input type="hidden" id="pid" name="pid" required>
            </div>
            <div class="form-row">
                <label for="cid">Category ID:</label>
                <select id="cid" name="cid" required>
                    <?php
                    include 'connect.php';
                    $categoryQuery = "SELECT cid, cname FROM categories";
                    $resultCategories = $conn->query($categoryQuery);
                    if ($resultCategories->num_rows > 0) {
                        while ($row = $resultCategories->fetch_assoc()) {
                            echo "<option value='" . $row['cid'] . "'>" . $row['cname'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-row">
                <label for="sid">Supplier ID:</label>
                <select id="sid" name="sid" required>
                    <?php
                    $supplierQuery = "SELECT sid, sname FROM supplier";
                    $resultSuppliers = $conn->query($supplierQuery);
                    if ($resultSuppliers->num_rows > 0) {
                        while ($row = $resultSuppliers->fetch_assoc()) {
                            echo "<option value='" . $row['sid'] . "'>" . $row['sname'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-row">
                <label for="pname">Product Name:</label>
                <input type="text" id="pname" name="pname" required>
            </div>
            <div class="form-row">
                <label for="pdesc">Product Description:</label>
                <input type="text" id="pdesc" name="pdesc" required>
            </div>
            <div class="form-row">
                <label for="pinsertdate">Insert Date:</label>
                <input type="date" id="pinsertdate" name="pinsertdate" required>
            </div>
            <div class="form-row">
                <label for="pupdatedate">Update Date:</label>
                <input type="date" id="pupdatedate" name="pupdatedate" required>
            </div>

            <div class="form-row">
                <label for="pprice">Product Price:</label>
                <input type="text" id="pprice" name="pprice" required>
            </div>
            <div class="form-row">
                <label for="pquantity">Product Quantity:</label>
                <input type="text" id="pquantity" name="pquantity" required>
            </div>
            <div class="form-row">
                <label for="pstatus">Product Status:</label>
                <input type="radio" id="active" name="pstatus" value="1" checked required>
                <label for="active">Active</label>
                <input type="radio" id="inactive" name="pstatus" value="0">
                <label for="inactive">Inactive</label>
            </div>
            <div class="form-row">
                <label for="pimage">Product Image:</label>
                <input type="text" id="pimage" name="pimage" required>
            </div>
            <input type="submit" name="add_product" value="Add Product">
        </form>
        <div class="close_button"><button style="align-items:center;" onclick="cancelAdd('addProductForm')">Đóng form</button></div>
    </div>

    <div id="editProduct" style="display: none;">
    <?php
    // Lấy thông tin sản phẩm dựa trên pid
    if (isset($_GET['pid'])) {
        $edit_pid = $_GET['pid'];
        $edit_product_query = "SELECT * FROM product WHERE pid = ?";
        $stmt = $conn->prepare($edit_product_query);
        $stmt->bind_param("i", $edit_pid);
        $stmt->execute();
        $edit_result = $stmt->get_result();
        if ($edit_result->num_rows > 0) {
            $edit_row = $edit_result->fetch_assoc();
            // Lấy thông tin của sản phẩm để hiển thị trong form chỉnh sửa
            $edit_cid = $edit_row['cid'];
            $edit_sid = $edit_row['sid'];
            $edit_pname = $edit_row['pname'];
            $edit_pdesc = $edit_row['pdesc'];
            $edit_pinsertdate = $edit_row['pinsertdate'];
            $edit_pupdatedate = $edit_row['pupdatedate'];
            $edit_pprice = $edit_row['pprice'];
            $edit_pquantity = $edit_row['pquantity'];
            $edit_pstatus = $edit_row['pstatus'];
            $edit_pimage = $edit_row['pimage'];
            $formatted_insert_date = date("Y-m-d\TH:i", strtotime($edit_pinsertdate));
            $formatted_update_date = date("Y-m-d\TH:i", strtotime($edit_pupdatedate));
        } else {
            $edit_cid = '';
            $edit_sid = '';
            $edit_pname = '';
            $edit_pdesc = '';
            $edit_pinsertdate = '';
            $edit_pupdatedate = '';
            $edit_pprice = '';
            $edit_pquantity = '';
            $edit_pstatus = '';
            $edit_pimage = '';
        }
        $stmt->close();
    } else {
        $edit_cid = '';
        $edit_sid = '';
        $edit_pname = '';
        $edit_pdesc = '';
        $edit_pinsertdate = '';
        $edit_pupdatedate = '';
        $edit_pprice = '';
        $edit_pquantity = '';
        $edit_pstatus = '';
        $edit_pimage = '';
    }
    ?>
    <form action="admin_ql_sanpham.php?action=edit_product&pid=<?php echo $edit_pid; ?>" method="POST" class="flex-form" onsubmit="return validateForm()">
        <div class="form-row">
            <label for="cid">Category ID:</label>
            <select id="cid" name="cid" required>
                <?php
                $query = "SELECT cid, cname FROM categories";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    $selected = ($edit_cid == $row['cid']) ? "selected" : "";
                    echo "<option value='{$row['cid']}' $selected>{$row['cid']} - {$row['cname']}</option>";
                }
                ?>
            </select>
            </div>
            <!-- Supplier ID select dropdown -->
            <div class="form-row">
                <label for="sid">Supplier ID:</label>
                <select id="sid" name="sid" required>
                    <?php
                    $query = "SELECT sid, sname FROM supplier";
                    $result = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $selected = ($edit_sid == $row['sid']) ? "selected" : "";
                        echo "<option value='{$row['sid']}' $selected>{$row['sid']} - {$row['sname']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-row">
                <label for="pname">Product Name:</label>
                <input type="text" id="pname" name="pname" value="<?php echo $edit_pname; ?>" required>
            </div>
            <div class="form-row">
                <label for="pdesc">Product Description:</label>
                <input type="text" id="pdesc" name="pdesc" value="<?php echo $edit_pdesc; ?>" required>
            </div>
            <div class="form-row">
                <label for="pinsertdate">Insert Date:</label>
                <input type="datetime-local" id="pinsertdate" name="pinsertdate" value="<?php echo $formatted_insert_date; ?>" required>
            </div>
            <div class="form-row">
                <label for="pupdatedate">Update Date:</label>
                <input type="datetime-local" id="pupdatedate" name="pupdatedate" value="<?php echo $formatted_update_date; ?>" required>
            </div>

            <div class="form-row">
                <label for="pprice">Product Price:</label>
                <input type="text" id="pprice" name="pprice" value="<?php echo $edit_pprice; ?>" required>
            </div>
            <div class="form-row">
                <label for="pquantity">Product Quantity:</label>
                <input type="text" id="pquantity" name="pquantity" value="<?php echo $edit_pquantity; ?>" required>
            </div>
            <div class="form-row">
                <label for="pstatus">Product Status:</label>
                <input type="radio" id="active" name="pstatus" value="1" <?php if ($edit_pstatus == 1) echo 'checked'; ?> required>
                <label for="active">Active</label>
                <input type="radio" id="inactive" name="pstatus" value="0" <?php if ($edit_pstatus == 0) echo 'checked'; ?>>
                <label for="inactive">Inactive</label>
            </div>
            <?php
            if (isset($_GET['pid'])) {
                $pid = $_GET['pid'];
                $query = "SELECT pimage FROM product WHERE pid = $pid";
                $result = mysqli_query($conn, $query);

                if ($result && mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $pimage = $row['pimage'];
            ?>
                    <div class="form-row">
                        <label for="pimage">Product Image URL:</label>
                        <input type="text" id="pimage" name="pimage" value="<?php echo $pimage; ?>" required>
                    </div>
            <?php
                } else {
                    echo "Product not found";
                }
            } else {
                echo "PID not provided in URL";
            }
            ?>
            <input type="submit" value="Save Edit">
        </form>
        <div class="close_button" style="justify-content: center;"><button style="align-items:center;" onclick="cancelEditAdd('editProduct')">Đóng form</button></div>
    </div>


    <script>
         function toggleForm() {
            var form = document.getElementById("addProductForm");
            form.style.display = "block";
        }

        function toggleEdit(pid) {
            // var editform = document.getElementById("editProduct");
            // editform.style.display = "block"; // Hiển thị phần tử khi nhấn nút Edit

            var currentURL = new URL(window.location.href);
            currentURL.searchParams.set('action', 'edit_action'); // Thêm action vào URL
            currentURL.searchParams.set('pid', pid); // Thêm pid vào URL

            window.history.pushState({ path: currentURL.href }, '', currentURL.href);

            // Lưu trạng thái của editProduct vào localStorage
            localStorage.setItem('editProductDisplay', 'block');

            location.reload();
        }
        window.onload = function() {
            var editProductDisplay = localStorage.getItem('editProductDisplay');
            var editform = document.getElementById("editProduct");

            if (editProductDisplay === 'block') {
                editform.style.display = "block"; // Hiển thị phần tử sau khi trang được tải lại
            } else {
                editform.style.display = "none"; // Mặc định ẩn phần tử
        }

        // Xóa trạng thái editProductDisplay sau khi đã sử dụng
        localStorage.removeItem('editProductDisplay');


        }
        function cancelAdd(){
            var form = document.getElementById("addProductForm");
            form.style.display = "none";
        }
        function cancelEditAdd(){
            var form = document.getElementById("editProduct");
            form.style.display = "none";
        }

    </script>
</body>

</html>