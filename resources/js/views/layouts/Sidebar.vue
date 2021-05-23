<template>
	<div>
		<div
			class="sidebar-left open rtl-ps-none"
			data-perfect-scrollbar
			data-suppress-scroll-x="true"
		>
			<ul class="navigation-left">
				<li class="nav-item active" data-item="dashboard">
					<a class="nav-item-hold" href="#">
						<i class="nav-icon i-Bar-Chart"></i>
						<span class="nav-text">Dashboard</span>
					</a>
					<div class="triangle"></div>
				</li>
				<li class="nav-item" data-item="uikits">
					<a class="nav-item-hold" href="#">
						<i class="nav-icon i-Library"></i>
						<span class="nav-text">Chat App</span>
					</a>
					<div class="triangle"></div>
				</li>
			</ul>
		</div>

		<div
			class="sidebar-left-secondary rtl-ps-none"
			data-perfect-scrollbar
			data-suppress-scroll-x="true"
		>
			<!-- Submenu Dashboards -->
			<ul class="childNav" data-parent="dashboard">
				<li class="nav-item">
					<a>
						<i class="nav-icon i-Clock-3"></i>
						<span class="item-name">Version 1</span>
					</a>
				</li>
				<!-- <li class="nav-item">
					<a
						href="{{route('dashboard_version_2')}}"
						class="{{ Route::currentRouteName()=='dashboard_version_2' ? 'open' : '' }}"
					>
						<i class="nav-icon i-Clock-4"></i>
						<span class="item-name">Version 2</span>
					</a>
				</li> -->
			</ul>
			<ul class="childNav" data-parent="uikits">
				<li class="nav-item">
					<a>
						<i class="nav-icon i-Bell1"></i>
						<span class="item-name">Notification</span>
					</a>
				</li>
				<li class="nav-item">
					<a>
						<i class="nav-icon i-Split-Horizontal-2-Window"></i>
						<span class="item-name">Chat Room</span>
					</a>
				</li>
			</ul>
		</div>
		<div class="sidebar-overlay"></div>
	</div>
</template>

<script>
export default {};
</script>

<style>
</style>