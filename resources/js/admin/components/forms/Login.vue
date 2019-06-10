<template>
	<div>

		<div class="login__alerts">
			<b-alert variant="success" v-model="success" dismissible>Přihlášení úspěšné, probíhá přesměrování do
				administrace.
			</b-alert>

			<b-alert variant="danger" v-model="error" dismissible>Se zadanými informacemi se nebylo možné přihlásit.</b-alert>
		</div>

		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="card login__form">
					<div class="card-header">Přihlášení</div>

					<div class="card-body">
						<form autocomplete="off" @submit.prevent="login" method="post">

							<div class="form-group row">
								<label for="email" class="col-md-12 col-form-label">E-Mail</label>

								<div class="col-md-12">
									<input id="email" type="email" class="form-control" name="email" v-model="email" required autofocus>
								</div>
							</div>

							<div class="form-group row">
								<label for="password" class="col-md-12 col-form-label">Heslo</label>

								<div class="col-md-12">
									<input id="password" type="password" class="form-control" name="password" v-model="password" required>
								</div>
							</div>

							<div class="form-group row mt-5">
								<div class="col-md-12">
									<button type="submit" class="btn btn-primary">
										Přihlášení
									</button>
									<router-link :to="{name: 'ResetPassword'}" class="btn btn-link">Zapomenuté heslo</router-link>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>


<script>
	export default {
		name: 'login-form',

		data() {
			return {
				email: null,
				password: null,
				error: false,
				success: false
			}
		},

		methods: {

			login: function () {
				let credentials = {
					email: this.email,
					password: this.password
				};

				this.error = this.success = false;

				this.$store.dispatch ('loginUser', credentials).then (() => {
					this.$router.push ({name: "Dashboard"});

					this.error = false;
					this.success = true;
				}).catch ((error) => {
					this.$store.commit ('logout');
					this.error = true;
					this.success = false;
				});
			}
		}
	}
</script>