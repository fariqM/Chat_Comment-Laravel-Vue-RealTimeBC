<template>
	<div
		class="auth-layout-wrap"
		style="background-image: url(/assets/images/photo-wide-4.jpg)"
	>
		<div class="auth-content">
			<div class="card o-hidden">
				<div class="row">
					<div
						class="col-md-6 text-center"
						style="
							background-size: cover;
							background-image: url(/assets/images/photo-long-3.jpg);
						"
					>
						<div class="pl-3 auth-right">
							<div class="auth-logo text-center mt-4">
								<img :src="'/assets/images/logo.png'" />
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
										required
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
										required
									/>
									<div v-if="theErrors.email" class="mt-2 text-danger">
										{{ theErrors.email[0] }}
									</div>
								</div>
								<div class="form-group">
									<label for="password">Password</label>
									<div class="input-right-icon">
										<input
											v-model="form.password"
											class="form-control form-control-rounded"
											v-bind:type="PasswordForm"
											v-bind:class="{ 'is-invalid': formPassword }"
											required
										/>
										<span @click="showPassword" class="span-right-input-icon">
											<i class="ul-form__icon i-Eye"></i>
										</span>
									</div>
									<!-- <input
										v-model="form.password"
										class="form-control form-control-rounded"
										type="password"
										v-bind:class="{ 'is-invalid': formPassword }"
										required
									/> -->
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
										required
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
			PasswordForm: "password",
			formRePassword: false,
			formPassword: false,
			progress: 0,
			theErrors: [],
			form: {
				name: "joniea",
				email: "",
				password: "rangga1822",
				password_confirmation: "rangga1822",
			},
		};
	},
	methods: {
		showPassword() {
			if (this.PasswordForm === "password") {
				this.PasswordForm = "text";
			} else {
				this.PasswordForm = "password";
			}
		},
		FormHandler() {
			if (this.form.password_confirmation === this.form.password) {
				this.formRePassword = false;
				this.formPassword = false;
				this.RegisterAction();
			} else {
				this.$toast.error("Password doesnt match!", "Oops!", {
					position: "topCenter",
				});
				this.formRePassword = true;
				this.formPassword = true;
			}
		},
		attempRegist() {
			const loading = this.$vs.loading({
				background: "#505050",
				progress: 0,
				color: "#fff",
				type: "scale",
				text: "ATTEMPTING REGISTERING THE ACCOUNT",
			});
			const interval = setInterval(() => {
				if (this.progress <= 100) {
					loading.changeProgress(this.progress++);
				}
			}, 12);
			axios.get("/sanctum/csrf-cookie").then((fun) => {
				axios.post("/register", this.form).then((response) => {
					if (response.status == 201) {
						// "success register"
						loading.close();
						clearInterval(interval);
						this.progress = 0;
						this.$toast.success("Register Succes", "Great!", {
								position: "topCenter",
								timeout: 1999,
								close: false,
							});
						setTimeout(() => {
							this.$router.push({ name: "home" });
						}, 1000);
					} else if (response.status == 200) {
						loading.close();
						clearInterval(interval);
						this.progress = 0;
						this.reLogin();
					}
					// console.log(response.status);
				});
			});
		},
		reLogin() {
			const loading = this.$vs.loading({
				background: "#505050",
				progress: 0,
				color: "#fff",
				type: "scale",
				text: "PLEASE LOGOUT BEFORE REGISTER NEW ACCOUNT",
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
			}, 4000);
		},
		RegisterAction() {
			const loading = this.$vs.loading({
				progress: 0,
				color: "#7d33ff",
				type: "scale",
				text: "VERIFYING EMAIL...",
			});
			const interval = setInterval(() => {
				if (this.progress <= 100) {
					loading.changeProgress(this.progress++);
				}
			}, 12);
			axios.get("/sanctum/csrf-cookie").then((fun) => {
				axios.get(`/api/get-email/${this.form.email}`).then((response) => {
					// console.log(response);
					if (response.data !== "") {
						loading.close();
						clearInterval(interval);
						this.progress = 0;
						this.$toast.error("Email already used.", "Oops!", {
							position: "topCenter",
						});
					} else if (response.data === "") {
						loading.close();
						clearInterval(interval);
						this.progress = 0;
						this.attempRegist();
					}
				});
			});
		},
	},
};
</script>

<style>
</style>