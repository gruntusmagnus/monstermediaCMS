<template>
	<div>
		<h1>Novy admin</h1>

		<employee-form></employee-form>

	</div>
</template>

<script>
	import EmployeeForm from "../../components/forms/employee/EmployeeForm";

	export default {
		components: {
			EmployeeForm
		}
	}
</script>