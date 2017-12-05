		<div class="container">
			<h2 class="text-center mb-4">Bukti Pemesanan</h2>
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
				</tbody>
			</table>
		</div>