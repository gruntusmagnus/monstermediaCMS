<template>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-8">
				<div class="card card-default">
					<div class="card-header">Zapomenuté heslo</div>
					<div class="card-body">

						<b-alert variant="success" v-model="emailSent" dismissible>E-mail s instrukcemi úspěšně odeslán.</b-alert>
						<b-alert variant="danger" v-model="error" dismissible>Na zadanou adresu se nepodařilo odeslat e-mail. Opravdu je u nás registrovaná?</b-alert>


						<form autocomplete="off" @submit.prevent="requestResetPassword" method="post">
							<div class="form-group">
								<label for="email">E-mail</label>
								<input type="email" id="email" class="form-control" placeholder="user@example.com" v-model="email" required>
							</div>
							<button type="submit" class="btn btn-primary">Odeslat instrukce pro reset hesla</button>

							<router-link :to="{name: 'Login'}">Zpět na přihlášení</router-link>
						</form>

					</div>
				</div>
			</div>
		</div>
	</div>

</template>

<style lang="scss">

</style>


<script>
	import settings from "../../settings";

	export default {
		data() {
			return {
				email: null,
				error: false,
				emailSent: false
			}
		},
		methods: {
			requestResetPassword() {
				this.$http.post(settings.API_URL + 'admin/auth/reset-password', {email: this.email}).then(result => {
					this.emailSent = true;
					this.error = false;
				}, error => {
					this.error = true;
					this.emailSent = false;
				});
			}
		}
	}
</script>