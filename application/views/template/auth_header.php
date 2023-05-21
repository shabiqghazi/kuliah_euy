<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.css') ?>" crossorigin="anonymous">

	<link rel="icon" href="<?=base_url('assets/img/')?>favicon.svg" type="image/svg">
	<link href="<?= base_url('assets/') ?>css/sb-admin-2.min.css" rel="stylesheet">
	<title><?= $title ?></title>
	<!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/') ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Poppins"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/') ?>css/sb-admin-2.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/') ?>css/style.css" rel="stylesheet">
    <style>
    	*{
    		font-family: Poppins;
    	}
    </style>
</head>
<body class="bg-white">

<div class="sticky-top">
	<nav class="navbar navbar-expand-lg navbar-dark bg-blue p-3" style="background-color:#8DAADE">
		<div class="container">
			<a class="navbar-brand text-white" href="<?= base_url() ?>"><i class="fas fa-book-reader"></i><h4 class="d-inline mx-3 font-weight-bold">Kuliah Euy</h4></a>
			<span class="navbar-text" align="right">
				<a href="<?= base_url('auth/login') ?>" class="navbar-text" align="right">Login</a> | 
				<a href="<?= base_url('auth/registration') ?>" class="navbar-text" align="right">Daftar</a>
			</span>
		</div>
	</nav>
</div>