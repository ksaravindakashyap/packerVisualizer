<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="http://lion-admin-templates.multipurposethemes.com/bs5/images/favicon.ico">

    <title>Cisco Project - Packet Analyzer</title>
  
	<!-- Vendors Style-->
	<link rel="stylesheet" href="src/css/vendors_css.css">
	  
	<!-- Style-->  
	<link rel="stylesheet" href="src/css/style.css">
	<link rel="stylesheet" href="src/css/skin_color.css">
	
</head>
<body class="hold-transition dark-skin sidebar-mini theme-primary fixed">
	
<div class="wrapper">
	<div id="loader"></div>

    <?php include 'includes/header.php';?>
    <?php include 'includes/sidebar.php';?>
  
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	  <div class="container-full">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="d-flex align-items-center">
				<div class="me-auto">
					<h4 class="page-title">Data in table</h4>
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item" aria-current="page">Raw Data <i class="ti-angle-right"></i></li>
								<li class="breadcrumb-item active" aria-current="page">
								    <?php if($pid=='Select Packet Name')
								    {
								        echo $pid.'</li>';
								    }
								    else
								    {
								        $row_pname=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM packet WHERE `id`='$pid'"));
								        echo $row_pname['name'];
								    }?>
								</li>
							</ol>
						</nav>
					</div>
				</div>
				
			</div>
		</div>
        
        
        <section class="content">
		    <div class="row">
		        <div class="col-xl-12 col-12">
					<div class="box">
				<div class="box-header with-border">
				  <h4 class="box-title"><?php echo $row_pname['name'];?> | Data Table</h4>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example" class="table text-fade table-bordered table-hover display nowrap margin-top-10 w-p100">
						<thead>

							<tr class="text-dark">
								<th>Order No.</th>
								<th>Time</th>
								<th>Source</th>
								<th>Destination</th>
								<th>Protocol</th>
								<th>Length</th>
								<th>Info</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$sql="SELECT * FROM `data` WHERE `pid`='$pid'";
							$res = mysqli_query($conn,$sql);
							while($row_data=mysqli_fetch_assoc($res))
							{ ?>
							<tr>
							    <td><?php echo $row_data['no'];?></td>
							    <td><?php echo $row_data['time'];?></td>
							    <td><?php echo $row_data['source'];?></td>
							    <td><?php echo $row_data['destination'];?></td>
							    <td><?php echo $row_data['protocol'];?></td>
							    <td><?php echo $row_data['length'];?></td>
							    <td><?php echo $row_data['info'];?></td>
							</tr>
							<?php
							}
							?>
						</tbody>	
					</table>
					</div>              
				</div>
				</div>
		    </div>
		   </div>
		</section>			
		<!-- /.content -->
	  </div>
  </div>
  <!-- /.content-wrapper -->
  
   <footer class="main-footer">
    <div class="pull-right d-none d-sm-inline-block">
        <ul class="nav nav-primary nav-dotted nav-dot-separated justify-content-center justify-content-md-end">
		  <li class="nav-item">
			<a class="nav-link" href="https://themeforest.net/item/lion-responsive-bootstrap-4-admin-dashboard-template-and-webapp-template/21335238" target="_blank">Purchase Now</a>
		  </li>
		</ul>
    </div>
	  &copy; <a href="#">Data Packet Analyzation Project Done By</a>(i) Manan Raj (ii) KS Aravinda Kashyap (iii) Vaibhavi Guptha (iv) GM Akshatha
  </footer>
  <div class="control-sidebar-bg"></div>
	
	
</div>
	
	
	<!-- Vendor JS -->
	<script src="src/js/vendors.min.js"></script>
	<script src="src/js/pages/chat-popup.js"></script>
    <script src="assets/icons/feather-icons/feather.min.js"></script>	<script src="assets/vendor_components/raphael/raphael.min.js"></script>
	<script src="assets/vendor_components/morris.js/morris.min.js"></script>

	<!-- Lion Admin App -->
	<script src="src/js/demo.js"></script>
	<script src="src/js/template.js"></script>
	
	
	<script src="assets/vendor_components/datatable/datatables.min.js"></script>
	
	<script src="src/js/pages/data-table.js"></script>
	

</body>
</html>
