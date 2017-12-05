<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['app_name'] = 'Resto Minang';


$config['capability'] = array(
    false,
    'member',
    'admin',
);

$config['main_menu'] = array(
    array(
        'id'            => 'home',
        'capability'    => array(false, 'member', 'admin'),
        'label'         => 'Home',
        'icon'          => 'fa-home',
        'url'           => 'home',
    ),
    array(
        'id'            => 'menu',
        'capability'    => array(false, 'member'),
        'label'         => 'Makanan & Minuman',
        'icon'          => 'fa-cutlery',
        'url'           => 'menu',
    ),
    array(
        'id'            => 'denah',
        'capability'    => array(false, 'member'),
        'label'         => 'Denah Meja',
        'icon'          => 'fa-map',
        'url'           => 'denah',
    ),
    array(
        'id'            => 'reservasi',
        'capability'    => array('admin'),
        'label'         => 'Reservasi',
        'icon'          => 'fa-ticket',
        'submenu'       => array(
            array(
                'id'            => 'reservasi',
                'capability'    => array('admin'),
                'label'         => 'Reservasi',
                'icon'          => 'fa-ticket',
                'url'           => 'reservasi/view',
            ),
            array(
                'id'            => 'laporan',
                'capability'    => array('admin'),
                'label'         => 'Laporan',
                'icon'          => 'fa-file',
                'url'           => 'laporan',
            ),
        ),
    ),
    array(
        'id'            => 'menu',
        'capability'    => array('admin'),
        'label'         => 'Menu',
        'icon'          => 'fa-cutlery',
        'submenu'       => array(
            array(
                'id'            => 'makanan',
                'capability'    => array('admin'),
                'label'         => 'Makanan',
                'icon'          => 'fa-spoon',
                'url'           => 'makanan',
            ),
            array(
                'id'            => 'minuman',
                'capability'    => array('admin'),
                'label'         => 'Minuman',
                'icon'          => 'fa-beer',
                'url'           => 'minuman',
            ),
        ),
    ),
    array(
        'id'            => 'denah',
        'capability'    => array('admin'),
        'label'         => 'Denah',
        'icon'          => 'fa-map',
        'url'           => 'denah/view',
    ),
    array(
        'id'            => 'user',
        'capability'    => array('admin'),
        'label'         => 'Users',
        'icon'          => 'fa-users',
        'submenu'       => array(
            array(
                'id'            => 'member',
                'capability'    => array('admin'),
                'label'         => 'Member',
                'icon'          => 'fa-user',
                'url'           => 'member',
            ),
            array(
                'id'            => 'admin',
                'capability'    => array('admin'),
                'label'         => 'Admin',
                'icon'          => 'fa-user-secret',
                'url'           => 'admin',
            ),
        ),
    ),
    array(
        'id'            => 'seting',
        'capability'    => array('admin'),
        'label'         => 'Seting',
        'icon'          => 'fa-cogs',
        'submenu'       => array(
            array(
                'id'            => 'app',
                'capability'    => array('admin'),
                'label'         => 'Setting App',
                'icon'          => 'fa-cog',
                'url'           => 'seting',
            ),
            array(
                'id'            => 'setting-pembayaran',
                'capability'    => array('admin'),
                'label'         => 'Pembayaran',
                'icon'          => 'fa-usd',
                'url'           => 'seting/pembayaran',
            ),
        ),
    ),
);

$config['second_menu'] = array(
    array(
        'id'            => 'login',
        'capability'    => array(false),
        'label'         => 'Login',
        'icon'          => 'fa-sign-in',
        'url'           => 'user/login',
    ),
    array(
        'id'            => 'register',
        'capability'    => array(false),
        'label'         => 'Register',
        'icon'          => 'fa-user',
        'url'           => 'user/register',
    ),
    array(
        'id'            => 'reservasi',
        'capability'    => array('member'),
        'label'         => 'Reservasi',
        'icon'          => 'fa-ticket',
        'url'           => 'reservasi',
    ),
);