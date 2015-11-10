<?php
include '../../security/check_session.php';
include '../../config/connexion.php';
$cs = new CheckSession ();

/*
 * if (! $cs->check_user_session ()) {
 * // header("Location:".$_SERVER['DOCUMENT_ROOT'].'/index.php');
 * header ( "location:/lgproject/index.php" );
 * } /*
 * else if (! $cs->check_administrator ()) {
 * header ( "location:companys/companys.php" );
 * }
 */

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
					Product Management <small>List, add, delete and update products</small>
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
				<li><a href="#">Home</a><i class="fa fa-circle"></i></li>
				<li><a href="#">Products Management</a> <i
					class="fa fa-circle"></i></li>
				<li class="active">Products list</li>
			</ul>
			<!-- END PAGE BREADCRUMB -->
			<!-- BEGIN PAGE CONTENT INNER -->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-cogs font-green-sharp"></i> <span
									class="caption-subject font-green-sharp bold uppercase">Products
									list</span>
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
										<th>Price buy</th>
										<th>Price sell</th>
										<th>Category</th>
										<th>Tax Category</th>
										<th>Stock cost</th>
										<th>Stock volume</th>
										<th>Daily Stock</th>

									</tr>
								</thead>
								<tbody>
					<?php
					
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
										<td><?php echo round($priceBuy,2);?></td>
										<td><?php echo round($pricesell,2);?></td>

										<td><?php
						$sqlChildCategory = "SELECT * FROM CATEGORIES WHERE ID = '$categoryId'";
						$resultChildCategory = $c->query ( $sqlChildCategory );
						while ( $rowChildCategory = $resultChildCategory->fetch_assoc () ) {
							$categoryName = $rowChildCategory ['NAME'];
						}
						echo $categoryName;
						?></td>

										<td><?php
						$sqlChildTaxCategory = "SELECT * FROM TAXCATEGORIES WHERE ID = '$taxCategoryId'";
						$resultChildTaxCategory = $c->query ( $sqlChildTaxCategory );
						while ( $rowChildTaxCategory = $resultChildTaxCategory->fetch_assoc () ) {
							$taxCategoryName = $rowChildTaxCategory ['NAME'];
						}
						echo $taxCategoryName;
						?></td>

										<td><?php echo $stockCost;?></td>
										<td><?php echo $stockVolume;?></td>
										<td>
										<?php
						$inStock = 0;
						$outOfStock = 0;
						$difference = 0;
						$today = date ( "Y-m-d 00:00:00" );
						
						$sqlOutOfStock = "SELECT SUM(UNITS)
										 FROM  `STOCKDIARY`
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
											<center>
												<button class="btn btn-warning" data-toggle="modal"
													data-target="<?php echo '#myModal'.$idProduct; ?>">View</button>
											</center> <!-- Modal -->
											<div class="modal fade"
												id="<?php echo 'myModal'.$idProduct; ?>" role="dialog">
												<div class="modal-dialog">

													<!-- Modal content-->
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<h4 class="modal-title">Stock Today Mouvement</h4><h2><?php echo date("Y-m-d");?></h2> 
														</div>
														<form class="form-horizontal" role="form" name="f">
															<div class="form-group">
																<label class="control-label col-sm-2">Pdoduct:</label>
																<div class="col-sm-10">
																	<label class="control-label"><?php echo $name;?></label>
																</div>
															</div>
															<div class="form-group">
																<label class="control-label col-sm-2" for="email">Stock
																	In:</label>
																<div class="col-sm-10">
																	<label class="control-label col-sm-2"><?php
																					if ($inStock == null) {
																						echo 0;
																					} else {
																						echo $inStock;
																					}
																					?></label>
																</div>
															</div>
															<div class="form-group">
																<label class="control-label col-sm-2" for="Nom">Stock
																	Out</label>
																<div class="col-sm-10">
																	<label class="control-label col-sm-2"><?php
																					if ($outOfStock == null) {
																						echo 0;
																					} else {
																						echo abs($outOfStock);
																					}
																					?></label>
																</div>
															</div>
															<div class="form-group">
																<label class="control-label col-sm-2" for="Prenom">Difference</label>
																<div class="col-sm-10">
																	<label class="control-label col-sm-2"><?php
																					$inValue = $inStock;
																					$outValue = $outOfStock;
																					if ($outOfStock == null) {
																						$outValue =  0;
																					}if ($inStock == null) {
																						$inValue =  0;
																					}
																					echo ($inValue - abs($outValue));
																					?></label>
																</div>
															</div>
														</form>
														<div class="modal-footer">
															<button type="button" class="btn btn-default"
																data-dismiss="modal">Close</button>
														</div>
													</div>

												</div>
											</div>
										</td>
									</tr>
					
					<?php 					}								?> 
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