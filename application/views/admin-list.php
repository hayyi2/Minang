		<h2 class="text-center mb-4">Manage Admin</h2>
		<?php get_message_flash() ?>
		<a href="<?php url('admin/input') ?>" class="btn btn-primary btn-sm mb-2 float-right"><i class="fa fa-fw fa-plus"></i> Add New Admin</a>
		<h4>Data Admin</h4>
		<table class="table mb-4">
			<thead>
				<tr>
					<th>No</th>
					<th>Name</th>
					<th>Email</th>
					<th>Created at</th>
					<th>Updated at</th>
					<th width="1">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($data as $no => $item): ?>
					<tr>
						<td><?php echo $no + 1; ?></td>
						<td><?php echo $item->name; ?></td>
						<td><?php echo $item->email; ?></td>
						<td><?php echo $item->created_at; ?></td>
						<td><?php echo $item->updated_at; ?></td>
						<td class="text-nowrap text-center">
							<a href="<?php url('admin/edit/'.$item->user_id) ?>" class="btn btn-success btn-sm"><i class="fa fa-fw fa-pencil"></i></a>
							<?php if ($no > 0): ?>
								<a onclick="return confirm('Apakah anda yakin akan menghapus data?')" href="<?php url('admin/delete/'.$item->user_id) ?>" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i></a>
							<?php endif ?>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>