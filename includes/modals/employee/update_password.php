<div id="update_password" class="modal custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Update Password</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="form" id = "form" action="" enctype="multipart/form-data" method="post">
					
					<div class="col-sm-6">
						<div class="form-group">
							<label class="col-form-label">Password</label>
							<input class="form-control" required name="password" type="password">
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label class="col-form-label">Confirm Password</label>
							<input class="form-control" required name="confirm_pass" type="password">
						</div>
					</div>
					<div class="submit-section">
						<input type="hidden" name="id" value=<?php echo $id?>>
						<input type="submit" class="btn btn-primary submit-btn" name="update_access" value="Update Password">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>