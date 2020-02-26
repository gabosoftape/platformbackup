<?php
require_once 'header.php';
if($_SESSION['nickname'] == 1520){
?>
<div class="container marginTop3">
	<div class="content" style="margin-top:10%">
		<div class="animated fadeIn">
			<div class="row">
				<?php
				$resultaccount = $mysqli->query("SELECT id, username, name FROM sys_user WHERE name != '' ORDER BY id ASC");
				while($rowaccount=mysqli_fetch_array($resultaccount)){
					$resultaccountunit = $mysqli->query("SELECT COUNT(id) AS numero FROM bs_account_unit WHERE parent_id = '".$rowaccount['id']."' ");
					$rowaccountunit=mysqli_fetch_array($resultaccountunit);
					?>
					<div class="col-lg-3 col-sm-12">
						<div class="card">
							<div class="card-body">
								<div class="stat-widget-five">
									<div class="row mb-3">
										<div class="col-12 font12px text-right">
											<b><?php echo strtoupper($rowaccount['name'])?></b>
										</div>
									</div>
									<div class="row mt-3">
										<div class="stat-icon dib flat-color-1">
											<img src="images/default.png"/>
										</div>
										<div class="stat-content">
											<div class="text-left dib">
												<div class="stat-heading"> 
													<i class="fa fa-truck-moving font25px color213C6C"></i>
													<?php echo $rowaccountunit['numero']?>
												</div>
											</div>
										</div>
									</div>
									<div class="row mt-3">
										<div class="col-6">
											<a href="fuec.php?id=<?php echo base64_encode($rowaccount['id'])?>">
												<button class="btn background213C6C btn-sm col-12">Fuec</button>
											</a>
										</div>
										<div class="col-6">
											<a href="admin.php?id=<?php echo base64_encode($rowaccount['id'])?>">
												<button class="btn btn-success btn-sm col-12">Admin</button>
											</a>	
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php
				}
				?>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
<?php
}
else{
?>
<div class="container marginTop3">
	<div class="content" style="margin-top:10%">
		<div class="animated fadeIn">
			<div class="row">
				<?php
				$resultaccount = $mysqli->query("SELECT id, username, name FROM sys_user WHERE id = ".$_SESSION['nickname']." ");
				$rowaccount=mysqli_fetch_array($resultaccount);
				
				$resultaccountunit = $mysqli->query("SELECT COUNT(id) AS numero FROM bs_account_unit WHERE parent_id = '".$rowaccount['id']."' ");
				$rowaccountunit=mysqli_fetch_array($resultaccountunit);
				?>
				<div class="col-lg-3 col-sm-12">
					<div class="card">
						<div class="card-body">
							<div class="stat-widget-five">
								<div class="row mb-3">
									<div class="col-12 font12px text-right">
										<b><?php echo strtoupper($rowaccount['name'])?></b>
									</div>
								</div>
								<div class="row mt-3">
									<div class="stat-icon dib flat-color-1">
										<img src="images/default.png"/>
									</div>
									<div class="stat-content">
										<div class="text-left dib">
											<div class="stat-heading"> 
												<i class="fa fa-truck-moving font25px color213C6C"></i>
												<?php echo $rowaccountunit['numero']?>
											</div>
										</div>
									</div>
								</div>
								<div class="row mt-3">
									<div class="col-6">
										<a href="fuec.php?id=<?php echo base64_encode($rowaccount['id'])?>">
											<button class="btn background213C6C btn-sm col-12">Fuec</button>
										</a>
									</div>
									<div class="col-6">
										<a href="admin.php?id=<?php echo base64_encode($rowaccount['id'])?>">
											<button class="btn btn-success btn-sm col-12">Admin</button>
										</a>	
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
<?php 
}
require_once 'footer.php';
?>