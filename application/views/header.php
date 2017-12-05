<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title><?php echo $title . ' - ' . get_option('app_name'); ?></title>

	<!-- Bootstrap Core CSS -->
	<link href="<?php asset('css/bootstrap.min.css') ?>" rel="stylesheet">
	<!-- Custom CSS -->
	<link href="<?php asset('css/style.css') ?>" rel="stylesheet">
	<!-- Custom Fonts -->
	<link href="<?php asset('vendor/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet" type="text/css">

	<!-- jQuery -->
	<script src="<?php asset('js/jquery-3.2.1.min.js') ?>"></script>
	<!-- Bootstrap Core JavaScript -->
	<script src="<?php asset('js/popper.min.js') ?>"></script>
	<script src="<?php asset('js/bootstrap.min.js') ?>"></script>

	<!-- Bootstrap Datetime picker -->
	<link href="<?php asset('vendor/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css'); ?>" rel="stylesheet">
	<script type="text/javascript" src="<?php asset('vendor/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js'); ?>" charset="UTF-8"></script>

	<!-- script -->
	<script src="<?php asset('js/script.js') ?>"></script>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
		<div class="container-fluid">
			<a class="navbar-brand" href="<?php echo base_url() ?>"><?php echo get_option('app_name'); ?></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-main" aria-controls="navbar-main" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbar-main">
				<ul class="navbar-nav mr-auto">
					<?php foreach (get_app_config('main_menu') as $menu): 
						$active_submenu = false;
						if (isset($menu['submenu'])) {
							foreach ($menu['submenu'] as $submenu) {
								if ($submenu['id'] == $acive_menu) {
									$active_submenu = true;
								}
							}
						}
						?>
						<?php if (in_array(current_user_data('capability'), $menu['capability'])): ?>
							<?php if (isset($menu['submenu'])): ?>
								<li class="nav-item dropdown<?php if($active_submenu || $acive_menu == $menu['id']) echo " active"; ?>">
									<a class="nav-link dropdown-toggle" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<i class="fa fa-fw <?php echo $menu['icon']; ?>"></i> 
										<?php echo $menu['label']; ?>
									</a>
									<div class="dropdown-menu">
										<?php foreach ($menu['submenu'] as $submenu): ?>
											<a class="dropdown-item<?php if($acive_menu == $submenu['id']) echo " active"; ?>" href="<?php url($submenu['url']); ?>"><i class="fa fa-fw <?php echo $submenu['icon']; ?>"></i> <?php echo $submenu['label']; ?></a>
										<?php endforeach ?>
									</div>
								</li>
							<?php else: ?>
								<li class="nav-item<?php if($acive_menu == $menu['id']) echo " active"; ?>">
									<a class="nav-link" href="<?php url($menu['url']); ?>"><i class="fa fa-fw <?php echo $menu['icon']; ?>"></i> <?php echo $menu['label']; ?></a>
								</li>
							<?php endif ?>
						<?php endif ?>
					<?php endforeach ?>
				</ul>
				<ul class="navbar-nav">
					<?php 
					$second_menu = get_app_config('second_menu');
					$capability = get_app_config('capability');
					unset($capability[0]);
					if (in_array(current_user_data('capability'), $capability)) {
						$second_menu[] = array(
					        'id'            => 'user',
					        'capability'    => $capability,
					        'label'         => current_user_data('name'),
        					'icon'          => 'fa-user',
					        'submenu'       => array(
					            array(
					                'id'            => 'profile',
					                'capability'    => $capability,
					                'label'         => 'Profile',
        							'icon'          => 'fa-user',
					                'url'           => 'user/profile',
					            ),
					            array(
					                'id'            => 'logout',
					                'capability'    => $capability,
					                'label'         => 'Logout',
        							'icon'          => 'fa-sign-out',
					                'url'           => 'user/logout',
					            ),
					        ),
					    );
					}
					foreach ($second_menu as $menu): 
						$active_submenu = false;
						if (isset($menu['submenu'])) {
							foreach ($menu['submenu'] as $submenu) {
								if ($submenu['id'] == $acive_menu) {
									$active_submenu = true;
								}
							}
						}
						?>
						<?php if (in_array(current_user_data('capability'), $menu['capability'])): ?>
							<?php if (in_array(current_user_data('capability'), $menu['capability'])): ?>
								<?php if (isset($menu['submenu'])): ?>
									<li class="nav-item dropdown<?php if($active_submenu) echo " active"; ?>">
										<a class="nav-link dropdown-toggle" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<i class="fa fa-fw <?php echo $menu['icon']; ?>"></i> 
											<?php echo $menu['label']; ?>
										</a>
										<div class="dropdown-menu dropdown-menu-right">
											<?php foreach ($menu['submenu'] as $submenu): ?>
												<a class="dropdown-item<?php if($acive_menu == $submenu['id']) echo " active"; ?>" href="<?php url($submenu['url']); ?>"><i class="fa fa-fw <?php echo $submenu['icon']; ?>"></i> <?php echo $submenu['label']; ?></a>
											<?php endforeach ?>
										</div>
									</li>
								<?php else: ?>
									<li class="nav-item<?php if($acive_menu == $menu['id']) echo " active"; ?>">
										<a class="nav-link" href="<?php url($menu['url']); ?>"><i class="fa fa-fw <?php echo $menu['icon']; ?>"></i> <?php echo $menu['label']; ?></a>
									</li>
								<?php endif ?>
							<?php endif ?>
						<?php endif ?>
					<?php endforeach ?>
				</ul>
			</div>
		</div>
	</nav>
	<div class="container">