<template>
	<div class="app-admin-wrap layout-sidebar-large clearfix">
		<MyHeader></MyHeader>

		<Sidebar></Sidebar>
		<div class="main-content-wrap d-flex flex-column">
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
import CompStore from "../../store/component/ComptStore"
import {  mapGetters } from "vuex";


export default {
	components: {
		Sidebar,
		MyHeader,
		MyFooter,
	},
	created() {
		this.$store.registerModule("compt", CompStore);
	},
	beforeDestroy() {
		this.$store.unregisterModule("compt");
	},
	computed:{
		...mapGetters({ sidebarStatus: "compt/getSidebarOpen" }),
		
	},
	methods:{
		
	}
	
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