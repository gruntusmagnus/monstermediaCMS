<template>

	<aside>
		<b-alert show v-if="loading">Probíhá načítání menu...</b-alert>

		<nested-menu v-else :data="data"></nested-menu>

	</aside>
</template>

<script>
	import NestedMenu from './NestedMenu'

	export default {
		components: {
			NestedMenu
		},

		data() {
			return {
				data: [],
				loading: false
			}
		},
		methods: {
			initSidebar: function () {
				this.loading = true;

				this.$http.get ("/api/menu/admin-sidebar")
					.then ((response) => {
						this.loading = false;
						this.data = response.data;
					}, (error) => {
						this.loading = false;
					})
			}
		},
		mounted: function mounted() {
			this.initSidebar();
		}
	}
</script>

<style lang="scss">

	nav {
		padding-top: 40px;
		background: #4a555c;
		z-index: 1;

		ul{
			list-style: none;
			padding: 0;
			margin: 0;

			li{

				a{
					display:block;
					color: #fff;
					padding: 5px;
					text-decoration: none;

					&:hover{
						background: rgba(0,0,0,0.2);
						color:#fff;
						text-decoration: none;
					}
				}
			}
		}

	}

</style>