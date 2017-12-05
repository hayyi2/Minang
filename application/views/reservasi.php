		<h2 class="text-center mb-4">Reservasi</h2>
		<?php get_message_flash() ?>
		<h4>Data Reservasi</h4>
		<table class="table mb-4">
			<thead>
				<tr>
					<th>No</th>
					<th>Makanan</th>
					<th>Minuman</th>
					<th>Tempat</th>
					<th>Tanggal</th>
					<th class="text-nowrap">Total Bayar</th>
					<th>Status</th>
					<th width="1"></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($data as $no => $item): ?>
				<tr>
					<td><?php echo $no + 1; ?></td>
					<td>
						<ul>
							<?php foreach (json_decode($item->menu) as $menu): ?>
								<?php if ($menu[0] == 1): ?>
									<li><?php echo $menu[2] . "(" . $menu[1] . ")" ; ?></li>
								<?php endif ?>
							<?php endforeach ?>
						</ul>
					</td>
					<td>
						<ul>
							<?php foreach (json_decode($item->menu) as $menu): ?>
								<?php if ($menu[0] == 2): ?>
									<li><?php echo $menu[2] . "(" . $menu[1] . ")" ; ?></li>
								<?php endif ?>
							<?php endforeach ?>
						</ul>
					</td>
					<?php if ($item->status == 1): ?>
						<td colspan="2">
							<a href="<?php url('denah') ?>" class="btn btn-primary btn-sm mb-2"><i class="fa fa-fw fa-plus"></i> Pesan Tempat</a>
						</td>
					<?php else: ?>
						<td>
							<ul>
								<?php foreach (json_decode($item->detail_table) as $menu): ?>
									<li><?php echo $menu[0] . " - " . $menu[1] ; ?></li>
								<?php endforeach ?>
							</ul>
						</td>
						<td><?php echo $item->date; ?></td>
					<?php endif ?>
					<td><?php echo money_formating($item->total); ?></td>
					<td><?php echo $status[$item->status]; ?></td>
					<td class="text-center text-nowrap">
						<?php if ($item->status <= 2): ?>
							<a href="<?php url('reservasi/detail/'.$item->reservasi_id) ?>" class="btn btn-info btn-sm"><i class="fa fa-fw fa-pencil"></i></a>
						<?php else: ?>
							<a href="<?php url('reservasi/detail/'.$item->reservasi_id) ?>" class="btn btn-primary btn-sm"><i class="fa fa-fw fa-eye"></i></a>
						<?php endif ?>
						<?php if ($item->status == 2): ?>
							<a href="<?php url('pembayaran') ?>" class="btn btn-primary btn-sm"><i class="fa fa-fw fa-credit-card"></i></a>
						<?php endif ?>
						<?php if ($item->status < 5 && strtotime($item->date) > strtotime('+3 hours', strtotime(date('Y-m-d H:00')))): ?>
							<a href="<?php url('reservasi/batal/'.$item->reservasi_id) ?>" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-close"></i></a>
						<?php endif ?>
					</td>
				</tr>
				<?php endforeach ?>
			</tbody>
		</table>
