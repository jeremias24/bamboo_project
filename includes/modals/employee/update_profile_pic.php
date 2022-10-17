<div id="update_picture" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Update Picture</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
							<form class="form" id = "form" action="" enctype="multipart/form-data" method="post">
								<div class="upload">
									<?php
									$user = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM employees WHERE id = $atId"));
									$id = $user["id"];
									$name = $user["PictureName"];
									$image = $user["Picture"];

									?>
									<img src="employees/<?php echo $image; ?>" width = 125 height = 125 title="<?php echo $image; ?>">
									<div class="round">
									<input type="hidden" name="id" value="<?php echo $id; ?>">
									<input type="hidden" name="name" value="<?php echo $name; ?>">
									<input type="file" name="image" id = "image" accept=".jpg, .jpeg, .png">
									<i class = "fa fa-camera" style = "color: #fff;"></i>
									</div>
								</div>
								</form>
								<script type="text/javascript">
								document.getElementById("image").onchange = function(){
									document.getElementById("form").submit();
								};
								</script>
							</div>
						</div>
					</div>
				</div>