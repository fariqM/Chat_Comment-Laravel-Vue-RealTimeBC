<template>
	<div class="auth-layout-wrap" style="background-image: url(/assets/images/photo-wide-4.jpg)">
		<div class="auth-content">
			<div class="card o-hidden">
				<div class="row">
					<div class="col-md-6">
						<div class="p-4">
							<div class="auth-logo text-center mb-4">
								<img :src="'/assets/images/logo.png'" alt="" />
							</div>
							<h1 class="mb-3 text-18">Sign In</h1>
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
							<button v-on:click="logout" class="btn btn-rounded btn-primary btn-block mt-2">
								Trial Logout
							</button>

							<div class="mt-3 text-center">
								<a href="forgot.html" class="text-muted"
									><u>Forgot Password?</u></a
								>
							</div>
						</div>
					</div>
					<div class="col-md-6 text-center"  style="background-size: cover;background-image: url(/assets/images/photo-long-3.jpg)">
						<div class="pr-3 auth-right">
							<router-link
								class="btn btn-rounded btn-outline-primary btn-outline-email btn-block btn-icon-text"
								:to="{ name: 'register.page' }"
							>
								<i class="i-Mail-with-At-Sign"></i> Sign up with Email
							</router-link>
							<router-link
								class="btn btn-rounded btn-outline-primary btn-outline-email btn-block btn-icon-text"
								:to="{ name: 'dashboard.page' }"
							>
								<i class="i-Mail-with-At-Sign"></i> View Inside
							</router-link>
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
			form: {
				email: "",
				password: "",
			},
		};
	},
	methods: {
		handleLogin() {
			axios.get("/sanctum/csrf-cookie").then((fun) => {
				try {
					axios
						.post("/login", this.form)
						.then((response) => {
							if (response.status == 204 || 200) {
								console.log("im in");
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

		logout() {
			axios.get("/sanctum/csrf-cookie").then((response) => {
				axios
					.post("/logout", this.formData)
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