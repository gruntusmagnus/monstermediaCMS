<template>
	<form @submit="saveEmployee" action="javascript:void(0)">
		<label for="name">
			Jmeno

			<input type="text" id="name" name="name" v-model="name">
		</label>

		<label for="email">
			Email

			<input type="text" id="email" name="email" v-model="email">
		</label>

		<button type="submit" class="btn btn-primary">Uložit</button>
	</form>
</template>

<script>
	export default {
		name: "employee-form",
		// props: ['method', 'action', 'employee'],
		data() {
			return {
				name: null,
				email: null,
				password: null,
				error: false
			}
		},
		methods: {
			saveEmployee() {
				this.$http.post ('/api/employee', {
					email: this.email,
					name: this.name,
				}).then ((response) => {
					this.$router.push ('/employee');
				});
			}
		}
	}
</script>