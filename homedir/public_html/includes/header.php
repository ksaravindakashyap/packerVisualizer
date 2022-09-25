<?php

include 'includes/config.php';
session_start();
if(isset($_POST['name']))
{
    $name= $_POST['name'];
    $sql = "INSERT INTO packet(`name`) VALUES ('$name')";
    mysqli_query($conn,$sql);
    
    $row=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM packet WHERE `name`='$name' order by id DESC"));
    
    $pid = $row['id'];
    
    if($_FILES['file']['name']!='')
    {
        $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
        fgetcsv($csvFile);
        while (($getData = fgetcsv($csvFile, 10000, ",")) !== FALSE)
        {
            $no=$getData[0];
            $time=$getData[1];
            $source=$getData[2];
            $destination=$getData[3];
            $protocol=$getData[4];
            $length=$getData[5];
            $info=$getData[6];
            
            mysqli_query($conn,"INSERT INTO data(`pid`,`no`,`time`,`source`,`destination`,`protocol`,`length`,`info`) VALUES ('$pid','$no','$time','$source','$destination','$protocol','$length','$info')");
        }
    }
}

$pid='';

if(isset($_POST['pid']))
{
    $_SESSION['pid']=$_POST['pid'];
    $pid=$_SESSION['pid'];
    $unique_source = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM conn WHERE `pid`='$pid'"));
    if($unique_source==0)
    {
        $res_source = mysqli_query($conn,"SELECT DISTINCT `source` AS ds FROM data WHERE `pid`='$pid'");
        
        
        while($row_s = mysqli_fetch_assoc($res_source))
        {
            $res_destination = mysqli_query($conn,"SELECT DISTINCT `destination` AS dd FROM data WHERE `pid`='$pid'");
            $s= $row_s['ds'];
            while($row_d = mysqli_fetch_assoc($res_destination))
            {
                $d= $row_d['dd'];
                $count = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM data WHERE `source`='$s' AND `destination`='$d'"));
                mysqli_query($conn,"INSERT INTO `conn`(`pid`,`source`,`destination`,`count`) VALUES ('$pid','$s','$d','$count')");
            }
        }
        mysqli_query($conn,"DELETE FROM `conn` WHERE `count`=0");
    }
    
}

$pid=$_SESSION['pid'];
?>


<div id="standard-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="standard-modalLabel">Modal Heading</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
			</div>
			<div class="modal-body">
				<form method="post" enctype="multipart/form-data">
				    <input type="text" class="form-control" placeholder="Packet Name" name="name" style="background-color: #24243E;color: #a1a4b5;">
				    <br>
				    <p>Upload Packet File (.csv)</p>
				    <input type="file" name="file" class="form-control">
				
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Upload Packet</button>
				</form>
				<button type="button" class="btn btn-light" data-bs-dismiss="modal" style="float:right">Close</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>
 <header class="main-header">
	<div class="d-flex align-items-center logo-box justify-content-start">	
		<!-- Logo -->
		<a href="dashboard" class="logo">
		  <!-- logo-->
		  <div class="logo-mini w-40">
			  <span class="light-logo"><img src="https://www.clipartmax.com/png/middle/200-2001206_cisco-cisco-high-res-logo.png" alt="logo"></span>
			  <span class="dark-logo"><img src="https://www.clipartmax.com/png/middle/200-2001206_cisco-cisco-high-res-logo.png" alt="logo"></span>
		  </div>
		  <div class="logo-lg">
			  <span class="light-logo" style="color:#fff">Packet Analyzer</span>
			  <span class="dark-logo" style="color:#fff">Packet Analyzer</span>
		  </div>
		</a>	
	</div>   
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
	  <div class="app-menu">
		<ul class="header-megamenu nav">
			<li class="btn-group nav-item">
				<a href="#" class="waves-effect waves-light nav-link push-btn btn-primary-light" data-toggle="push-menu" role="button">
					<i data-feather="menu"></i>
			    </a>
			</li>
			<li class="btn-group d-lg-inline-flex d-none">
				<div class="app-menu">
					<div class="search-bx mx-6">
						<form method="post" id="change_packet">
							<div class="input-group">
							  <select class="form-control" style="width:212px;height:40px;background-color: #24243E;color: #a1a4b5;" name="pid" onchange="change_packet()">
							            <option>Select Packet Name</option>
							      <?php
							      $sql="SELECT * FROM packet order by id desc";
							      
							      if($pid=='')
							      {
							          $res = mysqli_query($conn,$sql);
							          $row_name=mysqli_fetch_assoc($res);
	                                  $pid= $row_name['id'];
	                                  $_SESSION['pid']=$pid;
							      }
							      $res = mysqli_query($conn,$sql);
							      while($row_name=mysqli_fetch_assoc($res))
							      {?>
							            <option value="<?php echo $row_name['id'];?>" <?php if($row_name['id']==$pid){echo "selected";}?>><?php echo $row_name['name'];?> (<?php echo $row_name['upload_time'];?>)</option>
							      <?php
							      } ?>
							      ?>
							  </select>
							  <div class="input-group-append">
								<span class="form-control" style="background-color: #24243E;color: #a1a4b5;"><i class="ti-angle-down"><span class="path1"></span><span class="path2"></span></i></span>
							  </div>
							</div>
						</form>
					</div>
				</div>
			</li>
		</ul> 
	  </div>
	    
	   
	  <script>
	      function change_packet()
	      {
	          document.getElementById("change_packet").submit();
	      }
	  </script>
      <div class="navbar-custom-menu r-side">
        <ul class="nav navbar-nav">
			<li class="btn-group d-md-inline-flex d-none">
              <a href="javascript:void(0)" title="skin Change" class="waves-effect skin-toggle waves-light">
			  	<label class="switch">
					<input type="checkbox" data-mainsidebarskin="toggle" id="toggle_left_sidebar_skin">
					<span class="switch-on"><i data-feather="moon"></i></span>
					<span class="switch-off"><i data-feather="sun"></i></span>
				</label>
			  </a>				
            </li>
			
		
			
			<li class="btn-group nav-item d-xl-inline-flex d-none">
				<a href="#" data-provide="fullscreen" class="waves-effect waves-light nav-link btn-primary-light svg-bt-icon" title="Full Screen">
					<i data-feather="maximize"></i>
			    </a>
			</li>					  
          <!-- Control Sidebar Toggle Button -->
          <li class="btn-group nav-item d-xl-inline-flex d-none">
               <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#standard-modal">Upload Packets</button>
          </li>
	
        </ul>
      </div>
    </nav>
  </header>