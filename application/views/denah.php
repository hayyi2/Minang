		<h2 class="text-center mb-4">Denah Meja</h2>
		<?php get_message_flash() ?>
		<div class="text-center mb-2">
			<?php if ($new_date): ?>
				<form class="form-inline" action="<?php url('denah') ?>" method="post">
					<div class="form-group">
						<div class="input-group date form_date" data-date="" data-date-format="yyyy-mm-dd hh:00" data-link-field="tgl_hingga" data-link-format="yyyy-mm-dd hh:00">
							<span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
		                    <input name="date" class="form-control" type="text" value="<?php echo $date ?>" placeholder="Waktu Reservasi">
		                </div>
					</div>
					<div class="form-group mx-sm-2">
						<button type="submit" class="btn btn-primary">Lihat Tempat</button>
					</div>
				</form>
			<?php else: ?>
				<form class="form-inline">
					 <div class="form-group">
						<input type="text" readonly class="form-control-plaintext" value="Tanggal Reservasi">
					</div>
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
		                    <input readonly="" class="form-control" type="text" value="<?php echo $date ?>" placeholder="Waktu Reservasi">
							<a class="input-group-addon" onclick="return confirm('Anda yakin ingin merubah tanggal? Data pesanan tempat juga akan terhapus.')"  href="<?php url('reservasi/change_date/'.$reservasi_id) ?>"><i class="fa fa-fw fa-pencil"></i></a>
		                </div>
					</div>
				</form>
			<?php endif ?>
		</div>
		<?php for ($i = 0; $i < count($data) ;$i++): ?>
			<h4><?php echo $data[$i]->name; ?></h4>
			<div class="row mb-4">
				<div class="col-sm-9 text-center">
					<?php if ($data[$i]->thumbnail != ""): ?>
						<img src="<?php url('uploads/'.$data[$i]->thumbnail) ?>" alt="<?php echo $data[$i]->thumbnail ?>">
					<?php endif ?>
				</div>
				<div class="col-sm-3">
					<?php if ($data[$i]->table_name != null): ?>
						<div class="card">
							<ul class="list-group list-group-flush">
								<?php 
								do { ?>
									<li class="list-group-item">
										<div class="float-right">
											<?php 
											$find = false;
											foreach ($data_date as $reservasi) {
												if ($reservasi->place_detail_id == $data[$i]->place_detail_id) {
													$find = true;
													break;
												}
											}
											if ($find): ?>
												<button type="button" class="btn btn-secondary btn-sm">Telah di Pesan</button>
											<?php else: ?>
												<?php if ($can_add): ?>
													<form action="<?php url('reservasi/tempat/'.$data[$i]->place_detail_id) ?>" method="post">
														<input name="date" type="hidden" value="<?php echo $date ?>">
														<button type="submit" class="btn btn-info btn-sm">Pesan</button>
													</form>
												<?php else: ?>
													<button type="button" class="btn btn-primary btn-sm">Kosong</button>
												<?php endif ?>
											<?php endif ?>
										</div>
										<?php echo $data[$i]->table_name; ?>
									</li>
								<?php 
								$i++;
								} while (isset($data[$i]) && isset($data[$i - 1]) && $data[$i]->name == $data[$i - 1]->name) ?>
							</ul>
						</div>
					<?php endif ?>
				</div>
			</div>
		<?php endfor ?>