		<div class="row">
			<div class="col-8"></div>
			<div class="col-4">
				<?php get_message_flash() ?>
				<?php if (isset($error)): ?>
					<div class="alert alert-danger">
		                <button type="button" class="close" data-dismiss="alert">
		                    <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
		                </button>
		                <?php echo $error; ?>
		            </div>
				<?php endif ?>
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Form Register</h4>
						<form method="post" action="<?php url('user/register') ?>">
							<div class="form-group">
								<label>Name</label>
								<input name="name" <?php if(isset($data['name'])) echo ' value="' . $data['name'] . '"'; ?> required="" type="text" class="form-control" placeholder="Name">
							</div>
							<div class="form-group">
								<label>Email address</label>
								<input name="email" <?php if(isset($data['email'])) echo ' value="' . $data['email'] . '"'; ?> required="" type="email" class="form-control" placeholder="Enter email">
							</div>
							<div class="form-group">
								<label>Password</label>
								<input name="password" required="" type="password" class="form-control" placeholder="Password">
							</div>
							<div class="form-group">
								<label>Repeat Password</label>
								<input name="repeat_password" required="" type="password" class="form-control" placeholder="Repeat Password">
							</div>
							<label>Have an account <a href="<?php url('user/login') ?>">login</a></label>
							<button type="submit" class="btn btn-primary btn-block">Register</button>
						</form>
					</div>
				</div>
			</div>
		</div>