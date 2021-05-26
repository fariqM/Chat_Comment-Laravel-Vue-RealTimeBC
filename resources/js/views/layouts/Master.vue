<template>
	<div class="app-admin-wrap layout-sidebar-large clearfix">
		<MyHeader></MyHeader>

		<Sidebar></Sidebar>
		<div class="main-content-wrap sidenav-open d-flex flex-column">
			<div class="main-content">
				<transition name="fade" mode="out-in">
					<router-view></router-view>
				</transition>
				<!-- {{-- @yield('main-content') --}} -->

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
		MyFooter,
	},
	
};
</script>

<style>
.fade-enter-active, .fade-leave-active {
  transition: opacity .3s ease;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}
</style>