<template>
	<div class="page-wrap">
		<main class="py-4">
			<div class="login login--admin">

				<div class="login__header">
					<a href="/">
						<img src="/img/logo.png" alt="Cyberbog">
					</a>
				</div>

				<router-view></router-view>
			</div>
		</main>
	</div>
</template>

<script>
	export default {
	}
</script>

<style lang="scss" scoped >

	.login-form {
		width: 350px;
		padding:50px;
	}

</style>

