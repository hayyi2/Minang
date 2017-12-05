		<h2 class="text-center mb-4">Manage Denah</h2>
		<?php get_message_flash() ?>
		<div class="float-right">
			<a href="<?php url('denah') ?>" class="btn btn-info btn-sm mb-2"><i class="fa fa-fw fa-eye"></i> View Denah</a>
			<a href="<?php url('denah/input/poin') ?>" class="btn btn-primary btn-sm mb-2"><i class="fa fa-fw fa-plus"></i> Add New Denah</a>
		</div>
		<h4>Data Denah</h4>
		<table class="table mb-4">
			<thead>
				<tr>
					<th width="5">No</th>
					<th>Poin</th>
					<th>Meja</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$row_span = 1;
				foreach ($data as $no => $item): ?>
					<tr>
						<td class="text-nowrap"><?php echo $no + 1; ?></td>
						<?php if ($row_span == 1):?>
							<?php 
							while (isset($data[$no + $row_span]) && $item->name == $data[$no + $row_span]->name) {
								$row_span++;
							} 
							?>
							<td <?php if($row_span > 1) echo 'rowspan="' . $row_span . '"'; ?> width="75%">
								<?php echo $item->name; ?> <br>
								<?php if ($item->thumbnail != ""): ?>
									<img src="<?php url('uploads/'.$item->thumbnail) ?>" alt="<?php echo $item->thumbnail ?>"><br>
								<?php endif ?>
								<a href="<?php url('denah/edit/poin/'.$item->place_id) ?>" class="btn btn-success btn-sm mt-2"><i class="fa fa-fw fa-pencil"></i> Edit Denah</a>
								<a onclick="return confirm('Apakah anda yakin akan menghapus data?')" href="<?php url('denah/delete/poin/'.$item->place_id) ?>" class="btn btn-danger btn-sm mt-2"><i class="fa fa-fw fa-trash"></i> Delete Denah</a>
								<a href="<?php url('denah/input/meja/'.$item->place_id) ?>" class="btn btn-primary btn-sm mt-2"><i class="fa fa-fw fa-plus"></i> Add New Meja</a>
							</td>
						<?php else:  $row_span--;?>
						<?php endif ?>
						<td class="text-nowrap">
							<?php if ($item->place_detail_id != null): ?>
								<span class="float-right">
									<a href="<?php url('denah/edit/meja/'.$item->place_detail_id) ?>" class="btn btn-success btn-sm"><i class="fa fa-fw fa-pencil"></i></a>
									<a onclick="return confirm('Apakah anda yakin akan menghapus data?')" href="<?php url('denah/delete/meja/'.$item->place_detail_id) ?>" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i></a>
								</span>
								<?php echo $item->table_name; ?>
							<?php endif ?>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>