<template>
	<div class="auth-layout-wrap" style="background-image: url(/assets/images/photo-wide-4.jpg)">
		<div class="auth-content">
			<div class="card o-hidden">
				<div class="row">
					<div class="col-md-6 text-center"  style="background-size: cover;background-image: url(/assets/images/photo-long-3.jpg)">
						<div class="pl-3 auth-right">
							<div class="auth-logo text-center mt-4">
								<img :src="'/assets/images/logo.png'"/>
							</div>
							<div class="flex-grow-1"></div>
							<div class="w-100 mb-4">
								<router-link
									:to="{ name: 'login.page' }"
									class="btn btn-outline-primary btn-outline-email btn-block btn-icon-text btn-rounded"
								>
									<i class="i-Mail-with-At-Sign"></i> Sign in with Email
								</router-link>
							</div>
							<div class="flex-grow-1"></div>
						</div>
					</div>

					<div class="col-md-6">
						<div class="p-4">
							<h1 class="mb-3 text-18">Sign Up</h1>
							<form @submit.prevent="FormHandler">
								<div class="form-group">
									<label for="username">Your name</label>
									<input
										v-model="form.name"
										id="username"
										class="form-control form-control-rounded"
										type="text"
									/>
									<div v-if="theErrors.name" class="mt-2 text-danger">
										{{ theErrors.name[0] }}
									</div>
								</div>
								<div class="form-group">
									<label for="email">Email address</label>
									<input
										v-model="form.email"
										id="email"
										class="form-control form-control-rounded"
										type="email"
									/>
									<div v-if="theErrors.email" class="mt-2 text-danger">
										{{ theErrors.email[0] }}
									</div>
								</div>
								<div class="form-group">
									<label for="password">Password</label>
									<input
										v-model="form.password"
										class="form-control form-control-rounded"
										type="password"
										v-bind:class="{ 'is-invalid': formPassword }"
									/>
									<div v-if="theErrors.password" class="mt-2 text-danger">
										{{ theErrors.password[0] }}
									</div>
								</div>
								<div class="form-group">
									<label for="repassword">Retype password</label>
									<input
										v-bind:class="{ 'is-invalid': formRePassword }"
										v-model="form.password_confirmation"
										class="form-control form-control-rounded"
										type="password"
									/>
								</div>
								<button
									type="submit"
									class="btn btn-primary btn-block btn-rounded mt-3"
								>
									Sign Up
								</button>
							</form>
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
			formRePassword: false,
			formPassword: false,

			theErrors: [],
			form: {
				name: "",
				email: "",
				password: "",
				password_confirmation: "",
			},
		};
	},
	methods: {
		FormHandler() {
			if (this.form.password_confirmation === this.form.password) {
				this.formRePassword = false;
				this.formPassword = false;
				this.RegisterAction();
			} else {
				this.$toast.error("Password doesnt match!", "Oops,", {
					position: "topRight",
				});
				this.formRePassword = true;
				this.formPassword = true;
			}
		},
		RegisterAction() {
			axios.get("/sanctum/csrf-cookie").then((fun) => {
				console.log("this is the CSRF-Cookie from Sanctum : "+JSON.stringify(fun));
				try {
					axios.post("/register", this.form).then((response) => {
						console.log("register success");
						console.log(response);
						if(response.status == 201){
							//go to home
						}
					});
				} catch (e) {
					console.log(e);
					this.theErrors = e.response.data.errors;
				}
			});
			// try {
			// 		axios.post("/logout", this.form).then((response) => {
			// 			console.log("register success");
			// 			console.log(response);
			// 		});
			// 	} catch (e) {
			// 		console.log(e);
			// 		this.theErrors = e.response.data.errors;
			// 	}
		},
	},
};
</script>

<style>
</style>