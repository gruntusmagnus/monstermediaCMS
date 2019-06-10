<template>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-6">
				<div class="card card-default">
					<div class="card-header">Nastavení nového hesla</div>
					<div class="card-body">

						<b-alert variant="danger" v-model="has_error" dismissible>{{error}}</b-alert>


						<form autocomplete="off" @submit.prevent="resetPassword" method="post">
							<div class="form-group">
								<label for="email">E-mail</label>
								<input type="email" id="email" class="form-control" placeholder="user@example.com" v-model="email" required>
							</div>
							<div class="form-group">
								<label for="email">Heslo</label>
								<input type="password" id="password" class="form-control" placeholder="" v-model="password" required>
							</div>
							<div class="form-group">
								<label for="email">Potvrzení hesla</label>
								<input type="password" id="password_confirmation" class="form-control" placeholder="" v-model="password_confirmation" required>
							</div>
							<button type="submit" class="btn btn-primary">Nastavit nové heslo</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
	import settings from "../../settings";

	export default {
		data() {
			return {
				token: null,
				email: null,
				password: null,
				password_confirmation: null,
				error: '',
				has_error: false
			}
		},
		methods: {
			resetPassword() {

				if (this.password !== this.password_confirmation) {
					this.has_error = true;
					this.error = "Zadaná hesla nesouhlasí.";
					return;
				}

				this.has_error = this.error = false;

				this.$http.post (settings.API_URL + "admin/auth/reset/password", {
					token: this.$route.params.token,
					email: this.email,
					password: this.password,
					password_confirmation: this.password_confirmation
				})
					.then (result => {
						let credentials = {
							email: this.email,
							password: this.password
						};

						this.$store.dispatch ('loginUser', credentials).then (() => {
							this.$router.push ({name: "Dashboard"})
						}).catch ((error) => {
							this.$store.commit ('logout');
							this.error = true;
						});

					}, error => {
						this.has_error = true;
						this.error = "Reset hesla nebyl úspěšný. Zadáváte správný e-mail?";
					});
			}
		}
	}
</script>