		<h2 class="text-center mb-4">Manage <?php echo ucwords($category); ?></h2>
		<?php get_message_flash() ?>
		<div class="float-right">
			<a href="<?php url('menu/'.$category) ?>" class="btn btn-info btn-sm mb-2"><i class="fa fa-fw fa-eye"></i> View <?php echo ucwords($category); ?></a>
			<a href="<?php url($category . '/input') ?>" class="btn btn-primary btn-sm mb-2"><i class="fa fa-fw fa-plus"></i> Add New <?php echo ucwords($category); ?></a>
		</div>
		<h4>Data <?php echo ucwords($category); ?></h4>
		<table class="table mb-4">
			<thead>
				<tr>
					<th>No</th>
					<th>Name</th>
					<th>Description</th>
					<th>Price</th>
					<th>Thumbnail</th>
					<th width="1">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($data as $no => $item): ?>
					<tr>
						<td><?php echo $no + 1; ?></td>
						<td><?php echo $item->name; ?></td>
						<td><?php echo $item->description; ?></td>
						<td><?php echo money_formating($item->price); ?></td>
						<td width="100">
							<?php if ($item->thumbnail != ""): ?>
								<img src="<?php url('uploads/'.$item->thumbnail) ?>" alt="<?php echo $item->thumbnail ?>"><br>
							<?php endif ?>
						</td>
						<td class="text-nowrap text-center">
							<a href="<?php url($category . '/edit/' . $item->menu_id) ?>" class="btn btn-success btn-sm"><i class="fa fa-fw fa-pencil"></i></a>
							<a onclick="return confirm('Apakah anda yakin akan menghapus data?')" href="<?php url($category . '/delete/' . $item->menu_id) ?>" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i></a>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>