		<?php get_message_flash() ?>
		<h2 class="text-center mb-4">Detail Reservasi</h2>
		<div class="row">
			<div class="col-sm-2"></div>
			<div class="col-sm-8">
				<h4>Data Pemensan</h4>
				<table class="table mb-4">
					<tbody>
						<tr>
							<th width="50%">Nama</th>
							<td><?php echo $data->name; ?></td>
						</tr>
						<tr>
							<th width="50%">Email</th>
							<td><?php echo $data->email; ?></td>
						</tr>
					</tbody>
				</table>
				<h4>Data Reservasi</h4>
				<table class="table mb-4">
					<tbody>
						<tr>
							<th width="50%">Kode Reservasi</th>
							<td><?php echo strtoupper(substr(sha1($data->reservasi_id), -6)) ; ?></td>
						</tr>
						<tr>
							<th width="50%">Pemesanan Makanan</th>
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
							<th width="50%">Pemesanan Minuman</th>
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
							<th width="50%">Total Harga</th>
							<td><?php echo money_formating($data->total); ?></td>
						</tr>
						<tr>
							<th width="50%">Pemesanan Tempat</th>
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
							<th width="50%">Waktu</th>
							<td>
								<?php echo $data->date; ?>
							</td>
						</tr>
						<tr>
							<th width="50%">Status</th>
							<td>
								<?php echo $status[$data->status]; ?>
							</td>
						</tr>
					</tbody>
				</table>
				<?php if ($data_pembayaran): ?>
				<h4>Data Pembayaran</h4>
				<table class="table mb-4">
					<tbody>
						<tr>
							<th width="50%">No Rekening</th>
							<td><?php echo $data_pembayaran->no_account; ?></td>
						</tr>
						<tr>
							<th width="50%">Pemilik Rekening</th>
							<td><?php echo $data_pembayaran->name_account; ?></td>
						</tr>
						<tr>
							<th width="50%">Nama Bank</th>
							<td><?php echo $data_pembayaran->bank_account; ?></td>
						</tr>
						<tr>
							<th width="50%">Bukti Pembayaran</th>
							<td><img src="<?php url('uploads/'.$data_pembayaran->proof); ?>" alt=""></td>
						</tr>
						<tr>
							<th width="50%">Waktu Pembayaran</th>
							<td><?php echo $data_pembayaran->created_at; ?></td>
						</tr>
					</tbody>
				</table>
				<?php endif ?>
			</div>
		</div>