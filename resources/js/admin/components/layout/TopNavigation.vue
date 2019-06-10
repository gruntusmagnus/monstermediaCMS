<template>
	<div :class="menuClass">
		<div class="main-menu__content">

			<nested-menu show v-if="loaded" :data="data"></nested-menu>
			<top-navigation-side></top-navigation-side>

		</div>
		<div class="main-menu__mobile-btn" @click="toggleMenuClass">
			<div class="main-menu__mobile-btn-line"></div>
			<div class="main-menu__mobile-btn-line"></div>
			<div class="main-menu__mobile-btn-line"></div>
		</div>
	</div>
</template>

<script>
	import TopNavigationSide from "./TopNavigationSide"
	import NestedMenu from './NestedMenu'

	export default {
		components: {
			TopNavigationSide,
			NestedMenu
		},

		data() {
			return {
				data: [],
				loaded: true,
				menuExtraClass: ''
			}
		},
        computed: {
            menuClass() {
                return "main-menu main-menu--admin " +this.menuExtraClass
            }
        },
		methods: {
            toggleMenuClass() {
                if (this.menuExtraClass === "") {
                    this.menuExtraClass = "active";
                } else {
                    this.menuExtraClass = "";
                }
            },
			initMenu: function () {
				this.loaded = false;

				this.$http.get ("/api/menu/admin-sidebar")
						.then ((response) => {
							this.loaded = true;
							this.data = response.data;
						}, (error) => {
							this.loaded = true;
						})
			}
		},
		mounted: function mounted() {
			this.initMenu();
		}
	}

</script>

<style lang="scss" scoped>

	header {
		z-index: 2;
	}

</style>