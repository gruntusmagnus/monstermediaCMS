
<template>
	<ul class="main-menu__menu-right">
		<li>
			<language-switcher></language-switcher>
		</li>
		<li>
			<a class="main-menu__item main-menu__item--logout" @click="logout">
				Logout
			</a>
		</li>
	</ul>

</template>

<script>
	export default {
		name: 'top-navigation-side',
		methods: {
			logout: function () {
				this.$store.commit('logout');
				this.$router.push('/login');
			}
		}
	}
</script>