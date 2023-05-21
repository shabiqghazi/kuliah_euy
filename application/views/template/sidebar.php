<!-- Sidebar -->
<ul class="navbar-nav sidebar text-light accordion animated--slide-in sticky-top" style="transition: 0.3s ; background-color:#8DAADE" id="accordionSidebar navbarScroll">
	<!-- Sidebar - Brand -->
	<a class="sidebar-brand d-flex align-items-center text-light justify-content-center" href="index.html">
		<div class="sidebar-brand-icon">
			<i class="fas fa-book-reader"></i>
		</div>
		<div class="sidebar-brand-text mx-3">kuliah euy</div>
	</a>
	<?php $menusidebar = sidebar_menu($user['role_id']) ?>

	<?php foreach($menusidebar as $ms): ?>
	<!-- Divider -->
	<hr class="sidebar-divider" style="border-color:#fff;">
	<!-- Heading -->
	<div class="sidebar-heading">
		<?= $ms['menu'] ?>
	</div>
	<?php $this->load->model('Model_menu', 'menu');
		  $submenu_sidebar = sidebar_submenu($ms['menu_id']);
	 ?>
		<?php foreach($submenu_sidebar as $sms): ?>
		<!-- Nav Item -->
		<li class="nav-item py-1 <?= $title == $sms['title'] ? "active rounded" : ""; ?>" style="background-color: <?= $title == $sms['title'] ? "#f0f0f0" : ""; ?>;">
			<a class="nav-link py-1" href="<?= base_url() . $sms['url']; ?>">
				<i class="<?= $title == $sms['title'] ? "text-secondary" : "text-white"; ?> <?= $sms['icon'] ?>"></i>
				<span class="<?= $title == $sms['title'] ? "text-secondary" : "text-white"; ?>"><?= $sms['title'] ?></span>
			</a>
		</li>
		<?php endforeach; ?>
	<?php endforeach; ?>
	<!-- Divider -->
	<hr class="sidebar-divider d-none d-md-block" style="border-color:#fff;">
	<!-- Sidebar Toggler (Sidebar) -->
	<div class="text-center d-none d-md-inline">
		<button class="rounded-circle border-0" id="sidebarToggle"></button>
	</div>
</ul>
<!-- End of Sidebar -->