		<h2 class="text-center mb-4">Kelola Reservasi</h2>
		<?php get_message_flash() ?>
		<h4>Data Reservasi</h4>
		<table class="table mb-4">
			<thead>
				<tr>
					<th>No</th>
					<th>Name</th>
					<th>Kode</th>
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
					<td><a href="<?php url('member/edit/'.$item->user_id) ?>"><?php echo $item->name; ?></a></td>
					<td><?php echo strtoupper(substr(sha1($item->reservasi_id), -6)) ; ?></td>
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
							-
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
						<?php if ($item->status == 4): ?>
						<a href="<?php url('reservasi/ready/'.$item->reservasi_id) ?>" class="btn btn-primary btn-sm"><i class="fa fa-fw fa-cutlery"></i></a>
						<?php endif ?>
						<?php if ($item->status == 3): ?>
						<a href="<?php url('reservasi/konfirmasi/'.$item->reservasi_id) ?>" class="btn btn-primary btn-sm"><i class="fa fa-fw fa-usd"></i></a>
						<?php endif ?>
						<a href="<?php url('reservasi/full/'.$item->reservasi_id) ?>" class="btn btn-info btn-sm"><i class="fa fa-fw fa-eye"></i></a>
						<a onclick="return confirm('Apakah anda yakin akan menghapus data?')" href="<?php url('reservasi/delete/'.$item->reservasi_id) ?>" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i></a>
					</td>
				</tr>
				<?php endforeach ?>
			</tbody>
		</table>
