		<h2 class="text-center mb-4">Detail Reservasi</h2>
		<?php get_message_flash() ?>
		<div class="row">
			<div class="col-sm-12">
				<h4>Menu yang dipesan</h4>
				<table class="table mb-4">
					<thead>
						<tr>
							<th>No</th>
							<th>Gambar</th>
							<th>Menu Makana atau Minuman</th>
							<th>Jumlah</th>
							<th>Harga</th>
							<th>Sub Total</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$total = 0;
						foreach ($data_menu as $no => $menu): 
							$total += $menu->total;
							?>
							<tr>
								<td scope="row"><?php echo $no + 1; ?></td>
								<td width="100">
									<?php if ($menu->thumbnail != ""): ?>
										<img src="<?php url('uploads/'.$menu->thumbnail) ?>" alt="<?php echo $menu->thumbnail ?>"><br>
									<?php endif ?>
								</td>
								<td><?php echo $menu->name; ?></td>
								<td>
									<form class="form-inline" action="<?php url('reservasi/edit_menu/'.$menu->reservasi_menu_id) ?>" method="post">
										<div class="form-group mx-sm-2">
											<input <?php if ($data->status > 2) echo 'readonly=""'; ?> name="sum" change-show=".jumlah<?php echo $menu->reservasi_menu_id ?>" type="number" min="1" value="<?php echo $menu->sum; ?>" style="width: 60px;" class="form-control form-control-sm">
										</div>
										<div class="form-group jumlah<?php echo $menu->reservasi_menu_id ?>" style="display: none;">
											<button type="submit" class="btn btn-info btn-sm"><i class="fa fa-fw fa-pencil"></i></button>
										</div>
									</form>
								</td>
								<td class="text-right"><?php echo money_formating($menu->price); ?></td>
								<td class="text-right"><?php echo money_formating($menu->total); ?></td>
								<?php if ($data->status <= 2): ?>
									<td>
										<a onclick="return confirm('Apakah anda yakin akan menghapus data?')" href="<?php url('reservasi/delete_menu/'.$menu->reservasi_menu_id) ?>" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i></a>
									</td>
								<?php endif ?>
							</tr>
						<?php endforeach ?>
						<tr>
							<th scope="row" colspan="5">Total</th>

							<td class="text-right"><?php echo money_formating($total); ?></td>
							<?php if ($data->status <= 2): ?>
								<td></td>
							<?php endif ?>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="col-sm-6"></div>
			<div class="col-sm-6">
				<h4>Data Tambahan</h4>
				<table class="table mb-4">
					<tbody>
						<tr>
							<th scope="row">Total Harga</th>
							<td><?php echo money_formating($total); ?></td>
						</tr>
						<?php if ($data->status == 1): ?>
							<a href="<?php url('denah') ?>" class="btn btn-primary btn-sm mb-2"><i class="fa fa-fw fa-plus"></i> Pesan Tempat</a>
						<?php else: ?>
							<tr>
								<th scope="row">Tempat Pemesanan</th>
								<td>
									<ul>
										<?php foreach ($data_tempat as $tempat): ?>
											<li>
												<?php echo $tempat->table_name . ' - ' . $tempat->name; ?>
												<?php if ($data->status <= 2): ?>
													<a href="<?php url('reservasi/delete_tempat/'.$tempat->reservasi_place_id) ?>" class="text-danger"><i class="fa fa-fw fa-close"></i></a>
												<?php endif ?>
											</li>
										<?php endforeach ?>
									</ul>
								</td>
							</tr>
							<tr>
								<th scope="row">Waktu</th>
								<td>
									<?php echo $data->date; ?>
									<?php if ($data->status <= 2): ?>
										<a onclick="return confirm('Anda yakin ingin merubah tanggal? Data pesanan tempat juga akan terhapus.')"  href="<?php url('reservasi/change_date/'.$data->reservasi_id) ?>"><i class="fa fa-fw fa-pencil"></i></a>
									<?php endif ?>
								</td>
							</tr>
						<?php endif ?>
						<tr>
							<th scope="row">Status</th>
							<td><?php echo $status[$data->status]; ?></td>
						</tr>
					</tbody>
				</table>
				<div class="mb-4">
					<?php if ($data->status < 5 && strtotime($data->date) > strtotime('+3 hours', strtotime(date('Y-m-d H:00')))): ?>
						<a href="<?php url('reservasi/batal/'.$data->reservasi_id) ?>" class="btn btn-danger"><i class="fa fa-fw fa-close"></i> Batal</a>
					<?php endif ?>
					<?php if ($data->status == 2): ?>
						<a href="<?php url('pembayaran') ?>" class="btn btn-primary"><i class="fa fa-fw fa-credit-card"></i> Pembayaran</a>
					<?php endif ?>
					<?php if ($data->status == 4 || $data->status == 7): ?>
					<a target="blank" href="<?php url('reservasi/cetak/'.$data->reservasi_id) ?>" class="btn btn-primary">Cetak Invoice</a>
					<?php endif ?>
				</div>
			</div>
		</div>