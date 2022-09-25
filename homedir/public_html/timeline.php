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
	
    <link rel="stylesheet" href="https://sitsark.in/assets/css/timeline.css">
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
					
				</div>
				
			</div>
		</div>
        <script>
            function fun()
            {
                document.getElementById("form").submit();
            }
        </script>
        <?php
        $source=$_POST['source'];
        $destination=$_POST['destination'];
        if($_GET['pg_no']=='')
        $off=0;
        else
        $off=$_GET['pg_no'];
        ?>
        <section>
		    <div class="row">
		    <div class="col-xl-12 col-12">
				<div class="box">
				<div class="box-header with-border">
				    <?php $row_pname=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM packet WHERE `id`='$pid'"));?>
				  <h4 class="box-title"><?php echo $row_pname['name'];?> | Information Timeline</h4>
				  <br>
				  
				  <form method="POST" style="margin-top:4px" id="form">
				      
				      
				      <select name="source" style="background-color:grey;color:#fff" class="form-control" onchange="fun()">
				          <option value="">Select Source</option>
				          <?php $res=mysqli_query($conn,"SELECT DISTINCT(source) FROM data WHERE `pid`='$pid'");
				          while($row=mysqli_fetch_assoc($res))
				          {?>
				          <option value="<?php echo $row['source'];?>"  <?php if($source==$row['source']) echo 'selected';?>><?php echo $row['source'];?></option>
				          <?php
				          }?>
				      </select>
				      
				      <select name="destination" style="margin-top:4px;background-color:grey;color:#fff" class="form-control" onchange="fun()">
				          <option value="">Select Destination</option>
				          <?php $res=mysqli_query($conn,"SELECT DISTINCT(destination) FROM data WHERE `pid`='$pid'");
				          while($row=mysqli_fetch_assoc($res))
				          {?>
				          <option value="<?php echo $row['destination'];?>" <?php if($destination==$row['destination']) echo 'selected';?>><?php echo $row['destination'];?></option>
				          <?php
				          }?>
				      </select>
				  </form>
				  
				</div>
				<!-- /.box-header -->
				<div class="box-body">
				    <?php 
				    $sql = "SELECT * FROM `data` WHERE `pid`='$pid' and `source`='$source' and `destination`='$destination' limit 20 offset $off";
				    $res = mysqli_query($conn,$sql);
				    $c= mysqli_num_rows($res);
				    if($c>0)
				    {
				        $side='left';
				        echo '<div class="timeline"  style="color: black;">';
				        while($row=mysqli_fetch_assoc($res))
				        {
				    ?>
				            
                                <div class="timeline-container <?php echo $side;?>">
                                    <div class="content">
                                        <p>
                                            <?php 
                                            $did=$row['id'];
                                            $t=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM data WHERE `id`>$did limit 1"));
                                            $t = $t['time'];
                                            $t = $t-$row['time'];?>
                                            <b>Protocol :</b> <?php echo $row['protocol'];?><br>
                                            <b>Time of connection : </b> <?php echo $t;?><br>
                                            <b>Length : </b> <?php echo $row['length'];?><br>
                                            <b>Info : </b> <?php echo $row['info'];?>
                                        </p>
                                    </div>
                                </div>
                                
				            
				    <?php
				            if($side=='left')
				            $side = 'right';
				            else
				            $side = 'left';
				        }
				        echo '</div>';
				    }
				    else
				    {?>
				    <h2 style="color:#fff">No data transmission between these two source and destination</h2>
				    <?php
				    } ?>
				    <form method="POST" style="margin-top:4px">
				      
				      <input type="hidden" name="source" value="<?php echo $source;?>">
				      <input type="hidden" name="destination" value="<?php echo $destination;?>">
				      
				      
				      
				  </form>
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
    <script src="assets/icons/feather-icons/feather.min.js"></script>	
    <script src="assets/vendor_components/raphael/raphael.min.js"></script>
	<script src="assets/vendor_components/morris.js/morris.min.js"></script>

	<!-- Lion Admin App -->
	<script src="src/js/demo.js"></script>
	<script src="src/js/template.js"></script>
	
	<script type="text/javascript" src="https://sitsark.in/assets/js/timeline.js"></script>
	
	<script src="assets/vendor_components/datatable/datatables.min.js"></script>
	
	<script src="src/js/pages/data-table.js"></script>
	

</body>
</html>
