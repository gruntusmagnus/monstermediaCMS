<template>

    <component :is="layout">
        <router-view></router-view>
    </component>

</template>

<script>
	import {mapGetters} from "vuex";

	const default_layout = "default-layout";

	export default {
		computed: {
			layout() {
				return this.$route.meta.layout || default_layout;
			},
			...mapGetters(['isLoggedIn'])

		},
		mounted() {
			this.$store.dispatch ('loadUserInfo')
		}
	}
</script>