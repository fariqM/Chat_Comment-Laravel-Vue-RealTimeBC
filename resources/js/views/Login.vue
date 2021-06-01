<template>
	<div
		class="auth-layout-wrap"
		style="background-image: url(/assets/images/photo-wide-4.jpg)"
	>
		<div class="auth-content">
			<div class="card o-hidden">
				<div class="row">
					<div class="col-md-6">
						<div class="p-4">
							<div class="auth-logo text-center mb-4">
								<img :src="'/assets/images/logo.png'" alt="" />
							</div>
							<h1 class="mb-3 text-18">Sign in</h1>
							<form @submit.prevent="handleLogin">
								<div class="form-group">
									<label for="email">Email address</label>
									<input
										v-model="form.email"
										id="email"
										class="form-control form-control-rounded"
										type="email"
									/>
								</div>
								<div class="form-group">
									<label for="password">Password</label>
									<input
										v-model="form.password"
										id="password"
										class="form-control form-control-rounded"
										type="password"
									/>
								</div>
								<button class="btn btn-rounded btn-primary btn-block mt-2">
									Sign In
								</button>
							</form>
							<button
								v-on:click="logout"
								class="btn btn-rounded btn-primary btn-block mt-2"
							>
								Trial Logout
							</button>

							<div class="mt-3 text-center">
								<a href="forgot.html" class="text-muted"
									><u>Forgot Password?</u></a
								>
							</div>
						</div>
					</div>
					<div
						class="col-md-6 text-center"
						style="
							background-size: cover;
							background-image: url(/assets/images/photo-long-3.jpg);
						"
					>
						<div class="pr-3 auth-right">
							<router-link
								class="btn btn-rounded btn-outline-primary btn-outline-email btn-block btn-icon-text"
								:to="{ name: 'register.page' }"
							>
								<i class="i-Mail-with-At-Sign"></i> Sign up with Email
							</router-link>
							<router-link
								class="btn btn-rounded btn-outline-primary btn-outline-email btn-block btn-icon-text"
								:to="{ name: 'home' }"
							>
								<i class="i-Mail-with-At-Sign"></i> View Inside
							</router-link>
							<a
								class="btn btn-rounded btn-outline-primary btn-outline-email btn-block btn-icon-text"
								@click="CheckData"
							>
								<i class="i-Mail-with-At-Sign"></i> Check Data
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	data() {
		return {
			contacts: [],
			progress: 0,
			form: {
				email: "fariq@gmail.com",
				password: "rangga1822",
			},
		};
	},
	methods: {
		handleLogin() {
			// open loading section
			const loading = this.$vs.loading({
				progress: 0,
				color: "#7d33ff",
				type: "scale",
			});
			const interval = setInterval(() => {
				if (this.progress <= 100) {
					loading.changeProgress(this.progress++);
				}
			}, 15);
			// end open loading section

			axios.get("/sanctum/csrf-cookie").then((fun) => {
				try {
					axios
						.post("/login", this.form)
						.then((response) => {
							if (response.status == 204) {
								// close loading section
								loading.close();
								clearInterval(interval);
								this.progress = 0;
								// end close loading section
								// console.log(response.status);
								this.$router.push({ name: "home" });
							}
							// status 200 is when the token is same with last auth
							else if (response.status == 200) {
								// close loading section
								loading.close();
								clearInterval(interval);
								this.progress = 0;
								this.reLogin();
								// end close loading section
							}
						})
						.catch((error) => {
							console.log(error);
						});
				} catch (error) {
					console.log(error);
				}
			});
		},
		reLogin() {
			const loading = this.$vs.loading({
				background: '#505050',
				progress: 0,
				color: "#fff",
				type: "scale",
				text:
					"<h2>Similiar user, please logout before login with another account</h2>",
			});
			const interval = setInterval(() => {
				if (this.progress <= 100) {
					loading.changeProgress(this.progress++);
				}
			}, 30);
			setTimeout(() => {
				loading.close();
				clearInterval(interval);
				this.progress = 0;
				this.$router.push({ name: "home" });
			}, 3000);
		},
		async CheckData() {
			try {
				let { data } = await axios.get("/api/getcontacts");

				console.log(data);
				// axios.get("/api/getcontacts").then((fun) => {
				// 	console.log(fun);
				// });
			} catch (e) {
				// console.log(e);
			}
			// axios.get("/sanctum/csrf-cookie").then((response) => {
			// 	try {
			// 		axios.get("/api/getcontacts").then((fun) => {
			// 			console.log(fun);
			// 		});
			// 	} catch (e) {
			// 		console.log(e);
			// 	}
			// });
		},

		logout() {
			axios.get("/sanctum/csrf-cookie").then((response) => {
				axios
					.post("/logout")
					.then((response) => {
						console.log("user has logout");
					})
					.catch((error) => console.log(error));
			});
		},
	},
};
</script>

<style>
</style>