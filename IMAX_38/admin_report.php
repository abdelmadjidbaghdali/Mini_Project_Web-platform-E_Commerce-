<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>IMAX Tech - Report</title>
	<?php 
	include "header.php";
	include "static/pages/side_nav.html";
	include "static/pages/admin_nav.php";
	require_once "includes/class_autoloader.php";
	
	?>

	<?php
	$dbh = new Dbhandler();
	
	$result1 = mysqli_query($dbh->conn(),"SELECT sum(orderitems.Price * orderitems.Quantity) as Amount, payment.PaymentDate FROM ((payment INNER JOIN orders on payment.OrderID=orders.OrderID)
	INNER JOIN orderitems on orders.OrderID=orderitems.OrderID)WHERE orders.CartFlag =0 and payment.PaymentDate> now() - INTERVAL 2 day and payment.PaymentDate< now() - INTERVAL 1 day");
	
	$result2 = mysqli_query($dbh->conn(),"SELECT sum(orderitems.Price * orderitems.Quantity) as Amount, payment.PaymentDate FROM ((payment INNER JOIN orders on payment.OrderID=orders.OrderID)
	INNER JOIN orderitems on orders.OrderID=orderitems.OrderID)WHERE orders.CartFlag =0 and payment.PaymentDate> now() - INTERVAL 3 day and payment.PaymentDate< now() - INTERVAL 2 day");

	$result3 = mysqli_query($dbh->conn(),"SELECT sum(orderitems.Price * orderitems.Quantity) as Amount, payment.PaymentDate FROM ((payment INNER JOIN orders on payment.OrderID=orders.OrderID)
	INNER JOIN orderitems on orders.OrderID=orderitems.OrderID)WHERE orders.CartFlag =0 and payment.PaymentDate> now() - INTERVAL 4 day and payment.PaymentDate< now() - INTERVAL 3 day");

	$result4 = mysqli_query($dbh->conn(),"SELECT sum(orderitems.Price * orderitems.Quantity) as Amount, payment.PaymentDate FROM ((payment INNER JOIN orders on payment.OrderID=orders.OrderID)
	INNER JOIN orderitems on orders.OrderID=orderitems.OrderID)WHERE orders.CartFlag =0 and payment.PaymentDate> now() - INTERVAL 5 day and payment.PaymentDate< now() - INTERVAL 4 day");

	$result5 = mysqli_query($dbh->conn(),"SELECT sum(orderitems.Price * orderitems.Quantity) as Amount, payment.PaymentDate FROM ((payment INNER JOIN orders on payment.OrderID=orders.OrderID)
	INNER JOIN orderitems on orders.OrderID=orderitems.OrderID)WHERE orders.CartFlag =0 and payment.PaymentDate> now() - INTERVAL 6 day and payment.PaymentDate< now() - INTERVAL 5 day");

	$result6 = mysqli_query($dbh->conn(),"SELECT sum(orderitems.Price * orderitems.Quantity) as Amount, payment.PaymentDate FROM ((payment INNER JOIN orders on payment.OrderID=orders.OrderID)
	INNER JOIN orderitems on orders.OrderID=orderitems.OrderID)WHERE orders.CartFlag =0 and payment.PaymentDate> now() - INTERVAL 7 day and payment.PaymentDate< now() - INTERVAL 6 day");

	$result7 = mysqli_query($dbh->conn(),"SELECT sum(orderitems.Price * orderitems.Quantity) as Amount, payment.PaymentDate FROM ((payment INNER JOIN orders on payment.OrderID=orders.OrderID)
	INNER JOIN orderitems on orders.OrderID=orderitems.OrderID)WHERE orders.CartFlag =0 and payment.PaymentDate> now() - INTERVAL 8 day and payment.PaymentDate< now() - INTERVAL 7 day");

	$result_tot = mysqli_query($dbh->conn(),"SELECT sum(orderitems.Price * orderitems.Quantity) as Amount, payment.PaymentDate FROM ((payment INNER JOIN orders on payment.OrderID=orders.OrderID)
	INNER JOIN orderitems on orders.OrderID=orderitems.OrderID)WHERE orders.CartFlag =0 and payment.PaymentDate> now() - INTERVAL 8 day and payment.PaymentDate< now() - INTERVAL 1 day");
	
	$result_month1 = mysqli_query($dbh->conn(),"SELECT sum(orderitems.Price * orderitems.Quantity) as Amount, payment.PaymentDate FROM ((payment INNER JOIN orders on payment.OrderID=orders.OrderID)
	INNER JOIN orderitems on orders.OrderID=orderitems.OrderID)WHERE orders.CartFlag =0 and payment.PaymentDate> now() - INTERVAL 30 day");

	$result_month2 = mysqli_query($dbh->conn(),"SELECT sum(orderitems.Price * orderitems.Quantity) as Amount, payment.PaymentDate FROM ((payment INNER JOIN orders on payment.OrderID=orders.OrderID)
	INNER JOIN orderitems on orders.OrderID=orderitems.OrderID)WHERE orders.CartFlag =0 and payment.PaymentDate> now() - INTERVAL 60 day and payment.PaymentDate< now() - INTERVAL 30 day");

	$result_month3 = mysqli_query($dbh->conn(),"SELECT sum(orderitems.Price * orderitems.Quantity) as Amount, payment.PaymentDate FROM ((payment INNER JOIN orders on payment.OrderID=orders.OrderID)
	INNER JOIN orderitems on orders.OrderID=orderitems.OrderID)WHERE orders.CartFlag =0 and payment.PaymentDate> now() - INTERVAL 90 day and payment.PaymentDate< now() - INTERVAL 60 day");

	$result_month_tot = mysqli_query($dbh->conn(),"SELECT sum(orderitems.Price * orderitems.Quantity) as Amount, payment.PaymentDate FROM ((payment INNER JOIN orders on payment.OrderID=orders.OrderID)
	INNER JOIN orderitems on orders.OrderID=orderitems.OrderID)WHERE orders.CartFlag =0 and payment.PaymentDate> now() - INTERVAL 90 day");
	
	$result_items0 = mysqli_query($dbh->conn(),"SELECT sum(QuantityInStock) as Quantity, Category from items where Category = 0");
	$result_items1 = mysqli_query($dbh->conn(),"SELECT sum(QuantityInStock) as Quantity, Category from items where Category = 1");
	$result_items2 = mysqli_query($dbh->conn(),"SELECT sum(QuantityInStock) as Quantity, Category from items where Category = 2");
	
	$result_user = mysqli_query($dbh->conn(),"SELECT count(MemberID) as Quantity FROM members where RegisteredDate > now() - INTERVAL 30 day and RegisteredDate < now() - INTERVAL 1 day")
	?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

<style>
	.table {
		color:white;
		font-size:24px;
		text-align:center;
		width:1000px;
		margin:50px 100px;
	}
	
	th {
		font-size:32px;
	}
</style>
</head>

<body>

<div class="container" style="margin-top:150px">
	<div class="row" id="order" name="order">
	
	
	
	<div class="row" id="product" name="product"></div>
	<h3 class="page-title">Items report</h3>
	<div class="rounded-card-parent center" style="margin-bottom:20px">
		<h5 style="color:white">Items pie chart</h5>
		<p style="color:white">Quantity of stock in each category</p>
		
		<!--result_items0-->
		<?php
			while ($row=mysqli_fetch_array($result_items0)) {
				$category0 = "PC Packages";
				$quantity0 = $row['Quantity'];
			}
			
			if(is_null($quantity0)) {
				$quantity0 = 0;
			}
		?>
		
		<!--result_items1-->
		<?php
			while ($row=mysqli_fetch_array($result_items1)) {
				$category1 = "Monitor & Audio";
				$quantity1 = $row['Quantity'];
			}
			
			if(is_null($quantity1)) {
				$quantity1 = 0;
			}
		?>
		
		<!--result_items2-->
		<?php
			while ($row=mysqli_fetch_array($result_items2)) {
				$category2 = "Peripherals";
				$quantity2 = $row['Quantity'];
			}
			
			if(is_null($quantity2)) {
				$quantity2 = 0;
			}
		?>
		<table class="table">
		<tr>
			<th>Category</th>
			<th>Quantity</th>
		</tr>
		<tr>
			<td><?php echo $category0?></td>
			<td><?php echo $quantity0?></td>
		</tr>
		<tr>
			<td><?php echo $category1?></td>
			<td><?php echo $quantity1?></td>
		</tr>
		<tr>
			<td><?php echo $category2?></td>
			<td><?php echo $quantity2?></td>
		</tr>
		</table>
	</div>
	<br><br><br>

</div>
<script>
var amt = [<?php echo $amt7 = number_format((float)$amt7, 2, '.', '');?>,
<?php echo $amt6 = number_format((float)$amt6, 2, '.', '');?>,
<?php echo $amt5 = number_format((float)$amt5, 2, '.', '');?>,
<?php echo $amt4 = number_format((float)$amt4, 2, '.', '');?>,
<?php echo $amt3 = number_format((float)$amt3, 2, '.', '');?>,
<?php echo $amt2 = number_format((float)$amt2, 2, '.', '');?>,
<?php echo $amt1 = number_format((float)$amt1, 2, '.', '');?>,];

var date = [<?php echo json_encode($date7);?>,<?php echo json_encode($date6);?>,<?php echo json_encode($date5);?>
,<?php echo json_encode($date4);?>,<?php echo json_encode($date3);?>,<?php echo json_encode($date2);?>
,<?php echo json_encode($date1);?>];

var xValues = date;
var yValues = amt;

new Chart("myChart", {
	type: "line",
	data: {
		labels: xValues,
		datasets: [{
			fill: false,
			lineTension: 0,
			backgroundColor: "rgba(0,255,0,1)",
			borderColor: "rgba(0,255,255,0.4)",
			data: yValues
		}]
	},
	options: {
		responsive: true,
		maintainAspectRatio: false,
		legend: {display: false},
		scales: {
			yAxes: [{
				gridLines: {
					display: true,
					color: "rgba(0,255,0,0.4)",
				},
				ticks: {
					fontColor: "#00ffd0",
					fontSize: 18,
					beginAtZero: true
				}
			}],
			xAxes: [{
				gridLines: {
					display: true,
					color: "rgba(0,255,0,0.4)",
				},
				ticks: {
					fontColor: "#00ffd0",
					fontSize: 18,
				}
			}],
		}
	}
});

var date2 = [<?php echo json_encode($date_m3);?>,<?php echo json_encode($date_m2);?>,<?php echo json_encode($date_m1);?>];
var amt2 = [<?php echo $amt_m3 = number_format((float)$amt_m3, 2, '.', '');?>,<?php echo $amt_m2 = number_format((float)$amt_m2, 2, '.', '');?>,<?php echo $amt_m1 = number_format((float)$amt_m1, 2, '.', '');?>];

var xValues_m = date2;
var yValues_m = amt2;
var barColors = "rgba(0,255,0,0.8)";

new Chart("myChart2", {
	type: "bar",
	data: {
		labels: xValues_m,
		datasets: [{
		backgroundColor: barColors,
		data: yValues_m
		}]
	},
	options: {
		responsive: true,
		maintainAspectRatio: false,
		legend: {display: false},
		scales: {
			yAxes: [{
				gridLines: {
					display: true,
					color: "rgba(0,255,0,0.4)",
				},
				ticks: {
					fontColor: "#00FFd0",
					fontSize: 18,
					beginAtZero: true,
				}
			}],
			xAxes: [{
				gridLines: {
					display: true,
					color: "rgba(0,255,0,0.4)",
				},
				ticks: {
					fontColor: "#00FFd0",
					fontSize: 18,
				}
			}],
		}
	}
});

var cate = ["<?php echo $category0?>","<?php echo $category1?>","<?php echo $category2?>"];
var quan = [<?php echo $quantity0?>,<?php echo $quantity1?>,<?php echo $quantity2?>];

var xValues_items = cate;
var yValues_items = quan;
var barColors2 = ["#ff7700","#00ffd0","#00ccff"]

new Chart("myChart3", {
	type: "pie",
	data: {
		labels: xValues_items,
		datasets: [{
		backgroundColor: barColors2,
		data: yValues_items
		}]
	},
	options: {
		responsive: true,
		maintainAspectRatio: false,
		title:{
			display:false,
			text: "Quantity of stock in each category"
		}
	}
});

var quan_u = [<?php echo $quantity_user?>];

var xValues_u = ["New Sign Ups"];
var yValues_u = quan_u;

new Chart("myChart4", {
	type: "bar",
	data: {
		labels: xValues_u,
		datasets: [{
		backgroundColor: barColors,
		data: yValues_u
		}]
	},
	options: {
		responsive: true,
		maintainAspectRatio: false,
		legend: {display: false},
		scales: {
			yAxes: [{
				gridLines: {
					display: true,
					color: "rgba(0,255,0,0.4)",
				},
				ticks: {
					max: 60,
					fontColor: "#00FFd0",
					fontSize: 18,
					beginAtZero: true,
				}
			}],
			xAxes: [{
				gridLines: {
					display: true,
					color: "rgba(0,255,0,0.4)",
				},
				ticks: {
					fontColor: "#00FFd0",
					fontSize: 18,
				}
			}],
		}
	}
});
</script>
</body>
 <?php include "footer.php"; ?>
</html>