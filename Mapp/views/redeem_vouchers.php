<style>
.entry:not(:first-of-type)
{
    margin-top: 10px;
}

.glyphicon
{
    font-size: 12px;
}
</style>
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			
			<h3 class="page-title">
			Redeem <small>Voucher</small>
			</h3>
			<div class="page-bar">
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12 ">
					<!-- BEGIN SAMPLE FORM PORTLET-->
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-plus-square"></i> Redeem Voucher
							</div>
							<div class="tools">
								<a href="" class="collapse">
								</a>
								<a href="#portlet-config" data-toggle="modal" class="config">
								</a>
								<a href="" class="reload">
								</a>
								<a href="" class="remove">
								</a>
							</div>
						</div>
						<div class="portlet-body form">
							<form role="form" action="<?php echo base_url()?>redmption/redeem/" method="post">
								<div class="form-body">
									<div class="form-group">
										<label>Redeem Voucher</label>
										<div class="input-group">
											<span class="input-group-addon">
											<i class="fa fa-pencil"></i>
											</span>
											<input type="text" class="form-control" placeholder="Redeem Voucher" name="redeem_voucher">
										</div>
									</div>
								</div>
								<div class="form-actions">
									<button type="submit" class="btn blue">Submit</button>
									<button type="button" class="btn default">Cancel</button>
								</div>
							</form>
						</div>
					</div>
					
				</div>
					
			</div>
			
			<!-- END PAGE CONTENT-->
		</div>
	</div>
	