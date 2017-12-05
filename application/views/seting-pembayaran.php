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
					Seting Pembayaran
				</h4>
				<hr>
				<form enctype="multipart/form-data" method="post" action="<?php url('seting/pembayaran') ?>">
					<div class="form-group row">
						<label class="col-sm-4 col-form-label">Nama Penerima</label>
						<div class="col-sm-8">
							<input type="text" required="" name="option[nama_penerima]" value="<?php echo get_option('nama_penerima') ?>" class="form-control" placeholder="Name">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-4 col-form-label">No Rekening</label>
						<div class="col-sm-8">
							<input type="text" required="" name="option[no_rek]" value="<?php echo get_option('no_rek') ?>" class="form-control" placeholder="No Rekening">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-4 col-form-label">Nama Bank</label>
						<div class="col-sm-8">
							<input type="text" required="" name="option[bank]" value="<?php echo get_option('bank') ?>" class="form-control" placeholder="Nama Bank">
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