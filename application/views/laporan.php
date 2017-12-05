		<h2 class="text-center mb-4">Laporan</h2>
		<?php get_message_flash() ?>
		<form class="form-inline mb-3" action="<?php url('laporan') ?>" method="post">
			<div class="form-group">
				<div class="input-group date form_date2" data-date="" data-date-format="yyyy-mm-dd hh:00" data-link-field="tgl_hingga" data-link-format="yyyy-mm-dd hh:00">
					<span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                    <input name="start" class="form-control" required="" type="text" value="<?php if(isset($start)) echo $start ?>" placeholder="Tanggal">
                </div>
			</div>
			<div class="form-group mx-sm-2">
				<div class="input-group date form_date2" data-date="" data-date-format="yyyy-mm-dd hh:00" data-link-field="tgl_hingga" data-link-format="yyyy-mm-dd hh:00">
					<span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                    <input name="end" class="form-control" required="" type="text" value="<?php if(isset($start)) echo $start ?>" placeholder="Hingga Tanggal">
                </div>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-eye"></i> Lihat Data</button>
			</div>
		</form>
		<h4>Data Reservasi</h4>
		<table class="table mb-4">
			<thead>
				<tr>
					<th>No</th>
					<th>Name</th>
					<th>Kode</th>
					<th>Makanan</th>
					<th>Minuman</th>
					<th>Tanggal</th>
					<th class="text-nowrap">Total Bayar</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$total = 0;
				foreach ($data as $no => $item): ?>
				<tr>
					<td><?php echo $no + 1; ?></td>
					<td><?php echo $item->name; ?></td>
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
					<td><?php echo $item->date; ?></td>
					<td><?php echo money_formating($item->total); $total += $item->total;?></td>
				</tr>
				<?php endforeach ?>
			</tbody>
			<tfoot>
				<tr>
					<th colspan="6">Total Pemasukan</th>
					<td><?php echo money_formating($total); ?></td>
				</tr>
			</tfoot>
		</table>
