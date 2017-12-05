<?php 

function current_user_data($key = false)
{
	$CI =& get_instance();
	$session_data = $CI->session->userdata('current_user');

	if( $key ) {
		if( isset( $session_data[ $key ] ) )
			return $session_data[ $key ];
		else return false;
	}
	else return $session_data;
}

function protected_page($access_role = false){
	if (!$access_role) {
		$access_role = get_app_config('access_roles');
	}

	$capability = current_user_data('capability');

	$login_url 	= 'user/login';
	$no_go 		= array('user/logout');
	$main_url 	= (($capability == 'admin') ? '/reservasi/view' : 'home');

	if (!$capability) {
		$uri_string = uri_string();
		if( !in_array( $uri_string, $no_go))
			$login_url .= ('?go='.$uri_string);

		set_message_flash('Anda harus login terlebih dahulu.');
		redirect($login_url);
	}if (!in_array($capability, $access_role)) {
		set_message_flash('Anda tidak boleh menangakses halaman tersebut.');
		redirect($main_url);
	}
}