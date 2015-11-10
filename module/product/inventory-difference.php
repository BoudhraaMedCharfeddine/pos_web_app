<?php
include '../../security/check_session.php';
include '../../config/connexion.php';
$cs = new CheckSession ();

$dbc = new DbConnexion ();
$c = $dbc->connect ();

?>


<?php
include '../header.php';
?>

<!-- BEGIN PAGE CONTAINER -->
<div class="page-container">
	<!-- BEGIN PAGE HEAD -->
	<div class="page-head">
		<div class="container">
			<!-- BEGIN PAGE TITLE -->
			<div class="page-title">
				<h1>
					Inventory difference <small>View products mouvement</small>
				</h1>
			</div>
			<!-- END PAGE TITLE -->
			<!-- BEGIN PAGE TOOLBAR -->
			<div class="page-toolbar">
				<!-- BEGIN THEME PANEL -->
				<!-- END THEME PANEL -->
			</div>
			<!-- END PAGE TOOLBAR -->
		</div>
	</div>
	<!-- END PAGE HEAD -->
	<!-- BEGIN PAGE CONTENT -->
	<div class="page-content">
		<div class="container">
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div class="modal fade" id="portlet-config" tabindex="-1"
				role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"
								aria-hidden="true"></button>
							<h4 class="modal-title">Modal title</h4>
						</div>
						<div class="modal-body">Widget settings form goes here</div>
						<div class="modal-footer">
							<button type="button" class="btn blue">Save changes</button>
							<button type="button" class="btn default" data-dismiss="modal">Close</button>
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<!-- BEGIN PAGE BREADCRUMB -->
			<ul class="page-breadcrumb breadcrumb">
				<li><a href="product-list.php">Home</a><i class="fa fa-circle"></i></li>
				<li><a href="inventory-difference.php">Inventory Difference</a> <i
					class="fa fa-circle"></i></li>
				<li class="active">Products mouvement</li>
			</ul>
			<!-- END PAGE BREADCRUMB -->
			<!-- BEGIN PAGE CONTENT INNER -->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN -->
					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-cogs font-green-sharp"></i> <span
									class="caption-subject font-green-sharp bold uppercase">Select
									Date</span>
							</div>
							<div class="tools">
								<a href="javascript:;" class="remove"> </a>
							</div>
						</div>
						<div class="portlet-body">
							<div class="portlet-body form">
								<!-- BEGIN FORM-->
								<form method="post" class="form-horizontal">
									<div class="form-body">
										<div class="form-group">
											<label class="control-label col-md-2">Start date</label>
											<div class="col-md-3">
												<div class="input-group date date-picker"
													data-date-format="yyyy-mm-dd">
													<input type="text" class="form-control" readonly
														name="start_date"> <span class="input-group-btn">
														<button class="btn default" type="button">
															<i class="fa fa-calendar"></i>
														</button>
													</span>
												</div>
											</div>
											<label class="control-label col-md-2">Start date</label>
											<div class="col-md-3">
												<div class="input-group date date-picker"
													data-date-format="yyyy-mm-dd">
													<input type="text" class="form-control" readonly
														name="end_date"> <span class="input-group-btn">
														<button class="btn default" type="button">
															<i class="fa fa-calendar"></i>
														</button>
													</span>
												</div>
											</div>
										</div>
									</div>
									<div class="form-actions">
										<div class="row">
											<div class="col-md-offset-3 col-md-9">
												<button type="submit" name="btn_search" class="btn green"
													style="margin-left: 68.1%; margin-bottom: -2%;">Search</button>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
					<!-- BEGIN -->

					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-cogs font-green-sharp"></i> <span
									class="caption-subject font-green-sharp bold uppercase">Products
									mouvement</span>
							</div>
							<div class="tools">
								<a href="javascript:;" class="reload"> </a>
							</div>
						</div>
						<div class="portlet-body">
							<?php
							$sql = "SELECT * FROM PRODUCTS";
							$result = $c->query ( $sql );
							
							?>
							
								<table class="table table-striped table-hover table-bordered"
								id="sample_editable_1">
								<thead>
									<tr>
										<th>Reference</th>
										<th>Code</th>
										<th>Name</th>
								<?php
								/*
								 * <th>Price buy</th>
								 * <th>Price sell</th>
								 * <th>Category</th>
								 * <th>Tax Category</th>
								 * <th>Stock cost</th>
								 */
								?>
										<th>Stock volume</th>
										<th>In Stock</th>
										<th>Out of Stock</th>
										<th>Stock Difference</th>
									</tr>
								</thead>
								<tbody>
					<?php
					if (! isset ( $_POST ['btn_search'] )) {
						
						while ( $row = $result->fetch_assoc () ) {
							$idProduct = $row ['ID'];
							$reference = $row ['REFERENCE'];
							$code = $row ['CODE'];
							$name = $row ['NAME'];
							$priceBuy = $row ['PRICEBUY'];
							$pricesell = $row ['PRICESELL'];
							$categoryId = $row ['CATEGORY'];
							$taxCategoryId = $row ['TAXCAT'];
							$stockCost = $row ['STOCKCOST'];
							$stockVolume = $row ['STOCKVOLUME'];
							
							?>
					<tr>
										<td><?php echo $reference;?></td>
										<td><?php echo $code;?></td>
										<td><?php echo $name;?></td>
									<?php
							
							?>
										<td><?php echo $stockVolume;?></td>
									<?php
							$inStock = 0;
							$outOfStock = 0;
							$difference = 0;
							$today = date ( "Y-m-d 00:00:00" );
							
							$sqlOutOfStock = "SELECT SUM(UNITS) FROM  `STOCKDIARY`
									 WHERE PRODUCT =  '$idProduct' AND (UNITS < 0) AND (DATENEW > '$today')
																			 ";
							$resultOutOfStock = $c->query ( $sqlOutOfStock );
							while ( $rowOutOfStock = $resultOutOfStock->fetch_assoc () ) {
								$outOfStock = $rowOutOfStock ['SUM(UNITS)'];
							}
							
							$sqlInStock = "SELECT SUM(UNITS)
															FROM  `STOCKDIARY`
															WHERE PRODUCT =  '$idProduct' AND (UNITS > 0) AND (DATENEW > '$today')
															";
							$resultInStock = $c->query ( $sqlInStock );
							while ( $rowInStock = $resultInStock->fetch_assoc () ) {
								$inStock = $rowInStock ['SUM(UNITS)'];
							}
							
							?>
									<td>
									<?php
							if ($inStock == null) {
								echo 0;
							} else {
								echo $inStock;
							}
							?>
									</td>
										<td>
									<?php
							if ($outOfStock == null) {
								echo 0;
							} else {
								echo abs ( $outOfStock );
							}
							?>
									</td>
										<td>
										<?php
							$inValue = $inStock;
							$outValue = $outOfStock;
							if ($outOfStock == null) {
								$outValue = 0;
							}
							if ($inStock == null) {
								$inValue = 0;
							}
							echo ($inValue - abs ( $outValue ));
							?>
										</td>
									</tr>
					
					<?php
						}
					} else {
						
						$date_start_date = date ( $_POST ['start_date'] . " 00:00:00" );
						$date_end_date = date ( $_POST ['end_date'] . " 23:59:59" );
						
						if (! isset ( $_POST ['start_date'] )) {
						} else {
						}
						if (! isset ( $_POST ['end_date'] )) {
						} else {
						}
						echo $date_start_date;
						echo $date_end_date;
						
						while ( $row = $result->fetch_assoc () ) {
							$idProduct = $row ['ID'];
							$reference = $row ['REFERENCE'];
							$code = $row ['CODE'];
							$name = $row ['NAME'];
							$priceBuy = $row ['PRICEBUY'];
							$pricesell = $row ['PRICESELL'];
							$categoryId = $row ['CATEGORY'];
							$taxCategoryId = $row ['TAXCAT'];
							$stockCost = $row ['STOCKCOST'];
							$stockVolume = $row ['STOCKVOLUME'];
							
							?>
											<tr>
										<td><?php echo $reference;?></td>
										<td><?php echo $code;?></td>
										<td><?php echo $name;?></td>
															<?php
							
							?>
																<td><?php echo $stockVolume;?></td>
															<?php
							$inStock = 0;
							$outOfStock = 0;
							$difference = 0;
							$today = date ( "Y-m-d 00:00:00" );
							
							$sqlOutOfStock = "SELECT SUM(UNITS) FROM  `STOCKDIARY`
															 WHERE PRODUCT =  '$idProduct' AND (UNITS < 0) AND (DATENEW > '$date_start_date')
															 AND (DATENEW < '$date_end_date')";
							
							$resultOutOfStock = $c->query ( $sqlOutOfStock );
							while ( $rowOutOfStock = $resultOutOfStock->fetch_assoc () ) {
								$outOfStock = $rowOutOfStock ['SUM(UNITS)'];
							}
							
							$sqlInStock = "SELECT SUM(UNITS) FROM  `STOCKDIARY`
										   WHERE PRODUCT =  '$idProduct' AND (UNITS > 0) AND (DATENEW > '$date_start_date')
															 AND (DATENEW < '$date_end_date')";
							
							$resultInStock = $c->query ( $sqlInStock );
							while ( $rowInStock = $resultInStock->fetch_assoc () ) {
								$inStock = $rowInStock ['SUM(UNITS)'];
							}
							
							?>
															<td>
															<?php
							if ($inStock == null) {
								echo 0;
							} else {
								echo $inStock;
							}
							?>
															</td>
										<td>
															<?php
							if ($outOfStock == null) {
								echo 0;
							} else {
								echo abs ( $outOfStock );
							}
							?>
															</td>
										<td>
																<?php
							$inValue = $inStock;
							$outValue = $outOfStock;
							if ($outOfStock == null) {
								$outValue = 0;
							}
							if ($inStock == null) {
								$inValue = 0;
							}
							echo ($inValue - abs ( $outValue ));
							?>
																</td>
									</tr>
											
											<?php
						}
					}
					?> 
									</tbody>
							</table>



						</div>
					</div>
					<!-- END EXAMPLE TABLE PORTLET-->



				</div>
			</div>
			<!-- END PAGE CONTENT -->





		</div>
		<!-- END PAGE CONTAINER -->



<?php
include '../footer.php';
?>
