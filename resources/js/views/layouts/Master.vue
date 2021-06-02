<template>
	<div class="app-admin-wrap layout-sidebar-large clearfix">
		<MyHeader></MyHeader>

		<Sidebar></Sidebar>
		<div
			class="main-content-wrap d-flex flex-column"
			v-bind:class="{ 'sidenav-open': sidenavOpen }"
		>
			<div class="main-content">
				<transition name="fade" mode="out-in">
					<router-view></router-view>
				</transition>
				<MyFooter></MyFooter>
			</div>
		</div>
	</div>
</template>

<script>
import Sidebar from "./Sidebar";
import MyHeader from "./Header";
import MyFooter from "./Footer";
import CurrentUser from "../../store/auth/AuthStore";
import CompStore from "../../store/component/ComptStore";
import { mapGetters, mapActions } from "vuex";

export default {
	components: {
		Sidebar,
		MyHeader,
		MyFooter,
	},
	data() {
		return {
			checking: "",
			progress: 0,
		};
	},
	beforeRouteUpdate(to, from, next) {
		// We are checking the authentication for every navigation or route
		// inside the application
		
		if (this.currentUser.isAuth) {
			next();
		} else {
			this.unAuth("UNAUTHENTICATED.")
		}
	},
	beforeRouteEnter(to, from, next) {
		// Check the authentication before
		// render the 'home' application
		// thanks for laravel-sanctum we can easier
		// to authenticate user through API
		axios
			.get("/api/getcurrent-user")
			.then((fun) => {
				// if user is authenticated
				// we send those users data through the store
				next((vm) => {
					vm.setUser(fun.data);
				});
			})
			.catch((e) => {
				// if user is not authenticated
				// we throw the user to login page
				next((vm) => {
					vm.unAuth(e.response.data.message);
				});
				
			});
	},
	beforeCreate() {
		var as = window.location.href;
		if (as == "http://127.0.0.1:8000/app") {
			window.location = "http://127.0.0.1:8000/unknown-page";
		}
	},
	created() {
		this.$store.registerModule("compt", CompStore);
	},
	beforeDestroy() {
		this.$store.unregisterModule("compt");
	},
	computed: {
		...mapGetters({ currentUser: "auth/getCurrentUser" }),
		...mapGetters({ sidebarStatus: "compt/getSidebarOpen" }),
		...mapGetters({ sidenavOpen: "compt/getSidenavOpen" }),
	},
	methods: {
		// ...mapActions(["auth/setCurrentUsers"]),
		unAuth(value) {
			const loading = this.$vs.loading({
				progress: 0,
				background: "#000000",
				text:
					value.toUpperCase() +
					" BUT DONT WORRY, WE WILL TAKE YOU TO SAFE PLACE :)",
				color: "#fff",
				type: "scale",
			});
			const interval = setInterval(() => {
				if (this.progress <= 100) {
					loading.changeProgress(this.progress++);
				}
			}, 20);

			setTimeout(() => {
				loading.close();
				clearInterval(interval);
				this.progress = 0;
				this.$router.push({ name: "login.page" });
			}, 2450);
		},
		setUser(value) {
			this.$store.dispatch("auth/setCurrentUsers", value);
		},
	},
};
</script>

<style>
.fade-enter-active,
.fade-leave-active {
	transition: opacity 0.3s ease;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
	opacity: 0;
}
</style>