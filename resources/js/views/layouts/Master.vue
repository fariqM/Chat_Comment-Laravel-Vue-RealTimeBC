<template>
	<div class="app-admin-wrap layout-sidebar-large clearfix">
		<MyHeader></MyHeader>

		<Sidebar></Sidebar>
		<div class="main-content-wrap d-flex flex-column" v-bind:class="{'sidenav-open': sidenavOpen}">
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
	beforeCreate(){
		// console.log(window.location.href);
		var as= window.location.href
		if(as == "http://127.0.0.1:8000/app"){
			// console.log("move");
			window.location = "http://127.0.0.1:8000/unknown-page"
		} else {
			// console.log("dont move");
		}
	},
	created() {
		this.$store.registerModule("compt", CompStore);
	},
	beforeDestroy() {
		this.$store.unregisterModule("compt");
	},
	computed:{
		...mapGetters({ sidebarStatus: "compt/getSidebarOpen" }),
		...mapGetters({ sidenavOpen: "compt/getSidenavOpen"}),
		
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