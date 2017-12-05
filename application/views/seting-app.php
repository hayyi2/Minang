		<h2 class="text-center mb-4">Seting</h2>
		<div class="row">
			<div class="col-sm-2"></div>
			<div class="col-sm-8">
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
					Seting App
				</h4>
				<hr>
				<form enctype="multipart/form-data" method="post" action="<?php url('seting') ?>">
					<div class="form-group row">
						<label class="col-sm-4 col-form-label">App Name</label>
						<div class="col-sm-8">
							<input type="text" required="" name="option[app_name]" value="<?php echo get_option('app_name') ?>" class="form-control" placeholder="Name">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-4 col-form-label">Salam</label>
						<div class="col-sm-8">
							<input type="text" required="" name="option[greeting]" value="<?php echo get_option('greeting') ?>" class="form-control" placeholder="Name">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-4 col-form-label">Description</label>
						<div class="col-sm-8">
							<textarea name="option[app_description]" class="form-control" placeholder="Description" required=""><?php if(get_option('app_description')) echo get_option('app_description'); ?></textarea>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-4 col-form-label">Thumbnail</label>
						<div class="col-sm-8">
							<?php if (get_option('banner')): ?>
								<div class="input-group" item-alfa>
									<a target="blank" href="<?php url('uploads/'. get_option('banner')) ?>" class="form-control">
										<?php echo get_option('banner'); ?>
									</a>
									<span remove-hide="[name=image]" add-name="[type=hidden]" remove-alfa="[item-alfa]" class="input-group-addon"><i class="fa fa-fw fa-close"></i></span>
								</div>
								<input type="hidden" attr-name="deleted" class="form-control" value="<?php echo get_option('banner'); ?>">
								<input type="file" name="image" class="hide form-control">
							<?php else: ?>
								<input type="file" name="image" class="form-control">
							<?php endif ?>
						</div>
					</div>
					<hr>
					<div class="form-group row">
						<label class="col-sm-4 col-form-label"></label>
						<div class="col-sm-8">
							<button type="submit" class="btn btn-primary">Save Change</button>
						</div>
					</div>
				</form>
			</div>
		</div>