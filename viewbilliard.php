<?php

	$this->load->database();

	$timezone = "Asia/Manila";
	date_default_timezone_set ($timezone);																
	
	$datelog = date("Y-m-d");
	$memberno = $this->session->userdata(SESSFIX.'userno');	
	
	$total = 0;
	$converted = 0;
	
	$query = "SELECT sum(amount_add) as balance from my_videos where transdate<='$datelog' and status=1 and memberno=$memberno";
	$result = $this->db->query($query);
	$row = $result->row_array();
	if (isset($row))
	{
		$total = $row['balance'];
	}
	$result->free_result();
	
	$query = "SELECT sum(amount_add) as balance from my_wallet where transdate=20 and transdate<='$datelog' and status=1 and memberno=$memberno";
	$result = $this->db->query($query);
	$row = $result->row_array();
	if (isset($row))
	{
		$converted = $row['balance'];
	}
	$result->free_result();
	
	$balance = 0;
	$query = "SELECT sum(amount_add - amount_minus) as balance from my_videos where transdate<='$datelog' and status=1 and memberno=$memberno";
	$result = $this->db->query($query);
	$row = $result->row_array();
	if (isset($row))
	{
		$balance = $row['balance'];
	}
	$result->free_result();
	
	//$balance = $total - $converted;
	
	
	$datelog = date("Y-m-d");
	$memberno = $this->session->userdata(SESSFIX.'userno');	
	
	$acctbal = 0;
	
	$query = "SELECT sum(amount_add - amount_minus) as balance from my_wallet where transdate<='$datelog' and status=1 and memberno=$memberno";
	$result = $this->db->query($query);
	$row = $result->row_array();
	if (isset($row))
	{
		$acctbal = $row['balance'];
	}
	$result->free_result();
	
	/*
	$query = "SELECT sum(amount_add - amount_minus) as balance from my_wallet2 where transdate<='$datelog' and status=1 and memberno=$memberno";
	$result = $this->db->query($query);
	$row = $result->row_array();
	if (isset($row))
	{
		$acctbal = $acctbal+ $row['balance'];
	}
	$result->free_result();
	*/
	
	$query = "SELECT sum(amount_add - amount_minus) as balance from my_wallet3 where transdate<='$datelog' and status=1 and memberno=$memberno";
	$result = $this->db->query($query);
	$row = $result->row_array();
	if (isset($row))
	{
		$acctbal = $acctbal+ $row['balance'];
	}
	$result->free_result();
	
	
		$query = "SELECT sum(amount) as balance from my_encashments where status=0 and memberno=$memberno";
													$result = $this->db->query($query);
													$row = $result->row_array();
													if (isset($row))
													{
														$acctbal = $acctbal - $row['balance'];
													}
													$result->free_result();
													
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="">
    <title>TypingMaster - Billiard</title>

    <!-- STYLESHEETS -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~--- -->

    <!-- Fonts [ OPTIONAL ] -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">
	<link rel="icon" type="image/png" href="assets/images/logo1.png">
    <!-- Bootstrap CSS [ REQUIRED ] -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <!-- Nifty CSS [ REQUIRED ] -->
    <link rel="stylesheet" href="assets/css/nifty.min3.css">

    <!-- Nifty Demo Icons [ OPTIONAL ] -->
    <link rel="stylesheet" href="assets/css/demo-purpose/demo-icons.min.css">
	<link rel="stylesheet" href="assets/premium/icon-sets/icons/line-icons/premium-line-icons.min.css">
	
    <!-- Demo purpose CSS [ DEMO ] -->
    <link rel="stylesheet" href="assets/css/demo-purpose/demo-settings.min.css">
  
	
</head>

<body class="jumping">

    <!-- PAGE CONTAINER -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <div id="root" class="root mn--max hd--expanded">

        <!-- CONTENTS -->
        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        <section id="content" class="content">
		
		
            <div class="content__header content__boxed overlapping">
                <div class="content__wrap">

                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">P2E Billiard</li>
                        </ol>
                    </nav>
                    <!-- END : Breadcrumb -->

                    <h1 class="page-title mb-0 mt-2" style="color:#7454a3 !important;">P2E Billiard</h1>
                    <p class="lead" style="color:#7454a3 !important;">
                        Play the game of billiard to earn more money
                    </p>

                </div>

            </div>

           
		   <div class="content__boxed">
				<div class="content__wrap">		

					<div class="row">
                        <div class="col-md-12">
								<?php 
                                    if($this->session->userdata(SESSFIX.'msg_alertno')== 1) 
                                    { ?>											
                                        <div class="alert alert-success" role="alert">
                                            <strong>Command Successful!</strong>&nbsp;<?=$this->session->userdata(SESSFIX.'msg_alertmsg');?>
                                        </div>
                                        <script type="text/javascript">$(document).ready(function() { $('#msg-alert-pics').delay(5000).fadeOut('slow','linear'); });</script>	
                                    
                                <?php } elseif($this->session->userdata(SESSFIX."msg_alertno") == 2)
                                    { ?>
                                    
                                    <div class="alert alert-danger" role="alert">
                                        <strong>Invalid Action!</strong>&nbsp;&nbsp;<?=$this->session->userdata(SESSFIX.'msg_alertmsg');?>
                                    </div>
                                    <script type="text/javascript">$(document).ready(function() { $('#msg-alert-pics').delay(5000).fadeOut('slow','linear'); });</script>	
                                <?php 
                                    }
                                    $this->session->set_userdata(SESSFIX."msg_alertno",0);
                                ?>	
                        </div>
                    </div>


					<div class="row" style="display:none;">
		   
						 <div class="col-md-12 mb-3">

                            <!-- Placeholder card with image -->
                            <div class="card placeholder-glow">
                                <div class="ratio ratio-16x9">
                                    <span class="placeholder w-100 h-100"></span>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title"><span class="placeholder col-3"></span></h5>
                                    <p class="card-text">
                                        <span class="placeholder col-7"></span>
                                        <span class="placeholder col-4"></span>
                                        <span class="placeholder col-2"></span>
                                        <span class="placeholder col-7"></span>
                                    </p>
                                    <p class="card-text"><small class="text-muted"><span class="placeholder col-4"></span></small></p>
                                </div>
                            </div>
                            <!-- END : Placeholder card with image -->

                        </div>
					</div>
					
					
					<div class="row">
		            	 <div class="col-md-4">
            
							<div class="card mb-3">
                                <div class="card-body py-3">
			
									<div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="img-md ratio ratio-1x1 bg-primary text-white rounded-circle">
                                                <i class="d-flex align-items-center justify-content-center pli-financial  fs-2"></i>
                                            </div>
                                        </div>
                                        
										<div class="flex-grow-1 ms-3">
                                                <h5 class="h2 mb-0">
												<?php
												
													echo number_format($total,2);
												?>
												
												</h5>
                                                <p class="mb-0">Credits Earned</p>
                                        </div>

                                    </div>
                                </div>
							</div>
						</div>
						
						<div class="col-md-4">
					        <div class="card mb-3">
                                <div class="card-body py-3">
			
									<div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="img-md ratio ratio-1x1 bg-success text-white rounded-circle">
                                                <i class="d-flex align-items-center justify-content-center demo-pli-basket-coins fs-2"></i>
                                            </div>
                                        </div>
                                        
										<div class="flex-grow-1 ms-3">
                                                <h5 class="h2 mb-0">
												<?php
												
													echo number_format($balance,2);
												?>
												
												</h5>
                                                <p class="mb-0">Credits Balance <a class="btn btn-xs btn-success" href="billiard/convert">&nbsp;Convert Balance&nbsp;</a></p>
                                        </div>

                                    </div>
                                </div>
							</div>
							
					        
					    </div>
					    
					    <div class="col-md-4">

							<div class="card mb-3">
                                <div class="card-body py-3">
			
									<div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="img-md ratio ratio-1x1 bg-danger text-white rounded-circle">
                                                <i class="d-flex align-items-center justify-content-center pli-money-bag fs-2"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h5 class="h2 mb-0"><?php
												
													echo number_format($converted,2);
												?></h5>
                                            <p class="mb-0">Total Converted</p>
                                        </div>
                                    </div>

                                </div>
                            </div>
						</div>
							
			        </div>
			        
			        
			        
			        <div class="row">
                        <div class="col-md-12">
							
							<div class="card mb-3">
                                <div class="card-body">

                                    <!-- Profile picture and short information -->
                                    <div class="text-center position-relative">
                                        <div class="pt-2 pb-3">
                                            <img class="img-lg rounded-circle" src="assets/images/bilyar.png" alt="" loading="lazy">
                                        </div>
                                        <h4>8Ball Pro P2E</4>
									</p>
                                    </div>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="billiardgame" class="btn btn-success" target="_blank">PLAY</a>
                                        
                                    </div>
                                    <!-- END : Profile picture and short information -->


                                </div>
                            </div>
						</div>
					</div>
					
					<div class="row">
                        <div class="col-md-12">
                            
                            <div class="card">
        						<div class="card-header">
        							<h5 class="card-title mb-3">Play History</h5>                           
        						</div>
        
        						<div class="card-body">
        							<div id="my-p2e">
        								
        							</div>                          
        						</div>
        					</div>
					
                        </div>
                    </div>
					
				</div>
			</div>
		    
		    
		    <div class="content__boxed">
				<div class="content__wrap">
				
				</div>
			</div>
			
		   
		   
		   
		   
            <!-- FOOTER -->
            <footer class="mt-auto">
                <div class="content__boxed">
                    <div class="content__wrap py-3 py-md-1 d-flex flex-column flex-md-row align-items-md-center">
                        <div class="text-nowrap mb-4 mb-md-0">Copyright &copy; 2022 <a href="#" class="ms-1 btn-link fw-bold">TypingMaster Ltd.</a></div>
                        <nav class="nav flex-column gap-1 flex-md-row gap-md-3 ms-md-auto" style="row-gap: 0 !important;">
                            <a class="nav-link px-0" href="javascript:;">Policy Privacy</a>
                            <a class="nav-link px-0" href="javascript:;">Terms and conditions</a>
                            <a class="nav-link px-0" href="javascript:;">Contact Us</a>
                        </nav>
                    </div>
                </div>
            </footer>
            <!-- END - FOOTER -->

        </section>

        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        <!-- END - CONTENTS -->

        <!-- HEADER -->
        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        <header class="header">
            <div class="header__inner">

                <!-- Brand -->
                <div class="header__brand">
                    <div class="brand-wrap">

                        <!-- Brand logo -->
                        <a href="javascript:;" class="brand-img stretched-link">
                            <img src="assets/images/logo1.png" alt="TypingMaster" class="Nifty logo" width="40" height="40">
                        </a>

                        <!-- Brand title -->
                        <div class="brand-title">TypingMaster</div>

                        <!-- You can also use IMG or SVG instead of a text element. -->

                    </div>
                </div>
                <!-- End - Brand -->

                <div class="header__content">

                    <!-- Content Header - Left Side: -->
                    <div class="header__content-start">

                        <!-- Navigation Toggler -->
                        <button type="button" class="nav-toggler header__btn btn btn-icon btn-sm" aria-label="Nav Toggler">
                            <i class="demo-psi-view-list"></i>
                        </button>

                        <!-- Searchbox -->
                        <div class="header-searchbox">

                            <!-- Searchbox toggler for small devices -->
                            <label for="header-search-input" class="header__btn d-md-none btn btn-icon rounded-pill shadow-none border-0 btn-sm" type="button">
                                <i class="demo-psi-magnifi-glass"></i>
                            </label>

                            <!-- Searchbox input -->
                            <form class="searchbox searchbox--auto-expand searchbox--hide-btn input-group">
                                <input id="header-search-input" class="searchbox__input form-control bg-transparent" type="search" placeholder="Type for search . . ." aria-label="Search">
                                <div class="searchbox__backdrop">
                                    <button class="searchbox__btn header__btn btn btn-icon rounded shadow-none border-0 btn-sm" type="button" id="button-addon2">
                                        <i class="demo-pli-magnifi-glass"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- End - Content Header - Left Side -->

                    <!-- Content Header - Right Side: -->
                    <div class="header__content-end">                      

                        <!-- User dropdown -->
                        <div class="dropdown">

                            <!-- Toggler -->
                            <button class="header__btn btn btn-icon btn-sm" type="button" data-bs-toggle="dropdown" aria-label="User dropdown" aria-expanded="false">
                                <i class="demo-psi-male"></i>
                            </button>

                            <!-- User dropdown menu -->
                            <div class="dropdown-menu dropdown-menu-end w-md-450px">

                                <!-- User dropdown header -->
                                <div class="d-flex align-items-center border-bottom px-3 py-2">
                                    <div class="flex-shrink-0">
                                        <img class="img-sm rounded-circle" src="<?php
							
							if($this->session->userdata(SESSFIX.'userpic') == '' or $this->session->userdata(SESSFIX.'userpic') == '123456'){
								echo base_url().'assets/img/avatar.jpg';
							}else{
								echo base_url().'photos/avatar/'.$this->session->userdata(SESSFIX.'userpic');
							} 
						
							?>" alt="Profile Picture" loading="lazy">
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h5 class="mb-0"><?php echo $this->session->userdata(SESSFIX.'userfullname'); ?></h5>
                                        <span class="text-muted fst-italic"><?php echo $this->session->userdata(SESSFIX.'useremail'); ?></span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-7">

                                        <!-- Simple widget and reports -->
                                        <div class="list-group list-group-borderless mb-3">
                                            <div class="list-group-item text-center border-bottom mb-3">
                                                <p class="h1 display-1 text-green"><?php echo number_format($acctbal,2); ?></p>
                                                <p class="h6 mb-0"><i class="demo-pli-basket-coins fs-3 me-2"></i> Account Balance</p>
                                            </div>
                                            <div class="list-group-item py-0 d-flex justify-content-between align-items-center">
                                                Today Earning
                                                <small class="fw-bolder"><?php
													
													echo number_format(0,2);
													
												?></small>
                                            </div>
                                            <div class="list-group-item py-0 d-flex justify-content-between align-items-center">
                                                Tax
                                                <small class="fw-bolder text-danger">
												<?php
													
													echo number_format(0,2);
													
												?>
												</small>
                                            </div>
                                            <div class="list-group-item py-0 d-flex justify-content-between align-items-center">
                                                Total Earning
                                                <span class="fw-bold text-primary">
												<?php
													
													echo number_format($totalearnings,2);
													
												?>
												</span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-5">

                                        <!-- User menu link -->
                                        <div class="list-group list-group-borderless h-100 py-3">
                                          
                                            
                                            <a href="settings" class="list-group-item list-group-item-action">
                                                <i class="demo-pli-gear fs-5 me-2"></i> Settings
                                            </a>

                                          
                                            <a href="signout" class="list-group-item list-group-item-action">
                                                <i class="demo-pli-unlock fs-5 me-2"></i> Logout
                                            </a>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- End - User dropdown -->

                     
                    </div>
                </div>
            </div>
        </header>
        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        <!-- END - HEADER -->

        <!-- MAIN NAVIGATION -->
        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        <nav id="mainnav-container" class="mainnav">
            <div class="mainnav__inner">

                <!-- Navigation menu -->
                <div class="mainnav__top-content scrollable-content pb-5">

                    <!-- Profile Widget -->
                    <div class="mainnav__profile mt-3 d-flex3">

                        <div class="mt-2 d-mn-max"></div>

                        <!-- Profile picture  -->
                        <div class="mininav-toggle text-center py-2">
                            <img class="mainnav__avatar img-md rounded-circle border" src="<?php
							
							if($this->session->userdata(SESSFIX.'userpic') == '' or $this->session->userdata(SESSFIX.'userpic') == '123456'){
								echo base_url().'assets/img/avatar.jpg';
							}else{
								echo base_url().'photos/avatar/'.$this->session->userdata(SESSFIX.'userpic');
							} 
						
							?>" alt="Profile Picture">
                        </div>

                        <div class="mininav-content collapse d-mn-max">
                            <div class="d-grid">

                                <!-- User name and position -->
                                <button class="d-block btn shadow-none p-2" data-bs-toggle="collapse" data-bs-target="#usernav" aria-expanded="false" aria-controls="usernav">
                                    <span class="dropdown-toggle d-flex justify-content-center align-items-center">
                                        <h6 class="mb-0 me-3"><?php echo $this->session->userdata(SESSFIX.'userfullname'); ?></h6>
                                    </span>
                                    <small class="text-muted"><?php echo $this->session->userdata(SESSFIX.'useremail'); ?></small>
                                </button>

                                <!-- Collapsed user menu -->
                                <div id="usernav" class="nav flex-column collapse">
                                 
                                    <a href="javascrip:;" class="nav-link">
                                        <i class="demo-pli-male fs-5 me-2"></i>
                                        <span class="ms-1">Profile</span>
                                    </a>
                                    <a href="settings" class="nav-link">
                                        <i class="demo-pli-gear fs-5 me-2"></i>
                                        <span class="ms-1">Settings</span>
                                    </a>
                                   
                                    <a href="signout" class="nav-link">
                                        <i class="demo-pli-unlock fs-5 me-2"></i>
                                        <span class="ms-1">Logout</span>
                                    </a>
                                </div>

                            </div>
                        </div>

                    </div>
                    <!-- End - Profile widget -->
					
					<?php
						if ($this->session->userdata(SESSFIX.'userrank') == ADMINRANK) {						
					?>
                    <!-- Navigation Category -->
                    <div class="mainnav__categoriy py-3">
                        <h6 class="mainnav__caption mt-0 px-3 fw-bold">Admin</h6>
                        <ul class="mainnav__menu nav flex-column">
                            <li class="nav-item">
                                <a href="admin" class="nav-link mininav-toggle"><i class="pli-big-data fs-5 me-2"></i>

                                    <span class="nav-label mininav-content ms-1">Admin Panel</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="members" class="nav-link mininav-toggle"><i class="demo-pli-address-book fs-5 me-2"></i>

                                    <span class="nav-label mininav-content ms-1">Members</span>
                                </a>
                            </li>
							
							<li class="nav-item">
                                <a href="adminfunds" class="nav-link mininav-toggle"><i class="pli-money-bag fs-5 me-2"></i>

                                    <span class="nav-label mininav-content ms-1">Funds</span>
                                </a>
                            </li>
							
							<li class="nav-item">
                                <a href="payins" class="nav-link mininav-toggle"><i class="pli-folder-download fs-5 me-2"></i>

                                    <span class="nav-label mininav-content ms-1">Payins</span>
                                </a>
                            </li>
							
							<li class="nav-item">
                                <a href="adminacts" class="nav-link mininav-toggle"><i class="pli-statistic fs-5 me-2"></i>

                                    <span class="nav-label mininav-content ms-1">Activations</span>
                                </a>
                            </li>
							
							<li class="nav-item">
                                <a href="payouts" class="nav-link mininav-toggle"><i class="pli-folder-upload fs-5 me-2"></i>

                                    <span class="nav-label mininav-content ms-1">Payouts</span>
                                </a>
                            </li>
							
                        </ul>
                    </div>
                    <!-- END : Navigation Category -->
					<?php } ?>
						
                    <!-- Components Category -->
                    <div class="mainnav__categoriy py-3">
                        <h6 class="mainnav__caption mt-0 px-3 fw-bold">Navigation</h6>
                        <ul class="mainnav__menu nav flex-column">
							
							<li class="nav-item">
                                <a href="dashboard" class="nav-link "><i class="demo-psi-layout-grid fs-5 me-2"></i>

                                    <span class="nav-label mininav-content ms-1">Dashboard</span>
                                </a>
                            </li>
								
							<li class="nav-item">
                                <a href="deposit" class="nav-link mininav-toggle"><i class="pli-folder-upload fs-5 me-2"></i>

                                    <span class="nav-label mininav-content ms-1">Deposit</span>
                                </a>
                            </li>
							
							<li class="nav-item">
                                <a href="withdraw" class="nav-link mininav-toggle"><i class="pli-folder-download fs-5 me-2"></i>

                                    <span class="nav-label mininav-content ms-1">Withdraw</span>
                                </a>
                            </li>
							
							
							
							<li class="nav-item">
                                <a href="activations" class="nav-link"><i class="pli-spring fs-5 me-2"></i>

                                    <span class="nav-label mininav-content ms-1">Activations</span>
                                </a>
                            </li>
							
							<li class="nav-item">
                                <a href="matic" class="nav-link mininav-toggle"><i class="demo-pli-window-2 fs-5 me-2"></i>

                                    <span class="nav-label mininav-content ms-1">SmartMATIC</span>
                                </a>
                            </li>		
                            
                            <li class="nav-item">
                                <a href="bnb" class="nav-link mininav-toggle"><i class="demo-pli-mine fs-5 me-2"></i>

                                    <span class="nav-label mininav-content ms-1">BNBMaster</span>
                                </a>
                            </li>		
                            
								<!--
							<li class="nav-item">
                                <a href="tasks" class="nav-link mininav-toggle"><i class="pli-farmer fs-5 me-2"></i>

                                    <span class="nav-label mininav-content ms-1">Tasks</span>
                                </a>
                            </li>
							-->
							
							<li class="nav-item">
                                <a href="billiard" class="nav-link active"><i class="pli-contrast fs-5 me-2"></i>

                                    <span class="nav-label mininav-content ms-1">P2E Billiard</span>
                                </a>
                            </li>							
							
							<li class="nav-item">
                                <a href="referrals" class="nav-link "><i class="pli-people-on-cloud fs-5 me-2"></i>

                                    <span class="nav-label mininav-content ms-1">Referrals</span>
                                </a>
                            </li>
							<li class="nav-item">
                                <a href="settings" class="nav-link mininav-toggle"><i class=" demo-pli-gear fs-5 me-2"></i>
                                    <span class="nav-label mininav-content ms-1">Settings</span>
                                </a>
                            </li>
                         
							<li class="nav-item">
                                <a href="signout" class="nav-link mininav-toggle"><i class="demo-pli-unlock fs-5 me-2"></i>
                                    <span class="nav-label mininav-content ms-1">Logout</span>
                                </a>
                            </li>
							
							
                        </ul>
                    </div>
                    <!-- END : Components Category -->



                    <!-- Widget -->
                    <div class="mainnav__profile">

                        <!-- Widget buttton form small navigation -->
                        <div class="mininav-toggle text-center py-2 d-mn-min">
                            <i class="demo-pli-monitor-2"></i>
                        </div>

                        <div class="d-mn-max mt-5"></div>

                        <!-- Widget content -->
                        <div class="mininav-content collapse d-mn-max">
                            <h6 class="mainnav__caption px-3 fw-bold">Server Status</h6>
                            <ul class="list-group list-group-borderless">
                                <li class="list-group-item text-reset">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <p class="mb-2 me-auto">CPU Usage</p>
                                        <span class="badge bg-info rounded">31%</span>
                                    </div>
                                    <div class="progress progress-md">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 31%" aria-label="CPU Progress" aria-valuenow="31" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </li>
                                <li class="list-group-item text-reset">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <p class="mb-2 me-auto">Bandwidth</p>
                                        <span class="badge bg-warning rounded">53%</span>
                                    </div>
                                    <div class="progress progress-md">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 53%" aria-label="Bandwidth Progress" aria-valuenow="53" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </li>
                            </ul>
                           
                        </div>
                    </div>
                    <!-- End - Profile widget -->

                </div>
                <!-- End - Navigation menu -->

              

            </div>
        </nav>
        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        <!-- END - MAIN NAVIGATION -->    

    </div>
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <!-- END - PAGE CONTAINER -->

    <!-- SCROLL TO TOP BUTTON -->
    <div class="scroll-container">
        <a href="#root" class="scroll-page rounded-circle ratio ratio-1x1" aria-label="Scroll button"></a>
    </div>
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <!-- END - SCROLL TO TOP BUTTON -->
   

   

   <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
	<script src="assets/js/jquery-3.5.1.min.js"></script>

    <!-- Popper JS [ OPTIONAL ] -->
    <script src="assets/vendors/popperjs/popper.min.js" defer></script>

    <!-- Bootstrap JS [ OPTIONAL ] -->
    <script src="assets/vendors/bootstrap/bootstrap.min.js" defer></script>

    <!-- Nifty JS [ OPTIONAL ] -->
    <script src="assets/js/nifty.js" defer></script>

    <!-- Nifty Settings [ DEMO ] -->
    <script src="assets/js/demo-purpose-only.js" defer></script>
	<script type="text/javascript">			
	$(document).ready(function() {	
		
		$.ajax({ cache: false, type: 'GET',url: '<?=base_url();?>billiard/loadhistory',
				beforeSend: function() {						
				}}).done(
				function( data )
				{					
					$("#my-p2e").html(data);	
				//	$("#member-wallet").dataTable({ "lengthMenu": [[20, 50, 100, -1], [20, 50, 100, "All"]] });
		        });	
		
	});	

	$(function() {			
	
	});
	</script>
</body>
</html>
<?php
	$this->db->close();
?>
