<template>
	<div class="side-content-wrap">
		<div
			v-bind:class="{ open: SidebarOpen }"
			class="sidebar-left rtl-ps-none"
			
			data-suppress-scroll-x="true"
		>
			<ul class="navigation-left">
				<li
					class="nav-item"
					data-item="dashboard"
					v-bind:class="{ active: IsActive }"
				>
					<a class="nav-item-hold" @click="DashboardHandler">
						<i class="nav-icon i-Bar-Chart"></i>
						<span class="nav-text">Dashboard</span>
					</a>
					<div class="triangle"></div>
				</li>
				<li
					class="nav-item"
					data-item="uikits"
					v-bind:class="{ active: IsActiveChat }"
				>
					<a class="nav-item-hold" @click="ChatHandler">
						<i class="nav-icon i-Library"></i>
						<span class="nav-text">Chat App</span>
					</a>
					<div class="triangle"></div>
				</li>
			</ul>
		</div>
	</div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
	data() {
		return {
			IsActive: false,
			IsActiveChat: false,
		};
	},
	computed: {
		...mapGetters({ SidebarOpen: "compt/getSidebarOpen" }),
	},
	created() {
		// setTimeout(() => this.$store.dispatch("compt/setSidebarOpen"), 70);
		
	},

	methods: {
		DashboardHandler() {
			this.$router.push({ name: "home" }).catch((err) => {});
			this.IsActive = true;
			this.IsActiveChat = false;
			console.log(this.SidebarOpen);
		},
		ChatHandler() {
			this.$router.push({ name: "chat" }).catch((err) => {});
			this.IsActiveChat = true;
			this.IsActive = false;
		},
	},
};
</script>

<style>
</style>