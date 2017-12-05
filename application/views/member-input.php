		<h2 class="text-center mb-4">Manage Member</h2>
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
					<a href="<?php url('member') ?>" class="text-secondary"><i class="fa fa-fw fa-arrow-left"></i></a>
					<?php echo (($mode == 'add') ? 'Input' : 'Edit'); ?> Member
				</h4>
				<hr>
				<form method="post" action="<?php url(($mode == 'add') ? 'member/input' : 'member/edit/'.$data->user_id) ?>">
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
					<?php if ($mode == 'edit'): ?>
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
					<?php endif ?>
					<div id="change_password" <?php echo ($mode == 'edit' && !isset($user_data->password)) ? 'style="display: none;"' : '' ?>>
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
							<button type="submit" class="btn btn-primary"><?php echo (($mode == 'add') ? 'Add New' : 'Edit'); ?> Member</button>
							<?php if ($mode == 'edit'): ?>
								<a href="<?php url('member/input') ?>" class="btn btn-secondary">Add New Member</a>
							<?php endif ?>
						</div>
					</div>
				</form>
			</div>
		</div>