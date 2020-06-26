<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
		<title>User Access Control</title>
		<!-- General CSS Files -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
		
		<!-- CSS Libraries -->
		<link rel="stylesheet" href="../assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
		<link rel="stylesheet" href="../assets/node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css">
		<link rel="stylesheet" href="../assets/node_modules/izitoast/css/iziToast.min.css">
		<link rel="stylesheet" href="../assets/node_modules/select2/css/select2.min.css">
		<!-- Template CSS -->
		<link rel="stylesheet" href="../assets/css/style.css">
		<link rel="stylesheet" href="../assets/css/components.css">
		<style>
			.gradient  {
				color:white !important;
				background: linear-gradient(to right, #6676ee 0%, #6777ef 100%);
			}
			
			.se-pre-con {
				position: fixed;
				left: 0px;
				top: 0px;
				width: 100%;
				height: 100%;
				z-index: 9999;
				background: url("./assets/img/loading.gif") center no-repeat #fff;
			}

			.button-wrapper {
				position: relative;
				width: 150px;
				text-align: center;
				margin: 10% auto;
			}
			
			.button-wrapper span.label {
				position: relative;
				z-index: 0;
				display: inline-block;
				width: 100%;
				background: #00bfff;
				cursor: pointer;
				color: #fff;
				padding: 10px 0;
				text-transform:uppercase;
				font-size:12px;
			}

			#upload {
				display: inline-block;
				position: absolute;
				z-index: 1;
				width: 100%;
				height: 50px;
				top: 0;
				left: 0;
				opacity: 0;
				cursor: pointer;
			}
		</style>
	</head>
	
	<body>
		<div class="se-pre-con"></div>
		<div id="app">
			<div class="main-wrapper">
				<div class="navbar-bg"></div>
				<nav class="navbar navbar-expand-lg main-navbar">
					<form class="form-inline mr-auto">
						<ul class="navbar-nav mr-3">
							<li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
						</ul>
					</form>
					<ul class="navbar-nav navbar-right">
						<li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
							<img alt="image" src="../assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
							<div class="d-sm-none d-lg-inline-block">Hi, Ujang Maman</div></a>
							<div class="dropdown-menu dropdown-menu-right">
								<div class="dropdown-title">Logged in 5 min ago</div>
								<a href="features-profile.html" class="dropdown-item has-icon">
									<i class="far fa-user"></i> Profile
								</a>
								<a href="features-activities.html" class="dropdown-item has-icon">
									<i class="fas fa-bolt"></i> Activities
								</a>
								<div class="dropdown-divider"></div>
								<a href="#" class="dropdown-item has-icon text-danger">
									<i class="fas fa-sign-out-alt"></i> Logout
								</a>
							</div>
						</li>
					</ul>
				</nav>
				<div class="main-sidebar">
					<aside id="sidebar-wrapper">
						<div class="sidebar-brand">
							<a href="index.html">Stisla</a>
						</div>
						<div class="sidebar-brand sidebar-brand-sm">
							<a href="index.html">St</a>
						</div>
						<ul class="sidebar-menu">
							<li class="menu-header">Dashboard</li>
							<li class="nav-item dropdown">
								<a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
								<ul class="dropdown-menu">
									<li><a class="nav-link" href="index-0.html">General Dashboard</a></li>
									<li><a class="nav-link" href="index.html">Ecommerce Dashboard</a></li>
								</ul>
							</li>
							<li><a class="nav-link" href="credits.html"><i class="fas fa-clipboard-list"></i> <span>Menu Management</span></a></li>
							<li class="active"><a class="nav-link" href="/user"><i class="fas fa-users"></i> <span>User Management</span></a></li>
							<li><a class="nav-link" href="/role"><i class="fas fa-chess-rook"></i> <span>Role Management</span></a></li>
						</ul>
					</aside>
				</div>
				
				<!-- Main Content -->
				<?php echo $__env->yieldContent('content'); ?>
				<!-- End Main Content -->
				
				<footer class="main-footer">
					<div class="footer-left">
						Copyright &copy; 2018 <div class="bullet"></div> <a href="https://getstisla.com/" target="_blank">Stisla</a> Template
					</div>
					<div class="footer-right">2.3.0</div>
				</footer>
			</div>
		</div>
		
		<!-- General JS Scripts -->
		<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
		<script src="../assets/js/stisla.js"></script>
		
		<!-- JS Libraies -->
		<script src="../assets/node_modules/datatables/media/js/jquery.dataTables.min.js"></script>
		<script src="../assets/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
		<script src="../assets/node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js"></script>
		<script src="../assets/node_modules/izitoast/js/iziToast.min.js"></script>
		<script src="../assets/node_modules/sweetalert/js/sweetalert.min.js"></script>
		<script src="../assets/node_modules/select2/js/select2.full.min.js"></script>
		<!-- Template JS File -->
		<script src="../assets/js/scripts.js"></script>
		<script src="../assets/js/custom.js"></script>
		<!-- Page Specific JS File -->
		<?php echo $__env->yieldContent('js_content'); ?>
		<script>
			$(document).ready(function(){
				window.addEventListener('load', function () {
					$(".se-pre-con").fadeOut("slow");
				});
			});
		</script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\user-access-control\app\Views/index.blade.php ENDPATH**/ ?>