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
					<?php echo (($mode == 'add') ? 'Input' : 'Edit'); ?> Meja
				</h4>
				<hr>
				<form method="post" action="<?php url(($mode == 'add') ? 'denah/input/meja/'.$data->place_id : 'denah/edit/meja/'.$data->place_detail_id) ?>">
					<div class="form-group row">
						<label class="col-sm-4 col-form-label">Name</label>
						<?php if ($mode == 'add'): ?>
							<div class="col-sm-8" alfa-list>
								<div class="input-group" item-alfa>
									<input type="text" name="name[]" class="form-control" placeholder="Name" required>
									<span class="input-group-addon" remove-alfa="[item-alfa]"><i class="fa fa-fw fa-close"></i></span>
								</div>
							</div>
							<div alfa-master class="hide">
								<div class="input-group" item-alfa>
									<input type="text" name="name[]" class="form-control" placeholder="Name">
									<span class="input-group-addon" remove-alfa="[item-alfa]"><i class="fa fa-fw fa-close"></i></span>
								</div>
							</div>
						<?php else: ?>
							<div class="col-sm-8">
								<input type="text" name="name" value="<?php echo $data->name ?>" class="form-control" placeholder="Name" required>
							</div>
						<?php endif ?>
					</div>
					<hr>
					<div class="form-group row">
						<label class="col-sm-4 col-form-label"></label>
						<div class="col-sm-8">
							<?php if ($mode == 'add'): ?>
								<button add-alfa="[alfa-list]" type="button" class="btn btn-secondary"><i class="fa fa-fw fa-plus"></i></button>
							<?php endif ?>
							<button type="submit" class="btn btn-primary"><?php echo (($mode == 'add') ? 'Add New' : 'Edit'); ?> Meja</button>
							<?php if ($mode == 'edit'): ?>
								<a href="<?php url('denah/input/meja/'.$data->place_id) ?>" class="btn btn-secondary">Add New Meja</a>
							<?php endif ?>
						</div>
					</div>
				</form>
			</div>
		</div>