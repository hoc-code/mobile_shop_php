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
    // Các case xử lý cho bảng member
    case "add_member":
        $username = $_POST["username"];
        $password = $_POST["password"];
        $mname = $_POST["mname"];
        $mphone = $_POST["mphone"];
        $madd = $_POST["madd"];
        $memail = $_POST["memail"];
        $mstatus = $_POST["mstatus"];
    
        // Kiểm tra các trường thông tin bắt buộc không được để trống
        if (empty($username) || empty($password) || empty($memail) || empty($mstatus)) {
            $error_message = "Vui lòng điền đầy đủ thông tin cho các trường bắt buộc: username, password, memail, mstatus";
        } else {
            // Kiểm tra số điện thoại và email
            if (!preg_match('/^\d{10}$/', $mphone)) {
                $error_message = "Số điện thoại không hợp lệ";
            } elseif (!filter_var($memail, FILTER_VALIDATE_EMAIL) || !preg_match('/@gmail\.com$/', $memail)) {
                $error_message = "Email không hợp lệ. Vui lòng sử dụng định dạng email của Gmail.";
            } else {
                // Kiểm tra username đã tồn tại trong CSDL hay chưa
                $check_username_query = "SELECT * FROM member WHERE username='$username'";
                $check_username_result = $conn->query($check_username_query);
    
                if ($check_username_result->num_rows > 0) {
                    $error_message = "Tên người dùng $username đã tồn tại!";
                } else {
                    // Thêm thành viên mới vào CSDL
                    $insert_member_query = "INSERT INTO member (username, password, mname, mphone, madd, memail, mstatus) 
                                            VALUES ('$username', '$password', '$mname', '$mphone', '$madd', '$memail', '$mstatus')";
                    if ($conn->query($insert_member_query)) {
                        $success_message = "Thêm thành viên thành công";
                    } else {
                        $error_message = "Lỗi khi thêm thành viên: " . $conn->error;
                    }
                }
            }
        }
        if (isset($error_message)) {
            echo '<script>alert("' . $error_message . '");</script>';
        } elseif (isset($success_message)) {
            echo '<script>alert("' . $success_message . '");</script>';
        }
        break;
    
        case "edit_member":
            $mid = isset($_GET['mid']) ? $_GET['mid'] : null; 
            if (
                isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["mname"]) &&
                isset($_POST["mphone"]) && isset($_POST["madd"]) && isset($_POST["memail"]) && isset($_POST["mstatus"])
            ) {
                $username = $_POST["username"];
                $password = $_POST["password"];
                $mname = $_POST["mname"];
                $mphone = $_POST["mphone"];
                $madd = $_POST["madd"];
                $memail = $_POST["memail"];
                $mstatus = $_POST["mstatus"];
        
                // Định nghĩa regex cho số điện thoại và email
                $phoneRegex = '/^\d{10}$/'; // Regex cho số điện thoại: 10 số
                $emailRegex = '/^[a-zA-Z0-9._%+-]+@gmail\.com$/'; // Regex cho địa chỉ email
                
                $error_messages = []; // Mảng chứa thông báo lỗi
        
                // Kiểm tra điều kiện với regex
                if (!preg_match($phoneRegex, $mphone)) {
                    $error_messages[] = "Số điện thoại không hợp lệ";
                }
                if (!preg_match($emailRegex, $memail)) {
                    $error_messages[] = "Email không hợp lệ";
                }
                // Kiểm tra và xử lý lỗi
                if (count($error_messages) === 0) {
                    // Cập nhật thông tin thành viên
                    $update_member_query = "UPDATE member SET username=?, password=?, 
                                            mname=?, mphone=?, madd=?, memail=?, mstatus=?
                                            WHERE mid=?";
                    $stmt = $conn->prepare($update_member_query);
                    $stmt->bind_param("ssssssii", $username, $password, $mname, $mphone, $madd, $memail, $mstatus, $mid);
        
                    if ($stmt->execute()) {
                            $success_message = "Cập nhật thành viên thành công";
                        } $success_message = "Cập nhật thành viên thành công";
                    } else {
                        // Lỗi khi validate dữ liệu, alert errors and redirect back to form page with action and mid
                        $error_message = "Lỗi khi cập nhật thành viên:";
                        foreach ($error_messages as $error) {
                            $error_message .= '\n' . $error; // Concatenate each error message
                        }
                        echo "<script>alert('{$error_message}');</script>";
            
                        // Redirect back to form page with action and mid
                        $redirect_url = 'admin_ql_member.php?action=edit_member&mid=' . $mid;
                        echo "<script>window.location.href = '{$redirect_url}';</script>";
                        exit();
                    }
                } else {
                    $error_message = "Thiếu dữ liệu cần thiết để cập nhật thành viên";
                }
                break;   
    case "delete_member":
        $mid = $_GET["mid"];

        // Cập nhật trạng thái thành viên thành 0
        $update_member_query = "UPDATE member SET mstatus=0 WHERE mid=?";
        $stmt = $conn->prepare($update_member_query);
        $stmt->bind_param("i", $mid);

        if ($stmt->execute()) {
            $_SESSION["member_error"] = "Cập nhật trạng thái thành viên thành công";
        } else {
            $_SESSION["member_error"] = "Lỗi khi cập nhật trạng thái thành viên: " . $stmt->error;
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="admin_ql_member.css">
    <link rel="shortcut icon" href="../assets/img/zalo suopprt/cellphones.png">
    <title>Thành Viên</title>
    <link rel="stylesheet" href="admin_side_bar.css">
</head>

<body>
    <div>
    <nav class="nav1">
            <!-- <a href="admin.php"><i class="fa fa-home" aria-hidden="true"></i>Home</a> -->
            <a href="admin_ql_member.php"><i class="fa fa-user" aria-hidden="true"></i>Khách hàng</a>
            <a href="admin_ql_sanpham.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i>Sản phẩm</a>
            <a href="admin_ql_order.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i>Đơn đặt</a>
            <a href="admin_ql_doanhthu.php"><i class="fa fa-line-chart" aria-hidden="true"></i>Doanh thu</a>
            <a href="admin_ql_thongke.php"><i class="fa-solid fa-chart-simple"></i>Thống Kê</a>
            <a href="../../pages/dashboard/logout.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i>Đăng xuất</a>
    </nav>
    </div>
    <div class="content">
        <h1 align="center">Thành Viên</h1>
        <center>
        <button style="margin-bottom: 10px;" onclick="toggleForm()">Thêm mới</button>
        </center>
        <?php
        include '../connect.php';
        $num_rows = 5;
        $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
        $start = ($page - 1) * $num_rows;

        $count_query = "SELECT COUNT(*) as total FROM member";
        $count_result = $conn->query($count_query);
        $total_rows = $count_result->fetch_assoc()['total'];

        $num_of_pages = ceil($total_rows / $num_rows);

        $select_query = "SELECT * FROM member LIMIT ?, ?";
        $stmt = $conn->prepare($select_query);
        $stmt->bind_param("ii", $start, $num_rows);

        if (!$stmt->execute()) {
            die("Lỗi khi thực hiện truy vấn: " . $stmt->error);
        }

        $result = $stmt->get_result();

        echo '<table border="1" width="100%">';
        echo '<tr>';
        echo '<th>ID</th>';
        echo '<th>Username</th>';
        echo '<th>Password</th>';
        echo '<th>Full Name</th>';
        echo '<th>Phone</th>';
        echo '<th>Address</th>';
        echo '<th>Email</th>';
        echo '<th>Status</th>';
        echo '<th>Edit</th>';
        echo '<th>Delete</th>';
        echo '</tr>';

        if ($result->num_rows == 0) {
            echo "<tr><td style='color: red;' colspan='9'>No members!</td></tr>";
        } else {
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row["mid"] . '</td>';
                echo '<td>' . $row["username"] . '</td>';
                echo '<td>' . $row["password"] . '</td>';
                echo '<td>' . $row["mname"] . '</td>';
                echo '<td>' . $row["mphone"] . '</td>';
                echo '<td>' . $row["madd"] . '</td>';
                echo '<td>' . $row["memail"] . '</td>';
                echo '<td>';       
                if ($row["mstatus"] == 1) {
                    echo 'Active';
                } elseif ($row["mstatus"] == 0) {
                    echo 'Inactive';
                } else {
                    echo 'Unknown';
                }
                echo '</td>';
                // echo '<td><a href="admin_ql_member.php?mid=' . $row["mid"] . '">Edit</a> | <a href="?delete=' . $row["mid"] . '">Delete</a></td>';
                // echo '<td><a href="admin_edit_member.php?mid=' . $row["mid"] . '">Edit</a></td>';
                echo '<td><button id="editButton" onclick="toggleEdit(' . $row['mid'] . ')">Edit</button></td>';
                echo '<td><a style="background-color: red;
                padding: 10px;
                border-radius: 10px;
                text-decoration: none;
                color: #fff;
                font-weight: bold;" 
                href="?action=delete_member&mid=' . $row['mid'] . '">Delete</a></td>';
                echo '</tr>';
            }
        }

        echo '</table>';

        if (isset($_GET['delete'])) {
            $deleteId = $_GET['delete'];

            $delete_query = "DELETE FROM member WHERE mid = ?";
            $delete_stmt = $conn->prepare($delete_query);
            $delete_stmt->bind_param("i", $deleteId);

            if ($delete_stmt->execute()) {
                echo "<script>alert('Thành viên đã được xóa!');</script>";
                echo "<script>window.location.href = 'admin_ql_member.php';</script>";
            } else {
                echo "Lỗi khi xóa thành viên: " . $delete_stmt->error;
            }
        }

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
    <div id="addMemberForm" style="display: none;">
        <h2>Add New Member</h2>
        <form action="admin_ql_member.php?action=add_member" method="POST" class="flex-form" onsubmit="return validateForm()">
            <div class="form-row">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-row">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-row">
                <label for="mname">Full Name:</label>
                <input type="text" id="mname" name="mname" required>
            </div>
            <div class="form-row">
                <label for="mphone">Phone:</label>
                <input type="text" id="mphone" name="mphone" pattern="\d{10}" title="Please enter a 10-digit phone number">
            </div>
            <div class="form-row">
                <label for="madd">Address:</label>
                <input type="text" id="madd" name="madd" required>
            </div>
            <div class="form-row">
                <label for="memail">Email:</label>
                <input type="email" id="memail" name="memail" required pattern="[a-zA-Z0-9._%+-]+@gmail\.com" title="Please enter a valid Gmail address">
            </div>
            <div class="form-row">
                <label for="mstatus">Status:</label>
                
                <input type="radio" id="active" name="mstatus" value="1" checked required>
                <label for="active">Active</label>

                
                <input type="radio" id="inactive" name="mstatus" value="0">
                <label for="inactive">Inactive</label>
            </div>
            <input type="submit" value="Add Member">
        </form>
        <div class="close_button"><button style="align-items:center;" onclick="cancelAdd('addMemberForm')">Đóng form</button></div>
    </div>
    <div id="editMember" style="display: none;">    
    <?php
        // Lấy thông tin thành viên dựa trên mid
        if (isset($_GET['mid'])) {
            $edit_mid = $_GET['mid'];
            $edit_member_query = "SELECT * FROM member WHERE mid = ?";
            $stmt = $conn->prepare($edit_member_query);
            $stmt->bind_param("i", $edit_mid);
            $stmt->execute();
            $edit_result = $stmt->get_result();

            if ($edit_result->num_rows > 0) {
                $edit_row = $edit_result->fetch_assoc();
                // Lấy thông tin của thành viên để hiển thị trong form chỉnh sửa
                $edit_username = $edit_row['username'];
                $edit_password = $edit_row['password'];
                $edit_mname = $edit_row['mname'];
                $edit_mphone = $edit_row['mphone'];
                $edit_madd = $edit_row['madd'];
                $edit_memail = $edit_row['memail'];
                $edit_mstatus = $edit_row['mstatus'];
            } else {

                $edit_username = '';
                $edit_password = '';
                $edit_mname = '';
                $edit_mphone = '';
                $edit_madd = '';
                $edit_memail = '';
                $edit_mstatus = '';
            }
            $stmt->close();
        } else {
            $edit_username = '';
            $edit_password = '';
            $edit_mname = '';
            $edit_mphone = '';
            $edit_madd = '';
            $edit_memail = '';
            $edit_mstatus = '';
        }
        
        ?>
        <form action="admin_ql_member.php?action=edit_member&mid=<?php echo $edit_mid; ?>" method="POST" class="flex-form" onsubmit="return validateForm()">
             <div class="form-row">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?php echo $edit_username; ?>" required>
            </div>
            <div class="form-row">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" value="<?php echo $edit_password; ?>"required>
            </div>
            <div class="form-row">
                <label for="mname">Full Name:</label>
                <input type="text" id="mname" name="mname" value="<?php echo $edit_mname; ?>" required>
            </div>
            <div class="form-row">
                <label for="mphone">Phone:</label>
                <input type="text" id="mphone" name="mphone" value="<?php echo $edit_mphone; ?>" required>
            </div>
            <div class="form-row">
                <label for="madd">Address:</label>
                <input type="text" id="madd" name="madd" value="<?php echo $edit_madd; ?>" required>
            </div>
            <div class="form-row">
                <label for="memail">Email:</label>
                <input type="text" id="memail" name="memail" value="<?php echo $edit_memail; ?>" required>
            </div>
            <div class="form-row">
                <label for="mstatus">Status:</label>
                
                <input type="radio" id="active" name="mstatus" value="1" <?php if ($edit_mstatus == 1) echo 'checked'; ?> required>
                <label for="active">Active</label>

                
                <input type="radio" id="inactive" name="mstatus" value="0" <?php if ($edit_mstatus == 0) echo 'checked'; ?>>
                <label for="inactive">Inactive</label>
            </div>
            <input type="submit" value="Save Edit">
            
        </form>
        <div class="close_button" style="justify-content: center;"><button style="align-items:center;" onclick="cancelEditAdd('editMember')">Đóng form</button></div>
    </div>

    <script>
         function toggleForm() {
            var form = document.getElementById("addMemberForm");
            form.style.display = "block";
        }

        function toggleEdit(mid) {
            // var editform = document.getElementById("editMember");
            // editform.style.display = "block"; // Hiển thị phần tử khi nhấn nút Edit

            var currentURL = new URL(window.location.href);
            currentURL.searchParams.set('action', 'edit_action'); // Thêm action vào URL
            currentURL.searchParams.set('mid', mid); // Thêm mid vào URL

            window.history.pushState({ path: currentURL.href }, '', currentURL.href);

            // Lưu trạng thái của editMember vào localStorage
            localStorage.setItem('editMemberDisplay', 'block');

            location.reload();
        }
        window.onload = function() {
            var editMemberDisplay = localStorage.getItem('editMemberDisplay');
            var editform = document.getElementById("editMember");

            if (editMemberDisplay === 'block') {
                editform.style.display = "block"; // Hiển thị phần tử sau khi trang được tải lại
            } else {
                editform.style.display = "none"; // Mặc định ẩn phần tử
        }

        // Xóa trạng thái editMemberDisplay sau khi đã sử dụng
        localStorage.removeItem('editMemberDisplay');


        }
        function cancelAdd(){
            var form = document.getElementById("addMemberForm");
            form.style.display = "none";
        }
        function cancelEditAdd(){
            var form = document.getElementById("editMember");
            form.style.display = "none";
        }

    </script>
    
</body>

</html>
