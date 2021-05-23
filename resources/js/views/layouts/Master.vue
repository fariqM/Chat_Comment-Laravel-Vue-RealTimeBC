<template>
	<div class="app-admin-wrap layout-sidebar-large clearfix">
		<MyHeader></MyHeader>

		<Sidebar></Sidebar>
		<div class="main-content-wrap sidenav-open d-flex flex-column">
			<div class="main-content">
				<div>
					<!-- <router-view></router-view> -->
					<!-- {{-- @yield('main-content') --}} -->
				</div>
				<MyFooter></MyFooter>
				
			</div>
		</div>
	</div>
</template>

<script>
import Sidebar from "./Sidebar";
import MyHeader from "./Header";
import MyFooter from "./Footer";

export default {
	components: {
		Sidebar,
		MyHeader,
		MyFooter
	},
};
</script>

<style>
</style>