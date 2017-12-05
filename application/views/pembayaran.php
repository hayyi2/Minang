		<?php get_message_flash() ?>
		<h2 class="text-center mb-4">Pembayaran</h2>
		<div class="row">
			<div class="col-sm-6">
				<h4>Data Reservasi</h4>
				<table class="table mb-4">
					<tbody>
						<tr>
							<th scope="row">Pemesanan Makanan</th>
							<td>
								<ul>
									<?php foreach (json_decode($data->menu) as $menu): ?>
										<?php if ($menu[0] == 1): ?>
											<li>
												<?php echo $menu[2] . '(' . $menu[1] . ')'; ?>
											</li>
										<?php endif ?>
									<?php endforeach ?>
								</ul>
							</td>
						</tr>
						<tr>
							<th scope="row">Pemesanan Minuman</th>
							<td>
								<ul>
									<?php foreach (json_decode($data->menu) as $menu): ?>
										<?php if ($menu[0] == 2): ?>
											<li>
												<?php echo $menu[2] . '(' . $menu[1] . ')'; ?>
											</li>
										<?php endif ?>
									<?php endforeach ?>
								</ul>
							</td>
						</tr>
						<tr>
							<th scope="row">Total Harga</th>
							<td><?php echo money_formating($data->total); ?></td>
						</tr>
						<tr>
							<th scope="row">Pemesanan Tempat</th>
							<td>
								<ul>
									<?php foreach (json_decode($data->detail_table) as $tempat): ?>
										<li>
											<?php echo $tempat[0] . ' - ' . $tempat[1]; ?>
										</li>
									<?php endforeach ?>
								</ul>
							</td>
						</tr>
						<tr>
							<th scope="row">Waktu</th>
							<td>
								<?php echo $data->date; ?>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="col-sm-6">
				<h4>Silahkan Transfer ke Rekening</h4>
				<table class="table mb-4">
					<tbody>
						<tr>
							<th>No Rekening</th>
							<td><?php echo get_option('no_rek') ?></td>
						</tr>
						<tr>
							<th>Atas Nama </th>
							<td><?php echo get_option('nama_penerima') ?></td>
						</tr>
						<tr>
							<th>Nama Bank</th>
							<td><?php echo get_option('bank') ?></td>
						</tr>
					</tbody>
				</table>
				<h4>Form Konfirmasi Pembayaran</h4>
				<hr>
				<form enctype="multipart/form-data" method="post" action="<?php url('pembayaran') ?>" class="mb-4">
					<div class="form-group row">
						<label class="col-sm-4 col-form-label">No Rekening</label>
						<div class="col-sm-8">
							<input type="text" name="no_account" class="form-control" placeholder="No Rekening" required="">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-4 col-form-label">Atas Nama</label>
						<div class="col-sm-8">
							<input type="text" name="name_account" class="form-control" placeholder="Atas Nama" required="">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-4 col-form-label">Nama Bank</label>
						<div class="col-sm-8">
							<input type="text" name="bank_account" class="form-control" placeholder="Nama Bank" required="">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-4 col-form-label">Bukti Pembayaran</label>
						<div class="col-sm-8">
							<input type="file" name="proof" class="form-control" required="">
						</div>
					</div>
					<hr>
					<div class="form-group row">
						<label class="col-sm-4 col-form-label"></label>
						<div class="col-sm-8">
							<button type="submit" class="btn btn-primary">Konfirmasi Pembayaran</button>
						</div>
					</div>
				</form>
			</div>
		</div>