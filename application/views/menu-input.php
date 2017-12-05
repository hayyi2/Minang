		<h2 class="text-center mb-4">Manage <?php echo ucwords($category); ?></h2>
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
					<a href="<?php url($category . '/view') ?>" class="text-secondary"><i class="fa fa-fw fa-arrow-left"></i></a>
					<?php echo (($mode == 'add') ? 'Input' : 'Edit'); ?> <?php echo ucwords($category); ?>
				</h4>
				<hr>
				<form enctype="multipart/form-data" method="post" action="<?php url(($mode == 'add') ? $category . '/input' : $category . '/edit/'.$data->menu_id) ?>">
					<div class="form-group row">
						<label class="col-sm-4 col-form-label">Name</label>
						<div class="col-sm-8">
							<input type="text" required="" name="name" <?php if(isset($data->name)) echo 'value="' . $data->name . '"'; ?> class="form-control" placeholder="Name">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-4 col-form-label">Description</label>
						<div class="col-sm-8">
							<textarea name="description" class="form-control" placeholder="Description" required=""><?php if(isset($data->description)) echo $data->description; ?></textarea>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-4 col-form-label">Price</label>
						<div class="col-sm-6">
							<div class="input-group">
								<span class="input-group-addon"> Rp </span>
								<input type="number" required="" name="price" <?php if(isset($data->price)) echo 'value="' . $data->price . '"'; ?> class="form-control" placeholder="Price">
								<span class="input-group-addon"> ,- </span>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-4 col-form-label">Thumbnail</label>
						<div class="col-sm-8">
							<?php if ($mode == 'edit' && $data->thumbnail != ""): ?>
								<div class="input-group" item-alfa>
									<a target="blank" href="<?php url('uploads/'. $data->thumbnail) ?>" class="form-control">
										<?php echo $data->thumbnail; ?>
									</a>
									<span remove-hide="[name=image]" add-name="[type=hidden]" remove-alfa="[item-alfa]" class="input-group-addon"><i class="fa fa-fw fa-close"></i></span>
								</div>
								<input type="hidden" attr-name="deleted" class="form-control" value="<?php echo $data->thumbnail; ?>">
								<input type="file" name="image" class="hide form-control" placeholder="Thumbnail">
							<?php else: ?>
								<input type="file" name="image" class="form-control" placeholder="Thumbnail">
							<?php endif ?>
						</div>
					</div>
					<hr>
					<div class="form-group row">
						<label class="col-sm-4 col-form-label"></label>
						<div class="col-sm-8">
							<button type="submit" class="btn btn-primary"><?php echo (($mode == 'add') ? 'Add New' : 'Edit'); ?> <?php echo ucwords($category); ?></button>
							<?php if ($mode == 'edit'): ?>
								<a href="<?php url($category . '/input') ?>" class="btn btn-secondary">Add New <?php echo ucwords($category); ?></a>
							<?php endif ?>
						</div>
					</div>
				</form>
			</div>
		</div>