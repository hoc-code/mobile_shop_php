<?php
require("connect.php");
$keyword = $_REQUEST["keyword"];
$sql = "SELECT * FROM product WHERE pname LIKE '%" . $keyword . "%'";
$result = $conn->query($sql) or die($conn->error);
?>
<link rel="stylesheet" href="../../css/style.css">
<div class="list_cate">
	<?php
	while ($row = $result->fetch_assoc()) {
		$safeProductName = urlencode($row["pname"]);
		$productDetailURL = '../detail/product_detail.php?pname=' . $safeProductName;

		echo '<a href="' . $productDetailURL . '">';
		echo '<div class="wrapper">';
		echo $row["pname"];
		echo '</div></a>';
	}
	$conn->close();
	?>
</div>

