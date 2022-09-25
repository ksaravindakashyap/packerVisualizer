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
					<h4 class="page-title">All Charts</h4>
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item" aria-current="page">Dashboard <i class="ti-angle-right"></i></li>
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
						<div class="box-body">
							<h4 class="box-title">All Protocols Count</h4>
							<div id="donut-chart" style="color:#fff !important"></div>
						</div>
					</div>
				</div>
		    </div>
		    
		    <div class="col-xl-12 col-12">
					<div class="box">
						<div class="box-body">
							<h4 class="box-title">Unique Sources & Destination [ipv4 & ipv6] count</h4>
							<div id="bar-chart"></div>
						</div>
					</div>
				</div>
				
				
			<div class="col-xl-12 col-12">
					<div class="box">
						<div class="box-body">
							<div class="table-responsive">
					            <table id="example" class="table text-fade table-bordered table-hover display nowrap margin-top-10 w-p100">
						        <thead>

							        <tr class="text-dark">
							        	<th>S No.</th>
							        	<th>Source</th>
							        	<th>Destination</th>
							        	<th>Count</th>
							        </tr>
						        </thead>
						        <tbody>
							    <?php
							    $sql="SELECT * FROM `conn` WHERE `pid`='$pid' order by count DESC";
							    $res = mysqli_query($conn,$sql);
							    $i=0;
							    while($row_data=mysqli_fetch_assoc($res))
							    { ?>
							    <tr>
							        <td><?php echo ++$i;?></td>
							        <td><?php echo $row_data['source'];?></td>
							        <td><?php echo $row_data['destination'];?></td>
							        <td><?php echo $row_data['count'];?></td>
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
				
		</section>			
	
		<!-- Main content  -->
		<section class="content">			
		    <div class="row">
				<div class="col-xl-6 col-12">
					<div class="box">
						<div class="box-body">
							<h4 class="box-title">Line Chart</h4>
							<div id="line-chart"></div>
						</div>
					</div>
				</div>
				
				<div class="col-xl-6 col-12">
					<div class="box">
						<div class="box-body">
							<h4 class="box-title">Area Chart</h4>
							<div id="area-chart3"></div>
						</div>
					</div>
				</div>
				<div class="col-xl-6 col-12">
					<div class="box">
						<div class="box-body">
							<h4 class="box-title">line Chart</h4>
							<div id="area-chart"></div>
						</div>
					</div>
				</div>
				<div class="col-xl-6 col-12">
					<div class="box">
						<div class="box-body">
							<h4 class="box-title">Area Chart</h4>
							<div id="area-chart2"></div>
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
    <script src="assets/vendor_components/apexcharts-bundle/dist/apexcharts.js"></script>
	<!-- Lion Admin App -->
	<script src="src/js/demo.js"></script>
	<script src="src/js/template.js"></script>
	
	<script src="src/js/pages/widget-morris-charts.js"></script>
	
	<script>
	    Morris.Donut({
        element: 'donut-chart',
        data: [
	    <?php
	    $tot_val = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM data WHERE `pid`='$pid'"));
	    $sql_protocol="SELECT DISTINCT(protocol) FROM data WHERE `pid`='$pid'";
	    $res = mysqli_query($conn,$sql_protocol);
	    while($row=mysqli_fetch_assoc($res))
	    {
	        $prot= $row['protocol'];
	        $val=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM data WHERE `pid`='$pid' AND `protocol`='$prot'"));
	        $tp = round(($val/$tot_val)*100,2);
	        $prot.=' ('.$tp.'% )'
	        ?>
		    {
                label: "<?php echo $prot;?>",
                value: <?php echo $val;?>,
            },
        <?php
	    }?>
            ],
        resize: true,
    })

	</script>
	
	<script>
	Morris.Bar({
        element: 'bar-chart',
        data: [
        
         <?php
	    $sql_protocol="SELECT DISTINCT(source) FROM data WHERE `pid`='$pid'";
	    $res = mysqli_query($conn,$sql_protocol);
	    while($row=mysqli_fetch_assoc($res))
	    {
	        $prot= $row['source'];
	        $val1=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM data WHERE `pid`='$pid' AND `source`='$prot'"));
	        $val2=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM data WHERE `pid`='$pid' AND `destination`='$prot'"));
	       
	        
	        ?>
        
            {
                y: '<?php echo $prot;?>',
                a: <?php echo $val1;?>,
                b: <?php echo $val2;?>
            }, 
        <?php
	    }?>
            ],
        xkey: 'y',
        ykeys: ['a', 'b'],
        labels: ['As Source', 'As Destination'],
        barColors:['#fec801', '#4d7cff'],
        hideHover: 'auto',
        gridLineColor: '#eef0f2',
        resize: true
    });

</script>
	<script src="assets/vendor_components/datatable/datatables.min.js"></script>
	
	<script src="src/js/pages/data-table.js"></script>


</body>
</html>
