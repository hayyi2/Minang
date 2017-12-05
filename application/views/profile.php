		<h2 class="text-center mb-4">Profile</h2>
		<div class="row">
			<div class="col-sm-3"></div>
			<div class="col-sm-6">
				<?php get_message_flash() ?>
				<?php if (isset($error)): ?>
					<div class="alert alert-danger">
		                <button type="button" class="close" data-dismiss="alert">
		                    <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
		                </button>
		                <?php echo $error; ?>
		            </div>
				<?php endif ?>
				<h4>
					Edit Profile
				</h4>
				<hr>
				<form method="post" action="<?php url('user/profile') ?>">
					<div class="form-group row">
						<label class="col-sm-4 col-form-label">Name</label>
						<div class="col-sm-8">
							<input type="text" name="name" <?php if(isset($data->name)) echo 'value="' . $data->name . '"'; ?> class="form-control" placeholder="Name">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-4 col-form-label">Email</label>
						<div class="col-sm-8">
							<input type="email" name="email" <?php if(isset($data->email)) echo 'value="' . $data->email . '"'; ?> class="form-control" placeholder="Email">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-12 col-form-label">
							<div class="checkbox">
								<label>
									<input type="checkbox" name="change_password" value="1" data-toggle-checkbox="display" target-display="#change_password">
									Change Password
								</label>
							</div>
						</label>
					</div>
					<div id="change_password" style="display: none;">
						<div class="form-group row">
							<label class="col-sm-4 col-form-label">Password</label>
							<div class="col-sm-8">
								<input type="password" name="password" class="form-control" placeholder="Password">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-4 col-form-label">Repeat Password</label>
							<div class="col-sm-8">
								<input type="password" name="repeat_password" class="form-control" placeholder="Repeat Password">
							</div>
						</div>
					</div>
					<hr>
					<div class="form-group row">
						<label class="col-sm-4 col-form-label"></label>
						<div class="col-sm-8">
							<button type="submit" class="btn btn-primary">Edit Profile</button>
						</div>
					</div>
				</form>
			</div>
		</div>