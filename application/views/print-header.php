<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<title><?php 
	if (isset($print_title)) {
		echo $print_title;
	}
	?></title>

	<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
	<link rel="icon" href="img/favicon.ico" type="image/x-icon">

	<!-- Bootstrap Core CSS -->
	<link href="<?php asset('css/bootstrap.min.css') ?>" rel="stylesheet">
	<!-- Custom CSS -->
	<link href="<?php asset('css/style.css') ?>" rel="stylesheet">
	<!-- Custom Fonts -->
	<link href="<?php asset('vendor/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet" type="text/css">

</head>

<body class="body-print" onload="window.print()">

