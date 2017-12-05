		<h2 class="text-center mb-4">Makanan & Minuman</h2>
		<ul class="nav nav-pills text-center mb-3 justify-content-center">
			<?php foreach ($category as $value): ?>
				<li class="nav-item">
					<a class="nav-link<?php if($active_submenu == $value) echo ' active' ?>" href="<?php url('menu/'.$value) ?>"><?php echo ucwords($value); ?></a>
				</li>
			<?php endforeach ?>
		</ul>
		<?php get_message_flash() ?>
		<div class="row">
			<?php foreach ($data as $item): ?>
			<div class="col-sm-4">
				<div class="card mb-4">
					<?php if ($item->thumbnail != ""): ?>
						<img src="<?php url('uploads/'.$item->thumbnail) ?>" alt="<?php echo $item->thumbnail ?>" class="card-img-top">
					<?php endif ?>
					<div class="card-body">
						<h4 class="card-title"><?php echo $item->name; ?></h4>
						<div class="card-text mb-2"><?php echo $item->description; ?></div>
						<?php if (!current_user_data() || current_user_data('capability') == 'admin'): ?>
							<div><?php echo money_formating($item->price); ?></div>
						<?php else: ?>
							<div class="float-right mt-1"><?php echo money_formating($item->price); ?></div>
							<div>
								<form class="form-inline" action="<?php url('reservasi/menu/' . $item->menu_id . '/' . $active_submenu ) ?>" method="post">
									<div class="form-group">
										<input name="sum" type="number" min="1" value="1" style="width: 60px;" class="form-control form-control-sm">
									</div>
									<div class="form-group mx-sm-2">
										<button type="submit" class="btn btn-info btn-sm">Pesan</button>
									</div>
								</form>
							</div>
						<?php endif ?>
					</div>
				</div>
			</div>
			<?php endforeach ?>
		</div>