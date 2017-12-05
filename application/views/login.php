		<div class="row">
			<div class="col-4"></div>
			<div class="col-4">
				<?php get_message_flash() ?>
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Form Login</h4>
						<form method="post" action="<?php url('user/login') ?>">
							<?php if ($go = $this->input->get('go')): ?>
								<input type="hidden" name="go" value="<?php echo $go ?>">
							<?php endif ?>
							<div class="form-group">
								<label>Email address</label>
								<input name="email" type="email" class="form-control" placeholder="Enter email" required="">
							</div>
							<div class="form-group">
								<label>Password</label>
								<input name="password" type="password" class="form-control" placeholder="Password" required="">
							</div>
							<label>Dont have an account? <a href="<?php url('user/register') ?>">register</a>.</label>
							<button type="submit" class="btn btn-primary btn-block">Login</button>
						</form>
					</div>
				</div>
			</div>
		</div>