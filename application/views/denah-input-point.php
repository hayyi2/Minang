		<h2 class="text-center mb-4">Manage Denah</h2>
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
					<a href="<?php url('denah/view') ?>" class="text-secondary"><i class="fa fa-fw fa-arrow-left"></i></a>
					<?php echo (($mode == 'add') ? 'Input' : 'Edit'); ?> Denah
				</h4>
				<hr>
				<form enctype="multipart/form-data" method="post" action="<?php url(($mode == 'add') ? 'denah/input/poin' : 'denah/edit/poin/'.$data->place_id) ?>">
					<div class="form-group row">
						<label class="col-sm-4 col-form-label">Name</label>
						<div class="col-sm-8">
							<input type="text" required="" name="name" <?php if(isset($data->name)) echo 'value="' . $data->name . '"'; ?> class="form-control" placeholder="Denah">
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
									<span remove-hide="[name=denah]" add-name="[type=hidden]" remove-alfa="[item-alfa]" class="input-group-addon"><i class="fa fa-fw fa-close"></i></span>
								</div>
								<input type="hidden" attr-name="deleted" class="form-control" value="<?php echo $data->thumbnail; ?>">
								<input type="file" name="denah" class="hide form-control" placeholder="Thumbnail">
							<?php else: ?>
								<input type="file" name="denah" class="form-control" placeholder="Thumbnail">
							<?php endif ?>
						</div>
					</div>
					<hr>
					<div class="form-group row">
						<label class="col-sm-4 col-form-label"></label>
						<div class="col-sm-8">
							<button type="submit" class="btn btn-primary"><?php echo (($mode == 'add') ? 'Add New' : 'Edit'); ?> Denah</button>
							<?php if ($mode == 'edit'): ?>
								<a href="<?php url('denah/input/poin') ?>" class="btn btn-secondary">Add New Denah</a>
							<?php endif ?>
						</div>
					</div>
				</form>
			</div>
		</div>