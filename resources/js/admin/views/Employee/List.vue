<template>

	<div>
		<h1>Zaměstnanci</h1>

		<div class="loading" v-if="loading">Nacitani...</div>
		<b-table v-else striped hover :items="employees" />

		<router-link to="employee/create">Nový</router-link>
	</div>

</template>

<script>
	export default {
		data() {
			return {
				item: '',
				loading: false,
				employees: []
			}
		},
		methods: {
			loadEmployees: function () {
				this.loading = true;

				this.axios.get ("/api/employee")
					.then ((response) => {
						this.loading = false;
						this.employees= response.data.data;

					}, (error) => {
						this.loading = false;
					})
			}
		},
		mounted: function mounted() {
			this.loadEmployees();
		}
	}
</script>

