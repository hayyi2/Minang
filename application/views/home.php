<?php get_message_flash() ?>
<div class="jumbotron">
	<div class="text-center">
		<?php if (get_option('banner') != ""): ?>
			<img src="<?php url('uploads/'.get_option('banner')) ?>" alt="<?php echo get_option('banner') ?>" class="mb-3">
		<?php endif ?>
	</div>
	<h1 class="display-3"><?php echo get_option('greeting') ?></h1>
	<p class="lead"><?php echo get_option('app_description') ?></p>
	<?php if (!current_user_data()): ?>
		<p class="lead mb-4">Silahkan <a href="<?php url('user/login') ?>">Login</a> atau <a href="<?php url('user/register') ?>">Register</a> untuk memulai pemesanan.</p>
	<?php endif ?>
	<p class="lead">
		<a class="btn btn-primary btn-lg" href="<?php url('menu') ?>">Lihat Menu</a>
		<a class="btn btn-info btn-lg" href="<?php url('denah') ?>">Lihat Tempat</a>
	</p>
</div>