		<h2 class="text-center mb-4">Manage Member</h2>
		<?php get_message_flash() ?>
		<a href="<?php url('member/input') ?>" class="btn btn-primary btn-sm mb-2 float-right"><i class="fa fa-fw fa-plus"></i> Add New Member</a>
		<h4>Data Member</h4>
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
							<a href="<?php url('member/edit/'.$item->user_id) ?>" class="btn btn-success btn-sm"><i class="fa fa-fw fa-pencil"></i></a>
							<a onclick="return confirm('Apakah anda yakin akan menghapus data?')" href="<?php url('member/delete/'.$item->user_id) ?>" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i></a>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>