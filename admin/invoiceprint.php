<html>

<head>
	<meta charset="utf-8">
	<title>Invoice</title>
	<link rel="stylesheet" href="style.css">
	<link rel="license" href="https://www.opensource.org/licenses/mit-license/">
	<script src="script.js"></script>
	<style>
		/* reset */

		/* Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Body styles */
body {
    font-family: Arial, sans-serif;
    background-color: #f9f9f9;
    padding: 20px;
    height: 14in; /* Adjust the height as needed */
}

/* Header styles */
header {
    text-align: center;
    margin-bottom: 20px;
}

header h1 {
    font-size: 24px;
    color: #333;
    margin-bottom: 10px;
    background-color: #000;
    padding: 10px;
    border-radius: 5px;
    color: #fff;
}

header address {
    font-size: 14px;
    color: #666;
}

/* Article styles */
article {
    margin-bottom: 20px;
}

article h1 {
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 10px;
}

article address {
    font-size: 14px;
    color: #666;
    margin-bottom: 20px;
}

/* Table styles */
table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

table th,
table td {
    border: 1px solid #ddd;
    padding: 8px;
}

table th {
    background-color: #f2f2f2;
    font-weight: bold;
    text-align: left;
}

/* Balance table styles */
.balance {
    float: right;
    width: 40%;
}

.balance th,
.balance td {
    text-align: right;
}

/* Aside styles */
aside {
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

aside h1 {
    font-size: 18px;
    color: #333;
    margin-bottom: 10px;
}

aside p {
    font-size: 14px;
    color: #666;
    text-align: center;
}
@page {
    size: 8.5in 14in; /* Adjust the height to match body height */
    margin: 20mm; /* Adjust margins as needed */
}
	</style>

</head>

<body>


	<?php
	ob_start();
	include '../config.php';

	$id = $_GET['id'];

	$sql = "select * from payment where id = '$id' ";
	$re = mysqli_query($conn, $sql);
	while ($row = mysqli_fetch_array($re)) {
		$id = $row['id'];
		$Name = $row['Name'];
		$troom = $row['RoomType'];
		$bed = $row['Bed'];
		$nroom = $row['NoofRoom'];
		$cin = $row['cin'];
		$cout = $row['cout'];
		$meal = $row['meal'];
		$ttot = $row['roomtotal'];
		$mepr = $row['mealtotal'];
		$btot = $row['bedtotal'];
		$fintot = $row['finaltotal'];
		$days = $row['noofdays'];
	}

	$type_of_room = 0;
	if ($troom == "Superior Room") {
		$type_of_room = 320;
	} else if ($troom == "Deluxe Room") {
		$type_of_room = 220;
	} else if ($troom == "Guest House") {
		$type_of_room = 180;
	} else if ($troom == "Single Room") {
		$type_of_room = 150;
	}

	if ($bed == "Single") {
		$type_of_bed = $type_of_room * 1 / 100;
	} else if ($bed == "Double") {
		$type_of_bed = $type_of_room * 2 / 100;
	} else if ($bed == "Triple") {
		$type_of_bed = $type_of_room * 3 / 100;
	} else if ($bed == "Quad") {
		$type_of_bed = $type_of_room * 4 / 100;
	} else if ($bed == "None") {
		$type_of_bed = $type_of_room * 0 / 100;
	}

	if ($meal == "Room only") {
		$type_of_meal = $type_of_bed * 0;
	} else if ($meal == "Breakfast") {
		$type_of_meal = $type_of_bed * 2;
	} else if ($meal == "Half Board") {
		$type_of_meal = $type_of_bed * 3;
	} else if ($meal == "Full Board") {
		$type_of_meal = $type_of_bed * 4;
	}

	?>
	<header>
		<h1>Invoice</h1>
		<address>
			<p>ISEKAI INN,</p>
			<p>(+91) 9313346569</p>
		</address>
		<span><img alt="" src="../image/sekai.png"></span>
	</header>
	<article>
		<h1>Recipient</h1>
		<address>
			<p><?php echo $Name ?> <br></p>
		</address>
		<table class="meta">
			<tr>
				<th><span>Invoice #</span></th>
				<td><span><?php echo $id; ?></span></td>
			</tr>
			<tr>
				<th><span>Date</span></th>
				<td><span><?php echo $cout; ?> </span></td>
			</tr>

		</table>
		<table class="inventory">
			<thead>
				<tr>
					<th><span>Item</span></th>
					<th><span>No of Days</span></th>
					<th><span>Rate</span></th>
					<th><span>Quantity</span></th>
					<th><span>Price</span></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><span><?php echo $troom; ?></span></td>
					<td><span><?php echo $days; ?> </span></td>
					<td><span data-prefix>₱</span><span><?php echo $type_of_room; ?></span></td>
					<td><span><?php echo $nroom; ?> </span></td>
					<td><span data-prefix>₱</span><span><?php echo $ttot; ?></span></td>
				</tr>
				<tr>
					<td><span><?php echo $bed; ?> Bed </span></td>
					<td><span><?php echo $days; ?></span></td>
					<td><span data-prefix>₱</span><span><?php echo $type_of_bed; ?></span></td>
					<td><span><?php echo $nroom; ?> </span></td>
					<td><span data-prefix>₱</span><span><?php echo $btot; ?></span></td>
				</tr>
				<tr>
					<td><span><?php echo $meal; ?> </span></td>
					<td><span><?php echo $days; ?></span></td>
					<td><span data-prefix>₱</span><span><?php echo $type_of_meal ?></span></td>
					<td><span><?php echo $nroom; ?> </span></td>
					<td><span data-prefix>₱</span><span><?php echo $mepr; ?></span></td>
				</tr>
			</tbody>
		</table>

		<table class="balance">
			<tr>
				<th><span>Total</span></th>
				<td><span data-prefix>₱</span><span><?php echo $fintot; ?></span></td>
			</tr>
			<tr>
				<th><span>Amount Paid</span></th>
				<td><span data-prefix>₱</span><span><?php echo $fintot; ?></span></td>
			</tr>
			<tr>
				<th><span>Balance Due</span></th>
				<td><span data-prefix>₱</span><span>0.00</span></td>
			</tr>
		</table>
	</article>
	<aside>
		<h1><span>Contact us</span></h1>
		<div>
			<p align="center">Email : isekaiinn@gmail.com || Web : www.isekaiinn.com || Phone : +91 9313346569 </p>
		</div>
	</aside>

</body>

</html>

<?php

ob_end_flush();

?>