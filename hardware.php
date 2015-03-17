
<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	
	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>Probact</title>
	<meta name="description" content="Bootstrap Metro Dashboard">
	<meta name="author" content="TJ Mad">
	<meta name="keyword" content="Teej Eshwar Madhan">
	<!-- end: Meta -->
	
	<!-- start: Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- end: Mobile Specific -->
	
	<!-- start: CSS -->
	<link id="bootstrap-style" href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
	<link id="base-style" href="css/style.css" rel="stylesheet">
	<link id="base-style-responsive" href="css/style-responsive.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>
	<!-- end: CSS -->
	

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<link id="ie-style" href="css/ie.css" rel="stylesheet">
	<![endif]-->
	
	<!--[if IE 9]>
		<link id="ie9style" href="css/ie9.css" rel="stylesheet">
	<![endif]-->
		
	<!-- start: Favicon -->
	<link rel="shortcut icon" href="img/favicon.ico">
	<!-- end: Favicon -->
	
		
		
		
</head>

<body>
		<!-- start: Header -->
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="index1.php"><span>ProbAct</span></a>
								
				<!-- start: Header Menu -->
				<div class="nav-no-collapse header-nav">
					<ul class="nav pull-right">
						<li class="dropdown hidden-phone">
							<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
								
						<!-- start: User Dropdown -->
						<li class="dropdown">
							<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
								<i class="halflings-icon white user"></i> 
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li class="dropdown-menu-title">
 									<span>Account Settings</span>
								</li>
								<li><a href="#"><i class="halflings-icon user"></i> Profile</a></li>
								<li><a href="logoutOrg.php"><i class="halflings-icon off"></i> Logout</a></li>
							</ul>
						</li>
						<!-- end: User Dropdown -->
					</ul>
				</div>
				<!-- end: Header Menu -->
				
			</div>
		</div>
	</div>
	<!-- start: Header -->
	
		<div class="container-fluid-full">
		<div class="row-fluid">
				
			<!-- start: Main Menu -->
			<div id="sidebar-left" class="span2">
				<div class="nav-collapse sidebar-nav">
					<ul class="nav nav-tabs nav-stacked main-menu">
						<li><a href="index1.php"><i class="icon-bar-chart"></i><span class="hidden-tablet"> Dashboard</span></a></li>	
					
						<li>
							<a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Dropdown</span><span class="label label-important"> 3 </span></a>
							<ul>
								<li><a class="submenu" href="#"><i class="icon-file-alt"></i><span class="hidden-tablet">Hardware</span></a></li>
								<li><a class="submenu" href="software.php"><i class="icon-file-alt"></i><span class="hidden-tablet"> Software</span></a></li>
								<li><a class="submenu" href="ispnew.php"><i class="icon-file-alt"></i><span class="hidden-tablet">ISP</span></a></li>
							</ul>	
						</li>
					
						<li><a href="charts/frame1.html"><i class="icon-list-alt"></i><span class="hidden-tablet"> Charts</span></a></li>
				
					</ul>
				</div>
			</div>
			<!-- end: Main Menu -->
			
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			
			<!-- start: Content -->
			<div id="content" class="span10">
			
			
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="index1.php">Home</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li><a href="#">Hardware</a></li>
			</ul>

			<div class="row-fluid">
			<?php

include('Net/SSH2.php');
$ssh = new Net_SSH2($_SESSION['ip']);
$ssh->login($_SESSION['name'], $_SESSION['pwd']);
echo "Server Name ";
echo "<br>";
echo "<pre>";
$str=$ssh->exec('cat /proc/version');
if (strpos($str,'Red Hat') == true) {
   // echo 'true';

echo $str;
echo $ssh->exec('uname -a');
echo "</pre>";
echo "<br>";

echo "CPU Short Desc:";
$str=$ssh->exec('lscpu');
echo "<pre>";
echo $str;
echo "</pre>";


$myfile = fopen("logfiles/arch.txt", "w") or die("Unable to open file!");
fwrite($myfile,$str. PHP_EOL);


fclose($myfile);




echo "Partitions and Disk Space:";
echo "<pre>";
echo $ssh->exec('df -h');
echo "</pre>";
echo "<br>";



/**echo "Hardware O Full Info:";
echo "<pre>";
echo $ssh->exec('hwinfo --short');
echo "</pre>";
echo "<br>";
**/


echo "Distribution:";
echo "<pre>";
echo $ssh->exec('cat /etc/*-release');
echo "</pre>";
echo "<br>";
echo "Distribution Desc:";
echo "<pre>";
echo $ssh->exec('lsb_release -a');
echo "</pre>";
echo "<br>";

echo "<pre>";
$str=$ssh->exec('dmidecode');

$arr=explode("\n",$str);
echo $arr[37];
echo "<br>";
echo $arr[38];
echo "<br>";
echo $arr[39];
echo "<br>";
echo $arr[40];
echo "<br>";
echo $arr[41];
echo "<br>";
echo $arr[42];
echo "<br>";
echo $arr[43];
echo "<br>";
echo $arr[44];
echo "<br>";
echo $arr[45];
echo "<br>";
echo $arr[46];
echo "<br>";
echo "</pre>";
}
else
{
$str=strtolower($str);
if(strpos($str,'cannot')==true)
{
$str=$ssh->exec('cat /etc/release');
}
$str=strtolower($str);
if(strpos($str,'solaris')==true)
{
//echo "Loaded For Solaris<br/> ";
echo $ssh->exec('uname -a');
echo "</pre>";
echo "<br>";

echo "CPU Desc:";
$str=$ssh->exec('prtconf');
echo "<pre>";
echo $str;
echo "</pre>";


$myfile = fopen("logfiles/arch.txt", "w") or die("Unable to open file!");
fwrite($myfile,$str. PHP_EOL);


fclose($myfile);




echo "Partitions and Disk Space:";
echo "<pre>";
echo $ssh->exec('df -h');
echo "</pre>";
echo "<br>";



/**echo "Hardware O Full Info:";
echo "<pre>";
echo $ssh->exec('hwinfo --short');
echo "</pre>";
echo "<br>";
**/


echo "Distribution:";
echo "<pre>";
echo $ssh->exec('cat /etc/release');
echo "</pre>";
echo "<br>";
/***echo "Distribution Desc:";
echo "<pre>";
echo $ssh->exec('lsb_release -a');
echo "</pre>";*/
echo "<br>";

//echo "<pre>";
//$str=$ssh->exec('smbios');

//$arr=explode("\n",$str);
//print_r($str);
/*echo $arr[37];
echo "<br>";
echo $arr[38];
echo "<br>";
echo $arr[39];
echo "<br>";
echo $arr[40];
echo "<br>";
echo $arr[41];
echo "<br>";
echo $arr[42];
echo "<br>";
echo $arr[43];
echo "<br>";
echo $arr[44];
echo "<br>";
echo $arr[45];
echo "<br>";
echo $arr[46];
echo "<br>";
echo "</pre>";

*/
	//echo "Oops.. ! not Red hat Distro...";
}
}
?>
				
				
			
			
			
				
			
       

	</div><!--/.fluid-container-->
	
			<!-- end: Content -->
		</div><!--/#content.span10-->
		</div><!--/fluid-row-->
		
	<div class="modal hide fade" id="myModal">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Settings</h3>
		</div>
		<div class="modal-body">
			<p>Here settings can be configured...</p>
		</div>
		<div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal">Close</a>
			<a href="#" class="btn btn-primary">Save changes</a>
		</div>
	</div>
	
	<div class="clearfix"></div>
	
	<footer>

		<p>
			<span style="text-align:left;float:left">&copy; 2015 <a href="www.ericsson.com" alt="Bootstrap_Metro_Dashboard">Ericsson</a></span>
			
		</p>

	</footer>
	
	<!-- start: JavaScript-->

		<script src="js/jquery-1.9.1.min.js"></script>
	<script src="js/jquery-migrate-1.0.0.min.js"></script>
	
		<script src="js/jquery-ui-1.10.0.custom.min.js"></script>
	
		<script src="js/jquery.ui.touch-punch.js"></script>
	
		<script src="js/modernizr.js"></script>
	
		<script src="js/bootstrap.min.js"></script>
	
		<script src="js/jquery.cookie.js"></script>
	
		<script src='js/fullcalendar.min.js'></script>
	
		<script src='js/jquery.dataTables.min.js'></script>

		<script src="js/excanvas.js"></script>
	<script src="js/jquery.flot.js"></script>
	<script src="js/jquery.flot.pie.js"></script>
	<script src="js/jquery.flot.stack.js"></script>
	<script src="js/jquery.flot.resize.min.js"></script>
	
		<script src="js/jquery.chosen.min.js"></script>
	
		<script src="js/jquery.uniform.min.js"></script>
		
		<script src="js/jquery.cleditor.min.js"></script>
	
		<script src="js/jquery.noty.js"></script>
	
		<script src="js/jquery.elfinder.min.js"></script>
	
		<script src="js/jquery.raty.min.js"></script>
	
		<script src="js/jquery.iphone.toggle.js"></script>
	
		<script src="js/jquery.uploadify-3.1.min.js"></script>
	
		<script src="js/jquery.gritter.min.js"></script>
	
		<script src="js/jquery.imagesloaded.js"></script>
	
		<script src="js/jquery.masonry.min.js"></script>
	
		<script src="js/jquery.knob.modified.js"></script>
	
		<script src="js/jquery.sparkline.min.js"></script>
	
		<script src="js/counter.js"></script>
	
		<script src="js/retina.js"></script>

		<script src="js/custom.js"></script>
	<!-- end: JavaScript-->
	
</body>
</html>
